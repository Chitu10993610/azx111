<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "news/$action/".$aryNewsInfo['news_type'];

?>
<?php echo validation_errors(); ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
<?php if (isset($error)) { echo "<p class=\"error\" id=\"msg\">$error</p>"; } ?>
<form name="ImageManager" id="ImageManager" method="POST" action="<?= $action_url; ?>" enctype="multipart/form-data">

<?php
	include_once("js/fckeditor/fckeditor.php");
	$sBasePath = $_SERVER['PHP_SELF'] ;
	$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "index" ) ) ;
	$sBasePath = $sBasePath.'js/fckeditor/';
?>

<script language="javascript">
<!--
function checkFrm(obj)
{
	if(obj.txtNewsTitle.value=="")
	{
		alert("Ban chua nhap Tieu de tin.");
		obj.txtNewsTitle.focus();
		return false;
	}
	if(obj.txtNewsDescript.value=="")
	{
		alert("Ban chua nhap Trich dan ngan.");
		obj.txtNewsDescript.focus();
		return false;
	}
	if(obj.txtMessage.value=="")
	{
		alert("Ban chua nhap Noi dung.");
		return false;
	}
	return true;
}


function _return(img) {
	$("#news_image").val(img);
}

//-->
</script>

<table border="1" width="760" style="border-collapse: collapse">
	<tr>
		<td valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F0EFE3">
			<tr>
				<td bgcolor="#004E9B" height="21">
								<font color="#FFFFFF"><b>&nbsp;<?=$title?></font>
				<?php if($trans) echo $strLang;?></td>
			</tr>
			<tr>
				<td valign="top" align="center">
				<table border="1" cellpadding="3" style="border-collapse: collapse; " width="100%" bordercolor="#D1D1D1">
		 
					<tr>
						<td align="left" width="120" nowrap style="padding-left: 20px; padding-top:10px"><b>Tiêu đề Tin:</b></td>
						<td align="left" style="padding-left: 5px;">
						<input id="news_title" class="textbox" type="text" name="news_title" size="55" maxlength="200"  value="<?php echo htmlspecialchars($aryNewsInfo['news_title']) ?>"> 
						<span class="8blnormal">&nbsp; (Tối đa 200 ký tự)</span></td>
			<?php 
				 	if(!$trans) {
				 	?>
		<!--<tr>
				
				<td align="left" width="120" nowrap style="padding-left: 20px; padding-top:10px"><b>Loại tin:</b></td>
				<td style="padding-left: 5px;" align="left">
				<select name="news_type" style="width:200px;">
				 <option value="">---------- Chọn loại tin ----------</option>
			<?php 
  
				foreach($newsTypeOption as $key=>$text) {
					$selected = ($aryNewsInfo['news_type'] == $key) ? " selected" : "";
					echo '<option value="' . $key . '"'. $selected . '>' . $text. '</option>';
				}
			?>
				</select>
				</td>
			</tr>-->
			<tr>
				
				<td align="left" width="120" nowrap style="padding-left: 20px; padding-top:10px"><b>Chủng loại hàng:</b></td>
				<td style="padding-left: 5px;" align="left">
				<select name="cat_id" style="width:200px;">
				 <option value="0">----------Chọn mục tin----------</option>
			<?php 
			
				foreach ($aryCatList as $aryCat) {
					$selected = ($aryNewsInfo['cat_id'] == $aryCat['cat_id']) ? " selected" : "";
					echo '<option value="' . $aryCat['cat_id'] . '"'. $selected . '>' . str_repeat('&nbsp;&nbsp;', $aryCat['level']).$aryCat['cat_name']. '</option>';
				}
			?>
				</select>
				</td>
			</tr>
<?}?>
					<tr>
						<td align="left" width="120" valign="top" nowrap style="padding-left: 20px"><b>Trích dẫn:</b></td>
						<td style="padding-left: 5px;" align="left">
						<textarea id="intro_content" rows="5" name="intro_content" cols="60" style="width:500px;"><?php echo htmlspecialchars($aryNewsInfo['intro_content']) ?></textarea></td>
					</tr>
		
					<tr>
						<td align="left" valign="top" colspan="2" nowrap style="padding-left: 20px; padding-right: 20px; border-bottom-style:none; border-bottom-width:medium">
						<b>Nội dung:</b></td>
					</tr>
					<tr>
						<td align="center" valign="top" colspan="2" nowrap style="padding-left: 1px; padding-right:1px; border-top-style:none; border-top-width:medium">
							<?php
								$oFCKeditor = new FCKeditor('news_content');
								$oFCKeditor->BasePath = $sBasePath;
								$oFCKeditor->Height = 300;
								$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/office2003/' ;
								$oFCKeditor->Value = $aryNewsInfo['news_content'];
								$oFCKeditor->Create() ;
							?>
						</td>
					</tr>
					<?php 
				 	if(!$trans) {
				 	?>
					<!--<tr>
						<td align="left" width="120" nowrap style="padding-left: 20px"><b>Ảnh minh họa:</b></td>
						<td style="padding-left: 5px; padding-right: 20px">
						<input type="text" id="news_image" name="news_image" size="50" maxlength="150" class="textbox"  value="<?php echo $aryNewsInfo['news_image'] ?>">&nbsp;
												<input type="button" value="chọn ảnh" name="btnChoose" class="button" language="javascript" onClick="return window.open('<?=base_url()?>ImageManager/manager.php?f=news','_chooseImg','menubar=no,scrollbars=yes,height=480px, width=830')"></td>
					</tr>-->
					<tr>
						<td align="left" width="120" nowrap style="padding-left: 20px"><b>Ảnh minh họa: </b></td>
						<td style="padding-left: 5px; padding-right: 20px">
						<input style="width:300px;" type="file" name="news_image"> (Kích thước chuẩn:480 x 368px)
												<?php
												$thumb = ($aryNewsInfo["news_image"])? $this->front_lib->get_thumb(IMG_NEWS_PATH.$aryNewsInfo["news_image"]) : '';
												if($aryNewsInfo['news_image']) {
													echo '<img width="100" src="'.$thumb. '" / >';
													?>
													<input type="hidden" name="news_image_old" value="<?=$aryNewsInfo['news_image']?>" />
													<?php
												}
												?></td>
					</tr>
					<?php
					if(access(PUBLISH_NEWS)) {?>
					<tr>
						<td align="left" width="120" nowrap style="padding-left: 20px"><b>Cho phép đăng:</b></td>
						<td style="padding-right: 20px"><input type="radio" value="1" <?php if($aryNewsInfo['news_status'] == "1" || $aryNewsInfo['news_status'] == '') echo "checked" ?> name="news_status">Có&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="news_status" value="0" <?php if($aryNewsInfo['news_status'] == "0") echo "checked" ?>>Không</td>
					</tr>
					<tr>
						<td align="left" width="120" style="padding-left: 20px"><b>Hiển thị tin ngoài trang chủ:</b></td>
						<td><input type="radio" value="1" name="show_home" <?php if($aryNewsInfo['show_home'] == "1" ||$aryNewsInfo['show_home'] == '') echo "checked" ?>>Có&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="show_home" value="0" <?php if($aryNewsInfo['show_home'] == "0") echo "checked" ?>>Không</td>
					</tr>
					<tr>
						<td align="left" width="120" style="padding-left: 20px"><b>Hiển thị trong mục tin tiêu điểm:</b></td>
						<td><input type="radio" value="1" name="is_tieudiem" <?php if($aryNewsInfo['is_tieudiem'] == "1" || $aryNewsInfo['is_tieudiem'] == '') echo "checked" ?>>Có&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="is_tieudiem" value="0" <?php if($aryNewsInfo['is_tieudiem'] == "0") echo "checked" ?>>Không</td>
					</tr>
					<?}?>
					<?}?>
					<tr>
						<td align="center" colspan="2" style="padding-top: 8px; padding-bottom: 8px; border-bottom-style:solid; border-bottom-width:1px">
						<input type="submit" value="Cập nhật" name="Submit" class="button">
						<input type="reset" value="Nhập lại" name="btnReset" class="button"></td>
					</tr>
					<input type="hidden" name="news_type" value="<?php echo $aryNewsInfo['news_type']; ?>">
					<input type="hidden" name="news_id" value="<?php echo $aryNewsInfo['news_id']; ?>">
					<input type="hidden" name="req" value="update_news">
					<?php 
				 	if($trans) {
				 	?>
				 	<input type="hidden" name="trans" value="<?=$trans?>">
				 	<input type="hidden" name="translated" value="<?=$translate?>">
	<?}?>
				</form>					
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</form>
</div>
<script type="text/javascript" src="<?=base_url()?>ImageManager/assets/dialog.js"></script>