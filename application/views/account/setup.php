
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Account Management -- Master Account</li>
    </ol>

     <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>Master_Account/accountList" class="btn btn-light">List Account</a>
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
          Setup Master Account
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
		
      <form action="<?php echo _URL;?>Master_Account/doSetupAccount" method="post">
        
                <div class="form-group"><label>Company Name</label>
                   <input type="text" id="name" name="name" class="form-control">
                </div>

                <div class="form-group"><label>Organization Name</label>
                   <textarea type="text" id="organ" name="organ" class="form-control">
                   </textarea>
                </div>

                <div class="form-group"><label>Company Email</label>
                   <input type="text" id="email" name="email" class="form-control">
                </div>

                <div class="form-group"><label>Company Address</label>
                   <textarea type="text" id="address" name="address" class="form-control">
                   </textarea>
                </div>

                <div class="form-group"><label>Person in Charge</label>
                   <input type="text" id="pic" name="pic" class="form-control">
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
            var table=document.getElementById("accountTable");
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



