
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">User Type Management -- Master UserType</li>
    </ol>

     <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>Master_Usertype/usertypeList" class="btn btn-light">List User Type</a>
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
          Setup Master User Type
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

        <form action="<?php echo _URL;?>Master_Usertype/doSetupUserType" method="post">
		 
                <div class="form-group"><label>Usertype Name</label>
                   <input type="text" id="name" name="name" class="form-control">
                </div>

                <label>Is Admin?</label>
                <div  class="form-group">
                  <input type="radio" class="form-group" name="isAdmin" value="1"> Yes</br>
                  <input type="radio" class="form-group" name="isAdmin" value="0"> No
                </div>

                <div class="hr-line-dashed"></div>
                  <div class="form-group">
                  <label>Division</label>
                    <select name="divisionId" class="form-control" id="divisionId" >
                    <?php
                      foreach($divs as $div)
                      {                               
                      ?>
                        <option value="<?=$div->ID?>"><?=$div->NAME?></option>
                      <?php
                      }
                  
                    ?>
                                  
                    </select>
                </div>        
                
                <div class="hr-line-dashed"></div>
                  <div class="form-group">
                  <label>Sub-Division</label>
                    <select name="subdivisionId" class="form-control" id="subdivisionId" >
                    <?php
                      foreach($divs as $div)
                      {                               
                      ?>
                        <option value="<?=$div->ID?>"><?=$div->NAME?></option>
                      <?php
                      }
                  
                    ?>
                                  
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
            var table=document.getElementById("usertypeTable");
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
				t2.placeholder = "UserType Name";
				t2.name = "type[]";
                cell2.appendChild(t2);
			var cell3 = row.insertCell(2);
				cell3.style.width = '500px';
			var cell4 = row.insertCell(3);
            var t4 = document.createElement("button");
                t4.id = "addChild"+index;
				t4.className = "btn btn-info";
				t4.innerHTML  = "Add UserType Component";
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



