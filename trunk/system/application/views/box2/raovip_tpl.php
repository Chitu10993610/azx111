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
<div align="center" class="box2_5_box" >
		<div style="background: transparent url(<?php echo $img_name;?>) no-repeat scroll center center; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous; border:#CCCCCC solid 1px; " class="itemImg"><a href="<?=site_url().'tin-rao/'.$ci_properties['property_type'].'/'.$ci_properties['id']?>/<?=$ci_properties['name_sef']?>" class="itemTitle" id="vip1796432"><img height="80" border="0" width="125" src="<?=base_url()?>images/spacer.gif" title="Xem ảnh"></a></div>
		<div><a><?=price_format($ci_properties['price']) . ' ' . $ci_properties['currency']?> </a></div>
		</div>
<?}?>