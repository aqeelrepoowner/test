<?php

	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();

	if(isset($_POST['confirm_edit_course'])) {
	
		$course = new course();
		
		$args = array(
			"course_id" => FILTER_VALIDATE_INT,
			"course_name" => FILTER_SANITIZE_STRING,
			"course_desc" => FILTER_SANITIZE_STRING
		);
		
		$postData = filter_var_array($_POST,$args);
		
		$course->updateCourse($postData);
		
		header("Location:display_course.php");
	}
			 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DarulHuda - Course</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<script>
		function validateCourse() {
		
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
            <h1>Course <small>Enter Your Data</small></h1>
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
			<?php  
				
				$course = new course();
				
				$getData = filter_var_array($_GET,array("course_id"=>FILTER_VALIDATE_INT));
				
				$courseDetails = $course->getCourseById($getData['course_id']);
				
			?>
        <div class="row">
			<div class="col-lg-6">
			<h4>Course Details</h4>
            <form role="form" method="post" action="" onsubmit="return validateCourse();">

				<div class="form-group">
					<label>Course Name</label>
					<input type="text" class="form-control" name="course_name" placeholder="Enter text" value="<?php echo $courseDetails['course_name']; ?>">
					<p class="help-block"></p>
				</div>
			  
				<div class="form-group">
					<label>Course Description</label>
					<textarea class="form-control" placeholder="Enter text" rows="3" name="course_desc"><?php echo $courseDetails['course_description']; ?></textarea>
					<p class="help-block"></p>
				</div>
			  
				<input type="hidden" name="course_id" value="<?php echo $_GET['course_id']; ?>">
				<input type="submit" class="btn btn-default" name="confirm_edit_course" value="Update Course">
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
			$("#menu_course").attr("class","active");
		});
	</script>
  </body>
</html>