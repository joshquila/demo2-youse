<script> var j = jQuery.noConflict(); </script><?php
	global $current_user; 	get_currentuserinfo();
	if($current_user->ID==1){
		$siteurl  = $wpdb->get_results("SELECT option_value from wp_options where option_id=1 and option_name='siteurl'");		$page = get_page_by_title( 'My account' );		$page_id = $page->ID;
	}	?>	
	<div class="urdhnam" onclick="j('#openuserdrp').toggle();"><?php echo $current_user->user_email; ?><span class="srtwom"></span></div>	<ul style="display: none;" id="openuserdrp">
		<li class="camp"><a href="<?php echo get_permalink($page_id); ?>">My Campaigns</a></li>		<li class="draft"><a href="<?php echo get_permalink($page_id); ?>?p=campaignsdraft">My Drafts</a></li>		<li class="paid"><a href="<?php echo get_permalink($page_id); ?>?p=get_paid">Get Paid</a></li>		<li class="accset"><a href="<?php echo get_permalink($page_id); ?>?p=account">Account Settings</a></li>		<li>
			<a class="menu-logout" href="<?php echo site_url().'/my-account/logout/'; ?>">Log out</a>  
		</li>	</ul>