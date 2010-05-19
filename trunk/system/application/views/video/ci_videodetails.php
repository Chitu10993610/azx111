<script type="text/javascript">
var nowID = <?=is_array($attach_files)?sizeof($attach_files):0?>;
function addItem(el, id) {
	//append to list
	nowID++;
//	alert(nowID);
	$("div#"+el).append('<div id="div'+nowID+'" style="padding:5px;border-top:1px solid #eee;"><table>'
	+'<input type="hidden" value="'+nowID+'" name="pattach[]">'
	+'<tr><td>Tiêu đề: </td><td><input size=39 type="text" name="userfile_title[]" value=""></td></tr>'
	+'<tr><td>Giới thiệu: </td><td><textarea cols="30" rows="3" name="userfile_des[]"></textarea></td></tr>'
	+'<tr><td>Giới thiệu: </td><td><textarea cols="30" rows="3" name="userfile_des[]"></textarea></td></tr>'
	+'<tr><td>File: </td><td><input type="file" id="'+id+nowID+'" name="userfile'+nowID+'" size="25" />&nbsp;&nbsp;<a onclick="removeItem('+nowID+',\''+id+'\')" href="javascript:void(0)">Xóa</a></td></tr>'
	+'</table></div>');
}
function removeItem(index, id){
	$('#div'+index).remove();
}

function removeModel(index, id){
	$('#'+id+index).remove();
}

function _return(img) {
	$("#house_image").val(img);
	$("#image_display").attr("src", '<?=base_url()?>video/common/.thumbs/'+img);
}

</script>
<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "upload_video/$action/";

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
	if(obj.txtVideoTitle.value=="")
	{
		alert("Ban chua nhap ten san pham.");
		obj.txtVideoTitle.focus();
		return false;
	}
	if(obj.txtVideoDescript.value=="")
	{
		alert("Ban chua nhap Trich dan ngan.");
		obj.txtVideoDescript.focus();
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
	$("#video_image").val(img);
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
				<?php 
				 	if(!$trans) {
				 	?>
				 	<tr>
				
				<td align="left" width="120" nowrap style="padding-left: 20px; padding-top:10px"><b>Chuyên mục:</b></td>
				<td style="padding-left: 5px;" align="left">
				<select name="cat_id" style="width:200px;">
				 <option value="0">----------Chọn danh mục----------</option>
			<?php 
			
				foreach ($aryCatList as $aryCat) {
					$selected = ($aryVideoInfo['cat_id'] == $aryCat['cat_id']) ? " selected" : "";
					echo '<option value="' . $aryCat['cat_id'] . '"'. $selected . '>' . str_repeat('&nbsp;&nbsp;', $aryCat['level']).$aryCat['cat_name']. '</option>';
				}
			?>
				</select>
				</td>
			</tr>
				 	<tr>
						<td align="left" width="120" nowrap style="padding-left: 20px"><b>Video:</b></td>
						<td style="padding-left: 5px; padding-right: 20px">
						<!--<input type="text" id="video_image" name="video_image" size="50" maxlength="150" class="textbox"  value="<?php echo $aryVideoInfo['video_image'] ?>">&nbsp;
												<input type="button" value="chọn video" name="btnChoose" class="button" language="javascript" onClick="return window.open('<?=base_url()?>ImageManager/manager.php?f=video','_chooseImg','menubar=no,scrollbars=yes,height=480px, width=830')">-->
												<div id="attach_file" style="padding:3px; margin-bottom:0px;">
		<div id="div0" style="padding:5px;border-top:1px solid #eee;">
		<table>
			<tr><td>Tiêu đề: </td><td><input size="39" type="text" name="file_name" value="<?=$aryVideoInfo['file_name']?>"></td></tr>
			<tr><td>Giới thiệu: </td><td><textarea cols="30" rows="3" name="file_des"><?=$aryVideoInfo['file_des']?></textarea></td></tr>
			<tr> 
              <td width="35%">
                Hình đại diện :</td>
              <td><input type='file' name='image' id='image' /> (480 x 385px)</td>
            </tr>
			<td>File: </td><td><input type="file" size="25" id="file" name="userfile" /> (Tối đa 30Mb)
			<br />
			<?php if($aryVideoInfo['file_real_name']) {?><b>File cũ</b>: <?php  echo $aryVideoInfo['file_real_name']; }?> 
			</td></tr>
		</table>
		<div style="float:right; width:150px">
		<?php
		if($aryVideoInfo['video_image']) {
			$thumb = ($aryVideoInfo["video_image"]) ? $this->iht_common->get_thumb(IMG_VIDEO_PATH.'thumb/'.$aryVideoInfo["video_image"]) : '';?>
			<img src="<?=$thumb?>">
			<?}?>
		</div>
		</div>
	</div>
	</td>
					</tr>
				 		<tr>
						<td align="left" width="120" nowrap style="padding-left: 20px"><b>Cho phép đăng:</b></td>
						<td style="padding-right: 20px"><input type="radio" value="1" <?php if($aryVideoInfo['video_status'] == "1") echo "checked" ?> name="video_status">Có&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="video_status" value="0" <?php if($aryVideoInfo['video_status'] == "0") echo "checked" ?>>Không</td>
					</tr>
					
			
					<?}?>
					<tr>
						<td colspan="2"><a href="javascript:divToogle('option_extend');"><b><i>Code nhúng</i></b></a></td>
					</tr>
					<tr>
						<td colspan="2">
						<div id="option_extend" style="display:none;">
							<table>
								<tr>
									<td align="left" width="120" style="padding-left: 20px"></td>
									<td>
									<textarea cols="50" rows="10" name="code_embed"><?=$aryVideoInfo['embed_code']?></textarea>
									</td>
								</tr>
							</table>
							</div>
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2" style="padding-top: 8px; padding-bottom: 8px; border-bottom-style:solid; border-bottom-width:1px">
						<input type="submit" value="   Lưu   " name="Submit" class="button">
						<input type="reset" value="Nhập lại" name="btnReset" class="button"></td>
					</tr>
					<input type="hidden" name="id" value="<?php echo $aryVideoInfo['id']; ?>">
					<input type="hidden" name="req" value="update_video">
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
<input type="hidden" name="old_image" value="<?=$aryVideoInfo['video_image']?>">
<input type="hidden" name="older_file" value="<?=$aryVideoInfo['file_real_name']?>">
</form>
</div>
<script type="text/javascript" src="<?=base_url()?>ImageManager/assets/dialog.js"></script>