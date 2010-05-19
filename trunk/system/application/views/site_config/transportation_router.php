<?
$this->load->helper('url');
$action_url = site_url(). "ci_transportation_router/add/";
$num_transportation = sizeof($ci_transportation_router_list);
?>
<form id="transportation_router" method="POST" action="<?=$action_url?>">
<div id="div_transportation_router" style="padding-left:168px;">
	
	<?
	$router = 0;
         foreach ($ci_transportation_router_list as $router => $ci_transportation_router) {
      ?>
      <div style="padding:10px;border-top:1px solid #eee;">
		<span></span>
		&nbsp;<input type="text" id="transportation<?=$router?>" value="<?= $ci_transportation_router['transportation_router']; ?>" name="neighborhood[]" style="width:388px;" />&nbsp;
		<a onclick="removeItem('<?=$router?>', 'transportation')" href="javascript:void(0)">X</a>
	</div>
      <? }
      if($num_transportation) $router++; 
      ?>
	<div style="padding:10px;border-top:1px solid #eee;">
		<span></span>
		&nbsp;<input type="text" id="transportation<?=$router?>" value="" name="neighborhood[]" style="width:388px;" />&nbsp;
		<a onclick="removeItem('<?=$router?>', 'transportation')" href="javascript:void(0)">X</a>
	</div>
</div>
<div style="padding:5px;"><input type="button" onclick="doIt('div_transportation_router', 'transportation', <?=$num_transportation-1?>)" href="javascript:void(0)" value="Add New"></div>
<div style="padding:5px;"><input name="Submit" type="submit" class="button" value="Save">&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" class="button" ></div>
<input type="hidden" name="site_name" value="<?=$site_name?>" />
</form>