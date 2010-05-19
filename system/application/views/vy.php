  <?php 
			 foreach ($provinceOption as $aryProvince) {
				$lookupid   = $aryProvince["id"];
				$lookuptext   = $aryProvince["name"];
		?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $province)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
		<?			 
			 } ?>