<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'ROLAND.' . $_EXTKEY,
	'Filedownloadlist',
	array(
		'Galery' => 'list, show, download',
		
	),
	// non-cacheable actions
	array(
		'Galery' => 'list, show, download',
		
	)
);
