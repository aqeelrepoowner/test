<?php
	
	function __autoload($className)
	{
		include_once $className.".php";
	}
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();

	if(isset($_POST['confirm_register']))
	{
		$student = new students();
		
		$returnValue = $student->addStudent($_POST);
		
		if($returnValue)
		{
			header("Location:view_students.php");
		}
		
	}
	
	$teacher = new teacher();
					
	$teacherDetails = $teacher->getTeacherDetails();	
			
				 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DarulHuda - Add Students</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	
	<!-- DarulHuda CSS here-->
	<link rel="stylesheet" href="css/darulhuda.css">
	
	<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
	<script>
		function validateStudents() {
		
			var isValid = true;
			
				$('input[type="text"]').each(function(){
				
				if($.trim($(this).val()) == '') {
					 isValid = false;
				}
				else
				{
					isValid = true;
				}
			});
			
			
			if(isValid == false)
			{
				$(".alert").attr("style","display:block;");
				$(".alert").html("Please fill all textboxes with values");
				$('html, body').animate({ scrollTop: 10}, 'swing');
				return false;
			}
			
				$('select').each(function(){
				
				if($.trim($(this).val()) == 'Please Select') {
					 isValid = false;
				}
				else
				{
					isValid = true;
				}
			});
			
			if(isValid == false)
			{
				$(".alert").attr("style","display:block;");
				$(".alert").html("Please fill all dropdown with values");
				$('html, body').animate({ scrollTop: 10}, 'swing');
				return false;
			}
			
			$('textarea').each(function(){
			
				if($.trim($(this).val()) == '') {
					 isValid = false;
				}
				else
				{
					isValid = true;
				}
			});
			
			if(isValid == false)
			{
				$(".alert").attr("style","display:block;");
				$(".alert").html("Please fill textarea with value");
				$('html, body').animate({ scrollTop: 10}, 'swing');
				return false;
			}
			
		}
	</script>
	
  </head>

  <body>
	
    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">DarulHuda</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
       <?php include_once "menu.php"; ?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Add Students <small>Enter Your Data</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li><a href="view_students.php"><i class="fa fa-dashboard"></i> View Students</a></li>
              <li class="active"><i class="fa fa-edit"></i>Add Students</li>
            </ol>
			<div class="alert alert-danger alert-dismissable" style="display:none;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>					
			</div>
            <!--<div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Visit <a class="alert-link" target="_blank" href="http://getbootstrap.com/css/#forms">Bootstrap's Form Documentation</a> for more information.
            </div>-->
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-6">
			<h4>Personal Details</h4>
            <form role="form" method="post" action="" name="students" onsubmit="return validateStudents();">

              <div class="form-group">
                <label>First Name</label>
                <input class="form-control" name="first_name" placeholder="Enter text">
                <p class="help-block"></p>
              </div>

			<div class="form-group">
                <label>Middle Name</label>
                <input class="form-control" name="middle_name" placeholder="Enter text">
                <p class="help-block"></p>
              </div>
			  
			<div class="form-group">
                <label>Last Name</label>
                <input class="form-control" name="last_name" placeholder="Enter text">
                <p class="help-block"></p>
              </div>
			  
			   <div class="form-group">
                <label>Gender</label>
                <select class="form-control select_form" name="gender" placeholder="Enter text">
					<option>Please Select</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </div>
			  
			
			<div class="form-group">
                <label>Date of Birth</label>
				  
			  <input id="dob" name="dob" type="text" class="form-control">
              	 
                <p class="help-block"></p>
              </div>
			  
			 <div class="form-group">
                <label>Address</label>
                 <textarea class="form-control" placeholder="Enter text" rows="3" name="address"></textarea>
                <p class="help-block"></p>
              </div> 
			 
			 
              <div class="form-group">
                <label>Contact No</label>
                <input class="form-control" placeholder="Enter text" name="contact_no">
              </div>

        
			  <div style="" >
			  <label>Your fees for maktab is </label>
				<label>Rs. 200/-</label>
	
				
			  </div>
           <input type="submit" class="btn btn-default btn-success" name="confirm_register" value="Confirm Registration">
              <button type="reset" class="btn btn-default btn-danger">Reset Button</button>  

          </div>
          <div class="col-lg-6">
		  
            <h4>Academic Details</h4>
			 <div class="form-group">
<label>Academic Year</label>
				<select name="academic_year" id="year" class="form-control select_form">
				<option>Please Select</option>
					<?php
						$i = STARTYEAR;
						
						while($i < ENDYEAR)
						{
							$j = $i+1;
							
							echo "<option>".$i."-".$j."</option>";
							
							$i = $j;
						}
					?>
				</select>
                <p class="help-block"></p>
				</div>
               <div class="form-group">
                <label>Maktab Course</label>
                <select class="form-control" name="maktab_course" placeholder="Enter text">
					<option>Please Select</option>
                 <?php
				 $course = new course();
				 
				 $coursedetails = $course->getCourseDetails();
				 foreach($coursedetails as $value){
				 echo "<option value=".$value['course_id'].">".$value['course_name']."</option>";
				 }
				 ?>
				 
				 
                </select>
              </div>
			  
			  <div class="form-group">
                <label>Maktab Location</label>
                <select class="form-control" name="maktab_location" placeholder="Enter text">
					<option>Please Select</option>
					<option value="AR">Arshiya</option>
					<option value="AJ">Ajmera</option>
				</select>
              </div>
			 
			      <div class="form-group">
                <label>Teacher</label>
				  
                <select class="form-control" name="teacher_name" placeholder="Enter text">
					<option>Please Select</option>
						<?php 
							foreach($teacherDetails as $value)
							{	
								echo "<option value=".$value['teacher_id'].">".$value['qualification']." ".$value['teacher_first_name']." ".$value['teacher_last_name']. "</option>";
							}
						?>
                </select>
              </div>
			  
			  
			  
			  
			 <div class="form-group">
                <label>Are you willing to opt for Maktab Bus Facility</label>
                <label class="radio-inline">
                  <input type="radio" name="bus_facility" id="optionsRadiosInline1" value="Yes" checked> Yes
                </label>
                <label class="radio-inline">
                  <input type="radio" name="bus_facility" id="optionsRadiosInline2" value="No"> No
                </label>
               
              </div>

			  <div class="form-group">
                <label>School Name</label>
                <input class="form-control" placeholder="Enter text" name="school_name">
              </div>
			  
			  <div class="form-group">
                <label>School Class</label>
                <input class="form-control" placeholder="Enter text" name="school_class">
              </div>
			  
			  <div class="form-group">
                <label>School Medium</label>
                <input class="form-control" placeholder="Enter text" name="school_medium">
              </div>
			  
			
             
            </form>
            
            <p>Terms and Conditions of Maktab <a href="">Click here </a></p>

          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
	 <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
	<script>
		$(document).ready(function()
		{	
			$("#menu_students").attr("class","active");
		});
	</script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<script>
	$(function() {
			$("#registration_date").datepicker();
			$("#registration_date").datepicker("setDate", new Date);
			$("#dob").datepicker();
		});
	</script>
	
  </body>
</html>