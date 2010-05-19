<?
class Stock_trade_Model extends Nny_Model {
/**
 * MODULE NAME   : stock_trademodel.php
 *
 * DESCRIPTION   : Stock_trade model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-07-01 10:07 AM   - dungbt     - Created
 *
 * @package             stock_trade
 * @subpackage          Stock_trade model component Class
 * @author              dungbt
 * @copyright           Copyright (c) 2008-2009 Takesoft Software
 * @license             http://takesoft.net
 * @link                http://takesoft.net
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $stock_sym;
var $create_date;
var $amount;
var $price;
var $fee;
var $current_date;
var $current_price;
var $peak_date;
var $peak_price;
var $cat_id;
var $alert;
var $status_change;


   function Stock_trade_Model() {
      parent::Model();
      $this->obj =& get_instance();
      $this->_init_Stock_trade();

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

      $this->table_record_count = $this->record_count('stock_trade', $filters);

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
      $sql = 'SELECT * FROM stock_trade ' . $where_clause . $limit_clause;

      $query = $this->db->query($sql);

      if ($query->num_rows() > 0) {
         
         foreach ($query->result_array() as $row)      // Go through the result set
         {
						$query_results['id']		 = $row['id'];
			$query_results['stock_sym']		 = $row['stock_sym'];
			$query_results['create_date']		 = $row['create_date'];
			$query_results['amount']		 = $row['amount'];
			$query_results['price']		 = $row['price'];
			$query_results['fee']		 = $row['fee'];
			$query_results['current_date']		 = $row['current_date'];
			$query_results['current_price']		 = $row['current_price'];
			$query_results['peak_date']		 = $row['peak_date'];
			$query_results['peak_price']		 = $row['peak_price'];
			$query_results['cat_id']		 = $row['cat_id'];
			$query_results['alert']		 = 	$row['alert'];
			$query_results['status_change']		 = $row['status_change'];

			$results[]		 = $query_results;

         }

      }

      return $results;

   }


   // TODO: this won't be possible if there is no primary key for the table.
   function retrieve_by_pkey($idField) {

      $results = array();

      $query = $this->db->query("SELECT * FROM stock_trade WHERE id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['id']		 = $row['id'];
		$query_results['stock_sym']		 = $row['stock_sym'];
		$query_results['create_date']		 = $row['create_date'];
		$query_results['amount']		 = $row['amount'];
		$query_results['price']		 = $row['price'];
		$query_results['fee']		 = $row['fee'];
		$query_results['current_date']		 = $row['current_date'];
		$query_results['current_price']		 = $row['current_price'];
		$query_results['peak_date']		 = $row['peak_date'];
		$query_results['peak_price']		 = $row['peak_price'];
		$query_results['cat_id']		 = $row['cat_id'];
		$query_results['alert']		 = $row['alert'];
		$query_results['status_change']		 = $row['status_change'];

		$results		 = $query_results;


      }
      else {
         $results = false;
      }

      return $results;
   }


   function add( $data ) {

      // Build up the SQL query string
      $sql = $this->db->insert_string('stock_trade', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('stock_trade', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField, $user_id = '') {
      $query = $this->db->query("DELETE FROM stock_trade WHERE id = '$idField' ");

     return true;

   }

			function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_Stock_sym() {
		return $this->stock_sym;	}

	function set_Stock_sym($stock_sym) {
		$this->stock_sym = $stock_sym;	}

	function get_Create_date() {
		return $this->create_date;	}

	function set_Create_date($create_date) {
		$this->create_date = $create_date;	}

	function get_Amount() {
		return $this->amount;	}

	function set_Amount($amount) {
		$this->amount = $amount;	}

	function get_Price() {
		return $this->price;	}

	function set_Price($price) {
		$this->price = $price;	}

	function get_Fee() {
		return $this->fee;	}

	function set_Fee($fee) {
		$this->fee = $fee;	}

	function get_Current_date() {
		return $this->current_date;	}

	function set_Current_date($current_date) {
		$this->current_date = $current_date;	}

	function get_Current_price() {
		return $this->current_price;	}

	function set_Current_price($current_price) {
		$this->current_price = $current_price;	}

	function get_Peak_date() {
		return $this->peak_date;	}

	function set_Peak_date($peak_date) {
		$this->peak_date = $peak_date;	}

	function get_Peak_price() {
		return $this->peak_price;	}

	function set_Peak_price($peak_price) {
		$this->peak_price = $peak_price;	}

	function get_Cat_id() {
		return $this->cat_id;	}

	function set_Cat_id($cat_id) {
		$this->cat_id = $cat_id;	}

	function get_Status_change() {
		return $this->status_change;	}

	function set_Status_change($status_change) {
		$this->status_change = $status_change;	}



      function _init_Stock_trade()
      {
				$this->id = "";
		$this->stock_sym = "";
		$this->create_date = "";
		$this->amount = "";
		$this->price = "";
		$this->fee = "";
		$this->current_date = "";
		$this->current_price = "";
		$this->peak_date = "";
		$this->peak_price = "";
		$this->cat_id = "";
		$this->alert = "";
		$this->status_change = "";

      }

      function _emptyStock_trade()
      {
				$this->id = "";
		$this->stock_sym = "";
		$this->create_date = "";
		$this->amount = "";
		$this->price = "";
		$this->fee = "";
		$this->current_date = "";
		$this->current_price = "";
		$this->peak_date = "";
		$this->peak_price = "";
		$this->cat_id = "";
		$this->alert = "";
		$this->status_change = "";

      }

}

?>
