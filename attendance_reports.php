<?php

	$attend = new attendance();
	
	function getSunday($y, $m)
	{
		return new DatePeriod(
			new DateTime("first sunday of $y-$m"),
			DateInterval::createFromDateString('next sunday'),
			new DateTime("last day of $y-$m")
		);
	}
		
?>

			<div class="row-fluid sortable">		
				<div class="box span12" style="width: 1000px;margin-top: 50px;margin-left:10%;">
					<div class="box-header well" data-original-title>
					
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div>
						<span class="label label-success">Present Days</span> 
						<span class="label label-danger">Absent Days</span> 
						</div>
					<?php
						  $month = array("June", "July", "August", "September", "October", "November" , "December", "January", "Februrary", "March", "April", "May");
					?>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Roll No</th>
								  <th>Student Name</th>
									<?php
										foreach($month as $eachMonth) :
											
											echo "<th>".$eachMonth."<br/><small>(Days)</small></th>";
								
										endforeach;	
		 								
									?>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php  
								
								$student = new students();
								
								$studentDtls = $student->getStudentDetails();
								
								$getData = filter_var_array($_GET,array("academic_year"=>FILTER_SANITIZE_STRING));
								
								$dateSplit = explode("-",$getData['academic_year']);
								
								$date = $dateSplit[0];								
			
					
					if($date % 4 == 0)
						$feb = FEB_LEAP;
					else
						$feb = FEB;
								
							$monthDays = array(1=>JUN,2=>JUL,3=>AUG,4=>SEP,5=>OCT,6=>NOV,7=>DEC,8=>JAN,9=>$feb,10=>MAR,11=>APR,12=>MAY);
							
							$indexMonth = array(1=>6,2=>7,3=>8,4=>9,5=>10,6=>11,7=>12,8=>1,9=>2,10=>3,11=>4,12=>5);
						
							$holidays = array();
							
							foreach($studentDtls as $student):
						  ?>
							<tr>
								<td><?php echo $student['student_id'];	?></td>
								<td><?php echo $student['first_name']." ".$student['last_name']; ?></td>
								<?php

								$index = 1;
								
							for($i = 1;$i <= 12;$i++) :
							
								if($i  > 7)
									$date = $dateSplit[1];	
									
							
								
								$attendDetails = $attend->getAllAttendanceDetails($student['student_id'],$indexMonth[$i],$date);
								
								$presentDays = array();	
								
								if($attendDetails['days'] != "")
								{
										foreach(getSunday($date,$indexMonth[$i]) as $sundays)
										{	
											$holidays[$i][$index] = $sundays->format("d");
									
											$index++;
										}
								
								$countSundays = count($holidays[$i]);
									
								$days_in_month = $monthDays[$i] - $countSundays;
								
									$actualDays = $attendDetails['days'];
									$absentDays = 	$days_in_month - $actualDays;
									//var_dump($days_in_month);
									echo '<td><span class="label label-success">'.$actualDays.'</span>&nbsp;|&nbsp;<span class="label label-danger">'.$absentDays.'</span></td>';
								}
								else
								{
									echo "<td>N/A</td>";
								}
								
								endfor;
									
									//var_dump($absentDays);exit;
								?>
							</tr>
								<?php
							endforeach;
								?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div> 	 	