<?php
	
	include "config/dlhudaDB.php";

	class teacher
	{

		function getTeacherDetails()
		{
			$conn = dlhudaDB::getInstance();
			
			//echo "SELECT * FROM ". DHTEACH;exit;l
			
			$teacherRS = $conn->query("SELECT * FROM ". DHTEACH);
			
			$teacherDetails = array();
			
			while($teachers = mysqli_fetch_assoc($teacherRS))
			{	
				$teacherDetails[] = $teachers;
			}
			
			return $teacherDetails;
		}
		
	}?>