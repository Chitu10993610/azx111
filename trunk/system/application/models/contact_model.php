<?
class Contact_Model extends Nny_Model {
/**
 * MODULE NAME   : iht_contactmodel.php
 *
 * DESCRIPTION   : Iht_contact model controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-12-15 11:53 PM   - dungbt     - Created
 *
 * @package             iht_contact
 * @subpackage          Iht_contact model component Class
 * @author              dungbt
 * @copyright           Copyright (c) 2008-2009 Takesoft Software
 * @license             http://takesoft.net
 * @link                http://takesoft.net
 * @since               Version 1.0
 * @filesource
 */

var $table_record_count;

var $name;
var $address;
var $email;
var $phone;
var $mobile;
var $subject;
var $content;
var $create_date;
var $status;
var $id;
var $recyclebin;
var $update_date;


   function Iht_contact_Model() {
      parent::Model();
      $this->obj =& get_instance();
      $this->_init_Iht_contact();

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

      $this->table_record_count = $this->record_count('iht_contact', $filters);

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
      $sql = 'SELECT * FROM iht_contact ' . $where_clause . $limit_clause;

      $query = $this->db->query($sql);

      if ($query->num_rows() > 0) {
         
         foreach ($query->result_array() as $row)      // Go through the result set
         {
						$query_results['name']		 = $row['name'];
			$query_results['address']		 = $row['address'];
			$query_results['email']		 = $row['email'];
			$query_results['phone']		 = $row['phone'];
			$query_results['mobile']		 = $row['mobile'];
			$query_results['subject']		 = $row['subject'];
			$query_results['content']		 = $row['content'];
			$query_results['create_date']		 = $row['create_date'];
			$query_results['status']		 = $row['status'];
			$query_results['id']		 = $row['id'];
			$query_results['recyclebin']		 = $row['recyclebin'];
			$query_results['update_date']		 = $row['update_date'];

			$results[]		 = $query_results;

         }

      }

      return $results;

   }


   // TODO: this won't be possible if there is no primary key for the table.
   function retrieve_by_pkey($idField) {

      $results = array();

      $query = $this->db->query("SELECT * FROM iht_contact WHERE id = '$idField' LIMIT 1");

      if ($query->num_rows() > 0) {
         $row = $query->row_array();

		$query_results['name']		 = $row['name'];
		$query_results['address']		 = $row['address'];
		$query_results['email']		 = $row['email'];
		$query_results['phone']		 = $row['phone'];
		$query_results['mobile']		 = $row['mobile'];
		$query_results['subject']		 = $row['subject'];
		$query_results['content']		 = $row['content'];
		$query_results['create_date']		 = $row['create_date'];
		$query_results['status']		 = $row['status'];
		$query_results['id']		 = $row['id'];
		$query_results['recyclebin']		 = $row['recyclebin'];
		$query_results['update_date']		 = $row['update_date'];

		$results		 = $query_results;


      }
      else {
         $results = false;
      }

      return $results;
   }


   function add( $data ) {

      // Build up the SQL query string
      $sql = $this->db->insert_string('iht_contact', $data);

      $query = $this->db->query($sql);

      return $this->db->insert_id();
   }

   function modify($keyvalue, $data) {

      // Build up the SQL query string
      $where = "id = $keyvalue";
      $sql = $this->db->update_string('iht_contact', $data, $where);

      $query = $this->db->query($sql);

   }

   function delete_by_pkey($idField, $user_id = '') {
      $query = $this->db->query("DELETE FROM iht_contact WHERE id = '$idField' ");

     return true;

   }

			function get_Name() {
		return $this->name;	}

	function set_Name($name) {
		$this->name = $name;	}

	function get_Address() {
		return $this->address;	}

	function set_Address($address) {
		$this->address = $address;	}

	function get_Email() {
		return $this->email;	}

	function set_Email($email) {
		$this->email = $email;	}

	function get_Phone() {
		return $this->phone;	}

	function set_Phone($phone) {
		$this->phone = $phone;	}

	function get_Mobile() {
		return $this->mobile;	}

	function set_Mobile($mobile) {
		$this->mobile = $mobile;	}

	function get_Subject() {
		return $this->subject;	}

	function set_Subject($subject) {
		$this->subject = $subject;	}

	function get_Content() {
		return $this->content;	}

	function set_Content($content) {
		$this->content = $content;	}

	function get_Create_date() {
		return $this->create_date;	}

	function set_Create_date($create_date) {
		$this->create_date = $create_date;	}

	function get_Status() {
		return $this->status;	}

	function set_Status($status) {
		$this->status = $status;	}

	function get_Id() {
		return $this->id;	}

	function set_Id($id) {
		$this->id = $id;	}

	function get_Recyclebin() {
		return $this->recyclebin;	}

	function set_Recyclebin($recyclebin) {
		$this->recyclebin = $recyclebin;	}

	function get_Update_date() {
		return $this->update_date;	}

	function set_Update_date($update_date) {
		$this->update_date = $update_date;	}



      function _init_Iht_contact()
      {
				$this->name = "";
		$this->address = "";
		$this->email = "";
		$this->phone = "";
		$this->mobile = "";
		$this->subject = "";
		$this->content = "";
		$this->create_date = "";
		$this->status = "";
		$this->id = "";
		$this->recyclebin = "";
		$this->update_date = "";

      }

      function _emptyIht_contact()
      {
				$this->name = "";
		$this->address = "";
		$this->email = "";
		$this->phone = "";
		$this->mobile = "";
		$this->subject = "";
		$this->content = "";
		$this->create_date = "";
		$this->status = "";
		$this->id = "";
		$this->recyclebin = "";
		$this->update_date = "";

      }

}

?>
