<?php 
//	$this->lang->load('userauth', $this->session->userdata('ua_language')); 
	include_once("js/fckeditor/fckeditor.php");
	$sBasePath = $_SERVER['PHP_SELF'] ;
	$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "index" ) ) ;
	$sBasePath = $sBasePath.'js/fckeditor/';

	if (isset($msg)) { echo "<p class=\"error\">$msg</p>"; }

?>
	<div>
		<table width="760" border="0" cellpadding="5" cellspacing="5">

  <tr>
    <td colspan="2" >
    <?php
		$oFCKeditor = new FCKeditor('service');
		$oFCKeditor->BasePath = $sBasePath;
		$oFCKeditor->Height = 500;
		$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/office2003/' ;
		$oFCKeditor->Value = $service;
		$oFCKeditor->Create() ;
	?>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="Submit" type="submit" class="button" value="Save">&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" class="button" ></td>
  </tr>
</table>
</div>