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
<div style="width:265px;height:100px;border:solid 1px #e7d8d8; float:left; margin-top:10px; margin-left:4px;">
		                 <div style="width:125px;height:90px;float:left;margin-left:4px;margin-top:3px;">
<div style="background: transparent url(<?php echo $img_name;?>) no-repeat scroll center center; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;" class="itemImg"><a href="<?=site_url().'front/'.$ci_properties['id']?>/<?=$ci_properties['name_sef']?>" class="itemTitle" id="vip1796432"><img height="88" border="0" width="88" src="<?=base_url()?>images/spacer.gif" title="Xem ảnh"></a></div>
						 </div>
			             <div style="width:125px;height:90px;float:left;margin-left:4px;margin-top:3px;">
				             <p style="font-size:12px;margin-top:0px;">
							   	<a href="<?=site_url().'front/'.$ci_properties['id']?>/<?=$ci_properties['name_sef']?>" class="title_raovat" ><?=$this->front_lib->cut_string($ci_properties['name'], 60)?></a>
							</p>
				             <p style="font-size:12px;margin-top:-8px;">
								<a href="#" style="color:#FF0000;text-decoration:none;">Nơi đăng:<?=$ci_properties['province_name']?><br>Ngày:<?=date("d/m/Y", $ci_properties['start_date'])?></a>
							</p>
				         </div>
		 </div>	
<?}?>
 <div style="clear: both;"></div>
 <div class="pagination"><?=$page_links?></div>
 