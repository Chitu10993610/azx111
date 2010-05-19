<link rel="stylesheet" href="<?=base_url()?>js/datepicker/flora.datepicker.css" type="text/css" media="screen" title="Flora (Default)">
<script type="text/javascript" src="<?=base_url()?>js/datepicker/ui.datepicker.js"></script>
<script type="text/javascript">

 $(document).ready(function(){
    $("#birthday").datepicker({ dateFormat: 'yy/mm/dd' });
  });
</script>
<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url($action);
echo validation_errors();
$this->lang->load('userauth', $this->session->userdata('ua_language')); 
?>
	<h2><?php echo $form_title?></h2>
<?php
	if (isset($msg)) { echo "<p class=\"msg\">$msg</p>"; }
?>
	<div id="usersholder">
		<form name="addUser" method="post" action="<?= $action_url?>">
		<input type='hidden' name='userid' id='id' value='<?= $userid; ?>' >
		<table width="685" border="0" cellpadding="5" cellspacing="5">
		<tr><td width="150">
			<label for="username"><?= $this->lang->line('ua_username');?></label>
		</td><td width="550">
			<?php if(isset($myInfo)) echo $username; else {?>
			<input name="username" type="text" id="username" size="30" value="<?=$username?>" />
			
		</td></tr>
		<tr><td>
			<label for="select"><?= $this->lang->line('ua_group');?></label>
		</td><td>
			<select name="groupid" id="select" >
<?php foreach ($listAllGroups->result() as $objGroup): ?>
				<option <?=($objGroup->groupid == $groupid) ? "selected" : ''?> value="<?= $objGroup->groupid;?>" ><?= $objGroup->groupname;?></option>
<?php endforeach; ?>
			</select>
			<?}?>
		</td></tr>
		<tr><td>
			<label for="fullname"><?= $this->lang->line('ua_fullname');?></label>
		</td><td>
			<input name="fullname" type="text" id="fullname" size="30" value="<?=$fullname?>" />
			
		</td></tr><tr><td>
			<label for="email"><?= $this->lang->line('ua_email');?></label>
		</td><td>
			<input name="email" type="text" id="email" size="30" value="<?=$email?>" />
			
		</td></tr><tr><td>
			<label for="password"><?= $this->lang->line('ua_password') ;?></label>
		</td><td><?php if($userid) echo '('.$this->lang->line('ua_leave_blank').' )'?><br />
			<input name="password" type="password" id="password" size="30" value="" />
			
		</td></tr>
		<tr><td>
			<label for="passconf"><?= $this->lang->line('ua_passconf');?></label>
		</td>
		<td><?php if($userid) echo '('.$this->lang->line('ua_leave_blank').' )'?><br />
		<input name="passconf" type="password" id="passconf" size="30" value="" />
			 
		</td></tr>
		<tr><td>
			<label for="phone">ĐT cố định</label>
		</td>
		<td>
			<input name="phone" type="text" id="phone" size="30" value="<?=$phone?>" />
		</td></tr>
		<tr><td>
			<label for="mobile_phone">ĐTDĐ</label>
		</td>
		<td>
			<input name="mobile_phone" type="mobile_phone" id="mobile_phone" size="30" value="<?=$mobile_phone?>" />
		</td>
		</tr>
		<tr><td>
			<label for="birthday">Ngày sinh</label>
		</td>
		<td>
			<input name="birthday" id="birthday" value="<?php $birthday = (isset($birthday) && $birthday) ? $birthday : time(); echo date("Y/m/d", $birthday)?>" size="12" readonly="readonly" type="text" />
			<a onclick="document.getElementById('birthday').focus();" ><img src="<?=site_url()?>images/calbtn.gif" alt="" name="popcal" width="34" height="22" border="0" align="absbottom" id="popcal" /></a>
		</td>
		</tr>
		<tr><td>
			<label for="information">Giới thiệu bản thân</label>
		</td>
		<td>
			<textarea cols="30" rows="6" name="information" id="information" size="30" /><?=$information?></textarea>
		</td>
		</tr>
		<?php if(!isset($myInfo)) {?>
		<tr><td colspan="2">
			<b>Phân quyền theo chuyên mục</b>
		</td>
		</tr>
		     <tr>
			
			<td align="left" width="120" nowrap style="padding-left: 20px; padding-top:10px"><b>Chọn mục tin:</b></td>
			<td style="padding-left: 5px;" align="left">
			<select name="view_rule[]" style="width:200px;" size="10" multiple>
		<?php
			$selected=(strpos($view_rule, "all") !== false) ? "selected":"";?>
			 <option value="all" <?=$selected?>> -- Tất cả các chuyên mục -- </option>
			<?php
			$view_rule = explode(',', $view_rule);
			foreach ($aryCatList as $aryCat) {
				$selected=(in_array($aryCat['cat_id'], $view_rule)) ? " selected ":"";
				echo '<option value="' . $aryCat['cat_id'] . '" '. $selected . '>' . str_repeat('&nbsp;&nbsp;', $aryCat['level']).$aryCat['cat_name']. '</option>';
			}
		?>
			</select>
			</td>
		</tr>
		<?}?>
		<tr><td>
		</td><td>
			<input type="hidden" name="enabled" value="1" id="enabled" />
			<input style="width:100px;" name="Submit" type="submit" class="button" value="<?=($userid) ? "Lưu":"Tạo user"?>" />
		</td></tr></table>
		</form>
	</div>
</div>