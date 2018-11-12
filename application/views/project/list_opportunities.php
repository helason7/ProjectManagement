
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Opportunities List</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>project/addNewOpportunity" class="btn btn-light">Add New Opportunity</a>
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
          Opportunity List
        </div>
        <div class="panel-body table-responsive">

			<div id="toolbar">
				
				<a href="<?=_URL?>project/addNewOpportunity" class="btn btn-success">Add Opportunity</a>
				
				
			</div>

			<table id="opurtinity" data-toggle="table" data-url="<?php echo (base_url().'Project/viewOpurtinitydata'); ?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-toolbar="#toolbar" data-show-export="true" data-search="true" data-select-item-name="toolbar1" data-single-select="true" data-pagination="true" data-show-export="true"data-sort-name="name" data-sort-order="desc">
			    
				<thead>
			    <tr>
					
					<th data-field="ID"  data-sortable="true" data-visible="false">ID</th>
					<th data-field="PROJECT_NAME"  data-sortable="true" data-visible="true"  data-formatter="titleFormatter">Project Name</th>
					<th data-field="ID_PROJECT"  data-sortable="true" data-visible="true">Project ID</th>
					<th data-field="TARGET_START_DATE" data-sortable="false" >Start Project</th>
					<th data-field="TARGET_END_DATE"  data-sortable="false" >End Project</th>
			        <th data-field="TOTAL"  data-sortable="true">Amount</th>
					
					<th data-field="G_NAME" data-sortable="true">Cust Name</th>
					<th data-field="SALES_STAGE" data-sortable="true">Status</th>
					<th data-field="action" data-formatter="actionFormatter"  data-events="actionEvents">Action</th>
					
			    </tr>
			    </thead>
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




<script>
$(document).ready(function() {
    $('#example0').DataTable();
} );
function decFormatter(value){
           var nilai=parseInt(value)||0;
		   return parseInt(nilai).format(0, 3, '.', ',');	
			
        }


 function actionFormatter(value, row, index) {
    return [
       
        '<a class="upload" href="javascript:void(0)" title="upload">',
            '<i class="glyphicon glyphicon-file"></i>',
        '</a>&nbsp;&nbsp;&nbsp;',
        '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon-pencil"></i>',
        '</a>&nbsp;'
    ].join('');
}

window.actionEvents = {
   
    'click .edit': function (e, value, row, index) {
       //alert('You click edit icon, row: ' + JSON.stringify(row.ID));
    window.location = "<?=_URL?>project/updateproject/"+row.ID; 
  //      <?php $usrtype=$this->session->userdata( 'type_id' ); if($usrtype=='2'){ ?>
		// window.location = "<?=_URL?>project/updateproject/"+row.ID;	
	 //   <?php } else { ?>
		   
		//  window.location = "<?=_URL?>project/asdadsasd/";	  
	 //   <?php } ?>
	   
    },
	'click .upload': function (e, value, row, index) {
       //alert('You click edit icon, row: ' + JSON.stringify(row.ID));
        window.location = "<?=_URL?>project/uploaddoc/"+row.ID;	
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
   
   <?php $usrtype=$this->session->userdata( 'type_id' ); if($usrtype=='2'){ ?>
		 return "<a href=./ProjectAnalisys/"+ row.ID +">"+value+"</a>".supplant(row);
	   <?php } else { ?>
		   
		 return "<a href=./ProjectAnalisys/"+ row.ID +">"+value+"</a>".supplant(row);
	   <?php } ?>
	   
	   
}


</script>



