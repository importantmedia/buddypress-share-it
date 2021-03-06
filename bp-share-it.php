<?php

define ( 'BP_SHARE_IT_VERSION', '1.1.3' );

/*
 * Make sure BuddyPress is loaded before we do anything.
 */
if ( !function_exists( 'bp_core_install' ) ) {
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'buddypress/bp-loader.php' ) ) {
		require_once ( WP_PLUGIN_DIR . '/buddypress/bp-loader.php' );
	} else {
		add_action( 'admin_notices', 'bp_share_it_install_buddypress_notice' );
		return;
	}
}


function bp_share_it_install_buddypress_notice() {
	echo '<div id="message" class="error fade bp-tweet-upgraded"><p style="line-height: 150%">';
	_e('<strong>BuddyPress Share It</strong></a> requires the BuddyPress plugin to work. Please <a href="http://buddypress.org/download">install BuddyPress</a> first, or <a href="plugins.php">deactivate BuddyPress Share It button</a>.');
	echo '</p></div>';
}



/*
 * admin links
 */
require ( dirname( __FILE__ ) . '/admin.php' );


/**
 * bp_share_it_button_activity_filter()
 *
 * Adds share it button to activity stream.
 *
 */
function bp_share_it_button_activity_filter() {

  $activitytype = bp_get_activity_type();
	$activitylink = bp_get_activity_thread_permalink();
	$activitytitle = bp_get_activity_feed_item_title();
	$pluginpath = plugins_url();
	$sharetrans = __('Share', 'bpsi');
	
	if (get_option('twitter')==1) { $shareittwitter = '<li class="bpsi"><a class="new-window" href="http://twitter.com/share?text='.$activitytitle.'&url=' . $activitylink . '" rel="facebox"><img src="' .$pluginpath . '/buddypress-share-it/img/tweet.png"></a></li>';
	} else {
	}
	
	if (get_option('buzz')==1) { $shareitbuzz = '<li class="bpsi"><a class="new-window" href="http://www.google.com/buzz/post?message='.$activitytitle.'&url=' . $activitylink . '" rel="facebox"><img src="' .$pluginpath . '/buddypress-share-it/img/buzz.png"></a></li>';
	} else {
	}
  
  	if (get_option('facebook')==1) { $shareitfacebook = '<li class="bpsi"><a class="new-window" href="http://www.facebook.com/sharer.php?t='.$activitytitle.'&u=' . $activitylink . '" rel="facebox"><img src="' .$pluginpath . '/buddypress-share-it/img/share.png"></a></li>';
  	} else {
  	}
  	
  	if (get_option('digg')==1) { $shareitdigg = '<li class="bpsi"><a class="new-window-digg" href="http://digg.com/submit?url=' . $activitylink . '" rel="facebox"><img src="' .$pluginpath . '/buddypress-share-it/img/digg.png"></a></li>';
  	} else {
  	}
  	
  	if (get_option('email')==1) { $shareitemail = '<li class="bpsi"><a href="mailto:?body='.$activitytitle .' ' . $activitylink . '"><img src="' .$pluginpath . '/buddypress-share-it/img/email.png"></a></li>';
  	} else {
  	}
  
	
	if (get_option('activity')==1) { $shareit = '<span class="bp-share-it-button"> · <a class="buddypress-share-button">'.$sharetrans.'</a></span>
	
		
	<div class="share-buttons ' . $activitytype . '">
		<ul>
			' . $shareittwitter . '
			' . $shareitbuzz . '
			' . $shareitfacebook . '
			' . $shareitdigg . '
			' . $shareitemail . '
			
		</ul>
	
	</div>
		
	';
	
	echo $shareit;
	} else {
	}
}
add_action('bp_activity_entry_meta', 'bp_share_it_button_activity_filter', 999);

/**
 * bp_share_button_topic_filter()
 *
 * Adds share button to forum topics.
 *
 */
function bp_share_it_button_topic_filter() {
	$topiclink = bp_get_the_topic_permalink();
	$topictitle = bp_get_the_topic_title();
	$pluginpath = plugins_url();
	$sharetrans = __('Share', 'bpsi');
	
	if (get_option('twitter')==1) { $shareittwitter = '<li class="bpsi"><a class="new-window" href="http://twitter.com/share?url=' . $topiclink . '&text='.$topictitle.'"><img src="' .$pluginpath . '/buddypress-share-it/img/tweet.png"></a></li>';
	} else {
	}
	
	if (get_option('buzz')==1) { $shareitbuzz = '<li class="bpsi"><a class="new-window" href="http://www.google.com/buzz/post?message='.$topictitle.'&url=' . $topiclink . '"><img src="' .$pluginpath . '/buddypress-share-it/img/buzz.png"></a></li>';
	} else {
	}
  
  	if (get_option('facebook')==1) { $shareitfacebook = '<li class="bpsi"><a class="new-window" href="http://www.facebook.com/sharer.php?u=' . $topiclink . '&t='.$topictitle.'"><img src="' .$pluginpath . '/buddypress-share-it/img/share.png"></a></li>';
	} else {
	}
  	
  	if (get_option('digg')==1) { $shareitdigg = '<li class="bpsi"><a class="new-window-digg" href="http://digg.com/submit?url=' . $topiclink . '"><img src="' .$pluginpath . '/buddypress-share-it/img/digg.png"></a></li>';
	} else {
	}
  	
  	if (get_option('email')==1) { $shareitemail = '<li class="bpsi"><a href="mailto:?subject=' . $topictitle . '&body=' . $topiclink . '"><img src="' .$pluginpath . '/buddypress-share-it/img/email.png"></a></li>';
	} else {
	}
  
	
	if (get_option('forum')==1) { $shareit = '<div class="bp-share-it-button-forum"><a class="bp-share-button-forum button">'.$sharetrans.'</a></div>
	
		
	<div class="share-buttons">
		<ul>
			' . $shareittwitter . '
			' . $shareitbuzz . '
			' . $shareitfacebook . '
			' . $shareitdigg . '
			' . $shareitemail . '
			
		</ul>
	
	</div>
		
	';
	
	echo $shareit;
	} else {
	}

	
}
add_action('bp_before_group_forum_topic_posts', 'bp_share_it_button_topic_filter');


/**
 * bp_share_it_button_group_filter()
 *
 * Adds share it button to groups.
 *
 */
function bp_share_it_button_group_filter() {
	$grouplink =  bp_get_group_permalink();
	$groupname = bp_get_group_name();
	$pluginpath = plugins_url();
	$sharetrans = __('Share', 'bpsi');
	
	if (get_option('twitter')==1) { $shareittwitter = '<li class="bpsi"><a class="new-window" href="http://twitter.com/share?url=' . $grouplink . '&text='.$groupname.'"><img src="' .$pluginpath . '/buddypress-share-it/img/tweet.png"></a></li>';
	} else {
	}
	
	if (get_option('buzz')==1) { $shareitbuzz = '<li class="bpsi"><a class="new-window" href="http://www.google.com/buzz/post?message='.$groupname.'&url=' . $grouplink . '"><img src="' .$pluginpath . '/buddypress-share-it/img/buzz.png"></a></li>';
	} else {
	}
  
  	if (get_option('facebook')==1) { $shareitfacebook = '<li class="bpsi"><a class="new-window" href="http://www.facebook.com/sharer.php?u=' . $grouplink . '&t='.$groupname.'"><img src="' .$pluginpath . '/buddypress-share-it/img/share.png"></a></li>';
	} else {
	}
  	
  	if (get_option('digg')==1) { $shareitdigg = '<li class="bpsi"><a class="new-window-digg" href="http://digg.com/submit?url=' . $grouplink . '"><img src="' .$pluginpath . '/buddypress-share-it/img/digg.png"></a></li>';
	} else {
	}
  	
  	if (get_option('email')==1) { $shareitemail = '<li class="bpsi"><a href="mailto:?subject=' . $groupname . '&body=' . $grouplink . '"><img src="' .$pluginpath . '/buddypress-share-it/img/email.png"></a></li>';
	} else {
	}
	
	if (get_option('group')==1) { $shareit = '<div class="bp-share-it-button-group generic-button "><a class="leave-group">'.$sharetrans.'</a></div>
	
		
	<div class="share-buttons group">
		<ul>
			' . $shareittwitter . '
			' . $shareitbuzz . '
			' . $shareitfacebook . '
			' . $shareitdigg . '
			' . $shareitemail . '
			
		</ul>
	
	</div>
		
	';
	
	echo $shareit;
	} else {
	}	
}
add_action('bp_group_header_meta', 'bp_share_it_button_group_filter', 999);

/**
 * bp_tweet_button_blog_filter()
 *
 * Adds tweet button to blog posts.
 *
 */
function bp_share_it_button_blog_filter() {
	
	$postlink =  get_permalink();
	$posttitle = get_the_title();
	$pluginpath = plugins_url();
	$sharetrans = __('Share', 'bpsi');
	
	if (get_option('twitter')==1) { $shareittwitter = '<li class="bpsi"><a class="new-window" href="http://twitter.com/share?url=' . $postlink . '&text='.$posttitle.'"><img src="' .$pluginpath . '/buddypress-share-it/img/tweet.png"></a></li>';
	} else {
	}
	
	if (get_option('buzz')==1) { $shareitbuzz = '<li class="bpsi"><a class="new-window" href="http://www.google.com/buzz/post?message='.$posttitle.'&url=' . $postlink . '"><img src="' .$pluginpath . '/buddypress-share-it/img/buzz.png"></a></li>';
	} else {
	}
  
  	if (get_option('facebook')==1) { $shareitfacebook = '<li class="bpsi"><a class="new-window" href="http://www.facebook.com/sharer.php?u=' . $postlink . '&t='.$posttitle.'"><img src="' .$pluginpath . '/buddypress-share-it/img/share.png"></a></li>';
	} else {
	}
  	
  	if (get_option('digg')==1) { $shareitdigg = '<li class="bpsi"><a class="new-window-digg" href="http://digg.com/submit?url=' . $postlink . '"><img src="' .$pluginpath . '/buddypress-share-it/img/digg.png"></a></li>';
	} else {
	}
  	
  	if (get_option('email')==1) { $shareitemail = '<li class="bpsi"><a href="mailto:?subject=' . $posttitle . '&body=' . $postlink . '"><img src="' .$pluginpath . '/buddypress-share-it/img/email.png"></a></li>';
	} else {
	}
  	
	if (get_option('blog')==1) { $shareit = '<div class="bp-share-it-button"><a class="bp-share-button-blog button">'.$sharetrans.'</a></div>
	
		
	<div class="share-buttons blog">
		<ul>
			' . $shareittwitter . '
			' . $shareitbuzz . '
			' . $shareitfacebook . '
			' . $shareitdigg . '
			' . $shareitemail . '
			
		</ul>
	
	</div>
		
	';
	
	echo $shareit;
	} else {
	}
	
}
add_action('bp_before_blog_single_post', 'bp_share_it_button_blog_filter', 999);

/**
 * bp_share_it_scripts()
 *
 * Includes the Javascript and css.
 *
 */
function bp_share_it_scripts() {
  wp_enqueue_script( "buddypress-share-it", path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )."/bp-share-it.js"), array( 'jquery' ) );
}
add_action('wp_print_scripts', 'bp_share_it_scripts');


function bp_share_it_button_insert_head() {
?>
<style type="text/css">

</style>
<link href="<?php bloginfo('wpurl'); ?>/wp-content/plugins/buddypress-share-it/style.css" media="screen" rel="stylesheet" type="text/css"/>
<?php	
}
add_action('wp_head', 'bp_share_it_button_insert_head');
?>