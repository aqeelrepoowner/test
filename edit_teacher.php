<?php

	function __autoload($className)
	{
		include_once $className.".php";
	}
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();

	if(isset($_POST['edit_teacher']))
	{
		$teacher = new teacher();
		
		$teacher->editTeacher($_POST);
	}
	
?>				
		

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DarulHuda - Edit Teacher</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
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
          <a class="navbar-brand" href="index.html">DarulHuda</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
       <?php include_once "menu.php"; ?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Edit Teacher <small></small></h1>
            <ol class="breadcrumb">
              <li><a href="view_teacher.php"><i class="fa fa-dashboard"></i> View Teacher</a></li>
			  <li class="active"><i class="fa fa-edit"></i>Edit Teacher</li>
            </ol>
            <!--<div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Visit <a class="alert-link" target="_blank" href="http://getbootstrap.com/css/#forms">Bootstrap's Form Documentation</a> for more information.
            </div>-->
          </div>
        </div><!-- /.row -->
		
		<?php
			$teacher = new teacher();
			
			$teacherDetails = $teacher->getTeacherById($_GET['id']);
		?>
  <h2>Teacher Details</h2>
        <div class="row">
          <div class="col-lg-4">
		
			
            <form role="form" method="post" action="">

              <div class="form-group">
                <label>First Name</label>
                <input class="form-control" name="first_name" placeholder="Enter text" value="<?php echo $teacherDetails['teacher_first_name']; ?>">
                <p class="help-block"></p>
              </div>
				
				</div>
	<div class="col-lg-4">
			<div class="form-group">
                <label>Middle Name</label>
                <input class="form-control" name="middle_name" placeholder="Enter text" value="<?php echo $teacherDetails['teacher_middle_name']; ?>">
                <p class="help-block"></p>
              </div>
			  </div>
			  <div class="col-lg-4">
			<div class="form-group">
                <label>Last Name</label>
                <input class="form-control" name="last_name" placeholder="Enter text" value="<?php echo $teacherDetails['teacher_last_name']; ?>">
                <p class="help-block"></p>
              </div>
			  
			  </div>
			   <div class="col-lg-4">
			  <div class="form-group">
                <label>Date Of Birth</label>
                <input class="form-control" name="dob_teacher" placeholder="Enter text" id="dob_teacher" value="<?php $date = new DateTime($teacherDetails['teacher_dob']); echo $date->format("d-m-Y"); ?>">
                <p class="help-block"></p>
              </div>
			  </div>
			   <div class="col-lg-4">
			   <div class="form-group">
                <label>Gender</label>
                <select class="form-control" name="gender" placeholder="Enter text">
					<option>Please Select</option>
				<?php if($teacherDetails['gender'] == 'Male') : ?>	
				 <option selected="selected">Male</option>
                   <option>Female</option>
				   <?php
					else :
					
					?>
					 <option >Male</option>
                   <option selected="selected">Female</option>
					<?php
					endif;
				   ?>
                </select>
              </div>
			  </div>
			  <?php
				$qualification = array("Hafeez","Aalim","Mufti");	
			  ?>
			   <div class="col-lg-4">
			<div class="form-group">
                <label>Qualification</label>
                <select class="form-control" name="qualification" placeholder="Enter text">
					<option>Please Select</option>
					<?php foreach($qualification as $eachQualification) :
						if($eachQualification == $teacherDetails['qualification'])
							echo "<option selected='selected'>".$eachQualification."</option>";
						else
							echo "<option >".$eachQualification."</option>";
						endforeach;
					?>
                </select>
              </div>
			  </div>
			  <div class="col-lg-6">
			 <div class="form-group">
                <label>Address</label>
                 <textarea class="form-control" placeholder="Enter text" rows="3" name="address"><?php echo $teacherDetails['address']; ?></textarea>
                <p class="help-block"></p>
              </div> 
			 </div>
			 <div class="col-lg-4">
              <div class="form-group">
                <label>Contact No</label>
                <input class="form-control" placeholder="Enter text" name="contact_no" value="<?php echo $teacherDetails['contact_no']; ?>">
              </div>
	</div>
        
			 <div class="col-lg-4">
           <input type="submit" class="btn btn-success" name="edit_teacher" value="Update Teacher">
              <button type="reset" class="btn btn-danger">Reset Button</button>  
</div>
      
         
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
		<script>
	$(function() {
			$("#dob_teacher").datepicker();
		});
	</script>
  </body>
</html>