<?
class Ci_languagesModel extends Model {
/**
 * MODULE NAME   : ci_languagesmodel.php
 *
 * DESCRIPTION   : Ci_languages model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             languages
 * @subpackage          Ci_languages model component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $name;
var $image;
var $code;
var $create_user;
var $create_date;
var $status_flg;
var $ordering;

public $prefix;


   function Ci_languagesModel()
   {
      parent::Model();
      $this->obj =& get_instance();
      $this->prefix = $this->obj->db->dbprefix;

      // Initialise or clear class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      $this->_init_Ci_languages();

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
//      $this->table_record_count = $this->db->count_all( 'languages' );
		$query = $this->db->query('SELECT COUNT(*) as total_row FROM '.$this->prefix.'languages ' . $filters);
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
      $sql = 'SELECT * FROM '.$this->prefix.'languages ' . $where_clause . $limit_clause;
      $query = $this->db->query($sql);

      if ($query->num_rows() > 0) {
         foreach ($query->result_array() as $row)      // Go through the result set
         {
            // Build up a list for each column from the database and place it in
            // ...the result set

			$query_results['id']		 = $row['id'];
			$query_results['name']		 = $row['name'];
			$query_results['image']		 = $row['image'];
			$query_results['code']		 = $row['code'];
			$query_results['create_user']		 = $row['create_user'];
			$query_results['create_date']		 = $row['create_date'];
			$query_results['status_flg']		 = $row['status_flg'];
			$query_results['ordering']		 = $row['ordering'];

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

      $query = $this->db->query("SELECT * FROM ".$this->prefix."languages WHERE id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['id']		 = $row['id'];
		$query_results['name']		 = $row['name'];
		$query_results['image']		 = $row['image'];
		$query_results['code']		 = $row['code'];
		$query_results['create_user']		 = $row['create_user'];
		$query_results['create_date']		 = $row['create_date'];
		$query_results['status_flg']		 = $row['status_flg'];
		$query_results['ordering']		 = $row['ordering'];

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
      $sql = $this->db->insert_string('languages', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {


      // Load the database library
      $this->load->database();

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('languages', $data, $where);

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
      $query = $this->db->query("DELETE FROM ".$this->prefix."languages WHERE id = '$idField'");

     return true;

   }

	function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}
		
      function _init_Ci_languages()
      {
		$this->id = "";
		$this->name = "";
		$this->image = "";
		$this->code = "";
		$this->create_user = "";
		$this->create_date = "";
		$this->status_flg = "";
		$this->ordering = "";
      }

      // Initialize all your default variables here
      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You could add default values here, but fields are generally set empty
      function _emptyCi_languages()
      {
		$this->id = "";
		$this->name = "";
		$this->image = "";
		$this->code = "";
		$this->create_user = "";
		$this->create_date = "";
		$this->status_flg = "";
		$this->ordering = "";
      }
}

?>
