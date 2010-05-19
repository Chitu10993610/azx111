<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url()."languages/$action/";
?>
<!--<h2>Enter ci_ads Details</h2>-->
<?php echo validation_errors(); ?>
<?php if(isset($error)) echo $error; ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<form name="ci_adsdetails" id="ci_adsdetails" method="POST" action="<?= $action_url; ?>" enctype="multipart/form-data">
<input type='hidden' name='id' id='id' value='<?= $id; ?>' >
<table cellspacing="2" cellpadding="2" border="0" width="100%">
     <tr valign='top' height='20'>
            <td align='right'> <b> Tên:  </b> </td>
            <td>
               <input style="width:480px;" type='text' name='name' id='name' value='<?= $name; ?>' />
            </td>
         </tr>
   <tr valign='top' height='20'>
            <td align='right'> <b> Image:  </b> </td>
            <td>
               <input size="63" type='file' name='image' id='image' />
            </td>
   </tr>
	<tr valign='top' height='20'>
            <td align='right'> <b> Mã ngôn ngữ:  </b> </td>
            <td>
               <input style="width:480px;" maxlength="10" type='text' name='code' id='code' value='<?= $code; ?>' />
            </td>
         </tr>
    <tr valign='top' height='20'>
            <td align='right'> <b>Thứ tự</b> </td>
            <td><input style="width:480px;" maxlength="10" type='text' name='ordering' id='ordering' value='<?= $ordering; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='right'> <b>Active:  </b> </td>
            <td>
               <input style="width:80px;" type='checkbox' name='status_flg' id='status_flg' value='1' <?=($status_flg == 1) ? "checked" : ''?> /> (Nếu check thì ngôn ngữ này mới được sử dụng trên site)
            </td>
         </tr>

</table><div style="float:right; padding-right:20px;"><?php if($image) echo '<img src="'.base_url().'images/languages/'.$image . '" class="image-ads" border="0">'; ?></div>

<input type="submit" name="Submit" value="Save">
<input type="reset" name="resetForm" value="Clear Form">
</form>
</div>