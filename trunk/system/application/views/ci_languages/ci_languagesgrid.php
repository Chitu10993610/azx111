<div id="content" class="narrowcolumn">
<?
   $this->load->helper('url');
   $modify_url = site_url('languages/modify/');
   $delete_url = site_url('languages/delete/');
   $add_url    = site_url('languages/add/');

?>
<h3><a href="javascript:divToogle('groupsholder');">Danh sách ngôn ngữ</a></h3>
	<div id="groupsholder" style="display:block;">
		<br />
		<table id="group_table" class="stripe">
			<tr>
				<th width="20" align="center">No</th>
				<th align="center" width="40">Status</th>
				<th>Tên</th>
				<th>Code</th>
				<th align="center" width="120">Image</th>
				<th align="center">Edit</th>
				<th align="center">Delete</th>
			</tr>
			<?php 
			$k = 0;
			foreach ($ci_languages_list as $ci_languages) { ?>
			<tr>
			  <td align="center"><?= ++$k; ?></td>
			   <td align="center"><?php if($ci_languages['status_flg']) echo '<img src="'.base_url().'images/check.png" border="0">'; ?></td>
			   <td align="left"><?= $ci_languages['name']; ?></td>
			   <td align="left"><?= $ci_languages['code']; ?></td>
			   <td align="center"><?php if($ci_languages['image']) echo '<img src="'.base_url().'images/languages/'.$ci_languages['image'] . '" class="image-ads"  border="0">'; ?></td>
				<td class="edit">
				<a href = "<?= $modify_url."/".$ci_languages["id"]; ?>" ><?=img('images/i_edit.gif')?></a>
					</td>
				<td class="delete">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$ci_languages["id"]; ?>" ><?=img('images/i_delete.gif')?></a>
				</td>
			</tr>
			<? } ?>
		</table>
		<div style="float:left;"><?=$page_links?></div>			
		<div style="float:right;"><?= anchor ($add_url, 'Thêm ngôn ngữ', array('class' => 'addButton'));?></div>
		</div>
</div>