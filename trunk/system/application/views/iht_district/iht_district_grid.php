<div id="content" class="narrowcolumn">
<?
   $modify_url = site_url('iht_district/modify/');
   $delete_url = site_url('iht_district/delete/');
   $add_url    = site_url('iht_district/add/');
?>
<h3><a href="javascript:divToogle('groupsholder');">Danh sách các tỉnh</a></h3>
	<div id="groupsholder" style="display:block;">
		<br />
		<table id="group_table" class="stripe">
			<tr>
				<th width="20" align="center">No</th>
	<th valign='middle' align='center' class='tbl_headercell'>Tỉnh</th>
	<th valign='middle' align='center' class='tbl_headercell'>Khu vực</th>

				<th align="center">Edit</th>
				<th align="center">Delete</th>
			</tr>
			
      <?
         $i = 0;
         if(is_array($iht_district_list)) foreach ($iht_district_list as $iht_district) {
            $i++;
            if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#EFEFEF"; }
      ?>
      <tr bgcolor="<?= $bgColor; ?>">
<td align="center"><?=$i;?></td>
   <td align="left"><?= $iht_district['district_name']; ?></td>
   <td align="left"><?= $iht_district['province_name']; ?></td>
<td class="edit"><a href = "<?= $modify_url."/".$iht_district["id"]; ?>" ><?=img("images/i_edit.gif")?></a></td>
				<td class="delete">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$iht_district["id"]; ?>" ><?=img("images/i_delete.gif")?></a>
				</td>
</tr>
      <? } ?>
		</table>
		<div style="float:left;"><?=$page_links?></div>
		<div style="float:right;"><?= anchor ($add_url, 'Thêm tỉnh', array('class' => 'addButton'));?></div>
	</div>
</div>