<?php
$this->load->view('includes/header.php'); // load the header HTML 
?>
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/select2/dist/css/select2.min.css';?>">

<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css';?>">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';?>"> 
<link rel="stylesheet" href="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.css';?>">
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
        Employees 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Employees</a></li>
        <li class="active"> ViewEmployees</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View All Employees</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <form action="" method="post" id="form_search_dotor">
              <div class="row">
                <!--<div class="col-sm-6">
                  <div class="dataTables_length" id="example1_length">
                    <label>
                      Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries
                    </label>
                  </div>
                </div>-->
                <div class="col-sm-12">
                  <!--<div id="example1_filter" class="dataTables_filter" style="float:left;margin-right: 10px;">
                    <label>
                      <input style="height: 33px;" type="search" name="txt_name" id="txt_name" class="form-control input-sm" placeholder="Enter Name" aria-controls="example1">
                    </label>
                  </div>-->
                  <!-- time Picker
                <div class="bootstrap-timepicker">
                  <div class="form-group"> -->
                  <!-- Div Date Range picker --> 

                  <?php
                    $sel_Employee = $this->input->post('sel_Employee');
                  ?>
                  <div class="" style="width:15%;float: left;margin-right: 10px;">
                    <select class="form-control select2" name="sel_Employee" id="sel_Employee" style="">
                      <option value="0">All Employees</option>
                      <?php 
                      foreach($AllEmployees as $AllEmployee)
                      {

                      ?>
                        <option value="<?=$AllEmployee['user_id'] ?>" <?php if($sel_Employee == $AllEmployee['user_id']){ echo "selected" ;} ?>><?php echo $AllEmployee['user_name']; ?></option>
                      <?php 
                      }
                      ?>
                    </select>
                  </div>
                  <button type="submit" style="height:33px;" name="btn_search" class="btn btn-sm btn-info btn-flat pull-left">Search</button>
                  <a href="<?php echo base_url().'Employee/AddEditEmployee/';?>" style="height:33px;float: right;" name="btn_search" class="btn btn-sm btn-info btn-flat">Add New Employee</a>
              </div>
              <br><br>
              </div>
              
            </form>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Date Created</th>
                  <th>Salary Per Hour</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Zip</th>
                  <th>Country</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                   <?php
                foreach($Employees as $Employee)
                {
                  $user_datecreated = $Employee['user_datecreated'];
                  $Formated_user_datecreated = date('D d M, Y ', strtotime($user_datecreated));

                  // $appointment_time = $Appointment['appointment_time'];
                  // $Formated_appointment_Time = date('H:i A', strtotime($appointment_time));
                ?>
                <tr>
                  <td><?=$Employee['user_id'] ;?></td>
                    <td><?=$Employee['user_name'] ?></td>
                    <td><?=$Employee['user_email'] ?></td>
                    <td><?=$Formated_user_datecreated ?></td>
                    <td><?=$Employee['user_salaryPerHour'] ?></td>
                    <td><?=$Employee['user_city'] ?></td>
                    <td><?=$Employee['user_state'] ?></td>
                    <td><?=$Employee['user_zip'] ?></td>
                    <td><?=$Employee['user_country'] ?></td>
                    <td>
                      <a href="<?php echo base_url().'Employee/AddEditEmployee/'.$Employee['user_id']; ?> " target="_blank"  class="btn  btn-warning btn-sm">Update</a>
                    </td>
                  
                </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->  
    </section>
   </div>


</div>
<!-- ./wrapper -->
<?php
$this->load->view('includes/footer'); // load the footer HTML
?>
<!-- Select2 -->
<script src="<?php echo base_url().'assets/bower_components/select2/dist/js/select2.full.min.js';?>"></script>

<!-- DataTables -->
<script src="<?php echo base_url().'assets/bower_components/datatables.net/js/jquery.dataTables.min.js';?>"></script>
<script src="<?php echo base_url().'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js';?>"></script>
<script src="<?php echo base_url().'assets/bower_components/bootstrap-daterangepicker/daterangepicker.js';?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.js';?>"></script>
<script>
  $(function () {
    $('.select2').select2()
    //$('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      //'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

   

  //   //Date picker
  //   $('#appointment_date_from').datepicker({
  //     autoclose: true
  //   })

  //    //Date picker
  //   $('#appointment_date_to').datepicker({
  //     autoclose: true
  //   })

  //    //Timepicker
  //   $('#appointment_Time_start').timepicker({
  //     showInputs: false
  //   })

  //    //Timepicker
  //   $('#appointment_Time_to').timepicker({
  //     showInputs: false
  //   })
  // })

  // function funChangeAppointmentStatus(appointment_id , appointment_status_id , CancelAppointment)
  // {
  //   var confirmmsg = "";
  //   if(CancelAppointment == 1)
  //   {
  //     confirmmsg = "Are you sure you want to cancel this Appointment?";
  //   }
  //   else
  //   {
  //     confirmmsg = "Are you sure you want to approve this Appointment?";
  //   }
  //     if(confirm(confirmmsg))
  //     {
  //         $.ajax(
  //        {
  //         url:BaseUrlSite+'appointment/UpdateAppointmentStatus',
  //         data:{
  //             isAjaxCall    :'true',
  //             appointment_id: appointment_id,
  //             appointment_status_id : appointment_status_id,
  //             CancelAppointment : CancelAppointment
  //           },
  //           type:'POST',
  //           success:function(data)
  //           {
              
  //             location.reload();
  //           } 
  //       });
  //     }
  // }

   
</script>