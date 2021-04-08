
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url().'assets/images/avatar5.png';?>" height="45px;" width="45px;" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('user_name');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Active</a>
        </div>
      </div>
      <!-- search form -->
     <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <?php if($this->session->userdata('user_designation_id') == 1) // 1- CEO
        {
        ?>
          <li><a href="<?php echo base_url().'Employee/WeeklyReports'; ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Reports</span></a></li>
          <li><a href="<?php echo base_url().'Employee/Leaves'; ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Leaves</span></a></li>
          
          <!-- <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Personals</span></a></li>
          <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Departments</span></a></li> -->
        <?php
        }
        ?>

        <?php if($this->session->userdata('user_designation_id') == 2) // 2- Director
        {
        ?>
          <li><a href="<?php echo base_url().'Employee/WeeklyReports'; ?>  "><i class="fa fa-circle-o text-aqua"></i> <span>Weekly Reports</span></a></li>
          <li><a href="<?php echo base_url().'Employee/ViewEmployees'; ?>  "><i class="fa fa-circle-o text-aqua"></i> <span>Employees</span></a></li>
          <li><a href="<?php echo base_url().'Employee/Leaves'; ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Leaves</span></a></li>
        <?php
        }
        ?>

        <?php if($this->session->userdata('user_designation_id') == 3) // 3- Employee
        {
        ?>
          <li><a href="<?php echo base_url().'Employee/WeeklyReports'; ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Weekly Report</span></a></li>
          <!-- <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Vacation request</span></a></li> -->
          <li><a href="<?php echo base_url().'Employee/Leaves'; ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Sick Leaves</span></a></li>
        <?php
        }
        ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
