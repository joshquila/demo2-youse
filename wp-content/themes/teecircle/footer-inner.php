 <!--Footer start-->
  <div class="footer row">
  	<div class="ftrLft">
	<?php
		 
		$footer_about_query = new WP_Query( 'page_id=70');
		if($footer_about_query->have_posts()){			
			$footer_about_query->the_post();	
				//print_r($the_query);
		 ?>
		<div class="titl"><?php  echo get_post_meta( get_the_ID(), 'footerheading', true );?></div>
		<div class="cntnt"><?php  echo get_post_meta( get_the_ID(), 'footertext', true );?></div>
		<div class="cpyrht">
			<ul class="cpyLnk">
				<li><?php  echo get_post_meta( get_the_ID(), 'copyright', true );?></li>
				<li><a href="<?php echo get_permalink( 167 ); ?>">Privacy Policy</a></li>
				<li><a href="<?php echo get_permalink( 169 ); ?>">Terms of Service</a></li>
			</ul>
		</div>
		<?php }wp_reset_postdata();?>
	</div>
	<div class="ftrRht">
		<ul class="othrLnk">
			<li>
				<div class="titl"><span>Learn more links</span></div>
				<ul class="ftrLnk">
					<li><a href="<?php echo get_permalink( 70 ); ?>">About us</a></li>
					<li><a href="<?php echo get_permalink( 161 ); ?>">Custom t-shirts</a></li>
					<li><a href="<?php echo get_permalink( 163 ); ?>">FAQ</a></li>					
					<li><a href="<?php echo get_permalink( 165 ); ?>">Contact us</a></li>
				</ul>
			</li>
			<li>
				<div class="titl"><span>Your account links</span></div>
				<ul class="ftrLnk">
					<li>					
					 <?php if ( is_user_logged_in() ) {?>
					<a href="<?php echo site_url();?>/my-account/logout/">Log Out</a>
					<?php }else{?>	
					<a href="<?php echo site_url();?>/my-account/">Log In</a>
					<?php }?>	
					</li>
					<li><a href="<?php echo site_url();?>/my-account">Your Account</a></li>
				</ul>
			</li>
			<li>
				<div class="titl"><span>Get in touch</span></div>
				<ul class="socLnk">
				<?php
		 
		$footer_about_query = new WP_Query( array('p'=>'156'));
		if($footer_about_query->have_posts()){			
			$footer_about_query->the_post();	
				//print_r($the_query);
		 ?>
					<li><a href="<?php  echo get_post_meta( get_the_ID(), 'twitter', true );?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon1.jpg" alt="" border="0" /></a></li>					
					<li><a href="<?php  echo get_post_meta( get_the_ID(), 'facebook', true );?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon3.jpg" alt="" border="0" /></a></li>
					<li><a href="<?php  echo get_post_meta( get_the_ID(), 'googleplus', true );?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon4.jpg" alt="" border="0" /></a></li>
					<li><a href="<?php  echo get_post_meta( get_the_ID(), 'linkedin', true );?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icon5.jpg" alt="" border="0" /></a></li>
	<?php }wp_reset_postdata();?>				
				</ul>
			</li>
			<div class="clearFix"></div>
		</ul>
	</div>
	<div class="clearFix"></div>
  </div>
  <!--Footer end-->
  <?php wp_footer(); ?>
</div>
</body>
</html>