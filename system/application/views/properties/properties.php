<?
   $this->load->helper('url');
   $this->lang->load('userauth', $this->session->userdata('ua_language')); 
   $modify_url = site_url($site_name.'properties/modify/');
   $delete_url = site_url($site_name.'properties/delete/');
   $add_url    = site_url($site_name.'properties/add/');

?>
<div id="content" class="narrowcolumn">
<h2><a href="javascript:divToogle('groupsholder');">Danh Sách Tin Rao</a></h2>
	<?php
		if (isset($groupmsg)) {
			echo "<p class=\"error\" id=\"groupmsg\">$groupmsg</p>";
		}
	?>

	<div id="groupsholder" style="display:block;">
		<br />
		<table id="group_table" class="stripe">
			<tr>
<!--				<th>&nbsp;</th>-->
				<th width="20" align="center">No</th>
				<th width="60">Loại</th>
				<th>Tiêu đề</th>
				<th width="50">Phạm vi</th>
				<th width="100">Giá</th>

<!--				<th>Distance from Center</th>-->
				<th>Sửa</th>
				<th>Xóa</th>
			</tr>
			
			<?php 
			$k = $start;
			foreach ($ci_properties_list as $ci_properties) { ?>
			<tr>
<!--			    <td><input type="checkbox" onclick="isChecked(this.checked);" value="1" name="chkid[]"/></td>-->
				<td align="center"><?= ++$k; ?></td>
				<td><?php 
    switch ($ci_properties['type']) {
    case 0:echo"Cần bán";
    break;
    case 1:echo"Cho thuê";
    break;
    case 2:echo"Cần mua";
    break;
    case 3:echo"Cần thuê";
    break;
    }?></td>
				<td style="text-align:left;"><?=$ci_properties['name']?></td>
				<td><?=$ci_properties['province_name']?></td>
				<td><?=price_format($ci_properties['price'])?> <?=$ci_properties['currency']?><?=($ci_properties['m2'])? "/m<sup>2</sup>":''?> <?=($ci_properties['is_negotiate'])? "(Cho Thương Lượng)":''?></td>
				<td class="edit">
				<a href = "<?= $modify_url."/".$ci_properties["id"]; ?>" ><?=img('images/i_edit.gif')?></a>
					</td>
				<td class="delete" nowrap="nowrap">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$ci_properties["id"]; ?>" ><?=img('images/i_delete.gif')?></a>
				</td>
			</tr>
			<? } ?>
		</table>
		<div style="float:right;">
			<!--<div style="float:right;"><input type="button" value="<?= $this->lang->line('ua_edit'); ?>" class="addButton"/></div>
		<div style="float:right;"><input type="button" value="<?= $this->lang->line('ua_remove'); ?>" class="addButton"/></div>-->
		<div style="float:right;"><?= anchor ($site_name.'properties/add', 
			'Đăng Tin', array('class' => 'addButton'));?></div>
		</div>
		<div style="float:left;" class="paging" ><?=$page_links?></div>
	</div>
</div>