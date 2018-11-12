
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Opportunities Management -- Add New Opportunities</li>
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

 

  <!-- Start Fourth Row -->
  <div class="row">

    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
          New Opportunity
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
			
			<form action="<?php echo _URL;?>project/doAddOpportunity1" method="post">
				
								<div class="form-group"><label>ID PROJECT</label>
                                <input type="text" id="ID_PROJECT" name="ID_PROJECT" class="form-control">
                                </div>
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label>Project Name</label>
								<input type="text" id="PROJECT_NAME" name="PROJECT_NAME" class="form-control">
                                </div>
                                

                                <div class="hr-line-dashed"></div>
								<div class="form-group">
								  <label>Project Type</label>
								   <select name="ID_PORTOFOLIO" class="form-control" id="ID_PORTOFOLIO" >
										<option value="1">Digital Support</option>
										<option value="2">SCM Service</option>
										<option value="3">Payment Service</option>
										<option value="4">System Implementator</option>
									</select>
								</div>  


								<div class="hr-line-dashed"></div>
                                
                                <div class="form-group"><label>Description</label>
									  <textarea class="form-control rounded-0"  rows="5" cols="15" id="DESKRIPSI" name="DESKRIPSI">
									  </textarea>
                                </div>
								<div class="hr-line-dashed"></div>
                                <div class="form-group">
								<label for="journal_publish">Amount Forecasted</label>
								<div class="input-prepend input-group">
								<span class="add-on input-group-addon">
											<select  name="currency" style="height:20px;" >
												<option value="USD">USD</option>
												<option value="RUPIAH">RUPIAH</option>
											</select> 
										</span>
											<input type="text"  id="AMOUNT" name="AMOUNT" class="form-control" value=""/> 
									</div>
								</div>

								<div class="hr-line-dashed"></div>
								<div class="form-group">
								<label for="journal_publish">Start Date</label>
								<input type="text" id="TARGET_START_DATE" name="TARGET_START_DATE" class="form-control" value=""/> 
								</div>

								<div class="hr-line-dashed"></div>
								<div class="form-group">
								<label for="journal_publish">End Date</label>
								<input type="text" id="TARGET_END_DATE" name="TARGET_END_DATE" class="form-control" value=""/> 
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label>Delivery Time</label>
                                <input type="text" id="deliverytime" name="deliverytime" class="form-control">
                                </div>


                                <div class="hr-line-dashed"></div>
								<div class="form-group">
								<label for="journal_publish">Customer Contract Number</label>
								<input type="text" id="NO_KONTRAK_CUSTOMER" name="NO_KONTRAK_CUSTOMER" class="form-control" value=""/> 
								</div>


                                <div class="hr-line-dashed"></div>
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
							
								<div class="hr-line-dashed"></div>
								
								<div class="form-group"><label>PIC Solution</label>
								 <select name="ID_SOLUTION" class="form-control" id="ID_SOLUTION" >
									<?php
										foreach($solution_pic as $solution_pic)
										{																
										?>
											<option value="<?=$solution_pic->ID?>"><?=$solution_pic->NAME?></option>
										<?php
										}
								
									?>
																
								  </select>
                                </div>
					
                               
								<div class="hr-line-dashed"></div>
								
								
								<div class="form-group">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    
                                </div>
				
				
			</form>
		
	  
        </div>

      </div>
    </div>
    <!-- End Panel -->

  </div>
  <!-- End Fifth Row -->


<script type="text/javascript">
$(document).ready(function() {
  $('#TARGET_START_DATE').daterangepicker({ 
		singleDatePicker: true, 
		locale: {
					format: 'YYYY-MMM-DD'
				} 
	});
	
	$('#TARGET_END_DATE').daterangepicker({ 
		singleDatePicker: true, 
		locale: {
					format: 'YYYY-MMM-DD'
				} 
	});
	
	$('#DESKRIPSI').summernote({
      height: 200,
      toolbar: [    
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],       
        ['insert',['picture']]
      ],

            callbacks: {
                    onImageUpload: function(files) {
                        uploadFile(files[0]);
                    }
                }

    });
	
	
});

function uploadFile(file) {
			 
            data = new FormData();
            data.append("file", file);

            $.ajax({
                data: data,
                type: "POST",
                url: "<?php echo _URL;?>project/saveGambar/", 
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {                                 
                                                      
                 $('#DESKRIPSI').summernote("insertImage", url);
                }
            });
        }
		
		
</script>



