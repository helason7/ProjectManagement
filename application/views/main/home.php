
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Daftar Project dan Task List</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="index.html" class="btn btn-light">Dashboard</a>
        <a href="#" class="btn btn-light"><i class="fa fa-refresh"></i></a>
        <a href="#" class="btn btn-light"><i class="fa fa-search"></i></a>
        <a href="#" class="btn btn-light" id="topstats"><i class="fa fa-line-chart"></i></a>
      </div>
    </div>
    <!-- End Page Header Right Div -->

  </div>
  <!-- End Page Header -->


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-widget">

  <!-- Start Top Stats -->
	

	<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$CountOpp?></h3>

              <p>Opportunities</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?=_URL?>Project/presale" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$CountProject?></h3>

              <p>Project</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?=_URL?>Project/projectList" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$CountAct?></h3>

              <p>Task</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?=_URL?>Task/taskList/<?=$this->session->userdata('division_id');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$CountIssue?></h3>

              <p>Critical Issues</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        
    </div>

  <!-- Start Fourth Row -->
 


  <!-- Start Fifth Row -->
  <div class="row">


    <!-- Start Project Stats -->
    <div class="col-md-12 col-lg-12">
      <div class="panel panel-widget">
        <div class="panel-title">
          PROJECT DOCUMENT LIST 
          <ul class="panel-tools">
            <li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
            <li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
          </ul>
        </div>

        <div class="panel-body table-responsive">

          <table id="opurtinity" data-toggle="table" data-url="<?php echo $url1; ?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-toolbar="#toolbar" data-show-export="true" data-search="true" data-select-item-name="toolbar1" data-single-select="true" data-pagination="true" data-show-export="true"data-sort-name="name" data-sort-order="desc" >
			    
				<thead>
			    <tr>
					<th data-field="rownum" data-checkbox="true" >ID</th>
					<th data-field="ID"  data-sortable="true" data-visible="false">ID</th>
					
					<th data-field="ID_PROJECT"  data-sortable="true" data-visible="true">Project ID</th>
					<th data-field="RFI_DOC" data-formatter="colourFormatter" data-sortable="false" >RFI Document</th>
					<th data-field="RKS_DOC"  data-formatter="colourFormatter" data-sortable="false" >RKS Document</th>
			        <th data-field="BA_DOC"  data-formatter="colourFormatter" data-sortable="true">BA Document</th>
					<th data-field="SPK_DOC"  data-formatter="colourFormatter" data-sortable="false" >SPK Document</th>
			        <th data-field="CONTRACT_DOC"  data-formatter="colourFormatter" data-sortable="true">Contract Document</th>
					
					
					
			    </tr>
			    </thead>
			</table>

        </div>
      </div>
    </div>
   	

	<!---- --->
	
	
  
	
  </div>
  <!-- End Fifth Row -->
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
</script>



