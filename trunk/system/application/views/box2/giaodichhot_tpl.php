<?php 
if(is_array($ci_properties_list)) $n = sizeof($ci_properties_list);
if($n) foreach ($ci_properties_list as $ci_properties) { 
	$d++;
   $aryImg = array();
   if($ci_properties['attach_files']) {
		$aryImg = $ci_properties['attach_files'];
		
		if(stripos($aryImg[0], '/')) {
			$img_name = site_url().'images/common/.thumbs/'.$aryImg[0];
		}
		else {	
			//get image name
			$img_name = substr($aryImg[0], 0, strrpos($aryImg[0], '.'));
			$ext = strrchr($aryImg[0], ".");
			$img_name = site_url().'images/property/'.$img_name.'_small'.$ext;
		}
   }?>
   		
	
 <div style="width:230px; height:45px; margin-left:5px; font-size:11px;margin-top:3px;">
		<div style="background: transparent url(<?php echo $img_name;?>) no-repeat scroll center center; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous; border:#CCCCCC solid 1px;  width:43px; height:45px; overflow:hidden; float:left" class="itemImg"><a href="<?=site_url().'front/'.$ci_properties['id']?>/<?=$ci_properties['name_sef']?>" class="itemTitle" id="vip1796432"><img height="45" border="0" width="43" src="<?=base_url()?>images/spacer.gif" title="Xem ảnh"></a></div>
		<div style=" width:180px; height:45px;  float: right">
			<span style="color:#667089"><a href="<?=site_url().'front/'.$ci_properties['id']?>/<?=$ci_properties['name_sef']?>" style="color:#002445;text-decoration:none;"><?=$this->front_lib->cut_string($ci_properties['name'], 30)?></a></span><br>
			<span><?=$ci_properties['contact_email']?> - <?=$ci_properties['province_name']?></span><br>
			<span>Giá :<span style=" font-weight:bold; color:#FF0000"><?=$ci_properties['price'] . ' ' . $ci_properties['currency']?></span></span>
		</div>
	
</div> 
	<div style="clear:both"></div>  
<?}?>