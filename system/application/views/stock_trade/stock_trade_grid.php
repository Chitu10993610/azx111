<meta http-equiv="refresh" content="30">
<div id="content" class="narrowcolumn">
<?
   $modify_url = site_url('stock_trade/modify/');
   $delete_url = site_url('stock_trade/delete/');
   $add_url    = site_url('stock_trade/add/');
?>
<h3><a href="javascript:divToogle('groupsholder');">Danh sách stock</a></h3>
	<div id="groupsholder" style="display:block;">
		<br />
		<table id="group_table" class="stripe">
			<tr>
				<th width="20" align="center">No</th>
	<th valign='middle' align='center' class='tbl_headercell'>Mã CP</th>
	<th valign='middle' align='center' class='tbl_headercell'>Buy date</th>
	<th valign='middle' align='center' class='tbl_headercell'>Amount</th>
	<th valign='middle' align='center' class='tbl_headercell'>Price</th>
	<th valign='middle' align='center' class='tbl_headercell'>Fee</th>
	<th valign='middle' align='center' class='tbl_headercell'>Current price</th>
	<th valign='middle' align='center' class='tbl_headercell'>Change</th>
	<th valign='middle' align='center' class='tbl_headercell'>Peak date</th>
	<th valign='middle' align='center' class='tbl_headercell'>Peak price</th>
	<th valign='middle' align='center' class='tbl_headercell'>Current profit</th>
	<th valign='middle' align='center' class='tbl_headercell'>Peak profit</th>
	<th valign='middle' align='center' class='tbl_headercell'>Profit change</th>
	<th valign='middle' align='center' class='tbl_headercell'>Buzz</th>

				<th align="center">Edit</th>
				<th align="center">Delete</th>
			</tr>
			
      <?
         $i = 0;
         if(is_array($stock_trade_list)) foreach ($stock_trade_list as $stock_trade) {
            $i++;
            if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#EFE0ED"; }
//            echo  ($stock_trade['amount']*$stock_trade['price']*$stock_trade['fee'])/100;
      
            //caculator profit
            $current_profit = (($stock_trade['current_price'] - $stock_trade['price'])/$stock_trade['price']) * 100;
            $current_profit = number_format($current_profit, 2);
            
            //peak profit
            $peak_profit = (($stock_trade['peak_price'] - $stock_trade['price'])/$stock_trade['price']) * 100;
            $peak_profit = number_format($peak_profit, 2);
            
            $profit_changed = $peak_profit - $current_profit;
            $current_profit_money = number_format($current_profit*$stock_trade['amount']*$stock_trade['price']/100, 3, ',', '.'); 
      ?>
      <tr bgcolor="<?= $bgColor; ?>">
<td align="center"><?=$i;?></td>
   <td align="left"><?= $stock_trade['stock_sym']; ?></td>
   <td align="left"><?= date("d/m/y", $stock_trade['create_date']); ?></td>
   <td align="left"><?= $stock_trade['amount']; ?></td>
   <td align="left"><?= $stock_trade['price']; ?></td>
   <td align="left"><?= $stock_trade['fee']; ?></td>
   <td align="left"><?= $stock_trade['current_price']; ?></td>
   <td align="left"><?= $stock_trade['status_change']; ?></td>
   <td align="left"><?= date("d/m/y", $stock_trade['peak_date']); ?></td>
   <td align="left"><?= $stock_trade['peak_price']; ?></td>
   <td align="left"><?= $current_profit; ?>%<br>(<?=$current_profit_money;?>)</td>
   <td align="left"><?= $peak_profit; ?>%</td>
   <td align="left"><?=($profit_changed)? '-'.$profit_changed:$profit_changed; ?>%</td>
   
   <td align="left"><?php echo $stock_trade['alert'] .'%'; if($profit_changed > $stock_trade['alert']) echo '<img align="middle" src="'. site_url().'images/buzz.gif' . '" />'; ?></td>
<td class="edit"><a href = "<?= $modify_url."/".$stock_trade["id"]; ?>" ><?=img("images/i_edit.gif")?></a></td>
				<td class="delete">
				<a onclick="if (!confirm('Are you sure you want to delete selected items?')) return false;" href = "<?= $delete_url."/".$stock_trade["id"]; ?>" ><?=img("images/i_delete.gif")?></a>
				</td>
</tr>
      <? } ?>
		</table>
		<div style="float:left;"><?=$page_links?></div>
		<div style="float:right;"><?= anchor ($add_url, 'Add Stock', array('class' => 'addButton'));?></div>
	</div>
</div>