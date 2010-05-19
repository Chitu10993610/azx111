<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * base model
 *
 */
class Nny_Model extends Model {
	
	public $prefix;
	
	/**
	 * contruction function
	 * 
	 */
	public function Nny_Model() {
		parent::Model();
      	$this->obj =& get_instance();
		$this->prefix = $this->obj->db->dbprefix;
	}
	
   /**
	* Perform a paged database query.
	* @return arrary list
	*/
	function record_count($table, $filters = '') {

		$query = $this->db->query('SELECT COUNT(*) as total_row FROM ' . $table . $filters);
		$row = $query->row();
		return $row->total_row;
	}

	/**
	* Perform a paged database query.
	* @return arrary list
	*/
	function query_count($count_query) {

		// Construct a count query if none was given.
		$count_query = preg_replace(array('/SELECT.*?FROM /As', '/ORDER BY .*/'), array('SELECT COUNT(*) as total_row FROM ', ''), $count_query);

		$rs = $this->db->query($count_query);
		$row = $rs->row();
		return $row->total_row;
	}
	
		/**
	* Perform a paged database query.
	* @return arrary list
	*/
	function pager_query($query, &$total_row, $start = 0, $limit = 10, $count_query = NULL) {

		// Construct a count query if none was given.
		if (!isset($count_query)) {
			$count_query = preg_replace(array('/SELECT.*?FROM /As', '/ORDER BY .*/'), array('SELECT COUNT(*) FROM ', ''), $query);
		}

		// We calculate the total of pages as ceil(items / limit).
		$total_row = $this->getOne($count_query);

		return $this->query_range($query, $start, $limit);
	}

	/**
	 * thuc hien query theo limit
	 *
	 * @param  $query
	 * @return result
	 */
	function query_range($query, $from, $limit) {

		if((int)$limit) $query .= ' LIMIT '. (int)$from .', '. (int)$limit;
		$result  = $this->db->query($query);
		
		return $this->loadResult($result);
	}
	
	/**
	 * get array
	 *
	 * @param unknown_type $result
	 * @return unknown
	 */
	function getArray($sql) {
		
		$result = $this->db->query($sql);
		return $this->loadResult($result);
	}
	
	/**
	 * get array
	 *
	 * @param unknown_type $result
	 * @return unknown
	 */
	function loadResult($result) {
		$aryResult = array();
		foreach ($result->result_array() as $ary) {
			$aryResult[] = $ary;
		}
		
		return $aryResult;
	}
	
	
	
	/**
	 * get one value, row 0, col 0
	 *
	 * @param unknown_type $result
	 * @return unknown
	 */
	function getOne($sql) {
		$result = $this->db->query($sql);
		$row = $result->row_array();
		return array_pop($row);
	}
	
	//valid data
	function db_input($string) {
	  	/*if (get_magic_quotes_gpc() == 1) {
	  		return $string;
	  	}
	  	else {*/
	  		return addslashes($string);
//	  	}
	}
}