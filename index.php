<?php ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

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
					
					<form method="POST" role="form" id="pinForm" autocomplete="off">
						<legend>GENERATE STUDENT PIN</legend>
						<span id="error_log"></span>
					
						<div class="form-group">
							<label for="">Exam Number</label>
							<input type="text" name="examno" class="form-control" id="" placeholder="Examination Number" required >
						</div>
						<div class="form-group">
							<label for="">Candidate Name</label>
							<input type="text" name="candidatename" class="form-control" id="" placeholder="Candidate Name" required>
						</div>
					
						
					
					<button class="btn btn-primary btn-block btn-large">Submit</button>
						<button type="reset" class="btn btn-large btn-block btn-primary">Reset</button>
					</form>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">WARNING</h3>
			</div>
			<div class="panel-body">
				<p><h3 class="text-primary text-muted">
					Before you proceed to generate student pin, ensure that a pin has not been generated before for that examination number </h3>
					 <i class="glyphicon glyphicon-bell"></i> The "SUBMIT" button will be disabled, if a pin already exists for the examination number </p>
					<a class="btn btn-large btn-block btn-info" href="printgeneratedpin.php" role="button"><strong class="text-primary text-success">Click here to verify exam number first.</strong></a>

				
			</div>
		</div>
			
			<script type="text/javascript" language="javascript">
		
				$(document).ready(function() {
					
						$('#pinForm').submit(function(event) {
							event.preventDefault();

							//call form validation here
							/** 1. ensure that student exam number is a valid numeric value 
								2. Ensure that the candidate name is a valid string value. 
								3. Does not contain special characters	-/!@#$%&^*()_+|\?></,. **/


							$.ajax({
								url: 'generatepin.php',
								type: 'POST',
								dataType: 'html',
								data: $(this).serialize(),
							})

							.done(function(data) {
								$('#error_log').fadeIn('slow').html(data)				
							
							})
							.fail(function() {
								$('#error_log').fadeIn('slow').html('Ajax engine  failed')
							})
							.always(function() {
								
							});
							
						});
				
					
				});
					
					
				
			
		</script>


	
		
		 
		
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		
	</body>
</html>