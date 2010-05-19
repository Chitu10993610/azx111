<?
$this->load->helper('url');
$action_url = site_url(). "ci_culture/add/";
$num_amen = sizeof($ci_culture_list);
?>
<form id="culture" method="POST" action="<?=$action_url?>">
<div id="div_culture" style="padding-left:168px;">
	
	<?
	$router = 0;
         foreach ($ci_culture_list as $router => $ci_culture) {
      ?>
      <div style="padding:10px;border-top:1px solid #eee;">
		<span></span>
		&nbsp;<input type="text" id="amen<?=$router?>" value="<?= $ci_culture['culture']; ?>" name="neighborhood[]" style="width:388px;" />&nbsp;
		<a onclick="removeItem('<?=$router?>', 'amen')" href="javascript:void(0)">X</a>
	</div>
      <? }
      if($num_amen) $router++; 
      ?>
	<div style="padding:10px;border-top:1px solid #eee;">
		<span></span>
		&nbsp;<input type="text" id="amen<?=$router?>" value="" name="neighborhood[]" style="width:388px;" />&nbsp;
		<a onclick="removeItem('<?=$router?>', 'amen')" href="javascript:void(0)">X</a>
	</div>
</div>
<div style="padding:5px;"><input type="button" onclick="doIt('div_culture', 'amen', <?=$num_amen-1?>)" href="javascript:void(0)" value="Add New"></div>
<div style="padding:5px;"><input name="Submit" type="submit" class="button" value="Save">&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" class="button" ></div>
<input type="hidden" name="site_name" value="<?=$site_name?>" />
</form>