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
<form name="frmViewNews" method="post" action="upload_video/delete">
<?php foreach ($aryVideoList as $aryVideo) { ?>
	<div class="noidung-trai-02a">
		<?php 
		$thumb = ($aryVideo["video_image"]) ? $this->iht_common->get_thumb(IMG_VIDEO_PATH.'thumb/'.$aryVideo["video_image"]) : '';
		?>
		<div style="background-image: url('<?=$thumb?>')" class="imgvip_home">
			<?php if(access(EDIT_VIDEO)) {?><a href="upload_video/modify/<?php echo $aryVideo["id"]?>">
				<img height="100" width="150" src="images/spacer.gif" title="Xem video">
			</a>
			<?}else {?><img height="100" width="154" src="images/spacer.gif" title="Xem video">
			<?}?>
		</div>
		<div><input type="checkbox" id="chkid" name="chkid[]" value="<?php echo $aryVideo["id"]?>" onClick="docheckone();">
		<?php if(access(EDIT_VIDEO)) {?><a <?php if($aryVideo["video_status"]) echo ("class='lnkGray'") ?> title="Sua video" href="upload_video/modify/<?php echo $aryVideo["id"]?>"><?php echo $aryVideo["file_name"]?></a><?}?></div>
		
	</div>
<?}?>
<div style="clear:both;">
	<input type="checkbox" id="chkall" name="chkall" value="ON" onClick="checkall();"><label for="chkall">Chọn/bỏ chọn tất cả</label>
	<br />
	<?php if(access(ADD_VIDEO)) {?><input type="button" value="Thêm video mới" name="btnAddVideo" class="button" onClick="document.location.href='upload_video/add/<?=$cid?>'"><?}?>&nbsp;
	<?php if(access(DELETE_VIDEO)) {?><input type="submit" value="Xoá các video đã chọn" name="btnDelete" class="button" onClick="return checkGrid();" <?php If (!$numOfVideo) echo "DISABLED" ?>><?}?></div>
</form>
</div>