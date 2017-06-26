<?php
date_default_timezone_set("Europe/Amsterdam");
include_once("includes/functions.php");
include_once("includes/Chibuike.php");
include_once("includes/config.php");
if( $_SERVER['REQUEST_METHOD']== 'POST' ){
 
    $examno = xss_check_input($_POST['examno']);
    $candidatename = xss_check_input($_POST['candidatename']);
    
        //call form validation here
                            /** 1. ensure that student exam number is a valid numeric value 
                                2. Ensure that the candidate name is a valid string value. 
                                3. Does not contain special characters  -/!@#$%&^*()_+|\?></,. **/

    if( empty($examno)){
        $error="Please fill in all fields";
        $html='<div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Error, '.$error.'</strong>
                    </div>';

        echo ($html);
    }
    elseif(empty($candidatename)){
        $error="Please fill in all fields";
        $html='<div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Error, '.$error.'</strong>
                    </div>';

        echo ($html);
    }

    
    elseif(!check_valid_number($examno)){
        $error="Please enter a valid examination number- no alphabets";
        $html='<div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Error, '.$error.'</strong>
                    </div>';
            echo ($html);
        }

    elseif (check_valid_name($candidatename)) {
          $error="Candidate name is not valid. Alphates A-Z only";
           $html='<div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Error, '.$error.'</strong>
                    </div>';
            echo ($html);
}
else{
   
      //save generated pin to database
        $o = new Chibuike($connect);
        $num_rows = $o->record_exists('tblnew_intake_pins', 'examno', $examno);
        if($num_rows <= 0){
           if ($o->InsertNewPin($examno, $candidatename, generate_pin())) {
            $html=' <div class="alert alert-info">
                <strong>Success. Data Saved. </strong>, Pin Generated '.generate_pin().'<a href="printgeneratedpin.php" class="btn-success btn btn-lg"><i glyphicon glyphicon-print></i> Print </a> <a href="index.php" class="btn btn-warning btn-lg"><i glyphicon glyphicon-print></i> Continue with Pin generation </a></div> ';
                     }
        }else {
            $html=' <div class="alert alert-warning">
                <strong>Error. Data Not Saved. Record already exists in database!!</strong>.  <a href="index.php" class="btn btn-warning btn-lg"><i glyphicon glyphicon-remove></i> 
                Try Again</a></div> ';
        }

            echo ($html);
    }



}
?>