<?php

	$exam = new exam();
	
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
					
					<?php
							$month = array("January", "February", "March", "April", "May" , "June" , "July", "August", "September", "October", "November" , "December");
					?>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
									<th>Roll No</th>
									<th>Student Name</th>
									<th>Course Name</th>
									<th>Marks Obtained</th>
									<th>Out of Marks</th>
									<th>Percentage</th>
									<th>Exam Type</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php  
								
							$examDetails = $exam->getExamInfo();
							
							$subject = new subjects();
						
							
							foreach($examDetails as $examDtls):
						  ?>
							<tr>
								<td>
								<?php 
									
								echo $examDtls['student_id'];		
								
								?>
								</td>
								
								<td><?php echo $examDtls['first_name']." ".$examDtls['last_name']; ?></td>
								
								<?php
							
									$index = 1;
									if($examDtls['marks_obtained'] > 0) {
										$percentage = $examDtls['marks_obtained'] * 100 / $examDtls['out_of_marks'];
										 
										$percentage = number_format($percentage, 2, '.', '');
									}
								?>
								<td><?php echo $examDtls['mst_course_course_name']; ?></td>
								<td><?php echo $examDtls['marks_obtained']; ?></td>
								<td><?php echo $examDtls['out_of_marks']; ?></td>
								<td><?php echo $percentage."%"; ?></td>
								<td><?php echo $examDtls['exam_type']; ?></td>
							</tr>
								<?php
							endforeach;
								?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div> 	 	