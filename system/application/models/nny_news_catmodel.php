<?
class Nny_news_catModel extends Model {
/**
 * MODULE NAME   : nny_news_catmodel.php
 *
 * DESCRIPTION   : Nny_news_cat model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             nny_news_cat
 * @subpackage          Nny_news_cat model component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $news_title;
var $description;
var $news_url;


   function Nny_news_catModel()
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
      $this->_init_Nny_news_cat();

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
//      $this->table_record_count = $this->db->count_all( 'nny_news_cat' );
		$query = $this->db->query('SELECT COUNT(*) as total_row FROM nny_news_cat ' . $filters);
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
         if ($count) {
            $limit_clause = " LIMIT $start, $count ";
         }
         else {
            $limit_clause = " LIMIT $start ";
         }
      }

      // Build up the SQL query string and run the query
      $sql = 'SELECT * FROM nny_news_cat ' . $where_clause . $limit_clause;

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
			$query_results['news_title']		 = $row['news_title'];
			$query_results['description']		 = $row['description'];
			$query_results['news_url']		 = $row['news_url'];

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

      $query = $this->db->query("SELECT * FROM nny_news_cat WHERE id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['id']		 = $row['id'];
		$query_results['news_title']		 = $row['news_title'];
		$query_results['description']		 = $row['description'];
		$query_results['news_url']		 = $row['news_url'];

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
      $sql = $this->db->insert_string('nny_news_cat', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {


      // Load the database library
      $this->load->database();

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('nny_news_cat', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField, $site_id)
   {
      // Load  the db library
      $this->load->database();

      // ///////////////////////////////////////////////////////////////////////
      // TODO: Just to eliminate nasty mishaps, the delete query has been
      // TODO: ...deliberately disabled. Enable it if you mean to by uncommenting
      // TODO: ...the query function call below
      // ///////////////////////////////////////////////////////////////////////
      $query = $this->db->query("DELETE FROM nny_news_cat WHERE id = '$idField' AND site_id = $site_id");

     return true;

   }

	function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_Title() {
		return $this->news_title;	}

	function set_Title($news_title) {
		$this->news_title = $news_title;	}

	function get_Description() {
		return $this->description;	}

	function set_Description($description) {
		$this->description = $description;	}

	function get_News_url() {
		return $this->news_url;	}

	function set_News_url($news_url) {
		$this->news_url = $news_url;	}



      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You may want to add default values here.
      function _init_Nny_news_cat()
      {
		$this->id = "";
		$this->news_title = "";
		$this->description = "";
		$this->news_url = "";

      }

      // Initialize all your default variables here
      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You could add default values here, but fields are generally set empty
      function _emptyNny_news_cat()
      {
		$this->id = "";
		$this->news_title = "";
		$this->description = "";
		$this->news_url = "";

      }
      
      /**
	    * function getCategoryTree. get all product types
	    * @access public
	    * @param integer$parent_id
	    * @author Bui Thanh Dung
	   * @return $array
	 */
	function getCategoryTree(&$aryResult, $parent_id = 0, $level = 0, $ignore_cat = array()) {
		$lang_id = $this->session->userdata('lang_id');
		//$lang_id = 4;
		
		//$str_ignore_condition = " and c.cat_id <> '$ignore_cat'";
		$sql = "SELECT c.cat_id, cat_name, c.parent_id,  c.cat_order, c.cat_status FROM nny_news_cat c, nny_news_cat_des cd WHERE c.cat_id = cd.cat_id and parent_id = " .(int)$parent_id . " and lang_id = " . (int)$lang_id . " ORDER BY c.cat_order, cd.cat_name";
		//die($sql);
		$level++;
		$rs = $this->db->query($sql);
		foreach ($rs->result_array() as $ary) {
			if (!in_array($ary['cat_id'], $ignore_cat)) {
				
				//count cat has parent id order to ordering in cat manage
				//$totalCat = "totalCat".$ary['cat_id'];
				$totalCat = $this->getTotalCatByParentId($ary['parent_id']);
				
				array_push($aryResult, array('cat_id' => $ary['cat_id'],
								 'cat_name' => $ary['cat_name'],	
								 'parent_id' => $ary['parent_id'],
								 'level' => $level,
								 'cat_order' => $ary['cat_order'],
								 'cat_status' => $ary['cat_status'],
								 'totalCat' => $totalCat
								 )
				);
				
				$this->getCategoryTree($aryResult, $ary['cat_id'], $level, $ignore_cat);
			}	
		}
		$level--;
		//print_r($aryResult);							 									 
	}
	
	/**
	    * function getTotalCatByParentId. countl category has parent id is equal, count cat has parent id order to use to ordering
	    * @access public
	    * @param integer$parent_id
	    * @author Bui Thanh Dung
	   * @return $array
	 */
	function getTotalCatByParentId($parent_id = 0) {
		$lang_id = 0; 
		
		$sql = "SELECT COUNT(c.cat_id) AS totalCat FROM nny_news_cat c, nny_news_cat_des cd WHERE c.cat_id = cd.cat_id AND  parent_id = " .(int)$parent_id . " AND lang_id = " .(int)$lang_id;
		$rs = $this->db->query($sql);
		$aryCount = $rs->row_array();
		return $totalCat = $aryCount['totalCat'];					 									 
	}
	
	/**
	    * function createCat. create new product category 
	    * @access public
	    * @param array $aryCatInfo
	    * @author Bui Thanh Dung
	    * @return infectedNumber
	 */
	function createCat($aryCatInfo) {
		
		$sql = "INSERT INTO nny_news_cat(create_date, parent_id, cat_status) VALUES(NOW(), " . $aryCatInfo['parent_id'] . ", " .  $aryCatInfo['cat_status'] . ")";
		$this->db->query($sql);
		
		//get cat_id just inserted
		$insert_id = $this->db->insert_id();
		
		//insert cat_name theo tung language
//		foreach ($aryLanguageList as $aryLanguage) {
			$lang_id = 0;
			$cat_name = $aryCatInfo['cat_name'];
			$sql = "INSERT INTO nny_news_cat_des (cat_id, cat_name, lang_id) VALUES(" .$insert_id. ",'" .$cat_name. "'," .$lang_id. ")";
			$this->db->query($sql);	
//		}
		
		return $this->db->insert_id();
	}
	
	/**
	    * function editCat. create new product category 
	    * @access public
	    * @param array $aryCatInfo
	    * @param array $aryLanguageList
	    * @author Bui Thanh Dung
	    * @return infectedNumber
	 */
	function editCat($aryCatInfo) {
		$affectedRows = 0;
		$cat_id = $aryCatInfo['cat_id'];
		
		//get old info to compare with new info order to determin insert or update record
		$aryCatOldInfo = $this->getCatInfoBytId($cat_id);
		
		$sql = "UPDATE nny_news_cat SET last_modefied = NOW(), parent_id = " . $aryCatInfo['parent_id'] . 
				", cat_status = " .  $aryCatInfo['cat_status'] ."  WHERE cat_id =".$cat_id;
				
		$this->db->query($sql);
		$cat_name = $aryCatInfo['cat_name'];
		$sql = "UPDATE nny_news_cat_des SET cat_name = '" .$cat_name. "' WHERE cat_id = " .$cat_id. " AND lang_id = ".(int)$aryCatInfo['lang_id'];
			
		$this->db->query($sql);
		
		return true;
	}
	
	/**
	    * function getCatBytId.
	    * @access public
	    * @param integer $catId
	    * @author Bui Thanh Dung
	    * @return $array
	 */
	function getCatInfoBytId($catId){
		$aryCatInfo = array();
		if(!is_numeric($catId)) return $aryCatInfo;
		$sql = "SELECT c.cat_status, c.parent_id, cd.* FROM nny_news_cat c, nny_news_cat_des cd WHERE c.cat_id = cd.cat_id AND cd.cat_id = " . $catId;
		$rs = $this->db->query($sql);
		$aryCatInfo = $rs->row_array();
		//var_dump($aryCatInfo);
		return $aryCatInfo;				 									 
	}
	function getVuchivy($catId){
		$sql = "SELECT c.*, cd.* FROM nny_news_cat c, nny_news_cat_des cd WHERE c.cat_id = cd.cat_id AND cd.cat_id = " . $catId;
		//var_dump($aryCatInfo);
		$ary = array();
		$rs = $this->db->query($sql);
		$ary=$rs->row_array();
		return $ary;				 									 
	}
	
	/**
	    * function deleteCat.
	    * @access public
	    * @param integer $catId
	    * @author Bui Thanh Dung
	    * @return $array
	 */
	function deleteCat($catId) {

		//delete sub cat if exist
		$sql = "DELETE cd FROM nny_news_cat c, nny_news_cat_des cd WHERE cd.cat_id IN (SELECT cat_id FROM nny_news_cat WHERE parent_id = " . $catId . ")";
		$this->db->query($sql);
		
		//delete cat and subcat in news_type
		$sql = "DELETE c, cd FROM nny_news_cat c, nny_news_cat_des cd WHERE (c.cat_id = " . $catId . " OR parent_id =" . $catId . ") AND cd.cat_id =" . $catId ;
		$this->db->query($sql);	
		
		return true;				 									 
	}
	
		
	/**
	    * function sortCat.
	    * @access public
	    * @param array $aryCatOrder = Array ( [0] => 41 [1] => 42 [2] => 43 [3] => 45 [4] => 46 [5] => 47 [6] => 40 [7] => 44 [8] => 39 [9] => 35 [10] => 38 [11] => 36 ) 
	    * @param array $aryCatOrder = Array ( [0] => 3 [1] => 5 [2] => 4 [3] => 3 [4] => 3 [5] => 2 [6] => 3 [7] => 1 [8] => 2 [9] => 4 [10] => 2 [11] => 1 )
	    * @author Bui Thanh Dung
	    * @return infectedNumber
	 */
	function sortCat($aryCatOrder, $aryCatId) {

		$affectedRows = 0;
		foreach ($aryCatOrder as $key => $catOrder) {		
			$catOrder = $catOrder;
			$cat_id = $aryCatId[$key];
			
			$sql = "UPDATE nny_news_cat SET cat_order = " .  $catOrder ."  WHERE cat_id =".$cat_id;
			$affectedRows = $this->db->query($sql);
		}
		
		return $affectedRows;
	}
}

?>
