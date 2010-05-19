<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url() . "iht_upload/$action";
?>
<?php echo validation_errors(); ?>
<?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
	<form action="<?=$action_url?>" enctype="multipart/form-data" method="post">
		<input type="hidden" name="id" value="<?=$id?>">
			<span class="legend">Tải tài liệu</span>
			<table style="vertical-align:top;">
				<tr>
					<td><label for="file_name">Tên tài liệu:</label></td>
					<td><input name="file_name" value="<?=$file_name?>" id="file_name" type="text" style="width: 200px" /></td>
				</tr>
				<tr>
				
				<td align="left" width="120" nowrap style="padding-left: 20px; padding-top:10px"><b>Loại tài liệu:</b></td>
				<td style="padding-left: 5px;" align="left">
				<select name="cat_id" style="width:200px;">
				 <option value="">---------- Chọn loại tài liệu ----------</option>
			<?php 
  
				foreach($doc_type as $key=>$text) {
					$selected = ($cat_id == $key) ? " selected" : "";
					echo '<option value="' . $key . '"'. $selected . '>' . $text. '</option>';
				}
			?>
				</select>
				</td>
			</tr>
				
				<tr>
					<td><label for="txtFileName">File:</label></td>
					<td><input type="file" name="uploadfile">
					</td>
				</tr>
			</table>
			<br />
			<input type="submit" value="Tải file" name="Submit" />
	</form>
</html>

</div>