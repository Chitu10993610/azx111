<div class="menu_2" >
<ul class="menu_2_ul" >
  <?php 
	 global $curMenuid;
  	foreach ($typemenu as $aryMenu) {
		$menuid   = $aryMenu["id"];
		$menuname   = $aryMenu["name"];
?>
  <li class="menu_2_li"> <a class="menu_2_a <?if($menuid==$curMenuid){?>pm_select<?}?>" href="<?=$aryMenu["url"];?>/m<?=$menuid?>">
    <?=$menuname ?>
    </a> </li>
  <?			 
	 } ?>
</ul>
</div>