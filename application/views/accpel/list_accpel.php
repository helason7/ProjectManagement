
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Account List</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>Account_Pel/addNewAccpel" class="btn btn-light">Add New Account</a>
        <a href="#" class="btn btn-light"><i class="fa fa-refresh"></i></a>
        <a href="#" class="btn btn-light"><i class="fa fa-search"></i></a>
      </div>
    </div>
    <!-- End Page Header Right Div -->

  </div>
  <!-- End Page Header -->
    
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

 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-widget">

 
	<div class="row">
		<div class="col-md-12">
		  <div class="panel panel-default">
			<div class="panel-title">
			  <center> <a href="<?=_URL?>Account_Pel/addNewAccpel" class="btn btn-success"   style="width:90%; "> Add New Account </a></center>
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
          Account List
        </div>
        <div class="panel-body table-responsive">

            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>ID ACCOUNT PEL</th>
                        <th>ACCOUNT NAME</th>
						<th style="width:10%"></th>
                    </tr>
                </thead>
             
             
                <tbody>
					<?php
					foreach($accpels as $bud)
					{
					?>
                    <tr>
                        <td><?=$bud->ID_ACCOUNT_PEL?></td>
                        <td><?=$bud->ACCOUNT_NAME?></td>
            <td><a class="btn btn-warning" href="<?=_URL?>Account_Pel/update_data/<?=$bud->ID_ACCOUNT_PEL?>" >
<i class="fa fa-edit" style="font-size:18px"></i></a></td>
            <td><a class="btn btn-danger" href="<?=_URL?>Account_Pel/delete_data/<?=$bud->ID_ACCOUNT_PEL?>" >
<i class="fa fa-close" style="font-size:18px"></i></a></td>
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

  

  <!------------------------- Budget MODAL BOX -->
  
            <div class="modal fade" id="BudgetModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Budget Viewer</h4>
                  </div>
                  <div class="modal-body" id="body_mitra">
						
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
    $('#example0').DataTable();
} );

function view(name)
{
	name = name.replace(/ /g,"_");
	$('#body_mitra').load( "<?php echo _URL;?>mitra/detail_mitra/"+name, function() {
	  
		$('#BudgetModal').modal('show');
	});
}
</script>



