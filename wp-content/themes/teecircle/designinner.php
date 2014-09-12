<?php
/*
Template Name: Design Inner
*/
ob_start();
session_start();
//echo $_SESSION['proid'];
$_SESSION['reditect_page'] = 'demo/';
//echo '<pre>';
//print_r($_SESSION);
?>
<?php get_header('design');
$profit_val = mysql_fetch_array(mysql_query("Select meta_value from wp_postmeta where post_id=460 AND meta_key='profit_margin'"));
/*print_r($profit_val);*/
if(isset($profit_val['meta_value']) && !empty($profit_val['meta_value'])){
	$profitv = $profit_val['meta_value'];
}else{
	$profitv = 0;
}
$_SESSION['profitv'] = $profitv;
 ?>
<?php
	$product_categories = get_terms( 'product_cat');
	//print_r($product_categories);
	?>
<?php
	//$title=$_SESSION['p_title'];
?>	
<input type="hidden" id="userlogintype" value="<?php if(is_user_logged_in()){echo 'loggedin';}else{echo 'log';}?>" />
 <!--Body start-->
      <div class="mainBdy row"> 
        
        <!--Step Bar Sec-->
        <div class="stpBar">
          <div class="secLft">
            <ul class="prg">
              <li  class="actv"><a href="javascript:void(0);" class="clickme3yuin">1. Create your tee</a></li>
              <li class="<?php if(!isset($_REQUEST['val'])){echo 'actv';}?> clickme3sdsf"><a href="javascript:void(0)">2. Set a goal</a></li>
              <li class="clickme3 <?php if(isset($_REQUEST['val']) && !empty($_REQUEST['val']) && ($_REQUEST['val']=='desc')){echo 'actv';}?>"><a href="javascript:void(0)">3. Add a description</a></li>
            </ul>
			<input type="hidden" id="acttype" name="acttype" />
           </div>
          <div class="secRht">
            <ul class="sspSec">
              <li class="save"><a href="javascript:void(0);" onclick="if(j('#userlogintype').val()=='loggedin'){saved();}else{login_now();}j('#acttype').val('save');	">Save</a></li>
             <!-- <li class="share"><a href="javascript:show('shr');">Share</a></li>
              <li class="preview"><a href="javascript:get_preview('<?php echo get_permalink(311); ?>');">Preview</a></li>-->
            </ul>
          </div>
          <div class="clearFix"></div>
        </div>
        <!--Step Bar Sec-->
		<form id="productpost" method="post">
		<div style="width:100%; position:relative; overflow:hidden; margin-top:20px; ">
			<div id="step2nd" <?php if(isset($_REQUEST['val']) && !empty($_REQUEST['val']) && ($_REQUEST['val']=='desc')){?> style="display:none;"<?php }?>>        
			<div style="float:left; width:500px; height:auto;">
			<div class="smlBx">
			<div id="slider-range-min" class="ui-slider">
<!--<span>10</span>
<span>20</span>
<span>30</span>
<span>50</span>
<span>75</span>
<span>100</span>
<span>125</span>
<span>150</span>
<span>175</span>
<span>250</span>
<span>300</span>
<span>350</span>
<span>400</span>-->
<!--<span style="left:0%" class="step"><i></i><a>10</a></span>
<span style="left:7%" class="step"><i></i><a>80</a></span>
<span style="left:14%" class="step"><i></i><a>130</a></span>
<span style="left:21%" class="step"><i></i><a>190</a></span>
<span style="left:29%" class="step"><i></i><a>260</a></span>
<span style="left:36%" class="step"><i></i><a>320</a></span>
<span style="left:43%" class="step"><i></i><a>390</a></span>
<span style="left:50%" class="step"><i></i><a>440</a></span>
<span style="left:57%" class="step"><i></i><a>500</a></span>
<span style="left:64%" class="step"><i></i><a>570</a></span>
<span style="left:71%" class="step"><i></i><a>630</a></span>
<span style="left:79%" class="step"><i></i><a>700</a></span>
<span style="left:86%" class="step"><i></i><a>770</a></span>
<span style="left:93%" class="step"><i></i><a>830</a></span>-->

<span style="left:0%" class="step"><i></i><a>10</a></span>
<!-- <span style="left:2.5641%" class="step"><i></i><a>20</a></span> -->
<span style="left:5.12821%" class="step"><i></i><a>30</a></span>
<span style="left:10.2564%" class="step"><i></i><a>50</a></span>
<span style="left:16.6667%" class="step"><i></i><a>75</a></span>
<span style="left:23.0769%" class="step"><i></i><a>100</a></span>
<span style="left:29.4872%" class="step"><i></i><a>125</a></span>
<span style="left:35.8974%" class="step"><i></i><a>150</a></span>
<span style="left:42.3077%" class="step"><i></i><a>175</a></span>
<span style="left:48.7179%" class="step"><i></i><a>200</a></span>
<span style="left:61.5385%" class="step"><i></i><a>250</a></span>
<span style="left:74.359%" class="step"><i></i><a>300</a></span>
<span style="left:87.1795%" class="step"><i></i><a>350</a></span>
<span style="left:100%" class="step"><i></i><a id="lastslide">400</a></span>

</div>
<p>$<span id="baseprival"><?php echo $_SESSION['proprice'];?></span> base price per tee with a goal of <input type="hidden" id="amount" name="amount" class="inptbx" value="<?php echo $_SESSION['base_q'];?>">
 <input type="text" name="amountvb" id="amountvb" value="<?php echo $_SESSION['base_q'];?>" class="inptbx" onkeyup="checkvalslider(this.value);" /><!--<span id="amountvb"><?php echo $_SESSION['base_q'];?></span>--></p>
<p>Your goal is the minimum number of shirts that need to be reserved before the shirts are printed!</p>
</div>

<div class="smlBx">
<h3>Selling price</h3>
<?php //var_dump($_SESSION);?>
<p><input type="text" id="amountset" name="amountset" class="inptbx" value="$<?php echo ($_SESSION['proprice']+$profitv);?>" onblur="return checkspr(this);" /></p>
<p id="sellingb">With a price of $<?php echo ($_SESSION['proprice']+$profitv);?> your profit is $<?php echo $profitv;?> per tee</p><input type="hidden" id="profamt" name="profamt" value="<?php echo $profitv;?>"/>
</div>
<div class="smlBx">
<h3>Estimated profit</h3>
<p>If you reach your goal of <input type="hidden" id="amount2" name="amount2" class="inptbxSml"><span id="amount2span"></span> with a price of <span id="amount2spanorf">$<?php echo ($_SESSION['proprice']+$profitv);?></span></p>
<p> <span style="font-size:17px;">You will make at least profit of</span> <br /> <br /><input type="hidden" id="amount1" name="amount1" class="inptbx"><span id="amount1sp" style="font-size: 34px; color: green; font-weight: bold;"></p>
<p><input type="button" class="clickme2 clickme3 cmnBtn" value="Next Step" /></p>
</div>


</div>
<div style="float:right; width:500px; ">
<div class="dsgnCen notindesign" style="position:relative;">
<?php echo stripslashes(stripslashes($_SESSION["design"]));?>
</div>
</div>
</div>
<div id="step3rd" style="float:left; background:#fff;" >        
<div style="float:left; width:500px; height:auto;">
<div class="smlBx">
<h3>Campaign title</h3>
<?php
//var_dump($_SESSION);
?>
<input type="text" name="campain_title" id="campain_title" class="txtartxt" maxlength="40" value="<?php if(isset($_SESSION['post_title']) && !empty($_SESSION['post_title'])){echo $_SESSION['post_title'];}?>" />
<div id="campain_title_err" class="redTxt"></div>
<p>Summarize your campaign in 40 characters or less</p>
</div>
<script src="<?php echo get_template_directory_uri(); ?>/js/ckeditor/ckeditor.js"></script>
<div class="smlBx">
<h3>Description</h3>
<div id="description_err" class="redTxt"></div>
<textarea name="description" class="txtar ckeditor" id="description"><?php if(isset($_SESSION['post_content']) && !empty($_SESSION['post_content'])){echo $_SESSION['post_content'];}?></textarea>
</div>

<div class="smlBx">
<h3>Campaign Length</h3>
<?php
if(isset($_SESSION['_campain_valid_from'])){
	$t=$_SESSION['_campain_valid_from'];
	$t2=$_SESSION['_campain_valid_to'];
	$diff=abs($t2-$t);
	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days=floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24))+1;
}
//echo "<br/>Compain Valid For $days days.".date('Y-m-d',$t);
?>
<select name="campain_length" class="drpdwn">
<option value="<?php echo strtotime("+3 day", time());?>" <?php if($days==3){echo 'selected="selected"';}?>>3 Days (Ending <?php echo date('l, M. d', strtotime("+3 day", time()));?>)</option>
<option value="<?php echo strtotime("+5 day", time());?>" <?php if($days==5){echo 'selected="selected"';}?>>5 Days (Ending <?php echo date('l, M. d', strtotime("+5 day", time()));?>)</option>
<option value="<?php echo strtotime("+9 day", time());?>" <?php if($days==9){echo 'selected="selected"';}?>>9 Days (Ending <?php echo date('l, M. d', strtotime("+9 day", time()));?>)</option>
<option value="<?php echo strtotime("+10 day", time());?>" <?php if($days==10){echo 'selected="selected"';}?>>10 Days (Ending <?php echo date('l, M. d', strtotime("+10 day", time()));?>)</option>
<option value="<?php echo strtotime("+16 day", time());?>" <?php if($days==16){echo 'selected="selected"';}?>>16 Days (Ending <?php echo date('l, M. d', strtotime("+16 day", time()));?>)</option>
<option value="<?php echo strtotime("+23 day", time());?>" <?php if($days==23){echo 'selected="selected"';}?>>23 Days (Ending <?php echo date('l, M. d', strtotime("+23 day", time()));?>)</option>
</select>
</div>
<?php /*if(isset($_SESSION['post_name'])&& !empty($_SESSION['post_name'])){?>
<div class="smlBx">
<h3>Product URL</h3>
<div><p class="cdhurl"><?php echo bloginfo ('url').'/product/';?><?php echo$_SESSION['post_name']; ?></p>
<div class="clearFix"></div>
	</div>
<div id="choose_url_err" class="redTxt"></div>
<div id="msgs"></div>
</div>
<input type="hidden" name="choose_url" id="choose_url" class="txtarall" value="<?php echo$_SESSION['post_name']; ?>"/>
<?php }else{*/?>
<div class="smlBx">
<h3>Choose a URL</h3>
<div><p class="cdhurl"><?php echo bloginfo ('url').'/product/';?></p>
		<input type="text" name="choose_url" id="choose_url" onkeyup="return checks();" class="txtarall" value="<?php echo $_SESSION['post_name']; ?>"/>
	</div>
<div id="choose_url_err" class="redTxt"></div>
<div id="msgs"></div>
</div>	
<?php /*}*/?>


<div class="smlBx">
<h3> Shipping options</h3>
<p><input type="checkbox" name="shipping_options" value="yes" <?php if(isset($_SESSION['_shipping_option'])&&!empty($_SESSION['_shipping_option']) && $_SESSION['_shipping_option']=='yes'){echo'checked="checked"';} ?> />Allow buyers to pick-up their orders from you (pickup shipping is free)</p>
</div>

<div class="smlBx">
<h3> Add additional products</h3>
<p>You will make at least <span id="nxpp"><?php echo $profitv;?></span> profit on any item you sell and all sales count towards reaching your goal! </p>
<?php $product_categories = get_terms( 'product_cat');?>
<ul class="chkLst">
<?php 
//echo $_SESSION['style_na'];
//print_r($product_categories);
//$styorg = explode('==++==',$_SESSION['style_na']);print_r($styorg);
$de = 0;
foreach($product_categories as $key => $pc){//echo $pc->term_id;//print_r($pc);
	if($pc->term_id!=$_SESSION['style_na']){
	$args = array(
        'post_type' => 'product',
        'product_cat' => $pc->name,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_featured',
                'value' => 'yes'
            )
        )
    );
	$loop = new WP_Query( $args );
	/*echo '<pre>';
	print_r($loop);echo '</pre>';*/
	while ( $loop->have_posts() ) {$de=1; $loop->the_post();global $product;?>
	<li><input type="checkbox" name="prostye[]"<?php if(isset($_SESSION['prostye']) && count($_SESSION['prostye'])>0 && in_array($pc->slug,$_SESSION['prostye'])){echo"checked='checked'";}  ?> value="<?php echo $pc->slug;?>" /><?php echo the_title()/*.' '.$pc->name*/;?> (selling price $<span id="<?php echo $pc->slug;?>" class="stypric"><?php echo $product->get_price()+$profitv; ?></span>)<input type="hidden" name="propric[]" value="<?php echo $product->get_price()+$profitv; ?>" id="<?php echo $pc->slug;?>price" />
	<input type="hidden" name="proidval[]" value="<?php echo $product->id; ?>" id="<?php echo $pc->slug;?>proidval" /></li>
	<?php }}} 
	if($de==0){?>
		<li><b style="color: red;">No Additional Products are avalible for this product</b></li>
	<?php }?>
</ul>
</div>

<div class="smlBx">
<div id="agreetermer" class="redTxt"></div>
<p><input type="checkbox" name="agree_term" id="agree_term" value="yes"/>I have read and agree to the terms of service (TOS), and can confirm that the images, slogans, and content used in my campaign do not infringe upon the rights of any third party.</p>

<input type="button" onClick=" return submitter();"  value="Launch campaign" class="clickme2 cmnBtn" /><!-- or <a href="javascript:get_preview('<?php echo get_permalink(311); ?>')">Preview</a>-->
</div>


</div>
<div style="float:right;width:500px;">
<div class="dsgnCen notindesign" style="position:relative;">
<?php echo stripslashes(stripslashes($_SESSION['design']));?></div>
</div>
</div>  
</div>     <!-- <input type="hidden" name="uid" value="<?php echo get_current_user_id( );?>" />-->
        </form>
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
		<div class="rgstrFrm" id="loaderdiv" style="display:none;">
			<div class="titl">Saving your design!!<span class="loader"></span></div>
		</div>
	</div>
</div>


<?php get_footer('inner'); ?> 


<!--<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/source/jquery.fancybox.css">

<script type="text/javascript">
var j = jQuery.noConflict();
function checkspr(txt){//alert(txt);
	j.post( "<?php echo get_template_directory_uri(); ?>/ajaxpricech.php",{checkp:txt.value},function( data ) {
		//alert(data);
				var sfgs = data.split('++++');
				j('#amountset').val(sfgs[0]);
				j('#sellingb').html(sfgs[1]);
				j('#amount2spanorf').html(sfgs[0]);
				j('#profamt').val(sfgs[2]);j('#nxpp').html(sfgs[2]);
				j( "#amount1" ).val(  "$" + parseFloat(j( "#amount" ).val()*j('#profamt').val()).toFixed(2) );
	j( "#amount1sp" ).html(  "$" + parseFloat(j( "#amount" ).val()*j('#profamt').val()).toFixed(2) );
	j('.stypric').each(function(){
		j(this).html((parseFloat(j(this).html())+parseFloat(sfgs[2])).toFixed(2));
		j('#'+j(this).attr('id')+'price').val((parseFloat(j('#'+j(this).attr('id')+'price').val())+parseFloat(sfgs[2])).toFixed(2));
	});
				
							});	
	}
j(document).ready(function()	
{
	<?php if(isset($_REQUEST['val']) && !empty($_REQUEST['val']) && ($_REQUEST['val']=='desc')){?> 
j( "#step3rd" ).show();<?php }else{?>
	j( "#step3rd" ).hide();<?php }?>
	j('.mobileMenu .mmnu').hide();
	j('.mobile_nav').click(function(){
	j('.mobileMenu .mmnu').fadeToggle();
	});
		 
	j( "#slider-range-min" ).slider({
	range: "min",
	value: "<?php echo $_SESSION['base_q'];?>",
	min: 10,
	max: 400,
	slide: function( event, ui ) {
		j( "#amount" ).val( ui.value );
	j( "#amountvb" ).val( ui.value );
	j( "#amount2" ).val( ui.value );
	j("#amount2span").html( ui.value );
	j( "#amount1" ).val( "$" + parseFloat(j('#profamt').val()*j( "#amount" ).val()).toFixed(2) );
	//alert(j('#profamt').val());alert(ui.value);
	j( "#amount1sp" ).html( "$" + parseFloat(j('#profamt').val()*j( "#amount" ).val()).toFixed(2) );
		
	/*j.post('<?php echo get_template_directory_uri(); ?>/getprodbaseprice.php', {prodifg:ui.value}).done(function(data) {alert(data);
	j( "#baseprival" ).html( data );
	var prob = '<?php echo $profitv;?>';
	//alert(prob);
	//alert(parseFloat(data)+parseFloat(prob));
	j('#amountset').val('$'+(parseFloat(data)+parseFloat(prob)).toFixed(2));
	j('#amount2spanorf').html('$'+(parseFloat(data)+parseFloat(prob)).toFixed(2));
	
 });
	j( "#amount" ).val( ui.value );
	j( "#amountvb" ).html( ui.value );
	j( "#amount2" ).val( ui.value );
	j("#amount2span").html( ui.value );
	j( "#amount1" ).val( "$" + parseFloat(j('#profamt').val()*j( "#amount" ).val()).toFixed(2) );
	//alert(j('#profamt').val());alert(ui.value);
	j( "#amount1sp" ).html( "$" + parseFloat(j('#profamt').val()*j( "#amount" ).val()).toFixed(2) );*/
	
	},
	stop:function( event, ui ) {
		j.post('<?php echo get_template_directory_uri(); ?>/getprodbaseprice.php', {prodifg:ui.value}).done(function(data) {//alert(data);
	j( "#baseprival" ).html( data );
	var prob = '<?php echo $profitv;?>';
	//alert(prob);
	//alert(parseFloat(data)+parseFloat(prob));
	j('#amountset').val('$'+(parseFloat(data)+parseFloat(prob)).toFixed(2));
	j('#amount2spanorf').html('$'+(parseFloat(data)+parseFloat(prob)).toFixed(2));
	
 });
	j( "#amount" ).val( ui.value );
	j( "#amountvb" ).val( ui.value );
	j( "#amount2" ).val( ui.value );
	j("#amount2span").html( ui.value );
	j( "#amount1" ).val( "$" + parseFloat(j('#profamt').val()*j( "#amount" ).val()).toFixed(2) );
	//alert(j('#profamt').val());alert(ui.value);
	j( "#amount1sp" ).html( "$" + parseFloat(j('#profamt').val()*j( "#amount" ).val()).toFixed(2) );
		
	}
	});
	
	j( "#amount" ).val( j( "#slider-range-min" ).slider( "value" ) );
	j( "#amountvb" ).val( j( "#slider-range-min" ).slider( "value" ) );
	j( "#amount2" ).val( j( "#slider-range-min" ).slider( "value" ) );
	//alert(j("#amount2span").html());
	j("#amount2span").html( j( "#slider-range-min" ).slider( "value" ) );
	
	j( "#amount1" ).val(  "$" + parseFloat(j( "#amount" ).val()*j('#profamt').val()).toFixed(2) );
	j( "#amount1sp" ).html(  "$" + parseFloat(j( "#amount" ).val()*j('#profamt').val()).toFixed(2) );
	j( ".clickme2" ).click(function() {
		j.post( "<?php echo get_template_directory_uri(); ?>/set_session.php",j('#productpost').serialize(),function( data ) {//alert(data);
				
				});	
	});
	j( ".clickme3yuin" ).click(function() {
		j.post( "<?php echo get_template_directory_uri(); ?>/set_session.php",j('#productpost').serialize(),function( data ) {//alert(data);
				window.location='<?php echo get_permalink( 34 ); ?>';
				});	
	});
	
	/*j( ".clickme2" ).click(function() {
	//j( "#step2nd" ).hide();
	j( "#step2nd" ).css({'display':'inline-block;','z-index':'0'});
	j( "#step3rd" ).css({'display':'inline-block;','z-index':'1000','position':'absolute','left':'990px'});
	j( "#step3rd" ).animate({
	left: 0+"%",
	height: "toggle"
	}, 1000, function() {
	j('.prg li').removeClass('actv');
	j('.prg li').eq(2).addClass('actv');
	j( "#step2nd" ).hide();
	j( "#step3rd" ).css({'display':'inline-block;','z-index':'0','position':'relative','height':'auto'});
	});
	});*/
	
	j( ".clickme3" ).click(function() {
	//j( "#step2nd" ).hide();
	j( "#step2nd" ).css({'display':'inline-block;','z-index':'0'});
	j( "#step3rd" ).css({'display':'inline-block;','z-index':'1000','position':'absolute','left':'990px'});
	j( "#step3rd" ).animate({
	left: 0+"%",
	height: "toggle"
	}, 1000, function() {
	//j('.prg li').removeClass('actv');
	j('.prg li').eq(2).addClass('actv');
	j( "#step2nd" ).hide();
	j( "#step3rd" ).css({'display':'inline-block;','z-index':'0','position':'relative'});
	});
	});
	j( ".clickme3sdsf" ).click(function() {
	//j( "#step2nd" ).hide();
	j( "#step2nd" ).css({'display':'inline-block;','z-index':'1000','position':'absolute','left':'990px'});
	j( "#step3rd" ).css({'display':'inline-block;','z-index':'0'});
	j( "#step2nd" ).animate({
	left: 0+"%",
	height: "toggle"
	}, 1000, function() {
	j('.prg li').eq(1).addClass('actv');
	//j('.prg li').eq(2).removeClass('actv');
	j( "#step2nd" ).css({'display':'inline-block;','z-index':'0','position':'relative'});
	j( "#step3rd" ).hide();
	});
	});

		
});

	

</script>
<style>
	#text_container{
		top:75px;
		left:117px;
		position:absolute;
		border:1px solid;
		height:350px;
		width:200px;
		overflow:hidden;
	}
	.draggable1{
		border:0px solid;
		max-width: inherit;
		border:1px solid;
		cursor: move;
		width: auto;
		min-height:20px;	
		overflow:hidden;
		transform:rotate(0deg);
		-ms-transform:rotate(0deg); /* IE 9 */
		-webkit-transform:rotate(0deg);
	}
	.draggable1:hover{
		border:1px dashed
	}
	.cls_selected{
		border:1px dashed green;
	}
	.ui-resizable-helper { border: 2px dotted #00F; }
	.colorpalet {
		padding: 0;
		margin: 0;
		}
	.colorpalet span{	
		list-style-type: none;
		height: 12px;
		width: 12px;
		border: 1px solid #000;
		display: inline-block;
		cursor: pointer;
		padding: 0px;
	}
	.cls_close{
		background:#000 url("../images/close1.png") no-repeat top left;
		position:absolute;
		top:-5px;
		right:-5px;
		height:16px;
		width:16px;
		cursor:pointer;
		border:1px solid;
	}	
</style>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.css">
<?php if(isset($_SESSION['post_id'])&& !empty($_SESSION['post_id'])){
	$ajaxpost = 'editajaxproductpost.php';
	$ajaxpostsave = 'editajaxproductsavepost.php';
}else{
	$ajaxpost = 'ajaxproductpost.php';
	$ajaxpostsave = 'ajaxproductsavepost.php';
}?>
<!--<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
<script type="text/javascript">
function submitter(){
	j('.redTxt').html('');
	j('#description').val(CKEDITOR.instances['description'].getData());
	//alert(j('#description').val());
	if(j('#campain_title').val()==''){
		//alert(CKEDITOR.instances['description'].getData());
		j('#campain_title_err').html('This field is required.');
		j('#campain_title').focus();
	}else
	if(j('#campain_title').val()=='Untitled'){
		j('#campain_title_err').html('This field is required.');
		j('#campain_title').focus();
	}else
	if(j('#description').val()==''){
		//alert(j('.cke_editable cke_editable_themed cke_contents_ltr p').html());
		j('#description_err').html('This field is required.');
		j('#description').focus();
	}else
	if(j('#choose_url').val()==''){
		j('#choose_url_err').html('This field is required.');
		j('#choose_url').focus();
	}else
	if(!j('#agree_term').is(":checked")){
		j('#agreetermer').html('Please agree to the terms of service before proceeding.');
		j('#agree_term').focus();
	}else{
		show('loaderdiv');j('.login .crsIcn').hide()
		j.post( "<?php echo get_template_directory_uri(); ?>/ajaxproductcheck.php",{name:j('#choose_url').val()},function( data ) {
			if(data==0){	
			if(j('#userlogintype').val()=='loggedin'){
			j.post( "<?php echo get_template_directory_uri(); ?>/<?php echo $ajaxpost;?>",j('#productpost').serialize(),function( data ) {//alert(data);
					
					var shecjty = j('#choose_url').val();
					setTimeout(function(){window.location = '<?php echo bloginfo ('url')."/product/"; ?>'+shecjty;},5000);
				});
				}else{
					j('#loaderdiv').css('display','none');
					login_now();
				}		
				
				}else{
					j('.login').css('display','none');j('.fade').css('display','none');
					j('#choose_url_err').html('This URL already exists.');
					j('#choose_url').focus();
				}
		});
		}	
}
function saved(){
	
	//j('.prg li').eq(2).addClass('actv');
	//j( "#step2nd" ).hide();
	//j( "#step3rd" ).show();
	/*j( "#step3rd" ).animate({
	left: 0+"%",
	height: "toggle"
	}, 1000, function() {
	//j('.prg li').removeClass('actv');
	j('.prg li').eq(2).addClass('actv');
	j( "#step2nd" ).hide();
	j( "#step3rd" ).css({'display':'inline-block;','z-index':'0','position':'relative'});
	});*/
	
	/*j('.redTxt').html('');
	if(j('#campain_title').val()==''){
		j('#campain_title_err').html('This field is required.');
		j('#campain_title').focus();
	}else
	if(j('#choose_url').val()==''){
		j('#choose_url_err').html('This field is required.');
		j('#choose_url').focus();
	}else*/
	if(j('#choose_url').val()!=''){
		show('loaderdiv');j('.login .crsIcn').hide()
		j.post( "<?php echo get_template_directory_uri(); ?>/ajaxproductcheck.php",{name:j('#choose_url').val()},function( data ) {
			if(data==0){
				j('#choose_url_err').html('');
				if(j('#userlogintype').val()=='loggedin'){
			j.post( "<?php echo get_template_directory_uri(); ?>/<?php echo $ajaxpostsave;?>",j('#productpost').serialize(),function( data ) {
				//j('.login').css('display','none');j('.fade').css('display','none');
				//location.reload();
				setTimeout(function(){location.reload();},5000);
				});
				}else{
					j('#loaderdiv').css('display','none');
					login_now();
				}
			}else{
			j('.login').css('display','none');j('.fade').css('display','none');
					j('#choose_url_err').html('This URL already exists.');
					j('#choose_url').focus();
			}
		});	
	/*}else{
	alert('Fill up Form data');
	}*/	}else{
		show('loaderdiv');j('.login .crsIcn').hide()
				j('#choose_url_err').html('');
				if(j('#userlogintype').val()=='loggedin'){
			j.post( "<?php echo get_template_directory_uri(); ?>/<?php echo $ajaxpostsave;?>",j('#productpost').serialize(),function( data ) {
				//j('.login').css('display','none');j('.fade').css('display','none');
				setTimeout(function(){location.reload();},5000);
				});
				}else{
					j('#loaderdiv').css('display','none');
					login_now();
				}
	}
}
function checks(){		
	j.post( "<?php echo get_template_directory_uri(); ?>/ajaxproductcheck.php",{name:j('#choose_url').val()},function( data ) {
			if(data==0){
				j('#msgs').html('<strong>Available</strong>');
			}else{
				j('#msgs').html('<strong>Not Available</strong>');
			}
		});
}
function login_now(){
j.post( "<?php echo get_template_directory_uri(); ?>/set_session.php",j('#productpost').serialize(),function( data ) {
j('.fade').show();
j('.login').show();
j('#logch').show();
});
}
function login_close(){
j('.fade').hide();
j('.login').hide();
j('.login > div').hide();
}
function show(div){
j('.fade').show();
j('.login').show();
j('.login > div').hide();
j('.login .crsIcn').show();
j('#'+div).show();
j('#'+div+' > div').show();
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
					if(j('#acttype').val()=='save'){
						//j('.login').css('display','none');j('.fade').css('display','none');
						saved();
						//alert('ff');
					}else{
						j.post( "<?php echo get_template_directory_uri(); ?>/<?php echo $ajaxpost;?>",j('#productpost').serialize(),function( data ) {//alert(data);
					
					var shecjty = j('#choose_url').val();
					window.location = '<?php echo bloginfo ('url')."/product/"; ?>'+shecjty;
				});
					}
					
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
					if(j('#acttype').val()=='save'){//alert('ll');
						//j('.login').css('display','none');j('.fade').css('display','none');
						saved();
						
						//alert('ff');
					}else{
						j.post( "<?php echo get_template_directory_uri(); ?>/<?php echo $ajaxpost;?>",j('#productpost').serialize(),function( data ) {//alert(data);
					
					var shecjty = j('#choose_url').val();
					window.location = '<?php echo bloginfo ('url')."/product/"; ?>'+shecjty;
				});
					}
					
					
				}else{
					j('#inverrreg').html(data);
					
					//alert(data);
					return false;
				}
			});
	}
}
function get_preview(url){
//alert(url);
}
j('#step2nd #id-seeBack').click(function(){
			j('#step2nd #dv_front').hide();
			j('#step2nd #dv_back').show();
			j('#step2nd #txt_add').val('').removeClass('cls_edit');
			j('#step2nd .cls_selected').removeClass('cls_selected');
		});
j('#step3rd #id-seeBack').click(function(){
			j('#step3rd #dv_front').hide();
			j('#step3rd #dv_back').show();
			j('#step3rd #txt_add').val('').removeClass('cls_edit');
			j('#step3rd .cls_selected').removeClass('cls_selected');
		});
		j('#step2nd #id-seeFront').click(function(){
			j('#step2nd #dv_back').hide();
			j('#step2nd #dv_front').show();
			j('#step2nd #txt_add').val('').removeClass('cls_edit');
			j('#step2nd .cls_selected').removeClass('cls_selected');
		});
		j('#step3rd #id-seeFront').click(function(){
			j('#step3rd #dv_back').hide();
			j('#step3rd #dv_front').show();
			j('#step3rd #txt_add').val('').removeClass('cls_edit');
			j('#step3rd .cls_selected').removeClass('cls_selected');
		});
		function checkvalslider(val){//alert(val);
			if(val>400){
				j('.ui-slider-range-min').css('width','100%');
				j('.ui-slider-handle').css('left','100%');
				j('#lastslide').html(val);
			}else{
				j( "#slider-range-min" ).slider({
					value: val
					});
					j('#lastslide').html(400);
					j.post('<?php echo get_template_directory_uri(); ?>/getprodbaseprice.php', {prodifg:val}).done(function(data) {//alert(data);
	j( "#baseprival" ).html( data );
	var prob = '<?php echo $profitv;?>';
	//alert(prob);
	//alert(parseFloat(data)+parseFloat(prob));
	j('#amountset').val('$'+(parseFloat(data)+parseFloat(prob)).toFixed(2));
	j('#amount2spanorf').html('$'+(parseFloat(data)+parseFloat(prob)).toFixed(2));
	
 });
	j( "#amount" ).val(val );
	j( "#amountvb" ).val( val );
	j( "#amount2" ).val( val );
	j("#amount2span").html( val );
	j( "#amount1" ).val( "$" + parseFloat(j('#profamt').val()*j( "#amount" ).val()).toFixed(2) );
	//alert(j('#profamt').val());alert(ui.value);
	j( "#amount1sp" ).html( "$" + parseFloat(j('#profamt').val()*j( "#amount" ).val()).toFixed(2) );
		
	
			}
			
		}
</script>