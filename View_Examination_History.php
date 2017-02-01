<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Darul Huda - Examination History</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	 <link href="css/fees_payment_history.css" rel="stylesheet">
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
          <a class="navbar-brand" href="index.html">Darul Huda</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="charts.html"><i class="fa fa-bar-chart-o"></i> Charts</a></li>
            <li><a href="tables.html"><i class="fa fa-table"></i> Tables</a></li>
            <li><a href="forms.html"><i class="fa fa-edit"></i> Forms</a></li>
            <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
            <li><a href="bootstrap-elements.html"><i class="fa fa-desktop"></i> Bootstrap Elements</a></li>
            <li><a href="bootstrap-grid.html"><i class="fa fa-wrench"></i> Bootstrap Grid</a></li>
            <li class="active"><a href="blank-page.html"><i class="fa fa-file"></i> Blank Page</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Dropdown Item</a></li>
                <li><a href="#">Another Item</a></li>
                <li><a href="#">Third Item</a></li>
                <li><a href="#">Last Item</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">7 New Messages</li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li><a href="#">View Inbox <span class="badge">7</span></a></li>
              </ul>
            </li>
            <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                <li class="divider"></li>
                <li><a href="#">View All</a></li>
              </ul>
            </li>
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Examination History<small></small></h1>
            <ol class="breadcrumb">
              <li><a href="index.html"><i class="icon-dashboard"></i> Home</a></li>
              <li class="active"><i class="icon-file-alt"></i>Exams</li>
			  <li class="active"><i class="icon-file-alt"></i>Examination History</li>
            </ol>
          </div>
		   <form method="post" action="">
		  <div class="col-lg-4"> 
			  <div class="form-group">
					<label>Enter class of the Student</label>
					<select class="form-horizontal" name="student_class" placeholder="Enter class of the Student">
						<option>Please Select</option>
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
				  </div>
			 <div class="form-group">
					<label>Enter school location of the Student</label>
					<select class="form-horizontal" name="student_class" placeholder="Enter school location of the Student">
						<option>Please Select</option>
						<option>Arshiya</option>
						<option>Ajmera</option>
						
					</select>
				  </div>	  
				  
			  <div class="form-group">
                <label>Enter roll number of the Student</label>
                <input class="form-control" name="roll_number" placeholder="Enter roll number of the Student">
                <p class="help-block"></p>
              </div>
			  </div>
			  
			  <div id="datepicker"></div>
	<p>
		Dates:
		<input type="text" id="input1" size="10">
		<input type="text" id="input2" size="10">
	</p>
			  
			  <div class="row">
          <div class="col-fees-10">
            <h2>Examination Details</h2>
			<p>Exam details of <b>xxx</b> for the academic <b>Year</b> are mentioned below
		
            <div class="table-responsive">
				<label>1) Terminal Details</label>
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
				    <th>Sr.No<i class="fa fa-sort"></i></th>
                    <th>Name Of the Student <i class="fa fa-sort"></i></th>                 
                    <th>Name of the Subject <i class="fa fa-sort"></i></th>
					<th>Marks Obtained <i class="fa fa-sort"></i></th>
					<th>Total Marks <i class="fa fa-sort"></i></th>
					<th>Grade <i class="fa fa-sort"></i></th>
					<th>Rank <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="active">
				   <td>1</td>
				   <td>101</td>
				    
                    <td>/index.html</td>
                    <td>1265</td>
                    <td>32.3%</td>
                    <td>$321.33</td>
					<td>$321.33</td>
                  </tr>
                  <tr class="success">
				    <td>2</td>
					 <td>101</td>
                    <td>/about.html</td>
                    <td>261</td>
                    <td>33.3%</td>
                    <td>$234.12</td>
					<td>$321.33</td>
                  </tr>
                  <tr class="warning">
				    <td>3</td>
					<td>101</td>
                    <td>/sales.html</td>
                    <td>665</td>
                    <td>21.3%</td>
                    <td>$16.34</td>
					<td>$321.33</td>
                  </tr>
                  <tr class="danger">
				    <td>4</td>
					<td>101</td>
                    <td>/blog.html</td>
                    <td>9516</td>
                    <td>89.3%</td>
                    <td>$1644.43</td>
					<td>$321.33</td>
                  </tr>
                  <tr>
				    <td>5</td>
					<td>101</td>
                    <td>/404.html</td>
                    <td>23</td>
                    <td>34.3%</td>
                    <td>$23.52</td>
					<td>$321.33</td>
                  </tr>
                  <tr>
				    <td>6</td>
                    <td>101</td>
					<td>/services.html</td>
                    <td>421</td>
                    <td>60.3%</td>
                    <td>$724.32</td>
					<td>$321.33</td>
                  </tr>
                  <tr>
				    <td>7</td>
					<td>102</td>
				   <td>/blog/post.html</td>
                    <td>1233</td>
                    <td>93.2%</td>
                    <td>$126.34</td>
					<td>$321.33</td>
                  </tr>
                </tbody>
              </table>
            </div>
			
			<div class="table-responsive">
				<label>2) Annual Details</label>
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
				    <th>Sr.No <i class="fa fa-sort"></i></th>
                    <th>Name Of the Student <i class="fa fa-sort"></i></th>                 
                    <th>Name of the Subject <i class="fa fa-sort"></i></th>
					<th>Marks Obtained <i class="fa fa-sort"></i></th>
					<th>Total Marks <i class="fa fa-sort"></i></th>
					<th>Grade <i class="fa fa-sort"></i></th>
					<th>Rank <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="active">
				   <td>1</td>
				   <td>101</td>
				    
                    <td>/index.html</td>
                    <td>1265</td>
                    <td>32.3%</td>
                    <td>$321.33</td>
					<td>$321.33</td>
                  </tr>
                  <tr class="success">
				    <td>2</td>
					 <td>101</td>
                    <td>/about.html</td>
                    <td>261</td>
                    <td>33.3%</td>
                    <td>$234.12</td>
					<td>$321.33</td>
                  </tr>
                  <tr class="warning">
				    <td>3</td>
					<td>101</td>
                    <td>/sales.html</td>
                    <td>665</td>
                    <td>21.3%</td>
                    <td>$16.34</td>
					<td>$321.33</td>
                  </tr>
                  <tr class="danger">
				    <td>4</td>
					<td>101</td>
                    <td>/blog.html</td>
                    <td>9516</td>
                    <td>89.3%</td>
                    <td>$1644.43</td>
					<td>$321.33</td>
                  </tr>
                  <tr>
				    <td>5</td>
					<td>101</td>
                    <td>/404.html</td>
                    <td>23</td>
                    <td>34.3%</td>
                    <td>$23.52</td>
					<td>$321.33</td>
                  </tr>
                  <tr>
				    <td>6</td>
                    <td>101</td>
					<td>/services.html</td>
                    <td>421</td>
                    <td>60.3%</td>
                    <td>$724.32</td>
					<td>$321.33</td>
                  </tr>
                  <tr>
				    <td>7</td>
					<td>102</td>
				   <td>/blog/post.html</td>
                    <td>1233</td>
                    <td>93.2%</td>
                    <td>$126.34</td>
					<td>$321.33</td>
                  </tr>
                </tbody>
              </table>
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

	 <!-- Page Specific Plugins -->
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<script type="text/javascript">
		/*
		 * jQuery UI Datepicker: Using Datepicker to Select Date Range
		 * 
		 */
		$(function() {
			$("#datepicker").datepicker({
				beforeShowDay: function(date) {
					var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#input1").val());
					var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#input2").val());
					return [true, date1 && ((date.getTime() == date1.getTime()) || (date2 && date >= date1 && date <= date2)) ? "dp-highlight" : ""];
				},
				onSelect: function(dateText, inst) {
					var date1 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#input1").val());
					var date2 = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#input2").val());
					if (!date1 || date2) {
						$("#input1").val(dateText);
						$("#input2").val("");
						$(this).datepicker("option", "minDate", dateText);
					} else {
						$("#input2").val(dateText);
						$(this).datepicker("option", "minDate", null);
					}
				}
			});
		});
	</script>
  </body>
</html>