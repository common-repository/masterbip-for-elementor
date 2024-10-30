<?php
/**
 * Plugin Name: MasterBip para Elementor
 * Description: Módulos (Widgets y addons) adicionales para Elementor
 * Author: MasterBip
 * Version: 1.6.3
 * Author URI: https://www.masterbip.cl/
 *
 * Text Domain: masterbip
 *
 * MasterBip para Elementor is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * MasterBip para Elementor is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

final class Elementor_Mb_Elementor{
	const VERSION = '1.6.2';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.0';
	public function __construct(){
		add_action('init',array($this,'i18n'));
		add_action('plugins_loaded',array($this,'init'));
	}
	public function i18n(){
		load_plugin_textdomain('masterbip');
	}
	public function init(){
		if (!did_action('elementor/loaded')){
			add_action('admin_notices',array($this,'admin_notice_missing_main_plugin'));
			return;
		}
		if (!version_compare(ELEMENTOR_VERSION,self::MINIMUM_ELEMENTOR_VERSION,'>=')){
			add_action('admin_notices',array($this,'admin_notice_minimum_elementor_version'));
			return;
		}
		if (version_compare(PHP_VERSION,self::MINIMUM_PHP_VERSION,'<')){
			add_action('admin_notices',array( $this, 'admin_notice_minimum_php_version'));
			return;
		}
		require_once('plugin.php');
		require_once('category.php');
	}
	public function admin_notice_missing_main_plugin(){
		if (isset($_GET['activate'])){
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.','masterbip'),
			'<strong>'.esc_html__('MasterBip para Elementor','masterbip').'</strong>',
			'<strong>'.esc_html__('Elementor','masterbip').'</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>',$message);
	}
	public function admin_notice_minimum_elementor_version(){
		if (isset( $_GET['activate'])){
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.','masterbip'),
			'<strong>'.esc_html__('MasterBip para Elementor','masterbip').'</strong>',
			'<strong>'.esc_html__('Elementor','masterbip'). '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>',$message);
	}
	public function admin_notice_minimum_php_version(){
		if (isset( $_GET['activate'])){
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.','masterbip'),
			'<strong>'.esc_html__('MasterBip para Elementor','masterbip'). '</strong>',
			'<strong>'.esc_html__('PHP','masterbip').'</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>',$message);
	}
}
new Elementor_Mb_Elementor();
