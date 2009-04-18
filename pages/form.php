<div class="lockablog_container">
     <div class="lockablog_image"></div>	
    <form id="lockablog_pageblock" action="" method="post">
    <div class="lockablog_message"><?php echo lockablog_get_promptmessage(); ?></div>
    <div class="lockablog_age"> </div>
     <select name="lockablog_minage" id="minage">
        <?php 
         for($i = 1; $i < 150; $i++)
         {
            ?>
             <option value="<?php echo $i; ?>"  ><?php echo $i; ?></option>
             <?php 
             
         }
        ?>
     </select>
     <div class="lockablog_submit">
       <input type="submit" value="<?php echo __("Submit your age", LOCKABLOG_TRANSLATIONDOMAIN ); ?>" />
       <input type="hidden" name="postid" value="<?php echo $post->ID; ?>" />
        <input type="hidden" name="lockablogpost_noncename_<?php echo $post->ID; ?>" id="lockablogpost_noncename_<?php echo $post->ID; ?>" value="<?php echo LOCKABLOG_NUONCETARGET  ?>" />
	 </div>
  </form>
</div>
<div class="lockablog_clear"></div>