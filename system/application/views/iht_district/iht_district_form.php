<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "/iht_district/$action/";
?>
<?php echo validation_errors(); ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<form name="iht_district_form" id="iht_district_form" method="POST" action="<?= $action_url; ?>" >
<input type='hidden' name='id' id='id' value='<?= $id; ?>' >
<table width="685" border="0" cellpadding="5" cellspacing="5">
	<tr valign='top' height='20'>

            <td align='left'> <b> Tên tỉnh  </b> </td>

            <td>
               <input type='text' name='district_name' id='name' value='<?= $district_name; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> Khu vực:  </b> </td>

            <td>
               <select name="province_id" id="province_id" >
				<option value="">Chọn khu vực</option><?
			 foreach ($iht_provincelist as $iht_province) {
				$lookupid   = $iht_province["aid"];
				$lookuptext   = $iht_province["atitle"];
?>
				<option value="<?=$lookupid; ?>" <?= ($lookupid == $province_id)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
<?			 } ?>
			</select>

            </td>
         </tr>

</table>
<input class="button" type="submit" name="Submit" value="Save">
<input class="button" type="reset" name="resetForm" value="Reset Form">
</form>
</div>