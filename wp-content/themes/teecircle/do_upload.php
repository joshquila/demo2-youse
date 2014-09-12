<?php
	//echo "<pre>";
	//print_r($_FILES);
	//echo  "</pre>";
	$base = dirname(__FILE__)."/uploads/";
	$new_file = time().rand(10000,99999)."_".$_FILES['userfile']['name'];
	move_uploaded_file($_FILES['userfile']['tmp_name'],$base.$new_file);
	$arr['size'] = $_FILES['userfile']['size'];
	$arr['old_name'] = $_FILES['userfile']['name'];
	$arr['new_full_path'] = $base.$new_file;
	$arr['new_name'] = $new_file;
	//echo  $_FILES['userfile']['type'];die();
	$ar = explode('.',$_FILES['userfile']['name']);
	$ext = end($ar);
	if(strtoupper($ext)=='EPS'){
		//echo 'c:/ImageMagick/convert.exe -verbose -density 50 "'.$arr['new_full_path'].'" -resize 100% "'.$base.substr($new_file,0,-3).'png'.'"';
		exec('c:/ImageMagick/convert.exe -transparent white "'.$arr['new_full_path'].'" "'.$base.substr($new_file,0,-3).'png'.'"');
		$arr['new_full_path'] = $base.substr($new_file,0,-3).'png';
	}
	$hw = getimagesize($arr['new_full_path']);
	//print_r($hw);
	$arr['height']=$hw[1];
	$arr['width']=$hw[0];	
	echo json_encode($arr);exit();
?>