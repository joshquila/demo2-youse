<?php
/*
Template Name: Ajax Library Images
*/
	
?><!--
<script src="<?php echo get_template_directory_uri() ?>/js/uploadify_31/jquery.uploadify-3.1.min.js" type="text/javascript"></script>-->

<script type="text/javascript">

$(document).ready(function(){
	/*
	$('#upload-file').click(function (e) {
            e.preventDefault();
			//$('.busydiv').css('height',$(window).height()).show();
			alert('ok');
			$('#userfile').uploadify('upload','*');
        });
		var dd="";
	$('#userfile').uploadify({
            'debug':false,
            'auto':true,
			'method':'POST',			
            'swf':  '<?php echo get_template_directory_uri(); ?>/js/uploadify_31/uploadify.swf',
            'uploader': "<?php echo get_template_directory_uri() ?>/do_upload.php",
            'cancelImg': '<?php echo get_template_directory_uri(); ?>/js/uploadify_31/uploadify-cancel.png',
            'fileTypeExts':'*.jpg;*.bmp;*.png;*.tif;*.eps',
            'fileTypeDesc':'Image Files (.jpg,.bmp,.png,.tif,.eps)',
            'fileSizeLimit':'4MB',
            'fileObjName':'userfile',
            'buttonText':'Select Photo',
			'buttonClass' : 'active',
            'multi':true,
            'removeCompleted':true,
			'onSelect':function(){$('.uploadify-queue').show()},
			'onUploadStart' : function(file) {},
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {},
            'onUploadComplete':function(file){},
            'onUploadSuccess' : function(file, data, response) {$('.uploadify-queue').hide();$('#all_image').trigger('click')}
        });
		*/
		$('.clip_artimages').click(function(){
			$.post(
				"<?php echo bloginfo('url')?>/ajax-get-clipart/",
				//"<?php echo get_template_directory_uri(); ?>/ajax_get_clipart.php",
				{
					folderpath : $(this).attr('data-path')
				},
				function(m){
					$('#panel').html(m);
				}
			);
		});
		$('.clip_artimages').trigger('click');
		$('.ediotr_bdy li').click(function(){
			$('.ediotr_bdy li').removeClass('active');
			$(this).addClass('active');
		});
});
</script>				
<style>
	.uploadify-queue{
		border:1px solid #000;
		background:#999999;
		height:auto;
		display:none;
	}
	.fileName{
		display:inline-block;
		font-size:16px;	
	}
	.cancel{display:none}
	.uploadify-progress-bar{ background:#FFFFFF;}
	.uploadify-button {background:#666666;color:#FFFFFF;font-size:16px;text-align:center;margin:5px;}
	.uploadify-button {
        background-color: transparent;
        border: none;
        padding: 0;
    }
    .uploadify:hover .uploadify-button {
        background-color: transparent;
    }
	#panel ul{
		margin:0;
		padding:0;		
	}
	#panel ul li{
		padding: 5px;
		margin:5px;
		display:inline-block;
		cursor: pointer;
	}
	#panel ul li img{
		border:1px solid;
		cursor: pointer;
	}
	
		
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="500">
		<table width="880" cellspacing="10" align="center">
			<tbody>
				<tr>
					<td valign="top" width="250" class="popLft">
						<div class="editor">
							<div class="editor_hdr">Choose Category</div>
<div style="font-size:11px;">Double click on art to add it to your design</div>
							<div class="ediotr_bdy">
							<?php $files=scandir(dirname(__FILE__)."/clip_arts");
							//echo count($files);
							/*echo '<pre>';
							print_r($files);*/?>
								<ul class="mailcatul">
								<?php for($g=0;$g<count($files);$g++){
									if(strstr($files[$g], '.')){}else{?>
								<?php //echo (isset($_GET['a']) && $_GET['a']==1)?'class="active"':''?>
								<li class="mailcatli">
								<?php $filesub=scandir(dirname(__FILE__)."/clip_arts/".$files[$g]);
										for($g1=0;$g1<count($filesub);$g1++){
											if(strstr($filesub[$g1], '.')){$v=0;}else{$v=1;}}?>
										<a href="javascript:void(0)" rel="1" class="cls_cat <?php if($v==0){echo 'clip_artimages';}?>" <?php if($v==0){?>data-path="<?php echo $files[$g];?>"<?php }?>><?php echo ucfirst($files[$g]);?></a>
										<span class="sub">
										<ul>
										<?php
										//echo '<pre>'; 
										//$filesub=scandir(dirname(__FILE__)."/clip_arts/".$files[$g]);
										for($g1=0;$g1<count($filesub);$g1++){
											if(strstr($filesub[$g1], '.')){}else{?>
											<li>
										<a href="javascript:void(0)" rel="1" class="cls_cat clip_artimages" data-path="<?php echo $files[$g].'/'.$filesub[$g1];?>"><?php echo ucfirst($filesub[$g1]);?></a>
										</li><?php }
										}?>
										</ul>
										</span>
									</li>
									
								<?php }}?>
									
									<!--<li <?php echo (isset($_GET['a']) && $_GET['a']==2)?'class="active"':''?>>
										<input type="file" name="userfile" id="userfile"/>
									</li>-->												
								</ul>
							</div>
						</div>
					</td>
					<td width="30"></td>
					<td width="560" class="popRht">
						<div class="panelpop" id="panel" style="overflow:auto">
											
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</td>
  </tr>
</table>

