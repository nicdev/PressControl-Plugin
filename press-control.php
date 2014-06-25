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


spl_autoload_register( 'pcAutoloader' );

function pcAutoloader( $class ) {
    if ( glob ( plugin_dir_path( __FILE__ ) . 'vendor/*/' . $class . '.php') ){
    	$filefind = glob( plugin_dir_path( __FILE__ ) . 'vendor/*/' . $class . '.php' );	
        include_once($filefind[0]);
    }
}

register_activation_hook(__FILE__, array('PressControl', 'firstRun'));
register_activation_hook(__FILE__, array('PressControl', 'deactivate'));
add_action('admin_menu', array('PressControl', 'adminPanel'));
add_action('admin_menu', array('PressControl', 'secheduleJobs'));