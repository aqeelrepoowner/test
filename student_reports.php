<?php

	$student = new students();
	
	$studentDetails = $student->getStudentDetails();

?>

			<div class="row-fluid sortable">		
				<div class="box span12" style="width: 1000px;margin-top: 50px;margin-left:0px;">
					<div class="box-header well" data-original-title>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Roll No</th>
								  <th>Student Name</th>
								  <th>Course Name</th>
								  <th>Date Of Birth</th>
								  <th>Maktab Location</th>
								  <th>Status</th>
								  <th>Registration Date</th>
								  <th>Academic Year</th>	
								  <th>Contact Number</th>
								  <th>Bus Facility</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php  
							foreach($studentDetails as $studentDtls) :
						  ?>
							<tr>
								<td><?php echo $studentDtls['student_id']; ?></td>
								<td><?php echo $studentDtls['first_name']." ".$studentDtls['last_name']; ?></td>
								<td><?php echo $studentDtls['course_name']; ?></td>
								<td class="center"><?php  $date = new DateTime($studentDtls['dob']); echo $date->format("d-m-Y"); ?></td>
								<td class="center"><?php  echo $studentDtls['school_location']; ?></td>
								<td class="center">
									<span class="label label-success"><?php echo ucfirst($studentDtls['status']); ?></span>
								</td>
								<td class="center"><?php  $reg_date = new DateTime($studentDtls['registered_date']); echo $reg_date->format("d-m-Y"); ?></td>
								<td class="center"><?php echo $studentDtls['academic_year']; ?></td>
								<td class="center"><?php echo $studentDtls['contact_no']; ?></td>
								<td class="center"><?php 
								if($studentDtls['bus_facility'] == "Yes") 
									echo '<span class="label label-success">'.$studentDtls['bus_facility'].'</span>';
								else
									echo '<span class="label label-danger">'.$studentDtls['bus_facility'].'</span>';?></td>
							</tr>
								<?php
							endforeach;
								?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div>