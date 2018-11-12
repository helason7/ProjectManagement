
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Opportunities Management -- Project Analisys</li>
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
		
			<form action="<?php echo $url;?>" method="post" >
				<div class="form-group"><label>ID PROJECT</label>
                            <input type="text" id="ID_PROJECT" name="ID_PROJECT" class="form-control" value="<?php  
					foreach ($project as $row)
					{
							echo $row['ID_PROJECT'];
					
					}
					?>">
					
                            </div>
				<div class="form-group"><label>Project Name</label>
				<input type="text" id="PROJECT_NAME" name="PROJECT_NAME" class="form-control" value="<?php  
					foreach ($project as $row)
					{
							echo $row['PROJECT_NAME'];
					
					}
					?>">
                </div>
				<div class="form-group">
				  <label>Customer</label>
				  <select name="ID_CUSTOMER" class="form-control" id="ID_CUSTOMER" >
					<?php
						foreach($accounts as $account)
						{																
						?>
							<option value="<?=$account->ID?>"><?=$account->NAME?></option>
						<?php
						}
				
					?>
												
				  </select>
				</div>      
			
			<fieldset class="row2">
				<legend>Cost Of Shared Services</legend>
				<p> 
					<input type="button" class="btn btn-success" value="Add Activity" onClick="addRow('dataTable')" /> 
					<input type="button" class="btn btn-success" value="Remove Activity" onClick="deleteRow('dataTable')"  /> 
					<p>(All acions apply only to entries with check marked check boxes only.)</p>
				</p>
				
               
               <table id="dataTable" class="form" border="0">
                  
				
				  <tbody>
                    <tr>
                      <p>
						
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
						
						<td>
							
							<select name="kegiatan[]" class="form-control" id="kegiatan" >
								<?php
									foreach($sharedservice as $sharedservice)
									{																
									?>
										<option value="<?=$sharedservice->ID_KEGIATAN?>"><?=$sharedservice->KEGIATAN?></option>
									<?php
									}
							
								?>
															
							</select>
							
						</td>
						<td>
							
							<input type="text" required="required" name="JUMLAH[]">
						 </td>
						 
						<td>
							
							<select name="SATUAN_JUMLAH[]" required="required">
									<option>--Pilih Satuan--</option>
									<option>PAKET</option>
									<option>BUKU</option>
								</select>
						</td>
						
						 <td>
							
							<input type="text" required="required" class="small"  name="DURASI[]">
					     </td>
						<td>
							
							<select name="SATUAN_DURASI[]" required="required">
									<option>--Pilih Satuan--</option>
									<option>BULAN</option>
									<option>SET</option>
									<option>TIME</option>
								</select>
						</td> 
						 <td>
							
							<input type="text" required="required" class="small"  name="UNIT_COST[]">
					     </td>
							</p>
                    </tr>
                    </tbody>
                </table>
				<div class="clear"></div>
            </fieldset>
			<div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
                
            </div>
		
			</form>   
		
        </div>

      </div>
    </div>
    <!-- End Panel -->
	
  </div>


  
<!-- ================================================
Data Tables
================================================ -->
<script src="<?php echo base_url(); ?>assets/js/datatables/datatables.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/script.js"></script>


<script>
$(document).ready(function() {
    
	
	$('#ID_CUSTOMER').val('<?php  foreach ($project as $row){ echo $row['ID_CUSTOMER'];}?>');
	
	
	
} );



</script>

