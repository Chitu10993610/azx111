<?php foreach ($ci_properties_list as $ci_properties) { ?>	
	<div id="house_newest">
		<div id="house_newest_img">
		<?php 
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
		?>
			<a title="<?=$ci_properties['attach_files_title'][0]?>" href="<?=site_url().'front/'.$ci_properties['id']?>/<?=$ci_properties['name_sef']?>"><img src="<?php echo $img_name;?>" alt="<?=$ci_properties['name']?>" height="80" width="80"/></a>
			<?
   }
   else {
   ?>
   			<a title="" href="<?=site_url().'front/'.$ci_properties['id']?>/<?=$ci_properties['name_sef']?>"><img src="<?php echo site_url().'images/house_no_im.jpg';?>" alt="<?=$ci_properties['name']?>" height="80" width="80"/></a>
   <?}?>
			</div>
		<div id="house_newest_info">
				<span class="sub_title_left"><a href="<?=site_url().'front/'.$ci_properties['id']?>/<?=$ci_properties['name_sef']?>"><?=$ci_properties['name']?></a></span><br />
				Giá: <span><?=$ci_properties['price'] . ' ' . $ci_properties['currency']?></span><br/>DT: <?=$ci_properties['square_footage']?></strong> m<sup>2</sup><br/>Tỉnh: <?=$ci_properties['province_name']?><br/>					
		</div>
	</div>
<!--	<div class="line"></div>-->
<?}?>