<?php

	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();

	if(isset($_POST['confirm_add_subject']))
	{
		$subject = new subjects();
		
		$subject->addSubject($_POST);
	}
				 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DarulHuda - Subject</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<script>
		function validateSubjects() {
		
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
				$('html, body').animate({ scrollTop: 3}, 'swing');
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
			
			if(isValid == false) {
			
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
          <a class="navbar-brand" href="index.html">SB Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
       <?php include_once "menu.php"; ?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Subjects <small>Enter Your Data</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"><i class="fa fa-edit"></i>Add Course</li>
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
			<h4>Subject Details</h4>
            <form role="form" method="post" action="" onsubmit="return validateSubjects();">
			  <div class="form-group">
                <label>Subject Name</label>
                <input type="text" class="form-control" name="subject_name" placeholder="Enter text">
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
                <label>Subject Description</label>
                <textarea class="form-control" placeholder="Enter text" rows="3" name="subject_desc"></textarea>
                <p class="help-block"></p>
             </div>
			  

			<input type="submit" class="btn btn-default" name="confirm_add_subject" value="Add Subject">
			<button type="reset" class="btn btn-default">Reset Button</button>  

          </div>
          

		</form>
       

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
			$("#menu_subjects").attr("class","active");
		});
	</script>
  </body>
</html>