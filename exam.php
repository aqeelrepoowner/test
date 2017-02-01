<?php

	include_once("config/dlhudaDB.php");
	include_once("config/dlhuda_config.php");

	class exam
	{
		
		function addExamDetails($examDetails)
		{	
			extract($examDetails);
			
			$conn = dlhudaDB::getInstance();
			
			$dob = new DateTime($exam_date);
	
			$dob_format = $dob->format("Y-m-d"); 
			
			$total_marks_obtain = array_sum($marks_obtained);
			
			$out_of_marks = array_sum($total_marks);
			
			$exam_presence = $exam_presence == "on" ? "Yes" : "No";
			
			$teacher_acknowledge = @$teacher_acknowledge == "on" ? "Yes" : "No";
			
			$parent_acknowledge = @$parent_acknowledge == "on" ? "Yes" : "No";
			
			$leader_acknowledge = @$leader_acknowledge == "on" ? "Yes" : "No";
			
			$studentRS = $conn->query("SELECT student_guid FROM ".DHSTUD ." WHERE student_id=".$roll_number);
			
			$student_details = mysqli_fetch_assoc($studentRS);
			
			$courseRS = $conn->query("SELECT course_name FROM ". DHCOURSE ." WHERE course_id=".$maktab_course);
			
			$course_details = mysqli_fetch_assoc($courseRS);

			$conn->query("INSERT INTO ". DHEXAM ."(exam_type,exam_date,exam_presence,remarks,teacher_acknowledgement,parent_acknowledgement,
			leader_acknowledgement,marks_obtained,out_of_marks,mst_course_course_id,mst_course_course_name,mst_students_student_id,mst_students_student_guid) 
			VALUES('$exam_type','$dob_format','$exam_presence','$remarks','$teacher_acknowledge','$parent_acknowledge',
			'$leader_acknowledge',$total_marks_obtain ,$out_of_marks,$maktab_course,'".$course_details['course_name']."',$roll_number,'".$student_details['student_guid']."')");
			
			$newId = $conn->insert_id;
			
			foreach($marks_obtained as $key => $value)
			{
				//echo "INSERT INTO ". DHMARKS ."(mst_subject_subject_id,exam_details_exam_id,marks_obtained) 
				//VALUES($key,$newId,$value)";
				$conn->query("INSERT INTO ". DHMARKS ."(mst_subject_subject_id,exam_details_exam_id,marks_obtained) 
				VALUES($key,$newId,$value)");
			}
		
		}	
		
		function updateExamDetails($examDetails)
		{
			extract($examDetails);
			
			$conn = dlhudaDB::getInstance();
			
			$dob = new DateTime($exam_date);
	
			$dob_format = $dob->format("Y-m-d"); 
			
			$total_marks_obtain = array_sum($marks_obtained);
			
			$out_of_marks = array_sum($total_marks);
			
			$exam_presence = $exam_presence == "on" ? "Yes" : "No";
			
			$teacher_acknowledge = @$teacher_acknowledge == "on" ? "Yes" : "No";
			
			$parent_acknowledge = @$parent_acknowledge == "on" ? "Yes" : "No";
			
			$leader_acknowledge = @$leader_acknowledge == "on" ? "Yes" : "No";
			
			$query = "UPDATE ".DHEXAM." SET exam_type = '$exam_type',exam_date = '$dob_format',exam_presence = '$exam_presence',remarks = '$remarks'
			,teacher_acknowledgement = '$teacher_acknowledge',parent_acknowledgement = '$parent_acknowledge',
			leader_acknowledgement = '$leader_acknowledge',marks_obtained = $total_marks_obtain,out_of_marks = $out_of_marks 
			WHERE mst_students_student_id = $roll_number AND mst_course_course_id = $course_id AND exam_type = '$exam_type'";
			
			//echo $query;
			
			$conn->query($query);
			
			foreach($marks_obtained as $key => $value)
			{
				$conn->query("UPDATE ". DHMARKS ." SET marks_obtained = $value WHERE mst_subject_subject_id = $key AND exam_details_exam_id =.". $_POST['exam_id']);
			}
		}
		
		function getExamDetails($examDetails)
		{	
			extract($examDetails);
	
			$conn = dlhudaDB::getInstance();
			
			$student = new students();
			
			$student_id = "";
			
			$query = "";
			
			if(@$rollNo != "" && @$student_name == "")
			{
				$query = "SELECT * FROM ".DHEXAM." 
				INNER JOIN ".DHSTUD." ON ".DHEXAM.".mst_students_student_id = ".DHSTUD.".student_id 
				INNER JOIN ".DHCOURSE." ON  ".DHEXAM.".mst_course_course_id = ".DHCOURSE.".course_id
				WHERE ".DHSTUD.".student_id = $rollNo AND academic_year = '$academic_year' 
				AND ".DHEXAM.".mst_course_course_id = ".$courseId." ";
			}
			elseif(@$rollNo == "" && @$student_name != "")
			{
				$studentDetails = $student->getStudentByName($student_name);
				
				$roll_number = $studentDetails['student_id'];
				
				$query = "SELECT * FROM ".DHEXAM." 
				INNER JOIN ".DHSTUD." ON ".DHEXAM.".mst_students_student_id = ".DHSTUD.".student_id 
				INNER JOIN ".DHCOURSE." ON  ".DHEXAM.".mst_course_course_id = ".DHCOURSE.".course_id
				WHERE ".DHSTUD.".student_id = $roll_number AND academic_year = '$academic_year' 
				AND ".DHEXAM.".mst_course_course_id = ".$courseId."  ";
			
			}
			elseif(@$rollNo != "" && @$student_name != "")
			{
				$studentByName = $student->getStudentByName($student_name);
				
				$rollByName = $studentByName['student_id'];
				
				$studentById =  $student->getStudentById($rollNo);
				
				$rollByID =  $studentById['student_id'];
				
				if($rollByID == $rollByName)
				{
					$query = "SELECT * FROM ".DHEXAM." 
					INNER JOIN ".DHSTUD." ON ".DHEXAM.".mst_students_student_id = ".DHSTUD.".student_id 
					INNER JOIN ".DHCOURSE." ON  ".DHEXAM.".mst_course_course_id = ".DHCOURSE.".course_id
					WHERE ".DHSTUD.".student_id = $rollByID AND academic_year = '$academic_year' 
					AND ".DHEXAM.".mst_course_course_id = ".$courseId."";
		
				}
			}

				
			if(@$query != "")
			{
				$connRs = $conn->query($query);
				
				$examDtls = array();	
					
				while($examDetails = mysqli_fetch_assoc($connRs))
				{
					$examDtls[] = $examDetails;
				}
				
				return $examDtls;
			}
			
		}
		
		function checkExamDetails($examDetails)
		{
			extract($examDetails);			
			
			$conn = dlhudaDB::getInstance();
			
			$student = new students();
			
			$student_id = "";
			
			$query = "";
			var_dump($_POST);exit;
			if(@$roll_number != "" && @$student_name == "")
			{
				$query = "SELECT mst_students_student_id FROM ".DHEXAM." 
				INNER JOIN ".DHSTUD." ON ".DHEXAM.".mst_students_student_id = ".DHSTUD.".student_id 
				INNER JOIN ".DHCOURSE." ON  ".DHEXAM.".mst_course_course_id = ".DHCOURSE.".course_id
				WHERE ".DHSTUD.".roll_no = '$roll_number' AND academic_year = '$academic_year' 
				AND ".DHEXAM.".mst_course_course_id = ".$courseId." AND exam_type = '$exam_type'";
			}
			elseif(@$roll_number == "" && @$student_name != "")
			{
				$studentDetails = $student->getStudentByName($student_name);
				
				$roll_number = $studentDetails['student_id'];
				
				$query = "SELECT mst_students_student_id FROM ".DHEXAM." 
				INNER JOIN ".DHSTUD." ON ".DHEXAM.".mst_students_student_id = ".DHSTUD.".student_id 
				INNER JOIN ".DHCOURSE." ON  ".DHEXAM.".mst_course_course_id = ".DHCOURSE.".course_id
				WHERE ".DHSTUD.".roll_no = '$roll_number' AND academic_year = '$academic_year' 
				AND ".DHEXAM.".mst_course_course_id = ".$courseId."  AND exam_type = '$exam_type'";
				
				
			}
			elseif(@$roll_number != "" && @$student_name != "")
			{
				$studentByName = $student->getStudentByName($student_name);
				
				$rollByName = $studentByName['student_id'];
				
				$studentById =  $student->getStudentById($roll_number);
				
				$rollByID =  $studentById['student_id'];
				
				if($rollByID == $rollByName)
				{
				
					$query = "SELECT mst_students_student_id FROM ".DHEXAM." 
				INNER JOIN ".DHSTUD." ON ".DHEXAM.".mst_students_student_id = ".DHSTUD.".student_id 
				INNER JOIN ".DHCOURSE." ON  ".DHEXAM.".mst_course_course_id = ".DHCOURSE.".course_id
				WHERE ".DHSTUD.".roll_no = '$rollByID' AND academic_year = '$academic_year' 
				AND ".DHEXAM.".mst_course_course_id = ".$courseId." AND exam_type = '$exam_type'";
		
				
				}
			}
echo $query;exit;
			if(@$query != "")
			{
				$connRs = $conn->query($query);
			
				
				return mysqli_num_rows($connRs);
			}
			else
			{
				return 1;
			}
			
			
		}
		
		function getSubjectMarksDetails($subjectId,$examId)
		{
			$conn = dlhudaDB::getInstance();
	
			$query = "SELECT ".DHMARKS.".marks_obtained,".DHMARKS.".mst_subject_subject_id FROM ".DHMARKS." INNER JOIN ".DHEXAM." ON ".DHMARKS.".exam_details_exam_id = ".DHEXAM.".exam_id 
			WHERE ".DHMARKS.".exam_details_exam_id = $examId AND ".DHMARKS.".mst_subject_subject_id = ".$subjectId;
			
			$subjectMarks = $conn->query($query);
			
			return mysqli_fetch_assoc($subjectMarks);
		}
		
		function getExamDetailsByFilters($filters)
		{
			extract($filters);
			
			$conn = dlhudaDB::getInstance();
			
			$query = "SELECT * FROM ".DHEXAM." 
				INNER JOIN ".DHSTUD." ON ".DHEXAM.".mst_students_student_id = ".DHSTUD.".student_id 
				INNER JOIN ".DHCOURSE." ON  ".DHEXAM.".mst_course_course_id = ".DHCOURSE.".course_id
				WHERE ".DHSTUD.".student_id = $roll_number AND academic_year = $academic_year 
				AND ".DHEXAM.".mst_course_course_id = ".$courseId." AND exam_type = $exam_type";
			
			$examDetailsRS = $conn->query($query);
			
			return mysqli_fetch_assoc($examDetailsRS);
		}
		
	
		
		function getExamInfo()
		{
			$query = "SELECT ".DHEXAM.".*,".DHSTUD.".first_name,".DHSTUD.".last_name,".DHSTUD.".student_id FROM ".DHEXAM." 
				INNER JOIN ".DHSTUD." ON ".DHEXAM.".mst_students_student_id = ".DHSTUD.".student_id 
				INNER JOIN ".DHCOURSE." ON  ".DHEXAM.".mst_course_course_id = ".DHCOURSE.".course_id";
						
			//echo $query;			
			
			$conn = dlhudaDB::getInstance();
			
			$examRS = $conn->query($query);
			
			$examDetails = array();	
			
			while($examRows = mysqli_fetch_assoc($examRS))
			{
				$examDetails[] = $examRows;
			}	
			
			return $examDetails;
		}
		
	}
?>