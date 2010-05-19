<?
class Ci_websModel extends Model {
/**
 * MODULE NAME   : ci_websmodel.php
 *
 * DESCRIPTION   : Ci_webs model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             ci_webs
 * @subpackage          Ci_webs model component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $webs_title;
var $image;
var $description;
var $webs_url;
var $webs_width;
var $webs_height;
var $site_id;
var $create_user;
var $start_date;
var $end_date;
var $create_date;
var $status_flg;
var $order;
var $position;


   function Ci_websModel()
   {
      parent::Model();
      $this->obj =& get_instance();

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Load database libraries and other libraries and helpers. The
      // NOTE: ...generated code lowebs the database library as it requires it,
      // NOTE: ...but you may prefer to load here or autoload, In this case
      // NOTE: ...remember to delete all explicit load()s.
      // ///////////////////////////////////////////////////////////////////////

      // Initialise or clear class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      $this->_init_Ci_webs();

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
//      $this->table_record_count = $this->db->count_all( 'ci_webs' );
		$query = $this->db->query('SELECT COUNT(*) as total_row FROM '.$this->db->dbprefix('webs'). ' '.$filters);
		$row = $query->row();
		$this->table_record_count = $row->total_row;


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
     if ($count) {
        $limit_clause = " LIMIT $start, $count ";
     }
     elseif($start) {
        $limit_clause = " LIMIT $start ";
     }

      // Build up the SQL query string and run the query
      $sql = 'SELECT * FROM '.$this->db->dbprefix('webs'). ' '.$where_clause . $limit_clause;
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
			$query_results['webs_title']		 = $row['webs_title'];
			$query_results['image']		 = $row['image'];
			$query_results['description']		 = $row['description'];
			$query_results['webs_url']		 = $row['webs_url'];
			$query_results['webs_height']		 = $row['webs_height'];
			$query_results['webs_width']		 = $row['webs_width'];
			$query_results['site_id']		 = $row['site_id'];
			$query_results['create_user']		 = $row['create_user'];
			$query_results['start_date']		 = $row['start_date'];
			$query_results['end_date']		 = $row['end_date'];
			$query_results['create_date']		 = $row['create_date'];
			$query_results['status_flg']		 = $row['status_flg'];
			$query_results['order']		 = $row['order'];
			$query_results['position']		 = $row['position'];

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

      $query = $this->db->query("SELECT * FROM ". $this->db->dbprefix('webs')." WHERE id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['id']		 = $row['id'];
		$query_results['webs_title']		 = $row['webs_title'];
		$query_results['image']		 = $row['image'];
		$query_results['description']		 = $row['description'];
		$query_results['webs_url']		 = $row['webs_url'];
		$query_results['webs_width']		 = $row['webs_width'];
		$query_results['webs_height']		 = $row['webs_height'];
		$query_results['site_id']		 = $row['site_id'];
		$query_results['create_user']		 = $row['create_user'];
		$query_results['start_date']		 = $row['start_date'];
		$query_results['end_date']		 = $row['end_date'];
		$query_results['create_date']		 = $row['create_date'];
		$query_results['status_flg']		 = $row['status_flg'];
		$query_results['order']		 = $row['order'];
		$query_results['position']		 = $row['position'];

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
      $sql = $this->db->insert_string('webs', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {


      // Load the database library
      $this->load->database();

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('webs', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField) {
      // Load  the db library
      $this->load->database();
      $query = $this->db->query("DELETE FROM ".$this->db->dbprefix('webs')." WHERE id = '$idField'");

     return true;

   }

	function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_Title() {
		return $this->webs_title;	}

	function set_Title($webs_title) {
		$this->webs_title = $webs_title;	}

	function get_Description() {
		return $this->description;	}

	function set_Description($description) {
		$this->description = $description;	}

	function get_Webs_url() {
		return $this->webs_url;	}

	function set_Webs_url($webs_url) {
		$this->webs_url = $webs_url;	}



      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You may want to add default values here.
      function _init_Ci_webs()
      {
		$this->id = "";
		$this->webs_title = "";
		$this->image = "";
		$this->description = "";
		$this->webs_url = "";
		$this->webs_height = "";
		$this->webs_width = "";
		$this->site_id = "";
		$this->create_user = "";
		$this->start_date = "";
		$this->end_date = "";
		$this->create_date = "";
		$this->status_flg = "";
		$this->order = "";
		$this->position = "";

      }

      // Initialize all your default variables here
      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You could add default values here, but fields are generally set empty
      function _emptyCi_webs()
      {
		$this->id = "";
		$this->webs_title = "";
		$this->image = "";
		$this->description = "";
		$this->webs_url = "";
		$this->webs_height = "";
		$this->webs_width = "";
		$this->site_id = "";
		$this->create_user = "";
		$this->start_date = "";
		$this->end_date = "";
		$this->create_date = "";
		$this->status_flg = "";
		$this->order = "";
		$this->position = "";

      }

}

?>
