<?php
	
	include_once("config/dlhudaDB.php");

	class teacher
	{	

		function getTeacherDetails()
		{
			
			$conn = dlhudaDB::getInstance();
			
			$teacherRS = $conn->query("SELECT * FROM ". DHTEACH);
			
			$teacherDetails = array();
			
			while($teachers = mysqli_fetch_assoc($teacherRS))
			{	
				$teacherDetails[] = $teachers;
			}
			
			return $teacherDetails;
		}
		
		function getTeacherById($teacherId)
		{
			$conn = dlhudaDB::getInstance();
			
			if($teacherRS = $conn->query("SELECT * FROM ". DHTEACH." WHERE teacher_id = ".$teacherId)):
			
			return mysqli_fetch_assoc($teacherRS);

			endif;
		}
		
		function addTeacher($teacherValues)
		{		
			extract($teacherValues);
			
			$conn = dlhudaDB::getInstance();
			
			$dob_teacher = new DateTime($dob_teacher);
	
			$dob_format = $dob_teacher->format("Y-m-d"); 
			
			$conn->query("INSERT INTO ". DHTEACH ."(teacher_first_name,teacher_middle_name,teacher_last_name,gender,teacher_dob,address,contact_no,qualification) VALUES('$first_name','$middle_name','$last_name','$gender','$dob_format','$address','$contact_no','$qualification')");
			
		}	
		
		function editTeacher($teacherValues)
		{
			extract($teacherValues);	
			$conn = dlhudaDB::getInstance();

			$date = new DateTime($dob_teacher);	
			
			$finalDate = $date->format('Y-m-d');
				
			$conn->query("UPDATE ". DHTEACH ." SET teacher_first_name = '$first_name',teacher_middle_name = '$middle_name',teacher_last_name = '$last_name',gender = '$gender',
			teacher_dob = '$finalDate',address = '$address',contact_no = $contact_no,qualification = '$qualification' WHERE teacher_id = ".$_GET['id']);	
			
		}
		
		function deleteTeacher($teacherID)
		{
			$conn = dlhudaDB::getInstance();
				
			$teacherID = $conn->real_escape_string($teacherID);
			
			$conn->query("DELETE FROM mst_teacher WHERE teacher_id = $teacherID");	
	
		}

	}

?>