<?php

/**
 * WP Todo List
 * 
 * @package WP_Todo_List_Init
 * @author Syed Galib Ahmed
 * @copyright 2019 Syed Galib Ahmed
 * @license GPL-2.0-or-later
 * 
 * @wordpress-plugin
 * Plugin Name: WP Todo List
 * Plugin URI: #
 * Description: A starter plugin for WordPress
 * Version: 0.0.1
 * Requires at least: 5.0.0
 * Requires PHP: 5.6.20
 * Author: Syed Galib Ahmed
 * Author URI: https://github.com/syedgalib
 * Text Domain: sg413-wp-todo-app
 * Domain Path: /languages
 * License: GPL2 or later
 * License URI: https://www.gnu.org/philosophy/license-list.html#GPLCompatibleLicenses
 * 
 * WP Todo List is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *  
 * WP Todo List is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 
 * You should have received a copy of the GNU General Public License
 * along with WP Todo List. If not, see https://www.gnu.org/philosophy/license-list.html#GPLCompatibleLicenses.
 */

if (!defined('ABSPATH')) {
  die;
}

define('WP_TODO_LIST__FILE__', __FILE__);
define('WP_TODO_LIST_PLUGIN_BASE', plugin_basename(WP_TODO_LIST__FILE__));
define('WP_TODO_LIST_PATH', plugin_dir_path(WP_TODO_LIST__FILE__));
define('WP_TODO_LIST_URL', plugins_url('/', WP_TODO_LIST__FILE__));
define('WP_TODO_LIST_ADMIN_PATH', WP_TODO_LIST_PATH . 'admin/');
define('WP_TODO_LIST_ADMIN_URL', WP_TODO_LIST_URL . 'admin/');
define('WP_TODO_LIST_PUBLIC_PATH', WP_TODO_LIST_PATH . 'public/');
define('WP_TODO_LIST_PUBLIC_URL', WP_TODO_LIST_URL . 'public/');

if (file_exists(WP_TODO_LIST_PATH . 'vendor/autoload.php')) {
  require_once(WP_TODO_LIST_PATH . 'vendor/autoload.php');
}


function WP_Todo_List()
{
  if ( class_exists( 'App\WP_Todo_List_Init' ) ) {
    return App\WP_Todo_List_Init::init();
  }

  return null;
}

WP_Todo_List();
