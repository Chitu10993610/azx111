<?
class Iht_area_Model extends Nny_Model {
/**
 * MODULE NAME   : iht_areamodel.php
 *
 * DESCRIPTION   : Iht_area model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2010-02-02 04:18 AM   - dungbt     - Created
 *
 * @package             iht_area
 * @subpackage          Iht_area model component Class
 * @author              dungbt
 * @copyright           Copyright (c) 2009-2010 Takesoft Software
 * @license             http://takesoft.net
 * @link                http://takesoft.net
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $area_name;
var $province_id;
var $district_id;
var $description;
var $is_dtm;
var $aid;
var $atitle;


   function Iht_area_Model() {
      parent::Model();
      $this->obj =& get_instance();
      $this->_init_Iht_area();

   }

   /**
    * Function: findAll()
    * Description: Retrieves and returns data listing from the database
    */
   function findAll($start = NULL, $count = NULL) {
      return $this->find(NULL, $start, $count);
   }

   /**
    * search by criterial
    *
    * @param string $filter_rules
    * @param integer $start
    * @param integer $count
    * @return array
    */
   function findByFilter($filter_rules, $start = NULL, $count = NULL) {
      return $this->find($filter_rules, $start, $count);
   }

   /**
    * do search by criterial
    * @param string $filters
    * @param integer $start
    * @param integer $count
    */
   function find($filters = NULL, $start = NULL, $count = NULL) {

      $results = array();

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

      // Build up the SQL query string and run the query
      $sql = 'SELECT * FROM iht_area ' . $where_clause . $limit_clause;

      $query = $this->db->query($sql);

      if ($query->num_rows() > 0) {
         
         foreach ($query->result_array() as $row)      // Go through the result set
         {
			$query_results['id']		 = $row['id'];
			$query_results['area_name']		 = $row['area_name'];
			$query_results['province_id']		 = $row['province_id'];
			$query_results['district_id']		 = $row['district_id'];
			$query_results['description']		 = $row['description'];
			$query_results['is_dtm']		 = $row['is_dtm'];

			$results[]		 = $query_results;
         }
      }
      
      //count
      if($count) $this->table_record_count = $this->query_count($sql);

      return $results;

   }
   /// vu chi vy 
    function findAll1($start = NULL, $count = NULL) {
      return $this->find1(NULL, $start, $count);
   }

//   function findById($key_value) {
//      return $this->find(array('id' => '$key_value'));
//   }


   function find1($filters = NULL, $start = NULL, $count = NULL) {

      $results = array();

      // Load the database library
      $this->load->database();

      // ///////////////////////////////////////////////////////////////////////
      // Make a note of the current table record count
      // ///////////////////////////////////////////////////////////////////////
      $this->table_record_count = $this->record_count('itjob_area');


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
      $sql = 'SELECT * FROM itjob_area  '. $where_clause . $limit_clause;

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

			$query_results['aid']		 = $row['aid'];
			$query_results['atitle']		 = $row['atitle'];

			$results[]		 = $query_results;


         }

      }

      return $results;

   }


   // TODO: this won't be possible if there is no primary key for the table.
   function retrieve_by_pkey($idField) {

      $results = array();

      $query = $this->db->query("SELECT * FROM iht_area WHERE id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['id']		 = $row['id'];
		$query_results['area_name']		 = $row['area_name'];
		$query_results['province_id']		 = $row['province_id'];
		$query_results['district_id']		 = $row['district_id'];
		$query_results['description']		 = $row['description'];
		$query_results['is_dtm']		 = $row['is_dtm'];

		$results		 = $query_results;


      }
      else {
         $results = false;
      }

      return $results;
   }


   function add( $data ) {

      // Build up the SQL query string
      $sql = $this->db->insert_string('iht_area', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('iht_area', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField, $user_id = '') {
      $query = $this->db->query("DELETE FROM iht_area WHERE id = '$idField' ");

     return true;

   }

			function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_Name() {
		return $this->area_name;	}

	function set_Name($area_name) {
		$this->area_name = $area_name;	}

	function get_Province_id() {
		return $this->province_id;	}

	function set_Province_id($province_id) {
		$this->province_id = $province_id;	}

	function get_District_id() {
		return $this->district_id;	}

	function set_District_id($district_id) {
		$this->district_id = $district_id;	}

	function get_Description() {
		return $this->description;	}

	function set_Description($description) {
		$this->description = $description;	}

	function get_Is_dtm() {
		return $this->is_dtm;	}

	function set_Is_dtm($is_dtm) {
		$this->is_dtm = $is_dtm;	}



      function _init_Iht_area()
      {
				$this->id = "";
		$this->area_name = "";
		$this->province_id = "";
		$this->district_id = "";
		$this->description = "";
		$this->is_dtm = "";

      }

      function _emptyIht_area()
      {
				$this->id = "";
		$this->area_name = "";
		$this->province_id = "";
		$this->district_id = "";
		$this->description = "";
		$this->is_dtm = "";

      }

}

?>
