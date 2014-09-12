<?php
/*
Template Name: FAQ Temp
*/
?>
<style type="text/css">
.cont{ display:none;}
</style>

<?php get_header('inner');?>     
<script type="text/javascript">
$(function(){

$('.accord h3').click(function(){
var hid=$(this).attr('id');
var id=hid.replace("h",'div'); 

$('#'+id).slideToggle(2000);
});
});
</script>
      <!--Body start-->
      <div class="mainBdy row"> 
        
     <?php get_sidebar('innermain'); wp_reset_query();?>
	 
        <!--about Right Start-->
        <div class="abtRht">
         
		 <h1><?php echo get_post_meta($post->ID,'title',true);?></h1>
		<?php the_content(); wp_reset_query();
		
				$myterms = get_terms('faq_category', 'orderby=none&hide_empty'); 
				$c=0;
				foreach ($myterms as $k=>$term) { 
				echo  '<h2>'.$term->name.'</h2>';
				query_posts(array(
				'post_type' => 'faq',
				'taxonomy' => 'faq_category',
				'term' => $term->slug,
				'showposts' => -1
				) );
				if(have_posts()){			
				?>
				<div class="accord" id="accord<?php echo $k;?>">
				<?php while ( have_posts() ) { the_post();$c++;				
				echo '<h3 id="h'.$c.'">'.get_the_title().'<h3>';
				echo '<div class="cont" id="div'.$c.'">';
				the_content();
				echo '</div>';
				}?>
				</div>
				<?php }}wp_reset_query();?>
		
		
        </div>
        <!--about Right end-->
        
        <div class="clearFix"></div>
      </div>
      <!--Body end--> 
      
      
<?php  get_footer('inner');?>