<?php
date_default_timezone_set("Europe/Amsterdam");
include_once("includes/functions.php");
include_once("includes/Chibuike.php");
include_once("includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Print Pin</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="//code.jquery.com/jquery.js"></script>

		<!-- jQuery<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> 
		
	
	</head>
	<body>
	
		<div class="container">
			<div class="row">
				<div class=" col-md-12">	
				<div id="frmContent">
						
					
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form" id="pinForm" autocomplete="off">
						<legend class="text-center">PRINT GENERATED STUDENT PIN</legend>
								<?php 
								if ($_SERVER['REQUEST_METHOD']== 'POST') {
									$s_examno = xss_check_input($_POST['s_examno']);
									if(empty($s_examno)){
							       				 	$error="Enter Exam number";
							        				$html='<div class="alert alert-warning">
							                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							                        <strong>Error, '.$error.'</strong>
							                    </div>';

							      			  echo ($html);
							    				}

							    elseif(!check_valid_number($s_examno)){
        							$error="Please enter a valid examination number- no alphabets";
       								 $html='<div class="alert alert-warning">
                       							 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       							 <strong>Error, '.$error.'</strong> </div>';
           							 echo ($html);
      											  }

							    else {
							    				//search database to locate the exam no. if it exists
							    			 $o = new Chibuike($connect);
							    			 $num_rows = $o->record_exists('tblnew_intake_pins', 'examno', $s_examno);
							    			 if($num_rows > 0){
							    			 	$_SESSION['pid'] = $s_examno;
									            $html=' <div class="alert alert-success">
									                <strong>Succes::Examination number was found in the database. Pin already exists </strong> 
									                <a href="printout.php" class="btn-success btn btn-lg"><i glyphicon glyphicon-print></i> Print
									                </a></div> ';

									                 echo ($html);

									        }else {
									            $html=' <div class="alert alert-warning">
									                <strong>Warning:: Exam number not found in the database. Pin does not exists. </strong>.
									                 <a href="index.php" class="btn btn-warning btn-lg"><i glyphicon glyphicon-cog></i> 
									                Proceed to generate pin </a></div> ';

									                 echo ($html);
									        }

         
							    	}
				}	//end post if
										 ?>
							<div class="form-group">
							<label for="">Exam Number</label>
							<input type="text" name="s_examno" class="form-control" id="" placeholder="Examination Number"  required>
						</div>			
											
					<button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Search</button>
						
					</form>
					</div>
				</div>
			</div>
		</div>
			
		
		
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		
	</body>
</html>