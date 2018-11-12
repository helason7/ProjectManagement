
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">POS Anggaran</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>Finance/posAnggaran" class="btn btn-light">List Pos Anggaran</a>
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
						<td>Deskripsi</td> <td> : </td> <td> <?=$post->DESCRIPTION?></td>
				</tr>
				<tr>
						<td>
							Account Manager in Charge</td> <td> : </td> <td> <?=$post->AM_NAME?>
															
						</td>
                </tr>
				<tr>
					<td>
						Budget Group</td> <td> : </td> <td> <?=$post->BUDGET_GROUP?>
					</td>
				</tr>
				<tr>
					<?php
					if($post->BUDGET_GROUP == "NOT SET")
					{
					?>
						<td colspan=4> <a href="#"  data-toggle="modal" data-target="#BudgetModal" class="btn btn-info"/> Set Budget </td>
					<?php
					}
					else{
					?>
						<td colspan=4> <a href="#"  onclick="view_usage('<?=$post->ID?>','<?=$post->BUDGET_GROUP?>')" class="btn btn-warning"/> View Budget </td>
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

  <div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-title">
				Summary Penggunaan Anggaran
			</div>
			<div class="panel-body table-responsive">
			<table  class="table display">
				<tr>
					<th style="width:5%;"> 
						No
					</th>
					<th style="width:25%;">
						Budget Name
					</th>
					<th style="width:25%;">
						Component Name
					</th>
					<th style="width:15%;">
						Allocated
					</th>
					<th style="width:15%;">
						Used
					</th>
					<th style="width:15%;">
						Remained
					</th>
				</tr>
				<?php foreach($summbudgets as $key=>$bud){
					
				?>
					<tr>
						<td><?=$bud['ORDER']?></td><td><?=$bud['TYPE_NAME']?></td><td></td><td style="text-align:right;">
						<?php
						if(count($bud['COMP_NAME']) == 1){
						?>
							Rp <?=number_format($bud['AMOUNT'])?>
						<?php
						}
						?></td>
						<td style="text-align:right;">
							<?php
							if(count($bud['COMP_NAME']) == 1){
							echo "Rp ".number_format($bud['USAGE']) ;
							}
							?>
						</td>
						<td style="text-align:right;">
							<?php
							if(count($bud['COMP_NAME']) == 1){
							echo "Rp ".number_format($bud['REMAINDER']) ;
							}
							?>
						</td>
					</tr>
					<?php
						foreach($bud['COMP_NAME'] as $comp)
						{
							if($comp != "")
							{
								$comp_ = explode("|",$comp);
					?>		
					<tr>
						<td><?=$comp_[1]?></td><td></td><td><?=$comp_[0]?></td><td style="text-align:right;">Rp <?=number_format($comp_[3])?></td><td style="text-align:right;">Rp <?=number_format($comp_[4])?></td><td style="text-align:right;">Rp <?=number_format($comp_[5])?></td>
					</tr>
					
					<?php		
							}
						}
					?>
				<?php
				}
				?>
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
  

  <!------------------------- BUDGET MODAL BOX -->
  
            <div class="modal fade" id="BudgetModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Budget Group</h4>
                  </div>
                  <div class="modal-body">
					<?php echo form_open(_URL.'project/doSetBudget/'.$post->ID);?>
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
									<input type="hidden" name="idOPP" value="<?=$post->ID?>"/> 
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
						<select  class="selectpicker" onchange="spending(<?=$post->ID?>,$(this).val())" name="status" />
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
					<?php echo form_open_multipart(_URL.'budget/doAddSpending/'.$type);?>
						<div id="spending">
						</div>					
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					</form>
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
    $('#table_spending').DataTable();
} );


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

