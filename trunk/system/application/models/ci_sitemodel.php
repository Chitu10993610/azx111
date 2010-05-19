<?
class Ci_siteModel extends Model {
/**
 * MODULE NAME   : ci_sitemodel.php
 *
 * DESCRIPTION   : Ci_site model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-03 10:07 PM   - Pradesh Chanderpaul     - Created
 *
 * @package             ci_site
 * @subpackage          Ci_site model component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $member_id;
var $site_name;
var $status_flg;
var $style;
var $header;
var $footer;
var $theme_id;
var $box1_area;
var $right_area;
var $above_product;
var $under_product;
var $update_date;
var $create_date;
var $time_expire;
var $page_title;
var $page_keywords;
var $page_description;
var $header_image;
var $bg_image;
var $bg_color;
var $paging_flg;
var $page_range;
var $number_record_per_page;
var $email_contact;
var $product_per_row;
var $style_navigation;
var $site_title;


   function Ci_siteModel()
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
      $this->_init_Ci_site();

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
      $this->table_record_count = $this->db->count_all( 'ci_site' );


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
      $sql = 'SELECT * FROM ci_site s LEFT JOIN ci_users u ON(s.member_id = u.userid)' . $where_clause . $limit_clause;

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
			$query_results['member_id']		 = $row['member_id'];
			$query_results['site_name']		 = $row['site_name'];
			$query_results['status_flg']		 = $row['status_flg'];
			$query_results['style']		 = $row['style'];
			$query_results['header']		 = $row['header'];
			$query_results['footer']		 = $row['footer'];
			$query_results['theme_id']		 = $row['theme_id'];
			$query_results['box1_area']		 = $row['box1_area'];
			$query_results['box2_area']		 = $row['box2_area'];
			$query_results['above_product']		 = $row['above_product'];
			$query_results['under_product']		 = $row['under_product'];
			$query_results['update_date']		 = $row['update_date'];
			$query_results['create_date']		 = $row['create_date'];
			$query_results['time_expire']		 = $row['time_expire'];
			$query_results['page_title']		 = $row['page_title'];
			$query_results['page_keywords']		 = $row['page_keywords'];
			$query_results['page_description']		 = $row['page_description'];
			$query_results['header_image']		 = $row['header_image'];
			$query_results['bg_image']		 = $row['bg_image'];
			$query_results['bg_color']		 = $row['bg_color'];
			$query_results['paging_flg']		 = $row['paging_flg'];
			$query_results['page_range']		 = $row['page_range'];
			$query_results['number_record_per_page']		 = $row['number_record_per_page'];
			$query_results['email_contact']		 = $row['email_contact'];
			$query_results['product_per_row']		 = $row['product_per_row'];
			$query_results['style_navigation']		 = $row['style_navigation'];
			$query_results['site_title']		 = $row['site_title'];
			$query_results['username']		 = 		$row['username'];
			$query_results['fullname']		 = 		$row['fullname'];

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

      $query = $this->db->query("SELECT * FROM ci_site s LEFT JOIN ci_users u ON(s.member_id = u.userid) WHERE id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['id']		 = $row['id'];
		$query_results['member_id']		 = $row['member_id'];
		$query_results['site_name']		 = $row['site_name'];
		$query_results['status_flg']		 = $row['status_flg'];
		$query_results['style']		 = $row['style'];
		$query_results['header']		 = $row['header'];
		$query_results['footer']		 = $row['footer'];
		$query_results['theme_id']		 = $row['theme_id'];
		$query_results['box1_area']		 = $row['box1_area'];
		$query_results['box2_area']		 = $row['box2_area'];
		$query_results['above_product']		 = $row['above_product'];
		$query_results['under_product']		 = $row['under_product'];
		$query_results['update_date']		 = $row['update_date'];
		$query_results['create_date']		 = $row['create_date'];
		$query_results['time_expire']		 = $row['time_expire'];
		$query_results['page_title']		 = $row['page_title'];
		$query_results['page_keywords']		 = $row['page_keywords'];
		$query_results['page_description']		 = $row['page_description'];
		$query_results['header_image']		 = $row['header_image'];
		$query_results['bg_image']		 = $row['bg_image'];
		$query_results['bg_color']		 = $row['bg_color'];
		$query_results['paging_flg']		 = $row['paging_flg'];
		$query_results['page_range']		 = $row['page_range'];
		$query_results['number_record_per_page']		 = $row['number_record_per_page'];
		$query_results['email_contact']		 = $row['email_contact'];
		$query_results['product_per_row']		 = $row['product_per_row'];
		$query_results['style_navigation']		 = $row['style_navigation'];
		$query_results['site_title']		 = $row['site_title'];
		$query_results['username']		 = $row['username'];
		$query_results['fullname']		 = $row['fullname'];

		$results		 = $query_results;


      }
      else {
         $results = false;
      }

      return $results;
   }
   
   // TODO: this won't be possible if there is no primary key for the table.
   function get_by_name($name) {

      $results = 0;

      // Load  the db library
      $this->load->database();
      $query = $this->db->query("SELECT id FROM ci_site WHERE site_name = '$name'");
      if ($query->num_rows() > 0) {
         	$row = $query->row_array();

			return $row['id'];
      }

      return $results;
   }


   function add( $data ) {

      // Load the database library
      $this->load->database();

      // Build up the SQL query string
      $sql = $this->db->insert_string('ci_site', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {


      // Load the database library
      $this->load->database();

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('ci_site', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField)
   {
    
   	if($idField == 1) return true;
   	// Load  the db library
      $this->load->database();

      // ///////////////////////////////////////////////////////////////////////
      // TODO: Just to eliminate nasty mishaps, the delete query has been
      // TODO: ...deliberately disabled. Enable it if you mean to by uncommenting
      // TODO: ...the query function call below
      // ///////////////////////////////////////////////////////////////////////
//       $query = $this->db->query("DELETE FROM ci_site WHERE id = '$idField' AND member_id = '$memberId' ");
       $query = $this->db->query("DELETE FROM ci_site WHERE id = '$idField'");

     return true;

   }

	function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_Member_id() {
		return $this->member_id;	}

	function set_Member_id($member_id) {
		$this->member_id = $member_id;	}

	function get_Site_name() {
		return $this->site_name;	}

	function set_Site_name($site_name) {
		$this->site_name = $site_name;	}

	function get_Status_flg() {
		return $this->status_flg;	}

	function set_Status_flg($status_flg) {
		$this->status_flg = $status_flg;	}

	function get_Style() {
		return $this->style;	}

	function set_Style($style) {
		$this->style = $style;	}

	function get_Header() {
		return $this->header;	}

	function set_Header($header) {
		$this->header = $header;	}

	function get_Footer() {
		return $this->footer;	}

	function set_Footer($footer) {
		$this->footer = $footer;	}

	function get_Theme_id() {
		return $this->theme_id;	}

	function set_Theme_id($theme_id) {
		$this->theme_id = $theme_id;	}

	function get_Box1_area() {
		return $this->box1_area;	}

	function set_Box1_area($box1_area) {
		$this->box1_area = $box1_area;	}

	function get_Box2_area() {
		return $this->box2_area;	}

	function set_Box2_area($box2_area) {
		$this->box2_area = $box2_area;	}

	function get_Above_product() {
		return $this->above_product;	}

	function set_Above_product($above_product) {
		$this->above_product = $above_product;	}

	function get_Under_product() {
		return $this->under_product;	}

	function set_Under_product($under_product) {
		$this->under_product = $under_product;	}

	function get_Update_date() {
		return $this->update_date;	}

	function set_Update_date($update_date) {
		$this->update_date = $update_date;	}

	function get_Create_date() {
		return $this->create_date;	}

	function set_Create_date($create_date) {
		$this->create_date = $create_date;	}

	function get_Time_expire() {
		return $this->time_expire;	}

	function set_Time_expire($time_expire) {
		$this->time_expire = $time_expire;	}

	function get_Page_title() {
		return $this->page_title;	}

	function set_Page_title($page_title) {
		$this->page_title = $page_title;	}

	function get_Page_keywords() {
		return $this->page_keywords;	}

	function set_Page_keywords($page_keywords) {
		$this->page_keywords = $page_keywords;	}

	function get_Page_description() {
		return $this->page_description;	}

	function set_Page_description($page_description) {
		$this->page_description = $page_description;	}

	function get_Header_image() {
		return $this->header_image;	}

	function set_Header_image($header_image) {
		$this->header_image = $header_image;	}

	function get_Bg_image() {
		return $this->bg_image;	}

	function set_Bg_image($bg_image) {
		$this->bg_image = $bg_image;	}

	function get_Bg_color() {
		return $this->bg_color;	}

	function set_Bg_color($bg_color) {
		$this->bg_color = $bg_color;	}

	function get_Paging_flg() {
		return $this->paging_flg;	}

	function set_Paging_flg($paging_flg) {
		$this->paging_flg = $paging_flg;	}

	function get_Page_range() {
		return $this->page_range;	}

	function set_Page_range($page_range) {
		$this->page_range = $page_range;	}

	function get_Number_record_per_page() {
		return $this->number_record_per_page;	}

	function set_Number_record_per_page($number_record_per_page) {
		$this->number_record_per_page = $number_record_per_page;	}

	function get_Email_contact() {
		return $this->email_contact;	}

	function set_Email_contact($email_contact) {
		$this->email_contact = $email_contact;	}

	function get_Product_per_row() {
		return $this->product_per_row;	}

	function set_Product_per_row($product_per_row) {
		$this->product_per_row = $product_per_row;	}

	function get_Style_navigation() {
		return $this->style_navigation;	}

	function set_Style_navigation($style_navigation) {
		$this->style_navigation = $style_navigation;	}

	function get_Site_title() {
		return $this->site_title;	}

	function set_Site_title($site_title) {
		$this->site_title = $site_title;	}



      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You may want to add default values here.
      function _init_Ci_site()
      {
		$this->id = "";
		$this->member_id = "";
		$this->site_name = "";
		$this->status_flg = "";
		$this->style = "";
		$this->header = "";
		$this->footer = "";
		$this->theme_id = "";
		$this->box1_area = "";
		$this->box2_area = "";
		$this->above_product = "";
		$this->under_product = "";
		$this->update_date = "";
		$this->create_date = "";
		$this->time_expire = "";
		$this->page_title = "";
		$this->page_keywords = "";
		$this->page_description = "";
		$this->header_image = "";
		$this->bg_image = "";
		$this->bg_color = "";
		$this->paging_flg = "";
		$this->page_range = "";
		$this->number_record_per_page = "";
		$this->email_contact = "";
		$this->product_per_row = "";
		$this->style_navigation = "";
		$this->site_title = "";

      }

      // Initialize all your default variables here
      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You could add default values here, but fields are generally set empty
      function _emptyCi_site()
      {
		$this->id = "";
		$this->member_id = "";
		$this->site_name = "";
		$this->status_flg = "";
		$this->style = "";
		$this->header = "";
		$this->footer = "";
		$this->theme_id = "";
		$this->box1_area = "";
		$this->box2_area = "";
		$this->above_product = "";
		$this->under_product = "";
		$this->update_date = "";
		$this->create_date = "";
		$this->time_expire = "";
		$this->page_title = "";
		$this->page_keywords = "";
		$this->page_description = "";
		$this->header_image = "";
		$this->bg_image = "";
		$this->bg_color = "";
		$this->paging_flg = "";
		$this->page_range = "";
		$this->number_record_per_page = "";
		$this->email_contact = "";
		$this->product_per_row = "";
		$this->style_navigation = "";
		$this->site_title = "";

      }

}

?>
