<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Employeee Page</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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
    <a href="../../index2.html"><b>EMS</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">
      <?php if(isset($Employee_id) && $Employee_id != '')
      {
        echo "Update Employee";
      }
      else
      {
        echo "Add a New Employee";
      }
      ?>
    </p>
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
    ?>


    <?php

    $txt_user_name = '' ;
    $txt_user_email             = '';
    $txt_user_phone             = '';
    $txt_user_password          = '';
    $txt_retype_user_password   = '';
    $txt_user_salaryPerHour     = '';
    $txt_user_city              = '';
    $txt_user_state             = '';
    $txt_user_zip               = '';
    $txt_user_country           = '';

    if(isset($_POST['hdn_btn_createUser'])=="")
    {
      if(isset($Employee_id) && $Employee_id != '')
      {
        foreach($user_infos as $user_info)
        {
            $txt_user_name            = $user_info['user_name'];
            $txt_user_email           = $user_info['user_email'];
            $txt_user_phone           = $user_info['user_phone'];
            $txt_user_password        = $user_info['user_password'];
            $txt_retype_user_password = $user_info['user_password'];
            $txt_user_salaryPerHour   = $user_info['user_salaryPerHour'];
            $txt_user_city            = $user_info['user_city'];
            $txt_user_state           = $user_info['user_state'];
            $txt_user_zip             = $user_info['user_zip'];
            $txt_user_country         = $user_info['user_country'];
        }
      }
    }
    

    ?>

    <form class="" method="post" id="form_signup" action="">
      <?php 
      if(isset($Employee_id) && $Employee_id != '')
      {
      ?>
        <input type="hidden" name="Employee_id" value="<?=$Employee_id ?>">
      <?php
      }
      ?>
      <div class="form-group has-feedback">
        <input type="text" name="txt_user_name" value="<?php echo $txt_user_name; ?>" id="txt_user_name" class="form-control" placeholder="Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span id="Error_user_name" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" id="txt_user_phone" value="<?php echo $txt_user_phone; ?>" name="txt_user_phone" class="form-control" placeholder="Phone" >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span id="Error_user_phone" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" id="txt_user_email" value="<?php echo $txt_user_email; ?>" name="txt_user_email" class="form-control" placeholder="Email" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span id="Error_user_email" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="txt_user_password" id="txt_user_password" value="<?php echo $txt_user_password; ?>" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span id="Error_user_password" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="txt_retype_user_password" id="txt_retype_user_password" value="<?php echo $txt_retype_user_password; ?>" placeholder="Retype password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span id="Error_retype_user_password" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" class="form-control" name="txt_user_salaryPerHour" id="txt_user_salaryPerHour" value="<?php echo $txt_user_salaryPerHour; ?>" placeholder="salary Per Hour">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span id="Error_user_salaryPerHour" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="txt_user_city" id="txt_user_city" value="<?php echo $txt_user_city; ?>" placeholder="City">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span id="Error_user_city" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="txt_user_state" id="txt_user_state" value="<?php echo $txt_user_state; ?>" placeholder="State">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span id="Error_user_state" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="txt_user_zip" id="txt_user_zip" value="<?php echo $txt_user_zip; ?>" placeholder="Zip">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span id="Error_user_zip" class="spanError"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="txt_user_country" id="txt_user_country" value="<?php echo $txt_user_country; ?>" placeholder="Country">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span id="Error_user_country" class="spanError"></span>
      </div>
     <!--  <div class="form-group has-feedback">
          <select name="user_department_id" id="user_department_id" onchange="funcHideShowData()" class="form-control" required="">
              <option value="0" selected="">-- Account Type --</option>
               <?php 
                foreach($AllDesignations as $AllDesignation)
                {
                ?>
                  <option value="<?=$AllDepartment['user_designation_id'] ?>" <?php if($this->input->post('user_department_id') == $AllDepartment['user_designation_name']){ echo "selected" ;}  ?>><?php echo $AllDepartment['user_designation_name']; ?></option>
                <?php 
                }
                ?>
          </select>
          <span class="glyphicon glyphicons-parents form-control-feedback"></span>
          <span id="Error_user_type" class="spanError"></span>
      </div> -->
      
      <!--</div>-->
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="hidden" name="hdn_btn_createUser" value="hdn_btn_createUser"/>
          <input type="button"  class="btn btn-primary btn-block btn-flat" id="btn_createUser" name="btn_createUser" value="
          <?php if(isset($Employee_id) && $Employee_id != '')
      {
        echo "Update";
      }
      else
      {
        echo "Add";
      }
      ?>
          ">
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
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

    $('[data-mask]').inputmask()

    $("#phoneNo").mask('0000-0000000');
    $("#txt_cnic").mask('00000-0000000-0');
  });
</script>

<script type="text/javascript">

  function funcHideShowData()
  {
     //alert("hello");
    var user_type = $( "#user_type" ).val();
    if(user_type == 1 )
    {
        $("#div_sel_doctor_category").show();
    }
    else
    {
      $("#div_sel_doctor_category").hide();
    }
  }
  
  //function ValidateSignup()
  $("#btn_createUser").click(function()
  {
    var txt_user_name      = $("#txt_user_name").val();
    var txt_user_email      = $("#txt_user_email").val();
    var txt_user_phone       = $("#txt_user_phone").val();
    var txt_user_password        = $("#txt_user_password").val();
    var txt_retype_user_password = $("#txt_retype_user_password").val();
    var txt_user_salaryPerHour             = $("#txt_user_salaryPerHour").val();
    var txt_user_city             = $("#txt_user_city").val();
    var txt_user_state             = $('#txt_user_state').val();
    var txt_user_zip              = $('#txt_user_zip').val();
    var txt_user_country             = $('#txt_user_country').val();
  
    $(".spanError").html("");
    $(".form-control").removeClass( "Errorborderclass" );

    if(txt_user_name == '')
    {
      $("#Error_user_name").html("Please enter name");
      $("#txt_user_name").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_user_phone == '')
    {
      $("#Error_user_phone").html("Please enter phone");
      $("#txt_user_phone").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_user_phone != "" && txt_user_phone.length < 10)
    {
      $("#Error_user_phone").html("Invalid Phone No");
      $("#txt_user_phone").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_user_email == '')
    {
      $("#Error_user_email").html("Please enter Email");
      $("#txt_user_email").addClass( "Errorborderclass" );
      return false;
    }

    if(txt_user_email != '')
    {
      var validations ={
      email: [/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/, 'Please enter a valid email address']
        };
      validation = new RegExp(validations['email'][0]);
      if (!validation.test(txt_user_email)){
            $("#Error_user_email").html("Invalid Email Format");
            $("#txt_user_email").addClass( "Errorborderclass" );
            return false;
      }
    }

    if( txt_user_email != '')
    {
      //loading('start');  
        $.ajax(
         {
          url:BaseUrlSite+'Employee/IsEmailAlreadyExist',
          data:{
              isAjaxCall    :'true',
              txt_user_email: txt_user_email,
              Isajaxcall : 1,
              Employee_id : 
              <?php 
              if(isset($Employee_id) && $Employee_id != '')
              {
              ?>
              <?=$Employee_id ?>
              <?php
              }
              else
              {
                echo 0;
              }
              ?>
            },
            type:'POST',
            success:function(data)
            {
              if(data=='Already Exist')
              {
                $("#Error_user_email").html("This email already exist");
                $("#txt_user_email").addClass( "Errorborderclass" );
                return false;
              }
              else
              {
                ValidateOnSuccessfunction();
              }
              
            } 
        });
      }

  });
    
    

  function ValidateOnSuccessfunction()
  {
    var txt_user_password        = $("#txt_user_password").val();
    var txt_retype_user_password = $("#txt_retype_user_password").val();
    var txt_user_salaryPerHour             = $("#txt_user_salaryPerHour").val();
    var txt_user_city             = $("#txt_user_city").val();
    var txt_user_state             = $('#txt_user_state').val();
    var txt_user_zip              = $('#txt_user_zip').val();
    var txt_user_country             = $('#txt_user_country').val();
    if(txt_user_password == '')
    {
      $("#Error_user_password").html("Please enter password");
      $("#txt_user_password").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_user_password.length < 8)
    {
      $("#Error_user_password").html("Pasword must be atleast 8 characters");
      $("#txt_user_password").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_retype_user_password == '')
    {
      $("#Error_retype_user_password").html("Please retype password");
      $("#txt_retype_user_password").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_retype_user_password != txt_user_password)
    {
      $("#Error_retype_user_password").html("Password not match");
      $("#txt_retype_user_password").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_user_salaryPerHour == '')
    {
      
      $("#Error_user_salaryPerHour").html("Please enter salaryPerHour");
      $("#txt_user_salaryPerHour").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_user_city == '')
    {
      
      $("#Error_user_city").html("Please enter city");
      $("#txt_user_city").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_user_state == '')
    {
      
      $("#Error_user_state").html("Please enter state");
      $("#txt_user_state").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_user_zip == '')
    {
      
      $("#Error_user_zip").html("Please enter zip");
      $("#txt_user_zip").addClass( "Errorborderclass" );
      return false;
    }
    if(txt_user_country == '')
    {
      
      $("#Error_user_country").html("Please enter Country");
      $("#txt_user_country").addClass( "Errorborderclass" );
      return false;
    }
    else
    {
      $("#form_signup").submit();
      
    }
  }


</script>
</body>
</html>
