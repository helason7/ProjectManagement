﻿
 <!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">User Management</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>Master_Usertype/listUsertype" class="btn btn-light">List Usertype</a>
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
            foreach($users as $usertype)
               {          
            ?>              
      <form action="<?php echo _URL;?>Master_Usertype/doEditUsertype/<?=$usertype->ID?>" method="post">     

                <div class="form-group"><label>Usertype Name</label>
                   <input type="text" id="name" name="name" class="form-control" value="<?=$usertype->NAME?>">
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
                    
        <?php
              }
           ?>
              
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