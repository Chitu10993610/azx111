<?php foreach ($aryNewsList as $aryNews) { ?>
<div style=" width:152px; height:218px; border-left:#E9F0C6 solid 1px; padding-left:2px; float:left">
										<div class="box1_1_2_1a_2"><a href="tin-tuc/<?=$cat_id?>" class="head_hautruong"><?=$box_title['cat_name'];?></a></div>
	<?php 
   if($aryNews['news_image']) {
		?>
			<a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img style="border:#333333 solid 0px;" src="<?=base_url()?>images/news/<?=$aryNews["news_image"]?>" alt="<?=$aryNews['news_title']?>" height="110" width="150"/></a>
			<?
   }
   else {
   ?>
   			<a title="" href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img style="border:#333333 solid 0px;" src="<?php echo site_url().'images/house_no_im.jpg';?>" alt="<?=$aryNews['news_title']?>" height="110" width="150"/></a>
   <?}?></a>
									  
	<div style="height: 85px; text-align: justify; overflow: hidden;margin-right:2px;">
		<a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>" class="title_ht_tc" ><?=$this->front_lib->cut_string($aryNews["news_title"], 50)?></a><br>
		<span style="font-size:11px;"><?=$this->front_lib->cut_string($aryNews["intro_content"], 130)?></span>
	</div>

										
</div>
<?}?>