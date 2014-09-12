<script>
	var j = jQuery.noConflict();
</script><?php
	global $current_user; get_currentuserinfo();
	if($current_user->ID==1){
	$siteurl  = $wpdb->get_results("SELECT option_value from wp_options where option_id=1 and option_name='siteurl'");
	//print_r($siteurl);
	//echo '<script>window.location="'.$siteurl[0]->option_value.'/teewp-admincircle/"</script>';
	//die();
}
			//print_r($current_user); ?>
			<!--<h1>Hi <?php echo $current_user->user_email; ?></h1>-->
		  <div class="urdhnam" onclick="j('#openuserdrp').toggle();"><?php echo $current_user->user_email; ?><span class="srtwom"></span></div>
		  <ul style="display: none;" id="openuserdrp">
			<li class="camp"><a href="<?php echo get_permalink( 10 ); ?>">My Campaigns</a></li>
			<li class="draft"><a href="<?php echo get_permalink( 10 ); ?>?p=campaignsdraft">My Drafts</a></li>
			<li class="paid"><a href="<?php echo get_permalink( 10 ); ?>?p=get_paid">Get Paid</a></li>
			<li class="accset"><a href="<?php echo get_permalink( 10 ); ?>?p=account">Account Settings</a></li>
			<li>
            <input name="" type="button" value="Log Out" onClick="window.location.href='<?php echo site_url().'/my-account/logout/'; ?>'" />  
			</li>
			</ul> 