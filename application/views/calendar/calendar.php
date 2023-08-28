<style>
    body {
        height: 100%;
    }

    .overlay {
        display: flex;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        justify-content: center;
        align-items: center;
    }
</style>
<div class="overlay" id="loading-overlay">
    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
</div>

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
        <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px);">
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-body">
                        <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap">
                            <!-- Konten kalender akan dirender di sini -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Untuk Add Event -->
    <div class="modal fade" id="addEventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ADD Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="x">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="event-title">Event Title</label>
                            <input type="text" class="form-control" id="event-title" name="event-title" placeholder="Event Title Here" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="all-day">All Day</label>
                                <select class="form-control" name="all-day" id="all-day" required>
                                    <option value="" selected disabled>-- Choose Day --</option>
                                    <option value="false">No</option>
                                    <option value="true">Yes</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="event-color">Event Color</label>
                                <select class="form-control" id="event-color" name="event-color" required></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="event-start">Start Date</label>
                                <input class="form-control" id="event-start" name="event-start" required>
                            </div>
                            <div class="col-md-6">
                                <label for="event-end">End Date</label>
                                <input class="form-control" id="event-end" name="event-end" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event-note">Event Note</label>
                            <textarea type="text" class="form-control" id="event-note" name="event-note" placeholder="Event Note Here" required></textarea>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="share-checkbox">
                                    Share with others
                                </label>
                            </div>
                            <div id="shared-member-div">
                                <select class="form-control" id="shared-members" name="shared-members[]" multiple="multiple"></select>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="location-checkbox">
                                    Location
                                </label>
                            </div>
                            <div id="location-div">
                                <input type="text" class="form-control" id="event-location" name="event-location" placeholder="Event Location Here">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="save-add-event">Add Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Untuk edit dan detail event -->
    <div class="modal fade" id="eventDetailModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Event Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="creatorDiv">
                    <div class="form-group" style="display: none;">
                        <label for="eventID">ID</label>
                        <input type="text" class="form-control" id="eventID" name="eventID" required readonly>
                        <input type="text" class="form-control" id="creationDate" name="creationDate" required readonly>
                    </div>
                    <div class="form-group">
                        <strong><i class="far fa-calendar mr-1"></i> Start Date</strong>
                        <input class="form-control" id="event-start-date" name="event-start-date" required>
                    </div>
                    <div class="form-group">
                        <strong><i class="far fa-calendar mr-1"></i> End Date</strong>
                        <input class="form-control" id="event-end-date" name="event-end-date" required>
                    </div>
                    <div class="form-group">
                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <textarea type="text" class="form-control" id="event-note-date" name="event-note-date" placeholder="Event Note Here" required></textarea>
                    </div>
                    <div class="form-group" id="event-location-date-div">
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        <textarea type="text" class="form-control" id="event-location-date" name="event-location-date" placeholder="Event Location Here" required></textarea>
                    </div>
                </div>
                <div class="modal-body" id="notcreatorDiv">
                    <div class="form-group" style="display: none;">
                        <label for="eventIDOther">ID</label>
                        <p class="text-muted" id="eventIDOther" name="eventIDOther"></p>
                    </div>
                    <div class="form-group">
                        <strong><i class="far fa-calendar mr-1"></i> Start Date</strong>
                        <p class="text-muted" id="event-start-other" name="event-start-other"> </p>
                    </div>
                    <hr>
                    <div class="form-group" id="event-end-date-div">
                        <strong><i class="far fa-calendar mr-1"></i> End Date</strong>
                        <p class="text-muted" id="event-end-other" name="event-end-other"> </p>
                    </div>
                    <hr>
                    <div class="form-group">
                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted" id="event-note-other" name="event-note-other"> </p>
                    </div>
                    <hr>
                    <div class="form-group" id="event-location-other-div">
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        <p class="text-muted" id="event-location-other" name="event-location-other"> </p>
                    </div>
                </div>
                <div class="modal-footer" id="footerDetail">
                    <button type="button" class="btn btn-danger" id="delete-event">Delete</button>
                    <button type="button" class="btn btn-primary" id="edit-save-event">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/plugins/fullcalendar/main.js"></script>
<script>
    $('#loading-overlay').show();

    var memberID = <?= json_encode($this->session->userdata('member_id')) ?>;
    $(document).ready(function() {
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

        // Untuk click clik calendar
        function handleDateClick(info) {
            $('#loading-overlay').show();
            var clickedDate = info.date;
            var fullDay = info.allDay;
            console.log(info);

            $('#event-title').val('');
            $('#event-start').val(formatDate(clickedDate));
            $('#all-day').val(fullDay.toString());
            $('#all-day').on('change', function() {
                checkAllDay(info);
            });
            checkAllDay(info);
            $('#event-note').val('');
            $('#location-checkbox').on('change', toogleLocDiv);
            toogleLocDiv();
            $('#event-location').val('');
            $('#share-checkbox').on('change', toogleShareDiv);
            toogleShareDiv();
            $('#shared-members').val([]).trigger('change');
            $('#shared-members').select2({
                placeholder: '-- Choose Members --',
                allowClear: true,
                minimumInputLength: 0,
                data: [
                    <?php foreach ($memberRecords as $key) { ?> {
                            id: "<?= $key->member_id ?>",
                            text: "<?= $key->member_name ?>"
                        },
                    <?php } ?>
                ]
            });
            $('#loading-overlay').hide();
            $('#addEventModal').modal('show');
        }

        function handleEventClick(info) {
            const {
                id,
                allDay,
                title,
                start,
                startStr,
                end,
                endStr,
                extendedProps: {
                    notes,
                    location,
                    creator,
                    creationDate
                }
            } = info.event;

            const isCreator = (memberID === creator);
            const linkNotes = formatNotes(notes);

            $('#loading-overlay').show();
            $('#eventDetailModal .modal-title').text(title);
            $('#eventDetailModal #creationDate').val(creationDate);

            if (isCreator) {
                $('#eventDetailModal #creatorDiv').show();
                $('#eventDetailModal #notcreatorDiv').hide();
                $('#eventDetailModal #eventID').val(id);

                if (allDay) {
                    $('#eventDetailModal #event-start-date, #eventDetailModal #event-end-date').attr('type', 'date');
                    if (startStr) {
                        $('#eventDetailModal #event-start-date, #eventDetailModal #event-end-date').val(startStr);
                    } else {
                        $('#eventDetailModal #event-start-date').hide();
                    }
                } else {
                    $('#eventDetailModal #event-start-date, #eventDetailModal #event-end-date').attr('type', 'datetime-local');
                    if (start) {
                        $('#eventDetailModal #event-start-date').val(formatDate(start));
                    } else {
                        $('#eventDetailModal #event-start-date').hide();
                    }

                    if (end) {
                        $('#eventDetailModal #event-end-date').val(formatDate(end));
                    } else {
                        $('#eventDetailModal #event-end-date').hide();
                    }
                }

                if (location) {
                    $('#eventDetailModal #event-location-date').val(location);
                } else {
                    $('#eventDetailModal #event-location-date-div').hide();
                }
                $('#eventDetailModal #event-note-date').val(notes);
                $('#eventDetailModal #footerDetail').show();
            } else {
                $('#eventDetailModal #notcreatorDiv').show();
                $('#eventDetailModal #creatorDiv').hide();
                $('#eventDetailModal #footerDetail').hide();
                $('#eventDetailModal #eventIDOther').text(id);

                if (allDay) {
                    $('#eventDetailModal #event-start-other, #eventDetailModal #event-end-other').text(startStr);
                } else {
                    $('#eventDetailModal #event-start-other, #eventDetailModal #event-end-other').attr('type', 'datetime-local');
                    if (start) {
                        $('#eventDetailModal #event-start-other').text(formatDate(start));
                    } else {
                        $('#eventDetailModal #event-start-other').hide();
                    }

                    if (end) {
                        $('#eventDetailModal #event-end-other').text(formatDate(end));
                    } else {
                        $('#eventDetailModal #event-end-other').hide();
                    }
                }

                if (location) {
                    $('#eventDetailModal #event-location-other').text(location);
                } else {
                    $('#eventDetailModal #event-location-other-div').hide();
                }
                $('#eventDetailModal #event-note-other').html(linkNotes);
            }

            $('#loading-overlay').hide();
            $('#eventDetailModal').modal('show');
        }

        // Batas click calendar

        // Delete bro
        $(document).on('click', '#delete-event', function() {
            var eventTitle = $('#eventDetailModal .modal-title').text();
            var startDate = $('#eventDetailModal #event-start-date').val();
            var eventNote = $('#eventDetailModal #event-note-date').val();

            var eventDel = {
                eventTitle: eventTitle,
                start: startDate,
                eventNote: eventNote,
                p_flag: 1,
            }
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loading-overlay').show();
                    handleDeleteEvent(eventDel);
                }
            });
        })

        function handleDeleteEvent(eventDel) {
            var eventId = $('#eventDetailModal #eventID').val();
            $.ajax({
                url: '<?= base_url(); ?>DeleteEvent',
                type: 'POST',
                data: eventDel,
                success: function(response) {
                    console.log(calendar);
                    var event = calendar.getEventById(eventId);
                    if (event) {
                        event.remove();
                    }
                    $('#eventDetailModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                complete: function() {
                    $('#loading-overlay').hide();
                }
            });

        }

        // Batas Delete bro

        // Untuk update bro
        $(document).on('click', '#edit-save-event', function() {
            $('#edit-save-event').prop('disabled', true);
            $('#loading-overlay').show();
            var eventId = $('#eventID').val();
            var eventTitle = $('#eventDetailModal .modal-title').text();
            var creationDate = $('#creationDate').val();
            var startDateTime = $('#event-start-date').val();
            var endDateTime = $('#event-end-date').val();
            var noteDate = $('#event-note-date').val();
            var locDate = $('#event-location-date').val();

            var eventUpdate = {
                title: eventTitle,
                creationDate: creationDate,
                start: startDateTime,
                end: endDateTime,
                eventNote: noteDate,
                eventLoc: locDate,
                flag: 2
            };
            updateEventDates(eventUpdate);
        });

        function updateEventDates(eventUpdate) {
            $.ajax({
                url: '<?= base_url(); ?>UpdateEvent',
                type: 'POST',
                data: eventUpdate,
                success: function(response) {
                    refreshCalendar();
                    $('#eventDetailModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                complete: function() {
                    $('#loading-overlay').hide();
                }
            });
        }
        // Batas update bro

        // CREATE
        $(document).on('click', '#save-add-event', function() {
            $('#save-add-event').prop('disabled', true);
            $('#loading-overlay').show();

            var title = $('#event-title').val();
            var color = $('#event-color').val();
            var allDay = $('#all-day').val();
            var startDate = $('#event-start').val();
            var endDate = $('#event-end').val();
            var eventNote = $('#event-note').val();
            var location = $('#event-location').val();
            var shareTo = $('#shared-members').val();
            var groupId = $('#group-id').val();

            var eventData = {
                title: title,
                color: color,
                allDay: Boolean(allDay === "true"),
                start: startDate,
                end: endDate,
                eventNote: eventNote,
                eventLoc: location,
                shareTo: JSON.stringify(shareTo),
                groupId: groupId
            };

            addEventCalendar(eventData);
        });


        function addEventCalendar(eventData) {
            // console.log(eventData);
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
                },
                complete: function() {
                    $('#loading-overlay').hide();
                }
            });
        }
        // BATAS CREATE

        // Tools select
        function checkAllDay(info) {
            var theDay = $('#all-day').val() === 'true';
            if (theDay) {
                $('#addEventModal #event-start').attr('type', 'date');
                $('#addEventModal #event-end').attr('type', 'date');
                $('#addEventModal #event-start').val(info.dateStr);
                $('#addEventModal #event-end').val('');
            } else {
                $('#addEventModal #event-start').attr('type', 'datetime-local');
                $('#addEventModal #event-end').attr('type', 'datetime-local');
                $('#addEventModal #event-start').val(formatDate(info.date));
                $('#addEventModal #event-end').val(formatDate(info.date));
            }
        }

        function toogleShareDiv() {
            var shareMemberDiv = $('#shared-member-div');
            var isChecked = $('#share-checkbox').prop('checked');

            if (isChecked) {
                shareMemberDiv.show();
            } else {
                shareMemberDiv.hide();
            }
        }

        function toogleLocDiv() {
            var locationDiv = $('#location-div');
            var isChecked = $('#location-checkbox').prop('checked');

            if (isChecked) {
                locationDiv.show();
            } else {
                locationDiv.hide();
            }
        }

        function getEventColors() {
            $.ajax({
                url: "<?= base_url() ?>GetEventColor",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var colorSelectEvent = $('#event-color');
                    response.forEach(function(color) {
                        var colorOption = $('<option></option>')
                            .attr('value', color.background_color)
                            .text(color.name_color)
                            .css('background-color', color.background_color);
                        colorSelectEvent.append(colorOption);
                    });

                    colorSelectEvent.on('change', function() {
                        var selectedColor = $(this).val();
                        $('#save-add-event').css('background-color', selectedColor);
                        $('#save-add-event').css('border-color', selectedColor);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                complete: function() {
                    // Setelah permintaan AJAX selesai, termasuk jika terjadi error
                    $('#loading-overlay').hide();
                }
            });
        }
        // Batas tools select

        // Tools untuk progressing
        function formatNotes(notes) {
            const urlRegex = /(https?:\/\/[^\s]+)/g; // Regular expression to match URLs
            return notes.replace(urlRegex, '<a href="$&" target="_blank">$&</a>');
        }

        function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            var hours = date.getHours().toString().padStart(2, '0');
            var minutes = date.getMinutes().toString().padStart(2, '0');

            return year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
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
                },
                complete: function() {
                    // Setelah permintaan AJAX selesai, termasuk jika terjadi error
                    $('#loading-overlay').hide();
                }
            });
        }
        // Batas tools untuk progressing

        // Main progress
        isiCalendar();
        getEventColors();
    });
</script>

<?php if ($this->session->flashdata('success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?= $this->session->flashdata('success') ?>',
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: toast => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    <?php $this->session->unset_userdata('success'); ?>
<?php elseif ($this->session->flashdata('error')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?= $this->session->flashdata('error') ?>',
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: toast => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    <?php $this->session->unset_userdata('error'); ?>
<?php endif; ?>