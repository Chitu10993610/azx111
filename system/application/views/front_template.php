<?php // get the view's language correct
	$language = $this->session->userdata('ua_language');
	if ( empty($language) ) {
		if ( $this->config->item('ua_multi_language') ) {
			$language = $this->lang_detect->language();
		} else { 
			$language = $this->config->item('language'); 
		}
		$this->session->set_userdata('ua_language', $language);
	}
	log_message('debug', 'Template: Mini_App Language: - '.$language);
	$this->lang->load('miniapp', $language);
	// set xml:lang
	$lang = 'ua_lang_'.$language;
	$lang = $this->config->item($lang);
	if( empty($lang) ) { $lang = 'en'; }

	// set the character set
	$charset = 'ua_charset_'.$language;
	$charset = $this->config->item($charset);
	if( empty($charset) ) { $charset = 'iso-8859-1'; }
	
	$keyword_df = "tapchiphunu, tin tuc, phu nu, tap chi";
	$description_df = "Cổng thông tin. IHT thiet ke website tot nhat viet nam";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=isset($page_keywords) ? $page_keywords : $keyword_df?>" />
<meta name="description" content="<?=isset($page_description) ? $page_description : $description_df?>" />
<base href="<?=base_url()?>" />
<title>
<?=$title?>
</title>
<?=isset($extraHeadContent)? $extraHeadContent : '';?>
<link rel="stylesheet" href="<?=base_url()?>css/front_style.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?=base_url()?>css/tintuc.css" type="text/css" >
<script type="text/javascript" src="js/jquery123.js" ></script>
<script type="text/javascript" src="<?=base_url()?>js/boxdropdown.js" ></script>
<script type="text/javascript" src="<?=base_url()?>js/functions.js" ></script>
<script type="text/javascript" src="<?=base_url()?>js/iht_ajax.js" ></script>
<script language="javascript">
function sconfirm(strMess,strURL){
	var yn;
	yn=window.confirm(strMess);
	if (yn==true){
		document.location.href=strURL;
		}
}
</script>
</head>
<body>
<div>
  <div class="body">
    <!--  Begin header -->
    <!--BEGIN HEAD -->
    <div class="head">
      <div class="logo"><img src="<?=site_url()?>images/logocty.jpg"></div>
      <div class="baner">
        <?=$ads_header?>
      </div>
    </div>
    <!--END HEAD -->
    <!--GEGIN MENU -->
    <?=$main_menu?>
    <div class="menu_2_bg">
      <?=$sub_menu?>
	<div id="vietbai">
		<a class="menu_2_a" href="<?=site_url()?>front/register">Đăng ký</a> | 
		<a class="menu_2_a" href="<?=site_url()?>news/add">Viết bài</a>
	</div>
			<div class="seo">
		<div class="raovat"><a target="_blank" href="http://tapchithuongmai.net" class="menu_2_a" style=""><img src="<?=site_url()?>images/raovattd.gif"></a></div>
		<form name="search" action="<?=base_url()?>front/search" method="POST"> 	
		<div class="seo_input"><input type="text"  name="keyword" maxlength="50px" id="keyword"/></div> 
		<div class="seo_button" ><input type="image" src="<?=site_url()?>images/timkiem.gif"></div>
		</form>
	</div>
      <div style="display: none; left: 378px; top: 130px;font-size:11px" class="divPopup" id="chooseCity" onMouseOut="overlayclose('chooseCity');" onmousemove="return overlay('chon_tinh','chooseCity', 'rightbottom')" onclick="overlayclose('chooseCity');">
        <div align="center"><a href="./front/chon_city/0">- TOÀN QUỐC -</a></div>
        <div style="float:left; width:90px; margin-left:5px;">
          <div class="Region" style="font-weight:bold">Miền Bắc</div>
          <div class="City">
            <?php 
			 foreach ($provinceOption1 as $aryProvince) {
				$lookupid   = $aryProvince["id"];
				$lookuptext   = $aryProvince["name"];
		?>
            <a href="./front/chon_city/<?=$lookupid?>" style="text-decoration:none;color:#333333">
            <?= $lookuptext; ?>
            </a> <br>
            <?			 
			 } ?>
          </div>
        </div>
        <!--//-->
        <div style="float:left; width:90px; margin-left:5px;">
          <div class="Region" style="font-weight:bold">Miền Nam</div>
          <div class="City">
            <?php 
			 foreach ($provinceOption2 as $aryProvince) {
				$lookupid   = $aryProvince["id"];
				$lookuptext   = $aryProvince["name"];
		?>
            <a href="./front/chon_city/<?=$lookupid?>" style="text-decoration:none;color:#333333">
            <?= $lookuptext; ?>
            </a> <br>
            <?			 
			 } ?>
          </div>
        </div>
        <div style="float:left; width:90px; margin-left:5px;">
          <div class="Region" style="font-weight:bold">Miền Trung</div>
          <div class="City">
            <?php 
			 foreach ($provinceOption3 as $aryProvince) {
				$lookupid   = $aryProvince["id"];
				$lookuptext   = $aryProvince["name"];
		?>
            <a href="./front/chon_city/<?=$lookupid?>" style="text-decoration:none;color:#333333">
            <?= $lookuptext; ?>
            </a> <br>
            <?			 
			 } ?>
          </div>
        </div>
      </div>
    </div>
    <!--END MENU -->
    <!-- BEGIN BODY -->
    <div style="width:1038px;margin-top:3px;">
      <!--BEGIN CONTENT -->
      <div style="width:828px;float:left; ">
		<div class="box1">
          <?=$box1_area?>
          <?=$content?>
        </div>
        <div  style="clear:both"></div> 
        <!--END BOX 1 -->
        <!-- BEGIN BOX 2-->
        <div class="box2">
          <?=$box2_area?>
        </div>
        <!--END BOX 2 -->
        <!--BEGIN BOX 3 -->
        <div class="box3">
          <?=$box3_area?>
        </div>
      </div>
      <div style="width:200px;float:right; background:#CCCCCC">
          <?=$right_area?>
       </div>
          <div style="clear:both"></div>
    </div>
  <!--END BODY -->
  <!--BEGIN FOOTER -->
  <div style="margin:0 auto;padding:0 1px;width:1038px;">
    <div  style="clear:both"></div>
    <div style=" background: url(<?=site_url()?>/images/show_image/bg_film.gif) repeat-x center; width:1038px; height:121px;padding-top:21px;">
      <?=$ads_bottom?>
    </div>
      <?php $this->load->view("footer");?>
  </div>
  <!--END FOOTER -->
  <div style="position: absolute; z-index: 1000; left: -240px; top: 543px;" id="LoadingDiv">
<table cellspacing="1" cellpadding="3" width="160" style="background-color: rgb(102, 102, 102);">
<tbody><tr>
	<td bgcolor="#ffffff" align="center"><img border="0" src="<?=site_url()?>images/loading.gif"/><br/>
	Đang Tải Dữ Liệu....<br/>Nhấn <font color="red"><b>F5</b></font> nếu chờ quá lâu</td>
</tr>
</tbody></table>
</div>
  <div style="clear:both;"></div>
</div>
</div>
</body>
</html>