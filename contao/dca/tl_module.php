<?php

declare(strict_types=1);

/*
 * (c) INSPIRED MINDS
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_module']['fields']['authorFilter'] =
[
    'label' => &$GLOBALS['TL_LANG']['tl_module']['authorFilter'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['authorDefault'] =
[
    'label' => &$GLOBALS['TL_LANG']['tl_module']['authorDefault'],
    'exclude' => true,
    'inputType' => 'select',
    'foreignKey' => 'tl_user.name',
    'eval' => ['doNotCopy' => true, 'chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'clr w50'],
    'sql' => "int(10) unsigned NOT NULL default '0'",
    'relation' => ['type' => 'hasOne', 'load' => 'lazy'],
];

PaletteManipulator::create()
    ->addField('authorFilter', 'config_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('newslist', 'tl_module')
;

$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'authorFilter';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['authorFilter'] = 'authorDefault';
