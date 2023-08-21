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
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Draggable Events</h4>
                            </div>
                            <div class="card-body">
                                <div id="external-events">
                                </div>
                                <label for="drop-remove">
                                    <input type="checkbox" id="drop-remove">
                                    remove after drop
                                </label>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create Event</h3>
                            </div>
                            <div class="card-body">
                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                    <ul class="fc-color-picker" id="color-chooser">
                                    </ul>
                                </div>
                                <div class="input-group">
                                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                                    <div class="input-group-append">
                                        <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
    <div class="modal fade" id="editExternalEventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit External Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-external-event-form">
                        <div class="form-group">
                            <label for="edit-external-event-title">Event Title</label>
                            <input type="text" class="form-control" id="edit-external-event-title" name="edit-external-event-title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-external-event-color">Event Color</label>
                            <select class="form-control" id="edit-external-event-color" name="edit-external-event-color" required>
                                <!-- Options for event colors -->
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save-edit-external-event">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editEventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-event-form">
                        <div class="form-group">
                            <label for="edit-event-title">Event Title</label>
                            <input type="text" class="form-control" id="edit-event-title" name="edit-event-title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-event-color">Event Color</label>
                            <select class="form-control" id="edit-event-color" name="edit-event-color" required>
                                <!-- Options for event colors -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-event-start">Start Date</label>
                            <input type="text" class="form-control" id="edit-event-start" name="edit-event-start" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-event-end">End Date</label>
                            <input type="text" class="form-control" id="edit-event-end" name="edit-event-end" required>
                        </div>

                        <input type="hidden" id="edit-event-id" name="edit-event-id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete-event">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-edit-event">Save Changes</button>
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
                    <p id="event-color-id">Color ID: </p>
                    <p id="event-start-date">Start Date: </p>
                    <p id="event-end-date">End Date: </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/plugins/fullcalendar/main.js"></script>
<script>
    $(function() {
        var containerEl = document.getElementById('external-events');
        var calendarEl = document.getElementById('calendar');
        var checkbox = document.getElementById('drop-remove');
        var calendar;

        function initializeCalendar(eventsData) {
            // Menangani drag dari external event menuju ke kalender
            new FullCalendar.Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {

                    return {
                        id: eventEl.colorId,
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('border-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });

            calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay"
                },
                validRange: {
                    start: '2023-01-01',
                    end: '2023-12-31'
                },
                slotMinTime: '06:00:00',
                slotMaxTime: '22:00:00',
                themeSystem: "bootstrap",
                events: eventsData,
                editable: true,
                droppable: true,
                eventDrop: handlePositionDrop, // Untuk update
                eventClick: handleEventClick,
                eventReceive: function(info) {
                    var event = info.event;
                    var title = event.title;
                    var backgroundColor = event.backgroundColor;
                    var borderColor = event.borderColor;
                    var startStr = event.startStr;
                    var endStr = event.endStr;
                    var allDay = event.allDay;
                    var backgroundColorHex = rgbToHex(backgroundColor);
                    var borderColorHex = rgbToHex(borderColor);

                    // Ambil informasi dari elemen HTML yang di-drop
                    var droppedEventTitle = $(info.draggedEl).data('title');
                    var droppedEventId = $(info.draggedEl).data('ex_id');

                    $.ajax({
                        url: '<?= base_url() ?>AddEvent',
                        type: 'POST',
                        data: {
                            title: title,
                            background_color: backgroundColorHex,
                            border_color: borderColorHex,
                            start_date: startStr,
                            end_date: endStr,
                            all_day: allDay,
                        },
                        success: function(response) {
                            console.log('Event added successfully:', response);
                            if ($('#drop-remove').prop('checked')) {
                                $(info.draggedEl).remove(); // Hapus elemen yang di-drop
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('Error adding event:', error);
                        }
                    });

                    if (checkbox == 'checked') {

                    }
                },

            });

            calendar.render();

            $(document).on('click', '#add-new-event', handleAddNewExternalEvent);
            $(document).on('click', '#color-chooser li a', handleColorChooserClick);
            $(document).on('click', '#save-edit-event', handleSaveEditEvent);
            $(document).on('click', '#delete-event', handleDeleteEvent);
            $('#edit-event-start, #edit-event-end').datepicker({
                dateFormat: 'yy-mm-dd',
            });

            // Menadapatkan seluruh tampilan utama
            // Batas
            // CRUD


        }

        $(document).on('click', '#external-events .external-event', handleExternalEventClick);

        function handleExternalEventClick() {
            $('#external-events .external-event').removeClass('active');
            // Menambahkan kelas .active ke elemen yang diklik
            $(this).addClass('active');
            var colorBack = $(this).data('backgroundColor'); // Pastikan ini mengambil nilai yang sesuai
            var eventTitle = $(this).data('title');
            var exId = $(this).data('id');
            // console.log($(this).data());

            // Mengisi nilai modal edit
            $('#edit-external-event-title').val(eventTitle);
            $('#edit-external-event-color').val(colorBack); // Set nilai select sesuai colorId

            // Menampilkan modal edit
            $('#editExternalEventModal').modal('show');
        }

        function handlePositionDrop(eventDropInfo) {
            // console.log(eventDropInfo)
            var event = eventDropInfo.event;
            var newStartDate = event.startStr;
            var newEndDate = event.endStr;
            updateEventDates(event.id, newStartDate, newEndDate);
        }

        function handleEventClick(info) {
            console.log(info.event);
            var id_event = info.event.id;
            var title = info.event.title;
            var colorId = info.event.extendedProps.colorId;
            var startDate = info.event.start;
            var endDate = info.event.end;

            $('#eventDetailModal .modal-title').text(title);
            $('#eventDetailModal #event-color-id').text('Color ID: ' + colorId);

            if (startDate) {
                $('#eventDetailModal #event-start-date').text('Start Date: ' + startDate.toLocaleString());
            } else {
                $('#eventDetailModal #event-start-date').text('Start Date: N/A');
            }

            if (endDate) {
                $('#eventDetailModal #event-end-date').text('End Date: ' + endDate.toLocaleString());
            } else {
                $('#eventDetailModal #event-end-date').text('End Date: N/A');
            }

            $('#eventDetailModal').modal('show');

        }

        $(document).on('click', '#save-edit-external-event', function() {
            var newEventTitle = $('#edit-external-event-title').val();
            var newEventColorId = $('#edit-external-event-color').val();
            var selectedExternalEvent = $('#external-events .external-event.active');

            // console.log(newEventTitle + "   " + newEventColorId + " Selected:  " + selectedExternalEvent);
            if (selectedExternalEvent.length > 0) {
                selectedExternalEvent.text(newEventTitle);
                selectedExternalEvent.data('title', newEventTitle);

                // Update data-color-id dengan nilai yang dipilih dari elemen select
                selectedExternalEvent.data('color-id', newEventColorId);

                // Mengambil warna dari elemen select (misalnya Anda memberikan atribut data-color="#FF0000")
                selectedExternalEvent.css({
                    'background-color': newEventColorId,
                    'border-color': newEventColorId,
                    'color': '#fff',
                });

                $('#editExternalEventModal').modal('hide');
            }
        });



        function handleAddNewExternalEvent(e) {
            e.preventDefault();
            var val = $('#new-event').val();
            var backgroundColor = $('#color-chooser li a.active').css('color');
            var borderColor = $('#color-chooser li a.active').css('border-color');
            if (val.length === 0) {
                return;
            }
            var backgroundColorHex = rgbToHex(backgroundColor);
            var borderColorHex = rgbToHex(borderColor);

            $.ajax({
                url: '<?= base_url() ?>AddExternalEvent',
                type: 'POST',
                data: {
                    eventTitle: val,
                    background_color: backgroundColorHex,
                    border_color: borderColorHex,
                },
                success: function(response) {
                    // console.log(response);
                    var event = $('<div class="external-event ui-draggable ui-draggable-handle"></div>');
                    event.text(val);
                    event.css({
                        'background-color': backgroundColor,
                        'border-color': backgroundColor,
                        'color': '#fff'
                    }).addClass('external-event');
                    event.data('event', {
                        title: val,
                        backgroundColor: backgroundColor,
                        borderColor: backgroundColor,
                        colorId: response.colorId // Assuming the response contains the new colorId
                    });
                    event.draggable({
                        zIndex: 999,
                        revert: true,
                        revertDuration: 0
                    });

                    $('#external-events').prepend(event);
                    $('#new-event').val('');

                    calendar.refetchEvents();
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                }
            });
        }

        function getEventColor(colorId) {
            $.ajax({
                url: '<?= base_url() ?>GetEventColor',
                type: 'POST',
                data: {
                    color_id: colorId,
                },
                success: function(response) {
                    var colorData = JSON.parse(response);
                    var backgroundColor = colorData.background_color;
                    var borderColor = colorData.border_color;

                    var event = $('<div/>');
                    event.css({
                        'background-color': backgroundColor,
                        'border-color': borderColor,
                        'color': '#fff'
                    }).addClass('external-event');

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        function updateEventColor(eventElement, colorId) {
            $.ajax({
                url: '<?= base_url() ?>GetEventColor',
                type: 'POST',
                data: {
                    color_id: colorId,
                },
                success: function(response) {
                    var colorData = JSON.parse(response);
                    var backgroundColor = colorData.background_color;
                    var borderColor = colorData.border_color;

                    eventElement.css({
                        'background-color': backgroundColor,
                        'border-color': borderColor,
                        'color': '#fff'
                    });

                    var colorLabel = $('<div class="event-color-label"></div>').css({
                        'background-color': backgroundColor,
                        'border-color': borderColor,
                    });
                    eventElement.prepend(colorLabel);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        function handleSaveEditEvent() {
            var eventId = $('#edit-event-id').val();
            var newTitle = $('#edit-event-title').val();
            var newColorId = $('#edit-event-color').val();
            var newStartDate = $('#edit-event-start').val();
            var newEndDate = $('#edit-event-end').val();

            $.ajax({
                url: '<?= base_url(); ?>UpdateEvent',
                type: 'POST',
                data: {
                    color_id: newColorId,
                    event_id: eventId,
                    start_date: newStartDate,
                    end_date: newEndDate,
                    flag: '0',
                },
                success: function(response) {
                    // console.log(response);
                    var event = calendar.getEventById(eventId);
                    console.log(event);
                    event.setProp('title', newTitle);
                    event.setProp('colorId', newColorId);
                    event.setStart(newStartDate);
                    event.setEnd(newEndDate);
                    updateEventColor(event, newColorId);
                    $('#editEventModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
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
            var eventId = $('#edit-event-id').val();

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
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }
        }

        // Tampilan isi kalender sekarang
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

        $.ajax({
            url: "<?= base_url() ?>GetExternalEvent",
            type: "GET",
            dataType: "json",
            success: function(response) {
                // console.log(response);
                response.forEach(function(event) {
                    // console.log(event);
                    var externalEvent = $('<div class="external-event ui-draggable ui-draggable-handle"></div>');
                    externalEvent.text(event.title);
                    externalEvent.data('title', event.title);
                    externalEvent.data('color-id', event.colorId);
                    externalEvent.data('backgroundColor', event.backgroundColor);
                    externalEvent.data('borderColor', event.borderColor);
                    externalEvent.attr('data-ex_id', event.ex_id);
                    externalEvent.data('textColor', '#fff');
                    externalEvent.attr('data-title', event.title);
                    externalEvent.attr('data-id', event.ex_id);

                    externalEvent.css({
                        'background-color': event.backgroundColor,
                        'border-color': event.borderColor,
                        'color': '#fff',
                    });
                    externalEvent.draggable({
                        zIndex: 999,
                        revert: true,
                        revertDuration: 0
                    });

                    $('#external-events').append(externalEvent);
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });

        function handleColorChooserClick(e) {
            e.preventDefault();
            $('#color-chooser li a').removeClass('active');
            $(this).addClass('active');
            // Ambil warna aktif dari color-chooser
            var activeColor = $(this).css('color');
            var activeBorder = $(this).css('border-color');
            // Ubah warna tombol add-new-event
            $('#add-new-event').css('background-color', activeColor);
            $('#add-new-event').css('border-color', activeBorder);
        }

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

                    response.forEach(function(color) {
                        var colorOption = $('<option></option>')
                            .attr('value', color.background_color)
                            .text(color.background_color)
                            .css('background-color', color.background_color);

                        colorSelect.append(colorOption);
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