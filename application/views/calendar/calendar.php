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
                            <input type="text" class="form-control" id="event-title" name="event-title" required>
                        </div>
                        <div class="form-group">
                            <label for="event-color">Event Color</label>
                            <select class="form-control" id="event-color" name="event-color" required>
                                <!-- Options for event colors -->
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

                        <input type="hidden" id="event-id" name="event-id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-add-event">Save Changes</button>
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

        function handleDateClick(info) {
            var clickedDate = info.date;

            // Menghitung end date dengan menambahkan 1 jam ke start date
            var endDate = new Date(clickedDate);
            endDate.setHours(endDate.getHours() + 1);

            // Mengambil komponen tanggal, bulan, tahun, jam, dan menit
            var year = clickedDate.getFullYear();
            var month = (clickedDate.getMonth() + 1).toString().padStart(2, '0');
            var day = clickedDate.getDate().toString().padStart(2, '0');
            var hours = clickedDate.getHours().toString().padStart(2, '0');
            var minutes = clickedDate.getMinutes().toString().padStart(2, '0');

            // Format tanggal dan waktu sesuai dengan format datetime-local
            var formattedStartDate = `${year}-${month}-${day}T${hours}:${minutes}`;
            var formattedEndDate = `${year}-${month}-${day}T${endDate.getHours()}:${endDate.getMinutes()}`;

            $('#event-start').val(formattedStartDate);
            $('#event-end').val(formattedEndDate);

            $('#addEventModal').modal('show');
        }


        function initializeCalendar(eventsData) {
            // Menangani drag dari event menuju ke kalender
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

            $(document).on('click', '#delete-event', handleDeleteEvent);
            $('#edit-event-start, #edit-event-end').datepicker({
                dateFormat: 'yy-mm-dd',
            });

            // Menadapatkan seluruh tampilan utama
            // Batas
            // CRUD


        }

        function handleEventClick(info) {
            console.log(info.event);
            var id_event = info.event.id;
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


            $('#eventDetailModal').modal('show');

        }

        function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            var hours = date.getHours().toString().padStart(2, '0');
            var minutes = date.getMinutes().toString().padStart(2, '0');

            return `${year}-${month}-${day}T${hours}:${minutes}`;
        }

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

        $(document).on('click', '#edit-save-event', function() {
            var eventId = $('#eventID').val();
            var startDateTime = $('#event-start-date').val();
            var endDateTime = $('#event-end-date').val();

            // Panggil fungsi untuk memperbarui detail event
            updateEventDates(eventId, startDateTime, endDateTime);
            refreshCalendar();
            $('#eventDetailModal').modal('hide');
        });

        function refreshCalendar() {
            // Hapus kalender yang ada sebelumnya
            calendar.destroy();
            // Inisialisasi ulang kalender dengan data yang baru
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
        isiCalendar();

        $.ajax({
            url: "<?= base_url() ?>GetEventColor",
            type: "GET",
            dataType: "json",
            success: function(response) {
                response.forEach(function(color) {
                    var colorOption = $('<li><a href="#"><i class="fas fa-square"></i></a></li>');
                    colorOption.find('a').css('color', color.background_color);
                    colorOption.find('a').css('border-color', color.border_color);
                    colorOption.data('color-id', color.id);
                    $('#color-chooser').append(colorOption);
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });

        // mengubah RGB to HEX
        function rgbToHex(rgb) {
            var parts = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            delete(parts[0]);
            for (var i = 1; i <= 3; ++i) {
                parts[i] = parseInt(parts[i]).toString(16);
                if (parts[i].length == 1) parts[i] = '0' + parts[i];
            }
            return '#' + parts.join('');
        }


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

        // Panggil fungsi untuk mendapatkan pilihan warna saat halaman dimuat
        getEventColors();
    });
</script>