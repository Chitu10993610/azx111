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

	// set the character sets
//	$charset = 'ua_charset_'.$language;
//	$charset = $this->config->item($charset);
//	if( empty($charset) ) { $charset = 'iso-8859-1'; }
	
	$html_title = 'CodeIgniter '
		. $this->lang->line('ma_template_example')
		. ' | '
		. $this->lang->line('ma_template_user_authenic');
	$html_title .= ( ! empty($title) ) ? " - ".$title : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$lang?>" lang="<?=$lang?>"><head>
<title><?=$title?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<base href="<?=base_url();?>" />
<?=isset($extraHeadContent)? $extraHeadContent : '';?>
<link rel="stylesheet" href="<?=base_url()?>css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?=base_url()?>css/userauth.css" type="text/css" media="screen">
<script language="javascript">
function sconfirm(strMess,strURL){
	var yn;
	yn=window.confirm(strMess);
	if (yn==true){
		document.location.href=strURL;
		}
}
</script>
<script type="text/javascript" src="<?=base_url()?>js/jquery123.js" ></script>
<script type="text/javascript" src="<?=base_url()?>js/functions.js" ></script>
<script type="text/javascript" src="<?=base_url()?>js/iht_ajax.js" ></script>

</head>
<body id="background">
<center>
<div id="page">
<!--  Begin header -->
<div id="header">
	<div id="logo">
		<a href="<?=site_url();?>">
			<img src="<?=site_url()?>images/logo.gif" />
		</a>
	</div>
	<?php if($this->session->userdata('username')) {?>
	<div class="wel_msg">
		Chào bạn<a href="<?=site_url().'my-info';?>"> <b><?=$this->session->userdata('username')?></b></a> &nbsp;&nbsp;
		[<a href="<?=site_url().'quan-ly-tin';?>"> Quản lý tin rao</a>&nbsp; | &nbsp;
		<?php echo anchor('user/logout', 'Thoát');?> ]
	</div>
	<?}
	else {?>
	<div class="wel_msg"><a href="<?=site_url()?>dang-ky">Đăng Ký</a> | <a href="<?=site_url()?>dang-nhap">Đăng Nhập</a></div>
	<?}?>
</div>
<!--  End header -->
<!--  Begin primary menu -->
<div id="menu">
	<ul>
		<li class="selected"><a target="_blank" href="<?=site_url()?>">Trang Chủ</a></li>
<!--		<li class=""><a href="<?=site_url()?>gioi-thieu">Giới thiệu</a></li>-->
<!--		<li class=""><a href="<?=site_url()?>front/dichvu">Dịch vụ BĐS</a></li>-->
<!--		<li class=""><a href="<?=site_url()?>tin-tuc">Tin BĐS</a></li>-->
<!--		<li class=""><a href="<?=site_url()?>front/tin_tuc/project">Dự án</a></li>-->
<!--		<li class=""><a href="<?=site_url()?>front/tin_tuc/camnang">Cẩm nang BĐS</a></li>-->
<!--		<li class=""><a href="<?=site_url()?>dang-tin">Đăng Tin</a></li>-->
		<li class=""><a href="<?=site_url()?>front/contact" style="background:none;">Liên hệ</a></li>
	</ul>
</div>
<!--  End primary menu -->
<?
	if (!isset($nav)) { $nav = FALSE; }
	$this->load->view('app/menu', $nav);		// menu
	//$this->load->view('usergroups/login');	//login box
?>

<!--// Begin of content //-->
<?=$content;?>
<!--// End of content //-->
<!--  Begin footer -->
	<div id="footer">
		<div class="footer_top"></div>
		<div class="footer_center">
				<div style="padding:5px;">
					Copyright © 2010 <?=$this->config->item('site_name')?>. All rights reserved.
				</div>
			</div>
</div>
	<!-- End footer -->
</div>
</center>
</body></html>