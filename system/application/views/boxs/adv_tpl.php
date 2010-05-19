<div>
<?foreach ($ads_list as $ci_ads) { 
	if($ci_ads['is_flash']) {
		?>
      <a href="<?=$ci_ads['ads_url']?>" target="_blank">
		<embed height="<?=$ci_ads['ads_height']?>" width="<?=$ci_ads['ads_width']?>" loop="true" wmode="transparent" play="true" src="<?=base_url().'images/adv/'.$ci_ads['image']?>" type="application/x-shockwave-flash"/></a>
    <?
	}else {
	?>
	<a href="<?=$ci_ads['ads_url']?>" target="_blank"><img border="0" src="<?=base_url().'images/adv/'.$ci_ads['image']?>" /></a>
<?}
}?>
</div>