<?
   $this->load->helper('url');
   $this->lang->load('userauth', $this->session->userdata('ua_language')); 
   $modify_url = site_url($site_name.'products/modify/');
   $delete_url = site_url($site_name.'products/delete/');
   $add_url    = site_url($site_name.'products/add/');

?>
<div id="content" class="narrowcolumn">
<h2><a href="javascript:divToogle('groupsholder');">Danh sách tin đăng</a></h2>
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
				<th width="50">S(m<sup>2</sup>)</th>
				<th width="100">Giá</th>
				<th width="50">P.ngủ</th>
				<th width="50">P.tắm</th>
<!--				<th>Distance from Center</th>-->
				<th>Sửa</th>
				<th>Xóa</th>
			</tr>
			
			<?php 
			$k = $start;
			foreach ($ci_products_list as $ci_products) { ?>
			<tr>
<!--			    <td><input type="checkbox" onclick="isChecked(this.checked);" value="1" name="chkid[]"/></td>-->
				<td align="center"><?= ++$k; ?></td>
				<td><?=($ci_products['type'] == 1)?"Cho thuê":"Bán"?></td>
				<td style="text-align:left;"><?=$ci_products['name']?></td>
				<td><?=$ci_products['square_footage']?></td>
				<td><?=$ci_products['price']?> <?=$ci_products['currency']?><?=($ci_products['m2'])? "/m<sup>2</sup>":''?> <?=($ci_products['is_negotiate'])? "(Cho Thương Lượng)":''?></td>
				<td><?=$ci_products['bedrooms']?></td>
				<td><?=$ci_products['bath']?></td>
				<!--<td><?=$ci_products['distance']?></td>-->
				<td class="edit">
				<a href = "<?= $modify_url."/".$ci_products["id"]; ?>" ><?=img('images/i_edit.gif')?></a>
					</td>
				<td class="delete" nowrap="nowrap">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$ci_products["id"]; ?>" ><?=img('images/i_delete.gif')?></a>
				</td>
			</tr>
			<? } ?>
		</table>
		<div style="float:right;">
			<!--<div style="float:right;"><input type="button" value="<?= $this->lang->line('ua_edit'); ?>" class="addButton"/></div>
		<div style="float:right;"><input type="button" value="<?= $this->lang->line('ua_remove'); ?>" class="addButton"/></div>-->
		<div style="float:right;"><?= anchor ($site_name.'products/add', 
			'Đăng Tin', array('class' => 'addButton'));?></div>
		</div>
		<div style="float:left;"><?=$page_links?></div>
	</div>
</div>