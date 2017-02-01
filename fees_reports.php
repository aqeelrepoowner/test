<?php

	$fees = new fees();
	
?>

	<div class="row-fluid sortable">		
				<div class="box span12" style="width: 1100px;margin-top: 50px;margin-left:0px;">
					<div class="box-header well" data-original-title>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<?php
							$month = array("June", "July", "August", "September", "October", "November" , "December", "January", "Februrary", "March", "April", "May");
					?>
					<span class='label label-success'>Amount Paid</span>&nbsp;<span class='label label-warning'>Amount Due</span>
					&nbsp;<span class='label label-info'>Total Fees</span>&nbsp;<span class='label label-danger'>Not Paid</span>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Roll No</th>
								  <th>Student Name</th>
									<?php
										foreach($month as $eachMonth) :
											
											echo "<th>".$eachMonth."</th>";
								
										endforeach;	
									?>
									<th>Total</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php  
						  
								$student = new students();
								
								$studentDtls = $student->getStudentDetails();	
							
								foreach($studentDtls as $studentDtls):
							
						  ?>
							<tr>
								<td><?php echo $studentDtls['student_id']; ?></td>
								<td><?php echo $studentDtls['first_name']." ".$studentDtls['last_name']; ?></td>
								
								<?php
								
								if(isset($_GET['maktab_location']) && $_GET['maktab_location'] != "Select Location")
									$feesDetails = $fees->getAllFeesDetails($studentDtls['student_id'],@$_GET['year'],@$_GET['maktab_location']);
								else
									$feesDetails = $fees->getAllFeesDetails($studentDtls['student_id'],@$_GET['year']);
								
									//var_dump($feesDetails);	
									
									$i = 0;
									$totalAmountDue = 0;$totalAmountReceived = 0;$totalFees = 0;
									$expYear = explode("-",$_GET['year']);
									$year = $expYear[0];
									
									foreach($month as $eachMonth) :
										if($i > 6)
											$year = $expYear[1];
											
										if(array_key_exists($i,$feesDetails) && $feesDetails[$i]['name_of_month'] == $eachMonth && $feesDetails[$i]['name_of_year'] == $year)
										{					
											$totalAmountReceived += $feesDetails[$i]['fees_amount'];
											$totalAmountDue += $feesDetails[$i]['fees_due'];
											$totalFees += $feesDetails[$i]['total_fees'];
											
											
											if($feesDetails[$i]['total_fees'] == $feesDetails[$i]['fees_due'])
											{
												echo "<td><span class='label label-danger'>Not Paid</span><br/>---------<br/><span class='label label-warning'>". $feesDetails[$i]['fees_due']."</span></td>";
											}
											elseif($feesDetails[$i]['total_fees'] == $feesDetails[$i]['fees_amount'])
											{
												echo "<td><span class='label label-success'>Paid</span>
												<br/>--------<br/><span class='label label-info'>".$feesDetails[$i]['total_fees']."</span></td>";
											}
											else
											{
												echo "<td><span class='label label-success'>".$feesDetails[$i]['fees_amount']."</span>&nbsp;|&nbsp;";
												echo "<span class='label label-warning'>".$feesDetails[$i]['fees_due']."</span>
												<br/>--------<br/><span class='label label-info'>".$feesDetails[$i]['total_fees']."</span></td>";
											}	
										}	
										else
											echo "<td>No Entry</td>";
									
									$i++;
									
									endforeach;
								?>
								<td><?php echo "<span class='label label-success'>".$totalAmountReceived."</span>
								<br/><span class='label label-warning'>".$totalAmountDue; ?></span>
								<br/>--------</br><span class='label label-info'><?php echo $totalFees; ?></span></td>
							</tr>
							<?php
								endforeach;
							?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
		</div>