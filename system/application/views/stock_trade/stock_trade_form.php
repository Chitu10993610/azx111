<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "/stock_trade/$action/";
?>
<?php echo validation_errors(); ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<form name="stock_trade_form" id="stock_trade_form" method="POST" action="<?= $action_url; ?>" >
<input type='hidden' name='id' id='id' value='<?= $id; ?>' >
<table width="685" border="0" cellpadding="5" cellspacing="5">
	<tr valign='top' height='20'>

            <td align='left'> <b> Mã CP:  </b> </td>

            <td>
               <input type='text' name='stock_sym' id='stock_sym' value='<?= $stock_sym; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> Buy date:  </b> </td>

            <td>
               <input type='text' name='create_date' id='create_date' value='<?= $create_date; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> Amount:  </b> </td>

            <td>
               <input type='text' name='amount' id='amount' value='<?= $amount; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> Price:  </b> </td>

            <td>
               <input type='text' name='price' id='price' value='<?= $price; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> Fee:  </b> </td>

            <td>
               <input type='text' name='fee' id='fee' value='<?= $fee; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> Current price:  </b> </td>

            <td>
               <input type='text' name='current_price' id='current_price' value='<?= $current_price; ?>' />
            </td>
         </tr>
    <tr valign='top' height='20'>
            <td align='left'> <b>Alert percent:  </b> </td>
            <td>
               <input type='text' name='alert' id='alert' value='<?= $alert; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> cat_id:  </b> </td>

            <td>
               <select name="cat_id" id="cat_id" >
				<option value="">Choose Category</option><?
			 foreach ($categorylist as $category) {
				$lookupid   = $category["cat_id"];
				$lookuptext   = $category["cat_name"];
?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $cat_id)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
<?			 } ?>
			</select>

            </td>
         </tr>

</table>
<input type="hidden" name="peak_price" value="<?=$peak_price;?>"
<input class="button" type="submit" name="Submit" value="Save">
<input class="button" type="reset" name="resetForm" value="Reset Form">
</form>
</div>