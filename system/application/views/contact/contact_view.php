<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "/iht_contact/$action/";
?>
<?php echo validation_errors(); ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<table width="685" border="0" cellpadding="5" cellspacing="5">
		<tr valign='top' height='20'>

            <td align='left'> <b> name:  </b> </td>

            <td>
               <?= $name; ?>
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> address:  </b> </td>

            <td>
               <?= $address; ?>
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> email:  </b> </td>

            <td>
               <?= $email; ?>
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> phone:  </b> </td>

            <td>
               <?= $phone; ?>
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> mobile:  </b> </td>

            <td>
               <?= $mobile; ?>
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> subject:  </b> </td>

            <td>
               <?= $subject; ?>
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> content:  </b> </td>

            <td>
               <?= $content; ?>
            </td>
         </tr>
	<tr valign='top' height='20'>

            <td align='left'> <b> Ngày gửi:  </b> </td>

            <td>
               <?= $create_date; ?>
            </td>
         </tr>

</table>
</div>