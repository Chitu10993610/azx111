<?
class Category_Model extends Nny_Model {
/**
 * MODULE NAME   : categorymodel.php
 *
 * DESCRIPTION   : Category model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-06-30 11:18 PM   - dungbt     - Created
 *
 * @package             category
 * @subpackage          Category model component Class
 * @author              dungbt
 * @copyright           Copyright (c) 2008-2009 Takesoft Software
 * @license             http://takesoft.net
 * @link                http://takesoft.net
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $cat_id;
var $cat_name;


   function Category_Model() {
      parent::Model();
      $this->obj =& get_instance();
      $this->_init_Category();

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

      $this->table_record_count = $this->record_count('category', $filters);

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
      $sql = 'SELECT * FROM category ' . $where_clause . $limit_clause;

      $query = $this->db->query($sql);

      if ($query->num_rows() > 0) {
         
         foreach ($query->result_array() as $row)      // Go through the result set
         {
						$query_results['cat_id']		 = $row['cat_id'];
			$query_results['cat_name']		 = $row['cat_name'];

			$results[]		 = $query_results;

         }

      }

      return $results;

   }


   // TODO: this won't be possible if there is no primary key for the table.
   function retrieve_by_pkey($idField) {

      $results = array();

      $query = $this->db->query("SELECT * FROM category WHERE cat_id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['cat_id']		 = $row['cat_id'];
		$query_results['cat_name']		 = $row['cat_name'];

		$results		 = $query_results;


      }
      else {
         $results = false;
      }

      return $results;
   }


   function add( $data ) {

      // Build up the SQL query string
      $sql = $this->db->insert_string('category', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {

      // Build up the SQL query string
      $where = "cat_id = $keyvalue";
      $sql = $this->db->update_string('category', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField, $user_id = '') {
      $query = $this->db->query("DELETE FROM category WHERE cat_id = '$idField' ");

     return true;

   }

			function get_Cat_id() {
		return $this->cat_id;	}

	function set_Cat_id($cat_id) {
		$this->cat_id = $cat_id;	}

	function get_Cat_name() {
		return $this->cat_name;	}

	function set_Cat_name($cat_name) {
		$this->cat_name = $cat_name;	}



      function _init_Category()
      {
				$this->cat_id = "";
		$this->cat_name = "";

      }

      function _emptyCategory()
      {
				$this->cat_id = "";
		$this->cat_name = "";

      }

}

?>
