   <!--Footer top start-->
  <div class="campn">
  	<div class="row">
	<?php
		 
		$inner_home_query = new WP_Query( array('p'=>'94'));
		if($inner_home_query->have_posts()){			
			$inner_home_query->the_post();	
				//print_r($the_query);
		 ?>
		<h3><?php echo get_the_title(); ?></h3>
		<p><?php echo get_the_content(); ?></p>
		<div class="camBtn">
		<div class="grnLnk bigtetxhoem"><a href="<?php echo site_url();?>/design/"><?php  echo get_post_meta( get_the_ID(), 'button_text', true );?></a></div></<div>
		<?php }wp_reset_postdata();?>	
	</div>
  </div>
  <!--Footer top end-->
   
   <!--Footer start-->
 
<div class="wholefooter">
	<div class="wholefooter1">	
		<?php 
				
				echo get_sidebar('tc-footer-widget-area1');

				?>
		
		<div class="footertitle">
			<span>TeeCircle</span><br/><br/>
			In vitae sapien quis nisi laoreet imperdiet dapibus in tortor. Quisque dictum nisi leo, ac commodo ante convallis non
		</div>
				
				
		<div class="footertitle">
			<span>Learn more links</span>
				<br><br>
					<a href="<?php echo get_permalink( 70 ); ?>">About us</a><br>
					<a href="<?php echo get_permalink( 161 ); ?>">Custom t-shirts</a><br>
					<a href="<?php echo get_permalink( 163 ); ?>">FAQ</a></li><br>					
					<a href="<?php echo get_permalink( 165 ); ?>">Contact us</a>
		</div>
		
		
		<div class="footertitle">
		<span>Your account links</span>
				<br><br>
					<?php if ( is_user_logged_in() ) {?>
					<a href="<?php echo site_url();?>/my-account/logout/">Log Out</a>
					<?php }else{?>	
					<a href="<?php echo site_url();?>/my-account/">Log In</a>
					<?php }?><br>

					<a href="<?php echo site_url();?>/my-account">Your Account</a>
		</div>
		
		
		<div class="footertitle">
		<span>Get in touch</span>
				<br><br>		
				<?php
		 
		$footer_about_query = new WP_Query( array('p'=>'156'));
		if($footer_about_query->have_posts()){			
			$footer_about_query->the_post();	
				//print_r($the_query);
		 ?>
					<a href="<?php  echo get_post_meta( get_the_ID(), 'twitter', true );?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="" border="0" width="26px"/></a>				
					<a href="<?php  echo get_post_meta( get_the_ID(), 'facebook', true );?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="" border="0" width="26px" /></a>
					<a href="<?php  echo get_post_meta( get_the_ID(), 'googleplus', true );?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/g+.png" alt="" border="0" width="26px" /></a>
					<a href="<?php  echo get_post_meta( get_the_ID(), 'linkedin', true );?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt="" border="0" width="26px" /></a>
	<?php }wp_reset_postdata();?>			
		</div>
	</div>
</div>
  
	
  <!--Footer end-->
  
</div>
</body>
</html>