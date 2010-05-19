<div id="content" class="narrowcolumn">
<h3><a href="javascript:divToogle('apholder');"><?= $this->lang->line('ua_manage_ap'); ?></a></h3>
	<?php
		if (isset($apmsg)) {
			echo "<p class=\"error\" id=\"apmsg\">$apmsg</p>";
		}
	?>

	<div id="apholder" style="display:block;">
		<?= anchor ('admin/usergroups/addap', 
			$this->lang->line('ua_addap'), array('class' => 'addButton'));?>
		<table id="ap_table" class="stripe">
			<tr>
				<th><?= $this->lang->line('ua_ap'); ?></th>
				<th><?= $this->lang->line('ua_description'); ?></th>
				<th align="center"><?= $this->lang->line('ua_edit'); ?></th>
				<th align="center"><?= $this->lang->line('ua_remove'); ?></th>
			</tr>
			<?php foreach ($listAllAps->result() as $ap): ?>
			<tr>
				<td><?= $ap->apname;?></td>
				<td><?= $ap->description;?></td>
				<td class="edit"><?= anchor ('admin/usergroups/editap/'.$ap->apid, 
						img('images/i_edit.gif'));?></td>
				<td class="delete" nowrap="nowrap">
 					<?= anchor ('admin/usergroups/removeap/'.$ap->apid, 
						img('images/i_delete.gif'), "onclick=\"if (!confirm('Are you sure you want to delete selected items?')) return false;\"");?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>