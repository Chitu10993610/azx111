<script language="javascript">
$(document).ready(function() {
//	$('#contact_info').hide();
//	$('#guide_info').hide();
//	$('#neighborhood').hide();
}); 
</script>
<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() .$site_name. "cau-hinh";

?>
<?php $this->lang->load('userauth', $this->session->userdata('ua_language')); ?>
<?php echo validation_errors(); ?>
	<h3><a href="javascript:divToogle('contact_info');">Thông tin liên hệ</a></h3>
	<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<form name="hs_configdetails" id="hs_configdetails" method="POST" action="<?= $action_url; ?>" enctype="multipart/form-data">
	<div id="contact_info">
	<?php
echo $contact_info;
?>
	</div>
	
<!--	<h3><a href="javascript:divToogle('guide_info');">Thông tin giới thiệu</a></h3>
	<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
	<div id="guide_info">
		<?php
echo $guide_info;
?>
	</div>-->

	<h3><a href="javascript:divToogle('service_info');">Báo giá quảng cáo</a></h3>
	<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
	<div id="service_info">
		<?php
echo $service_info;
?>
	</div>
	</form>
	<!--<h3><a href="javascript:divToogle('neighborhood');">Neighborhoods</a></h3>
	<div id="neighborhood">
		<?php
echo $tpl_neighborhood;
?>
	</div>-->

	<!--<h3><a href="javascript:divToogle('tpl_transportation_router');">Tuyến xe buyt, tầu</a></h3>
	<div id="tpl_transportation_router">
		<?php
echo $tpl_transportation_router;
?>
	</div>-->
	
	
	<div id="tpl_amenities">
		<?php
echo $tpl_amenities;
?>
	</div>
	

	<div id="tpl_culture">
		<?php
echo $tpl_culture;
?>
	</div>
</div>