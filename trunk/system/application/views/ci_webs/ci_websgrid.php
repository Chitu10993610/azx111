<div id="content" class="narrowcolumn">
<?
   $this->load->helper('url');
   $modify_url = site_url('webs/modify/');
   $delete_url = site_url('webs/delete/');
   $add_url    = site_url('webs/add/');

?>
<h3><a href="javascript:divToogle('groupsholder');">Webs List</a></h3>
	<div id="groupsholder" style="display:block;">
		<br />
		<table id="group_table" class="stripe">
			<tr>
				<th width="20" align="center">No</th>
				<th align="center" width="40">Status</th>
				<th>Title</th>
				<th>Url</th>
				<th align="center" width="120">Image</th>
				<th align="center">Edit</th>
				<th align="center">Delete</th>
			</tr>
			<?php 
			$k = 0;
			foreach ($ci_webs_list as $ci_webs) { ?>
			<tr>
			  <td align="center"><?= ++$k; ?></td>
			   <td align="center"><?php if($ci_webs['status_flg']) echo '<img src="'.base_url().'images/check.png" border="0">'; ?></td>
			   <td align="left"><?= $ci_webs['webs_title']; ?></td>
			   <td align="left"><span title="<?= $ci_webs['webs_url']; ?>"><?=substr($ci_webs['webs_url'], 0, 30); ?></span></td>
			   <td align="center"><?php if($ci_webs['image']) echo '<img width="100" src="'.base_url().'images/webs/'.$ci_webs['image'] . '" class="image-webs"  border="0">'; ?></td>
				<td class="edit">
				<a href = "<?= $modify_url."/".$ci_webs["id"]; ?>" ><?=img('images/i_edit.gif')?></a>
					</td>
				<td class="delete">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$ci_webs["id"]; ?>" ><?=img('images/i_delete.gif')?></a>
				</td>
			</tr>
			<? } ?>
		</table>
		<div style="float:left;"><?=$page_links?></div>			
		<div style="float:right;"><?= anchor ($add_url, 'Add Webs', array('class' => 'addButton'));?></div>
		</div>
</div>