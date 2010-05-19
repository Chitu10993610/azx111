<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : Ci_amenities.php
 *
 * DESCRIPTION   : Ci_amenities module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-02-03 03:55 PM   - Pradesh Chanderpaul     - Created
 *
 * @package             Ci_amenities
 * @subpackage          ci_amenities component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

class Ci_amenities extends Controller {

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Ci_amenities() {
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
   // Description: Extracts a list of all ci_amenities data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {

      // ///////////////////////////////////////////////////////////////////////
      // Request the list from database. This is done by creating an instance of
      // ...the ci_amenities model and sending it a 'retrievelist' request.
      // ///////////////////////////////////////////////////////////////////////

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: If you are not using pagination, then set appropriate values for
      // NOTE: ...the $start and $limit_per_page values, or remove then from the
      // NOTE: ...function call.
      // ///////////////////////////////////////////////////////////////////////
      $start = $this->uri->segment(3,0);
      $limit_per_page = 10;

      $this->load->model('ci_amenitiesmodel');                  // Instantiate the model
      $the_results['ci_amenities_list'] = $this->ci_amenitiesmodel->findAll($start, $limit_per_page);  // Send the retrievelist msg
      // $the_results['rowcount'] = count($the_results['ci_amenities_list']);

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set up the paging links. Just remove this if you don't need it,
      // NOTE: ...but you must remember to change the views too.
      // ///////////////////////////////////////////////////////////////////////
      $this->load->library('pagination');
      $this->load->helper('url');

      $config['base_url']     = site_url('ci_amenities/showall/');   // or just /ci_amenities/
      $config['total_rows']   = $this->ci_amenitiesmodel->table_record_count;
      $config['per_page']     = $limit_per_page;

      $this->pagination->initialize($config);

      $the_results['page_links'] = $this->pagination->create_links();


      // ///////////////////////////////////////////////////////////////////////
      // Print the results on the web page tmeplate. This is done by creating an
      // ...instance of the layout library and sending it a 'render_page' request
      // ///////////////////////////////////////////////////////////////////////
      $this->load->library('layout');

      $this->layout->render_page('/ci_amenities/ci_amenitiesgrid', $the_results);
      // NOTE: If you don't want to use the layout library, use the line below.
      // $this->load->view('/ci_amenities/ci_amenitiesgrid', $the_results);

   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new ci_amenities entry
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
		$this->form_validation->set_rules('amenities','Amenities', 'xss_clean');
      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
         
         $this->load->model('ci_amenitiesmodel');

	     //delete all before insert 
	     $neighborhood	= $this->input->post('neighborhood', TRUE);
	     if(is_array($neighborhood) && sizeof($neighborhood)) {
	    	 $the_results = $this->ci_amenitiesmodel->delete_all();
	    	 
	    	 $data['create_user']	= $this->session->userdata('userid');
			 $data['site_id']	= $this->session->userdata('site_id');
	    	 foreach ($neighborhood as $neigh) {
	    	 	if(!empty($neigh)) {
	    	 		$data['amenities'] = $neigh;
	    	 		
	    	 		$this->ci_amenitiesmodel->add($data);
	    	 	}
	    	 }
	     }

         // $this->load->helper('url');
         redirect($this->input->post('site_name', TRUE).'config/modify', 'location');
      	}
      }
      //else {
         // We have to show the user the input form
         /*
		$data['id']		= '';
		$data['amenities']		= '';

         */
         $data = $this->_clear_form();
         $data['action']       = 'add';



		//         $this->load->library('layout');
		//         $this->layout->render_page('/ci_amenities/ci_amenitiesdetails', $data);
		$data['content'] = $this->load->view('/ci_amenities/ci_amenitiesdetails', $data, TRUE);
		
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
$this->form_validation->set_rules('amenities','Amenities', 'xss_clean');

      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
      	
         // ////////////////////////////////////////////////////////////////////
         // User is submitting data
         // Store the values from the form onto the db
         // ////////////////////////////////////////////////////////////////////
         $this->load->model('ci_amenitiesmodel');

         // $data['action']          = 'modify';
         /*
		// XXS Filtering enforced for user input
		$data['id']		= $this->input->post('id', TRUE);
		$data['amenities']		= $this->input->post('amenities', TRUE);

         */
         $data = $this->_get_form_values();

         $this->ci_amenitiesmodel->modify($data['id'], $data);

         redirect('/ci_amenities/', 'location');
      	}
      }
      //else {
         // We have to show the user the input form

         $idField = $this->uri->segment(3);

         $this->load->model('ci_amenitiesmodel');
         $data = $this->ci_amenitiesmodel->retrieve_by_pkey($idField);
         $data['action'] = 'modify';



		//         $this->load->library('layout');
		//         $this->layout->render_page('/ci_amenities/ci_amenitiesdetails', $data);
		$data['content'] = $this->load->view('/ci_amenities/ci_amenitiesdetails', $data, TRUE);
		
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

      $this->load->model('ci_amenitiesmodel');
      $the_results = $this->ci_amenitiesmodel->delete_by_pkey($idField);

      $this->load->helper('url');
      redirect('/ci_amenities/', 'location');

   }

   function _clear_form() {

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set default values for the form here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		$data['id']		= '';
		$data['amenities']		= '';

      return $data;

   }

   function _get_form_values() {
      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Perform customisation on the retrieved form values here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		// XXS Filtering enforced for user input
		$data['id']		= $this->input->post('id', TRUE);
		$data['amenities']		= $this->input->post('amenities', TRUE);

      return $data;

   }

}
?>