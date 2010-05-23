<?php 
$i = 0;
foreach ($aryCatList as $aryCat) {
	$box_class = ($i % 2 == 0) ? 'box1_2_box_left' : 'box1_2_box_right';
	?>
	<div class="<?=$box_class?>">
	<?php
	foreach ($aryCat['aryNewsList'] as $aryNews) { 
		?>
			<div class="box1_2_box_head">
				<span><a href="tin-tuc/<?=$aryCat['cat_id']?>" class="box1_2_box_head_a"><?=$aryCat['cat_name']?></a></span>
			</div>
			<?php $thumb = ($aryNews["news_image"]) ? $this->front_lib->get_thumb($aryNews["news_image"]) : '';?>
	<div style="background-image: url('images/news/<?=$thumb?>');" class="imgvip_home">
				<a rel="thumbnail" href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
					<img height="80" width="135" src="images/spacer.gif" title="Xem ảnh">
				</a>
			</div>
			<div style="height:44px;width:140px; text-align:left;overflow:hidden"><a  class="box1_2_box_content" href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><?=$this->front_lib->cut_string($aryNews["intro_content"], 70)?></a></div>
	
	<?}
	$i++;
	?>
	</div>
<?php }?>