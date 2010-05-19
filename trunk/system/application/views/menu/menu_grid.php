<div id="content" class="narrowcolumn">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F0EFE3">
			<tr>
				<td bgcolor="#004E9B" height="21">
				<font color="#FFFFFF"><b>&nbsp; Danh sách menu</b></font></td>
			</tr>
			<tr>
				<td valign="top" align="center" style="padding-top: 10px; padding-bottom: 10px">
				<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">				
				<tr>
				<td align="center">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
				<form name="frmSort" method="post" action="<?=base_url()?>menu/sort">
				   <tr>
				     <td width="2%">&nbsp;</td>
				     <td width="97%">
			                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			                    <tr> 
			                      <td>
				             <table width="100%" border="0" cellpadding="0" cellspacing="0">
			                          <tr> 
			                            <td>
			                            <table border="1" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse" bordercolor="#C0C0C0">
			                                <tr> 
			                                  <td width="397" height="20" bgcolor="#D7D7D7" style="padding-left:5px; color:#000000; font-weight:bold">
										Tên mục</td>
			                                  <td height="20" width="63" bgcolor="#D7D7D7" style="padding-left:5px; color:#000000; font-weight:bold">Sắp xếp</td>
			                                  <td height="20" bgcolor="#D7D7D7" width="73" align="center"><b>Thêm mục con </b></td>
<!--			                                  <td height="20" bgcolor="#D7D7D7" width="40" align="center"><b>Dịch</b></td>-->
			                                  <td height="20" bgcolor="#D7D7D7" width="40" align="center"><b>Sửa</b></td>
			                                  <td height="20" bgcolor="#D7D7D7" width="40" align="center"><b>Xoá</b></td>
			                                   <td height="20" bgcolor="#D7D7D7" width="40" align="center"><b>ID</b></td>
			                                </tr>
                            <?php
                               	if(count($aryNewsTypesList) == 0) {
				echo "<TR><td align=center colspan=7><br><br>Không có mục tin nào.<br><br><br></td></tr>";
                               	}
                               	
                               	//else if has menu				
			else {
					
				//view all menu and submenu
				foreach ($aryNewsTypesList as $aryMenu) {
		?>	

			                                <tr>
			                                  <td height="15" align="left" bgcolor="#FFFFFF" style="padding-left: 5px; padding-right: 10px; color:#000000; font-weight:bold;">
			                                  <input type="hidden" name="id[]" value="<?php echo $aryMenu['id']; ?>">
			                                  <a href="./menu/modify/<?php echo $aryMenu['id']; ?>">
											  <?php echo str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $aryMenu['level'] - 1).$aryMenu['name']; if(!$aryMenu['status']) echo "<span style='color:red; font-weight:normal'> (not show)</span>" ?></a></td>
			                                  <td width="63" height="20" align="right" bgcolor="#FFFFFF">
												<select style="width:<?=(70-($aryMenu['level']-1)*10) . 'px'?>" size="1" name="ordering[]"class="textbox">
												<?php for($i = 1; $i <= $aryMenu['totalMenu']; $i++) { ?>
													<option value="<?php echo $i; ?>" <?php if ($aryMenu['ordering'] == $i) echo " selected"; ?>><?php echo $i ?></option>
												<?php } ?>
											  </select></td>
			                                  <td width="73" height="20" align="center" bgcolor="#FFFFFF">
			                                  
												<a href="./menu/add/<?php echo $aryMenu['id']; ?>">
												<img alt="Them muc con cho nhom nay" border="0" src="images/addforum.gif" width="16" height="16"></a></td>
			                                  <!--<td width="40" height="20" align="center" bgcolor="#FFFFFF">
												<a href="./menu/trans/<?php echo $aryMenu['id']; ?>">
												<img alt="Dịch bản ghi nay" border="0" src="images/control.gif" width="20" height="20"></a></td>-->
											
												<td width="40" height="20" align="center" bgcolor="#FFFFFF">
												<a href="./menu/modify/<?php echo $aryMenu['id']; ?>">
												<img alt="Sua bản ghi nay" border="0" src="images/control.gif" width="20" height="20"></a></td>
			                                  <td width="40" height="20" align="center" bgcolor="#FFFFFF">
			                              
												<a href="javascript:sconfirm('Ban co muon xoa nhom tin nay khong?','./menu/delete/<?php echo $aryMenu['id']; ?>')">
												<img alt="Xoa bản ghi nay" border="0" src="images/login_icon_false.gif" width="18" height="18"></a></td>
												<td width="40" height="20" align="center" bgcolor="#FFFFFF">
			                              <?php echo $aryMenu['id']; ?>
												</td>
			                                </tr>
			                                
		                                <?php
		                                	/*foreach ($aryNewsTypesList as $arySubmenu) {							                                

		                                		//view all submenu of this menu
		                                		if($arySubmenu['parent_id'] == $aryMenu['id']) {*/		

		                                ?>
			                                <?php
												
				}//view menu
				
			}//else if has menu
			                                ?>                               
			                              </table></td>
			                          </tr>
			                        </table></td>
			                    </tr>
	                      </table>
				        </td>
						     <td width="1%">&nbsp;</td>
				      </tr>
						   <tr>
						     <td width="2%" height="19">&nbsp;</td>
						     <td width="97%" height="19">
						     &nbsp;<input type="button" onClick="document.location.href='./menu/add';" value="Thêm Nhóm mục mới" name="themsp" style="float: right; font-family: Tahoma; font-size: 8pt" class="button">
						     <input type="submit" name="btnUpdate" value="Cập nhật sắp xếp" style="margin-right:10px;float: right; font-family: Tahoma; font-size: 8pt" class="button"></td>
						     <td width="1%" height="19">&nbsp;</td>
						   </tr>
					</form>
				  </table>
				  </td>
				  </tr>
				</table>					
				</td>
			</tr>
		</table>
</div>