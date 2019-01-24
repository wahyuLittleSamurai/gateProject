 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class getRfidDaftar extends CI_Controller {
     
     function __construct(){
         parent::__construct();
         $this->load->library(array('form_validation'));
         $this->load->helper(array('url','form'));
		 $this->load->database();
         $this->load->model('m_account'); //call model
     }
 
     public function index() {
 
         $this->data['posts'] = $this->m_account->collection_newRfid(); 
		 $this->load->view('v_getRfidDaftar', $this->data); 
		
     }
 }