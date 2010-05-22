<?php foreach ($aryNewsList as $aryNews) { ?>						
<div class="box2_3_box">
	<div class="box2_3_box_head" >
		<span><a href="tin-tuc/<?=$cat_id?>" class="bachuyenmuc"><?=$box_title['cat_name']?></a></span>
	</div>
	<div class="box2_3_box_content" >
		<?php $thumb = ($aryNews["news_image"]) ? $this->front_lib->get_thumb($aryNews["news_image"]) : '';?>
<div style="background: url('images/news/<?=$thumb?>') no-repeat scroll center transparent;" class="imgvip_125_95">
			<a rel="thumbnail" href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
				<img height="95" width="125" src="images/spacer.gif" title="Xem ảnh">
			</a>
		</div>
		<div style="width:125px; float:right;height: 100px; text-align: justify; overflow: hidden;"><a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>" class="box2_3_box_content_title_a"><b><?=$this->front_lib->cut_string($aryNews["news_title"], 39)?> </b><br><?=$this->front_lib->cut_string($aryNews["intro_content"], 125)?></a></div>
	</div>
</div>
<?}?>