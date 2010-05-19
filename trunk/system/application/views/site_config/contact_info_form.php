<?php 
	$this->lang->load('userauth', $this->session->userdata('ua_language')); 

	if (isset($msg)) { echo "<p class=\"error\">$msg</p>"; }

?>
	<div>
		<input type='hidden' name='id' id='id' value='<?= $id; ?>' >
		
<?php echo $error;?>
<table width="680" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td width="162"><label for="guide_name">Tên cty</label></td>
    <td width="498">
    <input style="width:480px;" name="guide_name" type="text" id="guide_name" value="<?= $guide_name; ?>" maxlength="255" /></td>
  </tr>
    <tr>
    <td width="163"><label for="guide_center_address">Địa chỉ</label></td>
    <td width="502"><input style="width:480px;" name="guide_center_address" type="text" id="guide_center_address" value="<?=$guide_center_address;?>" maxlength="255" /></td>
  </tr>
  <tr>
    <td><label for="contact_phone">Điện thoại</label></td>
    <td><input style="width:480px;" name="contact_phone" type="text" id="contact_phone" value="<?= $contact_phone; ?>" maxlength="15" /></td>
  </tr>
  <tr>
    <td>Fax</td>
    <td><input name="fax" type="text" id="fax" style="width:480px;" value="<?=$fax;?>" size="30" maxlength="15" /></td>
  </tr>
  <tr>
    <td><label for="contact_mail">Email</label></td>
    <td><input name="contact_mail" type="text" id="contact_mail" style="width:480px;" value="<?=$contact_mail;?>" size="30" maxlength="255" /></td>
  </tr>
  <tr>
    <td>Ảnh đại diện</td>
    <td><input style="width:300px;" type="file" name="guide_image"><div style="float:right; padding-right:20px;"><?php if($guide_image) echo '<img src="'.base_url().'/images/'.$site_name.'config/'.$guide_image . '" width="100" border="0">'; ?></div></td>
  </tr>  
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" class="button" value="Save">&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" class="button" ></td>
  </tr>
</table>
	</div>