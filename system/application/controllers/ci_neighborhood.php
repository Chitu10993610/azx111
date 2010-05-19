<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MODULE NAME   : Ci_neighborhood.php
 *
 * DESCRIPTION   : Ci_neighborhood module controller
 *
 * MODIFICATION HISTORY
 *   V1.0   2009-02-03 03:54 PM   - Pradesh Chanderpaul     - Created
 *
 * @package             Ci_neighborhood
 * @subpackage          ci_neighborhood component Class
 * @author              Pradesh Chanderpaul
 * @copyright           Copyright (c) 2006-2007 DataCraft Software
 * @license             http://www.datacraft.co.za/codecrafter/license.html
 * @link                http://www.datacraft.co.za/codecrafter/
 * @since               Version 1.0
 * @filesource
 */

class Ci_neighborhood extends Controller {

   /**
   * Contructor function
   *
   * Load the instance of CI by invoking the parent constructor
   *
   * @access      public
   * @return      none
   */
   function Ci_neighborhood() {
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
   // Description: Extracts a list of all ci_neighborhood data records and displays it.
   //
   // //////////////////////////////////////////////////////////////////////////
   function browse() {

      // ///////////////////////////////////////////////////////////////////////
      // Request the list from database. This is done by creating an instance of
      // ...the ci_neighborhood model and sending it a 'retrievelist' request.
      // ///////////////////////////////////////////////////////////////////////

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: If you are not using pagination, then set appropriate values for
      // NOTE: ...the $start and $limit_per_page values, or remove then from the
      // NOTE: ...function call.
      // ///////////////////////////////////////////////////////////////////////
      $start = $this->uri->segment(3,0);
      $limit_per_page = 10;

      $this->load->model('ci_neighborhoodmodel');                  // Instantiate the model
      $the_results['ci_neighborhood_list'] = $this->ci_neighborhoodmodel->findAll($start, $limit_per_page);  // Send the retrievelist msg
      // $the_results['rowcount'] = count($the_results['ci_neighborhood_list']);

      $this->load->library('layout');

      $this->layout->render_page('/ci_neighborhood/ci_neighborhoodgrid', $the_results);
      // NOTE: If you don't want to use the layout library, use the line below.
      // $this->load->view('/ci_neighborhood/ci_neighborhoodgrid', $the_results);

   }

   // //////////////////////////////////////////////////////////////////////////
   // Function: add()
   //
   // Description: Prompts user for input and adds a new ci_neighborhood entry
   //              ...onto the database.
   //
   // //////////////////////////////////////////////////////////////////////////
   function add() {

      $this->load->helper('url');

      $submit = $this->input->post('Submit');

      if ( $submit != false ) {
      	$this->load->library('form_validation');
      	
      	//field validates
      	//trim|required|min_length[5]|max_length[12]|xss_clean
		$this->form_validation->set_rules('neighborhood','Neighborhood', 'xss_clean');
      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
         
         $this->load->model('ci_neighborhoodmodel');

	     //delete all before insert 
	     $neighborhood	= $this->input->post('neighborhood', TRUE);
	     if(is_array($neighborhood) && sizeof($neighborhood)) {
	    	 $the_results = $this->ci_neighborhoodmodel->delete_all();
	    	 
	    	 $data['create_user']	= $this->session->userdata('userid');
			 $data['site_id']	= $this->session->userdata('site_id');
	    	 foreach ($neighborhood as $neigh) {
	    	 	if(!empty($neigh)) {
	    	 		$data['neighborhood'] = $neigh;
	    	 		$this->ci_neighborhoodmodel->add($data);
	    	 	}
	    	 }
	     }

         // $this->load->helper('url');
         redirect($this->input->post('site_name', TRUE).'config/modify', 'location');
      	}
      }
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
$this->form_validation->set_rules('neighborhood','Neighborhood', 'xss_clean');

      	
      	$this->form_validation->set_error_delimiters('<div class="error">','</div>');
      	if($this->form_validation->run() == TRUE) {
      	
         // ////////////////////////////////////////////////////////////////////
         // User is submitting data
         // Store the values from the form onto the db
         // ////////////////////////////////////////////////////////////////////
         $this->load->model('ci_neighborhoodmodel');

         // $data['action']          = 'modify';
         /*
		// XXS Filtering enforced for user input
		$data['id']		= $this->input->post('id', TRUE);
		$data['neighborhood']		= $this->input->post('neighborhood', TRUE);

         */
         $data = $this->_get_form_values();

         $this->ci_neighborhoodmodel->modify($data['id'], $data);

         redirect('/ci_neighborhood/', 'location');
      	}
      }
      //else {
         // We have to show the user the input form

         $idField = $this->uri->segment(3);

         $this->load->model('ci_neighborhoodmodel');
         $data = $this->ci_neighborhoodmodel->retrieve_by_pkey($idField);
         $data['action'] = 'modify';



		//         $this->load->library('layout');
		//         $this->layout->render_page('/ci_neighborhood/ci_neighborhooddetails', $data);
		$data['content'] = $this->load->view('/ci_neighborhood/ci_neighborhooddetails', $data, TRUE);
		
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

      $this->load->model('ci_neighborhoodmodel');
      $the_results = $this->ci_neighborhoodmodel->delete_by_pkey($idField);

      $this->load->helper('url');
      redirect('/ci_neighborhood/', 'location');

   }

   function _clear_form() {

      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Set default values for the form here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		$data['id']		= '';
		$data['neighborhood']		= '';

      return $data;

   }

   function _get_form_values() {
      // ///////////////////////////////////////////////////////////////////////
      // NOTE: Perform customisation on the retrieved form values here if you wish.
      // ///////////////////////////////////////////////////////////////////////
		// XXS Filtering enforced for user input
		$data['id']		= $this->input->post('id', TRUE);
		$data['neighborhood']		= $this->input->post('neighborhood', TRUE);

      return $data;

   }

}
?>