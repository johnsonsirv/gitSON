<?php 
	
	/**
	* 
	*/
	class Chibuike
	{
		public $ServerResponse;
		public $sql;
		public $bind;
		public $db;
		public $r_examno; public $r_candidatename; public $r_pin;
		public $createdat; public $createdby; //database audit
		function __construct($link)
		{
			$this->db = $link;
			//$this->ServerResponse = false;

		}

		public function InsertNewPin($exam_no, $candidate_name, $digit){
			//adds new pin to database

				$this->createdat = date('d-m-Y h:i:sa');
				$this->createdby = 'admin'; ///production will get the current sessiion id of the user
				$this->sql = "INSERT INTO tblnew_intake_pins VALUES(?,?,?,?,?)";
				$this->bind = $this->db->prepare($this->sql);
				$this->bind->bind_param('isiss',$exam_no, $candidate_name, $digit, $this->createdat, $this->createdby);

				$this->bind->execute() or die($this->db->connect_error);
				$this->ServerResponse = true;

			
				$this->bind->close();			
				return $this->ServerResponse;
		}


		public function record_exists($table_name, $key_field, $key_value ){
			//used to search if particular record exists in the database, using the key and the table name.

			$this->sql ="SELECT  $key_field FROM $table_name WHERE $key_field = ?";
			$this->bind = $this->db->prepare($this->sql);
			$this->bind->bind_param('i', $key_value);

			$this->bind->execute() or die($this->db->connect_error);
			$this->bind->store_result() or die($this->db->connect_error);

			$this->ServerResponse = $this->bind->num_rows;

			$this->bind->close();			
			return $this->ServerResponse;

		}


		public function fetch_print_record_if_exists($table_name, $key_field, $key_value){
			//fetch record if exists, and send result to the controller/view

			$this->sql ="SELECT  examno, candidatename, pin FROM $table_name WHERE $key_field = ?";
			$this->bind = $this->db->prepare($this->sql);
			$this->bind->bind_param('i', $key_value);

			$this->bind->execute() or die($this->db->connect_error);
			$this->bind->store_result() or die($this->db->connect_error);

			$this->bind->bind_result($this->r_examno, $this->r_candidatename, $this->r_pin);
				$this->bind->fetch();
			
			$this->bind->free_result();
			$this->bind->close();
			//return $this->ServerResponse;
		}

	}//end class
 ?>