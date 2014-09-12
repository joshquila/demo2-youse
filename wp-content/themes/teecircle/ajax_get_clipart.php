<?php
/*
Template Name: Ajax Get Clipart
*/

	$base = dirname(__FILE__)."/clip_arts/".$_POST['folderpath']."/";
	$a = glob("$base*.*");
	//print_r($a);
	$images = array();
	$ext_arr = array('JPG','JPEG','GIF','PNG');
	//$files=scandir('clipart/'.$clip_root.'/'.$clipart_style);
	echo "<ul>";
	foreach($a as $k=>$v){
		$x = explode('/',$v);
		$ext = explode('.',$v);
		$images[]=end($x);	
		if(in_array(strtoupper(end($ext)),$ext_arr)){
			echo "<li class='cls_im' data-name='".end($x)."'><img src ='".get_template_directory_uri()."/clip_arts/".$_POST['folderpath']."/".end($x)."' class='cls_clp' width='80'> </li>";
		}	
		
	}
	echo "</ul>";
	//print_r($images);
?>
<script>
	$(document).ready(function(){
		$('.cls_im').dblclick(function(){
			$('#panel').text('Loading....');
			var imgcou = parseInt($('#imagecounter').val())+1;
			
			j('.draggable1').removeClass('cls_selected');
			nonsec(j('.draggable1'));
			var hndl = '<div class="ui-resizable-handle ui-resizable-nw" id="nwgrip"></div><div class="ui-resizable-handle ui-resizable-ne cls_close" id="negrip"></div><div class="ui-resizable-handle ui-resizable-sw" id="swgrip"></div></div>';
			var apt = '#dv_back #text_container';
			if($('#dv_back').css('display')=='none'){
				apt = '#dv_front #text_container';
			}
			var ths = $(this);
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
			var rgb = getAverageRGB(j(this).find('.cls_selected').find('img'));
			$('.fancybox-overlay').trigger('click');
			rotation_handle(j(".cls_selected"));
			//alert($('#image_color li').length);
			/*if($('#image_color li').length==1){
				var firldcolo = '1color';
			}else{
				if($('#image_color li').length<10){
					var firldcolo = $('#image_color li').length+'colors';
				}else{
					var firldcolo = '10colors_and_above';
				}
			}*/
			//alert(firldcolo);
			//alert($('#'+firldcolo).val());
			//var fipri = parseFloat($('#tee_quote_prob_price').val())+parseFloat($('#'+firldcolo).val());
			//alert(fipri);
			//$('#tee_quote_prob_price').val(fipri);
			//$('#tee_price_preview').html('$'+fipri);
			//$('#image_color_inputprice').append('<input type="text" name="imagevan'+imgcou+'"  id="imagevan'+imgcou+'" value="'+parseFloat($('#'+firldcolo).val())+'" />');
			//$('#imagecounter').val(imgcou);
			
		});
	});
</script>