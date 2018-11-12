
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Opportunities List</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="#" data-toggle="modal" data-target="#AddModal"  class="btn btn-light">Add New Project</a>
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
		<div class="col-md-12">
		  <div class="panel panel-default">
			<div class="panel-title">
			  <ul class="topstats clearfix">
				<li class="arrow"></li>
				<li class="col-xs-6 col-lg-4">
				  <span class="title"><i class="fa fa-dot-circle-o"></i>READY to Handover</span>
				  <h3><?=$summary_project['HANDOVER']?></h3>
				</li>
				<li class="col-xs-6 col-lg-4">
				  <span class="title"><i class="fa fa-dot-circle-o"></i>PROJECT ONGOING</span>
				  <h3><?=$summary_project['ONGOING']?></h3>
				</li>
				<li class="col-xs-6 col-lg-4">
				  <span class="title"><i class="fa fa-dot-circle-o"></i>PROJECT CRITICAL</span>
				  <h3><?=$summary_project['CRITICAL']?></h3>
				</li>
			  </ul>
			  <center> <a href="#" class="btn btn-success"  data-toggle="modal" data-target="#AddModal"  style="width:90%; "> Add New Project </a></center>
			</div>
		  </div>
		</div>
	</div>
  <!-- Start Fourth Row -->
  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
          Project Ready to Hand Over
        </div>
        <div class="panel-body table-responsive">

            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Account</th>
                        <th>PIC</th>
                        <th>AM</th>
                        <th>Amount</th>
                        <th>Stage</th>
                        <th>Deadline</th>
						<th></th>
                    </tr>
                </thead>
             
             
                <tbody>
					<?php
					foreach($opportunities as $opp)
					{
					?>
                    <tr>
                        <td><?=$opp->NAME?></td>
                        <td><?=$opp->G_NAME?></td>
                        <td><?=$opp->PIC?></td>
                        <td><?=$opp->AM_NAME?></td>
                        <td><?=number_format($opp->AMOUNT)?></td>
                        <td><?=$opp->SALES_STAGE?></td>
                        <td><?=$opp->EXPECTED_DEADLINE?></td>
						<td><a href="<?=_URL?>project/addNewProjectOpp/<?=$opp->ID?>" class="btn btn-info">ACCEPT</a></td>
                    </tr>
                    <?php
					}
					?>
					
                </tbody>
            </table>


        </div>

      </div>
    </div>
    <!-- End Panel -->

  </div>
  <!-- End Fifth Row -->
 

  <!-- Start Fourth Row -->
  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
          Project List
        </div>
        <div class="panel-body table-responsive">

            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Account</th>
                        <th>PIC</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
						<th></th>
                    </tr>
                </thead>
             
               
                <tbody>
					<?php
					foreach($projects as $project)
					{
					?>
                    <tr>
                        <td><?=$project->NAME?></td>
                        <td><?=$project->G_NAME?></td>
                        <td><?=$project->PIC?></td>
                        <td><?=$project->START_DATE?></td>
                        <td><?=$project->END_DATE?></td>
                        <td><?=$project->STATUS?></td>
						<td><a href="<?=_URL?>project/ViewProject/<?=$project->ID?>" class="btn btn-success">VIEW</a></td>
                    </tr>
                    <?php
					}
					?>
					
                </tbody>
            </table>


        </div>

      </div>
    </div>
    <!-- End Panel -->

  </div>
  <!-- End Fifth Row -->


  <!------------------------- SOLUTION MODAL BOX -->
  
            <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Project</h4>
                  </div>
                  <div class="modal-body">
					
						<center> <a href="<?=_URL?>project/addNewProjectOpp" class="btn btn-success" style="width:90%; "> Add From Opportunity </a></center>
						<br/>
						<center> <a href="<?=_URL?>project/addNewProjectNew" class="btn btn-info" style="width:90%; "> New Project </a></center>
					
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
  
  
<!-- ================================================
Data Tables
================================================ -->
<script src="<?php echo base_url(); ?>assets/js/datatables/datatables.min.js"></script>



<script>
$(document).ready(function() {
    $('#example0').DataTable();
} );
</script>



