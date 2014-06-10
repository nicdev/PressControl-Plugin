<?php 

/**
 * Plugin Name: Press Control
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Allows you to connect to PressControl's dashboard for better multisite management.
 * Version: 0.1
 * Author: Nic Rosental, Epic Labs 
 * Author URI: http://epiclabs.com
 * License: GPL2
 * Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)
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
add_action('admin_menu', array('pressControl', 'adminPanel'));

class pressControl {

	/**
	 * Sets up the cron job to start submitting info to pressControl
	 * @return null
	 */
	
	public function firstRun(){

		//set up cron jobs for submitting info

	}

	public function adminPanel(){

		add_management_page('Press Control', 'Press Control', 'activate_plugins', 'press-control-options', array('pressControl', 'adminPanelRender'));

	}

	public function adminPanelRender(){
		
		echo file_get_contents(dirname(__FILE__) . '/views/options-page.php');
	
	}
}

