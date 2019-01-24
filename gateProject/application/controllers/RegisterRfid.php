 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class RegisterRfid extends CI_Controller {
     
     function __construct(){
         parent::__construct();
         $this->load->library(array('form_validation'));
         $this->load->helper(array('url','form'));
		 $this->load->helper('date');
         $this->load->model('m_account'); //call model
     }
 
     public function index($dataRfid = NULL) {
		
         $this->form_validation->set_rules('rfidTag', 'RFID','required');
         if($this->form_validation->run() == FALSE) {
			 //if($this->input->post('btnSubmit') == "Get RFID")
			 //{
				//$this->load->view('welcome_message'); //ganti dengan ambil data rfid daftar di tbl register rfid
			 //}
			 //else
			 //{
			$data['user'] = $dataRfid;
			$this->load->view('v_registerRfid',$data);	
			 //}
             
         }else{
			 
			 date_default_timezone_set('Asia/Jakarta');
 
			 $datestring = '%Y/%m/%d - %h:%i %a';
		     $time = time();
			 $currentTime = mdate($datestring, $time);

             $data['rfid'] = $this->input->post('rfidTag');
			 $data['type'] = $this->input->post('type');
             $data['keterangan'] = $currentTime;
 
             $this->m_account->daftarRfid($data);
             
             $pesan['message'] =    "Pendaftaran berhasil";
             
             $this->load->view('welcome_message',$pesan);
         }
     }
	 public function addRfidDaftar($dataRfid)
	 {
		$data['user'] = $dataRfid;
		$this->load->view('v_registerRfid',$data);
	 }
	 public function delRfidDaftar($dataRfid)
	 {
		$this->m_account->delDataRfidBaru($dataRfid);
		return redirect('getRfidDaftar');
	 }
 }