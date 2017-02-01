<?php
	
	include_once("config/dlhudaDB.php");
	
	class attendance
	{
		function addStudentAttendance($month = "",$year = "",$datePresent ="" ,$student_id = "")
		{	
			$conn = dlhudaDB::getInstance();
			
			
			/* if(is_numeric($year))
				{	
					if($year % 4 == 0)
						$feb = FEB_LEAP;
					else
						$feb = FEB;
				}
				
			$monthDays = array(1=>JAN,2=>$feb,3=>MAR,4=>APR,5=>MAY,6=>JUN,7=>JUL,8=>AUG,9=>SEP,10=>OCT,11=>NOV,12=>DEC);
			
			$calendarDays = $monthDays[$month];
	
			$working_days = $calendarDays - $holidaysCount;
			
			$absent_days = $working_days - $presentDays; */
			
			echo "INSERT INTO ". DHATTEND ."(name_of_month,name_of_year,attendance_day,mst_student_id,status) 
			VALUES('$month','$year','$datePresent','$student_id','Present')";
			
			$conn->query("INSERT INTO ". DHATTEND ."(name_of_month,name_of_year,attendance_day,mst_student_id,status) 
			VALUES('$month','$year','$datePresent','$student_id','Present')");
			
		}	
		
		function deleteStudentAttendance($month = "",$year = "",$student_id = "")
		{	
			$conn = dlhudaDB::getInstance();
			
			$conn->query("DELETE FROM ".DHATTEND." WHERE name_of_month = '$month' AND name_of_year = '$year' AND mst_student_id = $student_id");
		}
		
		function getStudentAttendanceDetails($studentId,$month,$year,$attendDay = "")
		{	
			$conn = dlhudaDB::getInstance();
		
			if($studentId != "" && $month != "" && $year != "")
			{	
				//echo "SELECT * FROM ".DHATTEND." WHERE mst_student_id = ".$studentId." AND name_of_month = '".$month."' AND name_of_year = '".$year."' AND status = 'Present' ";	
				
				if($attendDay == "")
					$query = "SELECT * FROM ".DHATTEND." WHERE mst_student_id = ".$studentId." AND name_of_month = '".$month."' AND name_of_year = '".$year."' AND status = 'Present' ";
				else
					$query = "SELECT * FROM ".DHATTEND." WHERE mst_student_id = ".$studentId." AND name_of_month = '".$month."' AND name_of_year = '".$year."' AND attendance_day = ".$attendDay." AND status = 'Present' ";
				
				if($studAttendRS = $conn->query($query))
				{
					if(mysqli_num_rows($studAttendRS) > 0) :
						$attendanceDetails = array();
						
						while($attendRS = mysqli_fetch_assoc($studAttendRS))
						{	
							$attendanceDetails['attendance_day'][] = $attendRS['attendance_day'];
							$attendanceDetails['mst_student_id'][] = $attendRS['mst_student_id'];	
						}
						
						return $attendanceDetails;
					endif;
				}
				else
					return "";
			}
		}
		
		function getAllAttendanceDetails($studentId,$month,$year)
		{	
			$conn = dlhudaDB::getInstance();
			
			$query = " SELECT count(*) as days FROM `mst_attendance` WHERE name_of_month = $month and name_of_year = $year AND mst_student_id = $studentId
						group by name_of_month";
					
				if($studAttendRS = $conn->query($query))
				{
					if(mysqli_num_rows($studAttendRS) > 0) :
				
						$attendRS = mysqli_fetch_assoc($studAttendRS);
						return $attendRS;
					endif;
				}
				else
					return "";			
						
						
		}
		
		function getStudentByAttendDays($attendDay,$studentId,$month,$year)
		{		
			$conn = dlhudaDB::getInstance();
		
			if($studentId != "" && $month != "" && $year != "")
			{	
				if($studAttendRS = $conn->query("SELECT * FROM ".DHATTEND." WHERE attendance_day = ".$attendDay." AND  mst_student_id = ".$studentId." AND name_of_month = '".$month."' AND name_of_year = '".$year."' AND status = 'Present' "))
				{
					if(mysqli_num_rows($studAttendRS) > 0) :
						return 1;
					else:
						return 0;

					endif;					
				}
				else
					return 0;
			}
		}
	}
?>