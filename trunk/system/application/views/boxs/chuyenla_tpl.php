<?php foreach ($aryNewsList as $aryNews) { ?>
<div  class="box1_2_box">
		<div class="box1_2_box_head">
			<span>chuyện lạ</span>
		</div>
		<div>
			<?php 
   if($aryNews['news_image']) {
		?>
			<a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img style="border:#333333 solid 0px;" src="<?=base_url()?>images/news/<?=$aryNews["news_image"]?>" alt="<?=$aryNews['news_title']?>" height="80" width="135"/></a>
			<?
   }
   else {
   ?>
   			<a title="" href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img style="border:#333333 solid 0px;" src="<?php echo site_url().'images/house_no_im.jpg';?>" alt="<?=$aryNews['news_title']?>" height="110" width="150"/></a>
   <?}?></a>
		</div>
		<div><a  class="box1_2_box_content" href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><?=$this->front_lib->cut_string($aryNews["intro_content"], 90)?></a></div>
</div>
<?}?>