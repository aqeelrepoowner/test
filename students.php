<?php
	include_once("config/dlhudaDB.php");

	
	class students
	{
		private $data = array();
		
		function __get($name)
		{
			if (array_key_exists($name, $this->data)) {
				return $this->data[$name];
			}
			
			 $trace = debug_backtrace();
			trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
			return null;

		}
		
		function __set($name,$value)
		{
			$this->data[$name] = $value;
		}
		
		function addStudent($studentValues)
		{	
			extract($studentValues);
			
			$conn = dlhudaDB::getInstance();
			
			$dob = new DateTime($dob);
	
			$dob_format = $dob->format("Y-m-d"); 
			
			$reg_date = date("Y-m-d H:i:s");
			
			
			$rollNoRs = $conn->query("SELECT MAX(roll_no) as roll_no FROM ".DHSTUD." ");
			
			$maxRollNo = $rollNoRs->fetch_assoc();
			
			$rollNoExp = explode("-",$maxRollNo['roll_no']);
			
			$rollInc = $rollNoExp[1] + 1;
			
			$rollNo = $maktab_location."-".$rollInc;
			
			
			$conn->query("INSERT INTO ". DHSTUD ."(first_name,last_name,dob,gender,father_name,roll_no,address,school_location,school_name,year_of_class,
			medium_of_school,academic_year,bus_facility,status,mst_teacher_teacher_id,mst_course_course_id,registered_date) 
			VALUES('$first_name','$last_name','$dob_format','$gender','$middle_name','$rollNo',
			'$address','$maktab_location','$school_name','$school_class','$school_medium','$academic_year',
			'$bus_facility','active',$teacher_name,$maktab_course,'$reg_date')");
			
		}	
		
		function getStudentDetails()
		{	
			$conn = dlhudaDB::getInstance();
			
			$studRS = $conn->query("SELECT * FROM ".DHSTUD." INNER JOIN ".DHCOURSE." ON ".DHSTUD.".mst_course_course_id= ".DHCOURSE.".course_id ");
			
			$studentDetails = array();
			
			while($studRSValue = mysqli_fetch_assoc($studRS))
			{	
				$studentDetails[] = $studRSValue;			
			}
			
			return $studentDetails;
		}

		function getStudentById($student_id = "")
		{	
			$conn = dlhudaDB::getInstance();
			if($studRS = $conn->query("SELECT * FROM ".DHSTUD ." WHERE student_id = ".$student_id." "))
			{
				$studentDetails = mysqli_fetch_assoc($studRS);
			
				return $studentDetails;
			}	
		}

		function getStudentByCourseId($course_id = "",$location = "")
		{	
			$conn = dlhudaDB::getInstance();
			
			if($location != "" && $course_id == "" && $location != "Select Location")
			{	
				$query = "SELECT * FROM ".DHSTUD ." WHERE  school_location = '".$location."' ";
			}
			elseif($location != "" && $course_id != "" && $location != "Select Location")
			{
				$query = "SELECT * FROM ".DHSTUD ." WHERE  mst_course_course_id = ".$course_id." AND school_location = '".$location."' ";
			}
			elseif($location == "" && $course_id == "")
			{
				$query = "SELECT * FROM ".DHSTUD ." ";	
			}	
			else
			{
				$query = "SELECT * FROM ".DHSTUD ." WHERE  mst_course_course_id = ".$course_id." ";
			}	
			
				if($studRS = $conn->query($query))
				{
					$studentData = array();
					
					while($studentDetails = mysqli_fetch_assoc($studRS))
					{
						$studentData[] = $studentDetails;
					}
				
					return $studentData;
				}
		}

		function getStudentByName($student_name = "")
		{	
				$conn = dlhudaDB::getInstance();
					
				$student_name = explode(" ",$student_name); 
				
				$count = count($student_name);
				
				if($count==1)
				{
					$query = "SELECT * FROM ".DHSTUD ." WHERE first_name = '".$student_name[0]."' ";
				}
				elseif($count==2)
				{
					$query = "SELECT * FROM ".DHSTUD ." WHERE first_name  = '".$student_name[0]."' 
								AND last_name = '".$student_name[1]."'";
				}
				elseif($count==3)
				{
					$query = "SELECT * FROM ".DHSTUD ." WHERE first_name  = '".$student_name[0]."' 
								AND father_name = '".$student_name[1]."' AND last_name = '".$student_name[2]."'" ;
				}
						
					
				if($studRS = $conn->query($query))
				{
					$studentDetails = mysqli_fetch_assoc($studRS);
				
					return $studentDetails;
				}				
		}

		function getStudentByFilters($filters)
		{
			extract($filters);	
			$conn = dlhudaDB::getInstance();	
			
			if(@$student_name != "" && $courseId != "" && @$roll_number == "")
			{
				$student_name = explode(" ",$student_name); 
				
				$count = count($student_name);
				
				if($count==1)
				{
					$query = "SELECT * FROM ".DHSTUD." INNER JOIN ".DHCOURSE." ON  ".DHSTUD.".mst_course_course_id = ".DHCOURSE.".course_id WHERE first_name = '".$student_name[0]."' AND mst_course_course_id =".$courseId."";
				}
				elseif($count==2)
				{
					$query = "SELECT * FROM ".DHSTUD ." INNER JOIN ".DHCOURSE." ON  ".DHSTUD.".mst_course_course_id = ".DHCOURSE.".course_id WHERE first_name  = '".$student_name[0]."' 
								AND last_name = '".$student_name[1]."' AND mst_course_course_id =".$courseId;
				}
				elseif($count==3)
				{
					$query = "SELECT * FROM ".DHSTUD ." INNER JOIN ".DHCOURSE." ON  ".DHSTUD.".mst_course_course_id = ".DHCOURSE.".course_id  WHERE first_name  = '".$student_name[0]."' 
								AND father_name = '".$student_name[1]."' AND last_name = '".$student_name[2]."' AND mst_course_course_id =".$courseId ;
				}
			}
			if(@$student_name == "" && $courseId != "" && @$roll_number != "")
			{
				$query = "SELECT * FROM ".DHSTUD." INNER JOIN ".DHCOURSE." ON  ".DHSTUD.".mst_course_course_id = ".DHCOURSE.".course_id WHERE roll_no ='".$roll_number."' AND mst_course_course_id =".$courseId ;
			}
			if(@$student_name != "" && $courseId != "" && @$roll_number != "")
			{
				$student_name = explode(" ",$student_name); 
					
				$count = count($student_name);
				
				if($count==1)
				{
					$query = "SELECT * FROM ".DHSTUD." INNER JOIN ".DHCOURSE." ON  ".DHSTUD.".mst_course_course_id = ".DHCOURSE.".course_id WHERE first_name = '".$student_name[0]."' AND mst_course_course_id =".$courseId." AND roll_no = '".$roll_number."'";
				}
				elseif($count==2)
				{
					$query = "SELECT * FROM ".DHSTUD ." INNER JOIN ".DHCOURSE." ON  ".DHSTUD.".mst_course_course_id = ".DHCOURSE.".course_id WHERE first_name  = '".$student_name[0]."' 
								AND last_name = '".$student_name[1]."' AND mst_course_course_id =".$courseId." AND roll_no = '".$roll_number."'";
				}
				elseif($count==3)
				{
					$query = "SELECT * FROM ".DHSTUD ." INNER JOIN ".DHCOURSE." ON  ".DHSTUD.".mst_course_course_id = ".DHCOURSE.".course_id  WHERE first_name  = '".$student_name[0]."' 
								AND father_name = '".$student_name[1]."' AND last_name = '".$student_name[2]."' AND mst_course_course_id =".$courseId." AND roll_no = '".$roll_number."'";
				}
			}
			//echo $query;
			$studentDetails = array();                     
			
			if($studRS = $conn->query($query))
			{
				
				while($results = mysqli_fetch_assoc($studRS))
				{
						$studentDetails[] = $results;
				}
				
				return $studentDetails;
			}	
			else
					return 0;
		}

		function updateStudent($studentDetails) {
		
			extract($studentDetails);
			
			$conn = dlhudaDB::getInstance();
			
			$dateOfBirth = new DateTime($dob);
			
			$DOB = $dateOfBirth->format('Y-m-d');
			
			//var_dump($gender);exit;
			$conn->query("UPDATE mst_students SET first_name = '$first_name',last_name = '$last_name',contact_no = $contact_no,
			dob = '$DOB',gender = '$gender',father_name = '$middle_name',address = '$address',school_location = '$maktab_location'
			,school_name = '$school_name',year_of_class = $school_class,
			medium_of_school = '$school_medium',academic_year = '$academic_year',bus_facility ='$bus_facility',
			mst_teacher_teacher_id = $teacher_name,mst_course_course_id = $maktab_course 
			WHERE student_id = $student_id");
		
		
		}
		
		function deleteStudent($studentId){
			
			$conn = dlhudaDB::getInstance();
			
			$studentID = $conn->real_escape_string($studentId);
			//echo "DELETE FROM mst_students WHERE student_id = $studentID";exit;
			$conn->query("DELETE FROM mst_students WHERE student_id = $studentID");
		}
		
	}
?>