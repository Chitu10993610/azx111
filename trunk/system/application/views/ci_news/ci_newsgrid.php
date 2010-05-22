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
				<font color="#FFFFFF"><b>&nbsp; Danh sách các tin hiện có</b></font></td>
			</tr>
			<tr>
				<td valign="top" align="center" style="padding-top: 10px; padding-bottom: 10px">
				<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">				
					<tr>
						<td align="center">
						<form name="frmViewNews" method="post" action="<?=base_url()?>news/delete">
						<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
							<tr>
								<td style="padding-left: 3px; padding-top: 3px; padding-bottom: 3px">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td>Có <?php echo $numOfNews?> tin trong  trang</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td>
									<table border="1" cellpadding="3" cellspacing="1" style="border-collapse: collapse" width="100%" bgcolor="#FFFFFF" bordercolor="#C3C3C3">
									<tr>
										<td align="center" bgcolor="#C0C0C0" width="30"><b>PIC</b></td>
										<td align="center" bgcolor="#C0C0C0"><b>Tiêu đề tin</b></td>
										<td align="center" bgcolor="#C0C0C0" width="100"><b>Ngày</b></td>
										<td align="center" bgcolor="#C0C0C0" width="50"><b>Người viết</b></td>
										<td align="center" bgcolor="#C0C0C0" width="50"><b>Sửa</b></td>
										<td align="center" bgcolor="#C0C0C0" width="30">
										<input type="checkbox" name="chkall" value="ON" onClick="checkall();"></td>
									</tr>
									<?php
									if($numOfNews == 0) {
										echo "<tr>";
										echo "<td class=\"text\" colspan=\"5\" align=\"center\"><BR>Không có bản tin nào.<BR><BR></td>";
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
										<a <?php if($aryNews["news_status"]) echo ("class='lnkGray'") ?> title="Sua ban tin" href="<?=base_url()?>news/modify/<?php echo $aryNews["news_id"]?>"><?php echo $aryNews["news_title"]?></a>
										<?php if($aryNews["show_home"]) echo ("<font color=#CC0000>(show at home)</font>") ?>
										</td>
										<td align="center" width="100"><?php echo date("d/m/Y", $aryNews["create_date"])?></td>
										<td align="center" width="50">
										<?php echo $aryNews["poster_name"]?>
										</td>
										<td align="center" width="50">
										<a href="<?=base_url()?>news/modify/<?php echo $aryNews["news_id"]?>">
										<img border="0" title="Sua bản ghi nay" src="<?=base_url()?>images/i_edit.gif" width="15" height="15"></a>
										</td>
										<td align="center" width="30">
										<input type="checkbox" id="chkid" name="chkid[]" value="<?php echo $aryNews["news_id"]?>" onClick="docheckone();"></td>
									</tr>
									<?php
									}
									?>
									<tr>
										<td align="right" colspan="5">
										<div class="paging" style="float:left; text-align:left; width:200px"><?=$page_links?></div>
										<input type="button" value="Thêm tin mới" name="btnAddNews" class="button" onClick="document.location.href='<?=base_url()?>news/add/<?=$cat_id?>/<?=$newsType?>'">&nbsp;
										<input type="submit" value="Xoá các tin đã chọn" name="btnDelete" class="button" onClick="return checkGrid();" <?php If (!$numOfNews) echo "DISABLED" ?>></td>
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
						<input type="hidden" name="news_type" value="<?php echo $newsType?>">
						<input type="hidden" name="cid" value="<?php echo $cat_id?>">
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