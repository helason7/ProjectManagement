
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Divisi List</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>Master_Divisi/setup_divisi" class="btn btn-light">Add New Divisi Type</a>
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
        <center> <a href="<?=_URL?>Master_Divisi/setup_divisi" class="btn btn-success"   style="width:90%; "> Add New Divisi Type </a></center>
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
          Divisi Type List
        </div>
        <div class="panel-body table-responsive">
            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DIVISION NAME</th>
                        <th>HEAD DIVISION</th>
						<th style="width:10%"></th>
                    </tr>
                </thead>
             
             
                <tbody>
					<?php
					foreach($divisis as $bud)
					{
					?>
                    <tr>
                        <td><?=$bud->ID?></td>
                        <td><?=$bud->NAME?></td>
                        <td><?=$bud->DIVNAME?></td>
						<td><a href="<?=_URL?>Master_Divisi/getDivById/<?=$bud->ID?>" class="btn btn-warning">EDIT</a></td>
            <td><a href="<?=_URL?>Master_Divisi/delete_data/<?=$bud->ID?>" class="btn btn-danger">DELETE</a></td>
                    </tr>
                    <?php
					}
					?>
					
                </tbody>
            </table>
      <!-- 
        <table id="opurtinity" data-toggle="table" data-url="<?php echo (base_url().'master_divisi/divisi_list'); ?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-toolbar="#toolbar" data-show-export="true" data-search="true" data-select-item-name="toolbar1" data-single-select="true" data-pagination="true" data-show-export="true"data-sort-name="name" data-sort-order="desc" >
          
        <thead>
          <tr>
          <th data-field="rownum" data-checkbox="true" >ID</th>
          <th data-field="ID"  data-sortable="true" data-visible="false">ID</th>
          <th data-field="NAME"  data-sortable="true" data-visible="false">Division Name</th>
          <th data-field="DIVNAME" data-sortable="true" data-visible="false">Head Division</th>
          
          </tr>
          </thead>
      </table> -->

        </div>

      </div>
    </div>
    <!-- End Panel -->

  </div>
  <!-- End Fifth Row -->

  

  <!------------------------- Divisi MODAL BOX -->
  
            <div class="modal fade" id="DivisiModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Divisi Viewer</h4>
                  </div>
                  <div class="modal-body" id="body_divisi">
						
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

function edit(ID)
{
	// name = name.replace(/ /g,"_");
	$('#body_divisi').load( "<?php echo _URL;?>master_divisi/edit_divisi/"+ID, function() {
	  
		$('#DivisiModal').modal('show');
	});
}

function delete(ID)
{
  // name = name.replace(/ /g,"_");
  $('#body_divisi').load( "<?php echo _URL;?>master_divisi/delete_divisi/"+ID, function() {
    
    $('#DivisiModal').modal('show');
  });
}
</script>



