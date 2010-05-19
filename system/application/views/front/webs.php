<link rel="stylesheet" href="<?=base_url()?>css/style-news.css" type="text/css" media="screen">
<div id="danhsachtin">
<?php
$n = sizeof($aryList);
 for($i = 0; $i < $n; $i++) {
 	$aryNews = $aryList[$i];
?>
		<div class="one_news">
			<a target="_blank" href="<?=$aryNews["webs_url"]?>"><img width="88" border="0" align="left" src="<?=base_url()?>images/webs/<?=$aryNews["image"]?>"/></a>
			<div class="content">
				<div class="title" style="width:84%"><p><a target="_blank" href="<?=$aryNews["webs_url"]?>"><?=$aryNews["webs_url"]?> - <?=$aryNews["webs_title"]?></p></a></div>
				<div class="data"><?=$aryNews["description"]?></div>
			</div>
		</div>
<?php
}
?>
</div><!--/danhsachtin-->
<div class="pagination"><?=$page_links?></div>
