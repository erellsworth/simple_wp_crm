<?php
/**
 * @package SimpleCRM
 * @version 1
 */
/*
Plugin Name: Simple CRM
Description: Collect customer data and build customer profiles inside of the client’s WordPress Dashboard.
Author: E.R. Ellsworth
Plugin URI: https://erellsworth.com/wordpress
Version: 1
Author URI: https://erellsworth.com
*/

define('SIMPLECRM_PATH', dirname(__FILE__));
define('SIMPLECRM_URI', plugin_dir_url( __FILE__ ));

require_once SIMPLECRM_PATH . '/post-type.php';
//require_once SIMPLECRM_PATH . '/admin.php';
require_once SIMPLECRM_PATH . '/form.php';