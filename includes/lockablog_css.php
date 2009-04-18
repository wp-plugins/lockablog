<?php

function lockablog_loadcss()
{
	?>
    <link rel="stylesheet" href="<?php echo LOCKABLOG_PLUGINURL; ?>style/style.css" type="text/css" media="screen" />
    <?php
}
add_action('wp_head', 'lockablog_loadcss');

?>