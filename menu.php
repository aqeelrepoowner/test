<?php


	include_once "config/dlhudaDB.php";

	$conn =  dlhudaDB::getInstance();

?>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li id="menu_dashboard"><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li id="menu_students"><a href="view_students.php"><img src="<?php echo MENU_ICONS. "user-student-icon.png" ?>"></img>Students</a></li>
			<li id="menu_teacher"><a href="view_teacher.php"><img style="height:32px;width:32px;" src="<?php echo MENU_ICONS. "Teacher-male-icon.png" ?>"></img>Teacher</a></li>
			<li id="menu_attend"><a href="view_attendance.php"><img style="height:32px;width:32px;" src="<?php echo MENU_ICONS. "checklist-icon.png" ?>"></img>Attendance</a></li>
			<li id="menu_course"><a href="display_course.php"><img style="height:32px;width:32px;" src="<?php echo MENU_ICONS. "Courses-icon.png" ?>"></img>&nbsp;Course</a></li>
			<li id="menu_subjects"><a href="view_subjects.php"><img style="height:32px;width:32px;" src="<?php echo MENU_ICONS. "folder_with_file	.png" ?>"></img>&nbsp;Subjects</a></li>
            <li id="menu_fees"><a href="view_fees.php"><img style="height:32px;width:32px;" src="<?php echo MENU_ICONS. "money.png" ?>"></img>&nbsp;Fees Details</a></li>
            <li id="menu_exam"><a href="view_exam_details.php"><img style="height:32px;width:32px;" src="<?php echo MENU_ICONS. "test-paper.png" ?>"></img>&nbsp;Exams</a></li>          
            <li id="menu_report" ><a href="view_reports.php" onclick="activeMenu('menu_report');"><img style="height:32px;width:32px;" src="<?php echo MENU_ICONS. "report.png" ?>"></img>&nbsp; Reports</a></li>
            <li id="menu_charity"><a href="view_donation.php"><img style="height:32px;width:32px;" src="<?php echo MENU_ICONS. "donate-icons.png" ?>"></img>&nbsp; Charity</a></li>
            <li><a href="blank-page.html"><i class="fa fa-file"></i>&nbsp; Blank Page</a></li>
        
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
           
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php  echo "Welcome ".$_SESSION['username']."!"; ?>  <b class="caret"></b></a>
              <ul class="dropdown-menu">
                
                <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->