<div style="width:825px; height: auto;font-family:times New Roman;">
	<div style="width:200px; height: auto; float:left; background:#CCCCCC">	
	<?=$ads_left?>
	</div>
	
	<div style="width:620px;height: auto; margin-left:5px;float:left;padding-bottom:15px;line-height:19px;font-size:16px;">
		<div style=" width:620px; height:20px; color:#8e8e8e; font-weight:bold;"> <span style="float:right; padding-right:10px;"><?=date("d/m/Y h:i", $aryNewsInfo['create_date'])?></span></div>
		<div style="width:620px; height:20px; border-bottom: #333333 1px  dashed;"><span style="color:#830c0e; text-transform:uppercase; font-weight:bold;  ">Tin tức</span></div>
		<div style="height:18px; width:620px; margin-top:2px;">			<a href="http://www.addthis.com/bookmark.php?v=250&pub=xa-4a4b668923d2e08c" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img style="margin-left:420px;" src="http://s7.addthis.com/static/btn/lg-bookmark-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js?pub=xa-4a4b668923d2e08c"></script>
		<a style="cursor:pointer;" onclick='window.open("<?=base_url()?>front/news_print/<?=$aryNewsInfo['news_id']?>", "bandeIn", "width=688, height=625, scrollbars=1, resizable=no, menubar=no");'><img border="0" align="absbottom" src="<?=base_url()?>images/icons/icon_print.gif"/>Bản in</a>
		</div>
		<div>
			<span style="font-weight:bold;color:#01458E;font-size:14px;"><?=$aryNewsInfo['news_title']?></span>
			<div style="width:620px; height:auto; margin-top:5px; font-size:14px; text-align:justify"><p><strong style="color:#5F5F5F"><?=$aryNewsInfo['intro_content']?></strong><br>

			<?=$aryNewsInfo['news_content']?>	
	</div>
	</div">
			<?php
			if(isset($aryNewsList) && is_array($aryNewsList) && sizeof($aryNewsList)) {
		?>
	<div style="width:620px; height:25px; background:url(bg_cactinkhac.gif) no-repeat bottom left; margin-top:10px;">
	<span style="width:150px; height:22px; text-transform:uppercase; font-weight:bold; padding-right:20px; background:url(<?=site_url()?>/images/IMAGE/icon_title_tinkhac.gif) no-repeat right center; color:#FF0000">Các tin khác</span></div>
	<ul style="margin:0px; padding:0px; list-style:none">
	<?php
			foreach ($aryNewsList as $aryNews) {
				?>	
	<li style="padding-left:20px; padding-top:5px; font-family:Times New Roman;">
			<a  class="list_news" href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><?=$aryNews["news_title"]?> <?=date("(d/m)", $aryNewsInfo['create_date'])?></a>
		</li>
				<?php
			}
			?>			
	</ul>
<div style="float:right;padding-right:25px;">		<a href="javascript:history.back()"><img border="0" align="absbottom" src="<?=base_url()?>images/icons/back.gif"/> Trở về	</a></div>
	</div>
<?php
			}
			?>
	
			</div>
			</div>