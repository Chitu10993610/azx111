<div style="width:825px; height: auto;">
	<div style="border-left:1px solid #CCCCCC;
float:left;
height:auto;
padding-left:5px;">
<div style="padding:20px;">
	
<? if($dataConf['guide_image']) {?>
	<div align="center">
		<span style="font-weight: bold; font-size: 18pt;">
			<img border="0px" align="" src="<?=base_url().'images/config/'.$dataConf['guide_image']?>" alt=""><br>
		</span>
	</div>
<? }?>
	<div align="center"><span style="font-weight: bold; font-size: 12pt; color: rgb(255, 0, 0);"><?=$dataConf['guide_name']?></span></div>
	
	<div align="center" style="font-style: italic;">
	<span style="font-weight: bold;"><span style="font-size: 10pt;">Văn phòng giao dịch: </span><span style="font-size: 10pt;"><span style="font-size: 10pt;"><?=$dataConf['guide_center_address']?><br></span>
	<span style="font-weight: bold; font-size: 10pt;"><span style="font-size: 10pt;">ĐT/Fax: <?=$dataConf['contact_phone']?>&nbsp;&nbsp;&nbsp;<br></span></span></span></span></div>
	<div align="center"><span style="font-weight: bold;"><span style="font-weight: bold;">Email: <span style="color: rgb(105, 105, 105); font-size: 10pt;"><?=$dataConf['contact_mail']?></span></span><br></span></span></div>
	<div align="center"><span style="color:#022A5D"><b>Xin vui lòng điền thông tin vào form dưới đây </b></span></div>
</div>
<?
$this->load->helper('url');
$action_url = site_url() . "front/contact/";
?>
<?php echo validation_errors(); ?>
<?php if (isset($ok)) { echo "Bạn đã gửi liên hệ thành công. Chúng tôi sẽ sớm liên hệ lại với bạn.<br /> Xin cám ơn bạn! "; } else { ?>
<form name="iht_contact_form" id="iht_contact_form" method="POST" action="<?= $action_url; ?>" >
<input type='hidden' name='id' id='id' value='<?= $id; ?>' >
<table width="570" border="0" cellpadding="5" cellspacing="5">
		<tr valign='top' height='20'>
            <td align='left'> <b>Họ tên:<span style="color:red">*</span></b> </td>
            <td>
               <input type='text' name='name' id='name' value='<?= $name; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='left'> <b>Địa chỉ:<span style="color:red">*</span></b> </td>
            <td>
               <input type='text' name='address' id='address' value='<?= $address; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='left'> <b>Email:</b> </td>
            <td>
               <input type='text' name='email' id='email' value='<?= $email; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='left'> <b>ĐT cố định:</b> </td>
            <td>
               <input type='text' name='phone' id='phone' value='<?= $phone; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='left'> <b>Di động:<span style="color:red">*</span></b> </td>
            <td>
               <input type='text' name='mobile' id='mobile' value='<?= $mobile; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='left'> <b>Tiêu đề:<span style="color:red">*</span></b> </td>
            <td>
               <input type='text' name='subject' id='subject' value='<?= $subject; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='left'> <b>Nội dung:<span style="color:red">*</span></b> </td>
            <td>
               <textarea cols=35 rows=7 NAME='content' ><?= $content; ?></textarea>
            </td>
         </tr>
</table>
<div align="center"><input class="button" type="submit" name="Submit" value="Gửi">
<input class="button" type="reset" name="resetForm" value="Nhập lại"></div>
</form>
<?}?>
</div></div>