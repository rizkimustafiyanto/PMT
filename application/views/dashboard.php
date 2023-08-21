<?php
$totalProject = '0';
$doneProject = '0';
$processProject = '0';
$stuckProject = '0';
if (!empty($Countable)) {
  foreach ($Countable as $key) {
    $totalProject = $key->tot_project;
    $doneProject = $key->percentage_done;
    $processProject = $key->percentage_process;
    $stuckProject = $key->percentage_stuck;
  }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">

          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $totalProject ?></h3>
              <p>Projects</p>
            </div>
            <div class="icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= (strpos($doneProject, '.') !== false) ? rtrim(number_format($doneProject, 2), '0') : number_format($doneProject, 0) ?>
                <sup style="font-size: 20px">%</sup>
              </h3>
              <p>Done</p>
            </div>
            <div class="icon">
              <i class="fas fa-signal"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= (strpos($processProject, '.') !== false) ? rtrim(number_format($processProject, 2), '0') : number_format($processProject, 0) ?>
                <sup style="font-size: 20px">%</sup>
              </h3>
              <p>Progress</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= (strpos($stuckProject, '.') !== false) ? rtrim(number_format($stuckProject, 2), '0') : number_format($stuckProject, 0) ?>
                <sup style="font-size: 20px">%</sup>
              </h3>
              <p>Stuck</p>
            </div>
            <div class="icon">
              <i class="fas fa-asterisk"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <!-- Daily Task -->
          <div class="card card-warning">
            <div class="card-header border-tranparent">
              <div class="card-title"><strong>Daily Task</strong></div>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="direct-chat-messages overflow-auto">
                <div class="text-center" style="padding-bottom: 20px;">
                  <span class="bg-red" style="border-radius: 20px; padding: 10px;"><?= date('d M Y') ?></span>
                </div>
                <div class="timeline">
                  <div>
                    <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab.
                      </div>
                    </div>
                  </div>
                  <div>
                    <i class="fas fa-comments bg-yellow"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                    </div>
                  </div>

                  <div class="time-label">
                    <span class="bg-green">3 Jan. 2014</span>
                  </div>

                  <div>
                    <i class="fa fa-camera bg-purple"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                      <div class="timeline-body">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                      </div>
                    </div>
                  </div>

                  <div>
                    <i class="fas fa-video bg-maroon"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>
                      <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                      <div class="timeline-body">
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen=""></iframe>
                        </div>
                      </div>
                      <div class="timeline-footer">
                        <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                      </div>
                    </div>
                  </div>

                  <div>
                    <i class="fas fa-clock bg-gray"></i>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!-- Batas Daily Task -->

          <!-- To Do List -->
          <div class="card card-warning" id="draggableCard">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
              <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                <strong>To Do List</strong>
              </h3>
              <div class="card-tools">
                <ul class="pagination pagination-sm">
                  <li class="page-item"><a href="#" class="page-link">«</a></li>
                  <li class="page-item"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">»</a></li>
                </ul>
              </div>
            </div>

            <div class="card-body">
              <ul class="todo-list ui-sortable" data-widget="todo-list">
                <li>

                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>

                  <div class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                    <label for="todoCheck1"></label>
                  </div>

                  <span class="text">Design a nice theme</span>

                  <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>

                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <li class="done">
                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo2" id="todoCheck2" checked="">
                    <label for="todoCheck2"></label>
                  </div>
                  <span class="text">Make the theme responsive</span>
                  <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <li>
                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo3" id="todoCheck3">
                    <label for="todoCheck3"></label>
                  </div>
                  <span class="text">Let theme shine like a star</span>
                  <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <li>
                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo4" id="todoCheck4">
                    <label for="todoCheck4"></label>
                  </div>
                  <span class="text">Let theme shine like a star</span>
                  <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <li>
                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo5" id="todoCheck5">
                    <label for="todoCheck5"></label>
                  </div>
                  <span class="text">Check your messages and notifications</span>
                  <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
                <li>
                  <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo6" id="todoCheck6">
                    <label for="todoCheck6"></label>
                  </div>
                  <span class="text">Let theme shine like a star</span>
                  <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                  <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                  </div>
                </li>
              </ul>
            </div>

            <div class="card-footer clearfix">
              <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
            </div>
          </div>
          <!-- Batas To Do List -->

          <!-- Project Progress -->
          <div class="card card-warning">
            <div class="card-header">
              <div class="card-title">
                <strong>Project Progress</strong>
              </div>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="col-md-12">
                <div class="progress-group">
                  Add Products to Cart
                  <span class="float-right"><b>160</b>/200</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                  </div>
                </div>

                <div class="progress-group">
                  Complete Purchase
                  <span class="float-right"><b>310</b>/400</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                  </div>
                </div>

                <div class="progress-group">
                  <span class="progress-text">Visit Premium Page</span>
                  <span class="float-right"><b>480</b>/800</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: 60%"></div>
                  </div>
                </div>

                <div class="progress-group">
                  Send Inquiries
                  <span class="float-right"><b>250</b>/500</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- Batas Project Progress -->

        </div>
        <!-- /.col-md-6 -->
        <div class="col-md-6">
          <!-- Calender -->
          <div class="card card-warning">
            <div class="card-header border-transparent">
              <div class="card-title"><strong>Calender</strong></div>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>

            <div class="card-body pt-0" style="margin-top: 5px;">
              <div style="width: 100%">
                <div class="bootstrap-datetimepicker-widget usetwentyfour">
                  <ul class="list-unstyled">
                    <li class="show">
                      <div class="datepicker">
                        <div class="datepicker-days">
                          <table class="table table-sm table-borderless">
                            <thead>
                              <!-- <tr>
                                 <th class="prev prev-year-btn" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th>
                                 <th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year"><?php echo $year; ?></th>
                                 <th class="next next-year-btn" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th>
                               </tr> -->
                              <tr>
                                <th class="prev prev-month-btn" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th>
                                <?php foreach (range(1, 12) as $m) : ?>
                                  <?php if ($m == $month) { ?>
                                    <th class="picker-switch<?php echo ($m == $month) ? ' bg-warning' : ''; ?>" colspan="5" title="Select Month">
                                      <?php echo date('M ' . $year, mktime(0, 0, 0, $m, 1)); ?>
                                    </th>
                                  <?php } ?>
                                <?php endforeach; ?>
                                <th class="next next-month-btn" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th>
                              </tr>
                              <tr>
                                <?php foreach ($days as $day) : ?>
                                  <th class="dow"><?php echo $day; ?></th>
                                <?php endforeach; ?>
                              </tr>
                            </thead>
                            <tbody>
                              <?php echo $calendar; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Batas Calender -->

        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<!-- <script>
  $(document).ready(function() {
    var areaChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
          label: 'Digital Goods',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label: 'Electronics',
          backgroundColor: 'rgba(210, 214, 222, 1)',
          borderColor: 'rgba(210, 214, 222, 1)',
          pointRadius: false,
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: [65, 59, 80, 81, 56, 55, 40]
        }
      ]
    };

    var barChartCanvas = $('#barChart');
    var barChartData = JSON.parse(JSON.stringify(areaChartData));
    
    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false
    };

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    });
  });
</script> -->
<script>
  // Panggil fungsi draggable pada elemen card dengan class card-warning
  $(document).ready(function() {
    // Membuat elemen dengan class 'ui-sortable-handle' menjadi dragable
    $(".ui-sortable").sortable({
      // Tentukan opsi tambahan jika diperlukan

    });
  });

  document.querySelector('.prev-month-btn').addEventListener('click', function() {
    var prevMonth = <?php echo ($month == 1) ? 12 : $month - 1; ?>;
    var prevYear = <?php echo ($month == 1) ? $year - 1 : $year; ?>;
    window.location.href = "<?php echo base_url('Dashboard/') ?>" + prevMonth + "/" + prevYear;
  });

  document.querySelector('.next-month-btn').addEventListener('click', function() {
    var nextMonth = <?php echo ($month == 12) ? 1 : $month + 1; ?>;
    var nextYear = <?php echo ($month == 12) ? $year + 1 : $year; ?>;
    window.location.href = "<?php echo base_url('Dashboard/') ?>" + nextMonth + "/" + nextYear;
  });

  // document.querySelector('.prev-year-btn').addEventListener('click', function() {
  //   var prevYear = <?php echo $year - 1; ?>;
  //   window.location.href = "<?php echo base_url('Dashboard/') ?>" + <?php echo $month; ?> + "/" + prevYear;
  // });

  // document.querySelector('.next-year-btn').addEventListener('click', function() {
  //   var nextYear = <?php echo $year + 1; ?>;
  //   window.location.href = "<?php echo base_url('Dashboard/') ?>" + <?php echo $month; ?> + "/" + nextYear;
  // });
</script>