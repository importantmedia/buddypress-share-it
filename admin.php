<?php

add_action('admin_menu', 'my_plugin_menu');
add_action( is_multisite() ? 'network_admin_menu' : 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	add_submenu_page( 'bp-general-settings', 'Share It', 'BuddyPress Share it', 'manage_options', 'bp-share-it', 'my_plugin_options');
	
	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
	//register our settings
	register_setting( 'my_plugin_options', 'twitter' );
	register_setting( 'my_plugin_options', 'buzz' );
	register_setting( 'my_plugin_options', 'facebook' );
	register_setting( 'my_plugin_options', 'digg' );
	register_setting( 'my_plugin_options', 'email' );
	register_setting( 'my_plugin_options', 'blog' );
	register_setting( 'my_plugin_options', 'activity' );
	register_setting( 'my_plugin_options', 'forum' );
	register_setting( 'my_plugin_options', 'groups' );
}

function my_plugin_options() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
				
	}
	
?>

			<?php if ( !empty( $_GET['updated'] ) ) : ?>
				<div id="message" class="updated">
					<p><strong><?php _e('settings saved.', 'bpsi' ); ?></strong></p>
				</div>
			<?php endif; ?>



<div class="wrap">
<h2><?php _e('BuddyPress Share it Settings', 'bpsi') ?></h2>

<p><?php _e('Please check sharing buttons to show.', 'bpsi') ?></p>

<form method="post" action="<?php bloginfo('wpurl'); ?>/wp-admin/options.php">
<?php wp_nonce_field('update-options'); ?>

<table class="form-table">
<tr valign="top">
<th scope="row">Twitter</th>
<td><input type="checkbox" name="twitter" value="1" <?php if (get_option('twitter')==1) echo 'checked="checked"'; ?>/></td>
</tr>

<tr valign="top">
<th scope="row">Buzz</th>
<td><input type="checkbox" name="buzz" value="1" <?php if (get_option('buzz')==1) echo 'checked="checked"'; ?>/></td>
</tr>

<tr valign="top">
<th scope="row">Facebook</th>
<td><input type="checkbox" name="facebook" value="1" <?php if (get_option('facebook')==1) echo 'checked="checked"'; ?>/></td>
</tr>

<tr valign="top">
<th scope="row">Digg</th>
<td><input type="checkbox" name="digg" value="1" <?php if (get_option('digg')==1) echo 'checked="checked"'; ?>/></td>
</tr>

<tr valign="top">
<th scope="row">Email</th>
<td><input type="checkbox" name="email" value="1" <?php if (get_option('email')==1) echo 'checked="checked"'; ?>/></td>
</tr>
</table>

<hr></hr>
<p><?php _e('Please check content to share.', 'bpsi') ?></p>

<table class="form-table">

<tr valign="top">
<th scope="row">Activity</th>
<td><input type="checkbox" name="activity" value="1" <?php if (get_option('activity')==1) echo 'checked="checked"'; ?>/></td>
</tr>

<tr valign="top">
<th scope="row">Blog</th>
<td><input type="checkbox" name="blog" value="1" <?php if (get_option('blog')==1) echo 'checked="checked"'; ?>/></td>
</tr>

<tr valign="top">
<th scope="row">Forums</th>
<td><input type="checkbox" name="forum" value="1" <?php if (get_option('forum')==1) echo 'checked="checked"'; ?>/></td>
</tr>

<tr valign="top">
<th scope="row">Groups</th>
<td><input type="checkbox" name="group" value="1" <?php if (get_option('group')==1) echo 'checked="checked"'; ?>/></td>
</tr>

</table>



<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="twitter,buzz,facebook,digg,email,activity,blog,forum,group" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>

<?php
}
?>