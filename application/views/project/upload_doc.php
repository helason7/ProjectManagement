
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Uploaded Project Document</li>
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
		 
			<table id="opurtinity" data-toggle="table" data-url="<?php foreach ($project as $row)
									{
											echo (base_url().'Project/viewprojectDocument/'.$row['ID_PROJECT']);
									} ?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-toolbar="#toolbar" data-show-export="true" data-search="true" data-select-item-name="toolbar1" data-single-select="true" data-pagination="true" data-show-export="true"data-sort-name="name" data-sort-order="desc" >
			    
				<thead>
			    <tr>
					<th data-field="rownum" data-checkbox="true" >ID</th>
					<th data-field="ID"  data-sortable="true" data-visible="false">ID</th>
					
					<th data-field="ID_PROJECT"  data-sortable="true" data-visible="true">Project ID</th>
					<th data-field="RFI_DOC" data-formatter="colourFormatter" data-sortable="false" >RFI Document</th>
					<th data-field="RKS_DOC"  data-formatter="colourFormatter" data-sortable="false" >RKS Document</th>
			        <th data-field="BA_NEGO_DOC"  data-formatter="colourFormatter" data-sortable="true">BA Document</th>
					<th data-field="SPK_DOC"  data-formatter="colourFormatter" data-sortable="false" >SPK Document</th>
			        <th data-field="KONTRAK_DOC"  data-formatter="colourFormatter" data-sortable="true">Contract Document</th>
					
					
					
			    </tr>
			    </thead>
			</table>
			<div class="hr-line-dashed"></div>			
			  
		
        </div>

      </div>
    </div>
    <!-- End Panel -->
	<div class="col-md-3">
		<div class="panel-body table-responsive">
			<!-- Horizontal Form -->
          <div class="panel panel-info">
            <div class="box-header with-border">
              <h3 class="box-title"> Add New Document</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			
            <form action="<?php echo $url;?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
				
				<div class="form-group"><label>ID PROJECT</label>
                    <input type="text" id="ID_PROJECT" name="ID_PROJECT" class="form-control" value="<?php  
					foreach ($project as $row)
					{
							echo $row['ID_PROJECT'];
					
					}
					?>"  readonly>
					<input type="hidden" class="form-control" id="ID" name="ID" value="<?php  
					foreach ($project as $row)
					{
							echo $row['ID'];
					
					}
					?>">
                </div>
				<div class="form-group"><label>Document Type</label>
					<select name="DOC_TYPE" class="form-control" id="DOC_TYPE" >
						<option value="1">RFI</option>
						<option value="2">RKS</option>
						<option value="3">BA NEGO</option>
						<option value="4">SPK</option>
						<option value="5">KONTRAK</option>							
					</select>
                </div>
			
                <div class="hr-line-dashed"></div>
				<div class="form-group">
				<label for="TITLE_DOC">TITLE DOC</label>
				<input type="text" id="TITLE_DOC" name="TITLE_DOC" class="form-control"> 
				</div>

				<div class="hr-line-dashed"></div>
				
				<div class="form-group">
					<label>Document File</label>
					<input type="file" id="file" name="file" class="form-control"> 
							   
				</div>
				
					
                               
				<div class="hr-line-dashed"></div>
								
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save</button>
                                
                </div>
				
				
			</form>  
			
			
          </div>
		</div>
  
	</div>
	
	<div class="col-md-9">
		<div class="panel-body table-responsive">
			<!-- Horizontal Form -->
          <div class="panel panel-default">
            <div class="box-header with-border">
              <h3 class="box-title"> List Document </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			
            <table id="opu" data-toggle="table" data-url="<?php foreach ($project as $row)
									{
											echo (base_url().'Project/viewdetailprojectDocument/'.$row['ID_PROJECT']);
									} ?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-toolbar="#toolbar" data-show-export="true" data-search="true" data-select-item-name="toolbar1" data-single-select="true" data-pagination="true" data-show-export="true"data-sort-name="name" data-sort-order="desc" >
			    
				<thead>
			    <tr>
					<th data-field="RNUM"  data-sortable="true" data-visible="false">ID</th>
					<th data-field="ID"  data-sortable="true" data-visible="false" >ID</th>
					<th data-field="ID_PROJECT"  data-sortable="true" data-visible="false" >ID_PROJECT</th>
					<th data-field="DOC_DESCRIPTION" data-sortable="true" data-visible="true">Type</th>
					<th data-field="TITLE_DOC" data-sortable="true" data-visible="true">Title</th>
					<th data-field="DOC_NAME"  data-sortable="true" data-visible="true" data-formatter="linkformarter" >Name</th>
					
					<th data-field="NAME" data-sortable="true" data-visible="true">Uploader</th>
					<th data-field="UPLOADED_DATE" data-sortable="true" data-visible="true">Upload Date</th>
					
					
			    </tr>
			    </thead>
			</table>
			
			
          </div>
		</div>
  
	</div>
	
  </div>
  
  
  </div>
  </div>


  
<!-- ================================================
Data Tables
================================================ -->
<script src="<?php echo base_url(); ?>assets/js/datatables/datatables.min.js"></script>



<script>

		
 function colourFormatter(value) {
       if (value < 1) {
			var color = 'red';
			return '<div  style="color: ' + color + '"> ' + value + '</div>';;
	   }
	   else{
		   return value;
	   }
    }
function upload(){
	
	swal("Oops...", "no data selected!", "error");
}

String.prototype.supplant = function (o) {
  return this.replace(/{([^{}]*)}/g,
    function (a, b) {
      var r = o[b];
      return typeof r === 'string' || typeof r === 'number' ? r : a;
    }
  );
};

function linkformarter(value, row, index) {
	    	 //return '<button id ="'+ value +'" type="button" class="btn btn-link">'+value+'</button>';  
   // return "<a href=./updateproject/"+ row.ID +">"+value+"</a>".supplant(row);
   
		
		return "<a href= /apps_xx/docs/projects/"+ row.DOC_NAME +">"+value+"</a>".supplant(row);
	   
	   
}
</script>

