<div id="content" class="narrowcolumn">
<?
   $modify_url = site_url('category/modify/');
   $delete_url = site_url('category/delete/');
   $add_url    = site_url('category/add/');
?>
<h3><a href="javascript:divToogle('groupsholder');">Danh sách category</a></h3>
	<div id="groupsholder" style="display:block;">
		<br />
		<table id="group_table" class="stripe">
			<tr>
				<th width="20" align="center">No</th>
					<th valign='middle' align='center' class='tbl_headercell'>Cat_id</th>
	<th valign='middle' align='center' class='tbl_headercell'>Cat_name</th>

				<th align="center">Edit</th>
				<th align="center">Delete</th>
			</tr>
			
      <?
         $i = 0;
         if(is_array($category_list)) foreach ($category_list as $category) {
            $i++;
            if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#EFEFEF"; }
      ?>
      <tr bgcolor="<?= $bgColor; ?>">
<td align="center"><?=$i;?></td>
   <td align="left"><?= $category['cat_id']; ?></td>
   <td align="left"><?= $category['cat_name']; ?></td>
<td class="edit"><a href = "<?= $modify_url."/".$category["cat_id"]; ?>" ><?=img("images/i_edit.gif")?></a></td>
				<td class="delete">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$category["cat_id"]; ?>" ><?=img("images/i_delete.gif")?></a>
				</td>
</tr>
      <? } ?>
		</table>
		<div style="float:left;"><?=$page_links?></div>
		<div style="float:right;"><?= anchor ($add_url, 'Add category', array('class' => 'addButton'));?></div>
	</div>
</div>