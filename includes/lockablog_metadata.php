<?php

function lockablog_add_model_meta()
{
	add_meta_box( 'lockablog_metabox', __( 'Lock a blog', LOCKABLOG_TRANSLATIONDOMAIN), 'lockablog_metabox', 'post', 'normal', 'high' );
	
}

function lockablog_metabox()
{
	global $post;
	
	// Use nonce for verification ... ONLY USE ONCE!
	echo '<input type="hidden" name="lockablogmeta_noncename" id="lockablogmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	
	$value = get_post_meta($post->ID, 'minage', true);
	$promptext = get_post_meta($post->ID, 'promptext', true);
	
	if (empty($promptext)) 
	 $promptext = LOCKABLOG_DEFAULT_MESSAGE;
	 
	?>
    <label for="promptext"><?php echo __("Use this text to prompt the readers:", LOCKABLOG_TRANSLATIONDOMAIN ); ?></label><br />
    <textarea rows="5" cols="35" name="promptext" id="promptext"><?php echo $promptext; ?></textarea><br />
    
    <label for="minage"><?php echo __("Minimal age to read this post:", LOCKABLOG_TRANSLATIONDOMAIN ); ?></label><br />
    <select name="minage" id="minage">
      <option value=""  ><?php echo __("Dont block this content", LOCKABLOG_TRANSLATIONDOMAIN ); ?></option>
    <?php 
	 for($i = 1; $i < 150; $i++)
	 {
		 $selected = '';
		 if ($i == $value)
		  $selected = 'selected="selected"';
		?>
         <option value="<?php echo $i; ?>" <?php echo $selected; ?> ><?php echo $i; ?></option>
         <?php 
		 
	 }
	?>
    </select>
    
    <?php
}

function lockablog_save_model_meta($post_id, $post)
{
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['lockablogmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post->ID ))
		return $post->ID;
	} else {
		if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	}

	$mydata['minage']    = $_POST['minage'];
	$mydata['promptext'] = $_POST['promptext'];
	
	foreach ($mydata as $key => $value) { //Let's cycle through the $mydata array!
		if( $post->post_type == 'revision' ) return; //don't store custom data twice
		$value = implode(',', (array)$value); //if $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { //if the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { //if the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); //delete if blank
	}
}

/* Use the admin_menu action to define the custom boxes */
add_action('admin_menu', 'lockablog_add_model_meta');
add_action('save_post',  'lockablog_save_model_meta', 1, 2);
?>