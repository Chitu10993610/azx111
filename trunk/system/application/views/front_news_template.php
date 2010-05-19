<?php  // get the view's language correct
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
	$description_df = "Cổng thông tin về phụ nữ. IHT thiet ke website tot nhat viet nam";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=isset($page_keywords) ? $page_keywords : $keyword_df?>" />
<meta name="description" content="<?=isset($page_description) ? $page_description : $description_df?>" />
<base href="<?=base_url()?>" />
<title><?=$title?></title>
<?=isset($extraHeadContent)? $extraHeadContent : '';?>
<link rel="stylesheet" href="<?=base_url()?>css/front_style.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?=base_url()?>css/tintuc.css" type="text/css" >
<link rel="stylesheet" href="<?=base_url()?>css/style_news.css" type="text/css" >
<link rel="stylesheet" href="<?=base_url()?>css/style_news_right.css" type="text/css" >
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
      <div class="baner"><?=$ads_header?></div>
    </div>
    <!--END HEAD -->
     <!--GEGIN MENU -->
    <div class="menu_top_bg">
      <div class="menu_top_left" >
        <div class="menu_top_right" >
          <ul class="menu_top_ul">
                    <?php 
       $current_cat_id =$this->uri->segment(4, 0);
foreach ($typemenu1 as $aryMenu) {

$menuid   = $aryMenu["id"];
$menuname   = $aryMenu["name"];
?>  
          <li class="menu_top_li">  <a class="menu_top_a" <?if($menuid==$current_cat_id){?>id="vuchivy"<?} ?> href="<?=$aryMenu["url"];?>">
            <?= $menuname ?>
            </a>  </li>
            <? 
} ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="menu_2_bg">
      <?=$sub_menu?>
      <?php if(!$sub_menu){ ?>
      <div class="menu_2" >
        <ul class="menu_2_ul" >
          <?php 
			  $current_cat_id =$this->uri->segment(4, 0);
          foreach ($typemenu2 as $aryMenu) {
			 
				$menuid   = $aryMenu["id"];
				$menuname   = $aryMenu["name"];
		?>
          <li class="menu_2_li"> <a class="menu_2_a" <?if($menuid==$current_cat_id){?>id="vuchivy"<?}?> href="<?=$aryMenu["url"];?>">
            <?=$menuname ?>
            </a> </li>
          <?			 
			 } ?>
        </ul>

       </div>
       			<div class="seo">
				<div class="raovat"><a target="_blank" href="http://tapchithuongmai.net" class="menu_2_a" ><img src="<?=site_url()?>images/raovattd.gif"></a></div>
				<form name="search" action="<?=base_url()?>front/search" method="POST"> 	
				<div class="seo_input"><input type="text"  name="keyword" maxlength="50px" style="border:1px #CCCCCC solid; width:200px; height:13px; margin-top:1px;"/></div> 
				<div class="seo_button" ><input type="image" src="<?=site_url()?>images/timkiem.gif"></div>
				</form>
			</div>
      <? }?>
      <div style="display: none; left: 378px; top: 130px;font-size:11px" class="divPopup" id="chooseCity" onMouseOut="overlayclose('chooseCity');" onmousemove="return overlay('chon_tinh','chooseCity', 'rightbottom')" onclick="overlayclose('chooseCity');">
        <div align="center"><a href="./front/chon_city/0">- TOÀN QU�?C -</a></div>
        <div style="float:left; width:90px; margin-left:5px;">
          <div class="Region" style="font-weight:bold">Mi�?n Bắc</div>
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
          <div class="Region" style="font-weight:bold">Mi�?n Nam</div>
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
          <div class="Region" style="font-weight:bold">Mi�?n Trung</div>
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
    <div class="noidung">
      <div class="noidung-trai">
        <?=$content?>
        <div style="clear:both;"></div>
			<?=$content2?>
        <!--//noidung-trai-05-->
      </div>
    
    <div class="noidung-phai">
      <?=$noi_dung_phai?>
    </div><!--//noidung-phai-->
    <div style="clear:both"></div>
    </div> <!--//noi dung-->
  	<!--END BODY -->
  <!--BEGIN FOOTER -->
  <div style="margin:0 auto;padding:0 1px;width:1038px;">
    <div  style="clear:both"></div>
    <div style=" background: url(<?=site_url()?>/images/show_image/bg_film.gif) repeat-x center; width:1038px; height:121px;padding-top:21px;">
      <?=$ads_bottom?>
    </div>
    <div  style="width:1038px;">
      <?php $this->load->view("footer");?>
    </div>
  </div>
  <!--END FOOTER -->
  <div style="clear:both;"></div>
</div>
</div>
</body>
</html>
