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

register_activation_hook(__FILE__, array('pressControl', 'firstRun'));
register_activation_hook(__FILE__, array('pressControl', 'deactivate'));
add_action('admin_menu', array('pressControl', 'adminPanel'));
add_action('admin_menu', array('pressControl', 'secheduleJobs'));

class pressControl {

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

	public function adminPanel(){

		add_management_page('Press Control', 'Press Control', 'activate_plugins', 'press-control-options', array('pressControl', 'adminPanelRender'));

	}

	public function adminPanelRender(){
		//$test = get_option('cron'); 
		echo '<pre>';
		//print_r($test);
		var_dump(wp_get_schedule('pc_check_themes_hook'));
		echo file_get_contents(dirname(__FILE__) . '/views/options-page.php');
	
	}

	public function secheduleJobs(){

		if(!wp_next_scheduled('pc_check_plugins_hook')
		{
			wp_schedule_event(time() + 60, 'hourly', 'pc_check_plugins_hook'); 	
		}
		
		if(!wp_next_scheduled('pc_check_themes_hook'))
		{
			wp_schedule_event(time() + 60, 'hourly', 'pc_check_themes_hook'); 	
		}
		
		add_action('pc_check_plugins_hook', array($this,'pcCheckPlugins'));
		add_action('pc_check_themes_hook', array($this,'pcCheckThemes'));
		

	}

	protected function pcCheckPlugins(){
		$all_plugins = get_plugins();
	}

	protected function pcCheckThemes(){
		$all_plugins = wp_get_themes();
	}

}

