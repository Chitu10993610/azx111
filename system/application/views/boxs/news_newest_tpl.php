<?php foreach ($aryNewsList as $aryNews) { ?>	
	<div id="house_newest">
		<div id="house_newest_img">
		<?php 
   if($aryNews['news_image']) {
		?>
			<a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img src="<?=base_url()?>images/news/.thumbs/.<?=$aryNews["news_image"]?>" alt="<?=$aryNews['news_title']?>" height="42" width="42"/></a>
			<?
   }
   else {
   ?>
   			<a title="" href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img src="<?php echo site_url().'images/house_no_im.jpg';?>" alt="<?=$aryNews['news_title']?>" height="42" width="42"/></a>
   <?}?>
			</div>
		<div id="house_newest_info">
				<span class="sub_title_left"><a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><?=$this->front_lib->cut_string($aryNews["news_title"], 35)?></a></span><br />
				<?=$this->front_lib->cut_string($aryNews["intro_content"], 60)?><br/>					
		</div>
	</div>
<!--	<div class="line"></div>-->
<?}?>