<?php
/*  Copyright 2008  Johnny Mast  (email : info@phpvrouwen.nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/*
	Plugin Name: Lock a blog
	Plugin URI:http://www.phpvrouwen.nl/lockablog
	Description: This plugin allows you block content wordpress post for underage readers.
	Version: 1.0
	Author: Johnny Mast
	Author URI: http://www.phpvrouwen.nl
*/
require_once ABSPATH.'/wp-includes/pluggable.php';
require_once 'includes/lockablog_templatetags.php';
require_once 'includes/lockablog_filters.php';
require_once 'includes/lockablog_metadata.php';
require_once 'includes/lockablog_css.php';


define ('LOCKABLOG_PATH',ABSPATH.'/'.PLUGINDIR.'/lockablog/');
define ('LOCKABLOG_PAGESPATH', ABSPATH.'/'.PLUGINDIR.'/lockablog/pages');
define ('LOCKABLOG_TRANSLATEDIR', PLUGINDIR.'/lockablog/translation');
define ('LOCKABLOG_TRANSLATIONDOMAIN', 'lockablog');
define ('LOCKABLOG_PLUGINURL', get_bloginfo ( 'wpurl' ).'/wp-content/plugins/lockablog/');
define ('LOCKABLOG_DEFAULT_MESSAGE', __('This content is blocked from non adult people what is your age ?.', LOCKABLOG_TRANSLATIONDOMAIN));
define ('LOCKABLOG_NUONCETARGET', plugin_basename(__FILE__));

/**
 * Initialize the translation for the Plugin.
 *
 */
function lockablog_init_translation()
{	
	
	load_plugin_textdomain(LOCKABLOG_TRANSLATIONDOMAIN, LOCKABLOG_TRANSLATEDIR);
}
add_action('init', 'lockablog_init_translation');


if (!function_exists ('print_rn'))
{
	function print_rn ($p_mData)
	{
		echo '<pre>';
		print_r ($p_mData);
		echo '</pre>';
	}
}


?>
