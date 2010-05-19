<table border="0" width="100%">
  <tbody>
  <?php foreach ($record_list as $key => $value) {?><tr>
    <td width="40"><a href=""><img height="41" align="middle" width="43" src="<?=base_url()?>images/hoanghai/i_download.gif"></a></td>
    <td valign="top"><a class="bold_red" href="<?=base_url().'front/download/'.$key?>"><?=$value?></a></td>
  </tr>
  <?}?>
</tbody></table>