<div id="content" class="narrowcolumn">
  <?
$this->load->helper('url');
$action_url = site_url() . "ci_upload/$action/";
$upload_url = site_url() . "ci_upload/file_add/";
?>
  <?php echo validation_errors(); ?>
  <?php if (isset($msg)) { echo "<p class=\"error\" id=\"msg\">$msg</p>"; } ?>
  <!--<link rel="stylesheet" href="<?=base_url()?>js/datepicker/flora.datepicker.css" type="text/css" media="screen" title="Flora (Default)">
<script type="text/javascript" src="<?=base_url()?>js/datepicker/ui.datepicker.js"></script>-->
  <script type="text/javascript" src="<?=base_url()?>js/jquery.form.js"></script>
  <script type="text/javascript">

function saveBaby(){
	$('#editBabyForm').ajaxSubmit({
		beforeSubmit:  function(){
			//show_Loading();
		},
		dataType:  'json', 
//		iframe: true,
        success: function(data){
        	//hide_Loading();
        	/*var upload = data.mess;
        	if(data.err == 0){
        		//thanh cong
        		$('#ngaysinhbe').val(upload.day);
        		$('#avatarInfo').html(upload.birthday);
        		$('#tenbe').val(upload.name);
        		$('#gioitinh').val(upload.gender);
        		$('#avatarTitle').html("Chào bé <strong>"+upload.name+"</strong>");
        		if(upload.avatar != ''){
        			$('#avatarImgMain > img').attr("src",upload.avatar);
        			$('#anhbe').val(upload.avatar);
        		}
        	}else{
        		alert(upload);
        	}
        	$.modal.close();*/
        }
	});
}
</script>
  <script type="text/javascript" src="<?=base_url()?>js/upload.js"></script>
  
  <?
$this->load->helper('url');
$action_url = site_url($action);
$this->lang->load('userauth', $this->session->userdata('ua_language')); 
?>
  <link rel="stylesheet" href="<?=base_url()?>css/register.css" type="text/css">
  <div id="tnpp_main_box">
    <div class="main_box_title">
      <div class="box_title_right">
        <p class="box_title_left">Upload file </p>
      </div>
    </div>
    <form action="<?=$upload_url?>" method="post" name="frmregis" id="editBabyForm" enctype="multipart/form-data" >
      <input type="hidden" value="save" id="op" name="op"/>
      <input type="hidden" value="register" id="regtype" name="regtype"/>
      <input type="hidden" value="" id="invite_hash" name="invite_hash"/>
      <div class="main_box_content">
        <ul class="ul_regis_acc">
          <li id="input_file_name">
            <div class="box_text"><span class="red_txt">* </span>File name:</div>
            <div id="input_file_name_content" class="box_frm">
              <input type="text" value="" class="txt_155" alt="alert_box" id="file_name" name="file_name"/>
              <p class="gray_10_txt"> File name may contain characters letters, numbers, underline mark (_), dashes (-) and length from 3 to 255 characters.</p>
            </div>
            <div class="box_error_area">
              <p class="box_error" id="error_notice_file_name" style="padding-bottom:0px;" />
            </div>
          </li>
          <li id="input_password">
            <div class="box_text"><span class="red_txt">* </span>File:</div>
            <div class="box_frm">
             <input type="hidden" name="MAX_FILE_SIZE" value="100000" /> 
      		<input type="file" name="fileshare" />
              <div class="gray_10_txt">
                <p>Max: 10M </p>
              </div>
            </div>
          </li>
        </ul>
        <div class="bottom_btn">
          <div class="btn_cover">
            <input type="button" value="Upload" class="tnpp_button_login" name="Submit" onclick="saveBaby();" />
          </div>
        </div>
    </form>
  </div>
</div>
<div style="position: absolute; z-index: 1000; left: -240px; top: 543px;" id="LoadingDiv">
  <table cellspacing="1" cellpadding="3" width="160" style="background-color: rgb(102, 102, 102);">
    <tbody>
      <tr>
        <td bgcolor="#ffffff" align="center"><img border="0" src="<?=site_url()?>images/loading.gif"/><br/>
          Loading....<br/>
          Click <font color="red"><b>F5</b></font> if you wait too long</td>
      </tr>
    </tbody>
  </table>
</div>
</div>
