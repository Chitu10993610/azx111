<div class="nBlock" <? if (isset($box_style) && !empty($box_style)) {?>style="<?=$box_style?>"<?}?>>
<?php if (isset($title) && !empty($title)) {?>
	<div class="box_header">
		<img align="left" src="<?=base_url()?>images/hoanghai/bg_box_l.png">
		<img align="right" src="<?=base_url()?>images/hoanghai/bg_box_r.png">
		<span><?=$title?></span>
	</div>
	<?}?>
	<div class="block_content_detail">
		<?=$content?>
		<div style="clear:both"></div>
	</div>
	<div class="box_footer">
	<img align="left" src="<?=base_url()?>images/hoanghai/bg_box_bl.gif">
	<img align="right" src="<?=base_url()?>images/hoanghai/bg_box_br.gif"> <span>&nbsp;</span> </div>
</div>