<?php

	function __autoload($className)
	{
		include_once $className.".php";
	}
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if($_POST['action'] == "update_exam_details")
		{	
			$exam = new exam();
			//var_dump($_POST);exit;
			$exam->updateExamDetails($_POST);
		}
	}
?>

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
            <h1>Examination History</h1><small style="background-color:rgb(245, 245, 245);padding:5px;float:right;color:red;">Please select course and roll no from below form</small>
            <ol class="breadcrumb">
              <li><a href="view_exam_details.php"><i class="icon-dashboard"></i> View Exam</a></li>
              <li class="active"><i class="icon-file-alt"></i>Edit Exams</li>
			 
            </ol>
			

			    <div class="alert alert-danger alert-dismissable" style="display:none;">
				
          </div>
          </div>
		  <?php
				$exam = new exam(); 
			
				$examDetails = $exam->getExamDetailsByFilters($_GET); 
	
				//var_dump($examDetails);
		  ?>
		
		   <form method="post" action="">
		   
			
			
				<div class="col-lg-4"> 
			
				   <div class="form-group">
					<label>Maktab Course</label>
					<?php  echo '<br/><span class="label label-success">'.$examDetails['course_name'].'</span>';  ?>
				</div>
		  
		
			  <div class="form-group">
                <label>Roll number of the student</label>
				<?php  echo '<br/><span class="label label-success">'.$examDetails['student_id'].'</span>';  ?>
               
              </div>
			  
			   <div class="form-group">
                <label>Name of student</label>
               <?php  echo '<br/><span class="label label-success">'.$examDetails['first_name'].'</span>&nbsp;&nbsp;<span class="label label-success">'.$examDetails['last_name'].'</span>';  ?>
              </div>
			  
			 <div class="form-group">
                <label>Exam Type</label>
				
				<?php $examType = array("Terminal","Annual"); ?>
                <select class="form-control" name="exam_type" placeholder="Enter text">
					<option>Please Select</option>
					<?php
						foreach($examType as $eachType)
						{
							if($examDetails['exam_type'] == $eachType)
								echo "<option selected='selected'>".$eachType."</option>";
							else
								echo "<option>".$eachType."</option>";
						}
					?>
                </select>
             </div>
				<input type="button" class="btn btn-default" name="confirm_exam_details" onclick="addExamDetails();" value="Go">
              <button type="reset" class="btn btn-default">Reset Button</button>  
			</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Exam Date</label>
						<input class="form-control" name="exam_date" placeholder="Exam Date" value="<?php $date = new DateTime($examDetails['exam_date']); echo $date->format('d-m-Y'); ?>">
						<p class="help-block"></p>
					</div>
					<div class="form-group">
						<div class="form-group">
							<label>Exam Presence&nbsp;</label>
								<?php
								if($examDetails['exam_presence'] == "Yes")
								{
							?>
							<label class="radio-inline">
							  <input type="radio" name="exam_presence" id="exam_presence1" checked>Present
							</label>
							<label class="radio-inline">
							  <input type="radio" name="exam_presence" id="exam_presence2" >Absent
							</label>
							<?php
								}
								else
								{
							?>
							<label class="radio-inline">
							  <input type="radio" name="exam_presence" id="exam_presence1" >Present
							</label>
							<label class="radio-inline">
							  <input type="radio" name="exam_presence" id="exam_presence2" checked>Absent
							</label>
							<?php
								}
							?>
						</div>

					<p class="help-block"></p>
					</div>
					 <div class="form-group">
                <label>Acknowledgement</label>
				
                <div class="checkbox">
                  <label>
				  <?php
					if($examDetails['teacher_acknowledgement'] == "Yes")
					{
				  ?>
                    <input type="checkbox"  name="teacher_acknowledge" checked>
					Teacher Acknowledgement
					<?php
					}
					else
					{	
					?>
					<input type="checkbox"  name="teacher_acknowledge">
					Teacher Acknowledgement
					<?php
					}
					?>
                  </label>
                </div>
               <div class="checkbox">
                  <label>
				  <?php
					if($examDetails['leader_acknowledgement'] == "Yes")
					{
				  ?>
				  <input type="checkbox" name="leader_acknowledge" checked>
                    Leader Acknowledgement
					
					<?php
					}
					else
					{
					?>
					 <input type="checkbox" name="leader_acknowledge">
                    Leader Acknowledgement
					<?php
					}
					?>
                  </label>
                </div>
               <div class="checkbox">
                  <label>
				  <?php
					if($examDetails['parent_acknowledgement'] == "Yes")
					{
				  ?>
                    <input type="checkbox"  name="parent_acknowledge" checked>
                   Parent Acknowledgement
				   <?php
					}
					else
					{
				   ?>
					<input type="checkbox"  name="parent_acknowledge">
                   Parent Acknowledgement
				   <?php
					}
				   ?>
                  </label>
                </div>
              </div>
				</div>
	
				<div class="col-lg-4">
					<div class="form-group">
						<label>Remarks</label>
						<textarea class="form-control" placeholder="Enter text" rows="3" name="remarks"><?php echo $examDetails['remarks']; ?></textarea>
						<p class="help-block"></p>
					</div> 
						  <div class="form-group">
                <label>Academic Year</label>
				<?php  echo '<br/><span class="label label-success">'.$examDetails['academic_year'].'</span>';  ?>
                <p class="help-block"></p>
              </div>	
				</div>
				
			 <div class="row" id="examDetails">
				<?php
	
				
				echo	'<div class="col-fees-10">';

				echo '<h2>Subject Marks Details</h2>
			<p>Exam details of <b>'.$examDetails['first_name']." ".$examDetails['last_name'].'</b> for academic year <b>'.$examDetails["academic_year"].'</b> are mentioned below:
				<table class="table table-bordered table-hover table-striped tablesorter">
				<thead>
					<tr>
						<th>Sr.No<i class="fa fa-sort"></i></th>
						<th>Name of the Subject <i class="fa fa-sort"></i></th>
						<th>Marks Obtained<i class="fa fa-sort"></i></th>                 
						<th>Total Marks<i class="fa fa-sort"></i></th>
					</tr>
                </thead>
                <tbody>';
			
						$subject = new subjects();
						
						$subjectDetails = $subject->getSubjectDetails($_GET['courseId']);
						
						
						
						if(is_array($subjectDetails))
						{
							$i = 1;
							
						foreach($subjectDetails as $value) :
							$subjectMarks = $exam->getSubjectMarksDetails($value['subject_id'],$examDetails['exam_id']);
							
						echo '<tr class="active">
						<td>'.$i.'</td>
						<td>'.$value['subject_name'].'</td>
						<td><input type="text" name="marks_obtained['.$value['subject_id'].']" value='.$subjectMarks['marks_obtained'].'></td>
						<td><input type="text" name="total_marks['.$value['subject_id'].']" value="100"></td>			
						</tr>';
						
						
						$i++;
								endforeach;
						}
			
                  
                  
                echo '</tbody>
              </table>';
			 
         
		  
		
		
          echo '</div><div style="margin-left:65%;"><input type="submit" name="" class="btn btn-success" value="Save"></div>';
				?>
         
			</div><!-- /.row -->
			
			<input type="hidden" name="action" value="update_exam_details">
		<input type="hidden" name="roll_number" value="<?php echo $examDetails['mst_students_student_id']; ?>">
			
			<input type="hidden" name="course_id" value="<?php echo $examDetails['mst_course_course_id']; ?>">
			
			<input type="hidden" name="exam_id" value="<?php echo $examDetails['exam_id']; ?>">
			  </form>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

	 <!-- Page Specific Plugins -->
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
  </body>
</html>