<div id="content" class="narrowcolumn">
<?
   $modify_url = site_url('iht_area/modify/');
   $delete_url = site_url('iht_area/delete/');
   $add_url    = site_url('iht_area/add/');
?>
<h3><a href="javascript:divToogle('groupsholder');">Danh sách khu vực</a></h3>
	<div id="groupsholder" style="display:block;">
		<br />
		<table id="group_table" class="stripe">
			<tr>
				<th width="20" align="center">No</th>
	<th valign='middle' align='center' class='tbl_headercell'>Name</th>
	<th valign='middle' align='center' class='tbl_headercell'>Tỉnh</th>
	<th valign='middle' align='center' class='tbl_headercell'>Quận</th>
	<th valign='middle' align='center' width="60" class='tbl_headercell'>Khu ĐTM</th>

				<th align="center">Edit</th>
				<th align="center">Delete</th>
			</tr>
			
      <?
         $i = 0;
         if(is_array($iht_area_list)) foreach ($iht_area_list as $iht_area) {
            $i++;
            if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#EFEFEF"; }
      ?>
      <tr bgcolor="<?= $bgColor; ?>">
<td align="center"><?=$i;?></td>
   <td align="left"><?= $iht_area['area_name']; ?></td>
   <td align="left"><?= $iht_area['province_id']; ?></td>
   <td align="left"><?= $iht_area['district_id']; ?></td>
   <td align="left"><?= $iht_area['is_dtm']; ?></td>
<td class="edit"><a href = "<?= $modify_url."/".$iht_area["id"]; ?>" ><?=img("images/i_edit.gif")?></a></td>
				<td class="delete">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$iht_area["id"]; ?>" ><?=img("images/i_delete.gif")?></a>
				</td>
</tr>
      <? } ?>
		</table>
		<div style="float:left;"><?=$page_links?></div>
		<div style="float:right;"><?= anchor ($add_url, 'Thêm khu vực', array('class' => 'addButton'));?></div>
	</div>
</div>