<select name='area' class="w80" >
    <option value=""> -- Tất cả -- </option>
    <?php 
			 foreach ($areaOption as $ary) {
				$lookupid   = $ary["id"];
				$lookuptext   = $ary["area_name"];
		?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $area)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
		<?			 
			 } ?>
    </select>