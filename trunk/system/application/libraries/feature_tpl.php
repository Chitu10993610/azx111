							<?php foreach ($aryNewsList as $aryNews) { ?>
							<div class="top_new">
								<div><a  href="#"><?php 
   if($aryNews['news_image']) {
		?>
			<a href="<?=base_url()?>tin-tuc/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img style="border:#333333 solid 0px;" src="<?=base_url()?>images/news/.thumbs/.<?=$aryNews["news_image"]?>" alt="<?=$aryNews['news_title']?>" height="235" width="300"/></a>
			<?
   }
   else {
   ?>
   			<a title="" href="<?=base_url()?>tin-tuc/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img style="border:#333333 solid 0px;" src="<?php echo site_url().'images/house_no_im.jpg';?>" alt="<?=$aryNews['news_title']?>" height="235" width="300"/></a>
   <?}?></a></div>
								<div style="padding-top:5px;">
									<a class="top_new_tile" href="<?=base_url()?>tin-tuc/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><?=$this->front_lib->cut_string($aryNews["news_title"], 50)?></a>
								</div>
								<div class="top_new_text" >
									<span ><?=$this->front_lib->cut_string($aryNews["intro_content"], 150)?></span>
								</div>
							</div>
							<?}?>
