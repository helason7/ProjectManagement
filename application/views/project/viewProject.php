
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Dashboard Management -- Project</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>project/projectList" class="btn btn-light">List Project</a>
        <a href="#" class="btn btn-light"><i class="fa fa-refresh"></i></a>
        <a href="#" class="btn btn-light"><i class="fa fa-search"></i></a>
      </div>
    </div>
    <!-- End Page Header Right Div -->

  </div>
  <!-- End Page Header -->


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-widget">

 

  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
          <?=$project->NAME?>
        </div>
        <div class="panel-body table-responsive">
		<?php
		$error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
            </div>
        <?php } ?>
		
		<?php
		$success = $this->session->flashdata('success');
        if($success)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success; ?>                    
            </div>
        <?php } ?>
		
		
		<style> 
		.table>tbody>tr>td {
		  padding: 5px;
		  line-height: 1.7
		}
		</style>
		
            <table  class="table display" >
				<tr>
						<td>Deskripsi</td> <td> : </td> <td> <?=nl2br($project->DESCRIPTION)?></td>
				</tr>
				<tr>
                        <td>
							Account</td> <td> : </td> <td> <?=$project->G_NAME?>
						</td>
				</tr>
				<tr>
                        <td>Person in Charge @ Account</td>  <td> : </td> <td> <?=$project->PIC?></td>
				</tr>
				
				<tr>
						<td>Start Date</td> <td> : </td> 
						<td>
							<?=$project->START_DATE?>
						</td>
				</tr>
				<tr>
						<td>End Date</td> <td> : </td> 
						<td>
							<?=$project->END_DATE?>
						</td>
				</tr>
				<tr>
					<td>Stage</td> <td> : </td> <td> <?=$project->SALES_STAGE?></td>
				</tr>
				<tr>
					<td colspan="3"><a href="#"  data-toggle="modal" data-target="#ActModal" class="btn btn-default"/> Edit Data </a> 
						<a href="#"  data-toggle="modal" data-target="#TeamViewModal" class="btn btn-option1"/> Project Team </a> 
						<a href="#"  data-toggle="modal" data-target="#ReportModal" class="btn btn-option2"/> Progress Report </a>
						<?php
						if($project->BUDGET_GROUP == "NOT SET")
						{
						?>
							<a href="#" class="btn btn-basic"/> Budget Not Set </a>
							<!--<td> <a href="#"  data-toggle="modal" data-target="#BudgetModal" class="btn btn-info"/> Set Budget </a></td>-->
						<?php
						}
						else{
						?>
							<a href="#"  onclick="view_usage('<?=$project->OPPORTUNITY_ID?>','<?=$project->BUDGET_GROUP?>')" class="btn btn-warning"/> View Budget </a>
						<?php
						}
						?>
					</td>					
				</tr>
             
            </table>
		
        </div>

      </div>
    </div>
    <!-- End Panel -->

  </div>

  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
		
        <div class="panel-title" style="text-align:center">
		  <center>
			  <ul class="topstats clearfix" style="text-align:center">
				<li class="col-xs-6 col-lg-6">
				  <span class="title"><i class="fa fa-dot-circle-o"></i> PROGRESS </span>
				  <h3><?=$progress->PERCENTAGE?> %</h3>
				</li>
				<li class="col-xs-6 col-lg-6">
				  <span class="title"><i class="fa fa-dot-circle-o"></i> TARGET</span>
				  <h3><?=$progress->TARGET?> %</h3>
				</li>
			  </ul>
		  </center>
		  <center> <a href="#" class="btn btn-info" data-toggle="modal" data-target="#ProgressModal" style="width:90%; "> Insert Progress Update </a></center>
		</div>
        <div class="panel-heading">
          PROGRESS TIMELINE
        </div>
        <div class="panel-body">

            <div id="chartist-line" class="ct-chart" style="height:200px;"></div>

        </div>
	  </div>
	</div>
  </div>
  

  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
		
        <div class="panel-title">
		  <ul class="topstats clearfix">
			<li class="arrow"></li>
			<li class="col-xs-6 col-lg-3">
			  <span class="title"><i class="fa fa-dot-circle-o"></i> Activity On Going</span>
			  <h3><?=$summary_act['ONGOING']?></h3>
			</li>
			<li class="col-xs-6 col-lg-3">
			  <span class="title"><i class="fa fa-dot-circle-o"></i> Activity Pending</span>
			  <h3><?=$summary_act['PENDING']?></h3>
			</li>
			<li class="col-xs-6 col-lg-3">
			  <span class="title"><i class="fa fa-dot-circle-o"></i> Activity Critical</span>
			  <h3><?=$summary_act['CRITICAL']?></h3>
			</li>
			<li class="col-xs-6 col-lg-3">
			  <span class="title"><i class="fa fa-dot-circle-o"></i> Activity Done</span>
			  <h3><?=$summary_act['DONE']?></h3>
			</li>
		  </ul>
		  <center> <a href="#" class="btn btn-info" data-toggle="modal" data-target="#actModal" style="width:90%; "> Add New Activity </a></center>
		</div>
        <div class="panel-heading">
          ACTIVITY LIST
        </div>
        <div class="panel-body table-responsive">

            <table id="table_act" class="table display">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>PIC ILCS</th>
                        <th>Costs</th>
                        <th>File</th>
						<th></th>
                    </tr>
                </thead>
             
             
                <tbody>
					<?php
					foreach($activities as $act)
					{
					?>
                    <tr>
                        <td><?=$act->NAME?></td>
                        <td><?=$act->DESCRIPTION?></td>
                        <td><?=$act->DATE_ACTIVITY?></td>
                        <td><?=$act->PIC_INTERNAL?></td>
                        <td><?=number_format($act->COSTS)?></td>
                        <td><?php if($act->FILE_ID > 0){?><a href="<?=$act->F_LINK?>" class="btn btn-success">FILES</a><?php } ?></td>
						<td <?php if($act->STATUS_ACTIVITY == "CRITICAL"){?> style="background-color:#ce625a" <?php } ?>>
							<fieldset>
								<div class="control-group">
								  <div class="controls">
								   <div class="input-prepend input-group">
										<span class="add-on">
											<select  name="STATUS" id="status_act" onchange="actStat(<?=$act->ID?>, $(this).val())" >
												<option value="ONGOING" <?php if($act->STATUS_ACTIVITY == "ONGOING"){?> selected <?php } ?> >ON GOING</option>
												<option value="DONE" <?php if($act->STATUS_ACTIVITY == "DONE"){?> selected <?php } ?> >DONE</option>
												<option value="PENDING" <?php if($act->STATUS_ACTIVITY == "PENDING"){?> selected <?php } ?>>Pending</option>
												<option value="CRITICAL" <?php if($act->STATUS_ACTIVITY == "CRITICAL"){?> selected <?php } ?> >CRITICAL</option>
												<option value="DELETE">Delete</option>
											</select> 
										</span>
								   </div>
								  </div>
								</div>
							</fieldset>
						</td>
					</tr>
                    <?php
					}
					?>
					
                </tbody>
            </table>


        </div>
	  </div>
	</div>
  </div>
  
  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
		
        <div class="panel-title">
		  <ul class="topstats clearfix">
			<li class="arrow"></li>
			<li class="col-xs-6 col-lg-4">
			  <span class="title"><i class="fa fa-dot-circle-o"></i> Issues On Going</span>
			  <h3><?=$summary_issues['ONGOING']?></h3>
			</li>
			<li class="col-xs-6 col-lg-4">
			  <span class="title"><i class="fa fa-dot-circle-o"></i> Issues Critical</span>
			  <h3><?=$summary_issues['CRITICAL']?></h3>
			</li>
			<li class="col-xs-6 col-lg-4">
			  <span class="title"><i class="fa fa-dot-circle-o"></i> Issues Done</span>
			  <h3><?=$summary_issues['DONE']?></h3>
			</li>
		  </ul>
		  <center> <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#issueModal" style="width:90%; "> Add New Issue </a></center>
		</div>
        <div class="panel-heading">
          ISSUE LIST
        </div>
        <div class="panel-body table-responsive">

            <table id="table_issue" class="table display">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>PIC ILCS</th>
                        <th>Deadline</th>
						<th></th>
                    </tr>
                </thead>
             
             
                <tbody>
					<?php
					foreach($issues as $issue)
					{
					?>
                    <tr>
                        <td><?=$issue->NAME?></td>
                        <td><?=$issue->DESCRIPTION?></td>
                        <td><?=$issue->DATE_ENTRY?></td>
                        <td><?=$issue->PIC?></td>
                        <td><?=$issue->DEADLINE?></td>
                       <td <?php if($issue->STATUS_ISSUE == "CRITICAL"){?> style="background-color:#ce625a" <?php } ?>>
							<fieldset>
								<div class="control-group">
								  <div class="controls">
								   <div class="input-prepend input-group">
										<span class="add-on">
											<select  name="STATUS_ISSUE" id="status_issue"  id="status_issue" onchange="issueStat(<?=$issue->ID?>, $(this).val())">
												<option value="ONGOING" <?php if($issue->STATUS_ISSUE == "ONGOING"){?> selected <?php } ?> >ON GOING</option>
												<option value="DONE" <?php if($issue->STATUS_ISSUE == "DONE"){?> selected <?php } ?> >DONE</option>
												<option value="CRITICAL" <?php if($issue->STATUS_ISSUE == "CRITICAL"){?> selected <?php } ?> >CRITICAL</option>
											</select> 
										</span>
								   </div>
								  </div>
								</div>
							</fieldset>
						</td>
					</tr>
                    <?php
					}
					?>
					
                </tbody>
            </table>


        </div>
	  </div>
	</div>
  </div>
  
  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
		
        <div class="panel-title">
		  <center> <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#spendingModal" style="width:90%; "> Add New Spending </a></center>
		</div>
        <div class="panel-heading">
          BUDGET USAGE
        </div>
        <div class="panel-body table-responsive">

            <table id="table_spending" class="table display">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Date</th>
                        <th>PIC ILCS</th>
                        <th>Amount</th>
                        <th>Anggaran</th>
                        <th>File</th>
                    </tr>
                </thead>
             
             
                <tbody>
					<?php
					foreach($spending as $spent)
					{
					?>
                    <tr>
                        <td><?=$spent->DESCRIPTION?></td>
                        <td><?=$spent->ACTIVITY_DATE?></td>
                        <td><?=$spent->UNAME?></td>
                        <td style="text-align:right;">Rp <?=number_format($spent->AMOUNT)?></td>
                        <td><?=$spent->NAME?></td>
                       <td><?php if($spent->FILE_ID > 0){?><a href="<?=$spent->FILE_LINK?>" class="btn btn-success">FILES</a><?php } ?></td>
					</tr>
                    <?php
					}
					?>
					
                </tbody>
            </table>


        </div>
	  </div>
	</div>
  </div>
  
  <!------------------------- ACtiVITY MODAL BOX -->
  
            <div class="modal fade" id="actModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Activity</h4>
                  </div>
                  <div class="modal-body">
					<?php echo form_open_multipart(_URL.'project/doAddActivityProject');?>
						<table  class="table display">
							<tr>
									<td>Name</td> <td> : </td> <td> <input type="text" class="form-control" name="name" style="width:300px" /></td>
							</tr>
							<tr>
									<td>Deskripsi</td> <td> : </td> <td> <textarea name="desc" style="width:300px;" class="form-control"> </textarea> </td>
							</tr>
							<tr>
									<td>
										Status</td> <td> : </td> <td> 
																		<select  class="selectpicker" name="status" />
																				<option value="ONGOING">ON GOING</option>
																				<option value="PENDING">PENDING</option>
																				<option value="CRITICAL">CRITICAL</option>
																				<option value="DONE">DONE</option>
																		</select>
									</td>
							</tr>
							<tr>
									<td>Person in Charge</td>  <td> : </td> <td> <input type="text" class="form-control" name="pic" style="width:300px" /></td>
							</tr>
							<tr>
									<td>Activity Date</td> <td> : </td> 
									<td>
										<fieldset>
											<div class="control-group">
											  <div class="controls">
											   <div class="input-prepend input-group">
												 <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
												 <input type="text" style="width:200px;" id="dateAct" name="dateAct" class="form-control" value=""/> 
											   </div>
											  </div>
											</div>
										</fieldset>
									</td>
							</tr>
							<tr>
								<td>Cost Forecasted</td> <td> : </td> 
								<td> 
									<input type="text" style="width:200px;" name="cost" class="form-control" value=""/> 
								</td>
							</tr>
							<tr>
								<td>
									File</td> <td> : </td> <td> 
																		<input type="file" name="doc" /><input type="hidden" name="type" value="PROJECT"/><input type="hidden" name="idProject" value="<?=$project->ID?>"/>
									</td>
							</tr>
						</table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Add Activity</button>
					</form>
                  </div>
                </div>
              </div>
            </div>
  
  
  
  <!------------------------- ISSUE MODAL BOX -->
  
            <div class="modal fade" id="issueModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Issue</h4>
                  </div>
                  <div class="modal-body">
					<?php echo form_open(_URL.'project/doAddIssueProject');?>
						<table  class="table display">
							<tr>
									<td>Name</td> <td> : </td> <td> <input type="text" class="form-control" name="name" style="width:300px" /></td>
							</tr>
							<tr>
									<td>Deskripsi</td> <td> : </td> <td> <textarea name="desc" style="width:300px;" class="form-control"> </textarea> </td>
							</tr>
							<tr>
									<td>
										Status</td> <td> : </td> <td> 
																		<select  class="selectpicker" name="status" />
																				<option value="ONGOING">ON GOING</option>
																				<option value="CRITICAL">CRITICAL</option>
																				<option value="DONE">DONE</option>
																		</select>
									</td>
							</tr>
							<tr>
									<td>Person in Charge</td>  <td> : </td> <td> <input type="text" class="form-control" name="pic" style="width:300px" /></td>
							</tr>
							<tr>
									<td>Deadline</td> <td> : </td> 
									<td>
										<fieldset>
											<div class="control-group">
											  <div class="controls">
											   <div class="input-prepend input-group">
												 <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
												 <input type="text" style="width:200px;" id="dateIssue" name="deadline" class="form-control" value=""/> 
												 <input type="hidden" name="type" value="PROJECT"/><input type="hidden" name="idProject" value="<?=$project->ID?>"/>
											   </div>
											  </div>
											</div>
										</fieldset>
									</td>
							</tr>
							
						</table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Add Issue</button>
					</form>
                  </div>
                </div>
              </div>
            </div>
  
  
  
  
  <!------------------------- EDIT PROJECT MODAL BOX -->
  
            <div class="modal fade" id="ActModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Opportunity</h4>
                  </div>
                  <div class="modal-body">
					<?php echo form_open(_URL.'project/doActEdit/'.$project->ID);?>
						<table  class="table display">
							<tr>
									<td>Name</td> <td> : </td> <td> <input type="text" class="form-control" name="name" style="width:300px" value="<?=$opportunity->NAME?>" /></td>
							</tr>
							<tr>
									<td>Deskripsi</td> <td> : </td> <td> <textarea name="desc" style="width:300px;"> <?=$opportunity->DESCRIPTION?> </textarea> </td>
							</tr>
							<tr>
									<td>
										Account</td> <td> : </td> <td> 
																		<select  class="selectpicker" name="account" />
																			<?php
																			foreach($accounts as $account)
																			{																
																			?>
																				<option value="<?=$account->ID?>" <?php if($opportunity->ID_ACCOUNT == $account->ID){ ?> selected <?php } ?>><?=$account->NAME?></option>
																			<?php
																			}
																			?>
																		</select>
									</td>
							</tr>
							<tr>
									<td>
										Account Manager in Charge</td> <td> : </td> <td> 
																		<select  class="selectpicker" name="am" />
																			<?php
																			foreach($ams as $am)
																			{																
																			?>
																				<option value="<?=$am->ID?>" <?php if($opportunity->AM_ID == $am->ID){ ?> selected <?php } ?>><?=$am->NAME?></option>
																			<?php
																			}
																			?>
																		</select>
									</td>
							</tr>
							<tr>
									<td>Expected Deadline</td> <td> : </td> 
									<td>
										<fieldset>
											<div class="control-group">
											  <div class="controls">
											   <div class="input-prepend input-group">
												 <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
												 <input type="text" style="width:200px;" id="deadline" name="deadline" class="form-control" value="<?=$opportunity->EXPECTED_DEADLINE?>"/> 
											   </div>
											  </div>
											</div>
										</fieldset>
									</td>
							</tr>
							<tr>
								<td>Amount Forecasted</td> <td> : </td> 
								<td> 
									<fieldset>
										<div class="control-group">
										  <div class="controls">
										   <div class="input-prepend input-group">
												<span class="add-on input-group-addon">
													<select  name="currency" style="height:20px;" >
														<option value="USD" <?php if($opportunity->CURRENCY == "USD"){ ?> selected <?php } ?>>USD</option>
														<option value="RUPIAH" <?php if($opportunity->CURRENCY == "RUPIAH"){ ?> selected <?php } ?>>RUPIAH</option>
													</select> 
												</span>
												<input type="text" style="width:200px;" name="amount" class="form-control" value="<?=$opportunity->AMOUNT?>"/> 
										   </div>
										  </div>
										</div>
									</fieldset>
								</td>
							</tr>
							<tr>
								<td>
									Probability</td> <td> : </td> <td> 
																		<select  class="selectpicker" name="prob" />
																			<option value="KECIL" <?php if($opportunity->PROBABILITY == "KECIL"){ ?> selected <?php } ?>>KECIL</option>
																			<option value="DAPAT DIPERJUANGKAN" <?php if($opportunity->PROBABILITY == "DAPAT DIPERJUANGKAN"){ ?> selected <?php } ?>>DAPAT DIPERJUANGKAN</option>
																			<option value="HAMPIR PASTI" <?php if($opportunity->PROBABILITY == "HAMPIR PASTI"){ ?> selected <?php } ?>>HAMPIR PASTI</option>
																			<option value="DEFINITE" <?php if($opportunity->PROBABILITY == "DEFINITE"){ ?> selected <?php } ?>>DEFINITE</option>
																		</select>
									</td>
							</tr>
							<tr>
									<td>
										Sales Stage</td> <td> : </td> <td> 
																		<select  class="selectpicker" name="stage" />
																			<?php
																			foreach($stages as $stage)
																			{																
																			?>
																				<option value="<?=$stage->ID?>" <?php if($opportunity->SALES_STAGE_ID == $stage->ID){ ?> selected <?php } ?>><?=$stage->NAME?></option>
																			<?php
																			}
																			?>
																		</select>
									</td>
							</tr>
						</table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Edit Opportunity</button>
					</form>
                  </div>
                </div>
              </div>
            </div>
			
			

  <!------------------------- BUILD TEAM MODAL BOX -->
  
            <div class="modal fade" id="TeamModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Project Team</h4>
                  </div>
                  <div class="modal-body">
					<?php echo form_open(_URL.'project/projectTeam');?>
						<table  class="table display">
							<tr>
									<td>Project Manager</td> <td> : </td> <td colspan="2"> 
																			<select  class="selectpicker" name="pm" />
																			    <option value="">--Select Project Manager--</option>
																				<?php
																				foreach($pms as $pm)
																				{																
																				?>
																					<option value="<?=$pm->ID?>"><?=$pm->NAME?></option>
																				<?php
																				}
																				?>
																			</select>
																			<input type="hidden" name="idProject" value="<?=$project->ID?>"/>
																			</td>
							</tr>
							<tr>
									<td>Business Analyst</td> <td> : </td> <td colspan="2"><select  class="selectpicker" name="ba" />
																			    <option value="">--Select Business Analyst--</option>
																							<?php
																							foreach($bas as $ba)
																							{																
																							?>
																								<option value="<?=$ba->ID?>"><?=$ba->NAME?></option>
																							<?php
																							}
																							?>
																						</select></td>
							</tr>
							<tr>
									<td>System Analyst</td> <td> : </td> <td colspan="2">
																			<select  class="selectpicker" name="sa" />
																			    <option value="">--Select System Analyst--</option>
																				<?php
																				foreach($sas as $sa)
																				{																
																				?>
																					<option value="<?=$sa->ID?>"><?=$sa->NAME?></option>
																				<?php
																				}
																				?>
																			</select></td>
							</tr>
							<tr>
									<td>Lead Developer</td> <td> : </td> <td colspan="2">
																			<select  class="selectpicker" name="lead" />
																			    <option value="">--Select Lead Developer--</option>
																				<?php
																				foreach($leads as $lead)
																				{																
																				?>
																					<option value="<?=$lead->ID?>"><?=$lead->NAME?></option>
																				<?php
																				}
																				?>
																			</select></td>
							</tr>
							<tr>
									<td>Programer</td> <td> : </td> <td id="programmer">
																			<select  class="selectpicker" name="progs[]" style="width:150px;">
																			    <option value="">--Select Programmer--</option>
																				<?php
																				foreach($progs as $prog)
																				{																
																				?>
																					<option value="<?=$prog->ID?>"><?=$prog->NAME?></option>
																				<?php
																				}
																				?>
																			</select>
												
									</td><td> <a href="#" class="btn btn-option2" onclick="addProg()">Add <i class="fa fa-plus"></i></a></td>
							</tr>
							<tr>
									<td>Integration</td> <td> : </td> <td id="integration">
																			<select  class="selectpicker" name="integrs[]" />
																			    <option value="">--Select Integration--</option>
																				<?php
																				foreach($integrs as $integr)
																				{																
																				?>
																					<option value="<?=$integr->ID?>"><?=$integr->NAME?></option>
																				<?php
																				}
																				?>
																			</select>
										
									</td><td><a href="#" class="btn btn-option2" onclick="addIntegr()">Add <i class="fa fa-plus"></i></a></td>
							</tr>
							<tr>
									<td>Technical Writer</td> <td> : </td> <td id="tw">
																			<select  class="selectpicker" name="tws[]" />
																			    <option value="">--Select Technical Writer--</option>
																				<?php
																				foreach($tws as $tw)
																				{																
																				?>
																					<option value="<?=$tw->ID?>"><?=$tw->NAME?></option>
																				<?php
																				}
																				?>
																			</select>
									</td><td><a href="#" class="btn btn-option2" onclick="addTW()">Add <i class="fa fa-plus"></i></a></td>
							</tr>
						</table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Confirm Team</button>
					</form>
                  </div>
                </div>
              </div>
            </div>
  

  <!------------------------- VIEW TEAM MODAL BOX -->
  
            <div class="modal fade" id="TeamViewModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Project Team</h4>
                  </div>
                  <div class="modal-body">
					<?php echo form_open(_URL.'project/projectTeam');?>
						<table  class="table display">
							<tr>
									<td>Project Manager</td> <td> : </td> <td colspan="2"> 
																			<select  class="selectpicker" name="pm" />
																			    <option value="">--Not Assigned--</option>
																				<?php
																				foreach($pms as $pm)
																				{																
																				?>
																					<option value="<?=$pm->ID?>" <?php if($team['Project Manager'][0]['ID'] == $pm->ID){ ?> selected <?php } ?>><?=$pm->NAME?></option>
																				<?php
																				}
																				?>
																			</select>
																			<input type="hidden" name="idProject" value="<?=$project->ID?>"/>
																			</td>
							</tr>
							<tr>
									<td>Business Analyst</td> <td> : </td> <td colspan="2"><select  class="selectpicker" name="ba" />
																			    <option value="">--Not Assigned--</option>
																							<?php
																							foreach($bas as $ba)
																							{																
																							?>
																								<option value="<?=$ba->ID?>" <?php if($team['Business Analyst'][0]['ID'] == $ba->ID){ ?> selected <?php } ?>><?=$ba->NAME?></option>
																							<?php
																							}
																							?>
																						</select></td>
							</tr>
							<tr>
									<td>System Analyst</td> <td> : </td> <td colspan="2">
																			<select  class="selectpicker" name="sa" />
																			    <option value="">--Not Assigned--</option>
																				<?php
																				foreach($sas as $sa)
																				{																
																				?>
																					<option value="<?=$sa->ID?>" <?php if($team['System Analyst'][0]['ID'] == $sa->ID){ ?> selected <?php } ?>><?=$sa->NAME?></option>
																				<?php
																				}
																				?>
																			</select></td>
							</tr>
							<tr>
									<td>Lead Developer</td> <td> : </td> <td colspan="2">
																			<select  class="selectpicker" name="lead" />
																			    <option value="">--Not Assigned--</option>
																				<?php
																				foreach($leads as $lead)
																				{																
																				?>
																					<option value="<?=$lead->ID?>" <?php if($team['Lead Developer'][0]['ID'] == $lead->ID){ ?> selected <?php } ?>><?=$lead->NAME?></option>
																				<?php
																				}
																				?>
																			</select></td>
							</tr>
							<tr>
									<td>Programmer</td> <td> : </td> <td id="programmer_view">
																		<?php
																		foreach($team['Programmer'] as $programmer)
																		{
																		?>																				
																			<select  class="selectpicker" name="progs[]" style="width:220px;  margin-top:5px;">
																				<option value="">--Not Assigned--</option>
																				
																					<?php
																					foreach($progs as $prog)
																					{																
																					?>
																						<option value="<?=$prog->ID?>" <?php if($programmer['ID'] == $prog->ID){ ?> selected <?php } ?>><?=$prog->NAME?></option>
																					<?php
																					}
																					?>
																				
																			</select><br/>
																		
																		<?php
																		}
																		?>
									</td><td> <a href="#" class="btn btn-option2" onclick="addProgView()">Add <i class="fa fa-plus"></i></a></td>
							</tr>
							<tr>
									<td>Integrator</td> <td> : </td> <td id="integration_view">
																		<?php 
																		foreach($team['Integrator'] as $integrator)
																		{
																		?>	
																			<select  class="selectpicker" name="integrs[]" style="width:220px;  margin-top:5px;>
																			    <option value="">--Not Assigned--</option>
																				<?php
																				foreach($integrs as $integr)
																				{																
																				?>
																					<option value="<?=$integr->ID?>" <?php if($integrator['ID'] == $integr->ID){ ?> selected <?php } ?>><?=$integr->NAME?></option>
																				<?php
																				}
																				?>
																			</select><br/>
																		<?php
																		}
																		?>
									</td><td><a href="#" class="btn btn-option2" onclick="addIntegrView()">Add <i class="fa fa-plus"></i></a></td>
							</tr>
							<tr>
									<td>Technical Writer</td> <td> : </td> <td id="tw_view">
																		<?php
																		foreach($team['Technical Writer'] as $tw)
																		{
																		?>	
																			<select  class="selectpicker" name="tws[]" style="width:220px;  margin-top:5px;>
																			    <option value="">--Not Assigned--</option>
																				<?php
																				foreach($tws as $tw)
																				{																
																				?>
																					<option value="<?=$tw->ID?>" <?php if($tw['ID'] == $tw->ID){ ?> selected <?php } ?>><?=$tw->NAME?></option>
																				<?php
																				}
																				?>
																			</select><br/>
																		<?php
																		}
																		?>
									</td><td><a href="#" class="btn btn-option2" onclick="addTWView()">Add <i class="fa fa-plus"></i></a></td>
							</tr>
						</table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Confirm Team</button>
					</form>
                  </div>
                </div>
              </div>
            </div>
  


  <!------------------------- PROGRESS MODAL BOX -->
  
            <div class="modal fade" id="ProgressModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Progress</h4>
                  </div>
                  <div class="modal-body">
					<?php echo form_open_multipart(_URL.'project/doAddProgress');?>
						<table  class="table display">
							<tr>
									<td>Target to Date</td> <td> : </td> <td> 
									
									
									<fieldset>
										<div class="control-group">
										  <div class="controls">
										   <div class="input-prepend input-group">
												<input type="text" class="form-control" name="target"/>
												<span class="add-on input-group-addon">
													<input type="text" value="%" style="height:20px; width:20px; padding:0px;" readonly />
												</span>
										   </div>
										  </div>
										</div>
									</fieldset>
									
							</tr>
							<tr>
									<td> Realisasi to Date</td> <td> : </td> <td>
									
									<fieldset>
										<div class="control-group">
										  <div class="controls">
										   <div class="input-prepend input-group">
												<input type="text" class="form-control" name="real"/>
												<span class="add-on input-group-addon">
													<input type="text" value="%" style="height:20px; width:20px; padding:0px;" readonly />
												</span>
										   </div>
										  </div>
										</div>
									</fieldset>
									
									
									
									
									
									</td>
							</tr>
							<tr>
									<td> Detil Laporan</td><td> : </td> <td><textarea name="detail" style="width:400px; height:250px;" class="form-control"> </textarea></td>
							</tr>
							<tr>
								<td> File</td> <td> : </td> <td> 
										<input type="file" name="doc" /><input type="hidden" name="type" value="PROJECT"/><input type="hidden" name="idProject" value="<?=$project->ID?>"/>
									</td>
							</tr>
							
							
						</table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Insert Progress Report</button>
					</form>
                  </div>
                </div>
              </div>
            </div>
  

  <!------------------------- Report MODAL BOX -->
  
            <div class="modal fade" id="ReportModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Progress Report</h4>
                  </div>
                  <div class="modal-body">
						<table  class="table display">
							<tr>
								<th> 
									Date
								</th>
								<th>
									Target
								</th>
								<th>
									Realisasi
								</th>
								<th>
									Dokumen
								</th>
								<th>
									Detail Report
								</th>
							</tr>
							<?php
							foreach($report as $row)
							{
							?>
							<tr>
								<td><?=$row->ENTRY_DATE?></td>
								<td><?=$row->TARGET?></td>
								<td><?=$row->PERCENTAGE?></td>
								<td><a href="<?=$act->F_LINK?>" class="btn btn-success">FILES</a></td>
								<td><a href="#" class="btn btn-info" onclick="($('#report_<?=$row->ID?>').show())">Detail Report</a></td>
							</tr>
							<tr style="display:none" id="report_<?=$row->ID?>">
								<td colspan=5 style="width:100%"><textarea class="form-control" style="width:100%;height:150px;" readonly><?=$row->DETAIL?></textarea></td>
							</tr>
							<?php	
							}
							?>
						</table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Insert Progress Report</button>
					</form>
                  </div>
                </div>
              </div>
            </div>
			
<!------------------------- BUDGET MODAL BOX -->
  
            <div class="modal fade" id="BudgetModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Budget Group</h4>
                  </div>
                  <div class="modal-body">
					<?php echo form_open(_URL.'project/doSetBudget/'.$project->OPPORTUNITY_ID);?>
						<table  class="table display">
							<tr>
									<td>Budget Group</td> <td> : </td> <td> 
										<select name="budget_group" onchange="detail($(this).val())" id="budget_detail">
											<option value="">--Choose Budget--</option>
											<?php
												foreach($budgets as $budget)
												{		
											?>
												<option value="<?=$budget->SET_NAME?>"><?=$budget->SET_NAME?></option>
											<?php										
												}
											?>
										</select>
									<input type="hidden" name="idOPP" value="<?=$project->OPPORTUNITY_ID?>"/> 
									</td>
							</tr>
						</table>
						<hr/>
						<div id="detail">
						
						</div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Set Budget</button>
					</form>
                  </div>
                </div>
              </div>
            </div>
  <!------------------------- BUDGET USAGE MODAL BOX -->
  <?php
	if($opportunity->BUDGET_GROUP != "NOT SET")
	{
  ?>
            <div class="modal fade" id="BudgetUsageModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" style="width:800px;">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Contract Budget Based Usage</h4>
                  </div>
                  <div class="modal-body">
						<div id="detail_usage">
						
						</div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Reset Budget</button>
                  </div>
                </div>
              </div>
            </div>
  
  <?php
	}
  ?>
  
  <!------------------------- SPENDING MODAL BOX -->
  
            <div class="modal fade" id="spendingModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Spending</h4>
                  </div>
                  <div class="modal-body">
				  <center>
					Alokasi Budget</td> <td> : </td> <td> 
						<select  class="selectpicker" onchange="spending(<?=$project->OPPORTUNITY_ID?>,$(this).val())" name="status" />
							<option value="">-Choose Budget Allocation-</option>
							<?php
								foreach($budgetComp as $comp)
								{
							?>
								<option value="<?=$comp->ID?>"><?=$comp->ORDER_NO?> <?=$comp->NAME?></option>
							<?php
								}
							?>
						</select>
					</center>
					<?php echo form_open_multipart(_URL.'budget/doAddSpending/project');?>
						<div id="spending">
						</div>					
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<input type="hidden" name="idProject" value="<?=$project->ID?>"/>
					</form>
                  </div>
                </div>
              </div>
            </div>
  
<!-- ================================================
Data Tables
================================================ -->
<script src="<?php echo base_url(); ?>assets/js/datatables/datatables.min.js"></script>


<!-- ================================================
Chartist
================================================ -->
<!-- main file -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chartist/chartist.min.js"></script>


<script>
$(document).ready(function() {
    $('#table_act').DataTable();
    $('#table_issue').DataTable();
    $('#table_spending').DataTable();
	$('#dateAct').daterangepicker({ 
		singleDatePicker: true, 
		locale: {
					format: 'YYYY-MMM-DD'
				} 
	});
	$('#dateIssue').daterangepicker({ 
		singleDatePicker: true, 
		locale: {
					format: 'YYYY-MMM-DD'
				} 
	});
	
/* ======================================================================
Simple Line Chart
====================================================================== */
	new Chartist.Line('#chartist-line', {
	  labels: <?=$timeline?>,
	  series: [
		<?=$percentage?>
	  ]
	}, {
	  fullWidth: true,
	  chartPadding: {
		right: 40
	  }

	});

} );

function issueStat(issue_id, stat)
{
	if(stat == "DONE")
	{
		$('#issue_id').val(issue_id);
		$('#issue_stat').val(stat);
		
		$('#SolutionModal').modal('show');
	}
	else
	{
		window.location.href = "<?=_URL?>project/doChangeStatIssue/PROJECT/"+issue_id+"/"+stat+"/<?=$project->ID?>";
	}
}

function actStat(act_id, stat)
{
//	alert(stat);
	window.location.href = "<?=_URL?>project/doChangeStatAct/PROJECT/"+act_id+"/"+stat+"/<?=$project->ID?>";
	
}

function addProg()
{
	var string = "<br/><select  class='selectpicker' name='progs[]' style='width:220px; margin-top:5px;' ><option value=''> --Select Programmer--</option>"
		<?php
		foreach($progs as $prog)
		{																
		?>
			+"<option value='<?=$prog->ID?>'><?=$prog->NAME?></option>"
		<?php
		}
		?>
	+"</select>";
	$("#programmer").append(string);
}

function addIntegr()
{
	var string = "<br/><select  class='selectpicker' name='integrs[]' style='width:220px; margin-top:5px;' ><option value=''> --Select Integration--</option>"
		<?php
		foreach($integrs as $integr)
		{																
		?>
			+"<option value='<?=$integr->ID?>'><?=$integr->NAME?></option>"
		<?php
		}
		?>
	+"</select>";
	$("#integration").append(string);
}


function addTW()
{
	var string = "<br/><select  class='selectpicker' name='tws[]' style='width:220px; margin-top:5px;' ><option value=''> --Select Technical Writer--</option>"
		<?php
		foreach($tws as $tw)
		{																
		?>
			+"<option value='<?=$tw->ID?>'><?=$tw->NAME?></option>"
		<?php
		}
		?>
	+"</select>";
	$("#tw").append(string);
}

function addProgView()
{
	var string = "<select  class='selectpicker' name='progs[]' style='width:220px; margin-top:5px;' ><option value=''> --Select Programmer--</option>"
		<?php
		foreach($progs as $prog)
		{																
		?>
			+"<option value='<?=$prog->ID?>'><?=$prog->NAME?></option>"
		<?php
		}
		?>
	+"</select><br/>";
	$("#programmer_view").append(string);
}

function addIntegrView()
{
	var string = "<select  class='selectpicker' name='integrs[]' style='width:220px; margin-top:5px;' ><option value=''> --Select Integration--</option>"
		<?php
		foreach($integrs as $integr)
		{																
		?>
			+"<option value='<?=$integr->ID?>'><?=$integr->NAME?></option>"
		<?php
		}
		?>
	+"</select><br/>";
	$("#integration_view").append(string);
}


function addTWView()
{
	var string = "<select  class='selectpicker' name='tws[]' style='width:220px; margin-top:5px;' ><option value=''> --Select Technical Writer--</option>"
		<?php
		foreach($tws as $tw)
		{																
		?>
			+"<option value='<?=$tw->ID?>'><?=$tw->NAME?></option>"
		<?php
		}
		?>
	+"</select><br/>";
	$("#tw_view").append(string);
}


function viewDetail(this_)
{
	content = "<tr><td>a</td><td>a</td><td>a</td><td>a</td><td>a</td></tr>";
	this_.after(content);
}


function view_usage(oppID,bName)
{
		bName = bName.replace(/ /g,"_");
		$('#detail_usage').load( "<?php echo _URL;?>budget/usage_detail_budget/"+oppID+"/"+bName, function() {
			$('#BudgetUsageModal').modal('show');
		});
	
}


function spending(oppID, id)
{
	if(id != "")
	{
		$('#spending').load( "<?php echo _URL;?>budget/spending_form/"+oppID+"/"+id, function() {
		  
		});
	}
	
}
</script>

