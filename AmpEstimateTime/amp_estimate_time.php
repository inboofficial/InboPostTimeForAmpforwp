<?php
/**
 *
 * @package             PluginPackage
 * @author              mohammad ali nassiri: mohammad.ank@outlook.com
 * @copyright           please_do_not_copy
 *
 * @wordpress-plugin
 * Plugin Name:         Inbo Post Time For ampforwp
 * Description:         estimate post time
 * Version:             0.10.2-beta
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author :             mohammad ali nasiri
 * Author URI :         mohammad.ank@outlook.com
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
