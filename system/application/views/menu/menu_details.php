<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "menu/$action/";

?>

<!--<h2>Enter ci_news Details</h2>-->
<?php echo validation_errors(); ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<script language="javascript">
<!--
function checkFrmLoaiHang()
{
	var menuName = "name"
	if(document.getElementById(menuName).value == "")
	{
		alert("Bạn chưa nhập tên mục .")
		document.getElementById(menuName).focus();
		return false;
	}
	
	return true;
}
//-->
</script>
<form name="form2" method="post"  action="<?= $action_url; ?>" onSubmit="return checkFrmLoaiHang();">
<table border="1" width="550" style="border-collapse: collapse">
<tr>
<td valign="top">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F0EFE3">
	<tr>
		<td bgcolor="#004E9B" height="21">
		<font color="#FFFFFF"><b>&nbsp; <?=$title?></b></font>
		<?php if($trans) echo $strLang;?>
		</td>
	</tr>
	<tr>
		<td valign="top" align="center" style="padding-top: 10px; padding-bottom: 10px">
		<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">				
			 <input type="hidden" name="id" value="<?=$aryMenuInfo['id']?>">
                                <tr> 
                                  <td colspan="2" valign="middle">
				<p align="center"><b>
				<font face="Arial" color="#000099">Thêm mục con của menu</font></b></td>
                                        </tr>

				<tr>		
				 <td width="35%"><div align="right">
                                            Tên mục :</div>
                                         </td>
					<td><input id="name" name="name" size="40" style="width:200" value="<?=$aryMenuInfo['name']?>"></td>
				</tr>
				<?php if(!$trans) {?>
				<tr>		
				 <td width="35%"><div align="right">
                                            Link(URL) :</div>
                                         </td>
					<td><input id="url" name="url" size="40" style="width:200" value="<?=$aryMenuInfo['url']?>"></td>
				</tr>	

                                        <tr> 
                                          <td width="35%"><div align="right">
                                            Thuộc nhóm :</div></td>
                                          <td>
				<select name="parent_id" style="width:200px;">
				 <option value="0">----------Chọn nhóm menu----------</option>
			<?php 
			
				foreach ($aryMenuList as $aryMenu) {
					$selected = ($aryMenuInfo['parent_id'] == $aryMenu['id']) ? " selected" : "";
					echo '<option value="' . $aryMenu['id'] . '"'. $selected . '>' . str_repeat('&nbsp;&nbsp;', $aryMenu['level']).$aryMenu['name']. '</option>';				
				}
			?>
				</select></td>
                                        </tr>
                                        <tr> 
                                          <td width="35%" align="right">Hiển thị :</td>
                                          <td>
                                          <table border="0" style="border-collapse: collapse" width="100%">
				<tr>
					<td width="22">
					<input type="radio" value="1" <?=($aryMenuInfo['status'] == 1) ? " checked" : "";?> name="status"></td>
					<td width="60">Có</td>
					<td width="22">
					<input type="radio" <?=($aryMenuInfo['status'] == 0) ? " checked" : "";?> name="status" value="0"></td>
					<td>Không</td>
				</tr>
				</table>											
				</td>
                                        </tr>
                                        <tr> 
                                          <td width="35%">&nbsp;</td>
                                          <td>
                                          <span class="8blnormal">
					(cho phép hiển thị ngoài website hay
						không)</span></td>
                                        </tr>
                                        <tr>
                                        <?}?>
                                          <td width="35%">&nbsp;</td>
                                          <td>&nbsp;                                          </td>
                                        </tr>
                                        <tr> 
                                          <td width="35%">&nbsp;</td>
                                          <td>
                                            <input name="Submit" type="submit" class="button" value="  <?=($aryMenuInfo['id'])? "Lưu" : "Thêm"?>  "> 
                                            <input name="btnReset" type="reset" class="button" value="Làm lại"> 
                                            <input name="btnView" type="button" class="button" value="Xem DS" onClick="document.location.href='<?=base_url()?>menu'"></td>
                                        </tr>                                        
                                      </table>
			 </td>
			</tr>
		</table>
		</td>
		</tr>
		</table>
		<?php 
				 	if($trans) {
				 	?>
				 	<input type="hidden" name="translated" value="<?=$translate?>">
	<?}?>                                 
		 </form>
</div>