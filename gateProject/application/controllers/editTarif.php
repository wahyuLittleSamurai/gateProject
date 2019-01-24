 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class editTarif extends CI_Controller {
     
     function __construct(){
         parent::__construct();
         $this->load->library(array('form_validation'));
         $this->load->helper(array('url','form'));
		 $this->load->database();
         $this->load->model('m_account'); //call model
     }
 
     public function index() {
 
         $this->form_validation->set_rules('motor', 'MOTOR','required');
         $this->form_validation->set_rules('mobil','MOBIL','required');
         if($this->form_validation->run() == FALSE) {
			 $data['user'] = $this->m_account->collection_dataTarif();
             $this->load->view('v_editTarif',$data);
         }else{
 
             $data['motor'] =    $this->input->post('motor');
             $data['mobil'] =    $this->input->post('mobil');
 
             $this->m_account->editMotor($data);
             
             $pesan['message'] =    "Pendaftaran berhasil";
             
             $this->load->view('welcome_message',$pesan);
         }
     }
 }