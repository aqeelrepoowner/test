<?php
	
	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();
	
	function getSunday($y, $m)
	{
		return new DatePeriod(
			new DateTime("first sunday of $y-$m"),
			DateInterval::createFromDateString('next sunday'),
			new DateTime("last day of $y-$m")
		);
	}
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if(isset($_POST['save_attendance'])) :
		
		$courseId = $_POST['course_id'];
		$maktab_location = $_POST['maktab_location'];
		$month = $_POST['month'];
		$year = $_POST['year'];
		
		$holidays = array();
						
		foreach(getSunday($year,$month) as $sundays)
		{	
			$holidays[] = $sundays->format("d");
		}
		
		$holidaysCount = count($holidays);
		
		$attend = new attendance();
		
			foreach($_POST['date'] as $key => $value) :
				$daysExplode = explode("_",$key);
				$attend->addStudentAttendance($month,$year,$daysExplode[0],$daysExplode[1]);
			endforeach;
			
		header("Location:".$_SERVER['HTTP_REFERER']);	
		exit;
		
		elseif(isset($_POST['update_attendance'])) :
		
		include "config/dlhuda_config.php";
		
		$courseId = $_POST['course_id'];
		$maktab_location = $_POST['maktab_location'];
		$month = $_POST['month'];
		$year = $_POST['year'];
		$index = 1;
		$holidays = array();
					
		$stud_ids = array();
		
		$attend = new attendance();
	
		foreach($_POST['date'] as $key => $value) :
			$datesExp = explode("_",$key);
		
			$stud_ids[] = $datesExp[1];
				
		endforeach;
		
		$unique_stud_id = array_unique($stud_ids);
			
			foreach($unique_stud_id as $uniqStudId) :
				
				$attend->deleteStudentAttendance($month,$year,$uniqStudId);	
				
			endforeach;
		
		foreach($_POST['date'] as $key => $value) :
			$datesExp = explode("_",$key);
		
			$attend->addStudentAttendance($month,$year,$datesExp[0],$datesExp[1]);
		endforeach;
		
		header("Location:".$_SERVER['HTTP_REFERER']);	
		exit;
		
		endif;
		
	}	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>DarulHuda - Attendance</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	
	<script>
		function getAttendance(month)
		{
			var year = $("select[name=year]").val();
			
			if((month != "" && year != "") && (month != "Select Month" && year != "Select Year"))
			{
				var URL = "<?php  echo $_SERVER['PHP_SELF']."?month=" ?>";
				
				var courseId = $("select[name=course_id]").val();
				
				var location = $("select[name=maktab_location]").val();

				URL += month;
				
				if(courseId != "" && courseId != "Select Course")
				{
					URL = URL + "&course="+courseId;
				}
				
				if(location != "" && location != "Select Location")
				{
					URL = URL + "&location="+location;
				}
			
				window.location = URL+"&year="+year;
			}
		}
		
		function checkAll(rowValue)
		{
			var mainCheck = document.getElementById("all_"+rowValue);
			
			var allCheckboxes = document.getElementsByClassName("chkbox"+rowValue);
			
			if(mainCheck.checked)
			{
				for(var i = 0;i<allCheckboxes.length;i++)
				{
					allCheckboxes[i].checked = true;
				}
			}
			else
			{
				for(var i = 0;i<allCheckboxes.length;i++)
				{
					allCheckboxes[i].checked = false;
				}
			}
		}
		
		function editRow(stud_id,daysCount,month,year,holidays)
		{	
			$("#changeButton").html('<input type="submit" value="Update" name="update_attendance">');
					$.post("ajax.php", { action:"checkStudData",stud_id:stud_id,days:daysCount,month:month,year:year,holidays:holidays})	
					.done(function(data) {
							$("#row_"+stud_id).html(data);
					});
					
					days++;				
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
          <a class="navbar-brand" href="index.html">DarulHuda</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
			<?php  
				include_once "menu.php";
			?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Attendance <small>Display Attendance</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-table"></i> Tables</li>
            </ol>
            <div class="alert alert-info alert-dismissable" style="display:none;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              We're using <a class="alert-link" href="http://tablesorter.com/docs/">Tablesorter 2.0</a> for the sort function on the tables. Read the documentation for more customization options or feel free to use something else!
            </div>
          </div>
        </div><!-- /.row -->
		<form action="" method="POST">
        <div class="row">
		<div style="float:left;margin-left:2%;width:100%;">
		<div style="float:left;">
		<span class="label label-primary" >Course </span>
		<?php
		
			$course = new course();
			
			$courseDetails = $course->getCourseDetails();
			
			echo "<select name='course_id' class='form-control' style='margin-top:2%;' onchange='getAttendance(month.value);'>";
			echo "<option>Select Course</option>";
			foreach($courseDetails as $eachCourse)
			{
				if($_GET['course'] == $eachCourse['course_id'])
					echo "<option value=".$eachCourse['course_id']." selected='selected'>".$eachCourse['course_name']."</option>";	
				else
					echo "<option value=".$eachCourse['course_id'].">".$eachCourse['course_name']."</option>";
			}
			
			echo "</select>";
			
		?>
		</div>
		<div style="float:left;margin-left:5%;">
		
		<span class="label label-primary">Location </span>
		<select name="maktab_location" id="maktab_location" class="form-control" style='margin-top:2%;' onchange='getAttendance(month.value);'>
		<option>Select Location</option>
		<?php
		
			$maktab_location = array('Arshiya','Ajmera');
			
			foreach($maktab_location as $value)
			{
				if($_GET['location'] == $value)
					echo "<option selected='selected'>".$value."</option>";
				else
					echo "<option>".$value."</option>";
			}	
		
		?>
			
		</select>
		</div>
		
		<div style="float:left;margin-left:35%;"><span class="label label-primary">Month </span>
		<?php
		
			$months = array("January","February","March","April","May","June","July","August","September","October","November","December");
			
			echo "<select name='month' id='month' class='form-control' style='margin-top:2%;' onchange='getAttendance(this.value)'>";
			echo "<option value='Select Month'>Select Month</option>";
			$i = 1;
			
			foreach($months as $eachMonth)
			{	
				if($_GET['month'] == $i)
					echo "<option value=".$i." selected='selected'>".$eachMonth."</option>";
				else
					echo "<option value=".$i.">".$eachMonth."</option>";
					
				$i++;				
			}
			
			echo "</select>";
			
		?>
		</div>
		<div style="float:left;margin-left:5%;">
		<span class="label label-primary">Year </span>
		<?php
			
			echo "<select name='year' class='form-control' style='margin-top:2%;' onchange='getAttendance(month.value)'>";
			echo "<option value='Select Year'>Select Year</option>";
			for($i = STARTYEAR;$i <= ENDYEAR;$i++)
			{
				if($_GET['year'] == $i)
					echo "<option selected='selected'>".$i."</option>";	
				else
					echo "<option>".$i."</option>";	
			}
			
			echo "</select>";
			
		?>
		</div>
		</div>
		<div class="col-lg-12">
            <h4>Attendance Chart</h4>
		
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
				<tr>
                    <th>Student Name <i class="fa fa-sort"></i></th>
					
					<?php
						if(@$_GET['year'] != "" && @$_GET['month'] != "")
						{
							$feb = 0;
						
								if(is_numeric($_GET['year']))
								{	
									if($_GET['year'] % 4 == 0)
										$feb = FEB_LEAP;
									else
										$feb = FEB;
								}
						
							$monthDays = array(1=>JAN,2=>$feb,3=>MAR,4=>APR,5=>MAY,6=>JUN,7=>JUL,8=>AUG,9=>SEP,10=>OCT,11=>NOV,12=>DEC);
						
							$holidays = array();$index = 1;
						
							foreach(getSunday($_GET['year'],$_GET['month']) as $sundays)
							{	
								$holidays[$index] = $sundays->format("d");
								
								$index++;
							}
							
							if($_GET['month'] != "" && isset($_GET['month'])):
								
								$days =	$monthDays[$_GET['month']];
								
								$count = 0;
								
								for($i = 1;$i <= $days;$i++):
									echo "<th>".$i."</th>";
								endfor;	

							endif;
						}
					?>
				</tr>
                </thead>
                <tbody>
					<?php
						$student = new students();
						
						$attend = new attendance();
				
						if(@$_GET['year'] != "" && @$_GET['month'] != "")
						{	
						
						if($studDetails = $student->getStudentByCourseId(@$_GET['course'],@$_GET['location']))
						{ 		
						$i =0;
							foreach($studDetails as $eachStudent) :
							
							$studAttendance = $attend->getStudentAttendanceDetails($eachStudent['student_id'],@$_GET['month'],@$_GET['year']);
							
							echo "<tr id='row_".$eachStudent['student_id']."'>";
							echo "<td>".$eachStudent['first_name']." ".$eachStudent['last_name']."<input type='checkbox' id='all_".$eachStudent['student_id']."' value=".$eachStudent['student_id']." onclick='checkAll(this.value);'>";
								
								if(is_array($studAttendance['mst_student_id']))
								{
									if(in_array($eachStudent['student_id'],$studAttendance['mst_student_id']))
										echo "<a href='javascript:void(0);'  onclick='editRow(".$eachStudent['student_id'].",".$days.",".$_GET['month'].",".$_GET['year'].");' id=".$eachStudent['student_id'].">Edit</a></td>";
								}
								else
									echo "</td>";
									
									
							
							for($i = 1;$i <= $days;$i++):
							
									if(in_array($i,$holidays))
									{								
										echo "<td style='background-color:#CFCDCD;'></td>";
									}
									else
									{
										if(is_array($studAttendance))
										{
											if(in_array($i, $studAttendance['attendance_day']))
												echo "<td>P</td>";
											else	
												echo "<td><input type='checkbox' class='chkbox".$eachStudent['student_id']."' name='date[".$i."_".$eachStudent['student_id']."]'></td>";	
										}											
										else	
											echo "<td><input type='checkbox'  class='chkbox".$eachStudent['student_id']."' name='date[".$i."_".$eachStudent['student_id']."]'></td>";
									}
									
									$index++;								
							endfor;
							echo "</tr>";
							$i++;
							endforeach;
							
						}
						}
					?>
                </tbody>
              </table>
			<div id="changeButton"><input type="submit" value="Save" name="save_attendance"></div>
            </div>
          </div>
        </div><!-- /.row -->

		</form>
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
			$("#menu_attend").attr("class","active");
		});
	</script>
    <!-- Page Specific Plugins -->
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

  </body>
</html>