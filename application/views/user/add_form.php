
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
        <a href="<?=_URL?>user" class="btn btn-light">List User</a>
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
          User Form
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
		
        <form action="<?php echo _URL;?>user/doAddUser" method="post">
            <table id="example0" class="table display">
                <tr>
                        <td>Name</td> <td> : </td> <td> <input type="text" class="form-control" name="name" style="width:300px" /></td>
				</tr>
				<tr>
                        <td>NIK</td>  <td> : </td> <td> <input type="text" class="form-control" name="nik" style="width:300px" /></td>
				</tr>
				
				<tr>
                        <td>
							Posisi</td> <td> : </td> <td> 
															<select  class="selectpicker" name="type" />
																<?php
																foreach($types as $type)
																{																
																?>
																	<option value="<?=$type->ID?>"><?=$type->NAME?></option>
																<?php
																}
																?>
															</select>
						</td>
				</tr>
				<tr>
						<td>Spesialisasi</td> <td> : </td> 
						<td>
							
								<?php
								foreach($specs as $spec)
								{
								?>
								<div class="checkbox checkbox-success" style=" position: relative; float:right; padding-right:20px;">
									<input id="checkbox_<?=$spec->ID?>" type="checkbox" name="specs[]" value="<?=$spec->ID?>">
									<label for="checkbox_<?=$spec->ID?>">
										<?=$spec->NAME?>
									</label>
								</div>
								<?php
								}
								?>
						</td>
                </tr>
				<tr>
					<td>UserName</td> <td> : </td> <td> <input type="text" class="form-control" name="username" style="width:300px" /></td>
				</tr>
				<tr>
					<td>Password</td> <td> : </td> <td> <input type="password" class="form-control" name="password" style="width:300px" /></td>
				</tr>
				<tr>
					<td colspan="4"><input type="submit" value="Add New User" class="btn btn-default"/></td>
				</tr>
             
            </table>
		</form>
		
	  <br/><br/><br/><Br/><br/>
        </div>

      </div>
    </div>
    <!-- End Panel -->

  </div>
  <!-- End Fifth Row -->




