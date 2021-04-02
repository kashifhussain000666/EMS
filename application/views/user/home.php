<?php
$this->load->view('includes/header.php'); // load the header HTML 
?>
<link rel="stylesheet" href="<?php echo base_url().'assets/css/bower_components/jvectormap/jquery-jvectormap.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/AdminLTE.min.css' ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/skins/_all-skins.min.css' ?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php
  $this->load->view('includes/headbar'); // load the headbar HTML
  ?>

  <?php
  $this->load->view('includes/sidebar'); // load the  sidebar HTML
  ?>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small><?php echo $this->session->userdata('user_type_name');?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <button style="display:none;" id="modal-default_userguide" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                Launch Default Modal
              </button>
      <!-- Info boxes -->
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Reports</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

      </div>
      <!-- /.row -->

     <div class="row">
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3></h3>

              <p>Total Approved Reports</p>
            </div>
            <div class="icon">
              <i class="ion  ion-bag "></i>
            </div>
            <a  href="javascript:void(0)" onclick="funcviewAppointmentDetail(appintmentstate='14', IsToday='1')" class="small-box-footer">View detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
      </div>
      <!-- /.row -->

       <div class="row">
    
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3></h3>

              <p>View All Reports</p>
            </div>
            <div class="icon">
              <i class="ion  ion-bag "></i>
            </div>
            <a  href="<?php echo base_url().'doctor/griddoctor';?>" class="small-box-footer">Click here to view all Reports <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
       
      </div>
    </section>
    <!-- /.content -->
   </div>


</div>
<!-- ./wrapper -->
<?php
$this->load->view('includes/footer'); // load the footer HTML
?>
<script src="<?php echo base_url().'assets/js/bower_components/chart.js/Chart.js'?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url().'assets/js/dist/js/pages/dashboard2.js'?>"></script>
<script src="<?php echo base_url().'assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'?>"></script>
<script src="<?php echo base_url().'assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'?>"></script>
<script type="text/javascript">
      function funcviewAppointmentDetail(Appointmentstatus,IsToday)
      {
        if(IsToday == 0)
        {
          $("#hdn_appointment_date_from").val("");
          $("#hdn_appointment_date_to").val("");
        }
        
        $("#hdn_sel_status").val(Appointmentstatus);
        //var form = "#hdn_get_view_detail";
        $("#hdn_get_view_detail").submit();
      }
</script>

<form method="post" action="<?php echo base_url().'Patients/ViewAppointment'?>" target="_blank" id="hdn_get_view_detail">
    <input type="hidden" name="appointment_date_from" id="hdn_appointment_date_from" value="<?php echo date('m/d/Y'); ?>">
    <input type="hidden" name="appointment_date_to" id="hdn_appointment_date_to" value="<?php echo date('m/d/Y'); ?>">
    <input type="hidden" name="sel_status" id="hdn_sel_status" value="">
    <input type="hidden" name="btn_search" id="btn_search" value="">
</form>
