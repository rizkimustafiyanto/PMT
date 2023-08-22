<style>
  .fc-header-toolbar {
    height: 8px;
    font-size: 12px;
  }

  .fc-header-toolbar .fc-prev-button {
    background-color: white;
    color: black;
    border: none;
  }

  .fc-header-toolbar .fc-next-button {
    background-color: white;
    color: black;
    border: none;
  }
</style>
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
            <div class="card-body" style="margin-top: -10px;">
              <div id="calendarView" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap">
                <!-- Konten kalender akan dirender di sini -->
              </div>
            </div>
          </div>
          <!-- Batas Calender -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Event View -->
<div class="modal fade" id="eventDetailView">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Event Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group" style="display: none;">
          <label for="eventID">ID</label>
          <input type="text" class="form-control" id="eventID" name="eventID" required readonly>
        </div>
        <div class="form-group">
          <label for="event-start">Start Date</label>
          <input type="datetime-local" class="form-control" id="event-start-date" name="event-start-date" required readonly>
        </div>
        <div class="form-group">
          <label for="event-end">End Date</label>
          <input type="datetime-local" class="form-control" id="event-end-date" name="event-end-date" required readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Batas Event View -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<script src="<?= base_url(); ?>assets/plugins/fullcalendar/main.js"></script>
<script>
  // Panggil fungsi draggable pada elemen card dengan class card-warning
  $(document).ready(function() {
    // Membuat elemen dengan class 'ui-sortable-handle' menjadi dragable
    $(".ui-sortable").sortable({
      // Tentukan opsi tambahan jika diperlukan
    });
  });
</script>
<script>
  $(function() {
    var calendarEl = document.getElementById('calendarView');
    var calendar;

    function initializeCalendar(eventsData) {
      // console.log(eventsData);
      calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          start: 'prev',
          center: 'title',
          end: 'next'
        },
        validRange: {
          start: '2023-01-01',
          end: '2023-12-31'
        },
        slotMinTime: '06:00:00',
        slotMaxTime: '22:00:00',
        themeSystem: 'bootstrap',
        events: eventsData,
        editable: false,
        droppable: false,
        eventClick: handleEventClick,
        aspectRatio: 2,
      });
      console.log(calendar)
      calendar.render();
    }

    // Untuk click clik calendar
    function handleEventClick(info) {
      console.log(info.event);
      var id_event = info.event.id;
      var fullDay = info.event.allDay;
      var title = info.event.title;
      var colorId = info.event.extendedProps.colorId;
      var startDate = info.event.start;
      var endDate = info.event.end;

      $('#eventDetailView .modal-title').text(title);
      $('#eventDetailView #eventID').val(id_event);

      if (startDate) {
        $('#eventDetailView #event-start-date').val(formatDate(startDate));
      } else {
        $('#eventDetailView #event-start-date').val('N/A');
      }

      if (endDate) {
        $('#eventDetailView #event-end-date').val(formatDate(endDate));
      } else {
        $('#eventDetailView #event-end-date').val('N/A');
      }
      $('#eventDetailView #event-end-date').prop('readonly', fullDay);
      $('#eventDetailView').modal('show');

    }
    // Batas click calendar
    // Tools untuk progressing
    function formatDate(date) {
      var year = date.getFullYear();
      var month = (date.getMonth() + 1).toString().padStart(2, '0');
      var day = date.getDate().toString().padStart(2, '0');
      var hours = date.getHours().toString().padStart(2, '0');
      var minutes = date.getMinutes().toString().padStart(2, '0');

      return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    function refreshCalendar() {
      calendar.destroy();
      isiCalendar();
    }

    function isiCalendar() {
      $.ajax({
        url: "<?= base_url() ?>GetEvent",
        type: "GET",
        dataType: "json",
        success: function(response) {
          // console.log(response);
          initializeCalendar(response);
        },
        error: function(xhr, status, error) {
          console.log(error + "oke");
        }
      });
    }
    // Batas tools untuk progressing

    // Progressing
    $(document).ready(function() {
      isiCalendar();
    });
  });
</script>