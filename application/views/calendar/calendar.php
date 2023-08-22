<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Calendar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Calendar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap">
                                <!-- Konten kalender akan dirender di sini -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Edit external event sebelum di drag -->
    <div class="modal fade" id="addEventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ADD Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="event-form">
                        <div class="form-group">
                            <label for="event-title">Event Title</label>
                            <input type="text" class="form-control" id="event-title" name="event-title" placeholder="Event Title Here" required>
                        </div>
                        <div class="form-group">
                            <label for="event-color">Event Color</label>
                            <select class="form-control" id="event-color" name="event-color" required>
                                <!-- Options for event colors -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="all-day">All Day</label>
                            <select class="form-control" name="all-day" id="all-day" required>
                                <option value="" selected disabled>-- Choose Day --</option>
                                <option value="false">No</option>
                                <option value="true">Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="event-start">Start Date</label>
                            <input type="datetime-local" class="form-control" id="event-start" name="event-start" required>
                        </div>
                        <div class="form-group">
                            <label for="event-end">End Date</label>
                            <input type="datetime-local" class="form-control" id="event-end" name="event-end" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-add-event">Add Event</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="eventDetailModal">
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
                        <label for="eventID">ID</label>
                        <input type="text" class="form-control" id="eventID" name="eventID" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="event-start">Start Date</label>
                        <input type="datetime-local" class="form-control" id="event-start-date" name="event-start-date" required>
                    </div>
                    <div class="form-group">
                        <label for="event-end">End Date</label>
                        <input type="datetime-local" class="form-control" id="event-end-date" name="event-end-date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="edit-save-event">Save Changes</button>
                    <button type="button" class="btn btn-danger" id="delete-event">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/plugins/fullcalendar/main.js"></script>
<script>
    $(function() {
        var calendarEl = document.getElementById('calendar');
        var calendar;

        function initializeCalendar(eventsData) {
            // console.log(eventsData);
            calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
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
                dateClick: handleDateClick,
                eventClick: handleEventClick
            });

            calendar.render();
        }

        function handleDateClick(info) {
            var clickedDate = info.date;
            var fullDay = info.allDay;
            $('#all-day').val(fullDay.toString());
            $('#event-start').val(formatDate(clickedDate));
            $('#event-end').prop('readonly', fullDay);
            $('#addEventModal').modal('show');
        }

        function handleEventClick(info) {
            console.log(info.event);
            var id_event = info.event.id;
            var fullDay = info.event.allDay;
            var title = info.event.title;
            var colorId = info.event.extendedProps.colorId;
            var startDate = info.event.start;
            var endDate = info.event.end;

            $('#eventDetailModal .modal-title').text(title);
            $('#eventDetailModal #eventID').val(id_event);

            if (startDate) {
                $('#eventDetailModal #event-start-date').val(formatDate(startDate));
            } else {
                $('#eventDetailModal #event-start-date').val('N/A');
            }

            if (endDate) {
                $('#eventDetailModal #event-end-date').val(formatDate(endDate));
            } else {
                $('#eventDetailModal #event-end-date').val('N/A');
            }
            $('#eventDetailModal #event-end-date').prop('readonly', fullDay);
            $('#eventDetailModal').modal('show');

        }

        // Delete bro
        function handleDeleteEvent() {
            var eventId = $('#eventID').val();
            if (confirm('Are you sure you want to delete this event?')) {
                $.ajax({
                    url: '<?= base_url(); ?>DeleteEvent',
                    type: 'POST',
                    data: {
                        event_id: eventId,
                    },
                    success: function(response) {
                        // console.log(response);
                        var event = calendar.getEventById(eventId);
                        if (event) {
                            event.remove();
                        }
                        $('#editEventModal').modal('hide');
                        $('#eventDetailModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }
        }
        // Batas Delete bro

        // Untuk update bro
        function updateEventDates(eventId, startDate, endDate) {
            $.ajax({
                url: '<?= base_url(); ?>UpdateEvent',
                type: 'POST',
                data: {
                    event_id: eventId,
                    start_date: startDate,
                    end_date: endDate,
                    flag: '1',
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        $(document).on('click', '#edit-save-event', function() {
            var eventId = $('#eventID').val();
            var startDateTime = $('#event-start-date').val();
            var endDateTime = $('#event-end-date').val();

            // Panggil fungsi untuk memperbarui detail event
            updateEventDates(eventId, startDateTime, endDateTime);
            refreshCalendar();
            $('#eventDetailModal').modal('hide');
        });
        // Batas update bro

        // CREATE
        $(document).on('click', '#save-add-event', function() {
            var title = $('#event-title').val();
            var color = $('#event-color').val();
            var allDay = $('#all-day').val();
            var startDate = $('#event-start').val();
            var endDate = $('#event-end').val();

            var eventData = {
                title: title,
                color: color,
                allDay: Boolean(allDay === "true"),
                start: startDate,
                end: endDate
            };

            addEventCalendar(eventData);
        });

        function addEventCalendar(eventData) {
            // console.log(eventData.allDay);
            $.ajax({
                url: '<?= base_url(); ?>AddEvent',
                type: 'POST',
                data: eventData,
                success: function(response) {
                    console.log(response);
                    refreshCalendar();
                    calendar.addEvent(eventData);
                    $('#addEventModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
        // BATAS CREATE

        // Tools select
        function getEventColors() {
            $.ajax({
                url: "<?= base_url() ?>GetEventColor",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var colorSelect = $('#edit-external-event-color');
                    var colorSelectEvent = $('#event-color');

                    response.forEach(function(color) {
                        var colorOption = $('<option></option>')
                            .attr('value', color.background_color)
                            .text(color.background_color)
                            .css('background-color', color.background_color);

                        colorSelect.append(colorOption);
                        colorSelectEvent.append(colorOption);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
        // Batas tools select

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
            // Tools Select
            $('#all-day').on('change', function() {
                var allDayValue = $(this).val();
                console.log(allDayValue);
                $('#event-end').prop('readonly', (allDayValue === 'true'));
            });
            // Batas Tools Select
            // CRUD
            $(document).on('click', '#delete-event', handleDeleteEvent);

            // Main progress
            isiCalendar();
            getEventColors();
        });
    });
</script>