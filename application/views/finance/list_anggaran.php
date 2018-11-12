
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">
	
  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Daftar Pos Anggaran</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>budget/setup_budget" class="btn btn-light">Add Pos Anggaran</a>
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
			  <center> <a href="#"  data-toggle="modal" data-target="#BudgetModal" class="btn btn-success"   style="width:90%; "> Tambahkan Pos Anggaran </a></center>
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
          List Post Anggaran
        </div>
        <div class="panel-body table-responsive">
		
            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>Nama Anggaran</th>
                        <th>Perusahaan</th>
                        <th>Alokasi</th>
                        <th>Terpakai</th>
                        <th>Available</th>
						<th style="width:10%"></th>
                    </tr>
                </thead>
             
             
                <tbody>
					<?php
					foreach($budgets as $bud)
					{
					?>
                    <tr>
                        <td><?=$bud->NAME?></td>
                        <td><?=$bud->G_NAME?></td>
                        <td><?=number_format($bud->ALLOCATED)?></td>
                        <td><?=number_format($bud->USED)?></td>
                        <td><?=number_format($bud->REMAIN)?></td>
						<td><a href="<?=_URL?>finance/ViewPost/oppb/<?=$bud->ID?>"  class="btn btn-success">VIEW</a></td>
                    </tr>
                    <?php
					}
					?>
					
					<?php
					foreach($posts as $post)
					{
					?>
                    <tr>
                        <td><?=$post->NAME?></td>
                        <td>INTERNAL</td>
                        <td><?=number_format($post->ALLOCATED)?></td>
                        <td><?=number_format($post->USED)?></td>
                        <td><?=number_format($post->REMAIN)?></td>
						<td><a href="<?=_URL?>finance/ViewPost/post/<?=$post->ID?>"  class="btn btn-success">VIEW</a></td>
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

  

 
  <!------------------------- BUDGET MODAL BOX -->
  
            <div class="modal fade" id="BudgetModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilih Budget Group</h4>
                  </div>
                  <div class="modal-body">
					<?php echo form_open(_URL.'Finance/doAddPost/');?>
						<table  class="table display">
							<tr>
								<td> Nama POS Anggaran </td><td> : </td> <td> <input type="text" name="name"> </td>
							</tr>
							<tr>
								<td> Deskripsi </td><td> : </td> <td> <textarea name="desc" style="width:300px;"> </textarea> </td>
							</tr>
							<tr>
									<td>Budget Group</td> <td> : </td> <td> 
										<select name="budget_group" onchange="detail($(this).val())" id="budget_detail">
											<option value="">--Choose Budget--</option>
											<?php
												foreach($budget_type as $budget)
												{		
											?>
												<option value="<?=$budget->SET_NAME?>"><?=$budget->SET_NAME?></option>
											<?php										
												}
											?>
										</select>
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
  
<!-- ================================================
Data Tables
================================================ -->
<script src="<?php echo base_url(); ?>assets/js/datatables/datatables.min.js"></script>



<script>
$(document).ready(function() {
    $('#example0').DataTable();
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
</script>



