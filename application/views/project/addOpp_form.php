
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
			
			<form action="<?php echo _URL;?>project/doAddOpportunity" method="post">
				
								<div class="form-group"><label>ID PROJECT</label>
                                <input type="text" id="name" name="name" class="form-control">
                                </div>
								<div class="form-group"><label>Project Name</label>
								<input type="text" id="name" name="name" class="form-control">
                                </div>
                                

                                <div class="hr-line-dashed"></div>
								<div class="form-group">
								  <label>Project Type</label>
								   <select name="prob" class="form-control" id="prob" >
										<option value="DS">Digital Support</option>
										<option value="DAPAT DIPERJUANGKAN">SCM Service</option>
										<option value="HAMPIR PASTI ">Payment Service</option>
										<option value="DEFINITE">System Implementator</option>
									</select>
								</div>  


								<div class="hr-line-dashed"></div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label>Description</label>
									  <textarea class="form-control rounded-0"  rows="5" cols="15" id="desc" name="desc">
									  </textarea>
                                </div>
                                <div class="form-group">
								<label for="journal_publish">Amount Forecasted</label>
								<div class="input-prepend input-group">
								<span class="add-on input-group-addon">
											<select  name="currency" style="height:20px;" >
												<option value="USD">USD</option>
												<option value="RUPIAH">RUPIAH</option>
											</select> 
										</span>
											<input type="text"  name="amount" class="form-control" value=""/> 
									</div>
								</div>

								<div class="hr-line-dashed"></div>
								<div class="form-group">
								<label for="journal_publish">Start Date</label>
								<input type="text" id="deadline" name="deadline" class="form-control" value=""/> 
								</div>

								<div class="hr-line-dashed"></div>
								<div class="form-group">
								<label for="journal_publish">End Date</label>
								<input type="text" id="deadline" name="deadline" class="form-control" value=""/> 
								</div>

								<div class="form-group"><label>Delivery Time</label>
                                <input type="text" id="name" name="name" class="form-control">
                                </div>


                                <div class="hr-line-dashed"></div>
								<div class="form-group">
								<label for="journal_publish">Contract Date</label>
								<input type="text" id="deadline" name="deadline" class="form-control" value=""/> 
								</div>

                                <div class="form-group"><label>AM</label>
                                <input type="text" id="name" name="name" class="form-control">
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
								  <label>Account</label>
								  <select name="account" class="form-control" id="account" >
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
								
								<div class="form-group"><label>Solution</label>
                                <input type="text" id="name" name="name" class="form-control">
                                </div>
					
                               
								<div class="hr-line-dashed"></div>
								<div class="form-group">
								<label for="journal_publish">Entry Date</label>
								<input type="text" id="deadline" name="deadline" class="form-control" value=""/> 
								</div>
								
								<div class="form-group">
                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                    
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
  $('#deadline').daterangepicker({ 
		singleDatePicker: true, 
		locale: {
					format: 'YYYY-MMM-DD'
				} 
	});
});
</script>



