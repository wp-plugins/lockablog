<?php
  
  function lockablog_the_content($content)
  {
	  global $post;
	  
	  if (lockablog_get_minage() && !lockablog_continueread())
	  {
		 
		  ob_start();
		  require LOCKABLOG_PAGESPATH.'/form.php';
		  $content = ob_get_contents();
		  ob_end_clean();
		  return $content;
	  } else
	  return $content;
  }
  add_filter('the_content', 'lockablog_the_content', 1, 900);
  
  
  function lockablog_continueread()
  {
	  global $post;
	  
	  $key     = sprintf('blockablog_%s', $post->ID);

	  if (isset($_COOKIE[$key]))
	  {
		  return ($_COOKIE[$key] >= lockablog_get_minage());
		  
	  }
	  return false;
  }
  
  function lockablog_detectagepost()
  {

	if (isset($_POST['postid']) && isset($_POST['lockablog_minage']) 	)
	{
		$postid   = $_POST['postid'];
		$thispost = get_post($postid);
		
	
		
		if ($_POST['lockablog_minage'] >= lockablog_get_minage($thispost))
		{

			$key = sprintf('blockablog_%s', $thispost->ID);	
			setcookie($key, $_POST['lockablog_minage']);
			
			wp_redirect($_SERVER['REQUEST_URI'], 301);
			exit;
		}	
	} 
  }
  add_action('wp', 'lockablog_detectagepost',1,1); /* Not We need to execute this before any content is shown */
?>