<?php
include_once( 'colorsofimage.class.php' );
if(isset($_POST['imgpath']) && !empty($_POST['imgpath'])){
	/*echo '<pre>';
	print_r($_POST['imgpath']);
	die();*/
	$wholearray = array();
	function RGBToHex($r, $g, $b){
	
		$hex = "#";
		$hex.= str_pad( dechex($r), 2, "0", STR_PAD_LEFT );
		$hex.= str_pad( dechex($g), 2, "0", STR_PAD_LEFT );
		$hex.= str_pad( dechex($b), 2, "0", STR_PAD_LEFT );

		return strtoupper($hex);
	}
	        function getcolorname($mycolor, $colorset) {
            $tmpdist = 165;
            $tmpname = array();
    //foreach($colors as $colorname => $colorset) {        
         if(pow($mycolor[0],2)>pow($colorset[0],2))
		{
			$r_dist = (pow($mycolor[0],2) - pow($colorset[0],2));
		}else{
			$r_dist = (pow($colorset[0],2) - pow($mycolor[0],2));
		}
		if(pow($mycolor[1],2)>pow($colorset[1],2))
		{
			$g_dist = (pow($mycolor[1],2) - pow($colorset[1],2));
		}else{
			$g_dist = (pow($colorset[1],2) - pow($mycolor[1],2));
		}
		if(pow($mycolor[2],2)>pow($colorset[2],2))
		{
			$b_dist = (pow($mycolor[2],2) - pow($colorset[2],2));
		}else{
			$b_dist = (pow($colorset[2],2) - pow($mycolor[2],2));
		}
        $totaldist = sqrt($r_dist + $g_dist + $b_dist);
        if ($totaldist < $tmpdist) {        
            return 'same';
        }else{
			return 'not same';
		}
    //}
    //return $tmpname;
}
	foreach($_POST['imgpath'] as $key => $bolanin){
		$vcb = explode('+++===',$bolanin);
		if($vcb[1] == 'imgarr'){
			//foreach($bolan as $bolanin){
				$colors_of_image = new ColorsOfImage( $vcb[0] );
				$colors = $colors_of_image->getColorMap();
				$colorsunique = array_unique($colors);
				foreach($colorsunique as $key1 => $color1 ){
					foreach($colorsunique as $key2 => $color2 ){
						//echo $color1;
						//echo $color2;
						if($color1!=$color2){
					        if(isset($color1) && isset($color2) && ($color1!='#000000') && ($color2!='#000000')){
								$colors1 = $colors_of_image->HexToRGB($color1);
								$colorset = $colors_of_image->HexToRGB($color2);
								$cvgavl = getcolorname($colors1, $colorset);
								if($cvgavl=='same'){
									unset($colorsunique[$key1]);
								}else{}
							}else{}
			           }
		  			}
        		}
				$wholearray = array_merge($wholearray,$colorsunique);
			//}
		}else{
			//foreach($bolan as $bolanin){
				$arra = array();
				$rbcn = explode(',',str_replace(')+++===colarr','',str_replace('rgb(','',$bolanin)));
				$hexty = RGBToHex($rbcn[0],$rbcn[1],$rbcn[2]);
				$arra[$hexty] = $hexty;
				//print_r($arra);
				$wholearray = array_merge($wholearray,$arra);
			//}
		}
	}
	//print_r($wholearray);
	/*die();
	$colors_of_image = new ColorsOfImage( $_POST['imgpath'] );
	$colors = $colors_of_image->getColorMap();
	$lis = '';
	$colorsunique = array_unique($colors);

//echo '<pre>';
//print_r($colorsunique);
		foreach($colorsunique as $key1 => $color1 ){
			foreach($colorsunique as $key2 => $color2 ){
				if($color1!=$color2){
			        //for($i=0;$i<count($colorsunique);$i++){
			           //for($j=$i+1;$j<count($colorsunique);$j++){
					  //print_r($colorsunique);
					   	//echo $color1.'=';
						//echo $color2.'=';
			//unset($colorsunique[1]);
			if(isset($color1) && isset($color2)){
				$colors1 = $colors_of_image->HexToRGB($color1);
				$colorset = $colors_of_image->HexToRGB($color2);
				$cvgavl = getcolorname($colors1, $colorset);
				//echo $cvgavl.'=';
				if($cvgavl=='same'){
					//echo $j.'='.$colorsunique[$j].'=';
					//$colorsunique[$j] = '';
					unset($colorsunique[$key1]);
					//echo 'del<br />';
				}else{
				//echo 'ntdel<br />';
			}
			}else{
				//echo 'ntdel<br />';
			}
			           }
		  }
        }*/
		
	$colorsuniquefinal = array_unique($wholearray);
	//print_r($colorsuniquefinal);
	$lis = '';
	foreach ( $colorsuniquefinal as $key => $color ) :
	if(isset($color) && !empty($color)){
			$lis .='<li style="background:'.$color.'">'.$color.'</li>';	
			}
	endforeach; 
	echo $lis;
	die();
}		
?>