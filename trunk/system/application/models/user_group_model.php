<?php

// This is the business model of users and groups

class User_group_model extends Model {

	function User_group_model()
	{
		parent::Model();
		$this->obj =& get_instance();
		$this->prefix = $this->obj->db->dbprefix;
	}

	// Test if latest schema, user_group
	function valid_db() 
	{
		return $this->db->table_exists('users');
	}

	/*
	|--------------------------------------------------------------------------
	|				functions of usergroup (joined) table
	|--------------------------------------------------------------------------
	*/
	
	// a function to join tables, intended private
	function _joinTables()
	{
		// needs no prefix !?!
		$prefix = '';
		$this->db->select('*');
		$this->db->from('usersgroups');
//		$this->db->use_table('usersgroups');
		$this->db->join('users', 'usersgroups.userid = users.userid');
		$this->db->join('groups', 'usersgroups.groupid = groups.groupid');
		
		$prefix = $this->obj->db->dbprefix;
		return $prefix;
	}

	// get everything listed in order
	function listAllInfo($groupid = 1, $order = 'username') {
		$strWhere = ($groupid) ? ' AND g.groupid = '.$groupid : '';
		$query = $this->db->query('SELECT u.*, g.*  FROM '.$this->prefix.'users u
								LEFT JOIN '.$this->prefix.'usersgroups ON('.$this->prefix.'usersgroups.userid = u.userid)
								LEFT JOIN '.$this->prefix.'groups g ON('.$this->prefix.'usersgroups.groupid = g.groupid)
								WHERE type = 0'.$strWhere);
		
		return $query;
	}
	
	// Get user and group info for $userid
	function listUserInfo($userid)
	{
		$query = $this->db->query('SELECT u.*, g.*  FROM '.$this->prefix.'users u
								LEFT JOIN '.$this->prefix.'usersgroups ON('.$this->prefix.'usersgroups.userid = u.userid)
								LEFT JOIN '.$this->prefix.'groups g ON('.$this->prefix.'usersgroups.groupid = g.groupid) WHERE u.userid =?', $userid);
		
		return $query->row_array();
	}

	/**
	* Get a list of the groups that the supplied username belongs to
	*
	* @param array $username Username to find the groups he belongs to
	* @return array Group names the specified user belongs to
	*/

	function groupsOfUser($username)
	{

		$prefix = $this->_joinTables();

		$this->db->select('groups.groupname');
		$this->db->where('users.username', $username);
		$query = $this->db->get();
		$result = $query->result();
		$groups = array();
		if($result){
			foreach($result as $row){
				$groups[] = $row->groupname;
			}
		}
		return $groups;
	}

	/**
	* Returns an array of users belonging to specified group
	*
	* @param array $groupname Name of group you want
	* @return array Users belonging to the group specified
	*/
	function usersInGroup($groupid)
	{

		$prefix = $this->_joinTables();

		//check select()
		//$this->db->select($this->obj->db->dbprefix.'users.username');
		$this->db->where('groups.groupid', $groupid);
	
		return $this->db->get();
	}
	
	
	/**
	* Returns an array of group belonging to specified app
	*
	* @param array $apname Name of ap you want
	* @return array Users belonging to the ap specified
	*/
	function groupInApByID($apid)
	{
		$this->db->select('apid');
		return $this->db->get_where('groups', array('apid' => $apid));
	}

	/*
	|--------------------------------------------------------------------------
	|				functions of usergroup table
	|--------------------------------------------------------------------------
	*/

	function usersInGroupByID($groupid){
//		$this->db->use_table('usersgroups');
//		$this->db->select('userid');
//		$this->db->where('groupid', $groupid);
		return $this->db->get_where('usersgroups', array('groupid' => $groupid));
//		return $this->db->get();
	}

	/**
	* Function to put a user in an exclusive group (no belonging to multiple groups)
	*/
	function putuseringroup($username, $groupname){

		$userid = $this->getUserId($username);
		$groupid = $this->getgroupid($groupname);

		// Remove user form all groups first
		$this->db->where('userid', $userid);
		$this->db->delete('usersgroups'); 

		// Add user to group
		$data = array( 'groupid' => $groupid, 'userid' => $userid );
		$this->db->insert('usersgroups', $data); 
	}

	// get this user's group memembership
	function groups_this_user() 
	{
		if ($this->userauth->loggedin()) {
			$thisuser = $this->session->userdata('username');
			return $this->groupsOfUser($thisuser);
		} else { return FALSE; }
	}

	/*
	|--------------------------------------------------------------------------
	|				functions envolving multiple tables
	|--------------------------------------------------------------------------
	*/

	/**
	* Add a user to the DB
	*
	* @param array $userarray Array containing the user attributes
	* @return int 0:Not added,1:User added,2:Already exists
	*/
	function addUser($data){
		if (!$this->userExists($data['username'])) {
			$data['password'] = sha1($data['password']);

			$groupId = $data['groupid'];
			unset($data['groupid']);
				
			// insert user
			// Build up the SQL query string
			$sql = $this->db->insert_string('users', $data);
			
			$query = $this->db->query($sql);
	
	//      $this->db->insert_id();
			$this->db->insert('usersgroups', array('userid'=>$this->db->insert_id(), 'groupid'=>$groupId));	// add to usergroups
			return 1; // User added
		} else {
			return 2; // User already exists
		}
	}

	function editUser ($userid, $data)
	{
			$groupId = $data['groupid'];
			unset($data['groupid']);
			
			// if the password was filled out, add it to the array.
			if ($data['password'] != '') {
				$data['password'] = sha1($data['password']);
			}
			
			$this->db->where('userid', $userid);
			$this->db->update('users', $data);  // users table
			
			$this->db->where('userid', $userid);
			return $this->db->update('usersgroups', 
						array('groupid'=>$groupId));	// add to usergroups
	}

	/**
	* Remove a user
	*
	* Note: function also removes the user from all groups they are a member of
	*
	* @param string $username Username of the user to remove
	* @return bool
	*/
	function removeUser($username){
		
		if($username == $this->session->userdata('username')) {
			// Exit if delete object is same as session user (same person)
			log_message('info', 'User change: User '.$username.' tried to delete themself.');
			show_error( $this->lang->line('ua_error_no_suicide') );
			exit();
		}
		if($this->userExists($username)) {
			// Delete group			
			$userid = $this->getUserId($username);
			
			//if user is admin
			if($userid == 1) return false;
			
			$this->db->where('userid', $userid);
			$this->db->delete('usersgroups'); 
			
			// Delete user
			$this->db->where('userid', $this->getUserId($username));
			$this->db->delete('users'); 
			
			// Delete rememberMe
			$this->obj->remember_me->removeRememberMe ($username);
			return TRUE;
		} else {
			// User didn't exist in the first place!
			return FALSE;
		}
	}

	/*
	|--------------------------------------------------------------------------
	|		utility function used for either user or group table
	|--------------------------------------------------------------------------
	*/

	/**
	* List all users or all groups depending on parameter
	*
	* @param string $option Can be one of:
	* 'users', 'groups'
	* @return array Array containing list of users/groups
	*/	
	function listUG($option, $parrent_id = 0){
		switch($option){
			case 'users':
//				$this->db->use_table('users');
				$this->db->select('userid, username, email, fullname, lastlogin, enabled');
				$query = $this->db->get('users');
//				$arr = $this->db->get();
				break;
			case 'groups':
				if($parrent_id) $this->db->where('apid', $parrent_id);
//				$this->db->use_table('groups');
				$this->db->select('groupid, groupname, description');
				$query = $this->db->get('groups');
//				$arr = $this->db->get();
				break;
		}
		
		return $query;
	}

	/*
	|--------------------------------------------------------------------------
	|				functions using only user table
	|--------------------------------------------------------------------------
	*/

	function testLogin($username, $password) {
		// test if valid user
		if ( $this->userExists($username) == TRUE ) {
			$ary_where = array('username' => $username, 'password' => $password);
//			$this->db->select('userid');
			$query = $this->db->get_where('users', $ary_where);
			if ($query->num_rows() > 0) {
				return $query->row();
			} else { return FALSE; }
		} else {return FALSE; }
	}

	function dateStampLogin($username) {
		$this->db->where('username', $username);
		$datestamp = date("Y-m-d H:i:s");
		$this->db->set('lastlogin', $datestamp); 
		$this->db->update('users');
		log_message('debug',"Last login by ".$username.": ".$datestamp);
	}

	/**
	* Checks to see if the supplied user exists in the DB
	*
	* @param string $username Username to look up
	* @return bool True if user exists
	*/
	function userExists($username){
		$this->db->select('userid');
		$query = $this->db->get_where('users', array('username' => $username));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}	
	
	/**
	* check email existed
	*
	* @param string email to look up
	* @return bool True if user exists
	*/
	function emailExists($email){
		$this->db->select('userid');
		$query = $this->db->get_where('users', array('email' => $email));
		return ($query->num_rows() == 1) ? TRUE : FALSE;
	}

	function getUserName($userid){
		$this->db->select('username');
		$query = $this->db->get_where('users', array('userid' => $userid));
		$query = $query->row();
		return $query->username;
	}

	function getUserId($username){
		$this->db->select('userid');
		$query = $this->db->get_where('users', array('username' => $username));
		$query = $query->row();
		return $query->userid;
	}

	/**
	* Check if account is enabled or not
	*
	* @param string $user Single username
	* @return bool User is enabled:true
	*/
	function enabled($username){
//		$this->db->use_table('users');
		$this->db->select('enabled');
//		$this->db->where('username', $username);
//		$query = $this->db->get();
		$query = $this->db->get_where('users', array('username' => $username));
		$row = $query->row();
		$ret = ($row->enabled == 1) ? TRUE : FALSE;
		return $ret;
	}
	
	/*
	|--------------------------------------------------------------------------
	|				functions using only group table
	|--------------------------------------------------------------------------
	*/

	function addGroup ($ap, $groupname, $groupdescription) {
		$this->db->set('groupname', $groupname); 
		$this->db->set('description', $groupdescription);
		$this->db->set('apid', $ap);
		return $this->db->insert('groups');
	}

	function editGroup ($ap, $groupid, $groupname, $groupdescription) {
		// group info
		$groupinfo = array(
					   'apid' => $ap,
					   'groupname' => $groupname,
					   'description' => $groupdescription
					);		
		$this->db->where('groupid', $groupid);
		$this->db->update('groups', $groupinfo);  // users table
		if ($this->db->affected_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * add application
	 *
	 * @param  $apname
	 * @param  $apdescription
	 */
	function addAp ($apname, $apdescription) {
		$this->db->set('apname', $apname); 
		$this->db->set('description', $apdescription);
		return $this->db->insert('applications');
	}
	
	/**
	 * edit/add application
	 *
	 * @param  $apid
	 * @param  $apname
	 * @param  $apdescription
	 */
	function editAp ($apid, $apname, $apdescription) {
		// ap info
		$apinfo = array(
					   'apname' => $apname,
					   'description' => $apdescription
					);		
		$this->db->where('apid', $apid);
		$this->db->update('applications', $apinfo);  // users table
		if ($this->db->affected_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	function removeGroup($groupid){
		$query = $this->usersInGroupByID($groupid);
		$numberOfGroupMembers = $query->num_rows();
		if ($numberOfGroupMembers == 0) {
			$this->db->where('groupid', $groupid);
			return $this->db->delete('groups'); // remove group info
		} else {
			return 2;
		}
	}

	function listGroupInfo($groupid) {
//		$this->db->use_table('groups');
//		$this->db->where ('groupid', $groupid);
//		$query = $this->db->get();
$query = $this->db->get_where('groups', array('groupid' => $groupid));
		return $query->row();
	}

	function getgroupid($groupname){
//		$this->db->use_table('groups');
//		$this->db->where ('groupname', $groupname);
//		$query = $this->db->get();
		$query = $this->db->get_where('groups', array('groupname' => $groupname));
		$row = $query->row();
		return $row->groupid;
	}
	
	function getgroupname($groupid){
//		$this->db->use_table('groups');
//		$this->db->where ('groupid', $groupid);
//		$query = $this->db->get();
		$query = $this->db->get_where('groups', array('groupid' => $groupid));
		$row = $query->row();
		return $row->groupname;
	}
	
	/**
	* List all application
	*
	* @return array Array containing list of application
	*/	
	function listAp(){
		
		//$this->db->select('userid, username, email, fullname, lastlogin, enabled');
		$query = $this->db->get('applications');
		return $query;
	}
	
	/**
	 * get app info
	 *
	 * @param unknown_type $apid
	 * @return unknown
	 */
	function getApInfo($apid) {
		$query = $this->db->get_where('applications', array('apid' => $apid));
		return $query->row();
	}
	
	function removeAp($apid){
		$query = $this->groupInApByID($apid);
		$numberOfGroupMembers = $query->num_rows();
		
		if ($numberOfGroupMembers == 0) {
			$this->db->where('apid', $apid);
			return $this->db->delete('applications'); // remove ap info
		} else {
			return 2;
		}
	}
	
	/**
	 * administer permissions.
	 */
	function user_admin_perm($groupid = NULL) {
		
		// Render group/permission overview:
		$options = array();
		$group_names = array();
		$permissions = $this->config->item('ua_perm');
		
		//get permission
		if (is_numeric($groupid)) {
			$result = $this->db->query('SELECT g.groupid, p.perm FROM '.$this->prefix.'groups g LEFT JOIN '.$this->prefix.'permission p ON g.groupid = p.groupid WHERE g.groupid = ? ', array($groupid));
		}
		else {
			$result = $this->db->query('SELECT g.groupid, p.perm FROM '.$this->prefix.'groups g LEFT JOIN '.$this->prefix.'permission p ON g.groupid = p.groupid ORDER BY groupname');
		}
		
		//get group
		foreach ($result->result() as $group) {
			$group_permissions[$group->groupid] = $group->perm .',';
		}
		
		$result = $this->db->query('SELECT groupid, groupname FROM '.$this->prefix.'groups ORDER BY groupname');
		
		
		if (is_numeric($groupid)) {
			foreach ($result->result() as $group) {
				if($groupid && $group->groupid == $groupid) {
					$group_names[$group->groupid] = $group->groupname;
				}
	
				$aryGroup[$group->groupid] = $group->groupname;
			}
			
			$form['aryGroup'] = $aryGroup;
		}
		else {
			foreach ($result->result() as $group) {
				$group_names[$group->groupid] = $group->groupname;
			}
			
			$form['aryGroup'] = $group_names;
		}
		
		
		$form['permissions'] = $permissions;
		
		asort($permissions);
		
		foreach ($permissions as  $appKey => $aryApp) {
			
			$appRowpan = 0;
			
			foreach ($aryApp as $aryPerm) {
				
				$appRowpan++;
				
				foreach ($aryPerm as $perm) {
					
					$appRowpan++;
					
					foreach ($group_names as $groupid => $name) {
						
						$form['checkboxes'][$groupid][$appKey][$perm] = '';
						
						// Builds arrays for checked boxes for each group
						if (strpos($group_permissions[$groupid], $perm .',') !== FALSE) {
							$form['checkboxes'][$groupid][$appKey][$perm] = $perm;
						}
						
						$form['group_names'][$groupid] = $name;
						
					} // end for group user
				} //end for permission
			} //end for group permission
			
			$form['rowpan'][$appKey] = $appRowpan + 1;
			
		} //end for application
			
		return $form;
	}
	
	/**
	 * set permission
	 *
	 */
	function setPerm($form_values) {
		
		// Save permissions:
		$result = $this->db->query('SELECT * FROM '.$this->prefix.'groups');
		foreach ($result->result() as $role) {
			if (isset($form_values[$role->groupid])) {
				// Delete, so if we clear every checkbox we reset that role;
				// otherwise permissions are active and denied everywhere.
				$this->db->query('DELETE FROM '.$this->prefix.'permission WHERE groupid = ?', array($role->groupid));
				$form_values[$role->groupid] = array_filter($form_values[$role->groupid]);
				
				if (count($form_values[$role->groupid])) {
					$this->db->query("INSERT INTO ".$this->prefix."permission (groupid, perm) VALUES (?, ?)", array($role->groupid, implode(', ', array_keys($form_values[$role->groupid]))));
				}
			}
		}
	}
	
	/**
	* Determine whether the user has a given privilege.
	*
	* @param $string: permission
	*/
	function can_access($string, $userid = NULL, $groupid = NULL) {
		static $perm = array();

		if(!$this->check_perm($string, $userid, $groupid)) { 
			redirect('user/auth_error'); 
		}
	}
	
	/**
	* Determine whether the user has a given privilege.
	*
	* @param $string: permission
	*/
	function check_perm($string, $userid = NULL, $groupid = NULL) {
		static $perm = array();
		$canAccess = FALSE;
		
		if (is_null($userid) && is_null($groupid)) {
//			$account = $user;
			$userid = $this->session->userdata('userid');
			$groupid = $this->session->userdata('groupid');
			
		}
		
		// admin has all privileges:
		if ($userid == 1) {
			return TRUE;
		}
		
		if(!$userid || !$groupid) return $canAccess;
		
		if (!isset($perm[$userid])) {
			
			$result = $this->db->query("SELECT DISTINCT(p.perm) FROM ".$this->prefix."groups g INNER JOIN ".$this->prefix."permission p ON p.groupid = g.groupid WHERE g.groupid = ?", $groupid);
			$perm[$userid] = '';
			
			$row = $result->row();
			$perm[$userid] .= "$row->perm, ";
		}
		
		if (isset($perm[$userid])) {
			return strpos($perm[$userid], "$string, ") !== FALSE;
		}
		
		return FALSE;
	}
	
	// Get user and group info for username
	function getUserInfo($username)	{
		
		$query = $this->db->query('SELECT u.*, g.*  FROM '.$this->prefix.'users u
										LEFT JOIN '.$this->prefix.'usersgroups ON('.$this->prefix.'usersgroups.userid = u.userid)
										LEFT JOIN '.$this->prefix.'groups g ON('.$this->prefix.'usersgroups.groupid = g.groupid)
										WHERE u.username = ?', $username);
		
		$rows = $query->result_array();
		return $rows[0];
	}
	
	/**
	* get list user not in group
	*
	* @param string $option Can be one of:
	* 'users', 'groups'
	* @return array Array containing list of users/groups
	*/	
	function listUserNotInGroup($appid){
		$result = '';
		if($appid) {
		
			$result = $this->db->query('SELECT DISTINCT(userid), username, fullname FROM '.$this->prefix.'users WHERE userid NOT IN
											(SELECT DISTINCT(u.userid) FROM `'.$this->prefix.'users` u
												INNER JOIN '.$this->prefix.'usersgroups ug ON (u.userid = ug.userid AND
												ug.groupid IN (SELECT groupid FROM '.$this->prefix.'groups WHERE apid = ?)))', $appid);
		}
		
		return $result;
	}
	
	/**
	* insert usergroups
	*/	
	function insertUserToGroup($userid, $groupid){
		// Add user to group
		$data = array( 'groupid' => $groupid, 'userid' => $userid );
		$this->db->insert('usersgroups', $data); 
	}
	
	/**
	* insert usergroups
	*/	
	function removeUserToGroup($userid, $groupid){
		// Remove user form all groups first
		$this->db->where(array('userid'=>$userid, 'groupid'=>$groupid));
		$this->db->delete('usersgroups'); 
	}
	
	/**
	* insert usergroups by userid
	*/	
	function removeUserToGroupByUser($userid){
		// Remove user form all groups first
		$this->db->where(array('userid'=>$userid));
		$this->db->delete('usersgroups'); 
	}
	
}

?>