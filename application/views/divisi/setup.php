
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">ILCS MANAGEMENT PORTAL - <?=$this->session->userdata('role');?></h1>
      <ol class="breadcrumb">
        <li class="active">Divisi Management -- Add New Divisi</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="<?=_URL?>Master_Divisi/divisiList" class="btn btn-light">List Divisi</a>
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
          New Divisi
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
      
      <form action="<?php echo _URL;?>Master_Divisi/doSetupDivisi" method="post">
        
                <div class="form-group"><label>Divisi Name</label>
                   <input type="text" id="name" name="name" class="form-control">
                </div>

                <div class="hr-line-dashed"></div>
                  <div class="form-group">
                  <label>Head Division</label>
                    <select name="headdiv" class="form-control" id="headdiv" >
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
    
    
        </div>

      </div>
    </div>
    <!-- End Panel -->

  </div>
  <!-- End Fifth Row -->


<script type="text/javascript">
$(document).ready(function() {
  $('#deadline').daterangepicker({ 
    singleDatePicker: true, 
    locale: {
          format: 'YYYY-MMM-DD'
        } 
  });
});
</script>



