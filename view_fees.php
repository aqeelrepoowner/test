	<?php

	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	$authenticate = new authenticate();
	
	$authenticate->checkLoginStatus();
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if($_POST['action'] == "save_fees_details")
		{	
			$fees = new fees();
			
			$fees->addFeesDetails($_POST);
		
			header("Location:".$_SERVER['HTTP_REFERER']);
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

    <title>Darul Huda - Fees Details</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
	 <link href="css/fees_payment_history.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<script>
	function searchStudent()
	{	
		var roll_number = $("#roll_number").val();
		
		var student_name = $("#student_name").val();
			
		var courseId = $("select[name=maktab_course]").val();
			
		var year = $("#year").val();
		
			if(courseId != "Please Select")
			{
				if(roll_number == "" && student_name == "")
				{
					$("#feesDetails").html("");
					
					$(".alert").attr("style","display:block;");
						
					$(".alert").html("Atleast submit name or roll number value");
				}
				else
				{
					$.post("ajax.php", { action:"fees_details",roll_number:roll_number,student_name:student_name,courseId:courseId,year:year})	
					.done(function(data) {	
						document.getElementById('feesDetails').innerHTML = data;
					});
					
					$(".alert").attr("style","display:none;");
					
					$(".alert").html("");
				}
			}
			else
			{
				$("#feesDetails").html("");
					
				$(".alert").attr("style","display:block;");
						
				$(".alert").html("Course name must not be empty");
				
			}
	}
	
	function validateFees()
	{
		var feesReceived = document.getElementsByClassName("fees_received");
		var totalFees = document.getElementsByClassName("total_fees");
		var amountDue = document.getElementsByClassName("fees_due");
		var fees_status = document.getElementsByClassName("fees_status");
		var paymentDate = document.getElementsByClassName("payment_date");
	
		var i;
		
		var isValid = false;
		
		for(i = 0;i<feesReceived.length;i++)
		{	
			if(feesReceived[i].disabled == false && feesReceived[i].value != "" && totalFees[i].value != "" && amountDue[i].value != "" && fees_status[i].value != "" && paymentDate[i].value != "")
			{
				
			  
				var feesRec = feesReceived[i].value;
				var total_amt = totalFees[i].value;
				
				if(amountDue[i].value == "" && (feesReceived[i].value < totalFees[i].value || feesRec.length < total_amt.length))
				{
					amountDue[i].style.background = "Red";
			
					isValid = false; 
				}
				else {
				
					isValid = true;
					break;
				}	
				
			}
			else
			{
				$(".alert").attr("style","display:block;");
				$(".alert").html("Please fill all textboxes of atleast 1 row");
				$('html, body').animate({ scrollTop: 3}, 'swing');
				isValid = false;
			}
			
		}
		
		if(isValid == true)
			return true;
		else
			return false;
			
	}
	
	
	function enableEdit(value)
	{
		$("#monthTable tbody tr:eq("+value+") td").each(function(index,element){
		
			$(this).find("input[type=text]").each(function(){
				$(this).removeAttr("disabled");
			});
			
			$(this).find("select").each(function(){
				$(this).removeAttr("disabled");
			});
				
		});
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
            <h1>Fees Details</h1><small style="background-color:rgb(245, 245, 245);padding:5px;float:right;color:red;">Please select below details from below</small>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Home</a></li>
              <li class="active"><i class="icon-file-alt"></i>Fees Details</li>
			 
            </ol>
			<div class="alert alert-danger alert-dismissable" style="display:none;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>			
				
			
          </div>
		
		   <form method="post" action="" onsubmit="return validateFees();">
		   
			<div class="col-lg-4"> 
			
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
                <label>Enter roll number of the Student</label>
                <input class="form-control" name="roll_number" id="roll_number" placeholder="Enter roll number of the Student">
                <p class="help-block"></p>
              </div>
			  
			  <div class="form-group">
                <label>Enter name of the Student</label>
                <input class="form-control" name="student_name" id="student_name" placeholder="Enter name of the Student">
                <p class="help-block"></p>
              </div>
			  
			  <div class="form-group">
                <label>Year</label>
				<select name="year" id="year" class="form-control">
					<?php
					$i = STARTYEAR;
						
						while($i < ENDYEAR)
						{	
							 $j = $i + 1;
							echo "<option>".$i."-".$j."</option>";
							$i = $j;
						}
					?>
				</select>
                <p class="help-block"></p>
              </div>
			 
				<input type="button" class="btn btn-default" name="search_student" onclick="searchStudent();" value="Go">
              <button type="reset" class="btn btn-default">Reset Button</button>  
			</div>
				
			   	<div class="col-lg-4">
				 <div class="form-group">
                <label>Remarks</label>
                 <textarea class="form-control" placeholder="Enter text" rows="3" name="remarks"></textarea>
                <p class="help-block"></p>
              </div> 
				</div>
				<br/>
			 <div class="row" id="feesDetails">
          
         
			</div><!-- /.row -->
			
			<input type="hidden" name="action" value="save_fees_details">
		
			  </form>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js" ></script>
	
    <script src="js/bootstrap.js" ></script>
	<script>
		$(document).ready(function()
		{	
			//alert("hi");
			$("#menu_fees").attr("class","active");
		});
	</script>
	 <!-- Page Specific Plugins -->
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
	
	
  </body>
</html>