<?php 

/**
 * Plugin Name: Press Control
 * Plugin URI: http://epiclabs.com/presscontrol
 * Description: Allows you to connect to PressControl's dashboard for better multisite management.
 * Version: 0.1
 * Author: Nic Rosental, Epic Labs 
 * Author URI: http://epiclabs.com
 * License: GPL2
 * Copyright 2014  Epic Labs  (email : nic@epiclabs.com)
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License, version 2, as 
 *  published by the Free Software Foundation.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

//include_once('vendor/Guzzle/src/Client.php');

//use GuzzleHttp\Client;

class PressControl {

	/**
	 * Sets up the cron job to start submitting info to pressControl
	 * @return null
	 */
	
	public function firstRun(){
		//self::secheduleJobs(); //For some reason scheduling isn't working on plugin activation
	}

	/**
	 * Deactivates the cron jobs, cleans up as necessary
	 * @return null
	 */
	
	public function deactivate(){
		wp_clear_scheduled_hook('pc_check_plugins_hook');
		wp_clear_scheduled_hook('pc_check_themes_hook');
	}

	/**
	 * Add options panel
	 */

	public function adminPanel(){

		add_management_page('Press Control', 'Press Control', 'activate_plugins', 'press-control-options', array('PressControl', 'adminPanelRender'));

	}

	/**
	 * Render options panel
	 */

	public function adminPanelRender(){

		include(dirname(__FILE__) . '/views/options-page.php');
	
	}

	/**
	 * Schedule cron jobs
	 */

	public function secheduleJobs(){

		if(!wp_next_scheduled('pc_check_plugins_hook'))
		{
			wp_schedule_event(time() + 60, 'hourly', 'pc_check_plugins_hook'); 	
		}
		
		if(!wp_next_scheduled('pc_check_themes_hook'))
		{
			wp_schedule_event(time() + 60, 'hourly', 'pc_check_themes_hook'); 	
		}
		
		add_action('pc_check_plugins_hook', array($this, 'pcCheckPlugins'));
		add_action('pc_check_themes_hook', array($this, 'pcCheckThemes'));
		add_action('pc_submit_data', array($this, 'pcSubmitData'));
		
	}

	/**
	 * Check for installed plugins
	 * @return array
	 */
	
	public function pcCheckPlugins(){
		$all_plugins = get_plugins();
		add_option('pc_plugins', $all_plugins);
		wp_mail('nic@epiclabs.com', 'plugins test', json_encode($all_plugins));
	}

	/**
	 * Check for installed themes
	 * @return array
	 */
	
	public function pcCheckThemes(){
		$all_themes = wp_get_themes();
		add_option('pc_themes', $all_themes);
	}

	/**
	 * Submit data to Press Control
	 */
	
	public function pcSubmitData(){
		$data['plugins'] = get_option('pc_plugins');
		$data['themes'] = get_option('pc_themes');

		$client = new Client();



	   	//json encode and send
	   	
	}

}

