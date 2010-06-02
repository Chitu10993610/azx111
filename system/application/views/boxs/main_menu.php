<div class="menu_top_bg">
  <div class="menu_top_left" >
    <div class="menu_top_right" >
      <ul class="menu_top_ul">
                <?php 
                	global $curMenuid;
					foreach ($typemenu1 as $aryMenu) {
						$menuid   = $aryMenu["id"];
						$menuname   = $aryMenu["name"];
					?>  
					      <li class="menu_top_li">  <a class="menu_top_a <?if($menuid == $curMenuid){?> pm_select<?} ?>"  href="<?=($aryMenu["url"] && $aryMenu["url"] != './') ? $aryMenu["url"] :'front/index';?>/m<?=$menuid?>">
					        <?= $menuname ?>
					        </a></li>
					        <?
					} ?>
      </ul>
    </div>
  </div>
</div>