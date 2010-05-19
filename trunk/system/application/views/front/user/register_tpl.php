<!--<link rel="stylesheet" href="<?=base_url()?>js/datepicker/flora.datepicker.css" type="text/css" media="screen" title="Flora (Default)">
<script type="text/javascript" src="<?=base_url()?>js/datepicker/ui.datepicker.js"></script>-->
<script type="text/javascript" src="<?=base_url()?>js/jquery.form.js"></script>
<script type="text/javascript">

 $(document).ready(function(){
    //$("#birthday").datepicker({ dateFormat: 'yy/mm/dd' });
    
//    show_Loading();
  });
  
  // prepare the form when the DOM is ready 
$(document).ready(function() { 
    var options = { 
        //target:        '#output2',   // target element(s) to be updated with server response 
        beforeSubmit:  CheckForms,  // pre-submit callback 
        success:       showResponse,  // post-submit callback 
 
        // other available options: 
        url: '<?=site_url()?>user/ucheck',
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
    // bind to the form's submit event 
    $('#frm_register').submit(function() { 
        // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        $(this).ajaxSubmit(options); 
 
        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false; 
    }); 
}); 
</script>
<script type="text/javascript" src="<?=base_url()?>js/register.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/vietuni8.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/loading.js"></script>

<div id="content" class="narrowcolumn">
<?
$this->load->helper('url');
$action_url = site_url($action);
$this->lang->load('userauth', $this->session->userdata('ua_language')); 
?>
	
<link rel="stylesheet" href="<?=base_url()?>css/register.css" type="text/css">
	<div id="tnpp_main_box">
	  <div class="main_box_title">
	    <div class="box_title_right"><p class="box_title_left">Đăng ký thành viên</p></div>
	  </div>
<!--	  <div class="optyping">Kiểu gõ:
							<input type="radio" onfocus="setTypingMode(0);" checked="checked" value="OFF" name="switcher" id="ratype01"/><label for="ratype01">Tắt</label>
							<input type="radio" onfocus="setTypingMode(2);" value="vnVni" name="switcher" id="ratype02"/><label for="ratype02">Vni</label>
							<input type="radio" onfocus="setTypingMode(1);" value="TELEX" name="switcher" id="ratype03"/><label for="ratype03">Telex</label>
		</div>-->
		( ô có dấu <span class="red_txt">* </span> Là bắt buộc nhập)
<form action="" method="post" name="frmregis" id="frm_register">
<input type="hidden" value="save" id="op" name="op"/>
<input type="hidden" value="register" id="regtype" name="regtype"/>
<input type="hidden" value="" id="invite_hash" name="invite_hash"/>
	  <div class="main_box_content">
	    <div class="title_ctn_gray">Thông tin đăng nhập:</div>
	    <ul class="ul_regis_acc">
		    <li id="input_username">
		      <div class="box_text"><span class="red_txt">* </span>Username:</div>
			    <div id="input_username_content" class="box_frm">
				    <input type="text" value="" onfocus="NHYShowAlert(this,0)" onkeyup="CheckStatus()" class="txt_155" alt="alert_box" id="username" name="username"/>
<!--				    <input type="button" onclick="Check_username()" disabled="disabled" value="Kiểm tra" class="btn_check" name="btCheck" id="btCheck"/>-->
				    <p class="gray_10_txt">Username có thể chứa ký tự chữ cái, chữ số, dấu gạch dưới (_), dấu gạch ngang (-) và độ dài từ 6 đến 20 ký tự</p><p class="red_10_txt">Username này đã được đăng ký. Xin vui lòng chọn username khác.</p>
			    </div>
			    <div class="box_error_area">
				    <p class="box_error" id="error_notice_username"/>					
			    </div>
		    </li>
		    <li id="input_password">
			    <div class="box_text"><span class="red_txt">* </span>Password:</div>
			    <div class="box_frm">
				    <input type="password" onfocus="NHYShowAlert(this,1)" class="txt_155" alt="alert_password" id="password" name="password"/>
				    <div class="gray_10_txt"><p>- Password có thể chứa các ký tự chữ cái, chữ số và có độ dài từ 6 đến 30 ký tự.</p>
  <p>- Password không được chứa khoảng trắng, các ký tự Unicode (ví dụ: tiếng Việt có dấu).</p></div>
			    </div>
			    <div class="box_error_area"><p class="box_error" id="error_notice_password"/></div>
		    </li>
		    <li id="input_password2">
			    <div class="box_text"><span class="red_txt">* </span>Nhập lại Password</div>
			    <div class="box_frm"><input type="password" class="txt_155" id="password2" name="password2"/></div>
			    <div class="box_error_area"><p class="box_error" id="error_notice_password2"/></div>
		    </li>
	    </ul>
	    <div class="title_ctn_gray">Thông tin cá nhân:</div>
	    <ul class="ul_regis_acc">
		    <li id="input_name">
		      <div class="box_text"><span class="red_txt">* </span>Họ và tên:</div>
			    <div class="box_frm">
				    <input type="text" value="" class="txt_213" id="fullname" name="fullname"/> 
			    </div>
			    <div class="box_error_area"><p class="box_error" id="error_notice_name"/></div>
		    </li>
		    <li id="input_email">
			    <div class="box_text"><span class="red_txt">* </span>Email của bạn:</div>
			    <div class="box_frm">
				    <input type="text" onfocus="NHYShowAlert(this,3)" class="txt_213" alt="alert_email" name="email" value="" style="background-color: rgb(255, 255, 160);"/> 
				    <p class="gray_10_txt">Bạn hãy nhập chính xác địa chỉ email của bạn đang sử dụng</p>
			    </div>
			    <div class="box_error_area"><p class="box_error2" id="error_notice_email"><span class="conerr"/></p></div>
		    </li>
			<li id="input_email_retype">
			    <div class="box_text"><span class="red_txt">* </span>Nhập lại email:</div>
			    <div class="box_frm">
				    <input type="text" class="txt_213" name="email_retype" value="" style="background-color: rgb(255, 255, 160);"/> 
		        </div>
			    <div class="box_error_area"><p class="box_error" id="error_notice_email_retype"><span class="conerr">Xin vui lòng nhập chính xác địa chỉ email ở trên</span></p></div>
		    </li>
		    <li id="input_security">
			    <div class="box_text"><strong class="blue_txt"><span class="red_txt">* </span>Mã xác nhận:</strong></div>
			    <div class="box_frm">
				    <input type="text" onfocus="NHYShowAlert(this,4)" class="txt_74" alt="alert_security" name="security_code" maxlength="5"/> <img class="code_ser" alt="" src="<?=site_url()?>securimage/securimage_show.php"/>				</div>
			    <div class="box_error_area"><p class="box_error" id="error_notice_security"/></div>
		    </li>
	    </ul>
	    <div class="bottom_btn">
		    <div class="btn_cover"><input type="submit" value="Đăng ký" class="tnpp_button_login" name="register" /></div>
			Khi bạn nhấn vào nút "Đăng ký", bạn đã đồng ý và chấp nhận các điều khoản <a class="blue_12_txt" href="<?=site_url()?>front/dieukhoan" target="_blank">Thỏa thuận sử dụng</a> của <a class="red_txt" href="<?=site_url()?>front/dieukhoan">Nhà như ý</a></div>
	    <div id="alert_box" class="alert_box" style="top: 108px; display: none;">
		    <p class="mar_top_10">Nếu username mà bạn chọn đã được sử dụng bởi thành viên khác, xin bạn vui lòng thử bằng cách thêm từ hoặc số sao cho username đó là duy nhất.</p>
        </div>
		  
	    <div id="alert_password" class="alert_box" style="display: none;">
			<p>Để password của bạn được bảo mật, bạn nên:</p>
		    <p>- Sử dụng cả chữ cái và chữ số.</p>
		    <p>- Sử dụng các ký tự đặc biệt (vd: #)</p>
		    <p>- Không nên đặt mật khẩu trùng với tên truy nhập, ngày sinh của bạn hoặc người thân.</p>
        </div>
	    <div id="alert_email" class="alert_box" style="display: none;">
	      <p><span class="red"></span></p>
		    <p class="mar_top_10">Nếu bạn không cung cấp một địa chỉ email chính xác, Nhà như ý có thể không xác minh được nhận dạng của bạn và sẽ không thể liên hệ với bạn hoặc giúp bạn nếu có vấn đề với tài khoản của bạn.</p>
        </div>
  
	    <div id="alert_security" class="alert_box" style="display: none;"><p>Bằng việc nhập mã xác nhận, bạn đã giúp chúng tôi tránh được hiện tượng spam dữ liệu.</p>

			<p class="mar_top_10">Mã xác nhận không sử dụng khoảng trắng.</p><span/><span/><span/></div>

	  </div>
</form>
      </div>
</div>