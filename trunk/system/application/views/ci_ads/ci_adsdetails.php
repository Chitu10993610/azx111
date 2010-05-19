<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url()."ads/$action/";
?>
<!--<h2>Enter ci_ads Details</h2>-->
<?php echo validation_errors(); ?>
<?php if(isset($error)) echo $error; ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<form name="ci_adsdetails" id="ci_adsdetails" method="POST" action="<?= $action_url; ?>" enctype="multipart/form-data">
<input type='hidden' name='id' id='id' value='<?= $id; ?>' >
<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign='top' height='20'>
            <td align='right'> <b> Image:  </b> </td>
            <td>
               <input size="63" type='file' name='image' id='image' />
            </td>
         </tr>
     <tr valign='top' height='20'>
            <td align='right'> <b> Title:  </b> </td>
            <td>
               <input style="width:480px;" type='text' name='ads_title' id='ads_title' value='<?= $ads_title; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='right'> <b> Description:  </b> </td>
            <td>
               <textarea style="width:480px;" cols=35 rows=7 NAME='description' id='description' ><?= $description; ?></textarea>
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='right'> <b> Ads URL:  </b> </td>
            <td>
               <input style="width:480px;" type='text' name='ads_url' id='ads_url' value='<?= $ads_url; ?>' />
            </td>
         </tr>
     <tr>
			
			<td align="left" width="120" nowrap style="padding-left: 20px; padding-top:10px"><b>Hiển thị trong các mục tin:</b></td>
			<td style="padding-left: 5px;" align="left">
			<select name="view_rule[]" style="width:200px;" size="10" multiple>
			<?php $selected=(strpos($view_rule, ":home:") !== false) ? "selected":"";?>
			<?php $selected=(strpos($view_rule, ":search:") !== false) ? "selected":"";?>
			 <option value=":home:" <?=$selected?>> -- Trang chủ -- </option>
			 <option value=":search:" <?=$selected?>> -- Kết quả tìm kiếm -- </option>
		<?php
			foreach ($aryCatList as $aryCat) {
				$selected=(strpos($view_rule, ':'.$aryCat['cat_id'].':') !== false) ? "selected":"";
				echo '<option value="' . ':'.$aryCat['cat_id'] .':'. '"'. $selected . '>' . str_repeat('&nbsp;&nbsp;', $aryCat['level']).$aryCat['cat_name']. '</option>';
			}
		?>
			</select>
			</td>
		</tr>
		 <tr>
			
			<td align="left" width="120" nowrap style="padding-left: 20px; padding-top:10px"><b>Hiển thị ở mục tin rao</b></td>
			<td style="padding-left: 5px;" align="left">
			<select name="view_rule[]" style="width:200px;" size="10" multiple>
			<?php $selected=(strpos($view_rule, ":home:") !== false) ? "selected":"";?>
			 <option value=":home:" <?=$selected?>> -- Rao vặt -- </option>

		<?php
			foreach ($aryCatList1 as $aryCat) {
				$selected=(strpos($view_rule, ':'.$aryCat['cat_id'].':') !== false) ? "selected":"";
				echo '<option value="' . ':'.$aryCat['cat_id'] .':'. '"'. $selected . '>' . str_repeat('&nbsp;&nbsp;', $aryCat['level']).$aryCat['cat_name']. '</option>';
			}
		?>
			</select>
			</td>
		</tr>
   <tr valign='top' height='20'>
            <td align='right'> <b>Width:  </b> </td>
            <td>
               <input style="width:80px;" maxlength="4" type='text' name='ads_width' id='ads_width' value='<?= $ads_width; ?>' />px
               &nbsp;<b>Height:</b> <input style="width:80px;" maxlength="4" type='text' name='ads_height' id='ads_height' value='<?= $ads_height; ?>' />px
            </td>
         </tr>
         <tr valign='top' height='20'>
            <td align='right'> <b>Thứ tự:  </b> </td>
            <td>
               <input style="width:80px;" maxlength="4" type='text' name='ads_order' id='ads_order' value='<?= $ads_order; ?>' />
            </td>
         </tr>
    <tr valign='top' height='20'>
            <td align='right'> <b> Position:  </b> </td>
            <td>
               <select name="position">
		            <option value="">-- Chọn vị trí --</option>
					<?php 
		  
						foreach($pos_adv as $key=>$text) {
							$selected = ($key == $position) ? " selected" : "";
							echo '<option value="' . $key . '"'. $selected . '>' . $text. '</option>';
						}
					?>
               </select>
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='right'> <b> Ads Status:  </b> </td>
            <td>
               <input style="width:80px;" type='checkbox' name='status_flg' id='status_flg' value='1' <?=($status_flg == 1) ? "checked" : ''?> /> (Nếu bỏ check quảng cáo này sẽ không hiển thị)
            </td>
         </tr>

</table><div style="float:right; padding-right:20px;"><?php if($image) echo '<img src="'.base_url().'images/adv/'.$image . '" class="image-ads" border="0">'; ?></div>

<input type="submit" name="Submit" value="Save">
<input type="reset" name="resetForm" value="Clear Form">
</form>
</div>