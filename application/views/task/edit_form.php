
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
        <a href="<?=_URL?>Task/taskList" class="btn btn-light">List Task</a>
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
          User Form
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

       
        <?php
            foreach($tasks as $task)
               {          
            ?>              
      <form action="<?php echo _URL;?>Task/doEditTask/<?=$task->ID?>" method="post">       
               
                
                <div class="form-group"><label>Start Date</label>
                   <input type="text" id="start" name="start" class="form-control" value="<?=$task->START_TASK?>" readonly>
                </div>

              <div class="hr-line-dashed"></div>
                  <div class="form-group">
                  <label>TO DO List</label>
                    <select name="task" class="form-control" id="task" >
                        <option value="Make Bugs Report">Make Bugs Report</option> 
                        <option value="Fix Bugs">Fix Bugs</option> 
                        <option value="Create Invoices Project">Create Invoices Project</option>
                        <option value="Go-Live Project">Go-Live Project</option>    
                    </select>
                  </div>    
 
                <div class="form-group"><label>Account Manager</label>
                   <input type="text" id="am" name="am" class="form-control" value="<?=$task->B_NAME?>" readonly>
                </div>

                <div class="form-group"><label>Solution</label>
                   <input type="text" id="sol" name="sol" class="form-control" value="<?=$task->C_NAME?>" readonly>
                </div>
<!--
                <div class="hr-line-dashed"></div>
                  <div class="form-group">
                  <label>Account Manager</label>
                    <select name="am" class="form-control" id="am" >
                    // <?php
                    //   foreach($am as $people)
                    //   {                               
                    //   ?>
                    //     <option value="<?=$people->ID?>"><?=$people->NAME?></option>
                    //   <?php
                    //   }
                  
                    // ?>
 <!--                                 
                    </select>
                </div>         
-->
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

                <label>Status Progress</label>
                <div  class="form-group">
                  <input type="radio" class="form-group" name="status" value="0"> On going</br>
                  <input type="radio" class="form-group" name="status" value="1"> Complete
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </div>
        <?php
              }
           ?>
           
      </form>                     
        
        
	  <br/><br/><br/><Br/><br/>
        </div>

      </div>
    </div>
    <!-- End Panel -->

  </div>
  <!-- End Fifth Row -->

   
<script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("p").hide();
    });
    $("#show").click(function(){
        $("p").show();
    });
});
</script>