
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Add New Cost / Budget</li>
    </ol>

     <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <!-- <a href="<?=_URL?>Account_Pel/accpelList" class="btn btn-light">List Account</a> -->
        <a href="#" class="btn btn-light"><i class="fa fa-refresh"></i></a>
        <a href="#" class="btn btn-light"><i class="fa fa-search"></i></a>
      </div>
    </div>

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
          Setup New Cost / Budget
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
		
	
        <form action="<?php echo _URL;?>Cost_Header/doAddCostheader/" method="post">

             <input type="hidden" id="id" name="id" value="<?=$id;?>" class="form-control">

             <input type="hidden" id="idProject" name="idProject" value="<?php foreach($project as $as){ echo $as->ID_PROJECT; }?>" class="form-control">
                <div class="form-group"><label>Keterangan</label>
                   <input type="text" id="budget_name" name="budget_name" class="form-control">
                </div>

                <div class="form-group"><label>Account Pel</label>
                 <select name="accpel" class="form-control" id="accpel" >
                  <?php
                    foreach($accpels as $accpel)
                    {                               
                    ?>
                      <option value="<?=$accpel->ID_ACCOUNT_PEL?>"><?=$accpel->ACCOUNT_NAME?></option>
                           <?php } ?>   
                  </select>
                                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </div>

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

var index = 0;

function addType(){
            var table=document.getElementById("mitraTable");
            var row=table.insertRow(table.rows.length);
				row.id = index;
            var cell1=row.insertCell(0);
            var t1=document.createElement("input");
                t1.id = "order"+index;
				t1.style.cssText = "width:60px;";
				t1.name = "order[]";
                cell1.appendChild(t1);
            var cell2 = row.insertCell(1);
            var t2=document.createElement("input");
                t2.id = "type"+index;
				t2.placeholder = "Account Name";
				t2.name = "type[]";
                cell2.appendChild(t2);
			var cell3 = row.insertCell(2);
				cell3.style.width = '500px';
			var cell4 = row.insertCell(3);
            var t4 = document.createElement("button");
                t4.id = "addChild"+index;
				t4.className = "btn btn-info";
				t4.innerHTML  = "Add Account Component";
				t4.onclick = function(){
								addComp(row.id);return false;
							  };
                cell4.appendChild(t4);
				
			index++;
    }
	
function addComp(parent){
	
	$('#'+parent).after('<tr id="comp_"'+parent+'><td><input type="text" name="comp_order['+parent+'][]" style="width:60px;" ></td><td></td><td><input type="text" name="comp['+parent+'][]" placeholder="Component Name"></td><td></td></tr>');
	
    }
</script>



