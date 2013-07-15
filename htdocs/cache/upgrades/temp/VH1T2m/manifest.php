<?php

$manifest = array (
	'acceptable_sugar_versions' => array(
		'regex_matches' => array(
			0 => "6\.3\.*",
			1 => "6\.4\.*",
			2 => "6\.5\.*",
		),
	),
	'acceptable_sugar_flavors' =>
	array(
		0 => 'CE',
		1 => 'PRO',
		2 => 'CORP',
		3 => 'ENT',
		4 => 'ULT'
	),
	'readme'           =>'',
	'author'           => 'Epicom::DannyMulvihill()',
	'description'      => 'This is a custom theme inspired by the new Google look.',
	'is_uninstallable' => true,
	'name'             => 'GooglePlusTheme',
	'published_date'   => '2012-11-07',
	'type'             => 'theme',
	'version'          => '0.1',
	'remove_tables'    => 'prompt',
	'icon'             => 'images/Themes.gif',
	'copy_files'       => array(
		'from_dir'   => 'GooglePlus',
		'to_dir'     => 'themes/GooglePlus',
		'force_copy' => array(),
	),
);
?>