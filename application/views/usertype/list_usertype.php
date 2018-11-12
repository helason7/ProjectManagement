
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">UserType</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>Master_Usertype/setup_usertype" class="btn btn-light">Add New UserType</a>
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
			  <center> <a href="<?=_URL?>Master_Usertype/setup_usertype" class="btn btn-success"   style="width:90%; "> Add New UserType </a></center>
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
          UserType List
        </div>
        <div class="panel-body table-responsive">
		
            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Is Admin</th>
                        <th>Division</th>
                        <th>Sub-Division</th>
						<th style="width:10%"></th>
                    </tr>
                </thead>
             
             
                <tbody>
					<?php
            $admin = "";
            
					foreach($usertypes as $bud)
					{
              if ($bud->IS_ADMIN != 0){
                  $admin = "Yes";
              } else{
                  $admin = "No";
              }
					?>
                    <tr>
                        <td><?=$bud->NAME?></td>
                        <td><?=$admin?></td>
                        <td><?=$bud->DIVISION?></td>
                        <td><?=$bud->SUBDIVISION?></td>
            <td><a href="<?=_URL?>Master_Usertype/update_data/<?=$bud->ID?>" class="btn btn-warning">EDIT</a></td>
            <td><a href="<?=_URL?>Master_Usertype/delete_data/<?=$bud->ID?>" class="btn btn-danger">DELETE</a></td>
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

  

  <!------------------------- UserType BOX -->
  
            <div class="modal fade" id=" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">UserType</h4>
                  </div>
                  <div class="modal-body" id="body_master_usertype">
						
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
	$('#body_usertype').load( "<?php echo _URL;?>master_usertype/detail_usertype/"+name, function() {
	  
		$('').modal('show');
	});
}
</script>



