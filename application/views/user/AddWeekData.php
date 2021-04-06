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
                Add Week Data 
                <small></small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="" method="post" id="form_search_dotor">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-md-6">
                                            <span style="float: left;padding-top: 6px;">Week: </span>
                                            <div class="input-group date" style="margin-left: 10px;width:300px;float: left;">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input autocomplete="off" type="text" style="margin-left:10px;" id="weeklyDatePicker" value="<?=$WeekStart?> - <?=$WeekEnd?>" class="form-control pull-right">
                                                <input type="hidden" id="WeekStart" name="WeekStart">
                                                <input type="hidden" id="WeekEnd" name="WeekEnd">
                                            </div>
											<button type="submit" style="height:33px;margin-left: 20px;" class="btn btn-sm btn-info btn-flat pull-left">Submit</button>
                                        </div>
                                    </div>
                                </div>
							</form>
                            <form action="" method="post" id="form_search_dotor">
								<input type="hidden" name="WeekStart" value="<?=date ("Y-m-d",strtotime($WeekStart))?>">
								<input type="hidden" name="WeekEnd" value="<?=date ("Y-m-d",strtotime($WeekEnd))?>">
								<input type="hidden" name="Employee_id" value="<?=$Employee_id?>">
                                <div class="row mt-3">
                                    <div class="col-sm-12">
										<?php if( isset($_POST['btn_submitTimes_Add']) ){?>
											<div class="alert alert-success" role="alert">
												Data saved successfully.
											</div>
										<?php } elseif($IsWeekAdded > 0 && !$IsEditAllow){?>
											<div class="alert alert-warning" role="alert">
												This week data is locked. You can not change it now.
											</div>
										<?php }; ?>
                                        <table class="table table-bordered">
											<thead>
												<tr>
													<th>Date</th>
													<th>Day of Week</th>
													<th>From (hr)</th>
													<th>To (hr)</th>
													<th>Interval (HH:MM)</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if( $IsWeekAdded == 0 )
													{
														$date = $WeekStart;
														while (strtotime($date) <= strtotime($WeekEnd)) 
														{?>
															<tr>
																<td><?=date ("Y-m-d",strtotime($date))?>
																</td>
																<td><?=date ("l",strtotime($date))?></td>
																<td>
																	<div class="input-group bootstrap-timepicker timepicker">
																		<input <?=$IsWeekAdded>0?'disabled':''?> class="form-control timepickerHour" HR='<?=date ("Ymd",strtotime($date))?>' type="text" name="HrFrom<?=date ("Ymd",strtotime($date))?>" id="HrFrom<?=date ("Ymd",strtotime($date))?>" required />
																	</div>
																</td>
																<td>
																	<div class="input-group bootstrap-timepicker timepicker">
																		<input <?=$IsWeekAdded>0?'disabled':''?> class="form-control timepickerHour" HR='<?=date ("Ymd",strtotime($date))?>' type="text" name="HrTo<?=date ("Ymd",strtotime($date))?>" id="HrTo<?=date ("Ymd",strtotime($date))?>" required />
																	</div>
																</td>
																<td>
																	<span id="interval<?=date ("Ymd",strtotime($date))?>">0:0</span>
																	<input type="hidden" name="timeSpent<?=date ("Ymd",strtotime($date))?>" id="timeSpent<?=date ("Ymd",strtotime($date))?>" value="00:00:00">
																</td>
															</tr>
													<?php
															$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
														}
													}
													else
													{
														foreach( $SavedReportData as $ReportData )
														{
															$date = $ReportData['user_DailyReport_date'];
															$user_DailyReport_TimeStart = $ReportData['user_DailyReport_TimeStart'];
															$user_DailyReport_TimeEnd = $ReportData['user_DailyReport_TimeEnd'];
															$user_DailyReport_TimeSpend = $ReportData['user_DailyReport_TimeSpend'];
															?>
																<tr>
																	<td><?=date ("Y-m-d",strtotime($date))?>
																	</td>
																	<td><?=date ("l",strtotime($date))?></td>
																	<td>
																		<div class="input-group bootstrap-timepicker timepicker">
																			<input value="<?=$user_DailyReport_TimeStart?>" <?=!$IsEditAllow?'disabled':''?> class="form-control timepickerHour" HR='<?=date ("Ymd",strtotime($date))?>' type="text" name="HrFrom<?=date ("Ymd",strtotime($date))?>" id="HrFrom<?=date ("Ymd",strtotime($date))?>" required />
																		</div>
																	</td>
																	<td>
																		<div class="input-group bootstrap-timepicker timepicker">
																			<input value="<?=$user_DailyReport_TimeEnd?>" <?=!$IsEditAllow?'disabled':''?> class="form-control timepickerHour" HR='<?=date ("Ymd",strtotime($date))?>' type="text" name="HrTo<?=date ("Ymd",strtotime($date))?>" id="HrTo<?=date ("Ymd",strtotime($date))?>" required />
																		</div>
																	</td>
																	<td>
																		<span id="interval<?=date ("Ymd",strtotime($date))?>"><?=$user_DailyReport_TimeSpend?></span>
																		<input type="hidden" name="timeSpent<?=date ("Ymd",strtotime($date))?>" id="timeSpent<?=date ("Ymd",strtotime($date))?>" value="<?=$user_DailyReport_TimeSpend?>">
																	</td>
																</tr>
														<?php	
														}
													}
												?>
											</tbody>
                                        </table>
                                    </div>
									<?php if( $IsWeekAdded == 0 ){?>
									<input name="btn_submitTimes_Add" type="submit" style="height:33px;margin-left: 20px;" class="btn btn-sm btn-info btn-flat pull-left" />
									<?php }elseif( $IsEditAllow ){?>
									<input name="btn_submitTimes_Update" type="submit" style="height:33px;margin-left: 20px;" class="btn btn-sm btn-info btn-flat pull-left" />
									<?php }?>
                                </div>
                            </form>
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
    
$(document).ready(function(){
    moment.locale('en', {
      week: { dow: 1 } // Monday is the first day of the week
    });

  //Initialize the datePicker(I have taken format as mm-dd-yyyy, you can     //have your owh)
  $("#weeklyDatePicker").datepicker({
      autoclose: true
  });

var firstDate='<?=date("d-m-Y",strtotime($WeekStart))?>', lastDate='<?=date("d-m-Y",strtotime($WeekEnd))?>';
$("#weeklyDatePicker").val(firstDate + " - " + lastDate);
	  $("#WeekStart").val(firstDate);
	  $("#WeekEnd").val(lastDate);
   //Get the value of Start and End of Week
  $('#weeklyDatePicker').on('changeDate', function (e) {
      var value = $("#weeklyDatePicker").val();
      firstDate = moment(value, "MM-DD-YYYY").day(0).format("DD-MM-YYYY");
      lastDate =  moment(value, "MM-DD-YYYY").day(6).format("DD-MM-YYYY");
  });
  $('#weeklyDatePicker').on('hide', function (e) {
	  $("#weeklyDatePicker").val(firstDate + " - " + lastDate);
	  $("#WeekStart").val(firstDate);
	  $("#WeekEnd").val(lastDate);
  });
});
function SetInterval(d)
{}

$('.timepickerHour').timepicker({defaultTime: '09:00 AM'}).on('changeTime.timepicker,hide.timepicker', function(e) {
	var HR = $(this).attr('HR');
	var startTime = $('#HrFrom'+HR).val();
	var endTime = $('#HrTo'+HR).val();
	
    var todayDate = moment(new Date()).format("MM-DD-YYYY"); //Instead of today date, We can pass whatever date        

    var startDate = new Date(`${todayDate} ${startTime}`);
    var endDate = new Date(`${todayDate } ${endTime}`);
    var timeDiff = Math.abs(startDate.getTime() - endDate.getTime());
	
    var hh = Math.floor(timeDiff / 1000 / 60 / 60);   
    hh = ('0' + hh).slice(-2)
   
    timeDiff -= hh * 1000 * 60 * 60;
    var mm = Math.floor(timeDiff / 1000 / 60);
    mm = ('0' + mm).slice(-2)

    timeDiff -= mm * 1000 * 60;
    var ss = Math.floor(timeDiff / 1000);
    ss = ('0' + ss).slice(-2)
    
    $('#interval'+HR).text(hh + ":" + mm);
    $('#timeSpent'+HR).val(hh + ":" + mm + ":" + ss);
});
</script>
<style>
.datepicker .datepicker-days table tbody tr:hover {
    background-color: #eee;
}
.mt-3
{
	margin-top: 3rem;
}
</style>