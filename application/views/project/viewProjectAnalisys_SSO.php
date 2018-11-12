
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
        <a href="<?=_URL?>project/ProjectAnalisys/<?php  
					foreach ($project as $row)
					{
							echo $row['ID'];
					
					}
					?>" class="btn btn-light">List Opportunities</a>
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
			<fieldset class="row4">
				<legend>
				<?php 
					foreach ($nameAccount as $row)
					{
							echo $row['ACCOUNT_NAME'];
					
					}
				?>
				</legend>
			</fieldset>

             <input type="hidden" id="idCost" name="idCost" value="<?=$idCost;?>" class="form-control">
				<div class="form-group"><label>ID PROJECT</label>
                            <input type="text" id="ID_PROJECT" name="ID_PROJECT" class="form-control" value="<?php  
					echo $projectid;
					?>">
					<input type="hidden" id="pospel" name="pospel" class="form-control" value="<?php  
					echo $pospel;
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
				  <input type="text" id="PROJECT_NAME" name="PROJECT_NAME" class="form-control" value="<?php  
					foreach ($project as $row)
					{
							echo $row['G_NAME'];
					
					}
					?>">
				</div>      
			<fieldset class="row3">
				
				<table id="cost" data-toggle="table" data-url="<?php echo $url1;?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-show-footer="true" data-show-export="true" data-search="true" data-select-item-name="toolbar1" data-single-select="true" data-pagination="true" data-show-export="true"data-sort-name="name" data-sort-order="desc">
			   
				<thead>
			    <tr>
					
					<th data-field="ID"  data-sortable="true" data-visible="false">ID</th>
					<th data-field="ID_TR_COST_PLAN" data-sortable="false" data-visible="false" >ID TR COST</th>
					<th data-field="ID_PROJECT"  data-sortable="true" data-visible="false">Project ID</th>
					<th data-field="KEGIATAN"  data-sortable="false" data-footer-formatter="totalTextFormatter" >Kegiatan</th>
					<th data-field="ID_COA" data-sortable="false"  >COA</th>
			        <th data-field="JUMLAH"  data-sortable="false" >Jumlah</th>
					<th data-field="SATUAN_JUMLAH"  data-sortable="true">Satuan</th>
					<th data-field="DURASI"  data-sortable="true">Durasi</th>
					<th data-field="SATUAN_DURASI"  data-sortable="true">Satuan</th>
					<th data-field="UNIT_COST" data-align="right" data-sortable="true" data-formatter="nilaiFormatter">Unit Cost</th>
					<th data-field="TOTAL_COST"  data-align="right" data-sortable="true" data-formatter="nilaiFormatter" data-footer-formatter= "sumFormatter">TOTAL</th>
					<th data-field="action" data-formatter="actionFormatter"  data-events="actionEvents">Action</th>
					
			    </tr>
			    </thead>
				</table>
			
			</fieldset>
			<fieldset class="row2">
				<legend> Input Activity</legend>
				<p> 
					<input type="button" class="btn btn-success" value="Add Activity" onClick="addRow('dataTable')" /> 
					<input type="button" class="btn btn-success" value="Remove Activity" onClick="deleteRow('dataTable')"  /> 
					<p>(All actions apply only to entries with check marked check boxes only.)</p>
				</p>
				
               
               <table id="dataTable" class="form" border="0">
                  
				
				  <tbody>
                    <tr>
                      <p>
						
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
						
						<td>
							<label>Activity</label>
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
							<label>Total</label>
							<input type="text" class="form-control" required="required" name="JUMLAH[]">
						 </td>
						 
						<td>
							<label>Unit of Total</label>
							<select name="SATUAN_JUMLAH[]" class="form-control"  required="required">
									<!-- <option>--Pilih Satuan--</option> -->
									<option>PAKET</option>
									<option>BUKU</option>
								</select>
						</td>
						
						 <td>
							<label>Duration</label>
							<input type="text" class="form-control" required="required" class="small"  name="DURASI[]">
					     </td>
						<td>
							<label>Unit Of Duration</label>
							<select name="SATUAN_DURASI[]" class="form-control"  required="required">
									<!-- <option>--Pilih Satuan--</option> -->
									<option>BULAN</option>
									<option>SET</option>
									<option>TIME</option>
								</select>
						</td> 
						 <td>
							<label>Unit Cost</label>
							<input type="text" class="form-control" required="required" class="small"  name="UNIT_COST[]">
					     </td>
							</p>
                    </tr>
                    </tbody>
                </table>
				<div class="clear"></div>
            </fieldset>
			</br>
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

function nilaiFormatter (value, row, index) {
        
		return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");	  
		
    }
function sumFormatter(data) {
        field = this.field;
        var total_sum = data.reduce(function(sum, row) {
            return (sum) + (Number(row[field]) || 0);
        }, 0);
        return total_sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }	
 function totalTextFormatter(data) {
        return 'Total';
    }
function actionFormatter(value, row, index) {
    return [
       
        
		'&nbsp;&nbsp;&nbsp;<a class="edit ml10" href="javascript:void(0)" title="Edit">',
        '<i class="glyphicon glyphicon-pencil"></i>',
        '</a>&nbsp;&nbsp;&nbsp;',
		'<a class="delete" href="javascript:void(0)" title="delete">',
        '<i class="glyphicon glyphicon-remove"></i>',
        '</a>',
    ].join('');
}

window.actionEvents = {
   
    'click .edit': function (e, value, row, index) {
       //alert('You click edit icon, row: ' + JSON.stringify(row.ID));
       <?php $usrtype=$this->session->userdata( 'type_id' ); if($usrtype=='2'){ ?>
		window.location = "<?=_URL?>project/updateproject/"+row.ID;	
	   <?php } else { ?>
		   
		 window.location = "<?=_URL?>project/asdadsasd/";	  
	   <?php } ?>
	   
    },
	'click .delete': function (e, value, row, index) {
      
		swal({
		  title: "Are you sure?",
		  text: "Your will not be able to recover this imaginary file!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, delete it!",
		  closeOnConfirm: false
		},
		function(){
			$.ajax({
						type: "POST",
						url: "<?php echo ($action3); ?>",
						data: { 
							'username': username
						},
						success: function (data)
						{
							var data = eval('('+data+')');
							if (data.success){
								swal("Deleted!", "Your imaginary file has been deleted.", "success");
								location.reload();
							}
							else{
								//alert(data.msg);
							}
						}
					});
					return false;
					
		  
		});

    }
};

function hapus(){
			var $table = $('#user');
			var data = $table.bootstrapTable('getSelections');
			var username = $.map(data, function (item) {
				
				return item.username;
			});
			var r = confirm(" Delete this user :"+username);
			if (r == true) {
				$.ajax({
						type: "POST",
						url: "<?php echo ($action3); ?>",
						data: { 
							'username': username
						},
						success: function (data)
						{
							var data = eval('('+data+')');
							if (data.success){
								//alert(data.msg);
								location.reload();
							}
							else{
								//alert(data.msg);
							}
						}
					});
					return false;
			} else {
				
			}
		}
		

</script>

