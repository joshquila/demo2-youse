<?php
/*
Template Name: Preview Template
*/
?>
<?php //bloginfo('url'); ?>
<?php get_header('inner'); ?>
<?php
	$product_categories = get_terms( 'product_cat');
	//print_r($product_categories);
	?>
<div class="mainBdy row"> 
	    <div class="tpLnk">This is a preview of your campaign. <a href="<?php echo get_permalink( 234 ); ?>">Click here to go back and continue launching your campaign &raquo;</a></div>
        
			<div class="titlBr">
				<div class="mnTitl">Your New Teespring Campaign</div>
				<div class="rhtLnk">
					<ul class="solIcn">
						<li><a href="javascript:void(0)"><img src="<?php echo get_template_directory_uri(); ?>/images/flike.jpg" alt="" border="0"></a></li>
						<li> <a href="http://www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.youtube.com%2F" data-pin-do="buttonPin" data-pin-config="above"><img src="http://assets.pinterest.com/images/pidgets/pin_it_button.png" /></a></li>
						<li><a href="javascript:void(0)"><img src="<?php echo get_template_directory_uri(); ?>/images/tweet.jpg" alt="" border="0"></a></li>
					</ul>
				</div>
				<div class="clearFix"></div>
			</div>
		
        <!--about Left Start-->
        <div class="prevLft">
          <img src="<?php echo get_template_directory_uri(); ?>/images/mygen.jpg" alt="" border="0">
		  <div class="lftpcMnu">
			  <ul>
				<li><a href="javascript:void(0)">front</a></li>
				<li>|</li>
				<li><a href="javascript:void(0)">back</a></li>
			  </ul>
			</div>
        </div>
        <!--about Left End--> 
        <!--about Right Start-->
        <div class="prevRht">
				 <h1>About this</h1>
				 <div class="cntnt">This is your example description. You will fill out your own content here. Mauris iaculis, dolor quis fermentum eleifend, mi sem mattis nisl, non semper ante nibh id nulla. Sed pulvinar, nunc in vestibulum eleifend, risus magna vehicula velit, nec viverra lorem sem non neque. Vivamus sit amet auctor felis.</div>
				 <div class="txtPrt">
					<p>Donec congue sollicitudin nibh sed semper. Mauris accumsan, metus et pulvinar lobortis, elit lectus mattis lacus, ac ultrices turpis tortor a mi. Curabitur ac dui elit, tristique iaculis diam. Sed quis orci eu eros faucibus vulputate. Donec at neque tortor.</p>
					<p>Duis tristique lorem et justo condimentum pharetra eleifend nulla aliquam.</p>
					<p><em>Screen printed on Hanes Tagless Tee. <a href="javascript:void(0)">Size info</a></em></p>
				 </div>
				<div class="byBkg">
					<p class="prcVal">$9</p>
					<p class="prCnt">50</p>
					<div class="byitBtn">Buy it!</div>
				</div>
				<div class="bxCnt">
					<h2>0 reserved towards goal of 50</h2>
					<p>The design will only print if we reach our goal! <a href="javascript:void(0)">Learn why</a>.</p>
					<div class="progress">
						<div class="bar" style="width:20%;"> </div>
					</div>
					<div class="toTm"><span></span>7 days and 0 hours left</div>
			   </div>
        </div>
        <!--about Right Start-->
        
        <div class="clearFix"></div>
      </div>
<?php get_footer('inner'); ?> 	  