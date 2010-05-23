<?
class Ci_newsModel extends Nny_Model {
/**
 * MODULE NAME   : ci_newsmodel.php
 *
 * DESCRIPTION   : Ci_news model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-20 01:12 AM   - Pradesh Chanderpaul     - Created
 *
 * @package             news
 * @subpackage          Ci_news model component Class
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


   function Ci_newsModel()
   {
      parent::Nny_Model();
//      $this->obj =& get_instance();

      // Initialise or clear class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      $this->_init_Ci_news();

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
      // ///////////////////////////////////////////////////////////////////////
      // Make a note of the current table record count
      // ///////////////////////////////////////////////////////////////////////
//      $this->table_record_count = $this->db->count_all( 'news' );
		$query = $this->db->query('SELECT COUNT(*) as total_row FROM '.$this->prefix.'news' . $filters);
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
      $sql = 'SELECT * FROM '.$this->prefix.'news ' . $where_clause . $limit_clause;

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

      $query = $this->db->query("SELECT * FROM ".$this->prefix."news WHERE id = '$idField' LIMIT 1");

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
      // Build up the SQL query string
      $sql = $this->db->insert_string('news', $data);

//      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('news', $data, $where);

      $query = $this->db->query($sql);

   }

     /**
	    * function deleteNews.
	    * @access public
	    * @param integer $aryNewsId
	    * @author Bui Thanh Dung
	    * @return $array
	 */
	function deleteNews($aryNewsId) {
		
		//chi xoa nhung tin chua xuat ban
		$where = (access(DELETE_NEWS_UNPUBLISH) && !access(DELETE_NEWS)) ? ' AND news_status = 0 ': '';
		
		$aryImages = array();
		if(is_array($aryNewsId) && sizeof($aryNewsId) > 0) {
			//$strNewsId = implode("','", $aryNewsId);
			foreach ($aryNewsId as $newsId) {
			
				//get news info
				$aryNews = $this->getNewsById($newsId);
			
				if(is_array($aryNews) && sizeof($aryNews)) {
					$sql = "DELETE FROM ".$this->prefix."news WHERE news_id = $newsId" .$where;
					$affectedRows = $this->db->query($sql);
					
					//chi xoa des khi tin o news bi xoa
					if($affectedRows) {
						$sql = "DELETE FROM ".$this->prefix."news_des WHERE news_id = $newsId";
						$affectedRows = $this->db->query($sql);
					}
					
					if($affectedRows) array_push($aryImages, $aryNews['news_image']);
				}
			}
		}
		
		return $aryImages;				 									 
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
      function _init_Ci_news()
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
      function _emptyCi_news()
      {
		$this->id = "";
		$this->news_title = "";
		$this->description = "";
		$this->news_url = "";

      }
      
      /**
	    * function getNewsList. get all news
	    * @access public
	    * @param integer $parent_id
	    * @author Bui Thanh Dung
	   * @return $array
	 */
	function getNewsList($type = '', $catId = 0, $start = 0, $limit = 15, $filter = '') {	
		$lang_id = 'vi';
		$aryNewsList = array();
		$strWhere = '';
		$fromtable = '';
		$strWhere .= $type ? " AND news_type = '$type'" : '';		
		if($catId) { 
			$strWhere .=  " AND (nt.cat_id = " . (int)$catId . " OR nt.parent_id =" . (int)$catId . " ) AND n.cat_id = nt.cat_id ";;
			$fromtable = ", nny_news_cat nt ";
		}	
		$strWhere .= $lang_id ? " AND lang_id = '$lang_id'" : '';		
		$sql = "SELECT n.*, nd.* FROM ".$this->prefix."news n,".$this->prefix."news_des nd " .$fromtable ."
		WHERE n.news_id = nd.news_id " . $strWhere . $filter
		." ORDER BY create_date DESC";

		$total_row = 0;
		$aryNewsList = $this->pager_query($sql, $total_row, $start, $limit);
		$this->table_record_count = $total_row;

		return $aryNewsList;		 									 
	}
	/**
	* function createNews. create new news 
	* @access public
	* @param array $aryNewsInfo
	* @author Bui Thanh Dung
	* @return infectedNumber
	*/
	function createNews($aryNewsInfo) {
		
		$this->load->library('front_lib');
			
		$sql = "INSERT INTO ".$this->prefix."news(
							poster, 
							poster_name, 
							news_status, 
							news_image_align, 
							news_image_border, 
							news_image_width, 
							news_image_higth, 
							show_home,  
							is_tieudiem,  
							create_date, 
							update_date, 
							news_image, 
							news_type, 
							cat_id) 
					VALUES(
							" . $aryNewsInfo['poster'] . ", 
							'" . $aryNewsInfo['poster_name'] . "', 
							" . (int)$aryNewsInfo['news_status'] . ", 
							" . (int)$aryNewsInfo['news_image_align'] . ", 
							" . (int)$aryNewsInfo['news_image_border'] . ", 
							" . (int)$aryNewsInfo['news_image_width'] . ", 
							" . (int)$aryNewsInfo['news_image_higth'] . ", 
							" . (int)$aryNewsInfo['show_home'] . ", 
							" . (int)$aryNewsInfo['is_tieudiem'] . ", 
							". time() . ",  
							". time() . ",  
							'" . $aryNewsInfo['news_image'] . "', 
							'" . $aryNewsInfo['news_type'] . "', 
							 " . (int)$aryNewsInfo['cat_id'] . " 
							 )";
		
		$this->db->query($sql);
		
		//get news_id just inserted
		$insert_id = $this->db->insert_id();
		
		//insert news_name theo tung language
			$lang_id = 'vi';
			$news_title = $this->db_input($aryNewsInfo['news_title']);
			$news_title_sef = $this->front_lib->cv2sef($news_title).'.html';
			$intro_content = $this->db_input($aryNewsInfo['intro_content']);
			$news_content = $this->db_input($aryNewsInfo['news_content']);
			
			$sql = "INSERT INTO ".$this->prefix."news_des (
								news_id, news_title, news_title_sef, intro_content, news_content, lang_id) 
								VALUES(" .$insert_id. ", '" .$news_title. "', '" .$news_title_sef. "','" .$intro_content. "', 
								'" .$news_content. "', '" .$lang_id. "')";
			return $this->db->query($sql);
	}
	
	/**
	    * function getNewsById. get news info
	    * @access public
	    * @param integer $parent_id
	    * @author Bui Thanh Dung
	   * @return $array
	 */
	function getNewsById($id, $lang_id = 'vi') {
		
//		$lang_id = 0;
		$aryNewsInfo = array();
		
		$sql = "SELECT n.*, nd.* FROM ".$this->prefix."news n, ".$this->prefix."news_des nd 
				WHERE n.news_id = nd.news_id AND n.news_id = " . $id." AND nd.lang_id = '$lang_id'";
				
		
		$rs = $this->db->query($sql);
		$aryNewsInfo = $rs->row_array();
				
			/*$aryNewsInfo[$ary['lang_id']] = array('news_id' => $ary['news_id'],
								 'news_title' => $objGeneral->fomarOut($ary['news_title']),	
								 'intro_content' => $ary['intro_content'],	
								 'news_content' => $ary['news_content'],	
								 'news_image' => $ary['news_image'],
								 'news_status' => $ary['news_status'],
								 'news_image_align' => $ary['news_image_align'],
								 'news_image_border' => $ary['news_image_border'],
								 'news_image_width' => $ary['news_image_width'],
								 'news_image_higth' => $ary['news_image_higth'],
								 'show_home' => $ary['show_home'],
								 'cat_id' => $ary['cat_id']
								 );*/
//			}
		
		return $aryNewsInfo;
						 									 
	}
	
	/**
	    * function updateNews. update news info
	    * @access public
	    * @param array $aryNewsInfo
	    * @author Bui Thanh Dung
	    * @return infectedNumber
	 */
	function updateNews($aryNewsInfo) {
		
		$this->load->library('front_lib');
		
		$affectedRows = 0;
		$newsId = $aryNewsInfo['news_id'];
		$lang_id = 'vi';
		
		$sql = "UPDATE ".$this->prefix."news SET news_image = '" . $aryNewsInfo['news_image'] . "', 
						news_status = '" . (int)$aryNewsInfo['news_status'] . "', 
						news_image_align = '" . $aryNewsInfo['news_image_align'] . "', 
						news_image_border = '" . (int)$aryNewsInfo['news_image_border'] . "', 
						news_image_width = '" . (int)$aryNewsInfo['news_image_width'] . "', 
						news_image_higth = '" . (int)$aryNewsInfo['news_image_higth'] . "', 
						show_home = '" . (int)$aryNewsInfo['show_home'] . "', 
						is_tieudiem = '" . (int)$aryNewsInfo['is_tieudiem'] . "',
						update_user = '" . $aryNewsInfo['update_user'] . "', 
						update_name = '" . $aryNewsInfo['update_name'] . "',
						update_date = ". time() . ",   
						cat_id =  '" . $aryNewsInfo['cat_id'] . "'  
				WHERE news_id = ". $newsId;   
		
		$affectedRows = $this->db->query($sql);
		
			$news_title = $this->db_input($aryNewsInfo['news_title']);
			$news_title_sef = $this->front_lib->cv2sef($news_title).'.html';
			$intro_content = $this->db_input($aryNewsInfo['intro_content']);
			$news_content = $this->db_input($aryNewsInfo['news_content']);
		
		//update or insert news_name by language
		$sql = "UPDATE ".$this->prefix."news_des SET 	news_title = '" .$news_title. "', news_title_sef = '" .$news_title_sef. "', 
					intro_content = '" .$intro_content. "',  news_content = '" .$news_content. "'
					WHERE news_id = " . $newsId . " AND lang_id = '$lang_id'";
			
		$affectedRows = $this->db->query($sql);

		return $affectedRows;
	}
	
	/**
	    * function trans
	    * @access public
	    * @param array $aryNewsInfo
	    * @author Bui Thanh Dung
	    * @return infectedNumber
	 */
	function trans($aryNewsInfo, $translated = 'true') {
		$this->load->library('front_lib');
		
		$affectedRows = 0;
		$newsId = $aryNewsInfo['news_id'];
		
		$news_title = $this->db_input($aryNewsInfo['news_title']);
		$news_title_sef = $this->front_lib->cv2sef($news_title).'.html';
		$intro_content = $this->db_input($aryNewsInfo['intro_content']);
		$news_content = $this->db_input($aryNewsInfo['news_content']);
		
		//update or insert news_name by language
		if($translated) {
			$sql = "UPDATE ".$this->prefix."news_des SET 	news_title = '" .$news_title. "', news_title_sef = '" .$news_title_sef. "', 
					intro_content = '" .$intro_content. "',  news_content = '" .$news_content. "'
					WHERE news_id = " . $newsId . " AND lang_id = '".$aryNewsInfo['lang_id']."'";
		}
		else {
			$sql = "INSERT INTO ".$this->prefix."news_des (
					news_id, news_title, news_title_sef, intro_content, news_content, lang_id) 
					VALUES(" .$newsId. ", '" .$news_title. "', '" .$news_title_sef. "','" .$intro_content. "', 
					'" .$news_content. "', '" .$aryNewsInfo['lang_id']. "')";
		}
		
		$affectedRows = $this->db->query($sql);

		return $affectedRows;
	}
}

?>
