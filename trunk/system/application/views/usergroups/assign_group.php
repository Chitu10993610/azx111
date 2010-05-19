<div id="content" class="narrowcolumn">
<h2 class="main help"><?=$form_title?></h2><br>
<div style="padding-left:200px;">
<form action="" method="POST" class="popupform">

<label for="group_assign">Group to assign</label><span style="padding-left:26px">
<select id="group_assign" name="groupid" onchange="submit();">
   <option value="">Select group</option>
<?php if(isset($listAllGroups)) foreach ($listAllGroups->result() as $group): ?>
				<option value="<?= $group->groupid;?>" <?php if($group->groupid == $this->input->post('groupid', TRUE)) echo "selected";?>><?= $group->groupname;?>
				</option>
<?php endforeach; ?>
</select>
</span>
<input type="hidden" name="appid" value="<?=$this->input->post('appid', TRUE)?>">
</form>
</div>
<div class="box generalbox generalboxcontent boxaligncenter">
<form id="assignform" method="post" action="">
<input name="groupid" value="<?=$this->input->post('groupid', TRUE)?>" type="hidden">
<input name="appid" value="<?=$this->input->post('appid', TRUE)?>" type="hidden">
<table summary="" style="margin-left: auto; margin-right: auto;" border="0" cellpadding="5" cellspacing="0">
    <tbody><tr>
      <td valign="top">
          <label for="removeselect"><?=(isset($listUsers)) ? $listUsers->num_rows() : 0;?> existing users</label>
          <br>
          <select style="width:280px;" name="removeselect[]" size="20" id="removeselect" multiple="multiple" onfocus="getElementById('assignform').add.disabled=true;
                           getElementById('assignform').remove.disabled=false;
                           getElementById('assignform').addselect.selectedIndex=-1;">
         			<?php if(isset($listUsers)) foreach ($listUsers->result() as $user): ?>
						<option value="<?=$user->userid;?>" ><?=$user->fullname;?></option>
					<?php endforeach; ?>
          </select></td>
      <td valign="top">
        <br>
        <label title="Hidden assignment"><span class="helplink"><a title="Help with Hidden assignment (new window)" href="http://localhost/moodle18/help.php?module=moodle&amp;file=hiddenassign.html&amp;forcelang=" onclick="this.target='popup'; return openpopup('/help.php?module=moodle&amp;file=hiddenassign.html&amp;forcelang=', 'popup', 'menubar=0,location=0,scrollbars,resizable,width=500,height=400', 0);"></a></span></label>
                <p class="arrow_button">
            <input disabled="disabled" name="add" id="add" value="◄&nbsp;Add" title="Add" type="submit"><br>
            <input disabled="disabled" name="remove" id="remove" value="Remove&nbsp;►" title="Remove" type="submit">
        </p>
      </td>
      <td valign="top">
          <label for="addselect"><?=(isset($listAllUsers)) ? $listAllUsers->num_rows() : 0;?> potential users</label>
          <br>
          <select style="width:280px;" name="addselect[]" size="20" id="addselect" multiple="multiple" onfocus="getElementById('assignform').add.disabled=false;
                           getElementById('assignform').remove.disabled=true;
                           getElementById('assignform').removeselect.selectedIndex=-1;">
          <?php if(isset($listAllUsers)) foreach ($listAllUsers->result() as $user): ?>
					<option value="<?=$user->userid;?>" ><?=$user->fullname;?></option>
				<?php endforeach; ?>
		</select>
         <br>
         <!--<label for="searchtext" class="accesshide">Tìm kiếm</label>
         <input name="searchtext" id="searchtext" size="30" value="" onfocus="getElementById('assignform').add.disabled=true;
                            getElementById('assignform').remove.disabled=true;
                            getElementById('assignform').removeselect.selectedIndex=-1;
                            getElementById('assignform').addselect.selectedIndex=-1;" onkeydown="var keyCode = event.which ? event.which : event.keyCode;
                               if (keyCode == 13) {
                                    getElementById('assignform').previoussearch.value=1;
                                    getElementById('assignform').submit();
                               } " type="text">
         <input name="search" id="search" value="Tìm kiếm" type="submit"> -->
                </td>
    </tr>
  </tbody></table>
</form>
</div>
</div>