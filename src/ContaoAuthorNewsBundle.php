<?php

declare(strict_types=1);

/*
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoAuthorNews;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoAuthorNewsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
