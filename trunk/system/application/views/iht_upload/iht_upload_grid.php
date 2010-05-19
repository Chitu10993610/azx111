<div id="content" class="narrowcolumn">
<?
   $modify_url = site_url('iht_upload/modify/');
   $delete_url = site_url('iht_upload/delete/');
   $download_url = site_url('iht_upload/download/');
   $add_url    = site_url('upload');
   $username = $_SESSION['userdata']['username'];
?>
<h3><a href="javascript:divToogle('groupsholder');">List file uploaded</a></h3>
	<div id="groupsholder" style="display:block;">
		<br />
		<table id="group_table" class="stripe">
			<tr>
				<th width="20" align="center">No</th>
	<th valign='middle' align='left' class='tbl_headercell'>File title</th>
	<th valign='middle' align='left' class='tbl_headercell'>File name</th>
	<th valign='middle' align='left' class='tbl_headercell'>File size</th>
	<th valign='middle' align='left' class='tbl_headercell'>Upload date</th>
	<th valign='middle' align='left' class='tbl_headercell'>Loại Tài liệu</th>
	<th valign='middle' align='center' class='tbl_headercell'>Download</th>
<!--	<th valign='middle' align='center' class='tbl_headercell'>Url</th>-->

				<th align="center">Edit</th>
				<th align="center">Delete</th>
			</tr>
      <?
         $i = 0;
         if(is_array($iht_upload_list)) foreach ($iht_upload_list as $iht_upload) {
            $i++;
            if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#EFEFEF"; }
      ?>
      <tr bgcolor="<?= $bgColor; ?>">
<td align="center"><?=$i;?></td>
   <td align="left"><?= $iht_upload['file_name']; ?></td>
   <td align="left"><?= $iht_upload['file_real_name']; ?></td>
   <td align="left"><?= number_format($iht_upload['file_size'], 3); ?> Kb</td>
   <td align="left"><?= date("m/d/Y", $iht_upload['create_date'])?></td>
   <td align="left"><?= $doc_type[$iht_upload['cat_id']]?></td>
<!--   <td align="left"><?= $iht_upload['user_id']; ?></td>-->
<td align="center"><a target="_blank" href = "<?=$download_url.'/'.$iht_upload["id"]; ?>" ><?=img("images/i_download.gif")?></a></td>
<!--<td align="center"><input type="text" onclick="this.select();" onfocus="this.select();" value="<?=site_url()."files/doc/".$iht_upload["file_real_name"]; ?>"></td>-->
<td class="edit"><a href = "<?= $modify_url."/".$iht_upload["id"]; ?>" ><?=img("images/i_edit.gif")?></a></td>
				<td class="delete">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$iht_upload["id"]; ?>" ><?=img("images/i_delete.gif")?></a>
				</td>
</tr>
      <? } ?>
		</table>
		<div style="float:left;"><?=$page_links?></div>
		<div style="float:right;"><?= anchor ($add_url, 'Upload new file', array('class' => 'addButton'));?></div>
	</div>
</div>