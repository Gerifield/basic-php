<?php
/**
 * @author gerifield <gerifield@ustream.tv>
 */

class GlobalConfig
{
	private static $configs = array(
		'TWIG.TEMPLATE_PATH' => '/var/www/public_html/template',
		'TWIG.CACHE_PATH'    => '/var/www/public_html/cache/template',
	);

	public static function get($key)
	{
		if (isset(self::$configs[$key])) {
			return self::$configs[$key];
		} else {
			return null;
		}
	}
} 