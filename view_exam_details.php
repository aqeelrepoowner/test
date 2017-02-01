<?php

	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();
?>
<script>


	function getExamDetails()
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
				var URL = '<?php echo $_SERVER['PHP_SELF']; ?>';
				
				if(academicYear != "")
					URL += '?rollNo='+rollNo+'&courseId='+courseId+'&academic_year='+academicYear;
				else
					URL += '?rollNo='+rollNo+'&courseId='+courseId;
					
				window.location = URL;
			}
			else
			if(studName != "" && rollNo == "")
			{
				var URL = '<?php echo $_SERVER['PHP_SELF']; ?>';
				
				if(academicYear != "")
					URL += '?student_name='+studName+'&courseId='+courseId+'&academic_year='+academicYear;
				else
					URL += '?student_name='+studName+'&courseId='+courseId;
					
				window.location = URL;
			}
			else
			if(studName != "" && rollNo != "")
			{
				var URL = '<?php echo $_SERVER['PHP_SELF']; ?>';
				
				if(academicYear != "")
					URL += '?rollNo='+rollNo+'&student_name='+studName+'&courseId='+courseId+'&academic_year='+academicYear;
				else
					URL += '?rollNo='+rollNo+'&student_name='+studName+'&courseId='+courseId;
					
				window.location = URL;
			}
			else
			{
				
			}
		}
		
	}
	
	function editExamDetails(examId,studentId,courseId,academic_year,exam_type)
	{		
		var URL = 'edit_exam_details.php';

		URL += '?examId='+examId+'&roll_number='+studentId+'&courseId='+courseId+"&academic_year='"+academic_year+"'&exam_type='"+exam_type+"'";
				
		window.location = URL;								
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
          <a class="navbar-brand" href="index.html">Darul Huda</a>
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
            <h1>Examination History</h1><a href="add_exam_details.php" style="padding:5px;float:right;" class="btn btn-success">Add Exam Details</a>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="icon-dashboard"></i> Home</a></li>
              <li class="active"><i class="icon-file-alt"></i>Exams</li>
			  
            </ol>
			

			    <div class="alert alert-danger alert-dismissable" style="display:none;">
				
          </div>
          </div>
		
		   <form method="post" action="">
		   
			<div class="col-lg-4"> 
			
				   <div class="form-group">
                <label>Maktab Course</label>
                <select class="form-control" name="maktab_course" placeholder="Enter text">
					<option>Please Select</option>
                 <?php
				 $course = new course();
				 
				 $coursedetails = $course->getCourseDetails();
				 foreach($coursedetails as $value)
				 {
					if($_GET['courseId'] == $value['course_id'])
						echo "<option value=".$value['course_id']." selected='selected'>".$value['course_name']."</option>";
					else
						echo "<option value=".$value['course_id'].">".$value['course_name']."</option>";
				 }
				 ?>
				 
				 
                </select>
              </div>
		  
		
			  <div class="form-group">
                <label>Enter roll number of the student</label>
                <input class="form-control" name="roll_number" id="roll_number" placeholder="Enter roll number of the Student"
				<?php if(isset($_GET['rollNo'])){ echo "value=".$_GET['rollNo']; } ?>	>
                <p class="help-block"></p>
              </div>
			  
			 
			
			</div>
				
				<div class="col-lg-4">
					
						  <div class="form-group">
						    <div class="form-group">
								<label>Enter name of student</label>
								<input class="form-control" name="stud_name" id="stud_name" placeholder="Enter name of student"
								<?php if(isset($_GET['student_name'])){ echo "value=".$_GET['student_name']; } ?> >
								<p class="help-block"></p>
							</div>
			  
                
              </div>	
			    <div class="form-group">
				<input type="button" class="btn btn-default" name="confirm_exam_details" onclick="getExamDetails();" value="Go">
              <a href="view_exam_details.php"  class="btn btn-default" >Reset Button</a>
</div>			  
				</div>
				
				<div class="col-lg-4">
				<label>Academic Year</label>
				<select name="academic_year" id="year" class="form-control">
					<?php
						$i = STARTYEAR;
						
						while($i < ENDYEAR)
						{
							$j = $i+1;
							if($i."-".$j == $_GET['academic_year'])
								echo "<option selected='selected'>".$i."-".$j."</option>";
							else
								echo "<option >".$i."-".$j."</option>";
							
							$i = $j;
						}
					?>
				</select>
                <p class="help-block"></p>
				 <div class="form-group">
                <label>Exam Type</label>
                <select class="form-control" name="exam_type" placeholder="Enter text">
					<option>Please Select</option>
					<option>Terminal</option>
					<option>Annual</option>
                </select>
             </div>
				</div>
				
			 <div class="row" id="examDetails">
				<?php
				
					if(isset($_GET['courseId']))
					{
						$exam = new exam();	
							
						$examDetails = $exam->getExamDetails($_GET);
						
						
						echo '<div class="col-lg-12"style="margin-left:1%;">';
						
						echo '<table class="table table-bordered table-hover table-striped tablesorter">
				<thead>
					<tr>
						<th>Roll.No<i class="fa fa-sort"></i></th>
						<th>Student Name<i class="fa fa-sort"></i></th>
						<th>Marks Obtained<i class="fa fa-sort"></i></th>                 
						<th>Total Marks<i class="fa fa-sort"></i></th>
						<th>Exam Type<i class="fa fa-sort"></i></th>
						
						<th>Manage<i class="fa fa-sort"></i></th>
					</tr>
                </thead>
                <tbody>';
					$index = 1;
					if(is_array($examDetails))
					{
						foreach($examDetails as $value)
						{
							echo '<tr>';
							
							echo '<td>'.$value['student_id'].'</td>';
							
							echo '<td>'.$value['first_name'].' '.$value['last_name'].'</td>';
							
							echo '<td>'.$value['marks_obtained'].'</td>';
							
							echo '<td>'.$value['out_of_marks'].'</td>';

							echo '<td>'.$value['exam_type'].'</td>';
							?>
			<td style="font-size:12px;">
<a href="javascript:void(0);" onclick="editExamDetails(<?php echo $value['exam_id'].",".$value['mst_students_student_id'].",".$value['mst_course_course_id'].",'".$value['academic_year']."'".",'".$value['exam_type']."'"; ?>);">Edit</a>
						<?php	echo '<a href="#myModal" class="btn btn-setting btn-round"><i class="icon-cog"></i></a></td>
							</tr>';
							
							
							$index++;
							
						}
						echo '</tbody></table></div>';
					}
					}
					
					
				?>		
         
			</div><!-- /.row -->
			
			<input type="hidden" name="action" value="save_exam_details">
		
			  </form>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->
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

  </body>
</html>