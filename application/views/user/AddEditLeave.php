<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Leave</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/bootstrap/dist/css/bootstrap.min.css';?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/font-awesome/css/font-awesome.min.css';?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/Ionicons/css/ionicons.min.css';?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css';?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/square/blue.css';?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';?>">


   <style type="text/css">
        .spanError{
          color: #ff0000;
        }
        .Errorborderclass{
          border-color: #ff0000;
        }
  </style>
  <script type="text/javascript">
    var BaseUrlSite = '<?php echo base_url(); ?>';
  </script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Leaves</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Add Leave</p>
    <?php 
    if($error != "")
    {
      ?>
    <div class="alert alert-danger">
    <strong>Error!</strong> <?=$error?>
    </div>
    <?php 
    }
    if($success != "")
    {
      ?>
      <div class="alert alert-success">
        <strong>Success!</strong> <?=$success?>
      </div>
      <?php
    }
    $txt_user_Leave_date = '' ;
    $txt_user_Leave_desciption = '';

    if(isset($_POST['hdn_btn_addLeave'])=="")
    {}
    else
    {
      $txt_user_Leave_date = $this->input->post('txt_user_Leave_date') ;
      $txt_user_Leave_desciption = $this->input->post('txt_user_Leave_desciption') ;
    }
    ?>

    <form class="" method="post" id="form_Leave" action="">
      <div class="form-group has-feedback">
        <input type="text" name="txt_user_Leave_date" value="<?php echo $txt_user_Leave_date; ?>" id="txt_user_Leave_date" class="form-control" placeholder="Leave Date">
        <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
        <span id="Error_user_Leave_date" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <textarea class="form-control" name="txt_user_Leave_desciption" id="txt_user_Leave_desciption" placeholder="Description">
        </textarea>
        <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
        <span id="Error_user_Leave_desciption" class="spanError"></span>
      </div>
      
      
      <!--</div>-->
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="hidden" name="hdn_btn_addLeave" value="hdn_btn_addLeave"/>
          <input type="button"  class="btn btn-primary btn-block btn-flat" id="btn_AddLeave" name="btn_AddLeave" value="Add">
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url().'assets/bower_components/jquery/dist/jquery.min.js';?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url().'assets/bower_components/bootstrap/dist/js/bootstrap.min.js';?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js';?>"></script>

<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.date.extensions.js';?>"></script>
<script src="<?php echo base_url().'assets/plugins/input-mask/jquery.inputmask.extensions.js';?>"></script>
<script src="<?php echo base_url().'assets/Profile_files/jquery.mask.js.download';?>"></script>
<script src="<?php echo base_url().'assets/bower_components/bootstrap-daterangepicker/daterangepicker.js';?>"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.js';?>"></script>
<script src="<?php echo base_url().'assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

    //Date picker
    $('#txt_user_Leave_date').datepicker({
      autoclose: true
    })

  });
</script>

<script type="text/javascript">
  $("#btn_AddLeave").click(function()
  {
    var txt_user_Leave_date      = $("#txt_user_Leave_date").val();
    var txt_user_Leave_desciption      = $("#txt_user_Leave_desciption").val();
  
    $(".spanError").html("");
    $(".form-control").removeClass( "Errorborderclass" );

    if(txt_user_Leave_date == '')
    {
      $("#Error_user_Leave_date").html("Please enter date");
      $("#txt_user_Leave_date").addClass( "Errorborderclass" );
      return false;
    }
    if($.trim(txt_user_Leave_desciption) == '')
    {
      $("#Error_user_Leave_desciption").html("Please enter Description");
      $("#txt_user_Leave_desciption").addClass( "Errorborderclass" );
      return false;
    }
    if( txt_user_Leave_date != '')
    {
      //loading('start');  
        $.ajax(
         {
          url:BaseUrlSite+'Employee/IsLeaveAlreadyExist',
          data:{
              isAjaxCall    :'true',
              txt_user_Leave_date: txt_user_Leave_date,
              Isajaxcall : 1
            },
            type:'POST',
            success:function(data)
            {
              if(data=='Already Exist')
              {
                $("#Error_user_Leave_date").html("Leave already exist for this date");
                $("#txt_user_Leave_date").addClass( "Errorborderclass" );
                return false;
              }
              else
              {
                $("#form_Leave").submit();
              }
              
            } 
        });
      }
  });
</script>
</body>
</html>
