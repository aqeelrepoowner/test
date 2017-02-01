<?php

session_start();

	function __autoload($className)
	{
		include_once $className.".php";
	}
	
	function getSunday($y, $m)
	{
		return new DatePeriod(
			new DateTime("first sunday of $y-$m"),
			DateInterval::createFromDateString('next sunday'),
			new DateTime("last day of $y-$m")
		);
	}
	
	switch($_POST['action'])
	{
		case "exam_details":
		
		$exam = new exam();
		
		$examNumRows = $exam->checkExamDetails($_POST);
	
		if($examNumRows == 0)
		{
			$students = new students(); 
			
			$studentDetails = $students->getStudentByFilters($_POST); 
		
			
			if(is_array($studentDetails))
			{
				$countStudId = 0;
				
				foreach($studentDetails as $value)
				{
					if(array_key_exists('student_id',$value))
						$countStudId++;
				}
				
				if($countStudId > 1)
				{
					echo 3;
				}
				else
				{
		
		
		echo	'<div class="col-fees-10">';

				echo '<h2>Subject Marks Details</h2>
			<p>Exam details of <b>'.$studentDetails[0]['first_name']." ".$studentDetails[0]['last_name'].'</b> for academic year <b>'.$studentDetails[0]["academic_year"].'</b> are mentioned below:
				<table class="table table-bordered table-hover table-striped tablesorter">
				<thead>
					<tr>
						<th>Sr.No<i class="fa fa-sort"></i></th>
						<th>Name of the Subject <i class="fa fa-sort"></i></th>
						<th>Marks Obtained<i class="fa fa-sort"></i></th>                 
						<th>Total Marks<i class="fa fa-sort"></i></th>
					</tr>
                </thead>
                <tbody>';
			
						$subject = new subjects();
						
						$subjectDetails = $subject->getSubjectDetails($_POST['courseId']);
						
						if(is_array($subjectDetails))
						{
							$i = 1;
							
						foreach($subjectDetails as $value) :
							
						echo '<tr class="active">
						<td>'.$i.'</td>
						<td>'.$value['subject_name'].'</td>
						<td><input type="text" class="marks_obtained" name="marks_obtained['.$value['subject_id'].']"></td>
						<td><input type="text" class="total_marks" name="total_marks['.$value['subject_id'].']"></td>			
						</tr>';
						
						
						$i++;
								endforeach;
						}
			
                  
                  
                echo '</tbody>
              </table>';
			 
         
		  
		
		
          echo '</div><div style="margin-left:65%;"><input type="submit" name="" class="btn btn-success" value="Save"></div>';
		   }
         
			}
			else
			{
				echo 1;
			}
			}
		else
		{
			$_SESSION['error'] = 1;
			$_SESSION['error_message'] = "Record already exists Or Search filters are wrong";
			
			echo  2;
		}	
		
		  
		break;
		
		case "checkStudData":
		
				$attendance = new attendance();
				$index = 1;
				$holidays = array();
				
				foreach(getSunday($_POST['year'],$_POST['month']) as $sundays)
				{	
					$holidays[$index] = $sundays->format("d");
					$index++;	
				}
			
				$student = new students();
				
				$studentDetails = $student->getStudentById($_POST['stud_id']);
				
				
				for($i = 1;$i<=$_POST['days'];$i++)
				{
					$returnValue = $attendance->getStudentByAttendDays($i,$_POST['stud_id'],$_POST['month'],$_POST['year']);
					
						if($returnValue == 1 && $i == 1)
						{
							echo "<td>".$studentDetails['first_name']." ".$studentDetails['last_name']."<input id='all_".$_POST['stud_id']."' value=".$_POST['stud_id']." onclick='checkAll(this.value);' type='checkbox'>
							<a href='javascript:void(0);' onclick='editRow(".$_POST['stud_id'].",".$_POST['days'].",".$_POST['month'].",".$_POST['year'].");' >Edit</a></td><td><input type='checkbox' checked='checked' name='date[".$i."_".$_POST['stud_id']."]' class='chkbox".$_POST['stud_id']."'></td>";
						}
						elseif($returnValue == 1 && $i != 1)
						{
							echo "<td><input type='checkbox' checked='checked' name='date[".$i."_".$_POST['stud_id']."]' class='chkbox".$_POST['stud_id']."'></td>";
						}
						else
						{
							if(in_array($i,$holidays))
							{	
								echo "<td style='background-color:#CFCDCD;'></td>";	
							}
							else							
								echo "<td><input type='checkbox' class='chkbox".$_POST['stud_id']."' name='date[".$i."_".$_POST['stud_id']."]'></td>";
						}
				}
					
		break;
		
		case "fees_details":
		
			echo '<div class="col-fees-10" style="margin-left:2%;"><br/><br/>Details of ';

			$students = new students(); 
			
			$studentDetails = $students->getStudentByFilters($_POST); 
			
		
			
			if(is_array($studentDetails) && !empty($studentDetails))
			{
				echo '<b>'.$studentDetails[0]['first_name']." ".$studentDetails[0]['last_name'].'</b>'; 
	
				echo '</b> for academic year <b>'.$_POST['year'].'</b> are mentioned below:
				<table class="table table-bordered table-hover table-striped tablesorter" id="monthTable">
				<thead>
					<tr >
						<th>Sr.No<i class="fa fa-sort"></i></th>
						<th>Name of the Month <i class="fa fa-sort"></i></th>
						<th>Fees Amount Received <i class="fa fa-sort"></i></th>                 
						<th>Fees Amount Due <i class="fa fa-sort"></i></th> 
						<th>Total Monthly Fees <i class="fa fa-sort"></i></th> 
						<th>Fees Status <i class="fa fa-sort"></i></th> 
						<th>Date Of Payment <i class="fa fa-sort"></i></th>
						<th>Remarks <i class="fa fa-sort"></i></th>  
						
					</tr>
                </thead>
                <tbody>';
	
						$fees = new fees();
							
							
						$feesDetails = $fees->getFeesDetails($_POST['roll_number'],$_POST['student_name'],(string)$_POST['year']);
					
						$i = 1;
						
						$index = 0;
						
						$month = array("June", "July", "August", "September", "October", "November" , "December", "January", "Februrary", "March", "April", "May");
						
						$feesStatus = array("Paid","Partial","Unpaid");
					
						$yearSplit = explode("-",$_POST['year']);
					
						$year = $yearSplit[0];
						
                        
						//var_dump($feesDetails);
						foreach($month as $value) :
						
						echo '<tr class="active">
						<td>'.$i.'</td>
						<td>'.$value.'</td>';
						
						if($index > 6)
							$year = $yearSplit[1];
						
						if(is_array($feesDetails) && array_values($feesDetails)) {
							
						if(array_key_exists($index,$feesDetails) && in_array($value,$feesDetails[$index]) && $year == $feesDetails[$index]['name_of_year']) {
					
						if($feesDetails[$index]['fees_amount'] != "")
							echo '<td><input type="text" name="fees_received['.$value.']" class="fees_received" style="width:130px;" value='.$feesDetails[$index]['fees_amount'].' disabled></td>';
						else
							echo '<td><input type="text" name="fees_received['.$value.']" class="fees_received" style="width:130px;" disabled></td>';
						
						if($feesDetails[$index]['fees_due'] != "")
							echo '<td><input type="text" name="fees_due['.$value.']" style="width:130px;" class="fees_due" value='.$feesDetails[$index]['fees_due'].' disabled></td>';
						else
							echo '<td><input type="text" name="fees_due['.$value.']" style="width:130px;" class="fees_due" disabled></td>';
						
						if($feesDetails[$index]['total_fees'] != "")
							echo '<td><input type="text" style="width:130px;" name="total_fees['.$value.']" class="total_fees" value='.$feesDetails[$index]['total_fees'].' disabled></td>';
						else
							echo '<td><input type="text" style="width:130px;" name="total_fees['.$value.']"  class="total_fees" style="width:130px;" disabled></td>';
							
						echo '<td><select class="form-control fees_status" name="fees_status['.$value.']" placeholder="Enter text"  style="width:100px;" disabled>
					<option>Select</option>';
					
					foreach($feesStatus as $status)
					{
						if($feesDetails[$index]['fees_status'] == $status)
							echo '<option selected="selected">'.$status.'</option>';
						else 
							echo '<option>'.$status.'</option>';
					}
				   
					echo '</select></td>';
				
					if($feesDetails[$index]['date_of_payment'] != "")
						echo '<td><input type="text" name="payment_date['.$value.']" id= "date_of_payment" class="payment_date" value='.$feesDetails[$index]['date_of_payment'].' disabled></td>';
					else
						echo '<td><input type="text" name="payment_date['.$value.']" id= "date_of_payment" class="payment_date"  disabled></td>';
						
					if($feesDetails[$index]['remarks'] != "")	
						echo '<td><textarea name="remarks['.$value.']"  class="fees_textarea"  disabled>'.$feesDetails[$index]['remarks'].'</textarea></td>';
					else
						echo '<td><textarea name="remarks['.$value.']"   class="fees_textarea"   disabled></textarea></td>';

					
						echo '<td><a href="javascript:void(0);" onclick="enableEdit('.$index.');">Edit</a></td>';
					}
					else 
				{
						
						echo '<td><input type="text" style="width:130px;" class="fees_received" name="fees_received['.$value.']"></td>';
						echo '<td><input type="text" style="width:130px;"  class="fees_due" name="fees_due['.$value.']"></td>';
						echo '<td><input type="text"  style="width:130px;" class="total_fees" name="total_fees['.$value.']" ></td>';
						echo '<td><select class="form-control fees_status" name="fees_status['.$value.']"  placeholder="Enter text" style="width:100px;">
					<option>Select</option>';
					
					foreach($feesStatus as $status)
					{
						echo '<option>'.$status.'</option>';
					}   
						echo '</select></td>';
						
						echo '<td><input type="text" name="payment_date['.$value.']"  class="payment_date" id= "date_of_payment"></td>';
						
						echo '<td><textarea name="remarks['.$value.']"  class="fees_textarea" ></textarea></td>';
				}
					}
				
					
						
					
               echo '</tr>';
			  
					$i++;
					$index++;
							endforeach;
			
			
                  
                  
                echo '</tbody>
              </table>';
         
			
          echo '</div><div style="margin-left:65%;"><input type="submit" name="" class="btn btn-success" value="Save"></div>';
		  }
		  else
		  {
		  
		  echo '<table class="table table-bordered table-hover table-striped tablesorter" id="monthTable">
				<thead>
					<tr>
						<th>Sr.No<i class="fa fa-sort"></i></th>
						<th>Name of the Month <i class="fa fa-sort"></i></th>
						<th>Fees Amount Received <i class="fa fa-sort"></i></th>                 
						<th>Fees Amount Due <i class="fa fa-sort"></i></th> 
						<th>Fees Status <i class="fa fa-sort"></i></th> 
						<th>Date Of Payment <i class="fa fa-sort"></i></th>  
						<th>Remarks <i class="fa fa-sort"></i></th>  
						
					</tr>
                </thead>
                <tbody><tr><td>No data  </td><td>available  </td><td>in table </td><td></td><td></td><td></td></tr></tbody></table>';
		  
		  }
		break;
	
	}	
?>	