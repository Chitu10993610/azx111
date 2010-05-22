<?
class Ci_adsModel extends Model {
/**
 * MODULE NAME   : ci_adsmodel.php
 *
 * DESCRIPTION   : Ci_ads model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             ci_ads
 * @subpackage          Ci_ads model component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $ads_title;
var $image;
var $description;
var $ads_url;
var $ads_width;
var $ads_height;
var $site_id;
var $create_user;
var $start_date;
var $end_date;
var $create_date;
var $status_flg;
var $ads_order;
var $position;


   function Ci_adsModel()
   {
      parent::Model();
      $this->obj =& get_instance();
      $this->_init_Ci_ads();

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
		$query = $this->db->query('SELECT COUNT(*) as total_row FROM '.$this->db->dbprefix('ads'). ' '.$filters);
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
      $sql = 'SELECT * FROM '.$this->db->dbprefix('ads'). ' '.$where_clause . ' ORDER BY ads_order '.$limit_clause;
//      echo $sql."<br />";
      $query = $this->db->query($sql);

      if ($query->num_rows() > 0) {
         foreach ($query->result_array() as $row)      // Go through the result set
         {
			$results[]		 = $row;
         }

      }

      return $results;

   }


   // TODO: this won't be possible if there is no primary key for the table.
   function retrieve_by_pkey($idField) {

      $results = array();

      // Load  the db library
      $this->load->database();

      $query = $this->db->query("SELECT * FROM ". $this->db->dbprefix('ads')." WHERE id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$results		 = $row;
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
      $sql = $this->db->insert_string('ads', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {


      // Load the database library
      $this->load->database();

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('ads', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField) {
      // Load  the db library
      $this->load->database();
      $query = $this->db->query("DELETE FROM ".$this->db->dbprefix('ads')." WHERE id = '$idField'");

     return true;

   }

	function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_Title() {
		return $this->ads_title;	}

	function set_Title($ads_title) {
		$this->ads_title = $ads_title;	}

	function get_Description() {
		return $this->description;	}

	function set_Description($description) {
		$this->description = $description;	}

	function get_Ads_url() {
		return $this->ads_url;	}

	function set_Ads_url($ads_url) {
		$this->ads_url = $ads_url;	}



      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You may want to add default values here.
      function _init_Ci_ads()
      {
		$this->id = "";
		$this->ads_title = "";
		$this->image = "";
		$this->description = "";
		$this->ads_url = "";
		$this->ads_height = "";
		$this->ads_width = "";
		$this->site_id = "";
		$this->create_user = "";
		$this->start_date = "";
		$this->end_date = "";
		$this->create_date = "";
		$this->status_flg = "";
		$this->ads_order = "";
		$this->position = "";

      }

      // Initialize all your default variables here
      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You could add default values here, but fields are generally set empty
      function _emptyCi_ads()
      {
		$this->id = "";
		$this->ads_title = "";
		$this->image = "";
		$this->description = "";
		$this->ads_url = "";
		$this->ads_height = "";
		$this->ads_width = "";
		$this->site_id = "";
		$this->create_user = "";
		$this->start_date = "";
		$this->end_date = "";
		$this->create_date = "";
		$this->status_flg = "";
		$this->ads_order = "";
		$this->position = "";
      }
}

?>
