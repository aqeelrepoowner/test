<?php
	include_once "config/dlhuda_config.php";
	
	function __autoload($className)
	{
		include_once $className.".php";
	}
?>
<script>
function getReport(reportType)
{
	switch(reportType)
	{
		case "student_report":
			window.location = "view_reports.php?student_report=1";
		break;
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

    <title>DarulHuda</title>

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
          <a class="navbar-brand" href="index.html">DarulHuda</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
       <?php include_once "menu.php"; ?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Reports <small></small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"><i class="fa fa-edit"></i>Reports</li>
            </ol>
            <!--<div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Visit <a class="alert-link" target="_blank" href="http://getbootstrap.com/css/#forms">Bootstrap's Form Documentation</a> for more information.
            </div>-->
          </div>
        </div><!-- /.row -->
		<?php
			$reportTypes = array("student_report"=>"Student Report","fees_report"=>"Fees Report","attend_report"=>"Attendance Report",
			"exam_report"=>"Examination Report","charity_report"=>"Charity Report");
		?>
        <div class="row">
		 <div class="col-lg-4">
		 <?php
			$getParamKey = array_keys($_GET);
					
		 ?>
			<div class="form-group">
                <label>Report Type</label>
                <select class="form-control" name="report_type" onchange="getReport(this.value);" placeholder="Select Report type">
				  <option>Please Select</option>
                 <?php

					
					foreach($reportTypes as $key => $eachType)
					{
						if($getParamKey[0] == $key)
							echo "<option value=".$key." selected='selected'>".$eachType."</option>";
						else
							echo "<option value=".$key.">".$eachType."</option>";
					}
				  ?>
                </select>
			</div>
			
			
			<input type="submit" class="btn btn-default" name="confirm_register" value="Show Report">
            <button type="reset" class="btn btn-default">Reset Button</button>  

          </div>
		
				<?php
				
				if(isset($getParamKey[0])):
				
					switch($getParamKey[0])
					{
						case "student_report":
						?>
						
					  <div id="elements">	
			<div class="col-lg-4">
			
				<div class="form-group">
                <label>Student Name</label>
                <input class="form-control" name="student_name" placeholder="Enter text">
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
			
				
			</div>
			<div class="col-lg-4">
				  <div class="form-group">
                <label>Roll Number</label>
                <input class="form-control" name="student_name" placeholder="Enter text">
                <p class="help-block"></p>
              </div>
			  <div class="form-group">
                <label>Maktab Location</label>
                <select class="form-control" name="maktab_location" placeholder="Enter text">
					<option>Please Select</option>
					<option>Arshiya</option>
					<option>Ajmera</option>
					 </select>
              </div>
			  	 	<div class="form-group">
				<label>Bus Facility</label>
                <label class="radio-inline">
                  <input type="radio" name="bus_facility" id="optionsRadiosInline1" value="Yes" checked> Yes
                </label>
                <label class="radio-inline">
                  <input type="radio" name="bus_facility" id="optionsRadiosInline2" value="No"> No
                </label>
               
              </div>
			  
		
			  
					
				</div>
			
          
			  
	</div>
				<?php
					
						include_once "student_reports.php";
						
						break;
						
					}
					
					endif;
				?>  
             
            </form>
            
          

          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>