						<div class="box3_1_head">
							<span><a href="tin-tuc/21" class="box1_2_box_head_a"><?=$box_title['cat_name']?></a></span>
						</div>
						<ul class="box3_1_ul">
														<?php foreach ($aryNewsList as $aryNews) { ?>	
							<li >
									<a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
										<?=$this->front_lib->cut_string($aryNews["news_title"], 32)?>
									</a>
							</li>
							<?}?>

						</ul>