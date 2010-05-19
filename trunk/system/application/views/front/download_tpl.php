 <table cellspacing="0" cellpadding="0" border="0" width="100%" class="bangraovat">
  <tbody><tr>
    <th align="center" width="5%" scope="col">Stt</th>
    <th align="center" scope="col">Tên tài liệu</th>
    <th align="center" width="10%" scope="col">size</th>
    <th align="center" width="10%" scope="col">Download</th>
  </tr>
  <?php 
if(is_array($record_list)) $n = sizeof($record_list);
$i = 0;
if($n) foreach ($record_list as $ci_properties) {
	$i++
	?>
	 <tr>
    <td align="center"><strong style=""><?=$i?></strong></td>
    <td><?=$ci_properties['file_name']?></td>
    <td align="center"><?=$ci_properties['file_size']?> Kb</td>
    <td align="center"><a class="bold_red" href="<?=base_url().'iht_upload/download/'.$ci_properties['id']?>">Download</td>
  </tr>
<?}?>
</tbody></table>
 <div class="pagination"><?=$page_links?></div>