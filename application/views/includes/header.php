<!DOCTYPE html>
<?php
error_reporting(E_ERROR);
?>

<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- ================================================
	jQuery Library
	================================================ -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

  <title>ILCS PROJECT MANAGER</title>

  <!-- ========== Css Files ========== -->

  <link href="<?php echo base_url(); ?>assets/themes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/themes/bootstrap/css/bootstrap-table.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/themes/bootstrap/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/js/summernote/summernote.css" rel="stylesheet"> 
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/_all-skins.min.css">

  <link href="<?php echo base_url(); ?>assets/css/root.css" rel="stylesheet">

  
  
   
  </head>
  <body>
  <!-- Start Page Loading -->
  <div class="loading"><img src="<?php echo base_url(); ?>assets/img/loading.gif" alt="loading-img"></div>
  <!-- End Page Loading -->
 <!-- //////////////////////////////////////////////////////////////////////////// -->
  <!-- START TOP -->
  <div id="top" class="clearfix">

    <!-- Start App Logo -->
    <div class="applogo">
      <a href="index.html" class="logo">ILCS</a>
    </div>
    <!-- End App Logo -->

    <!-- Start Sidebar Show Hide Button -->
    <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <!-- End Sidebar Show Hide Button -->


    <!-- Start Top Right -->
    <ul class="top-right">


    <li class="dropdown link">
      <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><img src="<?php echo base_url(); ?>assets/img/profileimg.png" alt="img"><b><?=$this->session->userdata('name');?></b><span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
          <li role="presentation" class="dropdown-header">Profile</li>
          <!--li><a href="#"><i class="fa falist fa-inbox"></i>Inbox<span class="badge label-danger">4</span></a></li>
          <li><a href="#"><i class="fa falist fa-file-o"></i>Files</a></li>
          <li class="divider"></li-->
          <!--?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>

        <!--?php endif; ?-->

        <li><a href="<?php echo _URL;?>login/logout"><i class="fa falist fa-power-off"></i> Logout</a></li>
        </ul>
    </li>

    </ul>
    <!-- End Top Right -->

  </div>
  <!-- END TOP -->
 <!-- //////////////////////////////////////////////////////////////////////////// -->


<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START SIDEBAR -->
<div class="sidebar clearfix">

<ul class="sidebar-panel nav">
  <li class="sidetitle">MENU</li>
  <li><a href="<?=_URL?>Main"><span class="icon color5"><i class="fa fa-bar-chart"></i></span>Dashboard</a></li>
  <?php
	if($this->session->userdata ( 'isAdmin' ) == true)
	{
  ?>
		  <li><a href="<?=_URL?>User"><span class="icon color6"><i class="fa fa-envelope-o"></i></span>User Management</a></li>

		  <li><a href="#"><span class="icon color14"><i class="fa fa-money"></i></span>Sales Solution<span class="caret"></span></a>
		  <ul>
			  <li><a href="<?=_URL?>Project/presale">List of Opportunity</a></li>
			  <li><a href="<?=_URL?>Budget/budgetList">Master Budget</a></li>
			  <!--
			  <li><a href="<?=_URL?>Project/activity">List of Activities</a></li>
			  <li><a href="<?=_URL?>Project/issue">List of Issues</a></li>
			  -->
		  </ul>
		  <li><a href="#"><span class="icon color14"><i class="fa fa-briefcase"></i></span>Marketing<span class="caret"></span></a>
			<ul>
			  <li><a href="<?=_URL?>Project/projectList">Project Lists</a></li>
			  <!--
			  <li><a href="<?=_URL?>Project/activity">List of Activities</a></li>
			  <li><a href="<?=_URL?>Project/issue">List of Issues</a></li>
			  -->
			</ul>
		  </li>
<?php
	}
?>
  
  <?php
	if($this->session->userdata ( 'type_id' ) == '2')
	{
  ?>
		  <li><a href="#"><span class="icon color14"><i class="fa fa-money"></i></span>Opportunities<span class="caret"></span></a>
		  <ul>
			 
				<li><a href="<?=_URL?>Project/presale">List of Opportunity</a></li>
				<li><a href="<?=_URL?>Project/projectList">Project Lists</a></li>
				
				
		  </ul>
  
  <?php
  
	}
  ?>
  <?php
	if($this->session->userdata ( 'type_id' ) == '9')
	{
  ?>
		  <li><a href="#"><span class="icon color14"><i class="fa fa-money"></i></span>Opportunities<span class="caret"></span></a>
		  <ul>
			 
				<li><a href="<?=_URL?>Project/presale">List of Opportunity</a></li>
				<li><a href="<?=_URL?>Project/projectList">Project Lists</a></li>
				
				
		  </ul>
  
  <?php
  
	}
  ?>
  
  <li><a href="#"><span class="icon color14"><i class="fa fa-lightbulb-o"></i></span>Resource<span class="caret"></span></a>
    <ul> 
    <li><a href="">Resource Management</a></li>
    </ul>
</li>

<li><a href="#"><span class="icon color14"><i class="fa fa-bank"></i></span>Budgeting<span class="caret"></span></a>
    <ul>
      <li><a href="<?=_URL?>Finance/posAnggaran">Budget Allocation List</a></li>
	  <li><a href="<?=_URL?>Budget/budgetList">Master Budget</a></li>
    </ul>
	
  </li>

  <li><a href="#"><span class="icon color14"><i class="fa fa-list"></i></span>Master<span class="caret"></span></a>
    <ul>
    <li><a href="<?=_URL?>Master_Divisi/divisiList">Divisi</a></li>
    <li><a href="<?=_URL?>Master_Account/accountList">Account</a></li>
    <li><a href="<?=_URL?>Master_Salesstage/salesstageList">Sales Stage</a></li>
    <li><a href="<?=_URL?>Master_Specialization/specializationList">Specialization</a></li>
    <li><a href="<?=_URL?>Master_Usertype/usertypeList">User Type</a></li>
    <li><a href="<?=_URL?>User/index">User</a></li>
	<li><a href="<?=_URL?>Master_Mitra/mitraList">Mitra</a></li>
  <li><a href="<?=_URL?>Account_Pel/accpelList">Account Pel</a></li>
</ul>
  
  </li>


</ul>

</div>

</div>
<!-- END SIDEBAR -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
