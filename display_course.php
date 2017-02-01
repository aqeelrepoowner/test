<?php
	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	$args = array("del"=>FILTER_VALIDATE_INT,
	"course_id"=>FILTER_VALIDATE_INT);
	
	$getData = filter_var_array($_GET,$args);
	
	if(isset($getData['del'])) {
	
		$course = new course();
		
		$course->deleteCourse($getData['course_id']);
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Darul Huda</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
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
		</nav>

		<div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Courses <small></small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-table"></i> Tables</li>
            </ol>
            <div class="alert alert-info alert-dismissable" style="display:none;">
            
			</div>
        </div><!-- /.row -->

        <div class="row">
           <div style="float:right;margin:0px 5% 10px 0px;"><a href="add_course.php" class="btn btn-default btn-success" >Add Course</a> </div>
          <div class="col-lg-12">
           
            <div class="table-responsive">
			
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th>Course Name <i class="fa fa-sort"></i></th>
                    <th>Course Description <i class="fa fa-sort"></i></th>
					<th>Manage <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>
					<?php
						$course =  new course();

						$courseDetails = $course->getCourseDetails();			
							
		
						foreach($courseDetails as $eachValue)
						{
							echo  '<tr>';
							
							echo  '<td>'.$eachValue['course_name'].'</td>';
				   
							echo  '<td>'.$eachValue['course_description'].'</td>';
							
							echo  '<td><a href="edit_course.php?course_id='.$eachValue['course_id'].'">Edit</a>
							&nbsp;|&nbsp;<a href="display_course.php?course_id='.$eachValue['course_id'].'&del=1">Delete</a></td>';
							
							echo '</tr>';
						}
					?>
                 
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- /.row -->

        
        </div><!-- /.row -->

		</div><!-- /#page-wrapper -->

	</div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
	<script>
		$(document).ready(function()
		{	
			//alert("hi");
			$("#menu_course").attr("class","active");
		});
	</script>
    <!-- Page Specific Plugins -->
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

  </body>
</html>