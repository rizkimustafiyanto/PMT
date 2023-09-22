<div class="content-wrapper">
    <div style="height: 20px;"></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-sm card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3>All Project</h3>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" class="btn btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-project">
                                        <i class="fa fa-plus"></i> Add Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="tblProject" class="table table-bordered table-striped small">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Project Name</th>
                                        <th>Team Member</th>
                                        <th>Project Progress</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($ProjectRecords)) :
                                        foreach ($ProjectRecords as $index => $record) :
                                            $percent = $record->percentage;
                                            $percent = (empty($percent)) ? 0 : $percent;
                                            if (strlen($percent) > 4) {
                                                $percent = number_format($percent, 2);
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td>
                                                    <div><?= $record->project_name; ?></div>
                                                    <div>Created : <?= (new DateTime($record->creation_datetime))->format('Y-m-d'); ?></div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?php foreach ($ProjectMemberRecords as $row) {
                                                        if ($record->project_id == $row->project_id) : ?>
                                                            <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($row->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 30px; height: 30px;" title="<?= $row->member_name ?>">
                                                    <?php endif;
                                                    }; ?>
                                                </td>
                                                <td>
                                                    <div class="progress-group">
                                                        <div class="progress progress-sm">
                                                            <div class="progress-bar <?= ($percent < 100) ? 'bg-primary' : 'bg-success'; ?>" style="width: <?= $percent; ?>%"></div>
                                                        </div>
                                                        <span class="float-center"><b><?= $percent; ?> % Complete</b></span>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a class="badge <?= ($record->status_id == 'STW-1') ? 'badge-warning' : 'badge-success'; ?> float"><?= $record->name_project_status ?></a>
                                                </td>
                                                <td class="text-center">
                                                    <a id="btnSelect" class="btn btn-xs btn-info" href="<?= base_url() . 'List/' . $record->project_id; ?>"><i class="fa fa-eye"></i></a>
                                                    <?php if (($member_id == 'System' || $record->member_type_id == 'MT-1') && $record->status_id != 'STW-2') : ?>
                                                        <a class="btn btn-xs btn-danger" id="btnDeleteProject" data-project-id="<?= $record->project_id; ?>"><i class="fa fa-trash"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                    <?php endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-input-project">
        <div class="modal-dialog" style="max-width: 920px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Project</h4>
                </div>
                <form id="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card card-info card-outline" style="max-height: 300px;">
                                    <div class="card-header">
                                        <h5 class="card-title" style="width: 90%;"><input type="text" id="project_name" class="form-control" placeholder="Project Name" required></h5>
                                        <div class="card-tools">
                                            <div style="margin-top: 5px; margin-right: 10px;"><i class="fa fa-pen" style="color: gray;"></i></div>
                                        </div>
                                    </div>
                                    <textarea class="editor" name="project_description" id="project_description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="project_type" class="mr-2">Project Type</label>
                                    <select class="form-control select2bs4" name="project_type" id="project_type" required>
                                        <option value="" selected disabled>-- Select an option --</option>
                                        <?php foreach ($ProjectTypeRecords as $row) : ?>
                                            <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="startProject">Start Date</label>
                                            <input type="date" class="form-control" id="project_start" required>
                                        </div>
                                        <div class="col">
                                            <label for="endProject">End Date</label>
                                            <input type="date" class="form-control" id="project_due" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="AssignMember" class="mr-2">Assign Member</label>
                                    <select class="form-control" id="members_project" name="members_project[]" multiple="multiple"></select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" id="AddProject">Save Project</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#btnAdd', function() {
        handleClickAdd();
    })

    function colorSelect(member) {
        return $('<span style="color: blue;">' + member.text + '</span>');
    }

    function handleClickAdd() {
        $('#members_project').val([]).trigger('change');
        $('#members_project').select2({
            placeholder: '-- Choose Members --',
            allowClear: true,
            minimumInputLength: 0,
            data: [
                <?php foreach ($tempmember as $key) { ?> {
                        id: "<?= $key->member_id ?>",
                        text: "<?= $key->member_name ?>"
                    },
                <?php } ?>
            ],
            templateSelection: colorSelect
        });
    }



    $(document).on('click', '#AddProject', function() {
        var title = $('#project_name').val();
        var projectType = $('#project_type').val();
        var projectStart = $('#project_start').val();
        var projectDue = $('#project_due').val();
        var description = $('#project_description').summernote('code');
        var membersProject = $('#members_project').val();

        if (!title || !projectStart || !projectDue || !description || !projectType) {
            validasiInfo('Please complete all fields before inserting project!');
            return;
        }

        var AddProject = {
            title: title,
            projectType: projectType,
            start: projectStart,
            due: projectDue,
            description: description,
            membersProject: JSON.stringify(membersProject)
        };

        // TOOLS
        var addBtnProject = document.getElementById("AddProject");
        addBtnProject.disabled = true;
        addBtnProject.textContent = "Creating...";
        addBtnProject.classList.add("disabled");
        // console.log(AddProject);
        addProject(AddProject);
    })

    function addProject(AddProject) {
        $.ajax({
            url: '<?= base_url(); ?>InsertProject',
            type: 'POST',
            data: AddProject,
            success: function(response) {
                $('#modal-input-project').modal('hide');
                Swal.fire({
                    icon: response.status,
                    title: response.title,
                    text: response.message,
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: toast => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload(); // Reload the page
                    }
                });

            },
            error: function(xhr, status, error) {
                console.log(error);
            },
            complete: function() {
                $('#loading-overlay').hide();
            }
        });
    }

    $(document).on('click', '#btnDeleteProject', function() {
        var projectId = $(this).data("project-id");
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus proyek ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteProject(projectId);
            }
        });
    });

    function deleteProject(projectID) {
        $.ajax({
            url: '<?= base_url(); ?>DeleteProject',
            type: 'POST',
            data: {
                project_id: projectID
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response,
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: toast => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload(); // Reload the page
                    }
                });

            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function validasiInfo(message) {
        Swal.fire({
            icon: 'error',
            title: 'Peringatan',
            text: message,
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
    }
</script>

<script>
    $("#tblProject")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            order: [
                [0, "asc"]
            ]
        })
        .buttons()
        .container()
        .appendTo("#tblProject_wrapper .col-md-6:eq(0)");
</script>