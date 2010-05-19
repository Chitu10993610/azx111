 <table cellspacing="0" cellpadding="0" border="0" width="100%" class="bangraovat">
  <tbody><tr>
    <th align="center" width="10%" scope="col">Nhu cầu </th>
    <th align="center" scope="col">Tiêu đề</th>
    <th align="center" width="10%" scope="col">Khu vực</th>
    <th align="center" width="10%" scope="col">Quận huyện </th>
    <th align="center" width="12%" scope="col">Giá</th>
    <th align="center" width="7%" scope="col">Diện tích </th>
    <th align="center" width="5%" scope="col">Lượt xem</th>
    <th align="center" width="9%" scope="col">Ngày đăng </th>
  </tr>
  <?php 
if(is_array($ci_properties_list)) $n = sizeof($ci_properties_list);
if($n) foreach ($ci_properties_list as $ci_properties) {?>
	 <tr>
    <td align="center"><strong style="">
    <?php 
    switch ($ci_properties['type']) {
    case 0:echo"Cần bán";
    break;
    case 1:echo"Cho thuê";
    break;
    case 2:echo"Cần mua";
    break;
    case 3:echo"Cần thuê";
    break;
    }
    
    "Cần bán"?></strong></td>
    <td><a href="<?=site_url().'front/'.$ci_properties['id']?>/<?=$ci_properties['name_sef']?>" class="bold_red">
    	<?=$this->front_lib->cut_string($ci_properties['name'], 60)?></a>
		</td>
    <td align="center"><strong><?=$ci_properties['province_name']?></strong></td>
    <td align="center"><?=$ci_properties['province_name']?></td>
    <td align="center" title="<?=$ci_properties['price'] . ' ' . $ci_properties['currency']?><?=($ci_properties['m2'])? "/m2":''?> <?=($ci_properties['is_negotiate'])? "(Cho Thương Lượng)":''?>"><?=$ci_properties['price'] . ' ' . $ci_properties['currency']?><?=($ci_properties['m2'])? "/m<sup>2</sup>":''?></td>
    <td align="right"><?=$ci_properties['square_footage']?> m<sup>2</sup> </td>
    <td align="center"><?=$ci_properties['view']?></sup></td>
    <td align="right"><?=date("d-m-Y", $ci_properties['start_date'])?></td>
  </tr>
<?}?>
</tbody></table>
 <div class="pagination"><?=$page_links?></div>
 <div class="upper" style="position:absolute; right:20px; bottom:0;"><a href="<?=site_url()?>front/nhaban" class="bold_red">Xem tất cả</a></div>