<?php if($numberFile) echo '<hr style="color:#FFFFFF" />';?>
<table width="685" border="0" cellpadding="5" cellspacing="0" id="model<?=$numberFile?>">
  <tr>
    <td width="163">Bedrooms</td>
    <td width="502">
    <select name='fbedrooms[]'>
    <option value='1' >1</option>
    <option value='2' >2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    </select></td>
    <td><?php if($numberFile) {?><a title="Remove this model" onclick="removeModel('<?=$numberFile?>', 'model')" href="javascript:void(0)">Remove</a><? }?></td>
  </tr>
  <tr>
    <td>Baths
        </td>
    <td><select name='fbath[]'>
    <option value='0.5'>0.5</option>
    <option value='1'>1</option>
    <option value='1.5'>1.5</option>
    <option value='2'>2</option>
    <option value='2.5'>2.5</option>
    <option value='3'>3</option>
    <option value='3.5'>3.5</option>
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
	<td valign="top">Chiều rộng x Chiều dài:</td>
	<td>
		<input type="text" value="" size="20" name="fsquare_width[]"/> x <input type="text" value="" size="20" name="fsquare_length[]"/>
		 (m x m) - ví dụ:<span class="colour"> 6 x 8</span><br/>
	</td>
</tr>
<tr>
	<td valign="top" class="label">Giá :</td>
		<td >
		<input type="text" value="" size="20" name="price[]"/> 
		
<select size="1" name="currency[]">
	<option value="Triệu VNĐ">Triệu VNĐ</option>
	<option value="Tỷ VNĐ">Tỷ VNĐ</option>
<!--	<option value="3">USD</option>-->
	<option value="Nghìn VNĐ">Nghìn VNĐ</option>
</select>
		<input type="checkbox" value="1" id="realstate_m2" name="realstate_m2"/> /m <sup>2</sup>  
		<input type="checkbox" value="1" id="realstate_negotiate" name="realstate_negotiate"/> Cho thương lượng
		<br/>
		<label class="font_10">(Nhập số liên tục. Ví dụ: 250 triệu VND)</label>
	</td>
</tr>
  <!--<tr>
    <td>Price      </td>
    <td>Rent: <select name='fprice_min[]'>
    <?php foreach($propertyPriceOption as $key=>$pprice) {
    	echo '<option value="'.$key.'">'.$pprice.'</option>';
    }
    ?>
    </select>
    
    &nbsp;&nbsp;&nbsp;Sell: <select name='fprice_max[]'>
    <?php foreach($propertyPriceOption as $key=>$pprice) {
    	echo '<option value="'.$key.'">'.$pprice.'</option>';
    }
    ?>
    </select>
    </td>
    <td>&nbsp;</td>
  </tr>--> 
  <tr>
    <td>FloorPlan image</td>
    <td>
    Title: <input size="23" type="text" name="floorplan_file_title[]" value="">
    File: <input type="hidden" value="<?=$numberFile?>" name="flattach[]">
		<input type="file" size="23" id="floorplan_file<?=$numberFile?>" name="floorplan_file<?=$numberFile?>" />&nbsp;		
    </td>
    <td>&nbsp;</td>
  </tr>
</table>