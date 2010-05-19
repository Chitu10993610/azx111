<select name='district' onchange="commonLoad('<?=base_url().'ajax/area/'?>', this, 'area');" class="w80">
    <option value=""> -- Tất cả -- </option>
    <?php 
			 foreach ($districtOption as $ary) {
				$lookupid   = $ary["id"];
				$lookuptext   = $ary["district_name"];
		?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $district)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
		<?			 
			 } ?>
    </select>