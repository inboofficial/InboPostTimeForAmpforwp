<?php
/**
 * @package             PluginPackage
 * @author              mohammad ali nassiri
 * @copyright           please_do_not_copy
 */


use ir_inbo_extension\repository\PostMetaRepository;

if (!defined('ABSPATH')) {
    header('HTTP/1.0 403 Forbidden');
    die('You are not allowed to access this file.');
}

require_once "vendor/autoload.php";

PostMetaRepository::get_instance()->uninstall();
