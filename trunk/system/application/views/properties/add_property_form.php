<link rel="stylesheet" href="<?=base_url()?>js/datepicker/flora.datepicker.css" type="text/css" media="screen" title="Flora (Default)">
<script type="text/javascript" src="<?=base_url()?>js/datepicker/ui.datepicker.js"></script>
<?php
	include_once("js/fckeditor/fckeditor.php");
	$sBasePath = $_SERVER['PHP_SELF'] ;
	$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "index" ) ) ;
	$sBasePath = $sBasePath.'js/fckeditor/';
?>
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
</script>

<script type="text/javascript">
var map;
var p1, p2;

function distanceProcess() {
		
		document.getElementById("distance").value = 0;
		document.getElementById("submited").value = 1;
		document.ci_propertiesdetails.submit();
    }

function _return(img) {
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
$action_url = site_url() .$site_name. "/properties/$action/";

?>
<form name="ImageManager" id="ImageManager" method="POST" action="<?= $action_url; ?>" enctype="multipart/form-data">
<input type='hidden' name='id' id='id' value='<?= $id; ?>' >
<?php echo validation_errors(); ?>
<?php if(isset($error)) echo $error;?>
<?=$property_type?>
<table width="733" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td width="163"><label for="name">Tiêu đề tin</label> </td>
    <td width="502"><input style="width:480px;" name="name" type="text" id="name" value="<?= $name; ?>" maxlength="255" /></td>
  </tr>
<tr>
				<td>Loai tin rao</td>
				<td style="padding-left: 5px;" align="left">
				<select name="property_type" style="width:200px;">
				 <option value="">----------Chọn danh mục----------</option>
			<?php 
			
				foreach ($aryCatList as $aryCat) {
					$lookupid   = $aryCat["cat_id"];
					$lookuptext   = $aryCat["cat_name"];?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $property_type)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
					<?}
			?>
				</select>
				</td>
  </tr><tr>
    <td>Tỉnh/Thành phố</td>
    <td><select id="province" name='province' onchange="commonLoad('<?=base_url().'ajax/district/'?>', this, 'district');" >
    <option value="">Chọn tỉnh/Thành phố</option>
    <?php 
			 foreach ($provinceOption as $aryProvince) {
				$lookupid   = $aryProvince["id"];
				$lookuptext   = $aryProvince["name"];
		?>
				<option value="<?= $lookupid; ?>" <?= ($lookupid == $province)?"selected=selected":""; ?> ><?= $lookuptext; ?></option>
		<?			 
			 } ?>
    </select>    </td>
  </tr>
					<tr>
						<td>Nội dung:</td>
					</tr>
					<tr>
						<td align="center" valign="top" colspan="2" nowrap style="padding-left: 1px; padding-right:1px; border-top-style:none; border-top-width:medium">
								<?php
								$oFCKeditor = new FCKeditor('infomation');
								$oFCKeditor->BasePath = $sBasePath;
								$oFCKeditor->Height = 300;
								$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/office2003/' ;
								$oFCKeditor->Value = $infomation;
								$oFCKeditor->Create() ;
							?>
						</td>
					</tr>
  <tr>
    <td>Nhu cầu</td>
    <td>
    <input type='radio' name='type'  value="0" <?php if (empty($type)) echo 'checked="checked"';?> /> Bán &nbsp;&nbsp;&nbsp;
    <input type='radio' name='type' value="1" <?php if ($type == 1) echo "checked";?> /> Cho Thuê&nbsp;&nbsp;&nbsp;
    <input type='radio' name='type' value="2" <?php if ($type == 2) echo "checked";?> /> Cần Mua&nbsp;&nbsp;&nbsp;
    <input type='radio' name='type' value="3" <?php if ($type == 3) echo "checked";?> /> Cần Thuê    </td>
  </tr>
    <?php
	if(access(PUBLISH_NEWS)) {?>
  <tr>
    <td>Tin vip</td>
    <td>
    <input type='radio' name='is_vip'  value="0" <?php if (empty($is_vip)) echo 'checked="checked"';?> /> Không&nbsp;&nbsp;&nbsp;
    <input type='radio' name='is_vip' value="1" <?php if ($is_vip == 1) echo "checked";?> /> Là tin VIP    </td>
  </tr>
    <tr>
    <td>Giao dịch hot</td>
    <td>
    <input type='radio' name='is_hot'  value="0" <?php if (empty($is_hot)) echo 'checked="checked"';?> /> Không&nbsp;&nbsp;&nbsp;
    <input type='radio' name='is_hot' value="1" <?php if ($is_hot == 1) echo "checked";?> /> Là giao dịch hot    </td>
  </tr>
  <tr>
  </tr>
    <tr>
    <td>Cho phép đăng</td>
    <td>
    <input type='radio' name='status'  value="0" <?php if (empty($status)) echo 'checked="checked"';?> /> Không&nbsp;&nbsp;&nbsp;
    <input type='radio' name='status' value="1" <?php if ($status == 1) echo "checked";?> /> Có</td>
  </tr>
  <?}?>
  <tr>
    <td>Ngày hết hạn tin</td>
    <td><div id="div_range" style="padding:5px 5px 5px 0px;">

          <input name="available_date" id="available_date" value="<?php $available_date = (isset($available_date) && $available_date) ? $available_date : time(); echo date("m/d/Y", $available_date+2592000)?>" size="12" readonly="readonly" type="text" />
          <a onclick="document.getElementById('available_date').focus();" ><img src="<?=site_url()?>images/calbtn.gif" alt="" name="popcal" width="34" height="22" border="0" align="absbottom" id="popcal" /></a>
          </div></td>
  </tr>
  <tr>
	<td valign="top">Giá :</td>
		<td>
		<input type="text" value="<?= $price; ?>"  size="20" name="price"/> 
		
<select size="1" name="currency">
	<option <?=($currency == 'VNĐ') ? "Selected" : ''; ?> value="VNĐ">VNĐ</option>
	<option <?=($currency == 'USD') ? "Selected" : ''; ?> value="USD">USD</option>
</select></td>
</tr>
</table>
	
<div>
	<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
	<div id="property_detail">
<div id="container"></div>
<div id="attach_file" style="padding:3px; margin-bottom:0px;">
	Tải các hình ảnh minh họa cho BDS (Mỗi file nên dưới 1MB)
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
	</div>
</div>
<div>
	<div id="div-contact">
	<table width="685" border="0" cellpadding="5" cellspacing="5">
	<tr>
    <td><label for="contact_name">Tên người liên hệ</label>
        </td>
    <td><input style="width:480px;" name="contact_name" type="text" id="contact_name" value="<?= $contact_name; ?>" maxlength="255" /></td>
  </tr>
  <tr>
    <td><label for="contact_phone">Điện thoại liên hệ</label>
        </td>
    <td><input style="width:480px;" name="contact_phone" type="text" id="contact_phone" value="<?= $contact_phone; ?>" maxlength="255" /></td>
  </tr>
  <tr>
    <td><label for="contact_email">Email Liên hệ</label>
        </td>
    <td><input style="width:480px;" name="contact_email" type="text" id="contact_email" value="<?= $contact_email; ?>" maxlength="255" /></td>
  </tr>
  </table>
      <div style="padding:5px;"><input name="Submit" type="submit" class="button" value="Save">&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" class="button" ></div>
      </div>
</div>

</form>
</div>
<script type="text/javascript" src="<?=base_url()?>ImageManager/assets/dialog.js"></script>