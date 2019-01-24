  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
 
  class M_account extends CI_Model{

       function daftar($data)
       {
            $this->db->insert('tbladmin',$data);
       }
	   function daftarRfid($data)
       {
            $this->db->insert('tblrfid',$data);
			$this->db->where('rfid', $data['rfid']);
			$this->db->delete('tblregistrasirfid');	
       }
	   function delDataRfidBaru($data)
       {
			$this->db->where('rfid', $data);
			$this->db->delete('tblregistrasirfid');	
       }
	   
	   function collection_data()
	   {
			 $this->db->select("id,rfid,type,posisi,keterangan"); 
			 $this->db->from('tblrfid');
			 $this->db->where('type','car');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function collection_reportDataMotor()
	   {
			 $this->db->select("id,rfid,type,posisi,keterangan"); 
			 $this->db->from('tblrfid');
			 $this->db->where('type','motorcycle');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function collection_dataMotor()
	   {
			 $this->db->select("id,rfid,type,time"); 
			 $this->db->from('tblrfidardu');
			 $this->db->where('type','motorcycle');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function collection_dataCar()
	   {
			 $this->db->select("id,rfid,type,time"); 
			 $this->db->from('tblrfidardu');
			 $this->db->where('type','car');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function collection_dataCarAndMotor()
	   {
			 $this->db->select("id,rfid,type,time"); 
			 $this->db->from('tblrfidardu');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function collection_dataAll()
	   {
			 $this->db->select("id,rfid,type,posisi,keterangan"); 
			 $this->db->from('tblrfid');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function collection_newRfid()
	   {
			 $this->db->select("id,rfid,waktu"); 
			 $this->db->from('tblregistrasirfid');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function collection_dataTarif()
	   {
			 $this->db->select("id,motor,mobil"); 
			 $this->db->from('tbltarif');
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function editMotor($data)
	   {
			$this->db->update('tbltarif',$data);
	   }
	   function rfidInOut($data)
	   {
			$this->db->select('id');
			$this->db->from('tblrfid');
			$this->db->where('rfid',$data);
			$query=$this->db->get();
			return $query->result();
			//return $query->num_rows();
	   }
	   function rfidInputOk($data)
	   {
			date_default_timezone_set('Asia/Jakarta');
 
			$datestring = '%Y/%m/%d - %h:%i %a';
			$time = time();
			$currentTime = mdate($datestring, $time);
		
			$this->db->select('*');
			$this->db->from('tblrfid');
			$this->db->where('id',$data);
			$query=$this->db->get();
			
			foreach ($query->result() as $row)
			{  
				$currentRfid = $row->rfid;  
				$currentType = $row->type;   
			}            
			$data = array(
					'rfid' => $currentRfid,
					'type' => $currentType,
					'time' => $currentTime
			);
			$this->db->insert('tblrfidardu',$data); //masukan ke table rfidardu
			
			
			$this->db->set('rfid', $currentRfid);
			$this->db->update('tblsementara'); //masukan ke table penyimpanan sementara

	   }
	   function rfidRegister($dataRfidBaru)
	   {
			date_default_timezone_set('Asia/Jakarta');
 
			$datestring = '%Y/%m/%d - %h:%i %a';
			$time = time();
			$currentTime = mdate($datestring, $time);
			
			$data = array(
					'rfid' => $dataRfidBaru,
					'waktu' => $currentTime
			);
			$this->db->insert('tblregistrasirfid',$data); //masukan ke table registrasi rfid
	   }
	   function readAutoLoad($data)
	   {
			$this->db->select('*');
			$this->db->from('tblrfidardu');
			$this->db->where('type',$data);
			$query=$this->db->get();
			return $query->num_rows();
	   }
	   function readAutoLoadRfid()
	   {
			$this->db->select('rfid');
			$this->db->from('tblsementara');
			$query=$this->db->get();
			return $query->result();
	   }
	   function readTarif()
	   {
			$this->db->select('*');
			$this->db->from('tbltarif');
			$query=$this->db->get();
			return $query->result();
	   }
	  
  }