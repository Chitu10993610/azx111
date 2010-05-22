<?php
/**
* ==========================================================
* Code Igniter User Authentication Class
*
* Original Back-end userauth code by Craig Rodway, 
* craig dot rodway at gmail dot com
*
* Front end, transition to models and code enhancement 
* Derek Allard, derek at darkhorse dot to
*
* PHP 4 backwards compatibility and some bug stomping, 
* View display adapted into mini-app template
* George Dunlop, peccavio at peccavi dot com
*
* September 1, 2006 added load language file
* to CI standard language implementation.
* Thomas Traub tomcode.com
*
* ==========================================================
*/
class Usergroups extends Controller {
	public $site_name = '';
	public $site_id = 0;
	
	function Usergroups()
	{
		parent::Controller();
		$this->lang->load('userauth', $this->session->userdata('ua_language'));
		$this->lang->load('validation', $this->session->userdata('ua_language'));
		$this->load->helper('html');
	}

	function index() {
		$this->user_group_model->can_access(LIST_USER);
		
		$groupId = (int)$this->uri->segment(4, $this->input->post('userid', TRUE));
		$ua_data['listAllUsers'] = $this->user_group_model->listAllInfo($groupId);
		if ($this->session->flashdata('msg')) {
			$ua_data['msg'] = $this->session->flashdata('msg');
		}
		if ($this->session->flashdata('groupmsg')) {
			$ua_data['groupmsg'] = $this->session->flashdata('groupmsg');
		}
		// this is just db cleanup.  Remove old "remember me" cookie references from the db
		// this model is not actually finished yet, so it currently does nothing
		$this->remember_me->removeOldRememberMe();
		
		// get data view to template
		$data['nav'] = 'users';		// menu steering
		$data['title'] = $this->lang->line('ua_manage_title');
		$data['content'] = $this->load->view('usergroups/userauth', $ua_data, TRUE);

		// Display in Template
		$this->_display($data);
	}
	
	function listGroup()
	{
		$this->user_group_model->can_access('Aministration');
		$ua_data['listAllGroups'] = $this->user_group_model->listUG('groups');
		if ($this->session->flashdata('msg')) {
			$ua_data['msg'] = $this->session->flashdata('msg');
		}
		if ($this->session->flashdata('groupmsg')) {
			$ua_data['groupmsg'] = $this->session->flashdata('groupmsg');
		}
		// this is just db cleanup.  Remove old "remember me" cookie references from the db
		// this model is not actually finished yet, so it currently does nothing
		$this->remember_me->removeOldRememberMe();
		
		// get data view to template
		$data['nav'] = 'users';		// menu steering
		$data['title'] = $this->lang->line('ua_manage_group');
		$data['content'] = $this->load->view('usergroups/group_manage', $ua_data, TRUE);

		// Display in Template
		$this->_display($data);
	}
	
	function listAp()
	{
		$this->user_group_model->can_access('Aministration');
		$ua_data['listAllAps'] = $this->user_group_model->listAp();
		if ($this->session->flashdata('msg')) {
			$ua_data['msg'] = $this->session->flashdata('msg');
		}
		if ($this->session->flashdata('groupmsg')) {
			$ua_data['groupmsg'] = $this->session->flashdata('groupmsg');
		}
		// this is just db cleanup.  Remove old "remember me" cookie references from the db
		// this model is not actually finished yet, so it currently does nothing
		$this->remember_me->removeOldRememberMe();
		
		// get data view to template
		$data['nav'] = 'users';		// menu steering
		$data['title'] = $this->lang->line('ua_manage_ap');
		$data['content'] = $this->load->view('usergroups/ap_manage', $ua_data, TRUE);

		// Display in Template
		$this->_display($data);
	}

	function addUser () {
		$this->user_group_model->can_access('Add new user');

		$this->load->library('user_lib');
	
		$submit = $this->input->post('Submit');      
     	
		if ( $submit != false ) {

			$this->_validate_user_form();
			$data = $this->_get_user_form_values();
			
			if($this->form_validation->run() == TRUE) {
				$data['create_date']		= time();

				$status = $this->user_group_model->addUser($data);

				if ($status == 1) {
					$this->session->set_flashdata('msg', $this->lang->line('ua_user_added'));
					redirect('admin/usergroups/index/'.$data['groupid'], 'location');
				} else {
					$ua_data['msg'] = $this->lang->line('ua_user_exists');
				}
			}
		}
		
		if(!$submit) $data = $this->user_lib->_clear_user_form();
		$data['listAllGroups'] = $this->user_group_model->listUG('groups');
		
		$data['action']       = 'admin/usergroups/addUser';
		$data['form_title'] = $data['title'] = $this->lang->line('ua_adduser');
		$data['extraHeadContent'] = '<link type="text/css" rel="stylesheet" href="' . base_url(). 
			'/css/userauth.css" />';
		$data['content'] = $this->load->view('usergroups/user_form', $data, TRUE);

		// Display in Template
		$this->_display($data);
	}

	/**
	 * edit user info
	 *
	 */
	function editUser () {
		$this->user_group_model->can_access(EDIT_USER);
		$this->load->library('user_lib');
		
		$userid = (int) $this->uri->segment(4, $this->input->post('userid', TRUE));
		$userid = $userid ? $userid : $this->session->userdata('userid');
		$submit = $this->input->post('Submit');      
     	
		if ( $submit != false ) {
			$this->_validate_user_form();
			$data = $this->_get_user_form_values();
			
			if($this->form_validation->run() == TRUE) {
				$status   = $this->user_group_model->editUser ($userid, $data);
				
				if ($status) {
					$this->session->set_flashdata('msg', $this->lang->line('ua_user_edited'));
					redirect('admin/usergroups/index/'.$data['groupid'], 'location');
				} else {
					$data['msg'] = $this->lang->line('ua_missing');
				}
			}
		}
		
		$data['userid'] = $userid;
		
		if(!$submit) $data = $this->user_group_model->listUserInfo($userid);
		$data['listAllGroups'] = $this->user_group_model->listUG('groups');
		$this->iht_common->build_cat($data);
		
		$data['action']       = 'admin/usergroups/editUser';
		$data['form_title'] = $data['title'] = $this->lang->line('ua_edituser');
		$data['extraHeadContent'] = '<link type="text/css" rel="stylesheet" href="' . base_url().'/css/userauth.css" />';
		$data['content'] = $this->load->view('usergroups/user_form', $data, TRUE);

		// Display in Template
		$this->_display($data);
	}
	
	/**
	 * edit user info
	 *
	 */
	function myInfo () {
//		$this->user_group_model->can_access('Edit user');

		$this->load->library('user_lib');
		$userid = $this->session->userdata('userid');
		if(!$userid) redirect('admin');;

		$submit = $this->input->post('Submit');   
     	
		if ( $submit != false ) {
			$this->_validate_user_form(true);
			$data = $this->_get_user_form_values(true);
			
			if($this->form_validation->run() == TRUE) {
				$status   = $this->user_group_model->editUser ($userid, $data);
				
				if ($status) {
					$this->session->set_flashdata('msg', "Chỉnh sửa thông tin thành công");
					redirect('my-info', 'location');	
				} else {
					$data['msg'] = $this->lang->line('ua_missing');
				}
			}
		}
		
		$data['userid'] = $userid;
		$data['username'] = $this->session->userdata('username');;
		
		if(!$submit) $data = $this->user_group_model->listUserInfo($userid);

		$data['listAllGroups'] = $this->user_group_model->listUG('groups');

		$data['myInfo'] = 1;
		$data['action']       = 'my-info';
		$data['form_title'] = $data['title'] = "Chỉnh sửa thông tin cá nhân";
		$data['extraHeadContent'] = '<link type="text/css" rel="stylesheet" href="' . base_url().'/css/userauth.css" />';
		
		if ($this->session->flashdata('msg')) {
			$data['msg'] = $this->session->flashdata('msg');
		}
		$data['content'] = $this->load->view('usergroups/user_form', $data, TRUE);

		// Display in Template
		$this->_display($data);
	}
	
	function removeUser ()
	{
		$this->user_group_model->can_access('Delete user');
		$userid = (int) $this->uri->segment(4);
		$username = $this->user_group_model->getUserName($userid);
		if ($this->user_group_model->removeUser($username)) {
			
			//remove phan user group
			$this->user_group_model->removeUserToGroupByUser($userid);
			
			$this->session->set_flashdata('msg', $this->lang->line('ua_user_removed'));
			redirect('admin/usergroups');
		} else {
			$this->session->set_flashdata('msg', $this->lang->line('ua_user_not_removed'));
			redirect('admin/usergroups');
		}
	}
	
	function addGroup ()
	{
		$this->user_group_model->can_access('Add new group');
		$this->load->library('validation');
//		$ua_data['listAllAps'] = $this->user_group_model->listAp();
//		$rules['ap'] = "required|numeric";
		$rules['groupname'] = "required|max_length[50]|xss_clean";
		$rules['groupdescription'] = "required|max_length[255]|xss_clean";
		$this->validation->set_rules($rules);
//		$fields['ap'] = $this->lang->line('ua_application');
		$fields['groupname'] = $this->lang->line('ua_groupname');
		$fields['groupdescription'] = $this->lang->line('ua_groupdescription');
		$this->validation->set_fields($fields);
		$this->validation->set_error_delimiters('<span class="error">', '</span>');

		if ($this->validation->run() == TRUE) {
//			$ap = $this->input->post('ap', TRUE);
			$groupname = $this->input->post('groupname', TRUE);
			$groupdescription = $this->input->post('groupdescription', TRUE);
	
			$status = $this->user_group_model->addGroup($ap, $groupname, $groupdescription);

			if ($status) {
				$this->session->set_flashdata('groupmsg', $this->lang->line('ua_group_added'));
				redirect('admin/usergroups/listGroup', 'location');	
			} else {
				$this->session->set_flashdata('groupmsg', $this->lang->line('ua_group_added_err'));
				redirect('admin/usergroups/listGroup', 'location');	
			}
		}
		$ua_data['mode'] = 'add';
		$ua_data['groupid'] = '';
		$ua_data['button'] = $this->lang->line('ua_addgroup');
		$data['nav'] = 'addgroup';
		
		$ua_data['form_title'] = $data['title'] = $this->lang->line('ua_addgroup');
		$data['content'] = $this->load->view('usergroups/group_form', $ua_data, TRUE);

		// Display in Template
		$this->_display($data);
	}

	function editGroup ()
	{
		$this->user_group_model->can_access('Edit group');
		$this->load->library('validation');
		$groupid = (int) $this->uri->segment(4, $this->input->post('groupid', TRUE));
//		$ua_data['listAllAps'] = $this->user_group_model->listAp();
		
		$ua_data['groupid'] = $groupid;
		$ua_data['groupinfo'] = $this->user_group_model->listGroupInfo($groupid);
//		$rules['ap'] = "required|numeric";
		$rules['groupname'] = "required|max_length[50]|xss_clean";
		$rules['groupdescription'] = "required|max_length[255]|xss_clean";
		$this->validation->set_rules($rules);
//		$fields['ap'] = $this->lang->line('ua_application');
		$fields['groupname'] = $this->lang->line('ua_groupname');
		$fields['groupdescription'] = $this->lang->line('ua_groupdescription');
		$this->validation->set_fields($fields);
		$this->validation->set_error_delimiters('<span class="error">', '</span>');
		
		if ($this->validation->run() == TRUE) {
			$ap = $this->input->post('ap', TRUE);
			$groupname = $this->input->post('groupname', TRUE);
			$groupdescription = $this->input->post('groupdescription', TRUE);
	
			$status = $this->user_group_model->editGroup($ap, $groupid, $groupname, $groupdescription);
			if ($status) {
				$this->session->set_flashdata('groupmsg', $this->lang->line('ua_group_edited'));
				redirect('admin/usergroups/listGroup', 'location');	
			} else {
				$this->session->set_flashdata('groupmsg', $this->lang->line('ua_group_edited_err'));
				redirect('admin/usergroups/listGroup', 'location');	
			}
		}
		$ua_data['mode'] = 'edit';
		$data['nav'] = 'editgroup';
		$ua_data['button'] = $this->lang->line('ua_editgroup');
		$ua_data['form_title'] = $data['title'] = $this->lang->line('ua_editgroup');

		$data['content'] = $this->load->view('usergroups/group_form', $ua_data, TRUE);

		// Display in Template
		$this->_display($data);
	}

	function removeGroup ()
	{
		$this->user_group_model->can_access('Delete group');
		$status = $this->user_group_model->removeGroup((int) $this->uri->segment(4));
		if ($status == 0) {
			$this->session->set_flashdata('groupmsg', $this->lang->line('ua_removal_err'));
			redirect('admin/usergroups/listGroup', 'location');
		} elseif ($status == 1) {
			$this->session->set_flashdata('groupmsg', $this->lang->line('ua_group_removed'));
			redirect('admin/usergroups/listGroup', 'location');
		} else {
			$this->session->set_flashdata('groupmsg', $this->lang->line('ua_removal_err_members'));
			redirect('admin/usergroups/listGroup', 'location');
		}
	}
	
	/**
	 * add application
	 *
	 */
	function addAp ()
	{
		$this->user_group_model->can_access('Add new application');
		$this->load->library('validation');
		$rules['apname'] = "required|max_length[255]|xss_clean";
		$rules['apdescription'] = "required|max_length[500]|xss_clean";
		$this->validation->set_rules($rules);
		$fields['apname'] = $this->lang->line('ua_apname');
		$fields['apdescription'] = $this->lang->line('ua_apdescription');
		$this->validation->set_fields($fields);
		$this->validation->set_error_delimiters('<span class="error">', '</span> <br />');
		
		if ($this->validation->run() == TRUE) {
			$apname = $this->input->post('apname', TRUE);
			$apdescription = $this->input->post('apdescription', TRUE);
	
				$status = $this->user_group_model->addAp($apname, $apdescription);
						
			if ($status) {
				$this->session->set_flashdata('apmsg', $this->lang->line('ua_ap_added'));
				redirect('admin/usergroups/listAp', 'location');	
			} else {

				$this->session->set_flashdata('apmsg', $this->lang->line('ua_ap_added_err'));
				redirect('admin/usergroups/listAp', 'location');	
			}
		}

		$ua_data['mode'] = 'add';
		$data['nav'] = 'addap';
		$ua_data['form_title'] = $data['title'] = $this->lang->line('ua_addap');	

		$data['content'] = $this->load->view('usergroups/ap_form', $ua_data, TRUE);

		// Display in Template
		$this->_display($data);
	}
	
	/**
	 * edit application
	 *
	 */
	function editAp()
	{
		$this->user_group_model->can_access('Edit application');
		$this->load->library('validation');
		$apid = $this->uri->segment(4, $this->input->post('apid', TRUE));
		$ua_data['apid'] = $apid;
		$ua_data['apinfo'] = $this->user_group_model->getApInfo($apid);
		$rules['apname'] = "required|max_length[255]|xss_clean";
		$rules['apdescription'] = "required|max_length[500]|xss_clean";
		$this->validation->set_rules($rules);
		$fields['apname'] = $this->lang->line('ua_apname');
		$fields['apdescription'] = $this->lang->line('ua_apdescription');
		$this->validation->set_fields($fields);
		$this->validation->set_error_delimiters('<span class="error">', '</span>');
		
		if ($this->validation->run() == TRUE) {
			$apname = $this->input->post('apname', TRUE);
			$apdescription = $this->input->post('apdescription', TRUE);
			$status = $this->user_group_model->editAp($apid, $apname, $apdescription);
	
			if ($status) {
				$this->session->set_flashdata('apmsg', $this->lang->line('ua_ap_edited'));
				redirect('admin/usergroups/listAp', 'location');	
			} else {
					$this->session->set_flashdata('apmsg', $this->lang->line('ua_ap_edited_err'));
				redirect('admin/usergroups/listAp', 'location');	
			}
		}
		
		$ua_data['mode'] = 'edit';
		$data['nav'] = 'editap';
		$ua_data['form_title'] = $data['title'] = $this->lang->line('ua_editap');	
		$data['content'] = $this->load->view('usergroups/ap_form', $ua_data, TRUE);

		// Display in Template
		$this->_display($data);
	}
	
	function removeAp()
	{
		$this->user_group_model->can_access('Delete application');
		$status = $this->user_group_model->removeAp((int) $this->uri->segment(4));
		if ($status == 0) {
			$this->session->set_flashdata('apmsg', $this->lang->line('ua_removal_err'));
			redirect('admin/usergroups/listAp', 'location');
		} elseif ($status == 1) {
			$this->session->set_flashdata('apmsg', $this->lang->line('ua_ap_removed'));
			redirect('admin/usergroups/listAp', 'location');
		} else {
			$this->session->set_flashdata('apmsg', $this->lang->line('ua_removal_err_groups'));
			redirect('admin/usergroups/listAp', 'location');
		}
	}	
	
	/**
	 * administer permissions.
	 */
	function perm()	{
		$this->user_group_model->can_access('Permision');
		$this->load->library('validation');
		$groupid = $this->uri->segment(4, $this->input->post('groupid', TRUE));
//		$appid = $this->input->post('appid', TRUE);
		
		if (isset($_POST['submited']) && $_POST['submited']) {
			
			$this->user_group_model->setPerm($_POST);
			$this->session->set_flashdata('apmsg', $this->lang->line('ua_perm_edited'));
		}
		
		$ua_data['form'] = $this->user_group_model->user_admin_perm($groupid);
		
		$ua_data['groupid_selected'] = $groupid;
		$ua_data['appid_selected'] = $appid;
		$data['nav'] = 'permap';
		$ua_data['form_title'] = $data['title'] = $this->lang->line('ua_perm_title');	

		$data['extraHeadContent'] = '<link type="text/css" rel="stylesheet" href="' . base_url(). 
			'/css/userauth.css" />';
		$data['content'] = $this->load->view('usergroups/perm_form', $ua_data, TRUE);

		// Display in Template
		$this->_display($data);
	}
	
	/**
	 * assign member to group.
	 */
	function assignGroups()	{
		$this->user_group_model->can_access(ASSIGN_GROUP);
		$this->load->library('validation');
//		print_r($_POST);
		$appId = $this->input->post('appid', TRUE);
		$groupid = $this->input->post('groupid', TRUE);
		
		//$ua_data['listAllAps'] = $this->user_group_model->listAp();
				
		//if($appId) {
			$ua_data['listAllGroups'] = $this->user_group_model->listUG('groups', 0);
			
		//}
		
		if ($this->input->post('addselect') && sizeof($this->input->post('addselect'))) {
			foreach($this->input->post('addselect') as $userid) {
				$this->user_group_model->insertUserToGroup($userid, $groupid);
			}
		}
		elseif ($this->input->post('removeselect') && sizeof($this->input->post('removeselect'))) {
			//print_r($this->input->post('removeselect'));
			foreach($this->input->post('removeselect') as $userid) {
				$this->user_group_model->removeUserToGroup($userid, $groupid);
			}
		}
		
		if($groupid) {
			//get user potential
			$ua_data['listAllUsers'] = $this->user_group_model->listUserNotInGroup($appId);
			
			//get user in group is selected
			$ua_data['listUsers'] = $this->user_group_model->usersInGroup($groupid);
		}
		
		//$ua_data['form'] = $this->user_group_model->user_admin_perm($groupid);
		
		$ua_data['form_title'] = $data['title'] = $this->lang->line('ua_assign_group_title');	
		$data['content'] = $this->load->view('usergroups/assign_group', $ua_data, TRUE);

		// Display in Template
		$this->_display($data);
	}
	
	//display chung
	function _display($data) {
		
		$data['site_name'] = $this->site_name;
		
		// Display in Template
		$this->load->view('template', $data);
	}
   
   /**
    * check password
    *
    * @param string $name
    */
	function password_check($name) {
		if(_empty_check) {
			return false;
		}
		else if(!$this->hs_site->checkName($name)) {
			$this->form_validation->set_message('password_check', "Site name is invalid (0-9_a-zA-Z-)");
			return false;
		}
		else if($this->ci_sitemodel->get_by_name($name)) {
			$this->form_validation->set_message('password_check', "Site already exists");
			return false;
		}
		
		return true;
	}
	
	
	function _validate_user_form($is_myinfo = false) {
   		$this->load->library('form_validation');
   		
   		//field validates
      	//trim|required|min_length[5]|max_length[12]|xss_clean
//      	$this->form_validation->set_rules('userid','Userid', 'xss_clean');
		if(!$is_myinfo) {
			$this->form_validation->set_rules('username','Username', 'required|xss_clean');
			$this->form_validation->set_rules('groupid','Group', 'required|xss_clean');
		}
		
		$this->form_validation->set_rules('fullname','Fullname', 'required|xss_clean');
		$this->form_validation->set_rules('email','Email', 'required|valid_email|xss_clean');
//		$this->form_validation->set_rules('password','Password name', 'callback_password_check');

		if(!$this->input->post('userid', TRUE)) {
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		}
		
		$this->form_validation->set_rules('lastlogin','Lastlogin', 'xss_clean');
		$this->form_validation->set_rules('phone','ĐT cố định', 'is_natural|xss_clean');
		$this->form_validation->set_rules('address','Địa chỉ', 'xss_clean');
		$this->form_validation->set_rules('mobile_phone','ĐTDĐ', 'is_natural|xss_clean');
		$this->form_validation->set_rules('create_date','Create_date', 'xss_clean');
		$this->form_validation->set_rules('birthday','Birthday', 'xss_clean');
		$this->form_validation->set_rules('information','Information', 'xss_clean');
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
   }
   
   //get form values   
	function _get_user_form_values($is_myinfo = false) {
		if(!$is_myinfo) {
			$data['groupid']		= $this->input->post('groupid', TRUE);
			$data['username']		= $this->input->post('username', TRUE);
			$aryView_rule		= $this->input->post('view_rule', TRUE);
			$data['view_rule'] = is_array($aryView_rule) ? implode(',', $aryView_rule) : '';
		}
		
		$data['fullname']		= $this->input->post('fullname', TRUE);
		$data['email']		= $this->input->post('email', TRUE);
		
		if(!$this->input->post('userid', TRUE)) {
			$data['password']		= $this->input->post('password', TRUE);
		}
		
		$data['phone']		= $this->input->post('phone', TRUE);
		$data['address']		= $this->input->post('address', TRUE);
		$data['mobile_phone']		= $this->input->post('mobile_phone', TRUE);
		$data['edit_date']		= time();
		$data['birthday']		= strtotime($this->input->post('birthday', TRUE));
		$data['information']		= $this->input->post('information', TRUE);

      return $data;
   }
}

?>