<div class="content-wrapper">
    <div style="height: 15px;"></div>
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
                                        <th>Time</th>
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
                                            $encry_pro_id = enkripbro($record->project_id);
                                            $url = base_url() . 'Project/List/' . $encry_pro_id;
                                            $urlkanban = base_url() . 'Project/KanbanList/' . $encry_pro_id;

                                            $percent = $record->percentage;
                                            $percent = (empty($percent)) ? 0 : $percent;
                                            if (strlen($percent) > 4) {
                                                $percent = number_format($percent, 2);
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <?= $record->project_name; ?><br>
                                                            Created : <?= (new DateTime($record->creation_datetime))->format('d M y'); ?>
                                                        </div>
                                                        <div class="col-auto pin-button" data-project-id="<?= $record->project_id; ?>" title="Pin Project"><i class="<?= ($record->pin_pro == 1) ? 'fa-regular' : 'fa-solid'; ?> fa-bookmark"></i></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>Start : <?= ($record->start_date) ? (new DateTime($record->start_date))->format('d M y') : ''; ?></div>
                                                    <div>Due : <?= ($record->due_date) ? (new DateTime($record->due_date))->format('d M y') : ''; ?></div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?php foreach ($ProjectMemberRecords as $row) :
                                                        if ($record->project_id == $row->project_id) :
                                                            $avatar = $row->gender_id == 'GR-001' ? 'avatar5.png' : 'avatar3.png';
                                                            $photo_url = $row->photo_url;
                                                            if (empty($photo_url) || !file_exists(FCPATH . '../api-hris/upload/' . $photo_url)) {
                                                                $photo_url = 'assets/dist/img/' . $avatar;
                                                            } else {
                                                                $photo_url = '../api-hris/upload/' . $row->photo_url;
                                                            }
                                                    ?>
                                                            <img src="<?= base_url() . $photo_url ?>" alt="Image" class="rounded-circle elevation-1 profile-trigger" style="width: 30px; height: 30px;" title="<?= $row->member_name ?>" data-member-name="<?= $row->member_name ?>" data-member-company="<?= $row->company_name ?>" data-src="<?= base_url() . $photo_url ?>">
                                                    <?php
                                                        endif;
                                                    endforeach; ?>
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
                                                    <!-- <button class="btn btn-xs btn-info mr-1 pin-button" data-project-id="<?= $record->project_id; ?>" title="Pin Project"><i class="fa fa-thumbtack"></i></button> -->
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fas fa-bars"></i>
                                                        </button>
                                                        <div class="dropdown-menu" style="box-shadow: none; border-color: transparent; width: 50px;">
                                                            <a class="dropdown-item btn btn-xs" href="<?= $url ?>" title="View Detail" style="width: 60px;"><i class="fa fa-eye mr-1"></i>View</a>
                                                            <a class="dropdown-item btn btn-xs" href="<?= $urlkanban ?>" title="View Kanban" style="width: 60px;"><i class="fa fa-lg fa-brands fa-flipboard mr-1"></i>Board</a>
                                                            <?php if (($member_id == 'System' || $record->member_type_id == 'MT-1') && $record->status_id != 'STW-2') : ?>
                                                                <a class="dropdown-item btn btn-xs" id="btnDeleteProject" data-project-id="<?= $record->project_id; ?>" title="Delete Project" style="width: 60px;"><i class="fa fa-trash mr-1"></i>Delete</a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

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

    <div class="modal fade" id="modal-input-project" tabindex="-1" role="dialog" aria-labelledby="modal-input-project-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Project</h4>
                </div>
                <form id="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card card-info card-outline">
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
                                <div class="row col-lg-12 justify-content-between" style="display: none;">
                                    <div>
                                        <label for="project_type" class="mr-2">Project Type</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="ptypec" id="ptypec" onchange="toggleProjectType()">
                                        <label for="project_type" class="mr-2">Others</label>
                                    </div>
                                </div>
                                <div class="form-group" id="ptype">
                                    <select class="form-control select2bs4" name="project_type" id="project_type" required>
                                        <option value="" selected disabled>-- Select an option --</option>
                                        <?php foreach ($ProjectTypeRecords as $row) : ?>
                                            <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group" id="ptype1">
                                    <input type="text" name="project_type1" id="project_type1" class="form-control">
                                </div>
                                <div class="row col-lg-12 justify-content-between">
                                    <div>
                                        <label for="project_collab" class="mr-2">Collaborate Project</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="pcollabc" id="pcollabc" onchange="toggleCollab()">
                                        <label for="project_collab" class="mr-2">Collaborate</label>
                                    </div>
                                </div>
                                <div class="form-group" id="pcollab">
                                    <select class="form-control" id="collab_project" name="collab_project[]" multiple="multiple"></select>
                                </div>
                                <div class="form-group">
                                    <label for="dateRange">Date Range</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="dateRange">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-lg-12 justify-content-between">
                                    <div>
                                        <label for="AssignMember" class="mr-2">Assign Member</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="pmanagec" id="pmanagec" onchange="toggleManage()">
                                        <label for="project_manage" class="mr-2">Management</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="members_project" name="members_project[]" multiple="multiple" style="width: 100%;"></select>
                                </div>
                                <div class="form-group" id="pmanage">
                                    <label for="Management">Management</label>
                                    <select class="form-control" id="manage_project" name="manage_project[]" multiple="multiple"></select>
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
        handleCollabMember();
    })
    $("#dateRange").daterangepicker({
        opens: 'left',
        autoApply: true,
        startDate: moment(),
        endDate: moment(),
        locale: {
            format: 'YYYY-MM-DD',
        }
    });
    $(document).on('click', '#AddProject', function() {
        var checkbox = $("#ptypec");
        var projectType = checkbox.prop("checked") ? $("#project_type1").val() : $("#project_type").val();
        var title = $('#project_name').val();
        // var projectType = $('#project_type').val();
        var dateRange = $('#dateRange').val();
        var dates = dateRange.split(' - ');
        var startDate = dates[0];
        var endDate = dates[1];
        var description = $('#project_description').summernote('code');
        var membersProject = $('#members_project').val();
        var managesProject = $('#manage_project').val();

        var pcollabC = document.getElementById("pcollabc");
        var projectCollab = pcollabC.checked ? $("#collab_project").val() : '<?= $this->session->userdata("company_id") ?>';
        var projectCollabString = pcollabC.checked ? projectCollab.map(function(pc) {
            return '"' + pc + '"';
        }).join(', ') : JSON.stringify(projectCollab);

        var pmanageC = document.getElementById("pmanagec");
        var projectMems = pmanageC.checked ? managesProject.concat(membersProject) : membersProject;

        if (!title || !startDate || !endDate || !description) {
            validasiInfo('Please complete all fields before inserting project!');
            return;
        }

        var AddProject = {
            title: title,
            projectType: projectType,
            start: startDate,
            due: endDate,
            description: description,
            membersProject: JSON.stringify(projectMems),
            collab_member: projectCollabString !== '' ? projectCollabString : JSON.stringify('<?= $this->session->userdata("company_id") ?>')
        };

        // TOOLS
        var addBtnProject = document.getElementById("AddProject");
        addBtnProject.disabled = true;
        addBtnProject.textContent = "Creating...";
        addBtnProject.classList.add("disabled");
        // console.log(AddProject);
        loadIng();
        addProject(AddProject);
    })

    function addProject(AddProject) {
        $.ajax({
            url: '<?= base_url(); ?>InsertProject',
            type: 'POST',
            data: AddProject,
            success: function(response) {
                $('#modal-input-project').modal('hide');
                Swal.close();
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
                        window.location.href = '<?= base_url() ?>Project/List/' + response.project; // Reload the page
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

    function handleCollab() {
        $('#collab_project').val([]).trigger('change');
        $('#collab_project').select2({
            placeholder: '-- Choose Group --',
            allowClear: true,
            minimumInputLength: 0,
            data: [
                <?php foreach ($CollabGroup as $key) { ?> {
                        id: "<?= $key->company_id ?>",
                        text: "<?= $key->company_initial ?>" + ' - ' + "<?= $key->company_name ?>"
                    },
                <?php } ?>
            ],
            templateSelection: colorSelect
        });
        warnaMultiple();
    }

    function handleCollabMember() {
        var pcollabC = document.getElementById("pcollabc");
        var projectCollab = pcollabC.checked ? $("#collab_project").val() : '<?= $this->session->userdata("company_id") ?>';
        var projectCollabString = pcollabC.checked ? projectCollab.map(function(pc) {
            return '"' + pc + '"';
        }).join(', ') : JSON.stringify(projectCollab);
        $.ajax({
            url: '<?= base_url() ?>MemberSelect',
            type: 'POST',
            data: {
                pro_group: projectCollabString !== '' ? projectCollabString : JSON.stringify('<?= $this->session->userdata("company_id") ?>')
            },
            dataType: 'JSON',
            success: function(response) {
                // console.log(response);
                var membersData = [];
                $.each(response.SelectM, function(index, isi) {
                    membersData.push({
                        id: isi.member_id,
                        text: isi.company_initial + ' - ' + isi.company_brand_name + ' - ' + isi.member_name
                    });
                });
                $('#members_project').empty().select2({
                    placeholder: '-- Choose Members --',
                    allowClear: true,
                    minimumInputLength: 0,
                    data: membersData,
                    templateSelection: colorSelect
                });
                warnaMultiple();
            }
        });
    }

    function toggleProjectType() {
        var checkbox = document.getElementById("ptypec");
        var projectTypeSelect = document.getElementById("ptype");
        var projectTypeInput = document.getElementById("ptype1");

        if (checkbox.checked) {
            projectTypeSelect.style.display = "none";
            projectTypeInput.style.display = "block";
            projectTypeSelect.removeAttribute("required");
            projectTypeInput.setAttribute("required", "required");
        } else {
            projectTypeSelect.style.display = "none";
            projectTypeInput.style.display = "none";
            projectTypeSelect.setAttribute("required", "required");
            projectTypeInput.removeAttribute("required");
        }
    };

    function toggleCollab() {
        const checks = document.getElementById("pcollabc");
        const projectCollab = document.getElementById("pcollab");

        if (checks.checked) {
            projectCollab.style.display = "block";
            handleCollabMember();
            handleCollab();
        } else {
            projectCollab.style.display = "none";
            handleCollabMember();
        }
    };

    function toggleManage() {
        const checks = document.getElementById("pmanagec");
        const projectManage = document.getElementById("pmanage");

        if (checks.checked) {
            projectManage.style.display = "block";
            handleManage();
        } else {
            projectManage.style.display = "none";
        }
    };

    function handleManage() {
        $('#manage_project').val([]).trigger('change');
        $('#manage_project').select2({
            placeholder: '-- Choose Group --',
            allowClear: true,
            minimumInputLength: 0,
            data: [
                <?php foreach ($ManageRecord as $key) { ?> {
                        id: "<?= $key->member_id ?>",
                        text: "<?= $key->company_initial ?>" + ' - ' + "<?= $key->member_name ?>"
                    },
                <?php } ?>
            ],
            templateSelection: colorSelect
        });
        warnaMultiple();
    }

    $('#collab_project').on('change', function() {
        handleCollabMember();
    });

    // Penjagaan untuk running function
    $(document).ready(function() {
        toggleCollab();
        toggleProjectType();
        toggleManage();

        $("#tblProject")
            .DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                ordering: true
            })
            .buttons()
            .container()
            .appendTo("#tblProject_wrapper .col-md-6:eq(0)");
    })
</script>

<script>
    $(document).on('click', '.pin-button', function() {
        var projectId = $(this).data('project-id');
        var buttonElement = $(this);

        $.ajax({
            type: 'POST',
            url: '<?= base_url(); ?>Pining',
            data: {
                project_id: projectId
            },
            success: function(response) {
                console.log(response.message);
                window.location.reload();
            },
            error: function() {
                alert('Permintaan AJAX gagal.');
            }
        });
    });
</script>