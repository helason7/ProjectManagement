
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Task Management</li>
    </ol>

     <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>Task/mitraList" class="btn btn-light">List Task</a>
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
	
        <form action="<?php echo _URL;?>Task/doAddTask/" method="post">
		<!-- 
                <div class="form-group"><label>MANAGER</label>
                   <input type="text" id="idm" name="idm" class="form-control">
                </div> -->

              <div class="hr-line-dashed"></div>
                  <div class="form-group">
                  <label>TO DO LIST</label>
                    <select name="todo" class="form-control" id="todo" >
                    <?php
                      foreach($todo as $people)
                      {                               
                      ?>
                        <option value="<?=$people->ID_TASK?>"><?=$people->TODO_LIST?></option>
                      <?php
                      }
                  
                    ?>
                                  
                    </select>
                  </div>

              <div class="hr-line-dashed"></div>
                  <div class="form-group">
                  <label>Project</label>
                    <select name="project" class="form-control" id="project" >
                    <?php
                      foreach($project as $people)
                      {                               
                      ?>
                        <option value="<?=$people->ID?>"><?=$people->NAME?></option>
                      <?php
                      }
                  
                    ?>
                                  
                    </select>
                  </div>       
<!-- 
                <div class="hr-line-dashed"></div>
                  <div class="form-group">
                  <label>Account Manager</label>
                    <select name="am" class="form-control" id="am" >
                    <?php
                      foreach($am as $people)
                      {                               
                      ?>
                        <option value="<?=$people->ID?>"><?=$people->NAME?></option>
                      <?php
                      }
                  
                    ?>
                                  
                    </select>
                </div>         

                <div class="hr-line-dashed"></div>
                  <div class="form-group">
                  <label>Solution</label>
                    <select name="sol" class="form-control" id="sol" >
                    <?php
                      foreach($sol as $people)
                      {                               
                      ?>
                        <option value="<?=$people->ID?>"><?=$people->NAME?></option>
                      <?php
                      }
                  
                    ?>
                                  
                    </select>
                </div>  
 -->

              <div class="hr-line-dashed"></div>
                <label>Status Progress</label>
                <div  class="form-group">
                  <input type="radio" class="form-group" name="status" value="0"> On going</br>
                  <input type="radio" class="form-group" name="status" value="1"> Complete
                </div>
<!-- 
                <div class="form-group"><label>Status</label>
                   <input type="text" id="status" name="status" class="form-control">
                </div> -->

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
				t2.placeholder = "Task Name";
				t2.name = "type[]";
                cell2.appendChild(t2);
			var cell3 = row.insertCell(2);
				cell3.style.width = '500px';
			var cell4 = row.insertCell(3);
            var t4 = document.createElement("button");
                t4.id = "addChild"+index;
				t4.className = "btn btn-info";
				t4.innerHTML  = "Add Task Component";
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



