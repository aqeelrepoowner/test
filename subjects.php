<?php
	
	include_once("config/dlhudaDB.php");

	class subjects
	{	
		function getSubjectDetails($courseId)
		{
			$conn = dlhudaDB::getInstance();
			
			if($subjectRS = $conn->query("SELECT * FROM ". DHSUBJECT ." WHERE mst_course_course_id =".$courseId))
			{
				$subjectDetails = array();
				
				while($subject = mysqli_fetch_assoc($subjectRS))
				{	
					$subjectDetails[] = $subject;
				}

				return $subjectDetails;
			}
			else
				return "";
		}
		
		function getSubjectAllDetails()
		{
			$conn = dlhudaDB::getInstance();
			
			if($subjectRS = $conn->query("SELECT * FROM ". DHSUBJECT. " JOIN mst_course ON mst_course.course_id = mst_subject.mst_course_course_id "))
			{
				$subjectDetails = array();
				
				while($subject = mysqli_fetch_assoc($subjectRS))
				{	
					$subjectDetails[] = $subject;
				}

				return $subjectDetails;
			}
			else
				return "";
		}
		
		function addSubject($subjectValues)
		{	
			extract($subjectValues);
			
			$conn = dlhudaDB::getInstance();
		
			//echo "INSERT INTO ". DHSUBJECT."(subject_name,subject_description,mst_course_course_id) VALUES('$subject_name','$subject_desc','$maktab_course')";
			$conn->query("INSERT INTO ". DHSUBJECT."(subject_name,subject_description,mst_course_course_id) VALUES('$subject_name','$subject_desc','$maktab_course')");
		}	
		
		function getSubjectById($subjectId) {
			
			$conn = dlhudaDB::getInstance();
			
			$subjectRS = $conn->query("SELECT * FROM ".DHSUBJECT." JOIN mst_course ON mst_course.course_id = mst_subject.mst_course_course_id WHERE subject_id =".$subjectId);
			
			$subjectDetails = $subjectRS->fetch_assoc();
			
			return $subjectDetails;
			
		}
		
		function updateSubject($postData) {
		
			extract($postData);	
			
			$conn = dlhudaDB::getInstance();
			
			$conn->query("UPDATE ".DHSUBJECT." SET subject_name = '$subject_name',mst_course_course_id=$maktab_course,subject_description = '$subject_desc'
			WHERE subject_id = $subject_id");
			
		}
		
		function deleteSubject($subjectId) {
		
			$conn = dlhudaDB::getInstance();
			
			$conn->query("DELETE FROM ".DHSUBJECT." WHERE subject_id = ".$subjectId);
		}
		
		
	}

?>