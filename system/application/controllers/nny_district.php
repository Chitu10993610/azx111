<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : Nny_district.php
 *
 * DESCRIPTION   : Nny_district module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-03-17 06:22 PM   - Pradesh Chanderpaul     - Created
 *
 * @package             Nny_district
 * @subpackage          nny_district component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

class Nny_district extends Controller {

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Nny_district() {
      parent::Controller();
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
      // The default action is the showall action
      $this->browse();

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Load libraries and other libraries and helpers here. The
      // NOTE: ...generated code loads the database library as it requires it,
      // NOTE: ...but you may prefer to load here or autoload, In this case
      // NOTE: ...remember to delete all explicit load()s.
      // ///////////////////////////////////////////////////////////////////////
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: showall()
   //
   // Description: Extracts a list of all nny_district data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {

      // ///////////////////////////////////////////////////////////////////////
      // Request the list from database. This is done by creating an instance of
      // ...the nny_district model and sending it a 'retrievelist' request.
      // ///////////////////////////////////////////////////////////////////////

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: If you are not using pagination, then set appropriate values for
      // NOTE: ...the $start and $limit_per_page values, or remove then from the
      // NOTE: ...function call.
      // ///////////////////////////////////////////////////////////////////////
      $start = $this->uri->segment(3,0);
      $limit_per_page = 10;

      $this->load->model('nny_districtmodel');                  // Instantiate the model
      $the_results['nny_district_list'] = $this->nny_districtmodel->findAll($start, $limit_per_page);  // Send the retrievelist msg
      // $the_results['rowcount'] = count($the_results['nny_district_list']);

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set up the paging links. Just remove this if you don't need it,
      // NOTE: ...but you must remember to change the views too.
      // ///////////////////////////////////////////////////////////////////////
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['base_url']     = site_url('nny_district/showall/');   // or just /nny_district/
      $config['total_rows']   = $this->nny_districtmodel->table_record_count;
      $config['per_page']     = $limit_per_page;

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();


      // ///////////////////////////////////////////////////////////////////////
      // Print the results on the web page tmeplate. This is done by creating an
      // ...instance of the layout library and sending it a 'render_page' request
      // ///////////////////////////////////////////////////////////////////////
      $this->load->library('layout');

      $this->layout->render_page('/nny_district/nny_districtgrid', $the_results);
      // NOTE: If you don't want to use the layout library, use the line below.
      // $this->load->view('/nny_district/nny_districtgrid', $the_results);

   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new nny_district entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {

      $this->load->helper('url');

      // ///////////////////////////////////////////////////////////////////////
      // How are we being invoked. The user is either requesting a form or is
      // ...submitting it.
      // ///////////////////////////////////////////////////////////////////////
      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	//field validates
      	//trim|required|min_length[5]|max_length[12]|xss_clean
      	$this->form_validation->set_rules('id','Id', 'xss_clean');
$this->form_validation->set_rules('name','Name', 'xss_clean');
$this->form_validation->set_rules('province_id','Province_id', 'xss_clean');

      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
         
      	// ////////////////////////////////////////////////////////////////////
         // User is submitting data
         // Store the values from the form onto the db
         // ////////////////////////////////////////////////////////////////////
         $this->load->model('nny_districtmodel');

         /*
		// XXS Filtering enforced for user input
		$data['id']		= $this->input->post('id', TRUE);
		$data['name']		= $this->input->post('name', TRUE);
		$data['province_id']		= $this->input->post('province_id', TRUE);

         */
         $data = $this->_get_form_values();

         $this->nny_districtmodel->add($data);

         // $this->load->helper('url');
         redirect('/nny_district/', 'location');
      	}
      }
      //else {
         // We have to show the user the input form
         /*
		$data['id']		= '';
		$data['name']		= '';
		$data['province_id']		= '';

         */
         $data = $this->_clear_form();
         $data['action']       = 'add';



		//         $this->load->library('layout');
		//         $this->layout->render_page('/nny_district/nny_districtdetails', $data);
		$data['content'] = $this->load->view('/nny_district/nny_districtdetails', $data, TRUE);
		
		// Display in Template
		$this->load->view('template', $data);


//      }
   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: modify()
   //
   // Description: Controller function to process user modify requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function modify() {

      $this->load->helper('url');

      // ///////////////////////////////////////////////////////////////////////
      // How are we being invoked
      // ///////////////////////////////////////////////////////////////////////
      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	//field validates
      	//trim|required|min_length[5]|max_length[12]|xss_clean
      	$this->form_validation->set_rules('id','Id', 'xss_clean');
$this->form_validation->set_rules('name','Name', 'xss_clean');
$this->form_validation->set_rules('province_id','Province_id', 'xss_clean');

      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
      	
         // ////////////////////////////////////////////////////////////////////
         // User is submitting data
         // Store the values from the form onto the db
         // ////////////////////////////////////////////////////////////////////
         $this->load->model('nny_districtmodel');

         // $data['action']          = 'modify';
         /*
		// XXS Filtering enforced for user input
		$data['id']		= $this->input->post('id', TRUE);
		$data['name']		= $this->input->post('name', TRUE);
		$data['province_id']		= $this->input->post('province_id', TRUE);

         */
         $data = $this->_get_form_values();

         $this->nny_districtmodel->modify($data['id'], $data);

         redirect('/nny_district/', 'location');
      	}
      }
      //else {
         // We have to show the user the input form

         $idField = $this->uri->segment(3);

         $this->load->model('nny_districtmodel');
         $data = $this->nny_districtmodel->retrieve_by_pkey($idField);
         $data['action'] = 'modify';



		//         $this->load->library('layout');
		//         $this->layout->render_page('/nny_district/nny_districtdetails', $data);
		$data['content'] = $this->load->view('/nny_district/nny_districtdetails', $data, TRUE);
		
		// Display in Template
		$this->load->view('template', $data);


      //}
   }


   // //////////////////////////////////////////////////////////////////////////
   // Function: delete()
   //
   // Description: Controller function to process user delete requests
   //
   // //////////////////////////////////////////////////////////////////////////
   function delete() {
      $idField = $this->uri->segment(3);

      $this->load->model('nny_districtmodel');
      $the_results = $this->nny_districtmodel->delete_by_pkey($idField);

      $this->load->helper('url');
      redirect('/nny_district/', 'location');

   }

   function _clear_form() {

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set default values for the form here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		$data['id']		= '';
		$data['name']		= '';
		$data['province_id']		= '';

      return $data;

   }

   function _get_form_values() {
      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Perform customisation on the retrieved form values here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		// XXS Filtering enforced for user input
		$data['id']		= $this->input->post('id', TRUE);
		$data['name']		= $this->input->post('name', TRUE);
		$data['province_id']		= $this->input->post('province_id', TRUE);

      return $data;

   }

}
?>