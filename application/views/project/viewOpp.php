
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Opportunities Management -- Opportunity</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>project/presale" class="btn btn-light">List Opportunities</a>
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
          <?=$opportunity->NAME?>
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
						<td>Deskripsi</td> <td> : </td> <td> <?=$opportunity->DESCRIPTION?></td>
				</tr>
				<tr>
                        <td>
							Account</td> <td> : </td> <td> <?=$opportunity->G_NAME?>
						</td>
				</tr>
				<tr>
                        <td>Person in Charge @ Account</td>  <td> : </td> <td> <?=$opportunity->PIC?></td>
				</tr>
				<tr>
						<td>
							Account Manager in Charge</td> <td> : </td> <td> <?=$opportunity->AM_NAME?>
															
						</td>
                </tr>
				<tr>
						<td>Expected Deadline</td> <td> : </td> 
						<td>
							<?=$opportunity->EXPECTED_DEADLINE?>
						</td>
				</tr>
				<tr>
					<td>Amount Forecasted</td> <td> : </td> 
					<td> 
						<?=number_format($opportunity->AMOUNT)?> <?=$opportunity->CURRENCY?>
					</td>
				</tr>
				<tr>
					<td>
						Probability</td> <td> : </td> <td> <?=$opportunity->PROBABILITY?>
						</td>
				</tr>
				<tr>
					<td>
						Sales Stage</td> <td> : </td> <td> <?=$opportunity->SALES_STAGE?>
						</td>
				</tr>
				<tr>
					<td>
						Budget Group</td> <td> : </td> <td> <?=$opportunity->BUDGET_GROUP?>
						</td>
				</tr>
				<tr>
					<td colspan="2"><a href="#"  data-toggle="modal" data-target="#OppModal" class="btn btn-default"/> Edit Data </a></td>
					<?php
					if($opportunity->BUDGET_GROUP == "NOT SET")
					{
					?>
						<td> <a href="#"  data-toggle="modal" data-target="#BudgetModal" class="btn btn-info"/> Set Budget </a></td>
					<?php
					}
					else{
					?>
						<td> <a href="#"  onclick="view_usage('<?=$opportunity->ID?>','<?=$opportunity->BUDGET_GROUP?>')" class="btn btn-warning"/> View Budget </td>
					<?php
					}
					?>
				</tr>
             
            </table>
		
        </div>

      </div>
    </div>
    <!-- End Panel -->

  </div>


  
<!-- ================================================
Data Tables
================================================ -->
<script src="<?php echo base_url(); ?>assets/js/datatables/datatables.min.js"></script>



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
	$('#deadline').daterangepicker({ 
		singleDatePicker: true, 
		locale: {
					format: 'YYYY-MMM-DD'
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
		window.location.href = "<?=_URL?>project/doChangeStatIssue/OPPORTUNITY/"+issue_id+"/"+stat+"/<?=$opportunity->ID?>";
	}
}

function actStat(act_id, stat)
{
//	alert(stat);
	window.location.href = "<?=_URL?>project/doChangeStatAct/OPPORTUNITY/"+act_id+"/"+stat+"/<?=$opportunity->ID?>";
	
}


function detail(name)
{
	name = name.replace(/ /g,"_");
	if(name != "")
	{
		$('#detail').load( "<?php echo _URL;?>budget/set_detail_budget/"+name, function() {
		  
		});
	}
	
}

function spending(oppID, id)
{
	if(id != "")
	{
		$('#spending').load( "<?php echo _URL;?>budget/spending_form/"+oppID+"/"+id, function() {
		  
		});
	}
	
}

function view_usage(oppID,bName)
{
		bName = bName.replace(/ /g,"_");
		$('#detail_usage').load( "<?php echo _URL;?>budget/usage_detail_budget/"+oppID+"/"+bName, function() {
			$('#BudgetUsageModal').modal('show');
		});
	
}
</script>

