<link rel="stylesheet" href="<?=base_url()?>js/datepicker/flora.datepicker.css" type="text/css" media="screen" title="Flora (Default)">
<script type="text/javascript" src="<?=base_url()?>js/datepicker/ui.datepicker.js"></script>
<script type="text/javascript">

 $(document).ready(function(){
    $("#available_date").datepicker({ dateFormat: 'mm/dd/yy' });
  });
  
  var nowID = <?=is_array($attach_files)?sizeof($attach_files):0?>;
function addItem(el, id) {
	//append to list
	nowID++;
//	alert(nowID);
	$("div#"+el).append('<div style="padding:5px;border-top:1px solid #eee;"><input type="hidden" value="'+nowID+'" name="pattach[]">Tiêu đề: <input size=30 type="text" name="userfile_title[]" value="">&nbsp;File: <input type="file" id="'+id+nowID+'" name="userfile'+nowID+'" size="30" />&nbsp;&nbsp;<a onclick="removeItem('+nowID+',\''+id+'\')" href="javascript:void(0)">Xóa</a></div>');
}
function removeItem(index, id){
	$('#'+id+index).parent().remove();
}

function removeModel(index, id){
	$('#'+id+index).remove();
}

function _return(img) {
	alert(img);
	$("#house_image").val(img);
	$("#image_display").attr("src", '<?=base_url()?>images/common/.thumbs/'+img);
}

</script>

<div id="map_container" style="display:none;padding:5px; border: 1px #CCCCCC solid; width:410px;height:310px; position:absolute; background-color:#C0c0c0;">
	<div id="map" style="border: 1px #CCCCCC solid; width:400px;height:300px"></div>
	<a style="padding:5px;" href="javascript:void(0);" onclick='$("#map_container").css("display","none");'><b>Close</b></a>
</div>
<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() .$site_name. "/products/$action/";

?>
<form name="ImageManager" id="ImageManager" method="POST" action="<?= $action_url; ?>" enctype="multipart/form-data">
<input type='hidden' name='id' id='id' value='<?= $id; ?>' >
<?php echo validation_errors(); ?>
<?php if(isset($error)) echo $error;?>
<table width="685" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td width="163"><label for="name"><b>Tiêu đề sản phẩm</b></label> </td>
    <td width="502"><input style="width:480px;" name="name" type="text" id="name" value="<?= $name; ?>" maxlength="255" /></td>
  </tr>
<tr>
    <td>Tỉnh/Thành phố</td>
    <td><select name='province' >
    <option value="">Chọn tỉnh/Thành phố</option>
    <?php 
//    foreach($provinceOption as $key=>$ptype) {
//    	echo '<option value="'.$key.'">'.$ptype.'</option>';
//    }

			 foreach ($provinceOption as $aryProvince) {
				$lookupid   = $aryProvince["id"];
				$lookuptext   = $aryProvince["name"];
		?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $province)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
		<?			 
			 } ?>
    </select>
    </td>
  </tr>
<!--<tr>
    <td>Quận Huyện</td>
    <td><select name='district' >
    <option value="">Chọn quận huyện</option>
    <?php foreach($districtOption as $key=>$ptype) {
    	echo '<option value="'.$key.'">'.$ptype.'</option>';
    }
    ?>
    </select>
    </td>
  </tr>-->
  <tr>
    <td><b>Mô tả ngắn</b></td>
    <td><textarea cols="80" rows="3" name="infomation" id="infomation" style="width:480px;"/><?= $infomation; ?></textarea></td>
  </tr>  
  <?php 
  if($this->session->userdata('groupid') == 2 || $this->session->userdata('groupid') == 1) {?>
  <tr>
    <td><b>Chi tiết sản phẩm</b></td>
    <td><textarea cols="80" rows="8" name="private_info" id="private_info" style="width:480px;"/><?= $private_info; ?></textarea></td>
  </tr>
  <?php }?>
</table>
	<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>

<div id="attach_file" style="padding:3px; margin-bottom:0px;">
	Tải các hình ảnh minh họa cho sản phẩm(Mỗi file nên dưới 1MB)<br />
	Nếu bạn không có ảnh hãy click vào đây <input type="button" value="Chọn ảnh có sẵn" name="btnChoose" class="button" language="javascript" onClick="return window.open('<?=base_url()?>ImageManager/manager.php?f=common','_chooseImg','menubar=no,scrollbars=yes,height=480px, width=830')">
	<input type="hidden" id="house_image" name="house_image">
	<img id="image_display" src="<?=base_url()?>/images/Blank_1x1.gif">
	<?php
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
				$img_name = site_url().'images/property/'.$img_name.'_small'.$ext;
			}
					
					echo '<div style="padding:5px;border-top:1px solid #eee;">Tiêu đề: <input size="30" type="text" name="older_file_title['.$i.']" value="'.$aryImgTitle[$i].'">';
					echo '&nbsp;File: <img src="'.$img_name.'" height="80" />
					<input type="checkbox" value="'.$aryImg[$i].'" name="older_file['.$i.']" checked>
					<input type="hidden" value="'.$aryImg[$i].'" name="origin_older_file['.$i.']">';
					echo '</div>';
		}
	}
	?>
		<div style="padding:5px;border-top:1px solid #eee;">
			Tiêu đề: <input size="30" type="text" name="userfile_title[]" value="">
			File: <input type="file" size="30" id="file0" name="userfile0" />&nbsp;
			<input type="hidden" value="0" name="pattach[]">
			<a onclick="removeItem(0, 'file')" href="javascript:void(0)">Xóa</a>
		</div>
	</div>
<div style="margin-bottom:20px; padding-left:5px;"><a href="javascript:void(0);" onclick="addItem('attach_file', 'file')" href="javascript:void(0)" style="text-decoration:underline;">Tải thêm file</a></div>

<!--	</fieldset>-->
<div style="padding:5px;"><input name="Submit" type="submit" class="button" value="Save">&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" class="button" ></div>
</form>
</div>
<script type="text/javascript" src="<?=base_url()?>ImageManager/assets/dialog.js"></script>