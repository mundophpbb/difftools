<?php
/**
*
* MundoPHPBB Diff Tools [English]
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'MUNDOPHPBB_DIFF_TITLE'		=> 'Diff Tools',
	'MUNDOPHPBB_DIFF_WIZARD'	=> 'Diff Wizard',
	'MUNDOPHPBB_DIFF_OLD'		=> 'Old Text',
	'MUNDOPHPBB_DIFF_NEW'		=> 'New Text',
	'MUNDOPHPBB_DIFF_GENERATE'	=> 'Generate BBCode',
	'MUNDOPHPBB_DIFF_CANCEL'	=> 'Cancel',
	'MUNDOPHPBB_DIFF_HELPLINE'	=> 'MundoPHPBB Diff: [dif]- old + new[/dif]',
));