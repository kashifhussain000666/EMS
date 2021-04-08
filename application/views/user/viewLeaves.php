	
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
        Leaves 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Leaves</a></li>
        <li class="active"> Leaves</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">View All WeeklyReports</h3>
            </div>-->
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

                  <div class="<?=$this->session->userdata('user_designation_id') == 3?'hide':''?>" style="width:15%;float: left;margin-right: 10px;">
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

                  <?php
                  $sel_status = $this->input->post('sel_status');
                  //echo $sel_doctor_category ; die("hello");
                  ?>

                <div class="col-md-2">
                  <!-- select -->
                  <div class="form-group">

                    <select class="form-control" name="sel_status" id="sel_status">
                      <option value="0">All Status</option>
                          <option value="Pending" <?php if($sel_status == 'Pending'){ echo "selected" ;}  ?>>Pending</option>
                          <option value="Approved" <?php if($sel_status == 'Approved'){ echo "selected" ;}  ?>>Approved</option>

                    </select>
                  </div>
                </div>
                     <?php 
                 
            $Report_date_from     = $this->input->post('Report_date_from');
          

          
          ?>
                <div class="col-md-3">
                <span style="float: left;">From: </span>
                  <div class="input-group date" style="margin-left:6%;width:156px;float: left;">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" style="margin-left:10px;" name="Report_date_from" id="Report_date_from" value="<?=$Report_date_from ?>" class="form-control pull-right" >
                  </div>
                </div>
                     <?php

            $Report_date_to     = $this->input->post('Report_date_to');
          
                ?>
                <div class="col-md-3">
                <span style="float: left;">To: </span>
                  <div class="input-group date" style="margin-left:6%;width:156px;float: left;">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" style="margin-left:10px;" name="Report_date_to" value="<?=$Report_date_to ?>"  id="Report_date_to" class="form-control pull-right" >
                  </div>
                 </div>

                  <button type="submit" style="height:33px;" name="btn_search" class="btn btn-sm btn-info btn-flat pull-left">Search</button>
				  <?php if( $IsShowAddWeeklyBtn ){?>
				  <a href="<?php echo base_url().'/Employee/AddEditLeave/';?>" style="height:33px; margin-left:3px" class="btn btn-sm btn-info btn-flat">Add Leaves</a>
				  <?php } ?>
                  <!-- End div date range picker --> 
                </div>
              </div>
              </div>
              
            </form>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Leave Date</th>
                  <th>Description</th>
                  <th>Date Created</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                   <?php
                foreach($Leaves as $Leave)
                {
                  $user_Leave_date = $Leave['user_Leave_date'];
                  $Formated_user_Leave_date = date('D d M, Y ', strtotime($user_Leave_date));

                  $user_Leave_dateCreated = $Leave['user_Leave_dateCreated'];
                  $Formated_user_Leave_dateCreated = date('D d M, Y ', strtotime($user_Leave_dateCreated));

                  // $appointment_time = $Appointment['appointment_time'];
                  // $Formated_appointment_Time = date('H:i A', strtotime($appointment_time));

//                   user_id
// user_Leave_date
// user_Leave_dateCreated
// user_Leave_desciption
// user_Leave_id
// user_Leave_isapproved

                ?>
                <tr>
                  <td><?=$Leave['user_Leave_id'] ;?></td>
                  <td><?=$Leave['employee_name'] ?></td>
                  <td><?=$Formated_user_Leave_date?></td>
                  <td><?=$Leave['user_Leave_desciption'] ?></td>
                  <td><?=$Formated_user_Leave_dateCreated?></td>
                  <td>
                    <?php 
                    if($Leave['user_Leave_isapproved'] == 1 )
                    {
                    ?> 
                    <span class="label label-success">Approved</span>
                    <?php
                    }
                    else
                    { 

                    ?>
                    <button <?php if($IsApproveAllow){ ?> onclick="MarkLeaveApproved(<?=$Leave['user_Leave_id']?>)"<?php } ?> class="btn  btn-danger btn-sm">Pending</button>
                    <?php
                    }
                    ?>
                      
                    </td>
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

   

    //Date picker
    $('#Report_date_from').datepicker({
      autoclose: true
    })

     //Date picker
    $('#Report_date_to').datepicker({
      autoclose: true
    })

    //  //Timepicker
    // $('#appointment_Time_start').timepicker({
    //   showInputs: false
    // })

    //  //Timepicker
    // $('#appointment_Time_to').timepicker({
    //   showInputs: false
    // })
  })

  function MarkLeaveApproved(user_Leave_id)
  {
    var confirmmsg = "";
    confirmmsg = "Are you sure you want to approve this?";
    
      if(confirm(confirmmsg))
      {
          $.ajax(
         {
          url:BaseUrlSite+'Employee/MarkLeaveApproved',
          data:{
              user_Leave_id: user_Leave_id
            },
            type:'POST',
            success:function(data)
            {
              
              location.reload();
            } 
        });
      }
  }

   
</script>