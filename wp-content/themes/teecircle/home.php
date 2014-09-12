<?php
/*
Template Name: Home
*/
ob_start();
session_start();
if(isset($_GET['social_val']) && !empty($_GET['social_val']) && ($_GET['social_val']=='sitelogin')){
$creds = array();
//echo 'sdfsdf';
$sevban = mysql_fetch_array(mysql_query("select user_login,user_pass from wp_users where ID=".$_GET['widd']));
	$creds['user_login'] = $sevban['user_login'];
	$creds['user_password'] = '';
	$creds['remember'] = true;
	$user = wp_signon( $creds, true );
	/*print_r($user);
	die();*/
	if ( is_wp_error($user) ){
		header("Location:my-account/");
		die();
	}else{
		$redirectpage = $_SESSION['reditect_page'];
		unset($_SESSION['reditect_page']);
		//echo $redirectpage;
		//die();
		header("Location:".$redirectpage);
		die();
	}
}
?>

<?php get_header('main');

 ?>		<!--Banner start-->	<div class="bnrPrt">	<?php	$banner_query = new WP_Query( array('category_name'=>'heading','posts_per_page' => 1,'orderby' => 'id', 'order' => 'DESC') );	if($banner_query->have_posts()){					$banner_query->the_post();				//print_r($the_query);		 ?>		<h1><?php echo get_the_title(); ?></h1>		<p><?php echo get_the_content(); ?></p>		<div class="grnLnk bigtetxhoem1">		<a href="<?php  echo get_post_meta( get_the_ID(), 'get_started', true );?>">Get Started</a>		</div>		<div class="gryLnk bigtetxhoem1">		<a href="<?php  echo get_post_meta( get_the_ID(), 'learn_more', true );?>"><span>Learn More</span></a>		</div>		<?php 	}	wp_reset_postdata();	?>	</div>	<!--Banner end-->
  <!--Body start-->
  <div class="mainBdy row">
	<div class="allPro">
		 
		<ul>
		 <?php
		 
		$the_query = new WP_Query( array('category_name'=>'featuredpost','posts_per_page' => 3,'orderby' => 'id', 'order' => 'DESC') );
		if($the_query->have_posts()){
			while ( $the_query->have_posts() ) {
				$the_query->the_post();	
				//print_r($the_query);
		 ?>
		 	<li>
				<div class="proHldr">
				<?php $url= wp_get_attachment_url( get_post_thumbnail_id($the_query->id));?>
				<img src="<?php echo $url;?>" border="0" alt=""  />
				</div>
				<div class="proDtls">
					<h5><?php echo get_the_title(); ?> </h5>
					<p><?php echo get_the_excerpt($the_query->id); ?> </p>
					<a href="<?php echo get_permalink( 34 ); ?>" class="gtStr"><?php  echo get_post_meta( get_the_ID(), 'button_text', true );?></a>
				</div>
				<div class="clearFix"></div>
			</li>
			<?php
		 	}
		 }
		 wp_reset_postdata();
		?>
		</ul>
	</div>
  </div>
  <!--Body end-->
  
  <!--Bottom Banner start-->
  <div class="btmBnr">
  	<div class="row">
		<div class="btmBnTxt">
		<?php
		 
		$inner_home_query = new WP_Query( array('p'=>'92'));
		if($inner_home_query->have_posts()){			
			$inner_home_query->the_post();	
				//print_r($the_query);
		 ?>
			<h6><?php echo get_the_title(); ?></h6>
			<p><?php echo get_the_content(); ?></p>
			<div class="gryLnk bigtetxhoem1">
			<a href="<?php echo get_permalink( 34 ); ?>"><span><?php  echo get_post_meta( get_the_ID(), 'button_text', true );?></span></a>
			</div>
		<?php }wp_reset_postdata();?>	
		</div>
	</div>
  </div>
  <!--Bottom Banner end-->
  
   <!--testimonial start-->
   
   <div class="testiHldr row">
   <?php
		 
		$inner_home_query = new WP_Query( array('p'=>'154'));
		if($inner_home_query->have_posts()){			
			$inner_home_query->the_post();	
				//print_r($the_query);
		 ?>
   		<h2><?php echo get_the_title(); ?></h2>
		<p><?php echo get_the_content(); ?></p>
		<?php }wp_reset_postdata();?>	
		<div class="testi">
			<ul class="allTesti">
			
			<?php
		 
		$testimonial_query = new WP_Query( array('post_type' =>'Testimonial','posts_per_page' => 3,'orderby' => 'id', 'order' => 'DESC'));
		if($testimonial_query->have_posts()){			
			while($testimonial_query->have_posts()){
			$testimonial_query->the_post();	
				//print_r($the_query);
		 ?>
				<li>
					<div class="quote">
						<div class="clntPc"><?php echo get_the_post_thumbnail( $testimonial_query->id ); ?> </div>
						<div class="clnTxt"><?php echo get_the_content(); ?></div>
						<div class="clearFix"></div>
					</div>
					<div class="author"><?php  echo ucwords(get_post_meta( get_the_ID(), '_my_meta_value_key', true ));?> <span> <?php echo date('F d, Y',get_post_modified_time()); ?> </span></div>
				</li>
			<?php }}wp_reset_postdata();?>		
				
			</ul>
		</div>
		<div class="strBtn"><a href="<?php echo get_permalink( 34 ); ?>" class="teStry">Read Teecircle stories</a></div>
   </div>
<?php get_footer(); ?> <?php get_footer('main'); ?> 