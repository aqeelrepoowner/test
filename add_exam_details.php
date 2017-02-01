<?php

	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if($_POST['action'] == "save_exam_details")
		{	
			$exam = new exam();

			$exam->addExamDetails($_POST);
		}
	}
?>
<script>
	function addExamDetails()
	{	
		var rollNo = $("#roll_number").val();
		
		var courseId = $("select[name=maktab_course]").val();
		
		var studName = $("#stud_name").val();
		
		var academicYear = $("select[name=academic_year]").val();
		
		var exam_type =  $("select[name=exam_type]").val();
		
		if(courseId != "Please Select" && courseId != "")
		{
			if(rollNo != "" && studName == "")
			{
				$.post("ajax.php", { action:"exam_details",roll_number:rollNo,courseId:courseId,academic_year:academicYear,exam_type:exam_type})	
				.done(function(data) {	
							
						alert(data);
				
				if(data == 3)
				{
					$(".alert").attr("style","display:block;");
				
					$(".alert").html('More than one student with same name  ');
					
					$(".alert").after('<a href="#" class="btn btn-info btn-setting">Click for dialog</a>');
					
					document.getElementById('examDetails').innerHTML = "";
				}
				else
				if(data == 1)
				{
					$(".alert").attr("style","display:block;");
				
					$(".alert").html("Incorrect filter submitted!   <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>X</button>");
					document.getElementById('examDetails').innerHTML = "";
				}
				else
				if(data == 2)
				{
					$(".alert").attr("style","display:block;");
				
					$(".alert").html("Exam details already exists!   <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>X</button>");
					document.getElementById('examDetails').innerHTML = "";
				}
					else
					{
				
					document.getElementById('examDetails').innerHTML = data;
					$(".alert").attr("style","display:none;");
				
					$(".alert").html("");
			
					}
				});
				
				
			}
			else
			if(studName != "" && rollNo == "")
			{
				$.post("ajax.php", { action:"exam_details",courseId:courseId,academic_year:academicYear,exam_type:exam_type,student_name:studName})	
				.done(function(data) {	
				
				alert(data);
				
				if(data == 3)
				{
					$(".alert").attr("style","display:block;");
				
					$(".alert").html("More than one student with same name");
					document.getElementById('examDetails').innerHTML = "";
				}
				else
				if(data == 1)
				{
					$(".alert").attr("style","display:block;");
				
					$(".alert").html("Incorrect filter submitted!");
					document.getElementById('examDetails').innerHTML = "";
				}
				else
				if(data == 2)
				{
					$(".alert").attr("style","display:block;");
				
					$(".alert").html("Exam details already exists!");
					document.getElementById('examDetails').innerHTML = "";
				}
					else
					{
				
					document.getElementById('examDetails').innerHTML = data;
					$(".alert").attr("style","display:none;");
				
					$(".alert").html("");
			
					}
				});
				
				
			}
			else
			if(studName != "" && rollNo != "")
			{
				$.post("ajax.php", { action:"exam_details",roll_number:rollNo,courseId:courseId,academic_year:academicYear,exam_type:exam_type,student_name:studName})	
				.done(function(data) {	
					alert(data);
				
				if(data == 3)
				{
					$(".alert").attr("style","display:block;");
				
					$(".alert").html("More than one student with same name  ");
					
					document.getElementById('examDetails').innerHTML = "";
				}
				else
				if(data == 1)
				{
					$(".alert").attr("style","display:block;");
				
					$(".alert").html("Incorrect filter submitted!");
					
					document.getElementById('examDetails').innerHTML = "";
				}
				else
				if(data == 2)
				{
					$(".alert").attr("style","display:block;");
				
					$(".alert").html("Exam details already exists!");
					
					document.getElementById('examDetails').innerHTML = "";
				}
					else
					{
				
					document.getElementById('examDetails').innerHTML = data;
					$(".alert").attr("style","display:none;");
				
					$(".alert").html("");
			
					}
				});
				
			
			
			}
			else
			{
				$("#examDetails").html("");
				
				$(".alert").attr("style","display:block;");
				
				$(".alert").html("Atleast enter Roll number or Student Name");
			}
		}
		else
		{
				$("#examDetails").html("");
				
				$(".alert").attr("style","display:block;");
				
				$(".alert").html("Course Name must not be empty");
		}
		
		}
		function validateExam() {
			
			var marksObtained = document.getElementsByClassName("marks_obtained");
			var totalMarks = document.getElementsByClassName("total_marks");
			var isValid = true;
			for(var i = 0;i < marksObtained.length;i++) {
				if(marksObtained[i].value == "" || totalMarks[i].value == "") {
					isValid = false;
				}
			}
				
			if(!isValid){
				//$("#examDetails").html("");
				
				$(".alert").attr("style","display:block;");
				
				$(".alert").html("Exam details must not be empty");
				$('html, body').animate({ scrollTop: 10}, 'swing');
				
				return false;
			}	
			
		}
</script>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Darul Huda - Examination History</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
	 <link href="css/fees_payment_history.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	
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
          <a class="navbar-brand" href="index.php">Darul Huda</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
		<?php
			include_once "menu.php";
		?>
	 
		<!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Examination History</h1><small style="background-color:rgb(245, 245, 245);padding:5px;float:right;color:red;">Please select course and roll no from below form</small>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Home</a></li>
              <li class="active"><i class="icon-file-alt"></i>Exams</li>
			  <li class="active"><i class="icon-file-alt"></i>Examination History</li>
            </ol>
		
			    <div class="alert alert-danger alert-dismissable" style="display:none;">
				
				</div>
          </div>
		
			<form method="post" action="" onsubmit="return validateExam();">
		   
			<div class="col-lg-4"> 
			
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
                <label>Enter roll number of the student</label>
				<?php $student = new students();
						$studentDetails = $student->getStudentDetails();
				?>
                <select class="form-control" name="roll_number">
					<option>Please Select</option>
				<?php 
					foreach($studentDetails as $value) {
					
						echo "<option>".$value['roll_no']."</option>";
					
					}
				?>
                </select>
                <p class="help-block"></p>
              </div>
			  
			   <div class="form-group">
                <label>Enter name of student</label>
                <input class="form-control" name="stud_name" id="stud_name" placeholder="Enter name of student">
                <p class="help-block"></p>
              </div>
			  
			 <div class="form-group">
                <label>Exam Type</label>
                <select class="form-control" name="exam_type" placeholder="Enter text">
					<option>Please Select</option>
					<option>Terminal</option>
					<option>Annual</option>
                </select>
             </div>
				<input type="button" class="btn btn-default" name="confirm_exam_details" onclick="addExamDetails();" value="Go">
              <button type="reset" class="btn btn-default">Reset Button</button>  
			</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Exam Date</label>
						<input class="form-control" name="exam_date" placeholder="Exam Date">
						<p class="help-block"></p>
					</div>
					<div class="form-group">
						<div class="form-group">
							<label>Exam Presence&nbsp;</label>
							<label class="radio-inline">
							  <input type="radio" name="exam_presence" id="exam_presence1" checked>Present
							</label>
							<label class="radio-inline">
							  <input type="radio" name="exam_presence" id="exam_presence2" >Absent
							</label>
						</div>

					<p class="help-block"></p>
					</div>
					 <div class="form-group">
                <label>Acknowledgement</label>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"  name="teacher_acknowledge">
					Teacher Acknowledgement
                  </label>
                </div>
               <div class="checkbox">
                  <label>
				  <input type="checkbox" name="leader_acknowledge">
                    Leader Acknowledgement
                  </label>
                </div>
               <div class="checkbox">
                  <label>
                    <input type="checkbox"  name="parent_acknowledge">
                   Parent Acknowledgement
                  </label>
                </div>
              </div>
				</div>
	
				<div class="col-lg-4">
					<div class="form-group">
						<label>Remarks</label>
						<textarea class="form-control" placeholder="Enter text" rows="3" name="remarks"></textarea>
						<p class="help-block"></p>
					</div> 
						  <div class="form-group">
                <label>Academic Year</label>
				<select name="academic_year" id="year" class="form-control">
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
				</div>
				
			 <div class="row" id="examDetails">
          
         
			</div><!-- /.row -->
			
			<input type="hidden" name="action" value="save_exam_details">
		
			  </form>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
	<script>
		$(document).ready(function()
		{	
			$("#menu_exam").attr("class","active");
		});
	</script>
	 <!-- Page Specific Plugins -->
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
	
	<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
	</div>
  </body>
</html>

