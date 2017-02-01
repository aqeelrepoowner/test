<?php
	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();
	
	$args = array("del"=>FILTER_VALIDATE_INT,
	"teacher_id"=>FILTER_VALIDATE_INT);
	
	$getData = filter_var_array($_GET,$args);
	
	if(isset($getData['del'])) {
	
		$teacher = new teacher();
		
		$teacher->deleteTeacher($getData['teacher_id']);
	}
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Darul Huda - View Teacher Details</title>

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
            <h1>Teacher <small></small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-table"></i> View Students</li>
            </ol>
            <div class="alert alert-info alert-dismissable" style="display:none;">
            
          </div>
        </div><!-- /.row -->

        <div class="row">
           <div style="float:right;margin:0px 5% 10px 0px;"><a href="add_teacher.php" class="btn btn-default btn-success" >Add Teacher</a> </div>
          <div class="col-lg-12">
           
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
					<th>Sr No.<i class="fa fa-sort"></i></th>
                    <th>Teacher Name <i class="fa fa-sort"></i></th>
					<th>Gender<i class="fa fa-sort"></i></th>
					<th>Address<i class="fa fa-sort"></i></th>
					<th>Contact No <i class="fa fa-sort"></i></th>
					<th>Qualification <i class="fa fa-sort"></i></th>
					<th>Manage <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>
					<?php
						$teacher =  new teacher();

						$teacherDetails = $teacher->getTeacherDetails();			
						
						$i = 1;
						foreach($teacherDetails as $eachValue)
						{
							echo  '<tr>';
								
							echo '<td>'.$i.'</td>';
							
							echo  '<td>'.$eachValue['teacher_first_name']." ".$eachValue['teacher_middle_name']." ".$eachValue['teacher_last_name'].'</td>';
				   
							echo  '<td>'.$eachValue['gender'].'</td>';
							
							echo  '<td>'.$eachValue['address'].'</td>';
							
							echo  '<td>'.$eachValue['contact_no'].'</td>';
							
							echo  '<td>'.$eachValue['qualification'].'</td>';
							
							echo  '<td><a href="edit_teacher.php?id='.$eachValue['teacher_id'].'" >Edit</a>&nbsp;|&nbsp;
							<a href="view_teacher.php?teacher_id='.$eachValue['teacher_id'].'&del=1" onclick="return confirm("Do you really want to delete this entry ?");">Delete</a></td>';
							
							echo '</tr>';
							
							$i++;
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
			$("#menu_teacher").attr("class","active");
		});
	</script>
    <!-- Page Specific Plugins -->
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

  </body>
</html>