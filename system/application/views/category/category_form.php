<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "/category/$action/";
?>
<?php echo validation_errors(); ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<form name="category_form" id="category_form" method="POST" action="<?= $action_url; ?>" >
<input type='hidden' name='cat_id' id='cat_id' value='<?= $cat_id; ?>' >
<table width="685" border="0" cellpadding="5" cellspacing="5">
		<tr valign='top' height='20'>

            <td align='right'> <b> cat_id:  </b> </td>

            <td>
               
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='right'> <b> cat_name:  </b> </td>

            <td>
               <input type='text' name='cat_name' id='cat_name' value='<?= $cat_name; ?>' />
            </td>
         </tr>

</table>
<input class="button" type="submit" name="Submit" value="Save">
<input class="button" type="reset" name="resetForm" value="Reset Form">
</form>
</div>