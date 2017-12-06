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


$GLOBALS['TL_DCA']['tl_module']['fields']['authorFilter'] = array
(
	'label'      => &$GLOBALS['TL_LANG']['tl_module']['authorFilter'],
	'exclude'    => true,
	'inputType'  => 'checkbox',
	'eval'       => array('submitOnChange'=>true, 'tl_class'=>'clr'),
	'sql'        => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_module']['fields']['authorDefault'] = array
(
	'label'      => &$GLOBALS['TL_LANG']['tl_module']['authorDefault'],
	'exclude'    => true,
	'inputType'  => 'select',
	'foreignKey' => 'tl_user.name',
	'eval'       => array('doNotCopy'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'clr w50'),
	'sql'        => "int(10) unsigned NOT NULL default '0'",
	'relation'   => array('type'=>'hasOne', 'load'=>'lazy')
);

$GLOBALS['TL_DCA']['tl_module']['palettes']['newslist'] = str_replace('skipFirst', 'skipFirst,authorFilter', $GLOBALS['TL_DCA']['tl_module']['palettes']['newslist']);
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'authorFilter';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['authorFilter'] = 'authorDefault';
