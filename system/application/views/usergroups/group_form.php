<div id="content" class="narrowcolumn">
<?php 
	$this->lang->load('userauth', $this->session->userdata('ua_language')); 

	echo '<h2>'.$form_title.'</h2>';
	if (isset($msg)) { echo "<p class=\"error\">$msg</p>"; }

	if ($mode == 'add') { 
?>
	<div id="addGroup">
	<form id="add_group" name="add_group" method="post" action="<?= site_url('admin/usergroups/addGroup');?>">
			<p>
			<label for="groupname"><?= $this->lang->line('ua_groupname');?></label> <?=$this->validation->groupname_error; ?>
			<input name="groupname" type="text" id="groupname" size="30" value="<?php echo set_value('groupname'); ?>" /> 
			</p><p>
			<label for="groupdescription">
				<?= $this->lang->line('ua_groupdescription').'&nbsp;('
					.$this->lang->line('ua_255_char_max').')';?></label> <?=$this->validation->groupdescription_error; ?><br />
			<textarea name="groupdescription" cols="60" rows="3" id="groupdescription"><?=set_value('groupdescription');?></textarea>
			</p><p>
			<input type="hidden" name="groupid" value="<?= $groupid;?>" />
			<input type="submit" value="<?= $button;?>" />
			</p>
		</form>
	</div>

<?php } elseif ( $mode == 'edit') { ?>

	<div id="editGroup">
		<form id="add_group" name="add_group" method="post" action="<?= site_url('admin/usergroups/editGroup');?>">
			<input type="hidden" name="groupid" value="<?= $groupid;?>" />
			<p>
			<label for="groupname"><?= $this->lang->line('ua_groupname');?></label> 
			<input name="groupname" type="text" id="groupname" size="30" value="<?php echo set_value('groupname', $groupinfo->groupname); ?>" /> <?=$this->validation->groupname_error; ?>
			</p><p>
			<label for="groupdescription">
				<?= $this->lang->line('ua_groupdescription').'&nbsp;('
					.$this->lang->line('ua_255_char_max').')';?></label> <?=$this->validation->groupdescription_error; ?><br />
			<textarea name="groupdescription" cols="60" rows="3" id="groupdescription"><?= set_value('groupdescription', $groupinfo->description);?></textarea>
			</p><p>
			<input type="submit" value="<?= $button;?>" />
			</p>
		</form>
	</div>

<?php } else { echo $this->lang->line('ua_form_mode_error'); } ?>
</div>