 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class forgotpass extends CI_Controller {
     
     function __construct(){
         parent::__construct();
         $this->load->library(array('form_validation'));
         $this->load->helper(array('url','form'));
         $this->load->model('m_account'); //call model
		 $this->load->library('email');
     }
 
     public function index() {
 
         $this->form_validation->set_rules('username', 'USERNAME','required');
         if($this->form_validation->run() == FALSE) {
             $this->load->view('v_forgotpass');
         }else{
			
			
			// The mail sending protocol.
			$config['protocol'] = 'smtp';
			// SMTP Server Address for Gmail.
			$config['smtp_host'] = 'smtp.google.com';
			// SMTP Port - the port that you is required
			$config['smtp_port'] = '465';
			// SMTP Username like. (abc@gmail.com)
			$config['smtp_user'] = 'jamilwahyu53@gmail.com';
			// SMTP Password like (abc***##)
			$config['smtp_pass'] = 'echoAlpha';
			// Load email library and passing configured values to email library
			$this->load->library('email', $config);
			$this->email->set_newline("rn");
			// Sender email address
			$this->email->from('jamilwahyu53@gmail', 'yey bisa');
			// Receiver email address.for single email
			$emailTo = $this->input->post('username');
			$this->email->to($emailTo);
			// Subject of email
			$this->email->subject('coba coba aja');
			// Message in email
			$this->email->message('this is my way, if you are not like this, you can move for this');
			// It returns boolean TRUE or FALSE based on success or failure
			if ($this->email->send()) {
				//echo "got it";
				$this->load->view('welcome_message');
			} else {
				//echo "damn... it's not work with me ";
				$this->load->view('v_forgotpass');
			}
			
         }
     }
 }