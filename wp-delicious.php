<?php
/*
Plugin Name: WPDelicious
Plugin URI: http://wpdelicio.us/add-ons/
Description: Plugin for sharing wordpress posts into WPDelicious.
Version: 1.2
Author: Mostafa Soufi
Author URI: http://iran98.org/category/wordpress/wpdelicious/
License: GPL2
*/
	load_plugin_textdomain('wpdelicious','wp-content/plugins/wp-delicious');
	add_filter("the_content", "wpdelicious");
	add_action("plugins_loaded", "wpdelicious_widget");

	function latest_wpdelicious() {
	echo "<h2 class='widgettitle'>".__('Latest Delicious', 'wpdelicious')."</h2>";
	echo "<iframe src='http://wpdelicio.us/last/' width='100%' height='250' frameborder='0'></iframe>"; }
	
	function wpdelicious_widget() {
	register_sidebar_widget(__('Latest posts in wpdelicious', 'wpdelicious'), 'latest_wpdelicious'); }

	function wpdelicious_title() {
	$posttitle = get_the_title();
	return str_replace(' ', "%20", $posttitle);
	}
	
	function wpdelicious_tags() {
	if ( get_the_tags() ) {
	$posttags = get_the_tags();
	foreach($posttags as $get_tag)
	return $get_tag->name . '';
	}}
	
	function wpdelicious($content) {
	if ( is_user_logged_in() )
	echo
	"<a href=http://wpdelicio.us/q/?"
	."t=".									wpdelicious_title()
	."&amp;tg=".							wpdelicious_tags()
	."&amp;u=".								get_permalink()
	."&amp;a=".								get_the_author()
	."&amp;e=".								get_the_author_meta('user_email')			
	.">".__('Sent To WPDelicio.us','wpdelicious')."</a>";
	return $content;
	}
?>