<?
class Ci_usersModel extends Model {
/**
 * MODULE NAME   : ci_usersmodel.php
 *
 * DESCRIPTION   : Ci_users model controller
 */

var $table_record_count;

var $userid;
var $username;
var $fullname;
var $email;
var $password;
var $lastlogin;
var $enabled;


   function Ci_usersModel()
   {
      parent::Model();
      $this->obj =& get_instance();

      // Initialise or clear class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      $this->_init_Ci_users();

   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: findAll()
   //
   // Description: Retrieves and returns data listing from the database
   //
   // //////////////////////////////////////////////////////////////////////////
   function findAll($start = NULL, $count = NULL) {
      return $this->find(NULL, $start, $count);
   }

//   function findById($key_value) {
//      return $this->find(array('userid' => '$key_value'));
//   }

   function findByFilter($filter_rules, $start = NULL, $count = NULL) {
      return $this->find($filter_rules, $start, $count);
   }

   function find($filters = NULL, $start = NULL, $count = NULL) {

      $results = array();

      // Load the database library
      $this->load->database();

      // ///////////////////////////////////////////////////////////////////////
      // Make a note of the current table record count
      // ///////////////////////////////////////////////////////////////////////
      $this->table_record_count = $this->db->count_all( 'users' );


      // Filter could be an array or filter values or an SQL string.
      $where_clause = '';
      if ($filters) {
         if ( is_string($filters) ) {
            $where_clause = $filters;
         }
         elseif ( is_array($filters) ) {
            // Build your filter rules
            if ( count($filters) > 0 ) {
               foreach ($filters as $field => $value) {
                  $filter_list[] = " $field = '$value' ";
               }
               $where_clause = ' WHERE ' . join(' AND ', $filter_list );
            }
         }

      }

      $limit_clause = '';
      if ($start) {
         if ($count) {
            $limit_clause = " LIMIT $start, $count ";
         }
         else {
            $limit_clause = " LIMIT $start ";
         }
      }

      // Build up the SQL query string and run the query
      $sql = 'SELECT * FROM ci_users ' . $where_clause . $limit_clause;

      $query = $this->db->query($sql);

      if ($query->num_rows() > 0) {
         // ////////////////////////////////////////////////////////////////////
         // NOTE: At this stage you could return the entire result set, like:
         // NOTE: ...return $query->result_array();
         // NOTE: ...The generated code loops through the result set to provide
         // NOTE: ...the oppurtunity to provide further customisations on the
         // NOTE: ...code (especially if you are generating in verbose mode).
         // ////////////////////////////////////////////////////////////////////

         foreach ($query->result_array() as $row)      // Go through the result set
         {
            // Build up a list for each column from the database and place it in
            // ...the result set

			$query_results['userid']		 = $row['userid'];
			$query_results['username']		 = $row['username'];
			$query_results['fullname']		 = $row['fullname'];
			$query_results['email']		 = $row['email'];
			$query_results['password']		 = $row['password'];
			$query_results['lastlogin']		 = $row['lastlogin'];
			$query_results['enabled']		 = $row['enabled'];

			$results[]		 = $query_results;


         }

      }

      return $results;

   }


   // TODO: this won't be possible if there is no primary key for the table.
   function retrieve_by_pkey($idField) {

      $results = array();

      // Load  the db library
      $this->load->database();

      $query = $this->db->query("SELECT * FROM ci_users WHERE userid = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['userid']		 = $row['userid'];
		$query_results['username']		 = $row['username'];
		$query_results['fullname']		 = $row['fullname'];
		$query_results['email']		 = $row['email'];
		$query_results['password']		 = $row['password'];
		$query_results['lastlogin']		 = $row['lastlogin'];
		$query_results['enabled']		 = $row['enabled'];

		$results		 = $query_results;


      }
      else {
         $results = false;
      }

      return $results;
   }


   function add( $data ) {

      // Load the database library
      $this->load->database();

      // Build up the SQL query string
      $sql = $this->db->insert_string('ci_users', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {


      // Load the database library
      $this->load->database();

      // Build up the SQL query string
      $where = "userid = $keyvalue";
      $sql = $this->db->update_string('ci_users', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField)
   {
      // Load  the db library
      $this->load->database();

      // ///////////////////////////////////////////////////////////////////////
      // TODO: Just to eliminate nasty mishaps, the delete query has been
      // TODO: ...deliberately disabled. Enable it if you mean to by uncommenting
      // TODO: ...the query function call below
      // ///////////////////////////////////////////////////////////////////////
      // $query = $this->db->query("DELETE FROM ci_users WHERE userid = '$idField' ");

     return true;

   }

	function get_Userid() {
		return $this->userid;	}

	function set_Userid($userid) {
		$this->userid = $userid;	}

	function get_Username() {
		return $this->username;	}

	function set_Username($username) {
		$this->username = $username;	}

	function get_Fullname() {
		return $this->fullname;	}

	function set_Fullname($fullname) {
		$this->fullname = $fullname;	}

	function get_Email() {
		return $this->email;	}

	function set_Email($email) {
		$this->email = $email;	}

	function get_Password() {
		return $this->password;	}

	function set_Password($password) {
		$this->password = $password;	}

	function get_Lastlogin() {
		return $this->lastlogin;	}

	function set_Lastlogin($lastlogin) {
		$this->lastlogin = $lastlogin;	}

	function get_Enabled() {
		return $this->enabled;	}

	function set_Enabled($enabled) {
		$this->enabled = $enabled;	}



      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You may want to add default values here.
      function _init_Ci_users()
      {
		$this->userid = "";
		$this->username = "";
		$this->fullname = "";
		$this->email = "";
		$this->password = "";
		$this->lastlogin = "";
		$this->enabled = "";

      }

      // Initialize all your default variables here
      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You could add default values here, but fields are generally set empty
      function _emptyCi_users()
      {
		$this->userid = "";
		$this->username = "";
		$this->fullname = "";
		$this->email = "";
		$this->password = "";
		$this->lastlogin = "";
		$this->enabled = "";

      }

}

?>
