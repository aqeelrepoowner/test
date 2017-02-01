<?php
	ob_start();
	
	
	function __autoload($className)
	{
		include_once $className.".php";
	}

	if(isset($_POST['confirm_donate']))
	{
		
		$donate = new donate();
		
		$returnValue = $donate->confirmDonation($_POST);
		
		header("Location:view_donation.php");
	}
			
				 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DarulHuda - Add Students</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	
	<!-- DarulHuda CSS here-->
	<link rel="stylesheet" href="css/darulhuda.css">
	
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
          <a class="navbar-brand" href="index.php">SB Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
       <?php include_once "menu.php"; ?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Forms <small>Enter Your Data</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-edit"></i>Charity</li>
            </ol>
              </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
			<h4>Personal Details</h4>
            <form role="form" method="post" action="">

              <div class="form-group">
                <label>First Name</label>
                <input class="form-control" name="first_name" placeholder="Enter first name">
                <p class="help-block"></p>
              </div>
			  

			<div class="form-group">
                <label>Middle Name</label>
                <input class="form-control" name="middle_name" placeholder="Enter middle name">
                <p class="help-block"></p>
              </div>
			  
		
			  
			<div class="form-group">
                <label>Last Name</label>
                <input class="form-control" name="last_name" placeholder="Enter last name">
                <p class="help-block"></p>
              </div>
			  
			 
			  <div class="form-group">
                <label>Contact Number</label>
                <input class="form-control" name="contact_number" placeholder="Enter contact number">
                <p class="help-block"></p>
              </div>
			  
			  <div class="form-group">
                <label>Alternate Contact Number</label>
                <input class="form-control" name="alternate_contact_number" placeholder="Enter alternate contact number">
                <p class="help-block"></p>
              </div>
           <input type="submit" class="btn btn-success" name="confirm_donate" value="Donate Amount">
              <button type="reset" class="btn btn-danger">Reset Button</button>  
			</div> 
			
			<div class="col-lg-6">
			<h4>Other Details</h4>
			<div class="form-group">
			
                <label>Email Id</label>
                <input class="form-control" placeholder="Enter email" name="email_id">
              </div>
			
			<div class="form-group">
                <label>Address</label>
                 <textarea class="form-control" placeholder="Enter address" rows="3" name="address"></textarea>
                <p class="help-block"></p>
              </div> 
			
			
			
			 <div class="form-group">
                <label>Occupation</label>
                <select class="form-control" name="occupation" placeholder="Enter text">
					<option>Please Select</option>
					<option>Salaried</option>
					<option>Business</option>
					 </select>
              </div>
			
			
			<div class="form-group">
                <label>Date of Donation</label>
				  
			  <input id="dod" name="dod" type="text" class="form-control">
              	 
                <p class="help-block"></p>
              </div>
			  
			 			<div class="form-group">
                <label>Amount Donated</label>
                <input class="form-control" placeholder="Enter amount in INR" name="amt_donate">
              </div>
			 
			 
              

          </div>
                     
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
	<script src="js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<script>
	$(function() {
			
			$("#dod").datepicker();
		});
	</script>
	<script>
		$(document).ready(function()
		{	
			//alert("hi");
			$("#menu_charity").attr("class","active");
		});
	</script>
</html>
<?php
ob_end_flush();
?>