							<?php foreach ($aryNewsList as $aryNews) { ?>	
											<li>
									<a href="<?=base_url()?>tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
										<?=$this->front_lib->cut_string($aryNews["news_title"], 32)?>
									</a>
											</li>
							<?}?>
