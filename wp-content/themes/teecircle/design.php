<?php
/*
Template Name: Design
*/
ob_start();
session_start();
$_SESSION['reditect_page'] = 'design/';

?>
<input type="hidden" id="userlogintype" value="<?php if(is_user_logged_in()){echo 'loggedin';}else{echo 'log';}?>" />
<script>
	
		
	function getAverageRGB() {
		
		if(j('#dv_front').css('display')=='block'){
			chaim = checkunicolofront('dv_front');
		}
		if(j('#dv_back').css('display')=='block'){
			chaim = checkunicoloback('dv_back');
		}
		return false;	
	}
		
	function HexToRGB(Hex)
		{
			var Long = parseInt(Hex.replace(/^#/, ""), 16);
			return {
				R: (Long >>> 16) & 0xff,
				G: (Long >>> 8) & 0xff,
				B: Long & 0xff
			};
		}
	
	function componentToHex(c) {
   	 	var hex = c.toString(16);
    	return hex.length == 1 ? "0" + hex : hex;
	}

	function RGBtoHex(r, g, b) {
	    return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
	}
	
	function changeColor(v)
		{
			var canvas = document.createElement("canvas");
			var ctx = canvas.getContext("2d");
			var originalPixels = null;
			var currentPixels = null;
			var img = document.getElementById("bg_imgcan");
			canvas.width = img.width;
			canvas.height = img.height;
			
			ctx.drawImage(img, 0, 0, img.naturalWidth, img.naturalHeight, 0, 0, img.width, img.height);
			originalPixels = ctx.getImageData(0, 0, img.width, img.height);
			currentPixels = ctx.getImageData(0, 0, img.width, img.height);
			
			//img.onload = null;
			if(!originalPixels) return; // Check if image has loaded
			var newColor = HexToRGB(v);
			
			for(var I = 0, L = originalPixels.data.length; I < L; I += 4)
			{
				if(currentPixels.data[I + 3] > 0)
				{
					currentPixels.data[I] = originalPixels.data[I] / 255 * newColor.R;
					currentPixels.data[I + 1] = originalPixels.data[I + 1] / 255 * newColor.G;
					currentPixels.data[I + 2] = originalPixels.data[I + 2] / 255 * newColor.B;
				}
			}
			
			ctx.putImageData(currentPixels, 0, 0);
			
			document.getElementById("bg_img").src = canvas.toDataURL("image/png");
			
		}
	function changeColor2(v)
		{
			var canvas2 = document.createElement("canvas");
			var ctx2 = canvas2.getContext("2d");
			var originalPixels2 = null;
			var currentPixels2 = null;
			var img2 = document.getElementById("bg_imgcan1");
			canvas2.width = img2.width;
			canvas2.height = img2.height;
			
			ctx2.drawImage(img2, 0, 0, img2.naturalWidth, img2.naturalHeight, 0, 0, img2.width, img2.height);
			originalPixels2 = ctx2.getImageData(0, 0, img2.width, img2.height);
			currentPixels2 = ctx2.getImageData(0, 0, img2.width, img2.height);
			
			//img2.onload = null;
			if(!originalPixels2) return; // Check if image has loaded
			var newColor = HexToRGB(v);
			
			for(var I = 0, L = originalPixels2.data.length; I < L; I += 4)
			{
				if(currentPixels2.data[I + 3] > 0)
				{
					currentPixels2.data[I] = originalPixels2.data[I] / 255 * newColor.R;
					currentPixels2.data[I + 1] = originalPixels2.data[I + 1] / 255 * newColor.G;
					currentPixels2.data[I + 2] = originalPixels2.data[I + 2] / 255 * newColor.B;
				}
			}
			
			ctx2.putImageData(currentPixels2, 0, 0);
			
			document.getElementById("bg_img1").src = canvas2.toDataURL("image/png");
		}
			
</script>
<?php //bloginfo('url'); 
$profit_val = mysql_query("Select meta_value,meta_key from wp_postmeta where post_id=460 AND meta_key!='profit_margin' AND meta_key!='_my_meta_value_key' AND meta_key!='_edit_lock' AND meta_key!='_edit_last'");
 while($profit_valwhile = mysql_fetch_array($profit_val)){?>
 <input type="hidden" name="<?php echo $profit_valwhile['meta_key'];?>" id="<?php echo $profit_valwhile['meta_key'];?>" value="<?php echo $profit_valwhile['meta_value'];?>" />
<?php 
 }
 ?>
 <input type="hidden" name="imagecounter" value="0" id="imagecounter" />
 <input type="hidden" name="changeinagco" id="changeinagco" />
 
<?php get_header('design'); ?>
<?php
	$product_categories = get_terms( 'product_cat');
	//print_r($product_categories);
	?>
 <!--Body start-->
      <div class="mainBdy row"> 
        
        <!--Step Bar Sec-->
        <div class="stpBar">
          <div class="secLft">
            <ul class="prg">
              <li class="actv"><a href="<?php echo get_permalink( 34 ); ?>">1. Create your tee</a></li>
              <li><a id="setgoal" href="javascript:void(0)">2. Set a goal</a></li>
              <li><a id="adddesc" href="javascript:void(0)">3. Add a description</a></li>
            </ul>
          </div>
          <div class="secRht">
            <ul class="sspSec">
              <li class="save"><a href="javascript:void(0)" id="save">Save</a></li>
             <!-- <li class="share"><a href="javascript:void(0);" id="share">Share</a></li>
              <li class="preview"><a href="javascript:void(0)" id="preview">Preview</a></li>-->
            </ul>
          </div>
          <div class="clearFix"></div>
        </div>
        <!--Step Bar Sec-->
        
        <!--Design Left Start-->
        <div class="dsgnLft" id="tab">
          <div class="tabsArea">
            <ul class="tabs">
              <li class="txt"><a href="#tab1">Add text</a></li>
              <li class="art"><a href="#tab2">Add/Upload Art</a></li>
            </ul>
            <div class="clearFix"></div>
            <ul class="tabsContent">
              <li id="tab1">
                <p class="txtsecT">Enter text bellow</p>
                <input name="" type="text" id="txt_add" class="inpsec" />
                <p class="txtsec">Choose a Font</p>
                <select class="SelectSec" id="fonts">
                   <option value="Helvetica">Helvetica</option>
                   <option value="Arial">Arial</option>
                   <option value="Times New Roman">Times New Roman</option>
                   <option value="Times">Times</option>
                   <option value="serif">Serif</option>
                   <option value="Georgia">Georgia</option>
                </select>
				<div class="fontvah">
					<div class="txc">
						<p class="txtsec">Text Color</p>
               <!-- <div class="selclor">
                 <div class="mnClr"></div>				 
                </div>-->
				<!--<input type="color" name="txt_color" id="txt_color" value="#000000"/>-->
				<div class="allClrs" id="color-selectr">
					<div style="background:#000; height:20px; width:30px;"></div>
				</div>
				<div class="colorpalet" id="fontid" style="display:none;">
					<div class="inside">
					<?php
					
					$sql=mysql_query("select * from `".$wpdb->prefix.term_taxonomy."`  where `taxonomy` ='pa_color'");
					if(mysql_num_rows($sql)>0){
					while($ff=mysql_fetch_object($sql)){
					?>
					<span data-val="<?php echo $ff->description;?>" style="background:<?php echo $ff->description;?>"></span>
					<?php }}?>	
					</div>
				</div>
					</div>
					<div class="tetfoc"><div class="fintsize">
				<select id="fsize">
					<?php for($s=12;$s<100;$s++){?>
					<option value="<?php echo $s?>"><?php echo $s?></option>
					<?php }?>
				</select>
				</div></div>
					<!--<div class="otco"> <p class="txtsec">Outline Color</p>
				<div class="allClrs" id="color-selectr1">
					<div style="background:#000; height:20px; width:30px;"></div>
				</div>
				<div class="colorpalet" id="fontid1" style="display:none;">
					<div class="inside">
					<?php
					
					$sql=mysql_query("select * from `".$wpdb->prefix.term_taxonomy."`  where `taxonomy` ='pa_color'");
					if(mysql_num_rows($sql)>0){
					while($ff=mysql_fetch_object($sql)){
					?>
					<span data-val="<?php echo $ff->description;?>" style="background:<?php echo $ff->description;?>"></span>
					<?php }}?>	
					</div>
				</div></div>-->
 <div class="clearFix"></div>
				</div>
                
				 
				
				<table width="75" align="center">
					<tr>
						<td align="left" valign="top" width="25"><input type="button" size="4" value="" class="cls_rot_lft"></td>
						<td align="left" valign="top" width="25"><input type="button" size="4" value="" class="cls_rot_cntr"></td>
						<td align="left" valign="top" width="25"><input type="button" size="4" value="" class="cls_rot_rit"></td>
						
					</tr>
																	
				</table>
				<div class="outlineval">
					<div class="chootr">
		                <p class="txtsec">Add an Outline</p>
		                <select class="SelectSec rnsec" id="outlines">
                   <option value="0">No Outline</option>
                   <option value="1">Thin Outline</option>
                   <option value="2">Medium line</option>
                   <option value="3">Thick line</option>
                   
                </select>												
					</div>
					<div class="otco"> <p class="txtsec">Outline Color</p>
				<div class="allClrs" id="color-selectr1">
					<div style="background:#000; height:20px; width:30px;"></div>
				</div>
				<div class="colorpalet" id="fontid1" style="display:none;">
					<div class="inside">
					<?php
					
					$sql=mysql_query("select * from `".$wpdb->prefix.term_taxonomy."`  where `taxonomy` ='pa_color'");
					if(mysql_num_rows($sql)>0){
					while($ff=mysql_fetch_object($sql)){
					?>
					<span data-val="<?php echo $ff->description;?>" style="background:<?php echo $ff->description;?>"></span>
					<?php }}?>	
					</div>
				</div></div>
 <div class="clearFix"></div>
				</div>
              </li>
              <li id="tab2" class="tab2center">
			  <div class="grnLnk">
                <a href="<?php echo bloginfo('url'); ?>/ajax-library-images/?a=1" class="fancybox.ajax fnc" id="brws_art_libraby">Browse our art library</a></div>
               <p class="secnTxt">Many items for any occasion.</p>
                <p class="ortxt"><span>OR</span></p>
                <!--<a href="<?php echo bloginfo('url'); ?>/ajax-library-images/?a=2" class="updBtn fancybox.ajax fnc">Upload your own</a>-->
				<input type="file" name="userfile" id="userfile"/>
                <p class="secnTxt">Upload your own images or vector art.</p>
				
              </li>              
            </ul>
            <div class="clearFix"></div>
          </div>
        </div>
        <!--Design Left End--> 
       
        <!--Design Center Start-->
		<?php if(isset($_SESSION['design']) && !empty($_SESSION['design'])){?>
		<script>
		j(document).ready(function()	
			{/*j('.draggable1').draggable({});
				
			j(".draggable1").resizable({
				/*containment: "#text_container",
				aspectRatio: 0.25,		* /        
				handles: {
				    'se': '#segrip'				   				    
				},
				helper: 'ui-resizable-helper',
				start: function(e, ui) {
					//alert(ui.element.text());
					//var x = ui.element.width()/j(this).text().length;
		           	var ratio = j(this).height();//parseInt(x*6);		           
		            j(this).css("font-size", ratio);
					j(this).find('span').css({"dispaly":"inline-block"});
					j(this).css("height", "auto");	j(this).css("width", "auto");
					j(this).css("height", j(this).height());	j(this).css("width",  j(this).width());	
					//alert(ui.element.width());
						            
		        },
				stop: function(e, ui) {
		           	//var x = ui.element.width()/ui.element.text().length;
		           	var ratio = j(this).height();//parseInt(x*6);		           
		            j(this).css("font-size", ratio);
					j(this).find('span').css({"dispaly":"inline-block"});	
					//j(this).css("height", (j(this).height()-20)+'px');	
					j(this).css("height", "auto");	j(this).css("width", "auto");
					j(this).css("height", j(this).height());	j(this).css("width",  j(this).width());		
					//alert(ui.element.width());	
		        }				
		    });*/
			rotation_handle(j(".draggable1"));
			drg_rsz();
			j('.ui-resizable-handle,.handlerotate').css('display','none');
			j('.draggable1').css('background','none');
			j('.draggable1 span').css('border','0px');
			j('.front_print_area').removeAttr('style');
			j('.back_print_area').removeAttr('style');
			j.post('<?php echo get_template_directory_uri(); ?>/printareapix.php', {prodifg:"<?php echo $_SESSION['post_id'];?>"}).done(function(data) {//alert(data);
	var datavall = data.split('++++===++++');
	j('.front_print_area').css('height',datavall[0]+'px');
	j('.front_print_area').css('width',datavall[1]+'px');
	j('.front_print_area').css('top',datavall[2]+'px');
	j('.front_print_area').css('left',datavall[3]+'px');
	j('.back_print_area').css('height',datavall[4]+'px');
	j('.back_print_area').css('width',datavall[5]+'px');
	j('.back_print_area').css('top',datavall[6]+'px');
	j('.back_print_area').css('left',datavall[7]+'px');
});
			//j('#text_container').css('border','0px');
			
			
			});
			
		</script>
		<div class="dsgnCen" style="position:relative;">
		<?php 
			echo stripslashes(stripslashes($_SESSION['design']));?></div>
		<?php }else{?>
        <div class="dsgnCen" style="position: relative;">
		<div id="dv_front" >
          <img id="bg_img" /> <img id="bg_imgcan"  style="display: none;"/>
		  <div id="text_container" class="front_print_area">
		  	<div class="print_area">Printable area</div>
		  </div>
		  <div style="clear: both"></div>
		  
          <div class="seeBack"><a href="javascript:void(0)" id="id-seeBack"><img src="<?php echo get_template_directory_uri(); ?>/images/seeback.png" alt="" /></a></div>
          
		</div>
		
		<div id="dv_back" style="display: none;">
          <img id="bg_img1" /> <img id="bg_imgcan1" style="display: none;" />
		  <div id="text_container" class="back_print_area">
		  	<div class="print_area">Printable area</div>
		  </div>
		  
          <div class="seeBack">
		  <a href="javascript:void(0)" id="id-seeFront"><img src="<?php echo get_template_directory_uri(); ?>/images/seefront.png" alt="" /></a>

		  </div>
          
		</div>
		
		</div>
<?php }?>
        <!--Design Center End--> 
        
        <!--Design Right Start-->
        <div class="dsgnRht">
          <p class="txtssecT">Style and quality</p>
		  <select class="styaqu_select SeelectSec" id="styaqu_select" onchange="changeproductonsel(this.value);">
				<?php foreach($product_categories as $key => $pc){
					if($key==0){$chval = $pc->name;}?>
					<option value="<?php echo $pc->term_id;?>==++==<?php echo $pc->name;?>"><?php echo $pc->name;?></option>
				<?php }?>
			</select>
          <ul class="chsec tee_products" id="tee_products">
		  <?php $args = array( 'post_type' => 'product', 'product_cat' => $chval, 'post_status' => 'publish','author'=>'1');
        		$loop = new WP_Query( $args );
				/*echo '<pre>';print_r($loop);echo '</pre>';*/
				$h=0;
        		while ( $loop->have_posts() ) : $loop->the_post();global $product;
				if($h==0){$prodid = $product->id;}
				
		$authorvalues = get_the_terms( $product->id, 'pa_color');
		/*$product->id;*//*foreach ( $authorvalues as $authorvalue ) {
       echo $authorvalue->name;
        }*/
 if(mysql_num_rows(mysql_query("SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `post_id`='".$product->id."' and `meta_key`='_is_custom'"))==0){
      
?>
				<li class="tee_product <?php if($h==0){?>active<?php }?>" id="tee_product<?php echo $product->id;?>">    <div class="drsRev">
				<div onclick="product_li_active('tee_product<?php echo $product->id;?>');" >
					<div class="htxt"><?php the_title(); ?></div>			
					<div class="nrtxt"><?php the_content(); ?></div></div>
					<span class="teeitem_excerpt" style="display: none;"><?php the_excerpt(); ?></span>
					<span class="teeitem_excerptbase" style="display: none;"><?php echo get_post_meta( $product->id, 'base_cost_shirts', true); ?></span>
					<span class="teeitem_excerptproid" style="display: none;"><?php echo $product->id; ?></span>
					<span class="teeitem_excerptprice" style="display: none;"><?php echo get_post_meta( $product->id, 'base_cost_shirts_0010_0019', true); ?><?php //echo $product->get_price(); ?></span>

                     <span class="teeitem_price" style="display: none;"><?php echo $product->get_price_html(); ?></span>
					 </div>
					 <?php //echo '<pre>';print_r($authorvalues);echo '</pre>';
					 if(isset($authorvalues) && !empty($authorvalues) && count($authorvalues)>0){?>
					 <div id="product-colors" class="product-colors"><i></i>
					 <ul class="tee_nav">    
					 <?php 
					 $colr = 0;
					 shuffle($authorvalues);
					 foreach ( $authorvalues as $authorvalue ) {
					 	//echo $colr;
					 	if($colr<12){?>
					 <li style="background:<?php echo $authorvalue->description;?>;" title="<?php echo $authorvalue->name;?>" class="shirt-color-sample " data-texture="" data-value="<?php echo $authorvalue->description;?>" data-id="<?php echo $authorvalue->term_id;?>"></li><?php }
					$colr++; }?>
					 	<li class="palletf"><img src="<?php echo get_template_directory_uri(); ?>/images/pltpc.png" /></li>
					 </ul>
					 <div class="colorpalet upside" style="display:none;">
					<div class="inside">
					<?php foreach ( $authorvalues as $authorvalue ) {?>
						<span style="background:<?php echo $authorvalue->description;?>;" title="<?php echo $authorvalue->name;?>" class="shirt-color-sample " data-texture="" data-value="<?php echo $authorvalue->description;?>" data-id="<?php echo $authorvalue->term_id;?>"></span>
						<?php }?>
					</div>
				</div>
					 </div>
					<?php }?>
				</li>

    <?php $h++; } endwhile; ?>
				
          </ul>
          <div class="bestCst" style="display: none;" id="imgerrrpdiv">
<input type="hidden" name="addpriceoldd_front" value="0" id="addpriceoldd_front" />
<input type="hidden" name="addpriceoldd_back" value="0" id="addpriceoldd_back" />
<input type="hidden" name="checktexthas_front" value="textval" id="checktexthas_front" />
<input type="hidden" name="checktexthas_back" value="textval" id="checktexthas_back" />

		  <div id="imgerrr_front" style="color: red;"></div>
		  <div id="imgerrr_back" style="color: red;"></div>
		  <div id="image_color_inputprice" style="display: none;">			
			</div>
		  	<ul id="image_color_front" style="display: none;">				
			</ul>
			<ul id="image_color_back" style="display: none;">				
			</ul>
			<ul id="image_color_o" style="display: none;">				
			</ul>
			<ul id="image_color_d" style="display: none;">				
			</ul>
			
		  </div>
          <div class="bestCst">
            <p class="uppTxt tee_quote_note" id="tee_quote_note"></p>
			<p class="uppTxt tee_quote_note">Base cost @ <span  id="tee_quote_notebase"></span> shirts
			<input type="hidden" name="tee_quote_notebase_txt" id="tee_quote_notebase_txt"/>
			<input type="hidden" name="tee_quote_prob_id" id="tee_quote_prob_id"/>
			<input type="hidden" name="tee_quote_prob_price" id="tee_quote_prob_price"/></p>
            <p id="tee_price_preview" class="tee_price_preview prcTxt"></p>
            <div class="grnLnk"><a href="javascript:void(0);" id="tee_next_page">Next Step</a></div>
          </div>
        </div>
        <!--Design Right Start-->
        
        <div class="clearFix"></div>
      </div>
      <!--Body end--> 

<div class="clearboth"></div>
<div class="fade">
	<div class="login">
		<div class="crsIcn"><a href="javascript:login_close();">x</a></div>
		<div class="loginRht" id="logch"  style="display:none;">
			
			<div class="titl">How would you like to login?</div>
			<p>You can <a href="javascript:show('log');">login with Teecircle</a> or use any of the sites below:</p>
			
			<ul class="socl">
			<li>
					<a href="javascript:show('log');">
						<p>login with</p>
						<p><img src="<?php echo get_template_directory_uri(); ?>/images/logo1.png" alt="TeeCircle"></p>
					</a>
				</li>
			<li>
				<a href="<?php echo bloginfo('url'); ?>/facebook_twitter_login/?login&oauth_provider=facebook">
					<p>login with</p>
					<?php //echo(get_template_directory_uri())?>
					<p><img alt="Facebook" src="<?php echo(get_template_directory_uri())?>/images/facebook.jpg"></p>
				</a>
			</li>
			<li>
				<a href="<?php echo bloginfo('url'); ?>/facebook_twitter_login/google_login.php">
					<p>login with</p>
					<p><img alt="Google" src="<?php echo(get_template_directory_uri())?>/images/google.jpg"></p>
				</a>
			</li>
			<li>
				<a href="<?php echo bloginfo('url'); ?>/facebook_twitter_login/yahoo">
					<p>login with</p>
					<p><img alt="Yahoo" src="<?php echo(get_template_directory_uri())?>/images/yahoo.jpg"></p>
				</a>
			</li>
		</ul>
			
			<div class="btmlnk">or <a href="javascript:show('reg');">Create a new account with TeeCircle</a></div>
		</div>
		<div class="loginFrm" id="log"  style="display:none;">
		
			<div class="titl">Login with TeeCircle</div>
			<div>
			<div id="inverrlog" class="redTxt"></div>
			
				<form method="post">
					<div class="frmrw"> 
						<label>Email</label>
						<input id="username" class="input-text" type="text" name="username">
						<div id="usernameerrlog" class="redTxt"></div>
						<div class="clearFix"></div>
					</div>
					<div class="frmrw">
						<label>Password</label>
						<input id="password" class="input-text" type="password" name="password">
						<div id="passworderrlog" class="redTxt"></div>
						<div class="clearFix"></div>
					</div>
					<div class="frmrw">
						<label><a target="_new" href="<?php echo bloginfo ('url');?>/my-account/lost-password/">Forgot your password?</a></label>
						<div class="clearFix"></div>
					</div>
					<div class="frmrw">
						<input type="button" value="Login to your account »" class="cmnBtn" onclick="return get_signin();" />
					</div>
					<div class="frmrw">
					<span><a href="javascript:show('reg');" class="rhtLnk">Create New Account</a></span>
					<div class="clearFix"></div>
					</div>
				</form>
			</div>
		</div>
		<div class="rgstrFrm" id="reg" style="display:none;">
			<div class="titl">Register<span><a href="javascript:show('log');" class="rhtLnk">Already have account</a></span></div>
			<div>
			<div id="inverrreg" class="redTxt"></div>
				<form method="post">
					<div class="frmrw">  
						<label>Email</label>
						<input id="usernamer" class="input-text" type="text" name="username">
						<div class="redTxt" id="usernameerrreg"></div>
						<div class="clearFix"></div>
					</div>
					<div class="frmrw">
						<label>Password</label>
						<input id="passwordr" class="input-text" type="password" name="password">
						<div class="redTxt" id="passworderrreg"></div>
						<div class="clearFix"></div>
					</div>
					<div class="frmrw">
						<label>Re-enter password</label>
						<input id="repassword" class="input-text" type="password" name="repassword">
						<div class="redTxt" id="repassworderrreg"></div>
						<div class="clearFix"></div>
					</div>
					<div class="frmrw">
						<input type="button" value="Register" class="cmnBtn" onclick="return get_register();"/>
					</div>
				</form>
			</div>
		</div>
		<div class="rgstrFrm" id="shr" style="display:none;">
		<div class="titl">Share this design by email<span></span></div>
			<div>
			<div class="frmrw">
			<label for="username"><strong>Send to</strong> seperate email addresses with commas or spaces</label>
			<input id="repassword" class="input-text" type="password" name="repassword">
			<div class="clearFix"></div>
			</div>
			<div class="frmrw">
			<label for="username"><strong>Reply address</strong> your email address</label>
			<input id="repassword" class="input-text" type="password" name="repassword">
			<div class="clearFix"></div>
			</div>	
			<div class="frmrw">
						<input name="" type="button" value="Share Design &raquo;" class="cmnBtn" onclick="return get_register();"/>
					</div>				
			</div>		
		</div>
		<div class="rgstrFrm" id="blankch" style="display:none;">
		<div class="titl">You need to create a design.<span></span></div>
			<div>
			<div class="frmrw">
			<span class="text">Unfortunately, you can't sell a blank item. You need to add text or art before you can continue</span>
			<div class="clearFix"></div>
			</div>	
			<div class="frmrw">
						<input name="go_bk_des" type="button" value="Go back to designer »" class="cmnBtn" onclick="return login_close();"/>
					</div>				
			</div>		
		</div>
		<div class="rgstrFrm" id="loaderdiv" style="display:none;">
			<div class="titl">Saving your design!!<span class="loader"></span></div>
		</div>
	</div>
</div>
<?php $uploadpath =  wp_upload_dir(); ?>
<?php get_footer('inner'); ?> 

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/source/jquery.fancybox.css">

<script type="text/javascript">
var j = jQuery.noConflict();
function login_now(){
j.post('<?php echo get_template_directory_uri(); ?>/ajaxsaver.php', {design:j('.dsgnCen').html(),style_na:j('#styaqu_select').val(),base_q:j('#tee_quote_notebase_txt').val(),proid:j('#tee_quote_prob_id').val(),proprice:j('#tee_quote_prob_price').val(),front_print_area:j('.front_print_area').html(),back_print_area:j('.back_print_area').html()}).done(function(data) {
j('.fade').show();
j('.login').show();
j('#logch').show();
j('.login .crsIcn').show();
});

}
function login_close(){
j('.fade').hide();
j('.login').hide();
j('.login > div').hide();
}
function get_signin(){
	j('.redTxt').html('');
if(j('#username').val()==''){
	j('#usernameerrlog').html('Please enter Email');
	passworderrlog
//alert('Enter Name');
return false;
}
else if(j('#password').val()==''){
//alert('Enter password');
j('#passworderrlog').html('Please enter Password');
return false;
}
else{
	show('loaderdiv');j('.login .crsIcn').hide();
	j.post( "<?php echo get_template_directory_uri(); ?>/ajaxsignin.php",{username:j('#username').val(),password:j('#password').val()},function( data ) {
				
				if(data==0){
					j('#userlogintype').val('loggedin');
					//alert(data);
					
					//setTimeout(function(){location.reload();},5000);
					//alert(j('#acttype').val());
					
						//j('.login').css('display','none');j('.fade').css('display','none');
						savedraft();
						//alert('ff');
					
					
				}else{
					j('#inverrlog').html('Invalid Email or Password');
					return false;
				}
			});
	}
}


function get_register(){
j('.redTxt').html('');
if(j('#usernamer').val()==''){
	j('#usernameerrreg').html('Please enter Email Address');
return false;
}
else if(j('#usernamer').val()!=''){
	var filter =/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var sEmail=j('#usernamer').val();
	if (!filter.test(sEmail)) {
		j('#usernameerrreg').html('Please enter vaild Email Address');
       return false;
    }
    
}
if(j('#passwordr').val()==''){
	j('#passworderrreg').html('Please enter Password');
return false;
}else if(j('#passwordr').val()!=''){
	var StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/;
	var spass=j('#passwordr').val();
	if (!StrongPass.test(spass)) {
		j('#passworderrreg').html('Password must contain at least one upper case letter, one lower case letter and one digit.');
       return false;
    }
}
if(j('#repassword').val()==''){
	j('#repassworderrreg').html('Please enter Password again');
return false;
}
if(j('#repassword').val()!=j('#passwordr').val()){
	j('#repassworderrreg').html('Password does not match');	
return false;
}

else{
	show('loaderdiv');j('.login .crsIcn').hide();
	j.post( "<?php echo get_template_directory_uri(); ?>/ajaxregister.php",{username:j('#usernamer').val(),password:j('#passwordr').val()},function( data ) {
				
				if(data==1){//alert(data);
					j('#userlogintype').val('loggedin');
					//alert('Registration successful');
					
						//j('.login').css('display','none');j('.fade').css('display','none');
						savedraft();
						
						//alert('ff');
					
					
					
				}else{
					j('#inverrreg').html(data);
					
					//alert(data);
					return false;
				}
			});
	}
}
function show(div){
	j('.fade').show();
	j('.login').show();
	j('.login > div').hide();
	j('.login .crsIcn').show();
	j('#'+div).show();
	j('#'+div+' > div').show();
}
function product_li_active(txt){//alert('dd');
	j('#tee_quote_note').html(j('#'+txt+' .teeitem_excerpt p').html());
	j('#tee_quote_notebase').html(j('#'+txt+' .teeitem_excerptbase').html());
	j('#tee_quote_notebase_txt').val(j('#'+txt+' .teeitem_excerptbase').html());
	j('#tee_quote_prob_id').val(j('#'+txt+' .teeitem_excerptproid').html());
	j('#tee_quote_prob_price').val(parseFloat(j('#'+txt+' .teeitem_excerptprice').html()).toFixed(2));
	//j('#tee_price_preview').html(j('#'+txt+' .teeitem_price .amount').html());
	j('#tee_price_preview').html('$'+parseFloat(j('#'+txt+' .teeitem_excerptprice').html()).toFixed(2));
	j('.tee_product').removeClass('active'); 
	j('#'+txt).addClass('active');
	if(j('#'+txt+' .product-colors').length==1){j('.product-colors').css('display','none');j('#'+txt+' .product-colors').css('display','block');}
	j.ajaxSetup({async:false});
	j.post('<?php echo get_template_directory_uri(); ?>/ajaximage.php', {checkval:'productimage',prodifg:txt}).done(function(data) {//alert(data);
	var dataval = data.split('++++===++++');
	//alert('<?php echo $uploadpath["baseurl"]; ?>/'+dataval[0]);	
	var upbasepath = '<?php echo $uploadpath["baseurl"]; ?>/';
	j('#bg_img,#bg_imgcan').attr('src',upbasepath+dataval[0]);
	j('#bg_img1,#bg_imgcan1').attr('src',upbasepath+dataval[1]);
	});
 	j.post('<?php echo get_template_directory_uri(); ?>/printareapix.php', {prodifg:txt}).done(function(data) {//alert(data);
	var datavall = data.split('++++===++++');
	j('.front_print_area').css('height',datavall[0]+'px');
	j('.front_print_area').css('width',datavall[1]+'px');
	j('.front_print_area').css('top',datavall[2]+'px');
	j('.front_print_area').css('left',datavall[3]+'px');
	j('.back_print_area').css('height',datavall[4]+'px');
	j('.back_print_area').css('width',datavall[5]+'px');
	j('.back_print_area').css('top',datavall[6]+'px');
	j('.back_print_area').css('left',datavall[7]+'px');
});
}
function changeproductonsel(txt){
	j.post('<?php echo bloginfo ('url')."/ajax"; ?>', {checkval:'changeproductonsel',chval:txt}).done(function(data) {//alert(data);
	var dataval = data.split('++++++++++++++');	
	j('#tee_products').html(dataval[0]);
	product_li_active('tee_product'+dataval[1]);
 });	 	
}
j(document).ready(function()	
{
	j('#color-selectr').on('click',function(){
		j('#fontid').show();
	});
	j('#color-selectr1').on('click',function(){
		j('#fontid1').show();
	});
	j('#fontid .inside span').on('click',function(){
	 var val=j(this).attr('data-val');
	 j('#color-selectr div').css('background',val);
	 j('#fontid').hide();
	});
	
	j('#fontid1 .inside span').on('click',function(){
	 		j('#fontid1 .inside span').removeClass('cls_slct_outline_color');
			var val=j(this).attr('data-val');
	 		j('#color-selectr1 div').css('background',val);
			var s = j('#outlines').val();
			j(this).addClass('cls_slct_outline_color');
			//alert(s);
			var x = '-'+s+'px -'+s+'px 0 '+val+','+s+'px -'+s+'px 0 '+val+',-'+s+'px '+s+'px 0 '+val+','+s+'px '+s+'px 0 '+val+'';
			//alert(x);
			j('.cls_selected').css('textShadow',x);
			j('.cls_selected').css('text-shadow',x);
	 		j('#fontid1').hide();
			
	});
	
	j('.palletf').on('click',function(){
	//alert('few');
		j('.upside').toggle();
	});
	j('.upside .inside span').on('click',function(){
	   // var val=j(this).attr('data-val');
		//j('#colorpalet_upside div').css('background',val);
		j('.upside').hide();
	});
	//j('#bg_img').load(function(){j(this).css('backgroundColor','#ccc')});
	var initDiagonal;
	var initFontSize;
	j(document).on('mouseover','.shirt-color-sample',function(){
		j('#changeinagco').val('');		
		changeColor(j(this).data('value'));
		
		changeColor2(j(this).data('value'));
	});
	j(document).on('click','.shirt-color-sample',function(){		
		changeColor(j(this).data('value'));
		
		changeColor2(j(this).data('value'));
		j('#changeinagco').val('change');
	});
	j(document).on('mouseleave','.shirt-color-sample',function(){
		if(j('#changeinagco').val()!='change'){
			j('#bg_img').attr('src',j('#bg_imgcan').attr('src'));
		j('#bg_img1').attr('src',j('#bg_imgcan1').attr('src'));
		}
		
	});
	product_li_active('tee_product<?php echo $prodid;?>');
	j('#tab ul li:first-child').addClass('selected');
		var tabcontent = j(".tabsContent li").hide();
		tabcontent.hide();
		j(".tabsContent li:first-child").show();
		j('.tabs li a').click(function(){
			j('.tabs li').removeClass('selected');
			j(this).parent().addClass('selected');
			var goto = j(this).attr('href');
			tabcontent.hide();
			j(goto).show();
			return false;			
			});
			
			j('.mobileMenu .mmnu').hide();
			j('.mobile_nav').click(function(){
			j('.mobileMenu .mmnu').fadeToggle();
			});
			
			
			
			
			
			
		j('#txt_add').keyup(function(){
			
			var ths = j(this);
			var dsf = j('#dv_front').css('display');	
			var dsb = j('#dv_back').css('display');	
			var cont = '#dv_front';
			if(dsf=='none'){
				cont = '#dv_back';
			}
			if(!ths.hasClass('cls_edit')){				
				j('.draggable1').removeClass('cls_selected');
				nonsec(j('.draggable1'));
			var hndl = '<div class="ui-resizable-handle ui-resizable-nw" id="nwgrip"></div><div class="ui-resizable-handle ui-resizable-ne cls_close" id="negrip"></div><div class="ui-resizable-handle ui-resizable-sw" id="swgrip"></div><div class="ui-resizable-handle ui-resizable-se" id="segrip"></div>';
			var o = j('<div/>', {
			    class: 'draggable1 ui-draggable cls_selected',
			    text: ths.val(),
				'data-angle':0,				
			}).css({'left':'65px','top':'130px'})
			.html('<span>'+ths.val()+'</span>'+hndl+'')			
			.appendTo(cont+' #text_container');
			j('.cls_selected').css({'width':'auto','height':'12px;'});
			//j('.cls_selected').css({'width':j('.cls_selected').width()+'px','height':j('.cls_selected').height()+'px'});
			ths.addClass('cls_edit');
			j('.draggable1').draggable({});
				
			j(".draggable1").resizable({
				/*containment: "#text_container",*/
				aspectRatio: 2.5,		        
				handles: {
				    'se': '#segrip'				   				    
				},
				resize: function(){
		var jThis=$(this);
    var fontSize=parseInt(jThis.css("font-size"));
    var originalLines=jThis.height()/fontSize;
     if(jThis.width()>=jThis.find('span').width())
    	{
    		var fontt = jThis.css("font-size",""+(++fontSize)+"px");
    	}else{
    		var fontt = jThis.css("font-size",""+(fontSize-1)+"px");
    	}
		
		 $( this ).css({
			 'font-size'   : fontt,//parseInt($(this).height()) - 20 + "px" ,//$(".draggable").fitText()
			 'width'	   : parseInt(jThis.find('span').width()) + 10 + "px",
			 'height'	  : parseInt(jThis.find('span').height()) + 10 + "px"
			 //'line-height' : parseInt($(this).height()) - 40  + "px"

		 });
	},
				// helper: 'ui-resizable-helper',
				// start: function(e, ui) {
				// 	//alert(ui.element.text());
				// 	//var x = ui.element.width()/j(this).text().length;
		  //          	var ratio = j(this).height();//parseInt(x*6);		           
		  //           j(this).css("font-size", ratio);
				// 	j(this).find('span').css({"dispaly":"inline-block"});
				// 	j(this).css("height", "auto");	j(this).css("width", "auto");
				// 	j(this).css("height", j(this).height());	j(this).css("width",  j(this).width());
				// 	//alert(ui.element.width());
						            
		  //       },
				// stop: function(e, ui) {
		  //          	//var x = ui.element.width()/ui.element.text().length;
		  //          	var ratio = j(this).height();//parseInt(x*6);		           
		  //           j(this).css("font-size", ratio);
				// 	j(this).find('span').css({"dispaly":"inline-block"});	
				// 	//j(this).css("height", (j(this).height()-20)+'px');	
				// 	j(this).css("height", "auto");	j(this).css("width", "auto");
				// 	j(this).css("height", j(this).height());	j(this).css("width",  j(this).width());		
				// 	//alert(ui.element.width());	
		  //       }				
		    });
				
			rotation_handle(j(".cls_selected"));	
			}	
			if(j('#dv_front').css('display')=='block'){
			if(j('#checktexthas_front').val()=='textval'){
				getAverageRGB();
				j('#checktexthas_front').val('');
			}
		}
			if(j('#dv_back').css('display')=='block'){
			if(j('#checktexthas_back').val()=='textval'){
				getAverageRGB();
				j('#checktexthas_back').val('');
			}
			}	
		
		});
		j('#fsize').change(function(){
			$('.cls_selected').css('font-size',$(this).val()+'px');
		});
		
		j('#text_container').click(function(){
			j('.cls_selected .ui-resizable-handle').hide();
			j('.draggable1').css('background','none');
			j('.handlerotate').css('display','none');
			//j('#handle').css('display','none');
			j('.draggable1').css('border',0);
			j('.draggable1 span').css('border',0);	
			//url("../images/dragtee.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0)
			j('.cls_selected').removeClass('cls_selected').css('border',0);
			nonsec(j('.draggable1'));		
			j('#txt_add').removeClass('cls_edit').val('');
		});
		
		j('#negrip').click(function(){
			j('.cls_rot_rit').trigger('click');
			//getAverageRGB();
		});
		
		
		j('#txt_color').change(function(){
			var ths = j(this);
			j('.cls_selected').attr('fill',ths.val());
		});
		
		j('.cls_rot_lft').mousedown(function(){//alert('sdfds');
			var el = j('.cls_selected');
			var a = parseInt(el.data('angle'))-10;
			el.data('angle',a);
			el.animate({deg:a},{duration: 1,step: function() {el.css({transform: 'rotate(' + a + 'deg)'});}});	
		});
		/*j('#swgrip').click(function(){//alert('bn');
			var el = j('.cls_selected');
			var a = parseInt(el.data('angle'))-10;
			el.data('angle',a);
			el.animate({deg:a},{duration: 1,step: function() {el.css({transform: 'rotate(' + a + 'deg)'});}});	
		});*/
		j('.cls_rot_rit').mousedown(function(){
			var el = j('.cls_selected');
			var a = parseInt(el.data('angle'))+10;
			el.data('angle',a);
			el.animate({deg:a},{duration: 1,step: function() {el.css({transform: 'rotate(' + a + 'deg)'});}});			
		});
		j('.cls_rot_cntr').mousedown(function(){
			var el = j('.cls_selected');
			var a = 0;
			el.data('angle',a);
			el.animate({deg:a},{duration: 1,step: function() {el.css({transform: 'rotate(' + a + 'deg)'});}});
		});
		j(document).on('click','.draggable1',function(){
			j(this).css('background','url("<?php echo get_template_directory_uri();?>/images/dragtee.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0)');
			j(this).find('.handlerotate').css('display','block');
			//j(this).find('#handle').css('display','block');
			j(this).addClass('cls_selected').find('.ui-resizable-handle').removeAttr('style');
			//j(this).find('span').css({'border':'1px dashed','min-height':'12px','min-width':'120px'});
			j('#txt_add').val(j(this).find('span').text()).addClass('cls_edit');
		});
		j(document).on('keyup','#txt_add',function(){
			var hndl = '<div class="ui-resizable-handle ui-resizable-nw" id="nwgrip"></div><div class="cls_close ui-resizable-handle ui-resizable-ne" id="negrip"></div><div class="ui-resizable-handle ui-resizable-sw" id="swgrip"></div><div class="ui-resizable-handle ui-resizable-se" id="segrip"></div>';
			if(j('.cls_selected').length==1){
				if(j('.cls_selected').find('img').length==0){
					j('.cls_selected span')
					.html(j(this).val());						
				}
			}
			
			drg_rsz();
			if(j('#dv_front').css('display')=='block'){
			if(j('#checktexthas_front').val()=='textval'){
				getAverageRGB();
				j('#checktexthas_front').val('');
			}
		}
			if(j('#dv_back').css('display')=='block'){
			if(j('#checktexthas_back').val()=='textval'){
				getAverageRGB();
				j('#checktexthas_back').val('');
			}
		}
				
		});
		j(document).on('click','.cls_close',function(){		
			/*if(j(this).closest('.draggable1').attr('data-addpricev')!=''){
				//alert(j('#'+j(this).closest('.draggable1').attr('data-addpricev')).val());
				var fipri = parseFloat(j('#tee_quote_prob_price').val())-parseFloat(j('#'+j(this).closest('.draggable1').attr('data-addpricev')).val());
			j('#tee_quote_prob_price').val(fipri);
			j('#tee_price_preview').html('$'+fipri);
			j('#'+j(this).closest('.draggable1').attr('data-addpricev')).remove();*/
			j(this).closest('.draggable1').remove();
			j('#txt_add').val('');
			if(j('#dv_back .draggable1')){
				j('#checktexthas_back').val('textval');
			}
			if(j('#dv_front .draggable1')){
				j('#checktexthas_front').val('textval');
			}
			getAverageRGB();
			/*}else{
				j(this).closest('.draggable1').remove();
			}*/
			//j(this).closest('.draggable1').remove();
		});
		j('#fontid span').click(function(){
			j('.cls_selected').css('color',j(this).css('backgroundColor'));
			getAverageRGB();
		});	
		j('#fonts').change(function(){
			j('.cls_selected').css('font-family',j(this).val());
		});	
		
		j('#outlines').change(function(){
			//alert(j(this).val())
			var s = j(this).val();
			var c = $('.cls_slct_outline_color').data('val');
			x = '-'+s+'px -'+s+'px 0 '+c+','+s+'px -'+s+'px 0 '+c+',-'+s+'px '+s+'px 0 '+c+','+s+'px '+s+'px 0'+c+'';
			//alert(x);
			j('.cls_selected').css('textShadow',x);
			j('.cls_selected').css('text-shadow',x);
		});	
		/*	
		j('#brws_art_libraby').click(function(){
			j.fancybox({content:'hi','helpers' : { 'overlay': {'css': {'background': 'rgba(255, 255, 255, 0.5)'}}}});
		});*/
		j('.fnc').fancybox({'helpers' : { 'overlay': {'css': {'background': 'rgba(255, 255, 255, 0.5)'}}}});
		j('#id-seeFront').click(function(){
			
		});
		
		j('#id-seeBack').click(function(){
			j('#dv_front').hide();
			j('#dv_back').show();
			j('#imgerrr_back').show()
			//alert(j('#imgerrr_back').html());
			if(j('#imgerrr_back').html()==''){
				j('#imgerrrpdiv').hide();
			}else{
				j('#imgerrrpdiv').show();
				j('#imgerrr_front').hide()
			}
			j('#txt_add').val('').removeClass('cls_edit');
			nonsec(j('.cls_selected'));
			j('.cls_selected').removeClass('cls_selected');
			j('#color-selectr div').css('background','#000');
			
		});
		j('#id-seeFront').click(function(){
			j('#dv_back').hide();
			j('#imgerrr_front').show()
			if(j('#imgerrr_front').html()==''){
				j('#imgerrrpdiv').hide();
			}else{
				j('#imgerrrpdiv').show();
				j('#imgerrr_back').hide()
			}
			j('#dv_front').show();
			j('#txt_add').val('').removeClass('cls_edit');
			nonsec(j('.cls_selected'));
			j('.cls_selected').removeClass('cls_selected');
			j('#color-selectr div').css('background','#000');
		});
		/*j('#preview').click(function(){
			var obj = j('.dsgnCen');
			var xob = obj;
			
			j.fancybox({content:xob.html()});
			j('.fancybox-wrap').find('.cls_close,.ui-resizable-handle,.seeBack').remove();
			j('.fancybox-wrap div').css('border',0);
			
			//j('.fancybox-wrap').find('div').removeClass('draggable1');
			j('.fancybox-wrap').find('div').removeClass('ui-draggable');
			j('.fancybox-wrap').find('div').removeClass('ui-resizable');
			//j('.fancybox-wrap').find('div').removeClass('cls_selected');
		});*/
		j('#preview').click(function(){
		if(document.getElementById('text_container').innerHTML.toString().trim()=='<div class="print_area">Printable area</div>'){
			show('blankch');
			//j('.fade').show();
			//j('.login').show();
			//j('#blankch').show();
		//alert('You need to create a design.');
		return false;
		}else{
			j.post('<?php echo get_template_directory_uri(); ?>/ajaxsaver.php', {design:j('.dsgnCen').html(),style_na:j('#styaqu_select').val(),base_q:j('#tee_quote_notebase_txt').val(),proid:j('#tee_quote_prob_id').val(),proprice:j('#tee_quote_prob_price').val(),front_print_area:j('.front_print_area').html(),back_print_area:j('.back_print_area').html()}).done(function(data){window.location.href='<?php echo get_permalink( 311 ); ?>';
			});	
		}	
		});
		/////////////////////////////////save it start
		j('#save').click(function(){
		if(document.getElementById('text_container').innerHTML.toString().trim()=='<div class="print_area">Printable area</div>'){//alert('You need to create a design.');
		//j('.fade').show();
			//j('.login').show();
			//j('#blankch').show();
			show('blankch');
		return false;
		}else{
			if(j('#userlogintype').val()=='loggedin'){show('loaderdiv');j('.login .crsIcn').hide();
			savedraft();	
			}else{
			login_now();
			}
			}
		});
		///////////////////////////////////////save end
		/////////////////////////////////share start
		j('#share').click(function(){
		if(document.getElementById('text_container').innerHTML.toString().trim()=='<div class="print_area">Printable area</div>'){//alert('You need to create a design.');
		//j('.fade').show();
			//j('.login').show();
			//j('#blankch').show();
			show('blankch');
		return false;
		}else{
			show('shr');
			}
		});
		//////////////////////////////////share end
		/////////////////////////////////////set goal start
		j('#setgoal').click(function(){
			if(document.getElementById('text_container').innerHTML.toString().trim()=='<div class="print_area">Printable area</div>'){
				show('blankch');
				return false;
			}else{
				j.post('<?php echo get_template_directory_uri(); ?>/ajaxsaver.php', {design:j('.dsgnCen').html(),style_na:j('#styaqu_select').val(),base_q:j('#tee_quote_notebase_txt').val(),proid:j('#tee_quote_prob_id').val(),proprice:j('#tee_quote_prob_price').val(),front_print_area:j('.front_print_area').html(),back_print_area:j('.back_print_area').html()}).done(function(data){window.location.href='<?php echo get_permalink( 234 ); ?>';
				});	
			}	
		});
		///////////////////////////////////set goal end
		/////////////////////////////////////Next Step start
		j('#tee_next_page').click(function(){
			if(document.getElementById('text_container').innerHTML.toString().trim()=='<div class="print_area">Printable area</div>'){
				show('blankch');
				return false;
			}else{
				j.post('<?php echo get_template_directory_uri(); ?>/ajaxsaver.php', {design:j('.dsgnCen').html(),style_na:j('#styaqu_select').val(),base_q:j('#tee_quote_notebase_txt').val(),proid:j('#tee_quote_prob_id').val(),proprice:j('#tee_quote_prob_price').val(),front_print_area:j('.front_print_area').html(),back_print_area:j('.back_print_area').html()}).done(function(data){window.location.href='<?php echo get_permalink( 234 ); ?>';
				});	
			}	
		});
		///////////////////////////////////Next Step end
		/////////////////////////////////////Add Description start
		j('#adddesc').click(function(){
			if(document.getElementById('text_container').innerHTML.toString().trim()=='<div class="print_area">Printable area</div>'){
				show('blankch');
				return false;
			}else{
				j.post('<?php echo get_template_directory_uri(); ?>/ajaxsaver.php', {design:j('.dsgnCen').html(),style_na:j('#styaqu_select').val(),base_q:j('#tee_quote_notebase_txt').val(),proid:j('#tee_quote_prob_id').val(),proprice:j('#tee_quote_prob_price').val(),front_print_area:j('.front_print_area').html(),back_print_area:j('.back_print_area').html()}).done(function(data){window.location.href='<?php echo get_permalink( 234 ); ?>?val=desc';
				});	
			}	
		});
		///////////////////////////////////Add Description end
		
});

	
	
/*	function getRotationDegrees(obj)
 {
  var matrix = obj.css("-webkit-transform") ||
  obj.css("-moz-transform")    ||
  obj.css("-ms-transform")     ||
  obj.css("-o-transform")      ||
  obj.css("transform");
  if(matrix !== 'none') 
  {
   var values = matrix.split('(')[1].split(')')[0].split(',');
   var a = values[0];
   var b = values[1];
   var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
  } 
  else
  { 
   var angle = 0; 
  }
  return angle;
 }*/
 
 function drg_rsz(){
 	j(".draggable1")
	.draggable(
	{
		stop:function(e,ui){
			var l = ui.position.left+20;
			var t = ui.position.top+20;
			if(j('#dv_front').css('display')=='none'){
				var w = j('.back_print_area').width();
				var h = j('.back_print_area').height(); 
			}else{
				var w = j('.front_print_area').width();
				var h = j('.front_print_area').height(); 
			}
			var ui_w = j(this).width();
			var ui_h = j(this).height();
			
			
			if(l<0 || t<0 || (ui_w+l)>w || (ui_h+t)>h){
				if(j('#dv_front').css('display')=='none'){
									j('.back_print_area').css('border','1px solid red');
								}else{
									j('.front_print_area').css('border','1px solid red');
								}
			}else{
				if(j('#dv_front').css('display')=='none'){
									j('.back_print_area').css('border','1px solid #000');
								}else{
									j('.front_print_area').css('border','1px solid #000');
								}
			}
			
		}
	}
	).resizable({
		/*containment: "#text_container",*/
				aspectRatio: true,			        
						handles: {
						    'se': '#segrip'				   				    
						},

	resize: function(){
		var jThis=$(this);
    var fontSize=parseInt(jThis.css("font-size"));
     if(jThis.width()>=jThis.find('span').width())
    	{
    		var fontt = jThis.css("font-size",""+(++fontSize)+"px");
    	}else{
    		var fontt = jThis.css("font-size",""+(fontSize-1)+"px");
    	}
		 $( this ).css({
			 'font-size'   : fontt,//parseInt($(this).height()) - 20 + "px" ,//$(".draggable").fitText()
			 'width'	   : parseInt(jThis.find('span').width()) + 10 + "px",
			 'height'	  : parseInt(jThis.find('span').height()) + 10 + "px"
			 //'line-height' : parseInt($(this).height()) - 40  + "px"

		 });
	},
						/* helper: 'ui-resizable-helper',
						start: function(e, ui) {
							var x = ui.element.width()/j(this).text().length;
				           	var ratio = parseInt(x*2);		           
				            j(this).css("font-size", ratio);
							j(this).find('span').css({"dispaly":"inline-block"});
							j(this).css("height", "auto");	j(this).css("width", "auto");
							j(this).css("height", j(this).height());	j(this).css("width",  j(this).width());
							//alert(ui.element.width());
									            					 
				        },* /
						stop: function(e, ui) {
				           	var x = ui.element.width()/ui.element.text().length;
							var opset = ui.top
				           	var ratio = parseInt(x*2);		//j(this).height();//           
				            j(this).css("font-size", ratio);
							j(this).find('span').css({"dispaly":"inline-block"});	
							//j(this).css("height", (j(this).height()-20)+'px');	
							var txt_w = j('#text_container').width();
							var ui_w = parseInt(j(this).width());
							j(this).css("height", "auto");	j(this).css("width", "auto");
							j(this).css("height", j(this).height());	j(this).css("width",  j(this).width());	
							///alert(ui.left);
							//alert(txt_w);alert(ui_w);
							if(txt_w<ui_w){	
				                if(j('#dv_front').css('display')=='none'){
									j('.back_print_area').css('border','1px solid red');
								}else{
									j('.front_print_area').css('border','1px solid red');
								}
							}else{
								if(j('#dv_front').css('display')=='none'){
									j('.back_print_area').css('border','1px solid #000');
								}else{
									j('.front_print_area').css('border','1px solid #000');
								}
							}
							
							/ *
							var l = ui.position.left+20;
							var t = ui.position.top+20;
							var w = parseInt(j('#text_container').css('width'));
							var h = parseInt(j('#text_container').css('height'));
							var ui_w = parseInt(j(this).find('span').css('width'));
							var ui_h = parseInt(j(this).find('span').css('height'));
							
							if(l<0 || t<0 || (ui_w+l)>w || (ui_h+t)>h){
								j('#text_container').css('border','1px solid red');
							}else{
								j('#text_container').css('border','1px solid #000');
							} 
							* /
							
				        }	*/			
			});
 }		
</script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.9.1.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.xcolor.js"></script>

<script>
function diff(x, y, txt) {
    var centerItem = j('.'+txt),
        centerLoc = centerItem.offset();
    var dx = x - (centerLoc.left + (centerItem.width() / 2));
        dy = y - (centerLoc.top + (centerItem.height() / 2));
    var anj = Math.atan2(dy, dx) * (180 / Math.PI);
		if(anj<0){
			var myan = 250 + anj;
		}else{
			var myan = 250 + anj;
		}
    return myan;
}
	function rotation_handle(ele){
		//alert(ele.find('handlerotate').length);
		if(ele.find('handlerotate').length==0){
				j('<div></div>').appendTo(ele).attr('id','handle').attr('class','handlerotate ui-resizable-sw');}
ele.css('position', 'relative');
j('.handlerotate').draggable({
    opacity: 0.01, 
    drag: function(event, ui){
		var x = event.pageX;
	//alert(x);
    var y = event.pageY;
		var myangle= diff(x,y,'cls_selected');
        var rotateCSS = 'rotate(' + myangle + 'deg)';

        $(this).parent().css({
            '-moz-transform': rotateCSS,
            '-webkit-transform': rotateCSS
        });
    },
	stop: function() {j(this).removeAttr('style');}
});
		
	}
	function nonsec(ele){
		ele.find('.ui-resizable-handle').css('display','none');
		ele.find('.handlerotate').css('display','none');
		ele.css('background','none');
	}
</script>
<script src="<?php echo get_template_directory_uri() ?>/js/uploadify_31/jquery.uploadify-3.1.min.js" type="text/javascript"></script>
<?php if(isset($_SESSION['post_id'])&& !empty($_SESSION['post_id'])){
	$ajaxpostsave = 'editajaxproductsavepost.php';
}else{
	$ajaxpostsave = 'ajaxproductsavepost.php';
}
//echo $ajaxpostsave;
//echo $_SESSION['post_id'];?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#upload-file').click(function (e) {
            e.preventDefault();
			//$('.busydiv').css('height',$(window).height()).show();
			//alert('ok');
			jQuery('#userfile').uploadify('upload','*');
        });
		var dd="";
	jQuery('#userfile').uploadify({
            'debug':false,
            'auto':true,
			'method':'POST',			
			'width':'191',			
			'height':'36',			
            'swf':  '<?php echo get_template_directory_uri(); ?>/js/uploadify_31/uploadify.swf',
            'uploader': "<?php echo get_template_directory_uri() ?>/do_upload.php",
            'cancelImg': '<?php echo get_template_directory_uri(); ?>/js/uploadify_31/uploadify-cancel.png',
            'fileTypeExts':'*.jpg;*.bmp;*.png;*.tif;*.eps',
            'fileTypeDesc':'Image Files (.jpg,.bmp,.png,.tif,.eps)',
            'fileSizeLimit':'4MB',
            'fileObjName':'userfile',
            'buttonText':'Upload your own',
			'buttonClass' : 'updBtn',
            'multi':true,
            'removeCompleted':true,
			'onSelect':function(){$('.uploadify-queue').show()},
			'onUploadStart' : function(file) {},
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {},
            'onUploadComplete':function(file){},
            'onUploadSuccess' : function(file, data, response) {
				 var obj = jQuery.parseJSON(data);
				
				var r = obj.height/obj.width;
				var nw = 80;
				var nh = 80*r;
				
				$('.cls_im').remove();
				var html= '<span style="display:none" class="cls_im" data-name="'+obj.new_name+'"><img src ="<?php echo get_template_directory_uri();?>/uploads/'+obj.new_name+'" width="'+nw+'" height="'+nh+'" class="cls_clp" > </span>';
				$('body').append(html);
				//alert($('.cls_clp').height())
				prepare();
			}
        });
		
		
});

function prepare(){
	//alert('dfgdf');
			//$('#panel').text('Loading....');
			var imgcou = parseInt($('#imagecounter').val())+1;
			
			j('.draggable1').removeClass('cls_selected');
			nonsec(j('.draggable1'));
			var hndl = '<div class="ui-resizable-handle ui-resizable-nw" id="nwgrip"></div><div class="ui-resizable-handle ui-resizable-ne cls_close" id="negrip"></div><div class="ui-resizable-handle ui-resizable-sw" id="swgrip"></div></div>';
			var apt = '#dv_back #text_container';
			if($('#dv_back').css('display')=='none'){
				apt = '#dv_front #text_container';
			}
			//var ths = $(this);
			var ths = $('.cls_im');
			j('<div/>', {
			    class: 'draggable1 ui-draggable cls_selected',			   
				'data-angle':0		
			}).html(ths.html()+''+hndl+'').appendTo(apt);
			j('.cls_selected').attr('data-addpricev','imagevan'+imgcou);
			j('.draggable1').draggable({ 
				stop:function(e,ui){
					var l = ui.position.left+20;
					var t = ui.position.top+20;
					var w = parseInt(j('#text_container').css('width'));
					var h = parseInt(j('#text_container').css('height'));
					//var ui_w = parseInt(j(this).find('span').css('width'));
					//var ui_h = parseInt(j(this).find('span').css('height'));
					var ui_w = parseInt(j(this).find('img').css('width'));
					var ui_h = parseInt(j(this).find('img').css('height'));				
					
					if(l<0 || t<0 || (ui_w+l)>w || (ui_h+t)>h){
						j(apt).css('border','1px solid red');
					}else{
						j(apt).css('border','1px solid #000');
					}					
				}
			});
						
			
			j(".draggable1 img").resizable({
				aspectRatio:true,
					alsoResize:$(this).closest('.draggable1'),
					stop:function(){
						var txt_w = j(apt).width();
							var ui_w = parseInt(j(this).find('.cls_selected').find('img').css('width'));
							///alert(ui.left);
							if(txt_w<ui_w){								
								j(apt).css('border','1px solid red');
							}else{
								j(apt).css('border','1px solid #000');
							}
					}
			})
			var rgb = getAverageRGB();
			$('.fancybox-overlay').trigger('click');
			rotation_handle(j(".cls_selected"));
			//alert($('#image_color li').length);
			
			
		
}
function savedraft(){
	j.post('<?php echo get_template_directory_uri(); ?>/ajaxsaver.php', {design:j('.dsgnCen').html(),style_na:j('#styaqu_select').val(),base_q:j('#tee_quote_notebase_txt').val(),proid:j('#tee_quote_prob_id').val(),proprice:j('#tee_quote_prob_price').val(),front_print_area:j('.front_print_area').html(),back_print_area:j('.back_print_area').html()}).done(function(data) {//alert(data);
			j.post( "<?php echo get_template_directory_uri(); ?>/<?php echo $ajaxpostsave;?>",function( data ) {
				
					setTimeout(function(){login_close();},5000);
					<?php if($ajaxpostsave=='ajaxproductsavepost.php'){?>
						location.reload();
					<?php }?>
					
			});
			
			});	
}
function checkunicolofront(txt){
	//alert(txt);
			var chaim = new Array();
			var l=0;
			j('#'+txt+' .draggable1').each(function(){
				if(j(this).find('img').attr('src')){
					chaim[l] = j(this).find('img').attr('src')+'+++===imgarr';
				}else{
					chaim[l] = j(this).css('color')+'+++===colarr';
				}
				
				//alert(j(this).find('img').attr('src'));
			l++;});
			//alert(chaim);
			j.post('<?php echo get_template_directory_uri(); ?>/getimagecolor.php', {imgpath:chaim}).done(
		function(data){j('#image_color_front').html('');
			j('#image_color_front').html(data);
			if(j('#image_color_front li').length==0){
				var firldcolo = 0;
			}else if(j('#image_color_front li').length==1){
				var firldcolo = j('#1color').val();
			}else{
				if(j('#image_color_front li').length<10){
					var firldcolo = j('#'+j('#image_color_front li').length+'colors').val();
					j('#imgerrrpdiv').css('display','none');
					j('#imgerrr_front').html('');
				}else if(j('#image_color_front li').length==10){
					var firldcolo = j('#10colors_and_above').val();
					j('#imgerrrpdiv').css('display','none');
				}else{
					j('#imgerrrpdiv').css('display','block');
					j('#imgerrr_back').css('display','none');
					j('#imgerrr_front').html('Please reduce the amount of color you are using to a maximum of ten colors.');
					var firldcolo = 0;
				}
			}
			//alert(firldcolo);
			//if(firldcolo!=0){
//alert(parseFloat(j('#addpriceoldd').val()));alert(j('#tee_quote_prob_price').val());
//alert(firldcolo);alert(j('#image_color li').length);
				var fipri = parseFloat(j('#tee_quote_prob_price').val())-parseFloat(j('#addpriceoldd_front').val())+parseFloat(firldcolo);
			//alert(fipri);
			j('#tee_quote_prob_price').val(fipri.toFixed(2));
			j('#tee_price_preview').html('$'+fipri.toFixed(2));
j('#addpriceoldd_front').val(firldcolo);
			//}
			
			});	
			//alert(chaim);
			//return chaim;
}
function checkunicoloback(txt){
	//alert(txt);
			var chaim = new Array();
			var l=0;
			j('#'+txt+' .draggable1').each(function(){
				if(j(this).find('img').attr('src')){
					chaim[l] = j(this).find('img').attr('src')+'+++===imgarr';
				}else{
					chaim[l] = j(this).css('color')+'+++===colarr';
				}
				
				//alert(j(this).find('img').attr('src'));
			l++;});
			//alert(chaim);
			j.post('<?php echo get_template_directory_uri(); ?>/getimagecolor.php', {imgpath:chaim}).done(
		function(data){j('#image_color_back').html('');
			j('#image_color_back').html(data);
			if(j('#image_color_back li').length==0){
				var firldcolo = 0;
			}else if(j('#image_color_back li').length==1){
				var firldcolo = j('#1color').val();
			}else{
				if(j('#image_color_back li').length<10){
					var firldcolo = j('#'+j('#image_color_back li').length+'colors').val();
					j('#imgerrrpdiv').css('display','none');
					j('#imgerrr_back').html('');
				}else if(j('#image_color_back li').length==10){
					var firldcolo = j('#10colors_and_above').val();
					j('#imgerrrpdiv').css('display','none');
				}else{
					j('#imgerrrpdiv').css('display','block');
					j('#imgerrr_front').css('display','none');
					j('#imgerrr_back').html('Please reduce the amount of color you are using to a maximum of ten colors.');
					var firldcolo = 0;
				}
			}
			//alert(firldcolo);
			//if(firldcolo!=0){
//alert(parseFloat(j('#addpriceoldd').val()));alert(j('#tee_quote_prob_price').val());
//alert(firldcolo);alert(j('#image_color li').length);
				var fipri = parseFloat(j('#tee_quote_prob_price').val())-parseFloat(j('#addpriceoldd_back').val())+parseFloat(firldcolo);
			//alert(fipri);
			j('#tee_quote_prob_price').val(fipri.toFixed(2));
			j('#tee_price_preview').html('$'+fipri.toFixed(2));
j('#addpriceoldd_back').val(firldcolo);
			//}
			
			});	
			//alert(chaim);
			//return chaim;
}
</script>	
<style>
	/*.uploadify-queue{
		border:0px solid #000;
		background:#999999;
		height:auto;
		margin-top:20px;				
	}*/
	.fileName{
		display:inline-block;
		font-size:12px;			
	}
	.cancel{display:none}
	.uploadify-progress-bar{ background:#e63c02;}
	/*.uploadify-button {background:#666666;color:#FFFFFF;font-size:16px;text-align:center;margin:0px;}
	.uploadify-button {
        background-color: transparent;
        border: none;
        padding: 0;
		height:20px;
    }*/
    .uploadify:hover .uploadify-button {
        background-color: transparent;
    }
	
	
		
</style>