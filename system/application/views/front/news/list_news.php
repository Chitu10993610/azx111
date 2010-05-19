<link rel="stylesheet" href="css/style_news.css" type="text/css" />
<?php
if(!$numOfNews) {
	echo "Xin lỗi bạn! Mục tin này đang đc cập nhật, xin vui lòng quay lại sau";
}
else {
$n = sizeof($aryNewsMainList);
$d = ($n < 10) ? $n : 10;
$aryNews = $aryNewsMainList[0];
?>
<div class="noidung-trai-01">
	<div class="noidung-trai-01-titlemodule"><div class="noidung-trai-01-titlemodule-text"><?=$current_cat_name?></div></div>
	<div class="noidung-trai-01-content">
		<div class="noidung-trai-01-content-img"><a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>"><img width="216" style="border: 0px none;" src="images/news/<?=$aryNews["news_image"]?>"></a></div>
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

<div class="noidung-trai-02cap2">
<?php
for($i = 1; $i < $d; $i++) {
$aryNews = $aryNewsMainList[$i];
$thumb = ($aryNews["news_image"])? $this->front_lib->get_thumb($aryNews["news_image"]) : '';
?>
	<div class="noidungcap2-01" <?if($i == $d-1) echo 'style="border-bottom:none"';?>>
		<div class="noidungcap2-01-title"><a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>" class="noidungcap2-01-title-link"><?=$aryNews["news_title"]?></a></div>
		<div class="noidungcap2-01-content">
			<div class="baiviet-img" style="background: url('<?=base_url()?>images/news/<?=$thumb?>') no-repeat scroll center center transparent;">
				<a rel="thumbnail" href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>">
					<img height="100" width="126" src="images/spacer.gif" title="Xem ảnh">
				</a>
			</div>
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
<?php
if($n > 10) {
?><div class="noidung-trai-01">
	<div class="noidung-trai-01-titlemodule"><div class="noidung-trai-01-titlemodule-text"> Các tin đã đăng</div></div>
	<div class="noidung-trai-01-content-ctdd"><br>
	<ul class="news_other">
	<?php
for($i = 10; $i < $n; $i++) {
$aryNews = $aryNewsMainList[$i];
?>
    <li>
      <a href="tin-tuc/<?=$aryNews["cat_id"]?>/<?=$aryNews["news_id"]?>/<?=$aryNews['news_title_sef']?>" class="tin1-text-link"><?=$aryNews['news_title']?><span class="tin1-date">&nbsp;(<?=date("d/m", $aryNews['create_date'])?>) <?=$aryNews['source']?></span></a>
   	</li>
		<?}?>
		</ul>
	</div>
	<div class="boduoicap2"></div>
<!--	<div class="xentiep-cap2-2"><a href="#" class="xentiep-cap2-2-link">Xem tiếp...</a></div>-->
	</div>
	<div class="cactindadua">
		<div class="date">Các tin đã đưa ngày:</div>
		<form action="<?=$url?>" method="post" name="form1">
		<div class="box">
			    <select size="1" name="day">
			      <?php
				$aryDate = getdate(time());
			      for($i = 1; $i < 32; $i++) {
			      	$selected = ($aryDate['mday'] == $i) ? 'selected = "selected"' : '';
			      	echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
			      }
			      ?>
		        </select>
			    <select size="1" name="month">
			      <?php 
			      
			      for($i = 1; $i <= 12; $i++) {
			      	$selected = ($aryDate['mon'] == $i) ? 'selected = "selected"' : '';
			      	echo '<option '.$selected.' value="'.$i.'">Tháng '.$i.'</option>';
			      }
			      ?>
		        </select>
			    <select size="1" name="year">
			      <?php 
			      for($i = 2005; $i <= date('Y', time()); $i++) {
			      	$selected = ($aryDate['year'] == $i) ? 'selected = "selected"' : '';
			      	echo '<option '.$selected. 'value="'.$i.'">'.$i.'</option>';
			      }
			      ?>
		        </select>
				  <label>
				  <input type="submit" value="Xem" name="Xem">
				  </label>
		</div>
		</form>
	</div>
<?
}
?>
<?}?>