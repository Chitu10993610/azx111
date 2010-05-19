<div id="content" class="narrowcolumn">
<?
   $modify_url = site_url('contact/modify/');
   $delete_url = site_url('contact/delete/');
   $add_url    = site_url('contact/add/');
?>

<h3><a href="javascript:divToogle('groupsholder');">Danh sách các liên hệ</a></h3>
	<div id="groupsholder" style="display:block;">
		<br />
		<table id="group_table" class="stripe">
			<tr>
				<th width="20" align="center">No</th>
					<th width="60"  valign='middle' align='center' class='tbl_headercell'>Name</th>
	<th width="150"  valign='middle' align='left' class='tbl_headercell'>Email</th>
	<th width="150" valign='middle' align='left' class='tbl_headercell'>Ngày gửi</th>
		<th valign='middle' class='tbl_headercell'>Chủ đề</th>

				<th align="center">Chi tiết</th>
				<th align="center">Delete</th>
			</tr>
			
      <?
         $i = 0;
         if(is_array($contact_list)) foreach ($contact_list as $contact) {
            $i++;
            if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#EFEFEF"; }
      ?>
      <tr bgcolor="<?= $bgColor; ?>">
<td align="center"><?=$i;?></td>
   <td align="left"><?= $contact['name']; ?></td>
   <td align="left"><?= $contact['email']; ?></td>
   <td align="left"><?= $contact['create_date']; ?></td>
   <td align="left"><?= $contact['subject']; ?></td>
   <td class="edit"><a href = "<?= $modify_url."/".$contact["id"]; ?>" ><?=img("images/i_edit.gif")?></a></td>
				<td class="delete">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$contact["id"]; ?>" ><?=img("images/i_delete.gif")?></a>
				</td>
</tr>
      <? } ?>
		</table>
		<div style="float:left;"><?=$page_links?></div>
	</div>
</div>