<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url()."webs/$action/";
?>
<!--<h2>Enter ci_webs Details</h2>-->
<?php echo validation_errors(); ?>
<?php if(isset($error)) echo $error; ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<form name="ci_websdetails" id="ci_websdetails" method="POST" action="<?= $action_url; ?>" enctype="multipart/form-data">
<input type='hidden' name='id' id='id' value='<?= $id; ?>' >
<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign='top' height='20'>
            <td align='right'> <b> Image:  </b> </td>
            <td>
               <input size="63" type='file' name='image' id='image' />
            </td>
         </tr>
     <tr valign='top' height='20'>
            <td align='right'> <b> Title:  </b> </td>
            <td>
               <input style="width:480px;" type='text' name='webs_title' id='webs_title' value='<?= $webs_title; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='right'> <b> Description:  </b> </td>
            <td>
               <textarea style="width:480px;" cols=35 rows=7 NAME='description' id='description' ><?= $description; ?></textarea>
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='right'> <b> Web URL:  </b> </td>
            <td>
               <input style="width:480px;" type='text' name='webs_url' id='webs_url' value='<?= $webs_url; ?>' />
            </td>
         </tr>
	<tr valign='top' height='20'>
            <td align='right'> <b> Web Status:  </b> </td>
            <td>
               <input style="width:80px;" type='checkbox' name='status_flg' id='status_flg' value='1' <?=($status_flg == 1) ? "checked" : ''?> /> (Nếu bỏ check site này sẽ không hiển thị)
            </td>
         </tr>

</table><div style="float:right; padding-right:20px;"><?php if($image) echo '<img src="'.base_url().'images/webs/'.$image . '" class="image-webs" border="0">'; ?></div>

<input type="submit" name="Submit" value="Save">
<input type="reset" name="resetForm" value="Clear Form">
</form>
</div>