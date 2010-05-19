<style>
#backgroundPopup{
display:none;
position:fixed;
_position:absolute; /* hack for internet explorer 6*/
height:100%;
width:100%;
top:0;
left:0;
background:#000000;
border:1px solid #cecece;
z-index:1;
}
</style>
<link rel="stylesheet" href="<?=base_url()?>css/style-search.css" type="text/css" media="screen">


<script type="text/javascript"></script>
<script src="<?=base_url()?>js/lightbox/lightbox.js" type="text/javascript"></script>
<div id="content-main"><div class="container">

<div>
   
   <?php 
   $aryImg = array();
   if($ci_properties['attach_files']) {
		$aryImg = $ci_properties['attach_files'];
		$n = sizeof($aryImg);
		$img_origin = '';
			if(stripos($aryImg[0], '/')) {
				$img_name = site_url().'images/common/.thumbs/'.$aryImg[0];
				$img_origin = site_url().'images/common/'.$aryImg[0];
			}
			else {	
				//get image name
				$img_name = substr($aryImg[0], 0, strrpos($aryImg[0], '.'));
				$ext = strrchr($aryImg[0], ".");
				$img_name = $img_origin = site_url().'images/property/'.$img_name.$ext;
			}
		?>
			<a title="<?=@$ci_properties['attach_files_title'][0]?>" class="lightbox" rel="roadtrip<?=$ci_properties['id']?>" href="<?php echo $img_origin;?>" alt="<?=$ci_properties['name']?>"><img src="<?php echo $img_name;?>" alt="<?=$ci_properties['name']?>" width="250"/></a>
			<?
			if ($n > 1) for($i = 1; $i < $n; $i++) {
				echo '<a title="'.$ci_properties['attach_files_title'][$i].'" href="'.site_url().'images/'.'property/'.$aryImg[$i].'" class="lightbox" rel="roadtrip'.$ci_properties['id'].'"></a>';
			}
   }
   else {
   ?>
   <img src="<?php echo site_url().'images/house_no_im.jpg';?>" alt="" width="250"/>
   <?}?>
   <br>
   </div>

   
