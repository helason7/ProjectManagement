
 <!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">User Management</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>user/addNewForm" class="btn btn-light">Add New User</a>
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



  <!-- Start Fourth Row -->
  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
          User List
        </div>  
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

        <div class="panel-body table-responsive">

            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>NIK</th>
                        <th>Posisi</th>
                        <th>Divisi</th>
                        <th>Sub Divisi</th>
						<th></th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>NIK</th>
                        <th>Posisi</th>
                        <th>Divisi</th>
                        <th>Sub Divisi</th>
						<th></th>
                    </tr>
                </tfoot>

                <tbody>
					<?php
					foreach($users as $user)
					{
					?>
                    <tr>
                        <td><?=$user->NAME?></td>
                        <td><?=$user->NIK?></td>
                        <td><?=$user->G_NAME?></td>
                        <td><?=$user->DIVISION?></td>
                        <td><?=$user->SUBDIVISION?></td>
						<td><a href="<?=_URL?>User/editForm/<?=$user->ID?>" class="btn btn-success">EDIT</a></td>
            <td><a href="<?=_URL?>User/delete_data/<?=$user->ID?>" class="btn btn-danger">DELETE</a></td>
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


<!-- ================================================
Data Tables
================================================ -->
<script src="<?php echo base_url(); ?>assets/js/datatables/datatables.min.js"></script>



<script>
$(document).ready(function() {
    $('#example0').DataTable();
} );
</script>
