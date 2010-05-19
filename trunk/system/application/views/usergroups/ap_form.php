<div id="content" class="narrowcolumn">
<?php 
	$this->lang->load('userauth', $this->session->userdata('ua_language')); 

	echo '<h2>'.$form_title.'</h2>';
	if (isset($msg)) { echo "<p class=\"error\">$msg</p>"; }

	if ($mode == 'add') { 
?>
	<div id="addAp">
		<form id="add_ap" name="add_ap" method="post" action="<?= site_url('admin/usergroups/addAp');?>">
			<p>
			<label for="apname"><?= $this->lang->line('ua_apname');?></label> <?=$this->validation->apname_error; ?>
			<input name="apname" type="text" id="apname" size="30" value="<?=$this->validation->apname;?>" /> 
			</p><p>
			<label for="apdescription">
				<?= $this->lang->line('ua_apdescription').'&nbsp;('
					.$this->lang->line('ua_500_char_max').')';?></label> <?=$this->validation->apdescription_error; ?><br />
			<textarea name="apdescription" cols="60" rows="3" id="apdescription"><?=$this->validation->apdescription;?></textarea>
			</p><p>
			<input type="submit" value="<?= $this->lang->line('ua_addap');?>" />
			</p>
		</form>
	</div>

<?php } elseif ( $mode == 'edit') { ?>

	<div id="editAp">
		<form id="add_ap" name="add_ap" method="post" action="<?= site_url('admin/usergroups/editAp');?>">
			<input type="hidden" name="apid" value="<?= $apid;?>" />
			<p>
			<label for="apname"><?= $this->lang->line('ua_apname');?></label> 
			<input name="apname" type="text" id="apname" size="30" value="<?= ($this->validation->apname_error) ? ($this->validation->apname) : ($apinfo->apname);?>" /> <?=$this->validation->apname_error; ?>
			</p><p>
			<label for="apdescription">
				<?= $this->lang->line('ua_apdescription').'&nbsp;('
					.$this->lang->line('ua_500_char_max').')';?></label> <?=$this->validation->apdescription_error; ?><br />
			<textarea name="apdescription" cols="60" rows="3" id="apdescription"><?= ($this->validation->apdescription_error) ? ($this->validation->apdescription) : ($apinfo->description);?></textarea>
			</p><p>
			<input type="submit" value="<?= $this->lang->line('ua_editap');?>" />
			</p>
		</form>
	</div>

<?php } else { echo $this->lang->line('ua_form_mode_error'); } ?>
</div>