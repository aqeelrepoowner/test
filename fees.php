<?php
	include_once("config/dlhudaDB.php");
	include_once("config/dlhuda_config.php");

	class fees
	{
		private $data = array();
		
		
		
		function getAllFeesDetails($student_id ,$year="",$location = "")
		{
			$student = new students();
			
			if($student_id != "" && $location == "")
			{
				$query = "SELECT * FROM ".DHFEES ." INNER JOIN ".DHSTUD." ON  ".DHFEES.".mst_student_id = ".DHSTUD.".student_id WHERE mst_student_id = ".trim($student_id)." ";
				
				if($year != "")
				{
					$year = explode("-",trim($year));
					$query .= " AND (name_of_year = ".$year[0]."  OR name_of_year = ".$year[1].")";
				}
			}
			elseif($student_id != "" && $location != "")
			{
				$query = "SELECT * FROM ".DHFEES ." INNER JOIN ".DHSTUD." ON  ".DHFEES.".mst_student_id = ".DHSTUD.".student_id WHERE mst_student_id = ".trim($student_id)." AND  ".DHSTUD.".school_location = '".$location."'  ";
				
				if($year != "")
				{
					$year = explode("-",trim($year));
					$query .= " AND (name_of_year = ".$year[0]."  OR name_of_year = ".$year[1].")";
				}	
			}
			
			$conn = dlhudaDB::getInstance();
			
			//echo $query;
			
			if($feesRS = $conn->query($query)) :
			
			$feesDetails = array();
			
			while($feesRSValue = mysqli_fetch_assoc($feesRS))
			{	
				$feesDetails[$feesRSValue['index_position']] = $feesRSValue;			
			}
			
			return $feesDetails;
			
			endif;
		}
		
		function getFeesDetails($student_id = "",$studentName = "",$year = "")
		{	
			$student = new students();
			$query = "";
			
			if($student_id != "" && $studentName == "")
			{
				$query = "SELECT * FROM ".DHFEES ." WHERE mst_student_id = ".$student_id." ";
				
				if($year != "")
				{
					$year = explode("-",$year);
					$query .= " AND (name_of_year = ".$year[0]."  OR name_of_year = ".$year[1].")";
				}
			}
				
			elseif($student_id == "" && $studentName != "")	
			{
				$studentDetails = explode(" ",$studentName);
					
				if(count($studentDetails) == 1)
					$query = "SELECT * FROM ".DHFEES ." INNER JOIN ".DHSTUD." ON  ".DHFEES.".mst_student_id = ".DHSTUD.".student_id WHERE first_name ='".$studentDetails[0]."' ";
				elseif(count($studentDetails) == 2)
					$query = "SELECT * FROM ".DHFEES ." INNER JOIN ".DHSTUD." ON  ".DHFEES.".mst_student_id = ".DHSTUD.".student_id WHERE first_name ='".$studentDetails[0]."' AND last_name = '".$studentDetails[1]."' ";
				else
					$query = "SELECT * FROM ".DHFEES ." INNER JOIN ".DHSTUD." ON  ".DHFEES.".mst_student_id = ".DHSTUD.".student_id WHERE first_name ='".$studentDetails[0]."' AND last_name = '".$studentDetails[1]."' AND father_name = '".$studentDetails[2]."' ";
					
				if($year != "")	
				{
					$year = explode("-",$year);
					$query .= " AND (name_of_year = ".$year[0]."  OR name_of_year = ".$year[1].")";
					
				}
					
			}
			elseif($student_id != "" && $studentName != "")	
			{
				$studentDetails = explode(" ",$studentName);
					
				if(count($studentDetails) == 1)
					$query = "SELECT * FROM ".DHFEES ." INNER JOIN ".DHSTUD." ON  ".DHFEES.".mst_student_id = ".DHSTUD.".student_id WHERE first_name ='".$studentDetails[0]."' AND mst_student_id = ".$student_id." ";
				elseif(count($studentDetails) == 2)
					$query = "SELECT * FROM ".DHFEES ." INNER JOIN ".DHSTUD." ON  ".DHFEES.".mst_student_id = ".DHSTUD.".student_id WHERE first_name ='".$studentDetails[0]."' AND last_name = '".$studentDetails[1]."' AND mst_student_id = ".$student_id." ";
				else
					$query = "SELECT * FROM ".DHFEES ." INNER JOIN ".DHSTUD." ON  ".DHFEES.".mst_student_id = ".DHSTUD.".student_id WHERE first_name ='".$studentDetails[0]."' AND last_name = '".$studentDetails[1]."' AND father_name = '".$studentDetails[2]."' AND mst_student_id = ".$student_id." ";
					
					if($year != "")	
					{
						$year = explode("-",$year);
						$query .= " AND (name_of_year = ".$year[0]."  OR name_of_year = ".$year[1].")";
					}
			}

			$conn = dlhudaDB::getInstance();
			//echo $query;
			
			if($feesRS = $conn->query($query)) :
			
			$feesDetails = array();
			
			while($feesRSValue = mysqli_fetch_assoc($feesRS))
			{	
				$feesDetails[$feesRSValue['index_position']] = $feesRSValue;			
			}
			
			return $feesDetails;
			
			endif;
		}

		function addFeesDetails($feesDetails)
		{	
			extract($feesDetails);
			
			$student = new students();
			
			$studentguid = $student->getStudentById($roll_number);
		
			$conn = dlhudaDB::getInstance();
			
			$month = array(0=>"June", 1=>"July", 2=>"August", 3=>"September", 4=>"October", 5=>"November" , 6=>"December", 7=>"January",8=>"Februrary", 9=>"March", 10=>"April", 11=>"May");
		
			$yearSplit = explode("-",$year);
			
			$year = $yearSplit[0];
			
			$index = 0;	
			
			
			//var_dump($feesDetails);exit;
			
			foreach($month as $key => $value)
			{
				if($index > 6)
					$year = $yearSplit[1];
					
				if(array_key_exists($value, $fees_received) && array_key_exists($value, $fees_due) && array_key_exists($value, $fees_status) && array_key_exists($value, $payment_date))
				{
					if($payment_date[$value] != "" && $payment_date[$value] != "0000-00-00")
					{
						$dateTime = new DateTime($payment_date[$value]);
						
						$dateFormat = $dateTime->format("Y-m-d");
					}
					else
						$dateFormat = $payment_date[$value];
				
				
					$connRS = $conn->query("SELECT * FROM ".DHFEES." WHERE name_of_month = '".$value."' AND name_of_year = ".$year." AND mst_student_id = ".$roll_number);
					
						if(mysqli_num_rows($connRS) > 0)
						{	
							$conn->query("UPDATE ".DHFEES." SET name_of_month = '".$value."',name_of_year = ".$year.",
							date_of_payment = '".$dateFormat."',fees_amount = ".$fees_received[$value].",
							fees_due = ".$fees_due[$value].",fees_status = '".$fees_status[$value]."',mst_student_id = ".$roll_number.",total_fees = ".$total_fees[$value]."
							WHERE name_of_month = '".$value."' AND name_of_year = ".$year." AND mst_student_id = ".$roll_number);
						}					
				
						else
						{
							if($fees_received[$value] != "" && $fees_due[$value] != "" && $fees_status[$value] != "Select" && $payment_date[$value] != "")
							{
								echo "INSERT INTO ". DHFEES ."(name_of_month,name_of_year,date_of_payment,fees_amount,fees_due,total_fees,fees_status,mst_student_id,index_position) 
								VALUES('$value','$year','$dateFormat',$fees_received[$value],$fees_due[$value],$total_fees[$value],'$fees_status[$value]',$roll_number,$key)";
								//exit;
								
								if($student_name != "") {
									$student = new students();
									$studentDetails = $student->getStudentByName($student_name);
									
									var_dump($studentDetails);exit;
								}	
									
								
								$conn->query("INSERT INTO ". DHFEES ."(name_of_month,name_of_year,date_of_payment,fees_amount,fees_due,total_fees,fees_status,mst_student_id,index_position) 
								VALUES('$value','$year','$dateFormat',$fees_received[$value],$fees_due[$value],$total_fees[$value],'$fees_status[$value]',$roll_number,$key)");
							}
							else
							{
								$GLOBALS['error_message'] = "Incorrect values inserted for row number $index";
								$GLOBALS['display'] = "block";
							}
						}						
				}
				
				$index++;
			}
		}

}
?>