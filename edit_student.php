<?php
	
	function __autoload($className)
	{
		include_once $className.".php";
	}
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();

	
	if(isset($_POST['student_update']))
	{
		$student = new students();
		
		$args = array(
			'first_name' => FILTER_SANITIZE_STRING, 
  'middle_name' => FILTER_SANITIZE_STRING,
  'last_name' => FILTER_SANITIZE_STRING,
  'gender' => FILTER_SANITIZE_STRING,
  'dob' => FILTER_SANITIZE_STRING,
  'address' => FILTER_SANITIZE_STRING,
  'contact_no' => FILTER_VALIDATE_INT,
  'academic_year' =>FILTER_SANITIZE_STRING,
  'maktab_course' =>FILTER_VALIDATE_INT,
  'maktab_location' => FILTER_SANITIZE_STRING,
  'teacher_name' => FILTER_VALIDATE_INT,
  'bus_facility' => FILTER_SANITIZE_STRING,
  'school_name' => FILTER_SANITIZE_STRING,
  'school_class' =>FILTER_VALIDATE_INT,
  'school_medium' => FILTER_SANITIZE_STRING,
  'student_id' => FILTER_VALIDATE_INT
		);

		$postData = filter_var_array($_POST, $args);
		
		//var_dump($postData);exit;
		
		$returnValue = $student->updateStudent($postData);
		
		
		header("Location:view_students.php");
	
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

    <title>DarulHuda - Edit Student</title>

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
            <h1>Edit Students <small>Enter Your Data</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li><a href="view_students.php"><i class="fa fa-dashboard"></i> View Students</a></li>
              <li class="active"><i class="fa fa-edit"></i>Edit Student</li>
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
			<?php
			
				$student = new students();
				
				$args = array("student_id" => FILTER_SANITIZE_STRING);
					
				$safeStudID = filter_var_array($_GET,$args);				  
				
				$studentDetails = $student->getStudentById($safeStudID['student_id']);
				
			?>
        <div class="row">
          <div class="col-lg-6">
			<h4>Personal Details</h4>
            <form role="form" method="post" action="" name="students" onsubmit="return validateStudents();">

              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="first_name" placeholder="Enter text" value="<?php echo $studentDetails['first_name']; ?>">
                <p class="help-block"></p>
              </div>

			<div class="form-group">
                <label>Middle Name</label>
                <input type="text" class="form-control" name="middle_name" placeholder="Enter text" value="<?php echo $studentDetails['father_name']; ?>">
                <p class="help-block"></p>
              </div>
			  
			<div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter text" value="<?php echo $studentDetails['last_name']; ?>">
                <p class="help-block"></p>
              </div>
			  
			   <div class="form-group">
                <label>Gender</label>
                <select class="form-control select_form" name="gender" placeholder="Enter text">
					<option>Please Select</option>
					<?php $gender = array("Male","Female");
							
						foreach($gender as $value) {	
							
							if($studentDetails['gender'] == $value)
								echo "<option selected='selected'>".$value."</option>";
							else
								echo "<option>".$value."</option>";
						}		
					?>
						
                </select>
              </div>
			  
			
			<div class="form-group">
                <label>Date of Birth</label>
				  
			  <input id="dob" name="dob" type="text" class="form-control" value="<?php $date = new DateTime($studentDetails['dob']); echo $date->format('d-m-Y'); ?>">
              	 
                <p class="help-block"></p>
              </div>
			  
			 <div class="form-group">
                <label>Address</label>
                 <textarea class="form-control" placeholder="Enter text" rows="3" name="address"><?php  echo $studentDetails['address']; ?></textarea>
                <p class="help-block"></p>
              </div> 
			 
			 
              <div class="form-group">
                <label>Contact No</label>
                <input type="text" class="form-control" placeholder="Enter text" name="contact_no" value="<?php echo $studentDetails['contact_no']; ?>">
              </div>

        
			  <div style="" >
			  <label>Your fees for maktab is </label>
				<label>Rs. 200/-</label>
	
				
			  </div>
           <input type="submit" class="btn btn-default btn-success" name="confirm_register" value="Confirm Update">
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
							if($studentDetails['academic_year'] == $i."-".$j)
								echo "<option selected='selected'>".$i."-".$j."</option>";
							else
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
				 
					if($studentDetails['mst_course_course_id'] == $value['course_id'])
						echo "<option selected='selected' value=".$value['course_id'].">".$value['course_name']."</option>";
					else
						echo "<option value=".$value['course_id'].">".$value['course_name']."</option>";
				}
				 ?>
				 
				 
                </select>
              </div>
			  
			  
			  <?php
				$location = array("AR"=>MAKTAB_LOCATION1,"AJ" => MAKTAB_LOCATION2);
			  ?>
			  <div class="form-group">
                <label>Maktab Location</label>
                <select class="form-control" name="maktab_location" placeholder="Enter text">
					<option>Please Select</option>
					<?php
					foreach($location as $key => $value) {
					
					if($studentDetails['school_location'] == $key)	
						echo "<option selected='selected' value=".$key.">".$value."</option>";
					else
						echo "<option value=".$key.">".$value."</option>";
					
					}
					?>
					 </select>
              </div>
			  
			
			  
			      <div class="form-group">
                <label>Teacher</label>
				  
                <select class="form-control" name="teacher_name" placeholder="Enter text">
					<option>Please Select</option>
						<?php 
							foreach($teacherDetails as $value)
							{	
								if($studentDetails['mst_teacher_teacher_id'] == $value['teacher_id'])
									echo "<option selected='selected'  value=".$value['teacher_id'].">".$value['qualification']." ".$value['teacher_first_name']." ".$value['teacher_last_name']. "</option>";
								else
									echo "<option  value=".$value['teacher_id'].">".$value['qualification']." ".$value['teacher_first_name']." ".$value['teacher_last_name']. "</option>";
							}
						?>
                </select>
              </div>
			  
			  
			  
			  
			 <div class="form-group">
                <label>Are you willing to opt for Maktab Bus Facility</label>
                
				<label class="radio-inline">
					<?php if($studentDetails['bus_facility'] == 1) { ?> 
						<input type="radio" name="bus_facility" id="optionsRadiosInline1" value="Yes" checked> Yes
					<?php } else { ?>
						<input type="radio" name="bus_facility" id="optionsRadiosInline1" value="Yes"> Yes
					<?php } ?>	
                </label>
                <label class="radio-inline">
					<?php if($studentDetails['bus_facility'] == 0) { ?> 
						<input type="radio" name="bus_facility" id="optionsRadiosInline2" value="No" checked> No
					<?php } else { ?>
						<input type="radio" name="bus_facility" id="optionsRadiosInline2" value="No"> No
					<?php } ?>	
                </label>
               
              </div>

			  <div class="form-group">
                <label>School Name</label>
                <input type="text" class="form-control" placeholder="Enter text" name="school_name" value="<?php echo $studentDetails['school_name']; ?>">
              </div>
			  
			  <div class="form-group">
                <label>School Class</label>
                <input type="text" class="form-control" placeholder="Enter text" name="school_class"  value="<?php echo $studentDetails['year_of_class']; ?>">
              </div>
			  
			  <div class="form-group">
                <label>School Medium</label>
                <input type="text" class="form-control" placeholder="Enter text" name="school_medium" value="<?php echo $studentDetails['medium_of_school']; ?>">
              </div>
			  
				<input type="hidden" name="student_update" value="1">
				<input type="hidden" name="student_id" value="<?php echo $_GET['student_id'] ?>">
             
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