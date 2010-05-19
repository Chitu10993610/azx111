<link rel="stylesheet" href="<?=base_url()?>css/style-news.css" type="text/css" media="screen">
<div id="content" class="narrowcolumn">
	<div class="detail_tinnhadat">
			<div class="title"><?=$aryNewsInfo['news_title']?><p><?=date("d/m/Y h:i", $aryNewsInfo['create_date'])?></p>
			</div>
			<div class="content"><p><strong><?=$aryNewsInfo['intro_content']?></strong></p>
				<img border="0" align="left" style="margin-right: 15px;" src="<?=base_url()?>images/news/<?=$aryNewsInfo["news_image"]?>"/>
			<?=$aryNewsInfo['news_content']?>
			</div>
			<div class="tool_news"><br/><a style="cursor:pointer;" onclick='window.open("<?=base_url()?>front/news_print/<?=$aryNewsInfo['news_id']?>", "bandeIn", "width=688, height=625, scrollbars=1, resizable=no, menubar=no");'><img border="0" align="absbottom" src="<?=base_url()?>images/icons/icon_print.gif"/>Bản in</a> <a style="" onclick='window.open("http://nhadat.timnhanh.com?m=news&amp;a=send_to_friend&amp;c=tin_tuc_nha_dat&amp;s=phong_thuy&amp;i=84598&amp;suppressHeaders=1", "goibanbe", "width=810, height=625, scrollbars=1, resizable=no, menubar=no");'><!--<img border="0" align="absbottom" src="<?=base_url()?>images/icons/send_mail.gif"/> Gởi cho bạn bè</a>--> <a href="javascript:history.back()"><img border="0" align="absbottom" src="<?=base_url()?>images/icons/back.gif"/> Trở về	</a></div>
		</div>

		
		<div id="bookmark" style="float:left; width:200px; margin-bottom:10px;">
			<!-- AddThis Button BEGIN -->
			<a href="http://www.addthis.com/bookmark.php?v=250&pub=xa-4a4b668923d2e08c" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/static/btn/lg-bookmark-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js?pub=xa-4a4b668923d2e08c"></script>
			<!-- AddThis Button END -->
		</div><!--bookmark-->
		<?php
			if(isset($aryNewsList) && is_array($aryNewsList) && sizeof($aryNewsList)) {
		?>
			<div id="tinkhac">
		<div class="title">CÁC TIN KHÁC</div>
		<div class="content">
		<ul>
			<?php
			foreach ($aryNewsList as $aryNews) {
				?>
			<li><a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><?=$aryNews["news_title"]?></a></li>
			<?php
			}
			?>
			
		</ul>
		</div>
	<div class=""></div>
	</div><!--//tinkhac-->
		<?php
			}
			?>
</div>