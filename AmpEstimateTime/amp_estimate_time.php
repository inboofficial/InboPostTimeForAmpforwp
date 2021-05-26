<?php
/**
 *
 * @package             PluginPackage
 * @author              mohammad ali nassiri: mohammad.ank@outlook.com
 *
 * @wordpress-plugin
 * Plugin Name:         Inbo Post Time For ampforwp
 * Description:         estimate post time
 * Version:             0.10.2-beta
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author :             inbo
 * Author URI :         https://Inbo.ir
 * License:             GPL3
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.html
 *
 * Inbo Post Time For ampforwp plugin, Copyright 2021 inbo.ir
 * Inbo Post Time For ampforwp is free software:
 * you can redistribute it and/or modify it under the terms of the GNU General
 * Public License as published by the Free Software Foundation,
 * either version 2 of the License, or any later version.
 *
 * Inbo Post Time For ampforwp is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Inbo Post Time For ampforwp. If not, see <https://www.gnu.org/licenses/>.
 *
 */

if (!defined('ABSPATH')) {
    header('HTTP/1.0 403 Forbidden');
    die('You are not allowed to access this file.');
}

require_once "vendor/autoload.php";

use IrInboExtension\classes\Plugin;
use IrInboExtension\services\PostTimeSettings;
use IrInboExtension\services\PostEstimateTimeBlockLoader;


add_action('plugins_loaded', 'inbo_estimate_time_plugin_init'); // Hook initialization function
function inbo_estimate_time_plugin_init()
{
    $plugin = new Plugin(); // Create container
    $plugin['path'] = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR;
    $plugin['url'] = plugin_dir_url(__FILE__);
    $plugin['version'] = '1.0.0';
    //add services
    $plugin['PostTimeSettings'] = new PostTimeSettings($plugin['path']);
    $plugin['PostTimeBlockLoader'] = new PostEstimateTimeBlockLoader($plugin['path']);
    //run
    $plugin->run();
}
