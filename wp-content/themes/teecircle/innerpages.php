<?php
/*
Template Name: Innerpages Simple
*/
?>
<?php get_header('main');?>      
      <!--Body start-->
      <div class="mainBdy row"> 
        
     <?php 
        <!--about Right Start-->
        <div class="abtRht">
         
		 <h1><?php echo get_the_title();?></h1>
		<?php the_content();?>
        </div>
        <!--about Right end-->
        
        <div class="clearFix"></div>
      </div>
      <!--Body end--> 
      
      
	<?php  