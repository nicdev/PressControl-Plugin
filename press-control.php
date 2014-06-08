<?php 

/**
* Plugin Name: Press Control
* Description: Allows you to connect to PressControl's dashboard for better multisite management.
* Version: 0.0.1
* Author: Nic Rosental/Epic Labs nic@epiclabs.com
*/

register_activation_hook(__FILE__, pressControl('firstRun'));
add_action('init', array('pressControl', 'adminPanel'));

class pressControl(){

	/**
	 * Sets up the cron job to start submitting info to pressControl
	 * @return null
	 */
	
	public function firstRun(){

		//set up cron jobs for submitting info

	}

	public function adminPanel(){

		//hook up admin panel

	}

	public function adminPanelRender(){

		//provide options for how often it submits info
		//allow entering token for PressControl auth
	
	}
}

