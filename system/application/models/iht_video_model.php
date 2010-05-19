<?
class Iht_video_Model extends Nny_Model {
/**
 * MODULE NAME   : iht_videomodel.php
 *
 * DESCRIPTION   : Iht_video model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-08-10 12:38 PM   - dungbt     - Created
 *
 * @package             iht_video
 * @subpackage          Iht_video model component Class
 * @author              dungbt
 * @copyright           Copyright (c) 2008-2009 Takesoft Software
 * @license             http://takesoft.net
 * @link                http://takesoft.net
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $file_name;
var $user_id;
var $cat_id;
var $file_real_name;
var $file_des;
var $file_size;
var $mine_type;
var $create_date;
var $update_date;
   function Iht_video_Model() {
      parent::Nny_Model();
      $this->obj =& get_instance();
      $this->_init_Iht_video();

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

      $this->table_record_count = $this->record_count($this->db->dbprefix.'video', $filters);

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
      $sql = 'SELECT * FROM '.$this->db->dbprefix.'video ' . $where_clause . ' ORDER BY create_date DESC '. $limit_clause;

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

      $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix."video WHERE id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $results = $query->row_array();
      }
      else {
         $results = false;
      }

      return $results;
   }

   function add( $data ) {

      // Build up the SQL query string
      $sql = $this->db->insert_string('video', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('video', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField, $user_id = '') {
      $query = $this->db->query("DELETE FROM ".$this->db->dbprefix."video WHERE id = '$idField' ");

     return true;

   }
   
   /**
	    * function deleteVideo.
	    * @access public
	    * @param integer $aryVideoId
	    * @author Bui Thanh Dung
	    * @return $array
	 */
	function deleteVideo($aryVideoId) {
		
		$aryDelVideo = array();
		if(is_array($aryVideoId) && sizeof($aryVideoId) > 0) {
			//$strVideoId = implode("','", $aryVideoId);
			foreach ($aryVideoId as $videoId) {
			
				//get video info
				$aryVideo = $this->retrieve_by_pkey($videoId);
			
				if(is_array($aryVideo) && sizeof($aryVideo)) {
					$sql = "DELETE FROM ".$this->prefix."video WHERE id = $videoId" .$where;
					$affectedRows = $this->db->query($sql);
					
					if($affectedRows) {
						if($aryVideo['file_real_name']) array_push($aryDelVideo, IMG_VIDEO_PATH.$aryVideo['file_real_name']);
						if($aryVideo['video_image']) array_push($aryDelVideo, IMG_VIDEO_PATH.'thumb/'.$aryVideo['video_image']);
					}
				}
			}
		}
		
		return $aryDelVideo;				 									 
	}

			function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_File_name() {
		return $this->file_name;	}

	function set_File_name($file_name) {
		$this->file_name = $file_name;	}

	function get_User_id() {
		return $this->user_id;	}

	function set_User_id($user_id) {
		$this->user_id = $user_id;	}

	function get_File_real_name() {
		return $this->file_real_name;	}

	function set_File_real_name($file_real_name) {
		$this->file_real_name = $file_real_name;	}

	function get_File_des() {
		return $this->file_des;	}

	function set_File_des($file_des) {
		$this->file_des = $file_des;	}

	function get_File_size() {
		return $this->file_size;	}

	function set_File_size($file_size) {
		$this->file_size = $file_size;	}

	function get_Create_date() {
		return $this->create_date;	}

	function set_Create_date($create_date) {
		$this->create_date = $create_date;	}

	function get_Update_date() {
		return $this->update_date;	}

	function set_Update_date($update_date) {
		$this->update_date = $update_date;	}



      function _init_Iht_video()
      {
				$this->id = "";
		$this->file_name = "";
		$this->user_id = "";
		$this->cat_id = "";
		$this->file_real_name = "";
		$this->file_des = "";
		$this->file_size = "";
		$this->mine_type = "";
		$this->create_date = "";
		$this->update_date = "";

      }

      function _emptyIht_video() {
		$this->id = "";
		$this->file_name = "";
		$this->user_id = "";
		$this->cat_id = "";
		$this->file_real_name = "";
		$this->file_des = "";
		$this->file_size = "";
		$this->mine_type = "";
		$this->create_date = "";
		$this->update_date = "";
      }

}

?>
