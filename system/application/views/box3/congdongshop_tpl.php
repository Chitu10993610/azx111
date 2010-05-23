<?php 
$i = 0;
foreach ($aryCatList as $aryCat) {
	$box_class = ($i % 2 == 0) ? 'margin-right:5px;' : '';
	?>
	<div class="box3_1" style="<?=$box_class?>">
							<div class="box3_1_head">
							<span><a href="<?=$aryCat['cat_id']?>" class="box1_2_box_head_a"><?=$aryCat['cat_name']?></a></span>
						</div>
						<ul class="box3_1_ul">
														<?php
	foreach ($aryCat['aryNewsList'] as $aryNews) { 
		?>	
							<li >
									<a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
										<?=$this->front_lib->cut_string($aryNews["news_title"], 32)?>
									</a>
							</li>
							<?}
	$i++;
	?>

						</ul>
							
	</div>
<?php }?>