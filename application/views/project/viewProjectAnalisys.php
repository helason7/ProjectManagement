
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
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-title">
          <?=$opportunity->NAME?>
        </div>
        <div class="panel-body table-responsive">
<!-- 
		<?php $error = $this->session->flashdata('error');
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
		 -->
		
		<style> 
		.table>tbody>tr>td {
		  padding: 5px;
		  line-height: 1.7
		}
		</style>
		
			<form action="<?php echo $url;?>" method="post" >

								<div class="form-group"><label>ID PROJECTS</label>
                                <input type="text" id="ID_PROJECT" name="ID_PROJECT" class="form-control" value="<?php  
									foreach ($project as $row)
									{
											echo $row['ID_PROJECT'];
									
									}
									?>">
									
                                </div>
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label>Project Name</label>
								<input type="text" id="PROJECT_NAME" name="PROJECT_NAME" class="form-control" value="<?php  
									foreach ($project as $row)
									{
											echo $row['PROJECT_NAME'];
									
									}
									?>">
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
									  <?php foreach ($project as $row){echo $row['DESKRIPSI'];}?>
									  </textarea> 
                                </div>
								<div class="hr-line-dashed"></div>
                                <div class="form-group">
								<label for="journal_publish">Amount Forecasted</label>
								<div class="input-prepend input-group">
								<span class="add-on input-group-addon">
											<select  id="currency"  name="currency" style="height:20px;" >
												<option value="USD">USD</option>
												<option value="RUPIAH">RUPIAH</option>
											</select> 
										</span>
											<input type="text"  id="AMOUNT" name="AMOUNT" class="form-control" value=" <?php foreach ($project as $row){echo $row['AMOUNT'];}?>"> 
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group">
								<label for="journal_publish">Start Date</label>
								<input type="text" id="TARGET_START_DATE" name="TARGET_START_DATE" class="form-control" value=" <?php foreach ($project as $row){echo $row['TARGET_START_DATE'];}?>"> 
								</div>

								<div class="hr-line-dashed"></div>
								<div class="form-group">
								<label for="journal_publish">End Date</label>
								<input type="text" id="TARGET_END_DATE" name="TARGET_END_DATE" class="form-control" value="<?php foreach ($project as $row){echo $row['TARGET_END_DATE'];}?>"> 
								</div>

								<div class="form-group"><label>Delivery Time</label>
                                <input type="text" id="deliverytime" name="deliverytime" class="form-control" value="<?php foreach ($project as $row){echo $row['DELIVERY_TIME'];}?>">
                                </div>


                                <div class="hr-line-dashed"></div>
								<div class="form-group">
								<label for="journal_publish">Customer Contract Number</label>
								<input type="text" id="NO_KONTRAK_CUSTOMER" name="NO_KONTRAK_CUSTOMER" class="form-control" value="<?php foreach ($project as $row){echo $row['NO_KONTRAK_CUSTOMER'];}?>"> 
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
			</form>   
			
        </div>

      </div> 
    </div>

	 <div class="col-md-6">
      <div class="panel panel-default">
         
            <div class="box-header with-border">
              <h3 class="box-title"> PROPOSE BUDGET BASE </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			
            
         
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
<!-- 		
			<div id="toolbar">
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Budget</a>
			</div>
 -->
			<table id="opurtinity" data-toggle="table" data-url="<?php 
			foreach ($project as $row)
									{
											// echo $url1.$id;
											echo $url2.$row['ID_PROJECT'];

									
									}
			?>"  data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-toolbar="#toolbar" data-show-export="false" data-search="false" data-select-item-name="toolbar1" data-single-select="true" data-pagination="true" data-sort-name="name" data-sort-order="desc">
			<thead>
			    <tr>
					<!-- 
					<th data-field="ID"  data-sortable="true" data-visible="false">ID</th>
					<th data-field="ID_PROJECT"  data-sortable="true" data-visible="true" >Project id</th>
					<th data-field="ID_ACCOUNT_PEL"  data-sortable="true" data-visible="false" >ID_ACCOUNT_PEL</th>
					<th data-field="ACCOUNT_NAME" data-formatter="titleFormatter" data-sortable="true" data-visible="false">Account Name</th>
					
					
			        <th data-field="TOTAL_COST"  data-sortable="true" data-align="right">Proposed Amount</th>
					
					<th data-field="action" data-formatter="actionFormatter"  data-events="actionEvents">Action</th>
					 -->
<!-- 
					<th data-field="ID_COSTHEAD"  data-sortable="true" data-visible="false">ID</th>
					<th data-field="ID_PROJECT"  data-sortable="true" data-visible="true" >Project id</th>
					
 --> 					<th data-field="ACCOUNT_NAME"  data-formatter="titleFormatter" data-sortable="true" data-visible="true" >Account Name</th>
					<th data-field="BUDGET_NAME"  data-sortable="true" data-visible="true">Budget Name</th>
					
					
			        <th data-field="TOTAL_COST"  data-sortable="true" data-align="right">Proposed Amount</th>

			    </tr>
			    </thead>
			    <tbody></tbody>
			</table>  
			
        </div>

        <div id="toolbar"><!-- 
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal">Proposed</a>
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal">Approved</a> -->
				<a href="<?=_URL?>Cost_Header/addNewcostheader/<?=$id?>" class="btn btn-success" >Add Budget</a>
				<a href="<?=_URL?>Cost_Header/approvedCostHeader/<?=$id?>/
					<?php foreach ($project as $row)
											{
													echo $row['ID_PROJECT'];
											}
					?>" class="btn btn-success" >Approve</a>
				<!-- <a href="<?=_URL?>budget/setup_budget" class="btn btn-light">Add Budget</a> -->

			</div>
      </div> 
    </div>
	
	 <div class="col-md-6">
      <div class="panel panel-default">
         
            <div class="box-header with-border">
              <h3 class="box-title"> APPROVAL BUDGET BASE </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			
            
         
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
<!-- 		
			<div id="toolbar">
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Budget</a>
			</div>
 -->
			<table id="opurtinity" data-toggle="table" data-url="<?php 
			foreach ($project as $row)
									{
											// echo $url1.$id;
											echo $url3.$row['ID_PROJECT'];

									
									}
			?>"  data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-show-export="false" data-search="false" data-single-select="true" data-pagination="true" data-sort-name="name" data-sort-order="desc">
			<thead>
			    <tr>
					<!-- 
					<th data-field="ID"  data-sortable="true" data-visible="false">ID</th>
					<th data-field="ID_PROJECT"  data-sortable="true" data-visible="true" >Project id</th>
					<th data-field="ID_ACCOUNT_PEL"  data-sortable="true" data-visible="false" >ID_ACCOUNT_PEL</th>
					<th data-field="ACCOUNT_NAME" data-formatter="titleFormatter" data-sortable="true" data-visible="false">Account Name</th>
					
					
			        <th data-field="TOTAL_COST"  data-sortable="true" data-align="right">Proposed Amount</th>
					
					<th data-field="action" data-formatter="actionFormatter"  data-events="actionEvents">Action</th>
					 -->
<!-- 
					<th data-field="ID_COSTHEAD"  data-sortable="true" data-visible="false">ID</th>
					<th data-field="ID_PROJECT"  data-sortable="true" data-visible="true" >Project id</th>
					
 --> 					<th data-field="ACCOUNT_NAME"  data-formatter="titleFormatter" data-sortable="true" data-visible="true" >Account Name</th>
					<th data-field="BUDGET_NAME"  data-sortable="true" data-visible="true">Budget Name</th>
					
					
			        <th data-field="TOTAL_COST"  data-sortable="true" data-align="right">Proposed Amount</th>

			    </tr>
			    </thead>
			    <tbody></tbody>
			</table>  
			
        </div>
<!-- 
        <div id="toolbar">
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal">Proposed</a>
				<a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal">Approved</a>
				<a href="<?=_URL?>Cost_Header/addNewcostheader/<?=$id?>" class="btn btn-success" >Add Budget</a>
				<a href="<?=_URL?>Cost_Header/approvedCostHeader/<?=$id?>/
					<?php foreach ($project as $row)
											{
													echo $row['ID_PROJECT'];
											}
					?>" class="btn btn-success" >Approve</a>
				<!-- <a href="<?=_URL?>budget/setup_budget" class="btn btn-light">Add Budget</a> 
			</div>
      </div> -->

    </div>
	
    <!-- End Panel -->
    <!-- 
	<div class="col-md-6">
		<div class="box box-success">
            <div class="box-header">
              <i class="fa fa-comments-o"></i>

              <h3 class="box-title">Project Information Chat</h3>

              <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                <div class="btn-group" data-toggle="btn-toggle">
                  <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                </div>
              </div>
            </div>
            <div class="box-body chat" id="chat-box">
				<?php foreach ($comment as $row){ ?>
					 <div class="item">
						<img src="<?php echo base_url(); ?>assets/img/profileimg.png" alt="user image" class="online">

						<p class="message">
						  <a href="#" class="name">
							<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo $row['ENTRY_DATE'];?></small>
							<?php echo $row['NAME'];?>
						  </a>
						  <?php echo $row['KOMENTAR'];?>
						</p>
						
						
					  </div>
				 <?php } ?>
            </div>
            <div class="box-footer">
              
                <div class="form-group"><label>Comment Journal</label>

                           <textarea class="form-control rounded-0"  rows="5" cols="10" id="editordata" name="editordata">
                           </textarea>
                </div>

                <div class="form-group">
                           <button class="btn btn-color" type="submit">Send</button>
                        
				</div>
				
            </div>
			
        </div>
  
	</div>
  </div>
 -->
<!-- Budget Modal -->
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>

	        <div class="container">
			  <h2>Form control: checkbox</h2>
			  <p>The form below contains three checkboxes. The last option is disabled:</p>
			  <form class="form-inline" action="" method="POST">
				<?php echo 'asdsad' ?>
				<?php foreach ($accpels as $row){ ?>
					<div class="row">
						<div class="form-group">
								<input type="checkbox" name="" checked="checked">
					  			<label><?=$row->ACCOUNT_NAME?>
					  			<?php echo $row['ACCOUNT_NAME'];?>
					  			</label>
					    </div>
				    </div>
				<?php } ?>

		          
			  </form>
			</div>
			<div class="container" style="margin: 40px auto 20px auto;" >
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>

      </div>
      
    </div>
  </div>
<!-- end of budget modal -->
  
<!-- ================================================
Data Tables
================================================ -->
<script src="<?php echo base_url(); ?>assets/js/datatables/datatables.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/script.js"></script>


<script>
$(document).ready(function() {
    
	$('#ID_CUSTOMER').val('<?php  foreach ($project as $row){ echo $row['ID_CUSTOMER'];}?>');
	

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
	$('#editordata').summernote({
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

 function actionFormatter(value, row, index) {
    return [
       
        '<a class="add" href="javascript:void(0)" title="add">',
        '<i class="glyphicon glyphicon-plus"></i>',
        '</a>&nbsp;&nbsp;&nbsp;',
		'<a class="edit ml10" href="javascript:void(0)" title="Edit">',
        '<i class="glyphicon glyphicon-pencil"></i>',
        '</a>'
    ].join('');
}

window.actionEvents = {
   
    'click .edit': function (e, value, row, index) {
       //alert('You click edit icon, row: ' + JSON.stringify(row.ID));
       
		 window.location = "<?=_URL?>project/asdadsasd/";	  
	   
	   
    },
	'click .add': function (e, value, row, index) {
		var id=<?php echo $id; ?>;
       //alert('You click edit icon, row: ' + JSON.stringify(row.ID));
       // window.location = "<?=_URL?>project/budget/"+id;	
	    window.location = "<?=_URL?>project/budget1/"+ row.ID_ACCOUNT_PEL +"/"+row.ID_PROJECT ;	
    }
};



String.prototype.supplant = function (o) {
  return this.replace(/{([^{}]*)}/g,
    function (a, b) {
      var r = o[b];
      return typeof r === 'string' || typeof r === 'number' ? r : a;
    }
  );
};

	
function titleFormatter(value, row, index) {
	    	 //return '<button id ="'+ value +'" type="button" class="btn btn-link">'+value+'</button>';  
   // return "<a href=./updateproject/"+ row.ID +">"+value+"</a>".supplant(row);
   
  
		 return "<a href=../budget1/"+row.ID_COSTHEAD+"/"+row.ACC_PEL +"/"+row.ID_PROJECT +">"+value+"</a>".supplant(row);
		 // return "<a href=../budget1/"+row.ACC_PEL +"/"+row.ID_PROJECT +">"+value+"</a>".supplant(row);
	  
	   
}

</script>

