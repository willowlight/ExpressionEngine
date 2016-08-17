<?php

/*
 * ------------------------------------------------------
 *  BASEPATH - path to the legacy app folder. Most legacy
 *             files check for this (`if ! defined ...`)
 * ------------------------------------------------------
 */
	if ( ! defined('BASEPATH'))
	{
		define('BASEPATH', SYSPATH.'ee/legacy/');
		define('FILE_READ_MODE', 0644);
		define('FILE_WRITE_MODE', 0666);
		define('DIR_READ_MODE', 0755);
		define('DIR_WRITE_MODE', 0777);
	}

/*
 * ------------------------------------------------------
 *  Load the autoloader and register it
 * ------------------------------------------------------
 */

	require SYSPATH.'ee/updater/EllisLab/ExpressionEngine/Updater/Core/Autoloader.php';

	EllisLab\ExpressionEngine\Updater\Core\Autoloader::getInstance()
		->addPrefix('EllisLab', SYSPATH.'ee/updater/EllisLab/')
		->register();

	// TODO: We need to figure out how to include the latest boot.common helper functions
	// after the old ones were already included in the CLI bootstrap
	if ( ! function_exists('is_php'))
	{
		require __DIR__.'/EllisLab/ExpressionEngine/Updater/Boot/boot.common.php';
	}

/*
 * ------------------------------------------------------
 *  Route the request to a controller
 * ------------------------------------------------------
 */

	if (php_sapi_name() != 'cli')
	{
		$directory = (isset($_GET['D']) && $_GET['D'] !== 'cp') ? $_GET['D'] : 'updater';
		$controller = (isset($_GET['C'])) ? $_GET['C'] : 'updater';
		$method = (isset($_GET['M'])) ? $_GET['M'] : 'index';
		routeRequest($directory, $controller, $method);
	}

	function routeRequest($directory, $controller, $method = '')
	{
		$class = 'EllisLab\ExpressionEngine\Updater\Controller\\'.ucfirst($directory).'\\'.ucfirst($controller);

		if (class_exists($class))
		{
			$controller_methods = array_map(
				'strtolower', get_class_methods($class)
			);

			if ( ! empty($method) && in_array($method, $controller_methods))
			{
				$controller_object = new $class;

				echo $controller_object->$method();
			}
		}
	}
