<div id="content" class="narrowcolumn">
<h3><a href="javascript:divToogle('groupsholder');"><?= $this->lang->line('ua_manage_group'); ?></a></h3>
	<?php
		if (isset($groupmsg)) {
			echo "<p class=\"error\" id=\"groupmsg\">$groupmsg</p>";
		}
	?>

	<div id="groupsholder" style="display:block;">
		<?= anchor ('admin/usergroups/addgroup', 
			$this->lang->line('ua_addgroup'), array('class' => 'addButton'));?>
		<table id="group_table" class="stripe">
			<tr>
				<th><?= $this->lang->line('ua_group'); ?></th>
				<th><?= $this->lang->line('ua_description'); ?></th>
				<th align="center"><?= $this->lang->line('ua_edit'); ?></th>
				<th align="center"><?= $this->lang->line('ua_privilege'); ?></th>
				<th align="center"><?= $this->lang->line('ua_remove'); ?></th>
			</tr>
			<?php foreach ($listAllGroups->result() as $group): ?>
			<tr>
				<td><?= $group->groupname;?></td>
				<td><?= $group->description;?></td>
				<td class="edit"><?= anchor ('admin/usergroups/editgroup/'.$group->groupid,
						img('images/i_edit.gif'));?>
					</td>
				<td style="width:100px; text-align:center;"><?= anchor ('admin/usergroups/perm/'.$group->groupid, 
						img('images/icon-16N.png'));?></td>
				<td class="delete" nowrap="nowrap">
 					<?= anchor ('admin/usergroups/removegroup/'.$group->groupid, 
						img('images/i_delete.gif'), "onclick=\"if (!confirm('Are you sure you want to delete selected items?')) return false;\"");?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>