<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends Controller {
	
	public $site_name = '';

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function ajax() {
      parent::Controller();
      $this->load->helper('html');
   }

   /**
   * "Index" Page
   *
   * Default class action
   *
   * @access      public
   * @return      none
   */

   function index() {
    exit;
   }
   
   	//get district
   	function district () {
   		$provinId = (int)$this->uri->segment(3,0);
		$this->load->model('iht_district_model');
		$filter = ' WHERE p.id = '.$provinId;
		$data['districtOption'] = $this->iht_district_model->findByFilter($filter);	
		$page_req = 'ajax/district';
		$this->_display($page_req, $data);
   	}
   	
   	//get get area
   	function area () {
   		$districtId = (int)$this->uri->segment(3,0);
		$this->load->model('iht_area_model');
		$filter = ' WHERE district_id = '.$districtId;
		$data['areaOption'] = $this->iht_area_model->findByFilter($filter);
		$page_req = 'ajax/area';
		$this->_display($page_req, $data);
   	}
   	
   	    // private function, format data to template
	function _display($page_req, $data = array()) {
		
		$ary['content'] = $this->load->view($page_req, $data, TRUE);
		exit(json_encode($ary));
	}

}
?>