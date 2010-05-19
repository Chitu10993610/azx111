<?php
 class Tinh_vy extends Controller
 {
 	function Tinh_vy(){
 		parent::Controller();
 		$this->load->model("iht_tinhmodel","tinhmodel");
 	}
 	function index(){
 		$data["query"] = $this->tinhmodel->get_all_tinh();
		$this->load->view("vy",$data);		
 	}
 } 
?>