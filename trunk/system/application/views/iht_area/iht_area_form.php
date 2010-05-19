<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "/iht_area/$action/";
?>
<?php echo validation_errors(); ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<form name="iht_area_form" id="iht_area_form" method="POST" action="<?= $action_url; ?>" >
<input type='hidden' name='id' id='id' value='<?= $id; ?>' >
<table width="685" border="0" cellpadding="5" cellspacing="5">
	<tr valign='top' height='20'>
            <td align='left'> <b>Tên:  </b> </td>
            <td>
               <input type='text' name='area_name' id='name' value='<?= $area_name; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> Tỉnh:  </b> </td>

            <td>
               <select name="province_id" id="province_id" >
				<option value=""> -- Chọn Tỉnh Thành -- </option><?
			 foreach ($iht_provincelist as $iht_province) {
				$lookupid   = $iht_province["id"];
				$lookuptext   = $iht_province["name"];
?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $province_id)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
<?			 } ?>
			</select>

            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> Quận/Huyện:  </b> </td>

            <td>
               <select name="district_id" id="district_id" >
				<option value=""> -- Chọn Quận/Huyện -- </option><?
			 foreach ($iht_districtlist as $iht_district) {
				$lookupid   = $iht_district["id"];
				$lookuptext   = $iht_district["district_name"];
?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $district_id)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
<?			 } ?>
			</select>

            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> Miêu tả:  </b> </td>

            <td>
               <textarea cols=35 rows=7 NAME='description' id='description' ><?= $description; ?></textarea>
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='left'> <b>Là Khu ĐTM:  </b> </td>
            <td>
               <input type='checkbox' name='is_dtm' id='is_dtm' VALUE='1' <?=($is_dtm) ? "checked=checked" :''?>/> (Nếu là khu đô thị mới thì check vào đây)
            </td>
         </tr>

</table>
<input class="button" type="submit" name="Submit" value="Save">
<input class="button" type="reset" name="resetForm" value="Reset Form">
</form>
</div>