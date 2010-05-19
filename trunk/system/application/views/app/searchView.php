<?php
		$conditions = $this->session->userdata('search_cond');
//		var_dump($conditions);
		?>
<script language="javascript">
var priceSellValue = new Array("1-150000000","150000000-300000000","300000000-600000000","600000000-1000000000","1000000000-1500000000","1500000000-2000000000","2000000000-3000000000","3000000000-0","l","1-100000-m2","100000-300000-m2","300000-500000-m2","500000-1000000-m2","1000000-2000000-m2","2000000-4000000-m2","4000000-6000000-m2","6000000-8000000-m2","8000000-10000000-m2","10000000-13000000-m2","13000000-16000000-m2","16000000-20000000-m2","20000000-0-m2"); 
var priceSellText = new Array("< 150 triệu","150 triệu - 300 triệu","300 triệu - 600 triệu","600 triệu - 1 tỷ","1 tỷ - 1.5 tỷ","1.5 tỷ - 2 tỷ","2 tỷ - 3 tỷ","> 3 tỷ","--------------------------------------------------------","< 100 ngàn /m²","100 ngàn - 300 ngàn /m²","300 ngàn - 500 ngàn /m²","500 ngàn - 1 triệu /m²","1 triệu - 2 triệu /m²","2 triệu - 4 triệu /m²","4 triệu - 6 triệu /m²","6 triệu - 8 triệu /m²","8 triệu - 10 triệu /m²","10 triệu - 13 triệu /m²","13 triệu - 16 triệu /m²","16 triệu - 20 triệu /m²","> 20 triệu /m²"); 

var priceRentValue = new Array("1-1000000","1000000-3000000","3000000-6000000","6000000-10000000","10000000-0","l","1-100000-m2","100000-300000-m2","300000-500000-m2","500000-1000000-m2","1000000-2000000-m2","2000000-4000000-m2","4000000-6000000-m2","6000000-8000000-m2","8000000-10000000-m2","10000000-13000000-m2","13000000-16000000-m2","16000000-20000000-m2","20000000-0-m2"); 
var priceRentText = new Array("< 1 triệu","1 triệu - 3 triệu","3 triệu - 6 triệu","6 triệu - 10 triệu","> 10 triệu","--------------------------------------------------------","< 100 ngàn /m²","100 ngàn - 300 ngàn /m²","300 ngàn - 500 ngàn /m²","500 ngàn - 1 triệu /m²","1 triệu - 2 triệu /m²","2 triệu - 4 triệu /m²","4 triệu - 6 triệu /m²","6 triệu - 8 triệu /m²","8 triệu - 10 triệu /m²","10 triệu - 13 triệu /m²","13 triệu - 16 triệu /m²","16 triệu - 20 triệu /m²","> 20 triệu /m²"); 

function changeToSell(des) {
	removeAllOptions(document.searchForm.price)
	if(des == 0) {
		aryValue = priceSellValue;
		aryText = priceSellText;
	}
	else {
		aryValue = priceRentValue;
		aryText = priceRentText;
	}
	
	addOption(document.searchForm.price, '-Tất cả-', '0');
	for (var i=0; i < aryValue.length;++i){
		addOption(document.searchForm.price, aryText[i], aryValue[i]);
	}
}

$(document).ready(function(){
			changeToSell(0);
		});
</script>
<div id="search" class="form">

   <form action="<?=site_url() . "front/search";?>" name="searchForm" method="post">
   <div id="search-main">
   <div style="padding:5px;">Tìm mua <input type="radio" name="type" value="0" <?=($conditions['type'] == 0)? 'checked="checked"' : ''?> onclick="changeToSell(0);" />
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tìm thuê <input type="radio" name="type" <?=($conditions['type'] == 1)? 'checked="checked"' : ''?> value="1" onclick="changeToSell(1);" />
      </div>
      Loại BĐS <select name='property_type' style="width:80px;">
    <option value="">-Tất cả-</option>
    <?php foreach($propertyTypeOption as $key=>$ptype) {
    	$selected = ($conditions['property_type'] == $key)? 'selected="selected"' : '';
    	echo '<option value="'.$key.'" '.$selected.' >'.$ptype.'</option>';
    }
    ?>
    </select>
         <label for="price">Giá cao nhất</label>
         <select id="price" name="price" style="width:80px;"><option value="">-Tất cả-</option></select>
	&nbsp;&nbsp;Tỉnh thành
	<select name='province' >
    <option value="">-Tất cả-</option>
    <?php 
		 foreach ($provinceOption as $aryProvince) {
				$lookupid   = $aryProvince["id"];
				$lookuptext   = $aryProvince["name"];
				$selected = ($conditions['province'] == $lookupid)? 'selected="selected"' : '';
		?>
					<option value="<?= $lookupid; ?>" <?=$selected?> ><?= $lookuptext; ?></option>
		<?			 
			 } ?>
    </select>
    <input type="hidden" name="searched" value="1">
      <div style="position:absolute;right:-51px;top:5px;"><button id="searchSubmit" style="background: url(<?=site_url()?>img/search.jpeg) no-repeat;" name="searchSubmit" type="submit">Search</button></div>
     </div>
      
      <div id="searchadv" style="display: none;">
      <table>
      <tr>
      <td></td>
      <td></td>
		<td>
		Options and Amenities</td>
		<td><label>
				<select id="amenities" name="amenities">
				<option value="">-Tất cả-</option>
				<?php
				foreach ($ci_amenities_list as $ci_amenities) {
					echo '<option value="'. $ci_amenities['id'] .'">'. $ci_amenities['amenities'] .'</option>';
				}
				?>
				</select>
		</label></td>
      </tr>
      </table>
	<input id="sortby" name="sortby" type="hidden">
	<input name="page" type="hidden">
	<div style="position:absolute; right:10px; bottom:10px; width:30px;"><a href="#" onclick="$('#searchadv').hide(); return false;">close</a></div>
	</div><!--end advandce-->
   </form>
   
</div>