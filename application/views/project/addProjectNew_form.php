
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Opportunities Management -- Add New Project</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>project/presale" class="btn btn-light">List Projects</a>
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
          New Project
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
		
        <form action="<?php echo _URL;?>project/doAddProjectNew" method="post">
            <table  class="table display">
                <tr>
                        <td>Name</td> <td> : </td> <td> <input type="text" class="form-control" name="name" style="width:300px" /></td>
				</tr>
				<tr>
						<td>Deskripsi</td> <td> : </td> <td> <textarea name="desc" style="width:300px;"> </textarea> </td>
				</tr>
				<tr>
                        <td>
							Account</td> <td> : </td> <td> 
															<select  class="selectpicker" name="account" />
																<?php
																foreach($accounts as $account)
																{																
																?>
																	<option value="<?=$account->ID?>"><?=$account->NAME?></option>
																<?php
																}
																?>
															</select>
						</td>
				</tr>
				<tr>
						<td>Start Date</td> <td> : </td> 
						<td>
							<fieldset>
								<div class="control-group">
								  <div class="controls">
								   <div class="input-prepend input-group">
									 <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
									 <input type="text" style="width:200px;" id="start" name="start" class="form-control" value=""/> 
								   </div>
								  </div>
								</div>
							</fieldset>
						</td>
				</tr>
				<tr>
						<td>End Date</td> <td> : </td> 
						<td>
							<fieldset>
								<div class="control-group">
								  <div class="controls">
								   <div class="input-prepend input-group">
									 <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
									 <input type="text" style="width:200px;" id="end" name="end" class="form-control" value=""/> 
								   </div>
								  </div>
								</div>
							</fieldset>
						</td>
				</tr>
				<tr>
                        <td>
							Status</td> <td> : </td> <td> 
															<select  class="selectpicker" name="status" />
																	<option value="HEALTHY">HEALTHY</option>
																	<option value="NEED ATTENTION">NEED ATTENTION</option>
																	<option value="CRITICAL">CRITICAL</option>
																	<option value="CLOSED">CLOSED</option>
															</select>
						</td>
				</tr>
				<tr>
					<td colspan="4"><input type="submit" value="Add Project" class="btn btn-default"/></td>
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


<script type="text/javascript">
$(document).ready(function() {
  $('#start').daterangepicker({ 
		singleDatePicker: true, 
		locale: {
					format: 'YYYY-MMM-DD'
				} 
	});
	
  $('#end').daterangepicker({ 
		singleDatePicker: true, 
		locale: {
					format: 'YYYY-MMM-DD'
				} 
	});
});
</script>



