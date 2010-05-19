<?
class Iht_district_Model extends Nny_Model {
/**
 * MODULE NAME   : iht_districtmodel.php
 *
 * DESCRIPTION   : Iht_district model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2010-02-02 04:11 AM   - dungbt     - Created
 *
 * @package             iht_district
 * @subpackage          Iht_district model component Class
 * @author              dungbt
 * @copyright           Copyright (c) 2009-2010 Takesoft Software
 * @license             http://takesoft.net
 * @link                http://takesoft.net
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $district_name;
var $province_id;


   function Iht_district_Model() {
      parent::Model();
      $this->obj =& get_instance();
      $this->_init_Iht_district();

   }

   /**
    * Function: findAll()
    * Description: Retrieves and returns data listing from the database
    */
   function findAll($start = NULL, $count = NULL, $order = '') {
      return $this->find(NULL, $start, $count, $order);
   }

   /**
    * search by criterial
    *
    * @param string $filter_rules
    * @param integer $start
    * @param integer $count
    * @return array
    */
   function findByFilter($filter_rules, $start = NULL, $count = NULL, $order = '') {
      return $this->find($filter_rules, $start, $count, $order);
   }

   /**
    * do search by criterial
    * @param string $filters
    * @param integer $start
    * @param integer $count
    */
   function find($filters = NULL, $start = NULL, $count = NULL, $order = '') {

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
      $sql = 'SELECT d.*, p.atitle as province_name FROM '
      				.$this->db->dbprefix('district') . ' d INNER JOIN itjob_area p ON p.aid = d.province_id '. 
      				$where_clause .$order. $limit_clause;

      $query = $this->db->query($sql);

      if ($query->num_rows() > 0) {
         
         foreach ($query->result_array() as $row) {
			$results[]		 = $row;
         }
      }
      
      if($count) $this->table_record_count = $this->query_count($sql);

      return $results;
   }


   // TODO: this won't be possible if there is no primary key for the table.
   function retrieve_by_pkey($idField) {

      $results = array();

      $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('district')." WHERE id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['id']		 = $row['id'];
		$query_results[' district_name']		 = $row[' district_name'];
		$query_results['province_id']		 = $row['province_id'];

		$results		 = $query_results;


      }
      else {
         $results = false;
      }

      return $results;
   }


   function add( $data ) {

      // Build up the SQL query string
      $sql = $this->db->insert_string('district', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('district', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField, $user_id = '') {
      $query = $this->db->query("DELETE FROM ".$this->db->dbprefix('district')." WHERE id = '$idField' ");

     return true;

   }

			function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_Name() {
		return $this->district_name;	}

	function set_Name($district_name) {
		$this->district_name = $district_name;	}

	function get_Province_id() {
		return $this->province_id;	}

	function set_Province_id($province_id) {
		$this->province_id = $province_id;	}



      function _init_Iht_district()
      {
				$this->id = "";
		$this-> district_name = "";
		$this->province_id = "";

      }

      function _emptyIht_district()
      {
				$this->id = "";
		$this-> district_name = "";
		$this->province_id = "";

      }

}

?>
