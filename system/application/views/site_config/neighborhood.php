<?
$this->load->helper('url');
$action_url = site_url() . "ci_neighborhood/add/";
$num_neighborhood = sizeof($ci_neighborhood_list);

?>
<form id="neighborhood" method="POST" action="<?=$action_url?>">
<div id="container" style="padding-left:168px;">
	
	<?
	$k = 0;
         foreach ($ci_neighborhood_list as $k=>$ci_neighborhood) {
      ?>
      <div style="padding:10px;border-top:1px solid #eee;">
		&nbsp;<input type="text" id="neighborhood<?=$k?>" value="<?= $ci_neighborhood['neighborhood']; ?>" name="neighborhood[]" style="width:388px;" />&nbsp;
		<a onclick="removeItem(<?=$k?>, 'neighborhood')" href="javascript:void(0)">X</a>
	</div>
      <? } 
      if($num_neighborhood) $k++; 
      ?>
	<div style="padding:10px;border-top:1px solid #eee;">
		&nbsp;<input type="text" id="neighborhood<?=$k?>" value="" name="neighborhood[]" style="width:388px;" />&nbsp;
		<a onclick="removeItem(<?=$k?>, 'neighborhood')" href="javascript:void(0)">X</a>
	</div>
</div>
<div style="padding:5px;"><input type="button" onclick="doIt('container', 'neighborhood', <?=$num_neighborhood-1;?>)" href="javascript:void(0)" value="Add New"></div>
<div style="padding:5px;"><input name="Submit" type="submit" class="button" value="Save">&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" class="button" ></div>
<input type="hidden" name="site_name" value="<?=$site_name?>" />
</form>