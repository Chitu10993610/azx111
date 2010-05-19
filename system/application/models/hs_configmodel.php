<?
class Hs_configModel extends Model {
/**
 * MODULE NAME   : hs_configmodel.php
 *
 * DESCRIPTION   : Hs_config model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-02-03 08:36 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             hs_config
 * @subpackage          Hs_config model component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $guide_name;
var $contact_phone;
var $contact_mail;
var $guide_image;
var $information;
var $service;
var $fax;
var $guide_center_address;
var $center_name;
var $street_address;
var $city;
var $state;
var $zip;
var $create_user;


   function Hs_configModel()
   {
      parent::Model();
      $this->obj =& get_instance();

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Load database libraries and other libraries and helpers. The
      // NOTE: ...generated code loads the database library as it requires it,
      // NOTE: ...but you may prefer to load here or autoload, In this case
      // NOTE: ...remember to delete all explicit load()s.
      // ///////////////////////////////////////////////////////////////////////

      // Initialise or clear class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      $this->_init_Hs_config();

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
//      return $this->find(array('id' => '$key_value'));
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
      $this->table_record_count = $this->db->count_all( 'config' );


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
      $sql = 'SELECT * FROM '.$this->db->dbprefix('config') . ' '. $where_clause . $limit_clause;

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

			$query_results['id']		 = $row['id'];
			$query_results['guide_name']		 = $row['guide_name'];
			$query_results['contact_phone']		 = $row['contact_phone'];
			$query_results['contact_mail']		 = $row['contact_mail'];
			$query_results['fax']		 = $row['fax'];
			$query_results['information']		 = $row['information'];
			$query_results['service']		 		= $row['service'];
			$query_results['guide_image']		 = $row['guide_image'];
			$query_results['guide_center_address']		 = $row['guide_center_address'];
			$query_results['center_name']		 = $row['center_name'];
			$query_results['street_address']		 = $row['street_address'];
			$query_results['city']		 = $row['city'];
			$query_results['state']		 = $row['state'];
			$query_results['zip']		 = $row['zip'];
			$query_results['create_user']		 = $row['create_user'];

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

      $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('config')." WHERE site_id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['id']		 			= $row['id'];
		$query_results['guide_name']		 = $row['guide_name'];
		$query_results['contact_phone']		 = $row['contact_phone'];
		$query_results['contact_mail']		 = $row['contact_mail'];
		$query_results['information']		 = $row['information'];
		$query_results['service']		 		= $row['service'];
		$query_results['fax']		 = $row['fax'];
		$query_results['guide_image']		 = $row['guide_image'];
		$query_results['guide_center_address']		 = $row['guide_center_address'];
		$query_results['center_name']		 = $row['center_name'];
		$query_results['street_address']		 = $row['street_address'];
		$query_results['city']		 = $row['city'];
		$query_results['state']		 = $row['state'];
		$query_results['zip']		 = $row['zip'];
		$query_results['create_user']		 = $row['create_user'];

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
      $sql = $this->db->insert_string('config', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {


      // Load the database library
      $this->load->database();

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('config', $data, $where);

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
      // $query = $this->db->query("DELETE FROM hs_config WHERE id = '$idField' ");

     return true;

   }

	function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_Guide_name() {
		return $this->guide_name;	}

	function set_Guide_name($guide_name) {
		$this->guide_name = $guide_name;	}

	function get_Contact_phone() {
		return $this->contact_phone;	}

	function set_Contact_phone($contact_phone) {
		$this->contact_phone = $contact_phone;	}

	function get_Contact_mail() {
		return $this->contact_mail;	}

	function set_Contact_mail($contact_mail) {
		$this->contact_mail = $contact_mail;	}

	function get_Guide_image() {
		return $this->guide_image;	}

	function set_Guide_image($guide_image) {
		$this->guide_image = $guide_image;	}

	function get_Guide_center_address() {
		return $this->guide_center_address;	}

	function set_Guide_center_address($guide_center_address) {
		$this->guide_center_address = $guide_center_address;	}

	function get_Center_name() {
		return $this->center_name;	}

	function set_Center_name($center_name) {
		$this->center_name = $center_name;	}

	function get_Street_address() {
		return $this->street_address;	}

	function set_Street_address($street_address) {
		$this->street_address = $street_address;	}

	function get_City() {
		return $this->city;	}

	function set_City($city) {
		$this->city = $city;	}

	function get_State() {
		return $this->state;	}

	function set_State($state) {
		$this->state = $state;	}

	function get_Zip() {
		return $this->zip;	}

	function set_Zip($zip) {
		$this->zip = $zip;	}

	function get_Create_user() {
		return $this->create_user;	}

	function set_Create_user($create_user) {
		$this->create_user = $create_user;	}


      function _init_Hs_config()
      {
		$this->id = "";
		$this->guide_name = "";
		$this->contact_phone = "";
		$this->contact_mail = "";
		$this->information = "";
		$this->service = "";
		$this->fax = "";
		$this->guide_image = "";
		$this->guide_center_address = "";
		$this->center_name = "";
		$this->street_address = "";
		$this->city = "";
		$this->state = "";
		$this->zip = "";
		$this->create_user = "";

      }

      // Initialize all your default variables here
      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You could add default values here, but fields are generally set empty
      function _emptyHs_config()
      {
		$this->id = "";
		$this->guide_name = "";
		$this->contact_phone = "";
		$this->contact_mail = "";
		$this->information = "";
		$this->service = "";
		$this->fax = "";
		$this->guide_image = "";
		$this->guide_center_address = "";
		$this->center_name = "";
		$this->street_address = "";
		$this->city = "";
		$this->state = "";
		$this->zip = "";
		$this->create_user = "";

      }

}

?>
