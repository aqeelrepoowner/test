<?php
	include_once("config/dlhudaDB.php");

	
	
	class donate
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
		
		function confirmDonation($donationValues)
		{	
			
			extract($donationValues);
			
			$conn = dlhudaDB::getInstance();
		
			
			$dod = new DateTime($dod);
	
			//$dod_format = $dod->format("Y-m-d"); 
			
			$dod_format = date("Y-m-d H:i:s");
			
			/*echo "INSERT INTO ". DHSTUD ."(first_name,last_name,dob,gender,father_name,contact_no,address,school_location,school_name,year_of_class,medium_of_school,bus_facility,status,mst_teacher_teacher_id,academic_year,mst_course_course_id,registered_date) VALUES('$first_name','$last_name','$dob_format','$gender','$middle_name','$contact_no','$address','$maktab_location','$school_name','$school_class','$school_medium','$bus_facility','active',$teacher_name,'$academic_year',$maktab_course,'$reg_date')";*/
			
			$conn->query("INSERT INTO ". DHCHARITY ."(first_name,middle_name,last_name,contact_no,address,occupation,amount_donated,date_of_donation,email_id,alternate_contact_no) VALUES('$first_name','$middle_name','$last_name','$contact_number','$address','$occupation','$amt_donate','$dod_format','$email_id','$alternate_contact_number')");
			
			
			
			
			
			
		}

		function getCharityReport($donationValues,$filters="")
		{	
			extract($donationValues);
			
			$conn = dlhudaDB::getInstance();
			
			var_dump($academic_year);
			
			$query = "SELECT * FROM ".DHCHARITY." WHERE academic_year = '".$academic_year."' ";
			
			echo $query;
			
			$donationRS = $conn->query($query);
			
			$donationDetails = array();
			
			while($donate_array = mysqli_fetch_assoc($donationRS))
			{
				$donationDetails[] = $donate_array;
			}
			//var_dump($studentDetails);
			return $donationDetails;
		}
		
		function getDonationDetails($year=null,$month=null)
		{	
			$conn = dlhudaDB::getInstance();
			
			$query = "SELECT * FROM ".DHCHARITY." ";
			
			if($year!=null && $month==null){
			
				$query .= "WHERE YEAR(date_of_donation) = $year";
			}else if ($year==null && $month!=null){
				$query .= "WHERE MONTH(date_of_donation) = $month";
			}else if ($year!=null && $month!=null){
				$query .= "WHERE MONTH(date_of_donation) = $month AND YEAR(date_of_donation) = $year" ;
			}
			
			$donateRS = $conn->query($query);
			
			$donateDetails = array();
			
			while($donateRSValue = mysqli_fetch_assoc($donateRS))
			{	
				$donateDetails[] = $donateRSValue;			
			}
			
			return $donateDetails;
		}
	
}
?>