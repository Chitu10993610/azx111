<?php foreach ($aryNewsList as $aryNews) { ?>
<div class="box3_3_box" >
<?php $thumb = ($aryNews["news_image"]) ? $this->front_lib->get_thumb($aryNews["news_image"]) : '';?>
<div style="background-image: url('images/news/<?=$thumb?>')" class="imgvip_95_80">
			<a rel="thumbnail" href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
<!--				<img height="80" width="95" src="images/spacer.gif" title="Xem ảnh">-->
				<img height="80" width="95" src="images/news/<?=$thumb?>" title="Xem chi tiết">
			</a>
		</div>
<div style="width:95px; height:30px; text-align:center;overflow:hidden"><a  href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><?=$this->front_lib->cut_string($aryNews["intro_content"], 35)?></a></div>
</div>
<?}?>