<?
class Ci_propertiesModel extends Nny_Model {
/**
 * MODULE NAME   : ci_propertiesmodel.php
 *
 * DESCRIPTION   : Ci_properties model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-02-03 11:04 PM   - Pradesh Chanderpaul     - Created
 *
 * @package             ci_properties
 * @subpackage          Ci_properties model component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $id;
var $name;
var $owner;
var $address;
var $neighborhood;
var $contact_name;
var $contact_phone;
var $contact_email;
var $zip;
var $infomation;
var $intro_infomation;
var $private_info;
var $url;
var $hold;
var $type;
var $attach_files;
var $bedrooms;
var $bath;
var $square_footage;
var $transport_router1;
var $is_vip;
var $is_hot;
var $neighbor_hood;
var $property_type;
var $price;
var $create_user;
var $start_date;
var $end_date;
var $amenities;
var $geocode;
var $distance;
var $available_date;
//var $floorplan_file;
var $fprice;
var $fsquare_width;
var $fbedrooms;
var $fbath;
var $bath_max;
var $bedrooms_max;
var $price_max;
var $square_max;
var $site_id;
var $district;
var $is_negotiate;
var $m2;
var $page_type;
var $position;
var $direction;
var $from_to_road;
var $is_power_oclock;
var $is_water;
var $build_year;
var $currency;
var $culture;
var $fsquare_length;
var $province;


   function Ci_propertiesModel()
   {
      parent::Model();
      $this->obj =& get_instance();
      $this->_init_Ci_properties();

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
      
//	$query = $this->db->query('SELECT COUNT(*) as total_row FROM '.$this->db->dbprefix('properties'). ' ' . $filters);
//	$row = $query->row();
//	$this->table_record_count = $row->total_row;


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
      if ($count || $start) {
         if ($count) {
            $limit_clause = " LIMIT $start, $count ";
         }
         else {
            $limit_clause = " LIMIT $start ";
         }
      }

      // Build up the SQL query string and run the query
      $sql = 'SELECT p.*, t.name as province_name FROM '.$this->db->dbprefix('properties').' p LEFT JOIN itjob_cities t ON(p.province = t.id) ' . $where_clause . ' ORDER BY id DESC ' . $limit_clause ;
      $query = $this->db->query($sql);

      if ($query->num_rows() > 0) {

         foreach ($query->result_array() as $row) {
			$attach_files		 = @unserialize($row['attach_files']);
			$row['attach_files']		 = $attach_files['file'];
			$row['attach_files_title']	 = $attach_files['title'];

			$results[]		 = $row;
         }
      }
      
           //count
      if($count) $this->table_record_count = $this->query_count($sql);

      return $results;
   }


   // TODO: this won't be possible if there is no primary key for the table.
   function retrieve_by_pkey($idField) {

      $results = array();
      $query = $this->db->query("SELECT p.*, t.name as province_name FROM ".$this->db->dbprefix('properties')." p LEFT JOIN itjob_cities t ON(p.province = t.id) WHERE p.id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         	$row = $query->row_array();
			$results		 = $row;
      }
      else {
         $results = false;
      }

      return $results;
   }


   function add( $data ) {

      // Build up the SQL query string
      $sql = $this->db->insert_string('properties', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {

      // Build up the SQL query string
      $where = " id = $keyvalue AND create_user = " . $data['create_user'];
      $sql = $this->db->update_string('properties', $data, $where);

      $query = $this->db->query($sql);
   }
   
   /**
    * update view times
    *
    * @param unknown_type $keyvalue
    * @param unknown_type $data
    */
   function update_view($keyvalue, $data) {

      $sql = "UPDATE ".$this->db->dbprefix('properties')." SET `view` = view + 1 WHERE id = $keyvalue";

      $query = $this->db->query($sql);
   }

   function delete_by_pkey($idField, $user_id = 0) {
   	if($user_id) $strWhere = " AND create_user = $user_id ";
       $query = $this->db->query("DELETE FROM ".$this->db->dbprefix('properties')." WHERE id = '$idField' $strWhere");

     return true;
   }

	function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_Name() {
		return $this->name;	}

	function set_Name($name) {
		$this->name = $name;	}

	function get_Owner() {
		return $this->owner;	}

	function set_Owner($owner) {
		$this->owner = $owner;	}

	function get_Address() {
		return $this->address;	}

	function set_Address($address) {
		$this->address = $address;	}

	function get_Neighborhood() {
		return $this->neighborhood;	}

	function set_Neighborhood($neighborhood) {
		$this->neighborhood = $neighborhood;	}

	function get_Contact_name() {
		return $this->contact_name;	}

	function set_Contact_name($contact_name) {
		$this->contact_name = $contact_name;	}

	function get_Contact_phone() {
		return $this->contact_phone;	}

	function set_Contact_phone($contact_phone) {
		$this->contact_phone = $contact_phone;	}

	function get_Contact_email() {
		return $this->contact_email;	}

	function set_Contact_email($contact_email) {
		$this->contact_email = $contact_email;	}

	function get_Zip() {
		return $this->zip;	}

	function set_Zip($zip) {
		$this->zip = $zip;	}

	function get_Infomation() {
		return $this->infomation;	}

	function set_Infomation($infomation) {
		$this->infomation = $infomation;	}
	function set_Intro_infomation($intro_infomation) {
		$this->intro_infomation = $intro_infomation;	}

	function get_Url() {
		return $this->url;	}

	function set_Url($url) {
		$this->url = $url;	}

	function get_Hold() {
		return $this->hold;	}

	function set_Hold($hold) {
		$this->hold = $hold;	}

	function get_Type() {
		return $this->type;	}

	function set_Type($type) {
		$this->type = $type;	}

	function get_Attach_files() {
		return $this->attach_files;	}

	function set_Attach_files($attach_files) {
		$this->attach_files = $attach_files;	}

	function get_Bedrooms() {
		return $this->bedrooms;	}

	function set_Bedrooms($bedrooms) {
		$this->bedrooms = $bedrooms;	}

	function get_Bath() {
		return $this->bath;	}

	function set_Bath($bath) {
		$this->bath = $bath;	}

	function get_Square_footage() {
		return $this->square_footage;	}

	function set_Square_footage($square_footage) {
		$this->square_footage = $square_footage;	}

	function get_Transport_router1() {
		return $this->transport_router1;	}

	function set_Transport_router1($transport_router1) {
		$this->transport_router1 = $transport_router1;	}

	function get_is_vip() {
		return $this->is_vip;	}

	function set_is_vip($is_vip) {
		$this->is_vip = $is_vip;	}
	function get_is_hot() {
		return $this->is_vip;	}

	function set_is_hot($is_vip) {
		$this->is_vip = $is_vip;	}

	function get_Neighbor_hood() {
		return $this->neighbor_hood;	}

	function set_Neighbor_hood($neighbor_hood) {
		$this->neighbor_hood = $neighbor_hood;	}

	function get_Property_type() {
		return $this->property_type;	}

	function set_Property_type($property_type) {
		$this->property_type = $property_type;	}

	function get_Price() {
		return $this->price;	}

	function set_Price($price) {
		$this->price = $price;	}

	function get_Create_user() {
		return $this->create_user;	}

	function set_Create_user($create_user) {
		$this->create_user = $create_user;	}

	function get_Start_date() {
		return $this->start_date;	}

	function set_Start_date($start_date) {
		$this->start_date = $start_date;	}

	function get_End_date() {
		return $this->end_date;	}

	function set_End_date($end_date) {
		$this->end_date = $end_date;	}

	function get_Amenities() {
		return $this->amenities;	}

	function set_Amenities($amenities) {
		$this->amenities = $amenities;	}	
		
	function get_Geocode() {
		return $this->geocode;	}

	function set_Geocode($geocode) {
		$this->geocode = $geocode;	}
				
	function get_Distance() {
		return $this->distance;	}

	function set_Distance($distance) {
		$this->distance = $distance;	}
				
	function get_Available_date() {
		return $this->available_date;	}

	function set_Available_date($available_date) {
		$this->available_date = $available_date;	}
		
		
//	function get_floorplan_file() {
//		return $this->floorplan_file;	}

//	function set_floorplan_file($floorplan_file) {
//		$this->floorplan_file = $floorplan_file;	}

	function get_Fprice() {
		return $this->fprice;	}

	function set_Fprice($fprice) {
		$this->fprice = $fprice;	}

	function get_fsquare_width() {
		return $this->fsquare_width;	}

	function get_Fbedrooms() {
		return $this->fbedrooms;	}

	function set_Fbedrooms($fbedrooms) {
		$this->fbedrooms = $fbedrooms;	}

	function get_Fbath() {
		return $this->fbath;	}

	function set_Fbath($fbath) {
		$this->fbath = $fbath;	}

	function get_Bath_max() {
		return $this->bath_max;	}

	function set_Bath_max($bath_max) {
		$this->bath_max = $bath_max;	}

	function get_Bedrooms_max() {
		return $this->bedrooms_max;	}

	function set_Bedrooms_max($bedrooms_max) {
		$this->bedrooms_max = $bedrooms_max;	}

	function get_Price_max() {
		return $this->price_max;	}

	function set_Price_max($price_max) {
		$this->price_max = $price_max;	}

	function get_Square_max() {
		return $this->square_max;	}

	function set_Square_max($square_max) {
		$this->square_max = $square_max;	}

      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You may want to add default values here.
      function _init_Ci_properties()
      {
		$this->id = "";
		$this->name = "";
		$this->owner = "";
		$this->address = "";
		$this->neighborhood = "";
		$this->contact_name = "";
		$this->contact_phone = "";
		$this->contact_email = "";
		$this->zip = "";
		$this->infomation = "";
		$this->intro_infomation = "";
		$this->private_info = "";
		$this->url = "";
		$this->hold = "";
		$this->type = "";
		$this->attach_files = "";
		$this->bedrooms = "";
		$this->bath = "";
		$this->square_footage = "";
		$this->transport_router1 = "";
		$this->is_vip = "";
		$this->is_hot = "";
		$this->neighbor_hood = "";
		$this->property_type = "";
		$this->price = "";
		$this->create_user = "";
		$this->start_date = "";
		$this->end_date = "";
		$this->amenities = "";
		$this->geocode = "";
		$this->distance = "";
		$this->available_date = "";
				
//		$this->floorplan_file = "";
		$this->fprice = "";
		$this->fsquare_width = "";
		$this->fbedrooms = "";
		$this->fbath = "";
		$this->bath_max = "";
		$this->bedrooms_max = "";
		$this->price_max = "";
		$this->square_max = "";

      }

      // Initialize all your default variables here
      // Function used to initilialise class variables.
      // NOTE: Not particularly useful unless you are using model persistence
      // NOTE: You could add default values here, but fields are generally set empty
      function _emptyCi_properties()
      {
		$this->id = "";
		$this->name = "";
		$this->owner = "";
		$this->address = "";
		$this->neighborhood = "";
		$this->contact_name = "";
		$this->contact_phone = "";
		$this->contact_email = "";
		$this->zip = "";
		$this->infomation = "";
		$this->intro_infomation = "";
		$this->private_info = "";
		$this->url = "";
		$this->hold = "";
		$this->type = "";
		$this->attach_files = "";
		$this->bedrooms = "";
		$this->bath = "";
		$this->square_footage = "";
		$this->transport_router1 = "";
		$this->is_vip = "";
		$this->is_hot = "";
		$this->neighbor_hood = "";
		$this->property_type = "";
		$this->price = "";
		$this->create_user = "";
		$this->start_date = "";
		$this->end_date = "";
		$this->amenities = "";
		$this->geocode = "";
		$this->distance = "";
		$this->available_date = "";
				
//		$this->floorplan_file = "";
		$this->fprice = "";
		$this->fsquare_width = "";
		$this->fbedrooms = "";
		$this->fbath = "";
		$this->bath_max = "";
		$this->bedrooms_max = "";
		$this->price_max = "";
		$this->square_max = "";

      }

}

?>
