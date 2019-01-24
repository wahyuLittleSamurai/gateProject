 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Login extends CI_Controller {
	
     public function index() {
 
         // Fungsi Login
         $valid = $this->form_validation;
         $username = $this->input->post('txtUser');
         $password = $this->input->post('txtPassword');
         $valid->set_rules('txtUser','Username','required');
         $valid->set_rules('txtPassword','Password','required');
 
         if($valid->run()) {
             $this->simple_login->login($username,$password, base_url('dashboard'), base_url('login'));//panggil login di simple_login
         }
         // End fungsi login
         $this->load->view('v_login');
     }
 
     public function logout(){
         $this->simple_login->logout();
     }        
 }