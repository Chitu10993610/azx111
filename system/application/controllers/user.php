<?php
/**
*
* User - Action controller
*
* Initially by Derek 
*
* Added flash data, & authenication error handler
*
* George Dunlop
*
* September 1, 2006 added load language file
* to CI standard language implementation.
* Thomas Traub tomcode.com
*/

class User extends Controller {

	function User()
	{
		parent::Controller();
		$this->lang->load('userauth', $this->session->userdata('ua_language'));
	}
	
	function index()
	{
		// should not be a link to here so return back
		//redirect ($this->session->flashdata('uri'));
		// change this to 
		// if login -> edit profile
		// if ! login -> login page
	}
	
	function login() {

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$remember_me = $this->input->post('remember_me');
		//$this->load->library('front_lib');
		$data['username'] = '';
		$data['password'] = '';

		// check if userauth db current or needs to be installed 
//		if ($this->userauth->valid_db()) { 
			// valid db, try login
			if($username && $password) {
				if($this->userauth->trylogin($username, $password, TRUE)) {
					if ($remember_me) { 
						$this->remember_me->addRememberMe($username); 
					}
					
					//$url = base64_decode($this->uri->segment(3));

					// return page is based on flash data
					header("Location: ".site_url('menu'));
//					exit;
					
				} else {
					$data['username'] = $username;
					$data['password'] = $password;
					$data['remember_me'] = $remember_me;
					$data['error'] = $this->lang->line('ua_log_error');
				}
			}else {
					//$data['error'] = $this->lang->line('ua_name_and_pswd');
			}
			
			$data['title'] = $data['h1_title'] = "�?ăng nhập";
			if(!isset($data['error'])) {
				$data['username'] = '';
				$data['password'] = '';
			}
			
			//build left area
//			$this->front_lib->_build_left_front($data);
			
			$this->load->view('usergroups/login', $data);
//			$data['content']  = $this->load->view('usergroups/login', $data, true);

			// Display in Template
			//$this->load->view('front_template', $data);
//		}
	}

	function logout()
	{
		$this->userauth->logout();

		// Two choices here, comment out one or the other
		//redirect ($this->session->flashdata('uri'));
		//$this->_display_logout_message();
		redirect('');
		// change this to ua_config option 
		// for redirect to /user with logout message
	}

	// private function to display a logout message
	function _display_logout_message() {
		$this->session->keep_flashdata('uri');
		$data['title'] = $data['h1_title'] = $this->lang->line('ua_logout_title');
		$data['content'] = '<p>'.$this->lang->line('ua_logout_txt').'</p>';

		// Display in Template
		$this->load->view('template', $data);
	}

	function auth_error()
	{
		$this->session->keep_flashdata('uri');

		$data['title'] = $data['h1_title'] = $this->lang->line('ua_auth_err_title');
		if($this->userauth->loggedin()) {
			$data['content'] = '<p>'.$this->lang->line('ua_auth_denied').'</p>';
		} else {
			redirect('user/login');
			//$data['content'] = '<p>'.$this->lang->line('ua_auth_not_logged').'</p>';
		}

		// Display in Template
		$this->load->view('template', $data);
	}

	// switch session's language and set a cookie
	function set_language() {
		$language = $this->uri->segment(3);
		if ( empty($language) ) { $language = $this->input->post('lang_select'); }
		if ( $language == 'detect' ) {
			// kill the cookie & session variable
			set_cookie('ua_language', '');
			$this->session->set_userdata('ua_language', '');
		} else {
			// switch session's language and set a cookie
			set_cookie('ua_language', $language, 
				$this->config->item('remember_me_life'));
			$this->session->set_userdata('ua_language', $language);
		}
		redirect ($this->session->flashdata('uri'));
	}
	
	//check username ajax
	function ucheck() {
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$code = $this->input->post('security_code');
		$fullname = $this->input->post('fullname');
		$exitUser = -1;
		$exitEmail = -1;
		$checkCode = -1;
		$error = 0;
		$msgSuccess = '';
		
		if($username) $exitUser = ($this->user_group_model->userExists($username)) ? 1 : 0;
		if($email) $exitEmail = ($this->user_group_model->emailExists($email)) ? 1 : 0;
		
		//check seccurity imgage
		include_once(dirname(BASEPATH).DIRECTORY_SEPARATOR.'securimage'.DIRECTORY_SEPARATOR.'securimage.php');
		$img = new securimage();
		if($code) $checkCode = ($img->check($code)) ? 0 : 1;
		if($exitUser || $exitEmail || $checkCode) $error = 1;
		$aryJson = array('username'=>$exitUser,'email'=>$exitEmail,'code'=>$checkCode);
		
		if(!$error) {
			//process create user
     	
			$data = $this->_get_user_form_values();
			$status = $this->user_group_model->addUser($data);
			
			if ($status == 1) {
				
				//login cho user
				$sessdata = array();
				$sessdata = $this->user_group_model->getUserInfo($username);
				$sessdata['loggedin'] = TRUE;
				
				// Set the session
				$this->session->set_userdata($sessdata);
				
				$msgSuccess = 'Quá trình đăng ký thành công, chào mừng bạn "'.$username.'"';
			}
		}
		
		exit(json_encode(array('error'=>$error, 'aryError'=>$aryJson, 'msg'=>$msgSuccess, 'url'=>site_url())));
	}
	
	//get form values   
	function _get_user_form_values($is_myinfo = false) {
		
		$data['username']		= $this->input->post('username', TRUE);
		$data['fullname']		= $this->input->post('fullname', TRUE);
		$data['groupid']		= 3;
		$data['email']			= $this->input->post('email', TRUE);
		$data['password']		= $this->input->post('password', TRUE);
		$data['phone']			= $this->input->post('phone', TRUE);
		$data['address']		= $this->input->post('address', TRUE);
		$data['create_date']	= time();
		$data['edit_date']		= time();
		$data['birthday']		= strtotime($this->input->post('birthday', TRUE));

      return $data;
   }
}

?>