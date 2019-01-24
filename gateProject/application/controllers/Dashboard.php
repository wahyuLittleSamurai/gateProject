<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Dashboard extends CI_Controller {
     function __construct(){
         parent::__construct();
		 
		 $this->load->helper('date');
         $this->load->model('m_account'); //call model
         //$this->simple_login->cek_login();
     }
 
     //Load Halaman dashboard
     public function index() {
         $this->load->view('welcome_message.php');
     }
	
	public function getDataFromArdu($getData)
	{
		date_default_timezone_set('Asia/Jakarta');
 
		$datestring = '%Y/%m/%d - %h:%i %a';
		$time = time();
		$currentTime = mdate($datestring, $time);
		
		$dataRfid = $getData;
		$data['rfid'] = $dataRfid;
		$data['time'] = $currentTime;
		
		$dataUser = $this->m_account->rfidInOut($dataRfid);
		
		$inputRfid = NULL;
		foreach($dataUser as $post)
		{
			$inputRfid = $post->id;
		}
		
		if(!empty($inputRfid))
		{
			$this->m_account->rfidInputOk($inputRfid);
			echo "sukses"; //untuk di baca oleh ethernet
		}
		else
		{
			$this->m_account->rfidRegister($getData);
		}
		
	}
	public function getAuto()
	{
		$valueMotor = $this->m_account->readAutoLoad('motorcycle');
		$valueCar = $this->m_account->readAutoLoad('car');
		$valueRfidObj = $this->m_account->readAutoLoadRfid();
		$valueTarif = $this->m_account->readTarif();
		
		$valueRfid = NULL;
		foreach($valueRfidObj as $post)
		{
			$valueRfid = $post->rfid;
		}
		
		$tarifMotor = NULL;
		$tarifMobil = NULL;
		foreach($valueTarif as $tarifSekarang)
		{
			$tarifMotor = $tarifSekarang->motor;
			$tarifMobil = $tarifSekarang->mobil;
		}
		
		$totalTarif = (((int)$tarifMotor * (int)$valueMotor) + ((int)$tarifMobil * (int)$valueCar))/1000; 
		
		echo "{ \"motorcycle\":\"".$valueMotor."\",\"car\":\"".$valueCar."\",\"rfid\":\"".$valueRfid."\"
				,\"total\":\"".$totalTarif."K"."\"
			}";
	}
 }