<?php

declare(strict_types=1);

/*
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoAuthorNews\EventListener;

use Contao\NewsModel;
use InspiredMinds\ContaoNewsFilterEvent\Event\NewsFilterEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RequestStack;

#[AsEventListener]
class NewsFilterEventListener
{
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    public function __invoke(NewsFilterEvent $event): void
    {
        $module = $event->getModule();

        if (!$module->authorFilter) {
            return;
        }

        $authorId = (int) ($this->requestStack->getCurrentRequest()?->query->get('author') ?: $module->authorDefault);

        if (!$authorId) {
            return;
        }

        $t = NewsModel::getTable();

        $event->addColumn("$t.author = ?");
        $event->addValue($authorId);
    }
}
