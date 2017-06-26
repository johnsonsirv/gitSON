<?php 
	 function xss_check_input($data){
		//checks and sanitises the url from the form  submission
			$data = trim($data);
			$data= stripslashes($data);
			$data = htmlspecialchars($data);

			return $data;

	}

	 function check_valid_number($data){
		///checks data for valid input from the user
			$valid= true;
				$data = xss_check_input($data);
				if (!is_numeric($data)){
					$valid = false;
				}

				return $valid;
	}

	 function check_valid_name($data){
		//checks data for a valid name. Only alphabets Aa - Zz allowed
		$valid= true;
		$data = xss_check_input($data);
			if (!preg_match("/[^A-Za-z]/", $data)){
				$valid = false;
			}

			return $valid;
	}
	

	 function generate_pin(){
		//generates pin for new_intake and old students. implements different ways of generating the pin
		//of same length. Len() =  9
		$digit = "";
		$a=random_int (random_int(1212, 4545), random_int(6767, 8989) );
        $z=random_int (random_int(23232, 34343), random_int(45454, 67676) );
        
        $key =  random_int($a, 9999);
        $end =  random_int($z, 99999);
        $digit = $key.$end;

        	return $digit;
    
	}


	 function check_valid_email ($data) {
		$valid = true;
		$data = xss_check_input($data);
		if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
 				$valid = true;
			} 

		return $valid;
	}

 ?>