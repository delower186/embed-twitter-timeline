<?php
/*
Plugin Name: Embed Twitter Timeline
Plugin URI: https://delower.me/embed-twitter-timeline/
Description: Embed Twitter Timeline helps you easily embed and promote Twitter Profile by displaying timeline on your wordpres widget.
Version:1.0.0
Author: Delower
Author URI: https://delower.me
License: GPLv2 or later
Text Domain: embed-twitter-timeline
*/
/*
Embed Twitter Timeline is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

Embed Twitter Timeline is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Embed Twitter Timeline; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright (C) 2021  delower.

*/
/*
    @package embed-twitter-timeline
    ==============================
    Embed_Twitter_Timeline Class
    ==============================
*/
defined('ABSPATH') or die('Hey, What are you doing here? You Silly Man!');

//activate plugin
function activate_ett(){
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'activate_ett' );


//deactivate plugin
function deactivate_ett(){
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'deactivate_ett' );

// Check if class already exist
if ( !class_exists( 'Embed-Twitter-Timeline' ) ) {

    class Embed_Twitter_Timeline {
		
        public $pluginPath;
		public $pluginUrl;
		public $pluginName;

		/**
		* Embed_Twitter_Timeline Class Constructor
		*
		* Gets things started
		*/
		public function __construct( ) {
			$this->pluginPath 	= plugin_dir_path(__FILE__);
			$this->pluginUrl 	= plugin_dir_url(__FILE__);

            require_once($this->pluginPath .'classes/embed-twitter-timeline-widget.php');

            add_action('wp_enqueue_scripts',array($this,'enqueue'));
		}

        public function enqueue(){
            //wp_enqueue_style('style', $this->pluginUrl . 'assets/css/style.css');

            wp_enqueue_script('widget', $this->pluginUrl . 'assets/js/widgets.js');
        }
    }

    new Embed_Twitter_Timeline();
}