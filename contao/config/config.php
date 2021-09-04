<?php

/**
 * This file is part of the author_news Contao extension.
 *
 * (c) inspiredminds <https://github.com/inspiredminds>
 *
 * @package   inspiredminds/contao-author-news
 * @author    Fritz Michael Gschwantner <https://github.com/fritzmg>
 * @license   LGPL-3.0+
 * @copyright inspiredminds 2017
 */

use AuthorNews\AuthorNews;

array_unshift($GLOBALS['TL_HOOKS']['newsListCountItems'], [AuthorNews::class, 'newsListCountItems']);
array_unshift($GLOBALS['TL_HOOKS']['newsListFetchItems'], [AuthorNews::class, 'newsListFetchItems']);
