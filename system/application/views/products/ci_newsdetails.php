<script type="text/javascript">
var nowID = <?=is_array($attach_files)?sizeof($attach_files):0?>;
function addItem(el, id) {
	//append to list
	nowID++;
//	alert(nowID);
	$("div#"+el).append('<div style="padding:5px;border-top:1px solid #eee;"><input type="hidden" value="'+nowID+'" name="pattach[]">Tiêu đề: <input size=30 type="text" name="userfile_title[]" value="">&nbsp;File: <input type="file" id="'+id+nowID+'" name="userfile'+nowID+'" size="25" />&nbsp;&nbsp;<a onclick="removeItem('+nowID+',\''+id+'\')" href="javascript:void(0)">Xóa</a></div>');
}
function removeItem(index, id){
	$('#'+id+index).parent().remove();
}

function removeModel(index, id){
	$('#'+id+index).remove();
}

function _return(img) {
	$("#house_image").val(img);
	$("#image_display").attr("src", '<?=base_url()?>images/common/.thumbs/'+img);
}

</script>
<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "products/$action/";

?>
<?php echo validation_errors(); ?>
<?php if(isset($error)) echo $error; ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
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
		alert("Ban chua nhap ten san pham.");
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
				<?php if($trans) echo $strLang;?>
				</td>
			</tr>
			<tr>
				<td valign="top" align="center">
				<table border="1" cellpadding="3" style="border-collapse: collapse; " width="100%" bordercolor="#D1D1D1">
		 
					<tr>
						<td align="left" width="120" nowrap style="padding-left: 20px; padding-top:10px"><b>Tên sản phẩm:</b></td>
						<td align="left" style="padding-left: 5px;">
						<input id="news_title" class="textbox" type="text" name="news_title" size="55" maxlength="200"  value="<?php echo htmlspecialchars($aryNewsInfo['news_title']) ?>"> 
						<span class="8blnormal">&nbsp; (Tối đa 200 ký tự)</span></td>

				<?php 
				 	if(!$trans) {
				 	?>
				 	<tr>
				
				<td align="left" width="120" nowrap style="padding-left: 20px; padding-top:10px"><b>Chủng loại hàng:</b></td>
				<td style="padding-left: 5px;" align="left">
				<select name="cat_id" style="width:200px;">
				 <option value="0">----------Chọn danh mục----------</option>
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
				 	<tr>
						<td align="left" width="120" nowrap style="padding-left: 20px"><b>Ảnh minh họa:</b></td>
						<td style="padding-left: 5px; padding-right: 20px">
						<!--<input type="text" id="news_image" name="news_image" size="50" maxlength="150" class="textbox"  value="<?php echo $aryNewsInfo['news_image'] ?>">&nbsp;
												<input type="button" value="chọn ảnh" name="btnChoose" class="button" language="javascript" onClick="return window.open('<?=base_url()?>ImageManager/manager.php?f=news','_chooseImg','menubar=no,scrollbars=yes,height=480px, width=830')">-->
												<div id="attach_file" style="padding:3px; margin-bottom:0px;">
	Tải các hình ảnh minh họa cho sản phẩm(Mỗi file nên dưới 1MB)<br />
<!--	Nếu bạn không có ảnh hãy click vào đây <input type="button" value="Chọn ảnh có sẵn" name="btnChoose" class="button" language="javascript" onClick="return window.open('<?=base_url()?>ImageManager/manager.php?f=common','_chooseImg','menubar=no,scrollbars=yes,height=480px, width=830')">-->
	<input type="hidden" id="house_image" name="house_image">
	<img id="image_display" src="<?=base_url()?>/images/Blank_1x1.gif">
	<?php
	$attach_files = $aryNewsInfo['news_image'];
	
	if($attach_files) {
		$aryFile = unserialize($attach_files);
		$aryImg = $aryFile['file'];
		$aryImgTitle = $aryFile['title'];
		
		if(is_array($aryImg)) for($i = 0, $n = sizeof($aryImg); $i < $n; $i++) {
			
			if(stripos($aryImg[$i], '/')) {
				$img_name = site_url().'images/common/.thumbs/'.$aryImg[$i];
			}
			else {	
				//get image name
				$img_name = substr($aryImg[0], 0, strrpos($aryImg[0], '.'));
				$ext = strrchr($aryImg[0], ".");
				$img_name = site_url().'images/property/'.$img_name.'_thumb'.$ext;
			}
					
					echo '<div style="padding:5px;border-top:1px solid #eee;">Tiêu đề: <input size="30" type="text" name="older_file_title['.$i.']" value="'.$aryImgTitle[$i].'">';
					echo '&nbsp;File: <img src="'.$img_name.'" height="80" />
					<input type="checkbox" value="'.$aryImg[$i].'" name="older_file['.$i.']" checked title="Bỏ check để xóa ảnh này">
					<input type="hidden" value="'.$aryImg[$i].'" name="origin_older_file['.$i.']">';
					echo '</div>';
		}
	}
	?>
		<div style="padding:5px;border-top:1px solid #eee;">
			Tiêu đề: <input size="30" type="text" name="userfile_title[]" value="">
			File: <input type="file" size="25" id="file0" name="userfile0" />&nbsp;
			<input type="hidden" value="0" name="pattach[]">
			<a onclick="removeItem(0, 'file')" href="javascript:void(0)">Xóa</a>
		</div>
	</div>
<div style="margin-bottom:20px; padding-left:5px;"><a href="javascript:void(0);" onclick="addItem('attach_file', 'file')" href="javascript:void(0)" style="text-decoration:underline;">Tải thêm file</a></div>
												</td>
					</tr>
				 		<tr>
						<td align="left" width="120" nowrap style="padding-left: 20px"><b>Cho phép đăng:</b></td>
						<td style="padding-right: 20px"><input type="radio" value="1" <?php if($aryNewsInfo['news_status'] == "1") echo "checked" ?> name="news_status">Có&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="news_status" value="0" <?php if($aryNewsInfo['news_status'] == "0") echo "checked" ?>>Không</td>
					</tr>
					<?}?>
					
					<tr>
						<td align="center" colspan="2" style="padding-top: 8px; padding-bottom: 8px; border-bottom-style:solid; border-bottom-width:1px">
						<input type="submit" value="Cập nhật" name="Submit" class="button">
						<input type="reset" value="Nhập lại" name="btnReset" class="button"></td>
					</tr>
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