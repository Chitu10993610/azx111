<link rel="stylesheet" href="css/style_news.css" type="text/css" />
<?php
if(!$numOfNews) {
	echo "Xin lỗi bạn! Mục tin này đang đc cập nhật, xin vui lòng quay lại sau";
}
else {
$n = $numOfNews;
$d = ($n < 10) ? $n : 10;
$aryNews = $aryNewsMainList[0];
?>
<div class="noidung-trai-01">
	<div class="hearder_search_result"><div class="noidung-trai-01-titlemodule-text">Có <?=$numOfNews?> kết quả được tìm thấy với từ khóa <span style="color:#FF8A00"><?=$keyword_search?></span></div></div>
	<div class="noidung-trai-01-content">
		<div class="noidung-trai-01-content-img"><a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img width="216" style="border: 0px none;" src="uploads/News/pic/<?=$aryNews["news_image"]?>"></a></div>
		<div class="noidung-trai-01-content-content">
			<div class="title-cap2"><a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>" class="title-cap2-link"><?=$aryNews["news_title"]?></a></div>
			<div class="tacgia-cap2"><?=date('d/m/Y', $aryNews["create_date"])?></div>
			<div class="noidung-cap2"><?=$this->front_lib->cut_string($aryNews["intro_content"], 300)?></div>
		</div>
		<div class="xemtiep-cap2"><a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>" class="xemtiep-cap2-link">Xem tiếp &gt;&gt;</a></div>
		<div style="clear:both;"></div>
	</div>
	<div class="boduoicap2"></div>
</div>
<?php
if($n > 1) {
	?>
<div class="noidung-trai-02cap2">
<?php
for($i = 1; $i < $d; $i++) {
$aryNews = $aryNewsMainList[$i];
?>
	<div class="noidungcap2-01" <?if($i == $d-1) echo 'style="border-bottom:none"';?>>
		<div class="noidungcap2-01-title"><a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>" class="noidungcap2-01-title-link"><?=$aryNews["news_title"]?></a></div>
		<div class="noidungcap2-01-content">
			<div class="noidungcap2-01-content-img"><a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img width="135" style="border: 0pt none;" src="uploads/News/pic/.thumbs/.<?=$aryNews["news_image"]?>"></a></div>
			<div class="noidungcap2-01-content-ct">
				<div class="noidungcap2-01-content-ct-tacgia"><?=date('d/m/Y', $aryNews["create_date"])?></div>
				<div class="noidungcap2-01-content-ct-text"><?=$this->front_lib->cut_string($aryNews["intro_content"], 300)?></div>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="xemtiep-cap2"><a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>" class="xemtiep-cap2-link">Xem tiếp &gt;&gt;</a></div>
		<div style="clear:both;"></div>
	</div>
<?php
}
?>
</div>
<div class="boduoicap2"></div>
<p></p>
<?}?>

	<div class="cactindadua">
		<?=$page_links?>
	</div>
<?}?>