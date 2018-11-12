
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
        <a href="<?=_URL?>Master_Divisi/listDivisi" class="btn btn-light">List Divisi</a>
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
            foreach($divisis as $divisi)
               {          
            ?>              
      <form action="<?php echo _URL;?>Master_Divisi/doEditDivisi/<?=$divisi->ID?>" method="post">       
                <div class="form-group"><label>Division Name</label>
                   <input type="text" id="name" name="name" class="form-control" value="<?=$divisi->NAME?>">
                </div>

                <div class="form-group"><label>Head Division</label>
                   <input type="text" class="form-control" value="<?=$divisi->DIVNAME?>" readonly>
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