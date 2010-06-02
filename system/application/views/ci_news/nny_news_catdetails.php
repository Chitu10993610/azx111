<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "news_cat/$action/";

?>

<!--<h2>Enter ci_news Details</h2>-->
<?php echo validation_errors(); ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<script language="javascript">
<!--
function checkFrmLoaiHang()
{
	var catName = "cat_name"
	if(document.getElementById(catName).value == "")
	{
		alert("Bạn chưa nhập tên mục của ngôn ngữ bạn chọn mặc định.")
		document.getElementById(catName).focus();
		return false;
	}
	
	return true;
}
//-->
</script>
<table border="1" width="550" style="border-collapse: collapse">
<tr>
<td valign="top">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F0EFE3">
	<tr>
		<td bgcolor="#004E9B" height="21">
		<font color="#FFFFFF"><b>&nbsp; Thêm nhóm, mục mới</b></font></td>
	</tr>
	<tr>
		<td valign="top" align="center" style="padding-top: 10px; padding-bottom: 10px">
		<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">				
			 <form name="form2" method="post"  action="<?= $action_url; ?>" onSubmit="return checkFrmLoaiHang();">
			 <input type="hidden" name="cat_id" value="<?=$aryCatInfo['cat_id']?>">
                                <tr> 
                                  <td colspan="2" valign="middle">
				<p align="center"><b>
				<font face="Arial" color="#000099"></font></b></td>
                                        </tr>

				<tr>		
				 <td width="35%"><div align="right">
                                            Tên mục :</div>
                                         </td>
					<td><input id="cat_name" name="cat_name" size="40" style="width:200" value="<?=$aryCatInfo['cat_name']?>"></td>
				</tr>	

                                        <tr> 
                                          <td width="35%"><div align="right">
                                            Thuộc nhóm :</div></td>
                                          <td>
				<select name="parent_id" style="width:200px;">
				 <option value="0">----------Chọn nhóm hoặc chuyên mục cha----------</option>
			<?php 
			
				foreach ($aryCatList as $aryCat) {
					if($aryCatInfo['cat_id'] != $aryCat['cat_id']) {
						$selected = ($aryCatInfo['parent_id'] == $aryCat['cat_id']) ? " selected" : "";
						echo '<option value="' . $aryCat['cat_id'] . '"'. $selected . '>' . str_repeat('&nbsp;&nbsp;', $aryCat['level']).$aryCat['cat_name']. '</option>';
					}
									
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
					<input type="radio" value="1" <?=($aryCatInfo['cat_status'] == 1) ? " checked" : "";?> name="cat_status"></td>
					<td width="60">Có</td>
					<td width="22">
					<input type="radio" <?=($aryCatInfo['cat_status'] == 0) ? " checked" : "";?> name="cat_status" value="0"></td>
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
                                          <td width="35%">&nbsp;</td>
                                          <td>&nbsp;                                          </td>
                                        </tr>
                                        <tr> 
                                          <td width="35%">&nbsp;</td>
                                          <td>
                                            <input name="Submit" type="submit" class="button" value="  <?=($aryCatInfo['cat_id'])? "Lưu" : "Thêm"?>  "> 
                                            <input name="btnReset" type="reset" class="button" value="Làm lại"> 
                                            <input name="btnView" type="button" class="button" value="Xem DS" onClick="document.location.href='<?=base_url()?>news_cat'"></td>
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