<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class webcam extends CI_Controller {
  public function __construct() {
    parent::__construct();
	 $this->load->library(array('form_validation'));
	 $this->load->helper(array('url','form'));
	 $this->load->database();
	 $this->load->model('m_account'); //call model
	 
  }
	public function index() {
        $this->load->view('v_webcam');
     }
	public function saveImage(){
			
			$filename='test.jpg';
			$filepath='assets/images/'.$filename;
			$result=move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath);
           
        }
}