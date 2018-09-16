<?php

define('EME_LOADER_PATH', __DIR__);
require EME_LOADER_PATH . '/Creator.php';
/**
 *
 */
$files = get_included_files();
if (count($files) !== 3) {
	trigger_error('Auto loader script must be included before any other files.', E_USER_ERROR);
	exit();
}
if (defined('EME_LOADER_ROOT_PATH')) {
	trigger_error('Auto loader script must be included only once.', E_USER_ERROR);
	exit();
}
/**
 *
 */
define('EME_LOADER_ROOT_PATH', dirname(array_shift($files)));
/**
 *
 */

$className = md5(EME_LOADER_PATH);
$loaderClass = EME_LOADER_PATH . '/' . $className . '.php';
if (!file_exists($loaderClass)) {
	file_put_contents($loaderClass, Creator::getLoaderClassTemplate($className));
} else {
	require EME_LOADER_PATH . '/ClassLoader.php';
	require $loaderClass;
	$loader = new $className();
	$loader->resolve();
}
