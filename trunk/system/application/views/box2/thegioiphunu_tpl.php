<div class="box2_4_2_bg">
	<div  class="box2_4_2_left">
		<div class="box2_4_2_right">
			<div class="box2_4_2_head"><span><a href="tin-tuc/19" ><?=$cat_name?></a></span></div>
			<ul class="box2_4_2_ul" >
				<?=$thegioiphunu?>
		
			
			<?php foreach ($aryNewsList as $aryNews) { ?>	
			<li >
					<a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
						<?=$this->front_lib->cut_string($aryNews["news_title"], 36)?>
					</a>
			</li>
			<?}?>
		</ul>	
		</div>
	</div>
</div>

