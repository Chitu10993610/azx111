<link rel="stylesheet" href="<?=base_url()?>css/style-news.css" type="text/css" media="screen">
<div id="danhsachtin">
<?php
$n = sizeof($aryNewsList);
$d = ($n < 10) ? $n : 10;
 for($i = 0; $i < $d; $i++) {
 	$aryNews = $aryNewsList[$i];
?>
		<div class="one_news">
			<a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img width="88" border="0" align="left" src="<?=base_url()?>images/news/.thumbs/.<?=$aryNews["news_image"]?>"/></a>
			<div class="content">
				<div class="title" style="width:84%"><p><a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><?=$aryNews["news_title"]?></a></p><span><a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">chi tiết</a></span></div>
				<div class="data"><?=$aryNews["intro_content"]?></div>
			</div>
		</div>
<?php
}
?>
	</div><!--/danhsachtin-->
<?php
if($n > 10) {
?>
	<div id="tinkhac">
		<div class="title">CÁC TIN KHÁC</div>
		<div class="content">
		<ul>
<?php
 	for($i = 10; $i < $n; $i++) {
 		$aryNews = $aryNewsList[$i];
?>
		<li><a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><?=$aryNews["news_title"]?></a></li>
<?php
	}
?>
		</ul>
		</div>
	<div class="pagination"><?=$page_links?></div>
	</div><!--//tinkhac-->
<?}?>