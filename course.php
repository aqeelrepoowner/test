<?php
	
	include_once("config/dlhudaDB.php");

	class course
	{	

		function getCourseDetails()
		{
			$conn = dlhudaDB::getInstance();
			
			$courseRS = $conn->query("SELECT * FROM ". DHCOURSE);
			
			$courseDetails = array();
			
			while($course = mysqli_fetch_assoc($courseRS))
			{	
				$courseDetails[] = $course;
			}
			
			return $courseDetails;
		}
		
		function addCourse($courseValues)
		{	
			extract($courseValues);
			
			$conn = dlhudaDB::getInstance();
		
			$conn->query("INSERT INTO ". DHCOURSE."(course_name,course_description) VALUES('$course_name','$course_desc')");
		}

		function getCourseById($courseId)
		{		
			$conn = dlhudaDB::getInstance();
			//echo "SELECT * FROM ". DHCOURSE . " WHERE course_id =".$courseId;
			
			$courseRS = $conn->query("SELECT * FROM ". DHCOURSE . " WHERE course_id =".$courseId);
			
			//$courseDetails = array();
			
			$course = mysqli_fetch_assoc($courseRS);
			
			return $course;
		
		}
		
		function updateCourse($postData) {
			
			extract($postData);
			
			$conn = dlhudaDB::getInstance();

		//	echo "UPDATE ".DHCOURSE." SET course_name = '$course_name',course_description='$course_desc' WHERE course_id = ".$courseID;exit;
			$conn->query("UPDATE ".DHCOURSE." SET course_name = '$course_name',course_description='$course_desc' WHERE course_id = ".$course_id);
		}
		
		function deleteCourse($courseId) {
			
			$conn = dlhudaDB::getInstance();
			
			$conn->query("DELETE FROM ".DHCOURSE." WHERE course_id = ".$courseId);
		}
	
	}
	

?>