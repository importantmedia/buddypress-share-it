<?php 
/**
Plugin Name: BuddyPress Share It
Plugin URI: http://buddypress.org/community/groups/buddypress-share-it
Description: Adds a share button to your BuddyPress site to let people share content on Twitter, Facebook and Google Buzz without having to leave the page. 
Version: 1.1.3
Author: modemlooper
Author URI: http://twitter.com/modemlooper
License:GPL2
**/

function bp_share_it_init() {
	require( dirname( __FILE__ ) . '/bp-share-it.php' );
}
add_action( 'bp_include', 'bp_share_it_init' );

?>