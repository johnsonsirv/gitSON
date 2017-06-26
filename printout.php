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
					<div class="col-md-12">	
					<div id="printResult">
						<?php 
								//fetch the pid and validate status as ok.
							if (isset($_SESSION['pid'] )) {
									//use the [id to fetch the details from the model.]
									$pid = $_SESSION['pid'];
									 $o = new Chibuike($connect);
							    	 $num_rows = $o->record_exists('tblnew_intake_pins', 'examno', $pid);
									if ($num_rows  > 0 ){
											//record was found. fetch the data
											$o->fetch_print_record_if_exists('tblnew_intake_pins', 'examno', $pid);									
									}else{
										//record exists engine did not find the pid[examiniation number specified]. Redirect to search if generate pin
										/*echo '<script type="text/javascript"> alert ("Could not find the pid[examiniation number specified]. You will be redirected to generate new pin."); </script>';*/

										header('Location:index.php');
									}
											
							}
							else {
								header('Location:printgeneratedpin.php'); // redirect to the print generated  pin page if session['pid'] is unset
							}

						 ?>
					
				
								<div class="panel panel-success">
										<table class="table table-hover table-responsive table-striped table-bordered">
										
											<tbody>
											<tr class="text-primary text-center">
												<td colspan="2"><h2>STUDENT RESULT PIN</h2></td>
											</tr>
												<tr>
													<td width="40%">EXAMINATION NUMBER</td>	
													<td><strong><?php echo ($o->r_examno); ?></strong></td>
												</tr>
												<tr>
													<td>CANDIDATE NAME</td>	
													<td><strong><?php echo ($o->r_candidatename); ?></strong></td>
												</tr>

												<tr class="text-center text-info">
													<td colspan="2"><h2 class=" text-primary text-success"><?php echo ($o->r_pin); ?></h2> </td>	
													
												</tr>

												<tr>
													<td colspan="2">  

														<ol>
															<strong class="text-jsustify">How to Use the Pin</strong>
															<li> Visit <b class="text-info">www.sonnauthportal.com</b>  </li>
															<li>Click on <b class="text-info">Old Student Login</b> or <b class="text-info">New Intake Login</b></li>
															<li>Enter your <b>Examination number and PIN</b>.</li>
															<li> Click on <b class="text-info"> Submit </b></li>

														</ol>
													</td>	
													
												</tr>
											</tbody>
										</table>

										<button type="button" class="btn btn-success btn-block btn-large" onclick="javascript:window.print()"><i class="glyphicon glyphicon-print"></i> PRINT </button>
							</div>
					
						</div>
					</div>
				</div>
			</div>
			<?php unset($_SESSION['pid']); ?>
<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		
	</body>
</html>