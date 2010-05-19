<?
class Menu_Model extends Nny_Model {
/**
 * MODULE NAME   : menumodel.php
 *
 * DESCRIPTION   : Nny_menu model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             menu
 * @subpackage          Nny_menu model component Class
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
public $prefix;


   function Menu_Model()
   {
      parent::Model();
      $this->obj =& get_instance();
      $this->prefix = $this->obj->db->dbprefix;

      // Initialise or clear class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      $this->_init_Nny_menu();

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
//      $this->table_record_count = $this->db->count_all( 'menu' );
		$query = $this->db->query('SELECT COUNT(*) as total_row FROM '.$this->prefix.'menu ' . $filters);
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
      $sql = 'SELECT * FROM '
      .$this->prefix.'menu m LEFT JOIN ' 
      .$this->prefix.'menu_des md ON(m.id = md.id) ' 
      .$where_clause .' order by ordering ' .$limit_clause;

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

      $query = $this->db->query("SELECT * FROM ".$this->prefix."menu WHERE id = '$idField' LIMIT 1");

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
      $sql = $this->db->insert_string('menu', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {


      // Load the database library
      $this->load->database();

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('menu', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField, $site_id)
   {
      // Load  the db library
      $this->load->database();
      $query = $this->db->query("DELETE FROM ".$this->prefix."menu WHERE id = '$idField' AND site_id = $site_id");

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
      function _init_Nny_menu()
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
      function _emptyNny_menu()
      {
		$this->id = "";
		$this->news_title = "";
		$this->description = "";
		$this->news_url = "";

      }
      
      /**
	    * function getMenuegoryTree. get all product types
	    * @access public
	    * @param integer$parent_id
	    * @author Bui Thanh Dung
	   * @return $array
	 */
	function getMenuegoryTree(&$aryResult, $parent_id = 0, $level = 0, $ignore_menu = array()) {
//		$lang_id = $this->session->userdata('lang_id');
		$lang_id = 'vi';
		
		//$str_ignore_condition = " and c.id <> '$ignore_menu'";
		$sql = "SELECT c.id, name, c.parent_id,  c.ordering, c.status, c.url FROM ".$this->prefix."menu c, ".$this->prefix."menu_des cd WHERE c.id = cd.id AND parent_id = " .(int)$parent_id . " AND lang_id = '$lang_id' ORDER BY c.ordering, cd.name";
		//die($sql);
		$level++;
		$rs = $this->db->query($sql);
		foreach ($rs->result_array() as $ary) {
			if (!in_array($ary['id'], $ignore_menu)) {
				
				//count menu has parent id order to ordering in menu manage
				//$totalMenu = "totalMenu".$ary['id'];
				$totalMenu = $this->getTotalMenuByParentId($ary['parent_id']);
				
				array_push($aryResult, array('id' => $ary['id'],
								 'name' => $ary['name'],	
								 'parent_id' => $ary['parent_id'],
								 'level' => $level,
								 'ordering' => $ary['ordering'],
								 'status' => $ary['status'],
								 'url' => $ary['url'],
								 'totalMenu' => $totalMenu
								 )
				);
				
				$this->getMenuegoryTree($aryResult, $ary['id'], $level, $ignore_menu);
			}	
		}
		$level--;
		//print_r($aryResult);							 									 
	}
	
	/**
	    * function getTotalMenuByParentId. countl menuegory has parent id is equal, count menu has parent id order to use to ordering
	    * @access public
	    * @param integer$parent_id
	    * @author Bui Thanh Dung
	   * @return $array
	 */
	function getTotalMenuByParentId($parent_id = 0) {
		$lang_id = 'vi'; 
		
		$sql = "SELECT COUNT(c.id) AS totalMenu FROM ".$this->prefix."menu c, ".$this->prefix."menu_des cd WHERE c.id = cd.id AND  parent_id = " .(int)$parent_id . " AND cd.lang_id = '$lang_id'";
		$rs = $this->db->query($sql);
		$aryCount = $rs->row_array();
		return $totalMenu = $aryCount['totalMenu'];					 									 
	}
	
	/**
	    * function createMenu. create new product menuegory 
	    * @access public
	    * @param array $aryMenuInfo
	    * @author Bui Thanh Dung
	    * @return infectedNumber
	 */
	function createMenu($aryMenuInfo) {
		
		$sql = "INSERT INTO ".$this->prefix."menu(create_date, parent_id, status, url) VALUES(NOW(), " . $aryMenuInfo['parent_id'] . ", " .  $aryMenuInfo['status'] . ", '" .  $aryMenuInfo['url'] . "')";
		$this->db->query($sql);
		
		//get id just inserted
		$insert_id = $this->db->insert_id();
		
		//insert name theo tung language
//		foreach ($aryLanguageList as $aryLanguage) {
			$lang_id = 'vi';
			$name = $aryMenuInfo['name'];
			$sql = "INSERT INTO ".$this->prefix."menu_des (id, name, lang_id) VALUES(" .$insert_id. ",'" .$name. "','$lang_id')";
			$this->db->query($sql);	
//		}
		
		return $this->db->insert_id();
	}
	
	/**
	    * function editMenu. create new product menuegory 
	    * @access public
	    * @param array $aryMenuInfo
	    * @param array $aryLanguageList
	    * @author Bui Thanh Dung
	    * @return infectedNumber
	 */
	function editMenu($aryMenuInfo) {
		$affectedRows = 0;
		$id = $aryMenuInfo['id'];
		
		//get old info to compare with new info order to determin insert or update record
		$aryMenuOldInfo = $this->getMenuInfoBytId($id);
		
		$sql = "UPDATE ".$this->prefix."menu SET last_modefied = NOW(), 
				parent_id = " . $aryMenuInfo['parent_id'] . 
				", status = " .  $aryMenuInfo['status'] .
				", url = '" .  $aryMenuInfo['url'] .
				"'  WHERE id =".$id;
				
		$this->db->query($sql);
		$name = $aryMenuInfo['name'];
		$sql = "UPDATE ".$this->prefix."menu_des SET name = '" .$name. "' WHERE id = " .$id. " AND lang_id = '".$aryMenuInfo['lang_id']."'";
			
		$this->db->query($sql);
		
		return true;
	}
	
	/**
	    * function trans. translate menu 
	    * @access public
	    * @param array $aryMenuInfo
	    * @param array $aryLanguageList
	    * @author Bui Thanh Dung
	    * @return infectedNumber
	 */
	function trans($aryMenuInfo, $traslated = 'true') {
		$affectedRows = 0;
		$name = $this->db_input($aryMenuInfo['name']);
				
		if($traslated) {
			$sql = "UPDATE ".$this->prefix."menu_des SET name = '" .$name. "' WHERE id = " .$aryMenuInfo['id']. " AND lang_id = '".$aryMenuInfo['lang_id']."'";
		}
		else {
			$sql = "INSERT INTO ".$this->prefix."menu_des (id, name, lang_id) VALUES(" .$aryMenuInfo['id']. ",'" .$name. "','" .$aryMenuInfo['lang_id']. "')";
		}
		
		$affectedRows = $this->db->query($sql);
		
		return $affectedRows;
	}
	
	/**
	    * function getMenuBytId.
	    * @access public
	    * @param integer $menuId
	    * @author Bui Thanh Dung
	    * @return $array
	 */
	function getMenuInfoBytId($menuId, $lang_id = 'vi') {

		$aryMenuInfo = array();
		if(!is_numeric($menuId)) return $aryMenuInfo;
		
		$sql = "SELECT c.status, c.parent_id, c.url, cd.* FROM ".$this->prefix."menu c, ".$this->prefix."menu_des cd WHERE c.id = cd.id AND lang_id = '$lang_id' AND cd.id = " . $menuId;
		$rs = $this->db->query($sql);
		
		$aryMenuInfo = $rs->row_array();
		
		return $aryMenuInfo;				 									 
	}
	
	/**
	    * function deleteMenu.
	    * @access public
	    * @param integer $menuId
	    * @author Bui Thanh Dung
	    * @return $array
	 */
	function deleteMenu($menuId) {

		//delete sub menu if exist
		$sql = "DELETE cd FROM ".$this->prefix."menu c, ".$this->prefix."menu_des cd WHERE cd.id IN (SELECT id FROM ".$this->prefix."menu WHERE parent_id = " . $menuId . ")";
		$this->db->query($sql);
		
		//delete menu and submenu in news_type
		$sql = "DELETE c, cd FROM ".$this->prefix."menu c, ".$this->prefix."menu_des cd WHERE (c.id = " . $menuId . " OR parent_id =" . $menuId . ") AND cd.id =" . $menuId ;
		$this->db->query($sql);	
		
		return true;				 									 
	}
	
		
	/**
	    * function sortMenu.
	    * @access public
	    * @param array $aryMenuOrder = Array ( [0] => 41 [1] => 42 [2] => 43 [3] => 45 [4] => 46 [5] => 47 [6] => 40 [7] => 44 [8] => 39 [9] => 35 [10] => 38 [11] => 36 ) 
	    * @param array $aryMenuOrder = Array ( [0] => 3 [1] => 5 [2] => 4 [3] => 3 [4] => 3 [5] => 2 [6] => 3 [7] => 1 [8] => 2 [9] => 4 [10] => 2 [11] => 1 )
	    * @author Bui Thanh Dung
	    * @return infectedNumber
	 */
	function sortMenu($aryMenuOrder, $aryMenuId) {

		$affectedRows = 0;
		foreach ($aryMenuOrder as $key => $menuOrder) {		
			$menuOrder = $menuOrder;
			$id = $aryMenuId[$key];
			
			$sql = "UPDATE ".$this->prefix."menu SET ordering = " .  $menuOrder ."  WHERE id =".$id;
			$affectedRows = $this->db->query($sql);
		}
		
		return $affectedRows;
	}
}

?>
