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
<link rel="stylesheet" href="<?=base_url()?>js/lightbox/css/lightbox.css" type="text/css" media="screen" />
<script src="<?=base_url()?>js/lightbox/lightbox.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
			$(".lightbox").lightbox();
		});
</script>
<div id="content-main"><div class="container">

<div id="picMapBar">
   
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
			<a title="<?=@$ci_properties['attach_files_title'][0]?>" class="lightbox" rel="roadtrip<?=$ci_properties['id']?>" href="<?php echo $img_origin;?>" alt="<?=$ci_properties['name']?>"><img src="<?php echo $img_name;?>" alt="<?=$ci_properties['name']?>" width="55"/></a>
			<?
			if ($n > 1) for($i = 1; $i < $n; $i++) {
				echo '<a title="'.$ci_properties['attach_files_title'][$i].'" href="'.site_url().'images/'.'property/'.$aryImg[$i].'" class="lightbox" rel="roadtrip'.$ci_properties['id'].'"><img src="'.site_url().'images/'.'property/'.$aryImg[$i].'" width=55 style="margin:3px 3px 3px 0px;">'.'</a>';
			}
   }
   else {
   ?>
   <img src="<?php echo site_url().'images/house_no_im.jpg';?>" alt="" width="250"/>
   <?}?>
   <br>
   <div id="gmap" style="width:250px; height:250px; position:relative;"></div>
   </div>
<div id="propertyInfo">
   <h1 class="name"><?=$ci_properties['name']?></h1>
   
   <div id="topInfoPanel">
     <div class="rightCol">
      <div id="housing_contact">
            <table cellspacing="0" cellpadding="0" border="0" class="table_1">
              <tbody><tr>
                <td class="p1"><img border="0" src="<?=site_url()?>images/icons/detail.gif"/>Ngày Đăng</td>
                <td class="p3">:</td>
                <td class="p2"><?=date("d/m/Y", $ci_properties['start_date'])?></td>
              </tr>
              <tr>
                <td class="p1"><img border="0" src="<?=site_url()?>images/icons/detail.gif"/>Nơi Đăng</td>
                <td class="p3">:</td>
                <td class="p2"><?=$ci_properties['province_name']?></td>
              </tr>
              <tr>
                <td class="p1"><img border="0" src="<?=site_url()?>images/icons/detail.gif"/>Hướng</td>
                <td class="p3">:</td>
                <td class="p2">
					<?=$ci_properties['direction']?> 
				</td>
              </tr>
              <tr>
                <td class="p1"><img border="0" src="<?=site_url()?>images/icons/detail.gif"/>Địa chỉ</td>
                <td class="p3">:</td>
                <td class="p2"><?=$ci_properties['address']?> </td>
              </tr>
            </tbody></table>
			</div>
     </div>
     <br class="clearer">
   </div>
   
   <table id="propertyDetails">
      <tbody>
      <tr>
         <th>P.ngủ</th>
         <th>Phụ</th>
         <th>Diện tích</th>
         <th>Giá</th>
      </tr>
      <tr>
         <th><b><?=$ci_properties['bedrooms']?></b></th>
         <th><b><?=$ci_properties['bath']?></b> </th>
         <th><b><?=$ci_properties['square_footage']?></b> m<sup>2</sup></th>
         <th><b><?=price_format($ci_properties['price']) . ' ' . $ci_properties['currency']?><?=($ci_properties['m2'])? "/m<sup>2</sup>":''?> <?=($ci_properties['is_negotiate'])? "(Cho Thương Lượng)":''?></b></th>
      </tr>
   </tbody>
   </table>
   <div id="description">
	   <div class="sub_title">
	   	<p>Thông Tin Mô Tả</p>
	   </div>
      <div class="text"><?=nl2br($ci_properties['infomation'])?></div>
      <?php 
  		if($this->session->userdata('groupid') == 2 || $this->session->userdata('groupid') == 1) {?>
      <div class="text"><b>Phần thông tin riêng: </b><?=nl2br($ci_properties['private_info'])?></div>
      <?}?>
   </div>
   <div class="sub_title">
   		<p>Tiện nghi, cơ sở hạ tầng</p>
   </div>
       <?=str_replace('|', ' &nbsp;&nbsp;&nbsp;<img border="0" src="'.site_url().'images/icons/check.png"/>', substr($ci_properties['amenities'], 0, -1));?>
  	<div class="sub_title">
   		<p>Văn hóa xã hội :</p>
   </div> 
   		<?=str_replace('|', ' &nbsp;&nbsp;&nbsp;<img border="0" src="'.site_url().'images/icons/check.png"/>', substr($ci_properties['culture'], 0, -1));?>
   <div class="sub_title">
   		<p>Thông tin liên hệ :</p>
   </div>
   <table cellspacing="0" cellpadding="0" border="0" class="table_1">
              <tr>
                <td class="p1"> Cty/Cá nhân </td>
                <td class="p3">:</td>
                <td class="p2"><span><?=$ci_properties['contact_name']?></span>  </td>
              </tr>
              <tr>
                <td class="p1"> Điện thoại </td>
                <td class="p3">:</td>
                <td class="p2"><span><?=$ci_properties['contact_phone']?></span>  </td>
              </tr>
              <tr>
                <td class="p1"> Email</td>
                <td class="p3">:</td>
                <td class="p2">
				<a href="<?=$ci_properties['contact_email']?>"><?=$ci_properties['contact_email']?></a>
				</td>
              </tr>
            </tbody></table> 
</div>
<br class="clearer">
<div id="bookmark" style="float:right; width:200px; margin-bottom:10px;">
			<!-- AddThis Button BEGIN -->
			<a href="http://www.addthis.com/bookmark.php?v=250&pub=xa-4a4b668923d2e08c" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/static/btn/lg-bookmark-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js?pub=xa-4a4b668923d2e08c"></script>
			<!-- AddThis Button END -->

		</div><!--bookmark-->
   </div></div>
<div id="backgroundPopup"></div>