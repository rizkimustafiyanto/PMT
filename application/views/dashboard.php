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
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= (strpos($doneProject, '.') !== false) ? number_format($doneProject, 2) : $doneProject ?>
                <sup style="font-size: 20px">%</sup>
              </h3>
              <p>Done</p>
            </div>
            <div class="icon">
              <i class="fas fa-signal"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= (strpos($processProject, '.') !== false) ? number_format($processProject, 2) : $processProject ?>
                <sup style="font-size: 20px">%</sup>
              </h3>
              <p>Progress</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= (strpos($stuckProject, '.') !== false) ? number_format($stuckProject, 2) : $stuckProject ?>
                <sup style="font-size: 20px">%</sup>
              </h3>
              <p>Stuck</p>
            </div>
            <div class="icon">
              <i class="fas fa-asterisk"></i>
            </div>
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
              <div class="card-title">
                <strong>Daily Task</strong> (<span style="border-radius: 20px;"><?= date('d M Y') ?></span>)
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
            <div class="card-body overflow-auto">
              <div class="timeline" id="event-timeline">
                <!-- Placeholder for event items -->
              </div>
            </div>
          </div>
          <!-- Batas Daily Task -->

          <!-- To Do List -->
          <div class="card card-warning">
            <div class="card-header">
              <div class="card-title">
                <strong>My Task</strong>
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
              <div class="scrollable" style="max-height: 300px; overflow-y: auto;">
                <ul class="todo-list ui-sortable" data-widget="todo-list">
                  <?php if (!empty($MyTask)) : ?>
                    <?php foreach ($MyTask as $record) :
                      $remainingDays = 0;
                      $badgeClass = '';
                      $startDate = strtotime($record->start_date);
                      $dueDate = strtotime($record->due_date);
                      $currentTime = time();

                      if ($currentTime <= $startDate) {
                        $remainingDays = round(($dueDate - $currentTime) / (60 * 60 * 24));
                        $badgeClass = 'badge-success';
                      } elseif ($currentTime < $dueDate) {
                        $remainingDays = round(($dueDate - $currentTime) / (60 * 60 * 24));
                        $badgeClass = (round($remainingDays) <= 2) ? 'badge-danger' : 'badge-warning';
                      } elseif ($currentTime >= $dueDate) {
                        $remainingDays = round(($dueDate - $currentTime) / (60 * 60 * 24));
                        $badgeClass = (round($remainingDays) <= 0) ? 'badge-secondary' : 'badge-secondary';
                        $remainingDays = round($remainingDays * (-1));
                      }
                      $remainingDays = round($remainingDays);

                      $statusW = $record->status_id;
                    ?>

                      <li class="overflow-auto text-nowrap">
                        <div class="icheck-primary d-inline">
                          <label for="todo1"></label>
                          <input type="checkbox" value="" data-task_id_check="<?= $record->task_id ?>" name="todo1" id="todo1" <?= ($statusW == 'STL-4') ? 'checked' : '' ?> disabled>
                        </div>
                        <span class="text"><?= $record->task_name ?></span>
                        <small class="badge <?= $badgeClass ?>"><i class="far fa-clock"></i> <?= $remainingDays ?> Hari</small>
                        <div class="tools">
                          <!-- <i class="fas fa-edit" data-task_id="<?= $record->task_id ?>" data-list_id="<?= $record->list_id ?>" data-task_name="<?= $record->task_name ?>" data-start="<?= $record->start_date ?>" data-due="<?= $record->due_date ?>" data-priority="<?= $record->priority_type_id ?>" data-task_member="<?= $record->member_id ?>"></i> -->
                        </div>
                      </li>

                    <?php
                    endforeach;
                    ?>
                  <?php else : ?>
                    <div class="text-center">No Task</div>
                  <?php endif; ?>
                </ul>
              </div>
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
              <div class="scrollable" style="max-height: 300px; overflow-y: auto;">
                <?php if (!empty($MyProject)) :
                  foreach ($MyProject as $key) :
                    $percent = $key->percentage;
                    $percent = (empty($percent)) ? 0 : $percent;
                    if (strlen($percent) > 4) {
                      $percent = number_format($percent, 2);
                    }
                ?>
                    <div class="progress-group">
                      <?= $key->project_name ?>
                      <span class="float-right"><b><?= $percent ?></b>/100</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar <?= ($percent < 100) ? 'bg-primary' : 'bg-success'; ?>" style="width: <?= $percent; ?>%"></div>
                      </div>
                    </div>
                <?php endforeach;
                endif; ?>
              </div>
            </div>
          </div>
          <!-- Batas Project Progress -->
        </div>

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
        <div class="form-group">
          <strong><i class="far fa-calendar mr-1"></i> Start Date</strong>
          <p class="text-muted" id="event-start-date" name="event-start-date"> </p>
        </div>
        <hr>
        <div class="form-group" id="event-end-date-div">
          <strong><i class="far fa-calendar mr-1"></i> End Date</strong>
          <p class="text-muted" id="event-end-date" name="event-end-date"> </p>
        </div>
        <hr>
        <div class="form-group">
          <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
          <p class="text-muted" id="event-note-date" name="event-note-date"> </p>
        </div>
        <hr>
        <div class="form-group" id="event-location-date-div">
          <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
          <p class="text-muted" id="event-location-date" name="event-location-date"> </p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Batas Event View -->
<!-- Control Sidebar -->
<script>
  $(document).ready(function() {
    $(".ui-sortable").sortable({
      // Opsi untuk CRUD
    });
  });
</script>
<script>
  $(document).ready(function() {
    var calendarEl = document.getElementById('calendarView');
    var timelineEl = document.getElementById('event-timeline');

    function initializeCalendar(eventsData) {
      var calendar = new FullCalendar.Calendar(calendarEl, {
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
      calendar.render();
    }

    function initializeTimeline(dataTime) {
      const currentDate = new Date().toISOString().split('T')[0];
      const filteredEvents = dataTime.filter(event => event.start.split('T')[0] === currentDate);
      const timeline = document.getElementById('event-timeline');
      let timelineContent = '';

      if (filteredEvents.length === 0) {
        const timelineItem = document.createElement('div');
        const linkNotes = "No Event Yet";
        const timeDate = "--:--";

        timelineItem.innerHTML =
          '<i class="fas fa-ban" style="background-color: #f56954;"></i>' +
          '<div class="timeline-item">' +
          '<span class="time"><i class="fas fa-clock"></i> ' + timeDate + '</span>' +
          '<div class="timeline-body">' + linkNotes + '</div>' +
          '</div>';

        timelineContent += timelineItem.outerHTML;
      } else {
        filteredEvents.forEach(event => {
          const colorS = event.backgroundColor;
          const aldAy = event.allDay;
          const timelineItem = document.createElement('div');
          const linkNotes = formatNotes(event.notes);
          const getLoc = event.location;
          const getStart = new Date(event.start);
          const getEnd = new Date(event.end);
          const hoursStart = String(getStart.getHours()).padStart(2, '0') + ':' + String(getStart.getMinutes()).padStart(2, '0');
          const hoursEnd = String(getEnd.getHours()).padStart(2, '0') + ':' + String(getEnd.getMinutes()).padStart(2, '0');
          const timeDate = (hoursStart === hoursEnd) || (hoursEnd === 'NaN:NaN') ? 'FullDay' : hoursStart + " - " + hoursEnd;

          timelineItem.innerHTML =
            '<i class="fas fa-calendar-alt" style="background-color: ' + colorS + ';"></i>' +
            '<div class="timeline-item">' +
            '<span class="time"><i class="fas fa-clock"></i> ' + timeDate + '</span>' +
            '<h3 class="timeline-header" data-title="' + event.title +
            '"data-start="' + event.start +
            '"data-end="' + event.end +
            '"data-notes="' + event.notes +
            '"data-hs="' + hoursStart +
            '"data-he="' + hoursEnd +
            '"data-ald="' + aldAy +
            '"data-loc="' + getLoc +
            '">' + event.title + '</h3>' +
            '<div class="timeline-body">' + linkNotes + '</div>' +
            '</div>';

          timelineContent += timelineItem.outerHTML;
        });
      }

      timeline.innerHTML = timelineContent;
      const timelineHeaders = document.querySelectorAll('.timeline-header');
      timelineHeaders.forEach(header => {
        header.addEventListener('click', function() {
          const eventData = {
            title: this.getAttribute('data-title'),
            start: this.getAttribute('data-start'),
            end: this.getAttribute('data-end'),
            hoursstart: this.getAttribute('data-hs'),
            hoursend: this.getAttribute('data-he'),
            allday: this.getAttribute('data-ald'),
            extendedProps: {
              notes: this.getAttribute('data-notes'),
              location: this.getAttribute('data-loc')
            }
          };
          handleEventHeader(eventData);
        });
      });
    }

    function handleEventHeader(eventData) {
      const {
        title,
        start,
        end,
        extendedProps: {
          notes,
          location
        },
        hoursstart,
        hoursend,
        allday
      } = eventData;

      const startDate = new Date(start).toLocaleDateString('en-US');
      const endDate = new Date(end).toLocaleDateString('en-US');
      const linkNotes = formatNotes(notes);
      const isStartNotEnd = start !== end;

      $('#eventDetailView .modal-title').text(title);
      $('#eventDetailView #event-note-date').html(linkNotes);
      $('#eventDetailView #event-end-date').text(
        isStartNotEnd ? `${endDate} || ${hoursEnd || ''}` : endDate || ''
      );
      $('#eventDetailView #event-start-date').text(
        isStartNotEnd ? `${startDate} || ${hoursStart || ''}` : startDate || ''
      );
      $('#eventDetailView #event-end-date-div').toggle(isStartNotEnd);
      $('#eventDetailView #event-location-date-div').toggle(!!location);
      $('#eventDetailView #event-location-date').text(location);
      $('#eventDetailView').modal('show');
    }


    function handleEventClick(info) {
      var id = info.event.id;
      var allDay = info.event.allDay;
      var title = info.event.title;
      var colorId = info.event.extendedProps.colorId;
      var start = info.event.start;
      var startDateStr = info.event.startStr;
      var endDateStr = info.event.endStr;
      var end = info.event.end;
      var notes = info.event.extendedProps.notes;
      var location = info.event.extendedProps.location;
      var creationDate = info.event.extendedProps.creationDate;
      var linkNotes = formatNotes(notes);

      $('#eventDetailView .modal-title').text(title);
      $('#eventDetailView #eventID').text(id);
      $('#eventDetailView #creationDate').text(creationDate);
      $('#eventDetailView #event-note-date').html(linkNotes);

      const showStart = allDay ? startDateStr : formatDate(start);
      const showEnd = allDay ? (end ? endDateStr : null) : formatDate(end);

      $('#eventDetailView #event-start-date').text(showStart)
      $('#eventDetailView #event-end-date-div')
        .toggle(showEnd !== null)
        .find('#event-end-date')
        .text(showEnd);

      $('#eventDetailView #event-location-date-div')
        .toggle(!!location)
        .find('#event-location-date')
        .text(location);

      $('#eventDetailView').modal('show');
    }


    function formatNotes(notes) {
      var urlRegex = /(https?:\/\/[^\s]+)/g;
      return notes.replace(urlRegex, '<a href="$&" target="_blank">$&</a>');
    }

    function formatDate(date) {
      var year = date.getFullYear();
      var month = (date.getMonth() + 1).toString().padStart(2, '0');
      var day = date.getDate().toString().padStart(2, '0');
      var hours = date.getHours().toString().padStart(2, '0');
      var minutes = date.getMinutes().toString().padStart(2, '0');

      return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes;
    }

    $.ajax({
      url: "<?= base_url() ?>GetEvent",
      type: "GET",
      dataType: "json",
      success: function(response) {
        initializeTimeline(response);
        initializeCalendar(response);
      },
      error: function(xhr, status, error) {
        console.log(error);
      },
    });
  });
</script>