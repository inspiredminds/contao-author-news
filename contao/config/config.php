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


$GLOBALS['TL_HOOKS']['newsListCountItems'][] = array('AuthorNews\AuthorNews', 'newsListCountItems');
$GLOBALS['TL_HOOKS']['newsListFetchItems'][] = array('AuthorNews\AuthorNews', 'newsListFetchItems');
