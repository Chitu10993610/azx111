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
	
	$keyword_df = "nha dat, nhadat, nhà đất, iht.vn, website, thiet ke website, house for rent,Buiding for sales. Nhaban, nha ban, Nha cho thue, cho thuê, nhà bán, nhà giá re, nha gia re ";
	$description_df = "Cổng thông tin, giao dịch mua bán, thuê mướn Nhà đất, bất động sản, văn phòng, căn hộ cao cấp, chung cư trên phạm vi toàn quốc. Thuận mua vừa bán. thiet ke website tot nhat viet nam";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=isset($page_keywords) ? $page_keywords : $keyword_df?>" />
<meta name="description" content="<?=isset($page_description) ? $page_description : $description_df?>" />
<title><?=$title?></title>
<?=isset($extraHeadContent)? $extraHeadContent : '';?>
<link rel="stylesheet" href="<?=base_url()?>css/front_style.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?=base_url()?>css/templates.css" type="text/css" media="screen">

<script type="text/javascript" src="<?=base_url()?>js/functions.js" ></script>
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
<body id="background">
<div id="page">
<!--  Begin header -->
<div id="header">
	<div class="logo" style="background:url(<?=base_url()?>images/autovn/logo.png) no-repeat scroll 0 12px transparent"></div>
</div>
<!--  End header -->
<!--  Begin primary menu -->
<div id="menu">
	<?=$main_menu?>
</div><!--  End primary menu -->
<div id="sidebarrleft" align="center">
<?=$left_area?>
</div><!--//end sidebarrleft-->

<!--// Begin of content //-->
<div id="content" class="narrowcolumn">
	<div id="feature_are"><?if(isset($feature_are)) echo $feature_are?></div>
	<div id="user1_are"><?if(isset($user1_are)) echo $user1_are?></div>
	<?=$content;?>
</div>
<!--// End of content //-->

<!--// Begin of left area //-->
<div id="sidebarright"> 
<?=isset($right_area) ? $right_area : '';?>
</div>
<!--// End of left area //-->
<!--  Begin footer -->
<div style="clear:both;"></div>
<div id="footer">
<div id="footer_are"><?if(isset($footer_are)) echo $footer_are?></div>	
<!--Begin online and search -->
<div style="clear: both; padding-top: 20px;">
	   <table cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center" width="100%" style="border: 1px solid rgb(204, 204, 204);">
			     <tbody><tr>
			       <td align="center"><table cellspacing="0" cellpadding="4" border="0">
                  <!--<tbody><tr>
                    <td>Số khách trực tuyến <strong id="dang_truy_cap"><?=(int)$guestonline?></strong>&nbsp;</td>
                    <td>Số thành viên trực tuyến <strong id="mem_online"><?=(int)$memonline?></strong>&nbsp;</td>
                    <td>Số lượt truy cập<strong id="luot_truy_cap"> <?=$totalvisit?></strong>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
      </tbody></table></td>
                <td align="center">-->
				<!--<img height="32" align="left" width="75" src="<?=base_url()?>images/hoanghai/google.gif">
<form action="http://nhadat999.com/front/search_google" id="cse-search-box" style="width:368px;">
  <div>
    <input type="hidden" name="cx" value="partner-pub-0858963962837207:tdpojx-g3ai" />
    <input type="hidden" name="cof" value="FORID:9" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="31" />
    <input type="submit" name="sa" value="Ti&#768;m ki&#234;&#769;m" />
  </div>
</form>
<script type="text/javascript" src="http://www.google.com.vn/cse/brand?form=cse-search-box&amp;lang=vi"></script>-->
<!--end google search-->
</td>
				</tr>
				</tbody></table>
	</div>
<!--end online and search -->
<div class="menu_duoi_div">
	<!--	<a href="<?=site_url()?>">Trang Chủ</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?=site_url()?>tin-tuc/about">Giới thiệu</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?=site_url()?>front/dichvu">Dịch vụ BĐS</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?=site_url()?>tin-tuc">Tin BĐS</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?=site_url()?>tin-tuc/project">Dự án</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?=site_url()?>tin-tuc/camnang">Cẩm nang BĐS</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?=site_url()?>dang-tin">Đăng Tin</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?=site_url()?>front/contact" style="background:none;">Liên hệ</a>-->
</div>


		<div class="footer_top"></div>
		<div class="footer_center">
						<span style="color:#002B5F; font-weight:bold;"><!--Bản quyền thuộc Công ty cổ phần đầu tư và tư vấn Hoàng Hải<br />
						Địa chỉ: Số 1/163 phố Xã Đàn, Đống Đa, Hà Nội<br />
						Tel: (04) 3573 9286 * Fax: (04) 3573 9287<br />
						Website: www.nhadat999.com ; www.batdongsan999.com<br />
						Email: hoanghaitg9999@gmail.com - -->
						Designed by <a href="http://iht.vn">IHT</a></span>
				<div style="padding:5px;"></div>
			</div>
</div>
	<!-- End footer -->
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
</body>
</html>