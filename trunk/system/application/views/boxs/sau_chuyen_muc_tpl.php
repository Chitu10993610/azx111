<?php foreach ($aryNewsList as $aryNews) { ?>							
<div style="margin:8px 0"><a href="front/tin_tuc/<?=$cat_id?>" class="box2_1_head"><?=$box_title['cat_name']?></a></div>
<div style="text-align:justify">
   <?php $thumb = ($aryNews["news_image"]) ? $this->front_lib->get_thumb($aryNews["news_image"]) : '';?>
<div style="background: url('images/news/<?=$thumb?>') no-repeat scroll center center transparent;" class="img_vip_100_70">
			<a rel="thumbnail" href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
				<img height="70" width="100" src="images/spacer.gif" title="Xem ảnh">
			</a>
		</div>
</div>
<div style="height: 45px; font-weight:bold;text-align: left; overflow: hidden;"><a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"  class="box2_1_contet"><?=$this->front_lib->cut_string($aryNews["intro_content"], 60)?></a></div>
<?}?>