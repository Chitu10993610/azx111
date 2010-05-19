<form action="<?= site_url('admin/usergroups/perm');?>" name="perm" method="POST">
<div id="content" class="narrowcolumn">
<h2 class="main help"><?=$form_title?></h2><br>
<div style="width:500px;float:right; padding-bottom:5px;">
Chọn nhóm user <select name="groupid" onchange="submit();">
<option value="">Tất cả</option>
<?php foreach ($form['aryGroup'] as $groupId => $groupname): ?>
<option <?=($groupid_selected == $groupId) ? "selected":""?> value="<?=$groupId?>"><?=$groupname?></option>
<?php endforeach; ?>
</select>

<!--Select Application-->
Chọn nhóm chức năng <select name="appid" onchange="submit();">
<option value="">Tất cả</option>
<?php foreach ($form['permissions'] as $appKey => $aryApp): ?>
<option <?=($appid_selected == $appKey) ? "selected":""?> value="<?=$appKey?>"><?=$appKey?></option>
<?php endforeach; ?>
</select>
</div>
<table id="permissions" cellspacing="0" style="border-collapse:collapse;" width="100%" cellpadding="3">
 <thead><tr>
   <th width="100">Application</th>
   <th width="200">Permisson</th>
   <?php foreach ($form['group_names'] as $groupname): ?>
   <th align="center"><?=$groupname?></th>
   <?php endforeach; ?>
   </tr></thead>
<?php foreach ($form['permissions'] as $appKey => $aryApp): 
if(empty($appid_selected) || ($appid_selected && $appid_selected == $appKey)) {
?>
<tr class="odd">
	 <td class="module" id="module-block" rowspan="<?=$form['rowpan'][$appKey]?>" height="30"><b><?=$appKey?></b></td>
	 </tr>
	<?php foreach ($aryApp as $group_perm => $aryPerm): ?>
	 <tr class="odd">
	 <td class="module" id="module-block" colspan="<?=sizeof($form['group_names'])+1?>" height="30"><b><?=$group_perm?></b></td> </tr>
		<?php foreach ($aryPerm as $pkey=> $perm): ?>
			<tr class="even">
			<td class="permission"><?=$perm?></td>
			<?php foreach ($form['group_names'] as $groupid => $name): ?>
				 
				 
				   <td align="center" title="<?=$perm?>">
				   <div class="form-item">
				     <label class="option"><input name="<?=$groupid?>[<?=$pkey?>]" id="edit-<?=$groupid?>-<?=$perm?>" value="<?=$perm?>" class="form-checkbox" type="checkbox"
				     <?php if($perm == $form['checkboxes'][$groupid][$appKey][$perm]) echo "checked=\"checked\""; ?> ></label>
				   </div></td>
				   
	   		<?php endforeach; ?> <!--end for group-->
	   		</tr>
	   <?php endforeach; ?> <!--end for perm-->
	<?php endforeach; ?> <!--end for group perm-->
<?php }
endforeach; ?> <!--end for app-->
</table>
<input name="submited" type="submit" value="Set permission">
</div>
</form>