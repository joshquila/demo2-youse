<?php
/*
Template Name: Inner
*/
?>
<?php get_header('main'); wp_reset_query(); ?>
 <div class="mainBdy row"> 
 
 <div class="testiHldr row">
 
 <h1><?php echo get_the_title();?></h1><br />
 <p><?php echo $post->ID.get_the_content();?></p></div>
 </div>
 <div class="clearfix"></div>
<?php  wp_reset_query();

get_footer('main'); ?>