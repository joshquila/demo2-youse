<?php
ob_start();
session_start();
require_once("../../../wp-load.php");
    // yes, this is a PHP 5.3 closure, deal with it
	if(isset($_POST['proval']) && !empty($_POST['proval'])&& ($_POST['paval']!='delete')){
		$_SESSION['proval'] = $_POST['proval'];
		$proval=base64_decode(base64_decode($_POST['proval']));
		//echo(base64_decode(base64_decode($_POST['proval'])));
		$query=mysql_query("SELECT * from wp_postmeta where post_id=".$proval);
		/*$data=mysql_fetch_array(mysql_query($query));*/
		$post_data=mysql_fetch_array(mysql_query("Select * from wp_posts where ID=".$proval));
		$post_prod=mysql_query("SELECT b.meta_value,a.ID FROM `wp_posts` as a,`wp_postmeta` as b WHERE a.`post_parent`=".$proval." AND a.ID=b.post_id AND b.meta_key='attribute_pa_style'");
		$_SESSION['proid'] = $proval;
		if(mysql_num_rows($post_prod)>0){
			$v=0;//unset($_SESSION['prostye']);
			while($r=mysql_fetch_assoc($post_prod)){
				/*echo '<pre>';
				echo $v;
				print_r($r);*/
				$_SESSION['prostye'][$v]=$r['meta_value'];
				$v++;
			}
		}
		extract($post_data);
		/*extract($post_data);*/
		/*extract($data);*/
		/*echo '<pre>';
		print_r($data);*/
		//unset($_SESSION['_regular_price']);
		while($data=mysql_fetch_row($query)){
			/*echo '<pre>';
			print_r($data);*/
			if($data[2]=='_manage_pic'){
				$_SESSION['design']=$data[3];
			}else{
				$_SESSION[$data[2]]=$data[3];
			}
			if($data[2]=='_shipping_option'){
				$_SESSION['_shipping_option']=$data[3];
			}
			if($data[2]=='_campain_valid_from'){
				$_SESSION['_campain_valid_from']=$data[3];
			}
			if($data[2]=='_campain_valid_to'){
				$_SESSION['_campain_valid_to']=$data[3];
			}
			if($data[2]=='_regular_price'){
				$_SESSION['_regular_price']=$data[3];
			}
			if($data[2]=='attribute_pa_style'){
				$_SESSION['style_na']=$data[3];
			}
			if($data[2]=='_stock'){
				$_SESSION['base_q']=$data[3];
			}
			if($data[2]=='_price'){
				$_SESSION['proprice']=$data[3];
			}
		}
		$_SESSION['post_title']=$post_title;
		$_SESSION['post_content']=$post_content;
		//http://192.168.1.16/teecircle/product/goos/
		//$a=explode('/',$guid);
		$_SESSION['post_name']=$post_name;//$a[count($a)-2];
		$_SESSION['post_id']=$ID;
		
		/*
		$_SESSION['post_name']=$post_name;
		$_SESSION['_max_variation_sale_price']=$_max_variation_sale_price;
		$_SESSION['_min_variation_sale_price']=$_min_variation_sale_price;
		$_SESSION['_max_variation_regular_price']=$_max_variation_regular_price;
		$_SESSION['_min_variation_regular_price']=$_min_variation_regular_price;
		$_SESSION['_max_variation_price']=$_max_variation_price;
		$_SESSION['_min_variation_price']=$_min_variation_price;
		$_SESSION['_price']=$_price;
		$_SESSION['_manage_stock']=$_manage_stock;
		$_SESSION['_backorders']=$_backorders;
		$_SESSION['_sold_individually']=$_sold_individually;
		$_SESSION['_product_attributes']=$_product_attributes;
		$_SESSION['_sku']=$_sku;
		$_SESSION['_height']=$_height;
		$_SESSION['_width']=$_width;
		$_SESSION['_length']=$_length;
		$_SESSION['_weight']=$_weight;
		$_SESSION['_featured']=$_featured;
		$_SESSION['_purchase_note']=$_purchase_note;
		$_SESSION['_sale_price']=$_sale_price;
		$_SESSION['_regular_price']=$_regular_price;
		$_SESSION['_product_image_gallery']=$_product_image_gallery;
		$_SESSION['_downloadable']=$_downloadable;
		$_SESSION['_stock_status']=$_stock_status;
		$_SESSION['_visibility']=$_visibility;
		$_SESSION['_edit_last']=$_edit_last;
		$_SESSION['_edit_lock']=$_edit_lock;
		$_SESSION['total_sales']=$total_sales;
		$_SESSION['_shipping_option']=$_shipping_option;
		$_SESSION['_campain_valid_to']=$_campain_valid_to;
		$_SESSION['_campain_valid_from']=$_campain_valid_from;
		$_SESSION['_profit_per_pro']=$_profit_per_pro;
		$_SESSION['_is_custom']=$_is_custom;
		$_SESSION['design']=stripslashes(stripslashes($_manage_pic));
		$_SESSION['_manage_stock']=$_manage_stock;
		$_SESSION['_stock']=$_stock;*/
		//$_SESSION['']=;
	/*	echo '<pre>';
		echo"SESSION: ".$_SESSION['guid'];*/
		//print_r($_SESSION);
		
	}
	if(isset($_POST['paval']) && !empty($_POST['paval'])&& ($_POST['paval']=='delete')){
		$my_post = array();
		$my_post['ID'] = base64_decode(base64_decode($_POST['proval']));
		$my_post['post_status'] = 'trash';
		wp_update_post( $my_post );
		echo 'done';
	}

?>
