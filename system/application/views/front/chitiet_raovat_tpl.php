
<link rel="stylesheet" href="<?=base_url()?>css/style-search.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?=base_url()?>js/lightbox/css/lightbox.css" type="text/css" media="screen" />
<script src="<?=base_url()?>js/lightbox/lightbox.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
			$(".lightbox").lightbox();
		});
</script>

<div style="width:825px; height: auto;line-height:16px; ">
<div style="background:#FECB99;height:20px;"></div>

		
	<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><span style="font-weight:bold;color:#01458E"><?=$ci_properties['name']?></td>
  </tr>
  <td><span>Người đăng:<?=$ci_properties['contact_name']?><br /></span>
				<span>Email:<?=$ci_properties['contact_email']?><br /></span>
				<span>Phạm vi:<?=$ci_properties['province_name']?><br /></span>
				<span>Ngày đăng:<?=date("d/m/Y", $ci_properties['start_date'])?><br /></span>
				<span>Giá:<?=price_format($ci_properties['price']) . ' ' . $ci_properties['currency']?><?=($ci_properties['m2'])? "/m<sup>2</sup>":''?> <?=($ci_properties['is_negotiate'])? "(Cho Thương Lượng)":''?></span></td>
  <td align="right">
  <div align="left"  style=" width:375px;">
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
			<a title="<?=@$ci_properties['attach_files_title'][0]?>" class="lightbox" rel="roadtrip<?=$ci_properties['id']?>" href="<?php echo $img_origin;?>" alt="<?=$ci_properties['name']?>"><img src="<?php echo $img_name;?>" alt="<?=$ci_properties['name']?>" width="55" height="50" style="margin:3px 3px 3px 0px;"/></a>
			<?
			if ($n > 1) for($i = 1; $i < $n; $i++) {
				echo '<a title="'.$ci_properties['attach_files_title'][$i].'" href="'.site_url().'images/'.'property/'.$aryImg[$i].'" class="lightbox" rel="roadtrip'.$ci_properties['id'].'"><img src="'.site_url().'images/'.'property/'.$aryImg[$i].'" width=55 height=50 style="margin:3px 3px 3px 0px;">'.'</a>';
			}
   }
   else {
   ?>
   <img src="<?php echo site_url().'images/house_no_im.jpg';?>" alt="" width="250"/>
   <?}?>
   </div>
   </td>
   <tr>
    <td height="60" colspan="2"><div style="text-align:justify">
				<span style="font-weight:bold"><p>Nội dung</p></span>
				<span style="line-height:20px;"><?=nl2br($ci_properties['infomation'])?></span>
			</div></td>
  </tr>
</table>					  
</div>