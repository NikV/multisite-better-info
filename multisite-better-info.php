<?php
/**
 * Plugin Name: Multisite Info Dashboard Widget
 * Description: Multisite Info Dashboard Widget
 * Author: Nikhil Vimal
 * Author URI: http://nik.techvoltz.com
 * Version: 1.0
 * Plugin URI:
 * License: GNU GPLv2+
 */

class Multisite_Info_Dash_Widget {

	//Add ALL the actions
	public function __construct() {
		add_action( 'wp_network_dashboard_setup', array( $this, 'ms_info_dash' ));
	}

	//Build the Dashboard Widget
	public function ms_info_dash() {
		wp_add_dashboard_widget(
			'ms_info_widget',         // Widget slug.
			'Multisite Info',         // Title.
			array( $this, 'ms_info_callback' ) // Display function.
		);
	}

	/**
	 * The Dashboard Widget callback function
	 *
	 * @since 1.0
	 */
	public function ms_info_callback() {

		//echo $_SERVER['REMOTE_PORT'];
		echo 'User Agent: ' . $_SERVER['HTTP_USER_AGENT'] . "</p>";
		echo 'Server Name: ' . $_SERVER['SERVER_NAME'] . '</p>';
		echo "Server Software: ".$_SERVER['SERVER_SOFTWARE'] . "</p>";
		$current_date = 'Server time and date: ' . date('H:i:s, m/d/Y') . "\n\n";
		echo "$current_date </p>";
		echo 'Number of Sites in the Network: '. get_blog_count() . '</p>';
		echo 'Current Version of WordPress: ' . get_bloginfo('version') . '</p>';
		echo 'Host Name: ' . gethostname() . '</p>';
		switch_to_blog(1);
		$site_title = get_bloginfo( 'name' );
		$site_url = network_site_url( '/' );
		$site_description = get_bloginfo( 'description' );
		restore_current_blog();
		echo 'The Network Home URL is: ' . $site_url . '</p>';
		echo 'The Network Home Name is: ' . $site_title . '</p>';
		echo 'The Network Home Tagline is: ' . $site_description . '</p>';
		echo 'Page loaded in ' . date("s", $_SERVER['REQUEST_TIME_FLOAT']) . ' Seconds</p>';
		echo get_num_queries() .' queries in '.  timer_stop(1) .' seconds.';
	}
}
//Return Class
return new Multisite_Info_Dash_Widget();