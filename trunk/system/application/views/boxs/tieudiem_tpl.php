<div class="phai02-trai-02-botren"></div>
<div class="phai02-trai-04-content">
<?php if(is_array($aryNewsList)) foreach ($aryNewsList as $aryNews) { ?>
	<div class="forumhang1a">
	<?php $thumb = ($aryNews["news_image"]) ? $this->front_lib->get_thumb($aryNews["news_image"]) : '';?>
		<div style="background: url('<?=base_url()?>images/news/<?=$thumb?>') no-repeat scroll center 30% transparent;" class="imgvip">
			<a rel="thumbnail" href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
				<img height="53" width="53" src="images/spacer.gif" title="Xem ảnh">
			</a>
		</div>
		<div class="forumhang1a-title"><a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>" class="forumhang1a-text-link"><?=$this->front_lib->cut_string($aryNews["news_title"], 55)?></a></div>
	</div>
<?}?>
<div style="clear:both"></div>
</div>
<div class="phai02-trai-02-boduoi"></div>