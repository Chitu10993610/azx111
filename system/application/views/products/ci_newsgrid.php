<script language="javascript">

function showSearch()
{
	if(timkiem.style.visibility=="hidden")
	{
		timkiem.style.left=event.clientX-480;
		timkiem.style.top=event.clientY+20;
		timkiem.style.visibility="visible";
	}
	else
	{
		timkiem.style.left=0;
		timkiem.style.top=0;
		timkiem.style.visibility="hidden";
	}
}

</script>
<div id="content" class="narrowcolumn">
<table border="1" width="100%" style="border-collapse: collapse">
	<tr>
		<td valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F0EFE3">
			<tr>
				<td bgcolor="#004E9B" height="21">
				<font color="#FFFFFF"><b>&nbsp; Danh sách các sản phẩm hiện có</b></font></td>
			</tr>
			<tr>
				<td valign="top" align="center" style="padding-top: 10px; padding-bottom: 10px">
				<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">				
					<tr>
						<td align="center">
						<form name="frmViewNews" method="post" action="<?=base_url()?>products/delete">
						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
							<tr>
								<td style="padding-left: 3px; padding-top: 3px; padding-bottom: 3px">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td>Có <?php echo $numOfNews?> sản phẩm trong  trang</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td>
									<table border="1" cellpadding="3" cellspacing="1" style="border-collapse: collapse" width="100%" bgcolor="#FFFFFF" bordercolor="#C3C3C3">
									<tr>
										<td align="center" bgcolor="#C0C0C0" width="30"><b>PIC</b></td>
										<td align="center" bgcolor="#C0C0C0"><b>Tiêu đề Sản phẩm</b></td>
										<td align="center" bgcolor="#C0C0C0" width="100"><b>Ngày</b></td>
										<td align="center" bgcolor="#C0C0C0" width="50"><b>Dịch</b></td>
										<td align="center" bgcolor="#C0C0C0" width="50"><b>Sửa</b></td>
										<td align="center" bgcolor="#C0C0C0" width="30">
										<input type="checkbox" name="chkall" value="ON" onClick="checkall();"></td>
									</tr>
									<?php
									if($numOfNews == 0) {
										echo "<tr>";
										echo "<td class=\"text\" colspan=\"5\" align=\"center\"><BR>Không có sản phẩm nào.<BR><BR></td>";
										echo "</tr>";
									}
									else
									foreach ($aryNewsList as $aryNews) {
									?>
									<tr>
										<td align="center" width="30">
										<?php  if($aryNews["news_image"] != "") { ?>
										<img src="<?=base_url()?>images/icons/check.png" border="0">
										<?php }?>
										</td>
										<td>
										<a <?php if($aryNews["news_status"]) echo ("class='lnkGray'") ?> title="Sua Sản phẩm" href="<?=base_url()?>products/modify/<?php echo $aryNews["news_id"]?>"><?php echo $aryNews["news_title"]?></a>
										<?php if($aryNews["show_home"]) echo ("<font color=#CC0000>(show at home)</font>") ?>
										</td>
										<td align="center" width="100"><?php echo date("d/m/Y", $aryNews["create_date"])?></td>
										<td align="center" width="50">
										<a href="<?=base_url()?>products/trans/<?php echo $aryNews["news_id"]?>">
										<img border="0" title="Dịch Sản phẩm này" src="<?=base_url()?>images/i_edit.gif" width="15" height="15"></a>
										</td>
										<td align="center" width="50">
										<a href="<?=base_url()?>products/modify/<?php echo $aryNews["news_id"]?>">
										<img border="0" title="Sua Sản phẩm nay" src="<?=base_url()?>images/i_edit.gif" width="15" height="15"></a>
										</td>

										<td align="center" width="30">
										<input type="checkbox" id="chkid" name="chkid[]" value="<?php echo $aryNews["news_id"]?>" onClick="docheckone();"></td>
									</tr>
									<?php
									}
									?>
									<tr>
										<td align="right" colspan="5">
										<input type="button" value="Thêm Sản phẩm mới" name="btnAddNews" class="button" onClick="document.location.href='<?=base_url()?>products/add/<?=$cid?>'">&nbsp;
										<input type="submit" value="Xoá các Sản phẩm đã chọn" name="btnDelete" class="button" onClick="return checkGrid();" <?php If (!$numOfNews) echo "DISABLED" ?>></td>
									</tr>
								</table>
								</td>
							</tr>
							
							<tr>
								<td>
						        
								</td>
							</tr>
						</table>
						<input type="hidden" name="req" value="delete_news">
						<input type="hidden" name="cid" value="<?php echo $cid?>">
						</form>
						</td>
					</tr>
				</table>					
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>