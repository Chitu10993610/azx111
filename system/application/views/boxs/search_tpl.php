<?php
		$conditions = $this->session->userdata('search_cond');
//		var_dump($conditions);
		?>
<script language="javascript">
var priceSellValue = new Array("1-150000000","150000000-300000000","300000000-600000000","600000000-1000000000","1000000000-1500000000","1500000000-2000000000","2000000000-3000000000","3000000000-0","l","1-100000-m2","100000-300000-m2","300000-500000-m2","500000-1000000-m2","1000000-2000000-m2","2000000-4000000-m2","4000000-6000000-m2","6000000-8000000-m2","8000000-10000000-m2","10000000-13000000-m2","13000000-16000000-m2","16000000-20000000-m2","20000000-0-m2"); 
var priceSellText = new Array("< 150 triệu","150 triệu - 300 triệu","300 triệu - 600 triệu","600 triệu - 1 tỷ","1 tỷ - 1.5 tỷ","1.5 tỷ - 2 tỷ","2 tỷ - 3 tỷ","> 3 tỷ","--------------------------------------------------------","< 100 ngàn /m²","100 ngàn - 300 ngàn /m²","300 ngàn - 500 ngàn /m²","500 ngàn - 1 triệu /m²","1 triệu - 2 triệu /m²","2 triệu - 4 triệu /m²","4 triệu - 6 triệu /m²","6 triệu - 8 triệu /m²","8 triệu - 10 triệu /m²","10 triệu - 13 triệu /m²","13 triệu - 16 triệu /m²","16 triệu - 20 triệu /m²","> 20 triệu /m²"); 

var priceRentValue = new Array("1-1000000","1000000-3000000","3000000-6000000","6000000-10000000","10000000-0","l","1-100000-m2","100000-300000-m2","300000-500000-m2","500000-1000000-m2","1000000-2000000-m2","2000000-4000000-m2","4000000-6000000-m2","6000000-8000000-m2","8000000-10000000-m2","10000000-13000000-m2","13000000-16000000-m2","16000000-20000000-m2","20000000-0-m2"); 
var priceRentText = new Array("< 1 triệu","1 triệu - 3 triệu","3 triệu - 6 triệu","6 triệu - 10 triệu","> 10 triệu","--------------------------------------------------------","< 100 ngàn /m²","100 ngàn - 300 ngàn /m²","300 ngàn - 500 ngàn /m²","500 ngàn - 1 triệu /m²","1 triệu - 2 triệu /m²","2 triệu - 4 triệu /m²","4 triệu - 6 triệu /m²","6 triệu - 8 triệu /m²","8 triệu - 10 triệu /m²","10 triệu - 13 triệu /m²","13 triệu - 16 triệu /m²","16 triệu - 20 triệu /m²","> 20 triệu /m²"); 

function changeToSell(obj) {
	removeAllOptions(document.searchForm.price)
	var objval = $(obj).val();
	if((objval == 0) || (objval == 2))  {
		aryValue = priceSellValue;
		aryText = priceSellText;
	}
	else {
		aryValue = priceRentValue;
		aryText = priceRentText;
	}
	
	addOption(document.searchForm.price, ' -- Tất cả -- ', '0');
	for (var i=0; i < aryValue.length;++i){
		addOption(document.searchForm.price, aryText[i], aryValue[i]);
	}
}

$(document).ready(function(){
			changeToSell(0);
		});
</script>
<form name="searchForm" method="POST" action="<?=site_url() . "front/search";?>">
<table class="table_common" border="0" width="100%">
  <tbody><tr>
    <td>Nhu cầu </td>
    <td>
	<select onchange="changeToSell(this);" id="type" name="type" class="w80" >
	<option value=""> -- Tất cả -- </option>
	<option value="0">Cần bán</option>
	<option value="2">Cần mua</option>
	<option value="3">Cần thuê</option>
	<option value="1">Cho thuê</option>
	</select></td>
  </tr>
  <tr>
    <td>Tỉnh/TP</td>
    <td><select id="province" name='province' onchange="commonLoad('<?=base_url().'ajax/district/'?>', this, 'district');" class="w80" >
    <option value=""> -- Tất cả -- </option>
    <?php 
			 foreach ($provinceOption as $aryProvince) {
				$lookupid   = $aryProvince["id"];
				$lookuptext   = $aryProvince["name"];
		?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $conditions['province'])?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
		<?			 
			 } ?>
    </select>
    </td>
  </tr>
<tr>
    <td>Quận/Huyện</td>
    <td id="district"><select name='district' onchange="commonLoad('<?=base_url().'ajax/area/'?>', this, 'area');" class="w80" >
    <option value=""> -- Tất cả -- </option>
    <?php if($conditions['province'])
			 foreach ($districtOption as $ary) {
				$lookupid   = $ary["id"];
				$lookuptext   = $ary["district_name"];
		?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $district)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
		<?			 
			 } ?>
    </select>
    </td>
  </tr>
<tr>
    <td>Khu vực</td>
    <td id="area"><select name='area' class="w80" >
    <option value=""> -- Tất cả -- </option>
    <?php if($conditions['district'])
			 foreach ($areaOption as $ary) {
				$lookupid   = $ary["id"];
				$lookuptext   = $ary["area_name"];
		?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $area)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
		<?			 
			 } ?>
    </select>
    </td>
  </tr>
  <tr>
    <td>Loại BĐS </td>
    <td>
	<select name="" class="w80" >
	<option value=""> -- Tất cả -- </option>
	<option value="1">Chung cư</option>
	<option value="2">Biệt thự</option>
	<option value="3">Liền kề</option>
	<option value="4">Đất dự án</option>
	<option value="5">Đất đấu giá</option>
	<option value="6">Nhà mặt phố</option>
	<option value="7">Nhà tập thể</option>
	<option value="8">Nhà chia lô</option>
	<option value="9">Nhà trong ngõ</option>
	<option value="10">Đất chia lô</option>
	<option value="11">Đất thổ cư</option>
	<option value="12">Kho xưởng</option>
	<option value="13">BĐS khác</option>
	</select></td>
  </tr>
  <tr>
    <td>Diện tích(m<sup>2</sup>)</td>
    <td>
	<select id="dm_dien_tich" class="w80" >
	<option value=""> -- Tất cả -- </option>
	<option value="30">&lt; 30</option>
	<option value="30 - 50">30 - 50</option>
	<option value="50 - 70">50 - 70</option>
	<option value="70 - 100">70 - 100</option>
	<option value="100 - 150">100 - 150</option>
	<option value="150 - 200">150 - 200</option>
	<option value="200 - 300">200 - 300</option>
	<option value="300">&gt; 300</option>
	</select></td>
  </tr>
  <tr>
    <td>Giá</td>
    <td>
	<select name="price" class="w80" >
	<option value=""> -- Tất cả -- </option>
	</select>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Tìm kiếm" id="button"></td>
  </tr>
</tbody></table>
<input type="hidden" name="searched" value="1">
</form>