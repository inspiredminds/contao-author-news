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


namespace AuthorNews;

class AuthorNews
{
	/**
	 * newsListFetchItems hook to filter for news written by a specific author
	 * @param  array       $newsArchives
	 * @param  boolean     $blnFeatured
	 * @param  \ModuleNews $objModule
	 * @return integer|false
	 */
	public function newsListCountItems($newsArchives, $blnFeatured, \ModuleNews $objModule)
	{
		// check if we need to filter
		if (!$objModule->authorFilter)
		{
			return false;
		}

		// get the author ID
		$intAuthor = \Input::get('author') ?: $objModule->authorDefault;

		// check if an author was found
		if (!$intAuthor)
		{
			return 0;
		}

		if (!is_array($newsArchives) || empty($newsArchives))
		{
			return 0;
		}

		$t = \NewsModel::$strTable;
		$arrColumns = array(
			"$t.pid IN(" . implode(',', array_map('intval', $newsArchives)) . ")",
			"$t.author = ?"
		);
		$arrValues = array($intAuthor);

		if ($blnFeatured === true)
		{
			$arrColumns[] = "$t.featured='1'";
		}
		elseif ($blnFeatured === false)
		{
			$arrColumns[] = "$t.featured=''";
		}

		if (!BE_USER_LOGGED_IN || TL_MODE == 'BE')
		{
			$time = \Date::floorToMinute();
			$arrColumns[] = "($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'" . ($time + 60) . "') AND $t.published='1'";
		}

		return \NewsModel::countBy($arrColumns, $arrValues, $arrOptions);
	}


	/**
	 * newsListFetchItems hook to filter for news written by a specific author
	 * @param  array       $newsArchives
	 * @param  boolean     $blnFeatured
	 * @param  integer     $limit
	 * @param  integer     $offset
	 * @param  \ModuleNews $objModule
	 * @return \Model\Collection|\NewsModel|null|false
	 */
	public function newsListFetchItems($newsArchives, $blnFeatured, $limit, $offset, \ModuleNews $objModule)
	{
		// check if we need to filter
		if (!$objModule->authorFilter)
		{
			return false;
		}

		// get the author ID
		$intAuthor = \Input::get('author') ?: $objModule->authorDefault;

		// check if an author was found
		if (!$intAuthor)
		{
			return null;
		}

		// create options array for model query
		if (!is_array($newsArchives) || empty($newsArchives))
		{
			return null;
		}

		$t = \NewsModel::$strTable;
		$arrColumns = array(
			"$t.pid IN(" . implode(',', array_map('intval', $newsArchives)) . ")",
			"$t.author = ?"
		);
		$arrValues = array($intAuthor);

		if ($blnFeatured === true)
		{
			$arrColumns[] = "$t.featured='1'";
		}
		elseif ($blnFeatured === false)
		{
			$arrColumns[] = "$t.featured=''";
		}

		// Never return unpublished elements in the back end, so they don't end up in the RSS feed
		if (!BE_USER_LOGGED_IN || TL_MODE == 'BE')
		{
			$time = \Date::floorToMinute();
			$arrColumns[] = "($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'" . ($time + 60) . "') AND $t.published='1'";
		}

		$arrOptions = array();
		$arrOptions['order']  = "$t.date DESC";
		$arrOptions['limit']  = $intLimit;
		$arrOptions['offset'] = $intOffset;

		return \NewsModel::findBy($arrColumns, $arrValues, $arrOptions);
	}
}
