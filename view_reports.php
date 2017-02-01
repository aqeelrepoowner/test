<?php

	include_once "config/dlhuda_config.php";
	
	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Darul Huda - Reports</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
	 <link href="css/darulhuda.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		
		
		<link href="css/charisma-app.css" rel="stylesheet">
		
		<script>
		function getReport(reportType,year)
		{	
			switch(reportType)
			{
				case "student_report":
					window.location = "view_reports.php?student_report=1";
				break;
				
				case "fees_report":
					window.location = "view_reports.php?fees_report=1&year="+year;
				break;
				
				case "attend_report":
					window.location = "view_reports.php?attend_report=1";
				break;
				case "exam_report":
					window.location = "view_reports.php?exam_report=1";
				break;
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
            <h1>Reports</h1><small style="background-color:rgb(245, 245, 245);padding:5px;float:right;color:red;">Please select below details from below</small>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Home</a></li>
              <li class="active"><i class="icon-file-alt"></i>Reports</li>
            </ol>
			<div class="alert alert-danger alert-dismissable" style="display:none;">
				ada
			</div>
          </div>
		<?php
		
			$reportTypes = array("student_report"=>"Student Report","fees_report"=>"Fees Report","attend_report"=>"Attendance Report",
			"exam_report"=>"Examination Report","charity_report"=>"Charity Report");
			
			$getParamKey = array_keys($_GET);	
			
			if(isset($getParamKey[0])) :
			
				if(array_key_exists($getParamKey[0],$reportTypes))
				{
					$paramKey = $getParamKey[0];
				}
				else
				{
					$getValues = array_values($_GET);
					//var_dump($getValues);
					$paramKey = $getValues[0];
				}
				
	
			endif;	
				
		?>
			<?php $currentYear = (int)date("Y");
					$nextYear = $currentYear  + 1;
					
				?>
			<form method="get" action="">
		  
			<div class="col-lg-4">
		
			<div class="form-group">
                <label>Report Type</label>
                <select class="form-control" name="report_type" onchange="getReport(this.value,'<?php echo $currentYear."-".$nextYear; ?>');" placeholder="Select Report type" >
				  <option>Please Select</option>
                 <?php
	
					foreach($reportTypes as $key => $eachType)
					{
						if($paramKey == $key)
							echo "<option value=".$key." selected='selected'>".$eachType."</option>";
						else
							echo "<option value=".$key.">".$eachType."</option>";
					}
					
				  ?>
                </select>
			</div>
			
			
			<?php 	
				if(isset($paramKey)) :
								
				switch($paramKey)
				{
					case "student_report":
					
					?>
							 
				<input type="submit" class="btn btn-default" style="margin-left:30px" name="confirm_register" value="Get Report">
				<button type="reset" class="btn btn-default" style="margin-left:30px">Reset Button</button>  
			  
	
			  <?php
					include_once "student_reports.php";
			  ?>
			<?php
					break;
					case "fees_report":
								
						echo '<div class="form-group">
                <label>Year</label>
				<select name="year" id="year" class="form-control">';
					
					$i = STARTYEAR;
						
						while($i < ENDYEAR)
						{	
							 $j = $i + 1;
							 
							if($i."-".$j == @$_GET['year']) 
								echo "<option selected='selected'>".$i."-".$j."</option>";
							else
								echo "<option>".$i."-".$j."</option>";
								
							$i = $j;
						}
					
				echo '</select>
                <p class="help-block"></p>
              </div></div>';
			  echo '<div class="col-lg-4"><div class="form-group">
			  <label>Location </label>
		<select name="maktab_location" id="maktab_location" class="form-control">
		<option>Select Location</option>';
	
		
			$maktab_location = array('AR'=>MAKTAB_LOCATION1,'AJ'=>MAKTAB_LOCATION2);
			
			foreach($maktab_location as $key => $value)
			{
				if($_GET['maktab_location'] == $key)
					echo "<option selected='selected' value=".$key.">".$value."</option>";
				else
					echo "<option value=".$key.">".$value."</option>";
			}	
		
		echo '</select>
		</div>';
					echo '<input type="submit" class="btn btn-default" style="margin-left:30px" name="confirm_register" value="Get Report">
              <a href="view_reports.php?fees_report=1&year='.$_GET['year'].'" class="btn btn-default" >Reset Button</a> </div> ';		
						
						include_once "fees_reports.php";								
												
					break;
					
					case "attend_report":
						
					echo '<div class="form-group">
                <label>Year</label>
				<select name="academic_year" id="academic_year" class="form-control">
				<option value="">Select Year</option>';
					
					$i = STARTYEAR;
						
						while($i < ENDYEAR)
						{	
							 $j = $i + 1;
							 
							if($i."-".$j == @$_GET['academic_year']) 
								echo "<option selected='selected'>".$i."-".$j."</option>";
							else
								echo "<option>".$i."-".$j."</option>";
								
							$i = $j;
						}
					
				echo '</select>
                <p class="help-block"></p>
              </div>';
			  echo '<input type="submit" class="btn btn-default" style="margin-left:30px" name="confirm_register" value="Get Report">
              <button type="reset" class="btn btn-default" style="margin-left:30px">Reset Button</button></div>';		
					
					
					
					
					if(isset($_GET['academic_year']))
						include_once "attendance_reports.php";								
												
					break;
					case "exam_report":
								
						
					echo '  <input type="submit" class="btn btn-default" style="margin-left:30px" name="confirm_register" value="Get Report">
              <button type="reset" class="btn btn-default" style="margin-left:30px">Reset Button</button>  ';		
						
						include_once "exam_reports.php";								
												
					break;
				}	
				
				endif; 	
			?>
           
			</div>
			
			 <div class="row" id="feesDetails">
          
         
			</div><!-- /.row -->
			
			
		
			</form>
      
   
    </div><!-- /#wrapper -->
	</div>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
	<script>
			$( document ).ready(function()
			{
				$("#menu_report").attr("class","active");
			});
	</script>
	 <!-- Page Specific Plugins -->
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
	<script src="js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/charisma/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="js/charisma/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="js/charisma/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="js/charisma/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="js/charisma/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="js/charisma/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="js/charisma/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="js/charisma/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="js/charisma/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="js/charisma/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="js/charisma/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="js/charisma/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="js/charisma/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="js/charisma/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="js/charisma/jquery.cookie.js"></script>

	<!-- data table plugin -->
	<script src='js/charisma/jquery.dataTables.min.js'></script>

	

	<!-- select or dropdown enhancer -->
	<script src="js/charisma/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="js/charisma/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="js/charisma/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="js/charisma/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="js/charisma/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="js/charisma/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="js/charisma/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="js/charisma/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="js/charisma/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="js/charisma/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="js/charisma/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="js/charisma/charisma.js"></script>

	
  </body>
</html>