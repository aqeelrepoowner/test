<?php

	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();

	if(isset($_POST['confirm_add_teacher']))
	{
		$teacher = new teacher();
		
		$teacher->addTeacher($_POST);
		
		echo '<script>
				$(".alert").attr("class","alert alert-success alert-dismissable");
				$(".alert").attr("style","display:block;");
				$(".alert").html("Added Successfully");
			</script>';
			
		header("Location:view_teacher.php");	
	}
	
	
?>				
		

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DarulHuda - Add Teacher</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
	
		<script>
		function validateTeacher() {
		
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
          <a class="navbar-brand" href="index.php">DarulHuda</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
       <?php include_once "menu.php"; ?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Add Teacher <small></small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"><i class="fa fa-edit"></i>Teacher</li>
			  <li class="active"><i class="fa fa-edit"></i>Add Teacher</li>
            </ol>
          
			<div class="alert alert-danger alert-dismissable" style="display:none;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
          </div>
        </div><!-- /.row -->
  <h2>Teacher Details</h2>
        <div class="row">
          <div class="col-lg-4">
		
			<h4>Personal Details</h4>
            <form role="form" method="post" action="" onsubmit=" return validateTeacher();">

              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="first_name" placeholder="Enter text">
                <p class="help-block"></p>
              </div>

			<div class="form-group">
                <label>Middle Name</label>
                <input type="text" class="form-control" name="middle_name" placeholder="Enter text">
                <p class="help-block"></p>
              </div>
			  
			<div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter text">
                <p class="help-block"></p>
              </div>
			  
			  <div class="form-group">
                <label>Date Of Birth</label>
                <input type="text" class="form-control" name="dob_teacher" placeholder="Enter text" id="dob_teacher">
                <p class="help-block"></p>
              </div>
			  </div>
			  <div class="col-lg-4">
			   <div class="form-group">
                <label>Gender</label>
                <select class="form-control" name="gender" placeholder="Enter text">
					<option>Please Select</option>
                   <option>Male</option>
                   <option>Female</option>
                </select>
              </div>
			  
			<div class="form-group">
                <label>Qualification</label>
                <select class="form-control" name="qualification" placeholder="Enter text">
					<option>Please Select</option>
                    <option>Hafeez</option>
                    <option>Aalim</option>
				    <option>Mufti</option>
                </select>
              </div>
			  
			 <div class="form-group">
                <label>Address</label>
                 <textarea class="form-control" placeholder="Enter text" rows="3" name="address"></textarea>
                <p class="help-block"></p>
              </div> 
			 
			 
              <div class="form-group">
                <label>Contact No</label>
                <input type="text" class="form-control" placeholder="Enter text" name="contact_no">
              </div>

        
			 
           <input type="submit" class="btn btn-success" name="confirm_add_teacher" value="Add Teacher">
              <button type="reset" class="btn btn-danger">Reset Button</button>  

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
			$("#menu_teacher").attr("class","active");
		});
	</script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
		<script>
	$(function() {
			
			$("#dob_teacher").datepicker();
		});
	</script>
  </body>
</html>