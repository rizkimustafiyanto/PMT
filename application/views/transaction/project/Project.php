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
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="card col-lg-2">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            Group List
                                        </h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-primary btn-sm btn-tool" id="btnAddGroup" data-toggle="modal" data-target="#modal-input-project-group">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0" style="margin-top: 10px;">
                                        <table class="table table-bordered table-striped small">
                                            <tbody>
                                                <?php
                                                if ($GroupProjectRecords) {
                                                    foreach ($GroupProjectRecords as $key) :
                                                        $isiGroup = [];
                                                        if ($AllProjectRecords) :
                                                            foreach ($AllProjectRecords as $col) :
                                                                if ($key->group_id == $col->group_id) {
                                                                    $isiGroup[] = $col->project_id;
                                                                }
                                                            endforeach;
                                                        endif;

                                                ?>
                                                        <tr>
                                                            <td class="group-option" data-group-id="<?= $key->group_id; ?>" data-group-name="<?= $key->group_name; ?>">
                                                                <div style="cursor: pointer;">
                                                                    <?= $key->group_name; ?>
                                                                </div>
                                                                <div id="alatCRUD" style="display: none;">
                                                                    <i class="fas fa-edit editgroup" data-groups-id="<?= $key->group_id ?>" data-groups-name="<?= $key->group_name ?>" data-progroups="<?= implode(', ', $isiGroup) ?>"></i>
                                                                    <i class="fas fa-trash delgroup" data-groups-id="<?= $key->group_id ?>"></i>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;
                                                } else { ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            No Group
                                                        </td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card col-lg-10">
                                    <div class="card-header">
                                        <h5 class="card-title" id="headernya-table">All Project</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-primary btn-tool" id="btnAdd" data-toggle="modal" data-target="#modal-input-project">
                                                <i class="fa fa-plus"></i> Add Project
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="tblProject" class="table table-bordered table-striped small">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Project Name</th>
                                                    <th>Time</th>
                                                    <th>Project Progress</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
                                        <h5 class="card-title" style="width: 90%;">
                                            <input type="text" id="project_name" class="form-control" placeholder="PT | Project Name, Ex: PSD | Simple Pro" autocomplete="off" required>
                                        </h5>
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

    <div class="modal fade" id="modal-input-project-group" tabindex="-1" role="dialog" aria-labelledby="modal-input-project-group-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Grouping</h4>
                </div>
                <form id="">
                    <div class="modal-body">
                        <input type="hidden" id="group_id_project" class="form-control" placeholder="Group Name" autocomplete="off" required>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" id="group_name" class="form-control" placeholder="Group Name" autocomplete="off" required>
                            </div>
                            <div class="col-lg-6">
                                <select class="form-control" id="group_project" name="group_project[]" multiple="multiple" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" id="AddGrouping">Save Project</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#btnAddGroup', function() {
        $('#group_project').val([]).trigger('change');
        $('#group_project').select2({
            placeholder: '-- Choose Group --',
            allowClear: true,
            minimumInputLength: 0,
            data: [
                <?php foreach ($ProjectRecords as $key) { ?> {
                        id: "<?= $key->project_id ?>",
                        text: "<?= $key->project_name ?>"
                    },
                <?php } ?>
            ],
            templateSelection: colorSelect
        });
        warnaMultiple();
    })
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
    $(document).on('click', '#AddGrouping', function() {
        var group_id = $('#group_id_project').val();
        var group_name = $('#group_name').val();
        var project_id_group = $('#group_project').val();

        if (!project_id_group) {
            validasiInfo('Please complete all fields before grouping project!');
            return;
        }


        var addGroupingD = {
            group_id: group_id,
            group_name: group_name,
            project_id: JSON.stringify(project_id_group)
        };

        // TOOLS
        var AddGroupingbtn = document.getElementById("AddGrouping");
        AddGroupingbtn.disabled = true;
        AddGroupingbtn.textContent = "Creating...";
        AddGroupingbtn.classList.add("disabled");
        // console.log(addGroupingD);
        loadIng();
        addGroupingList(addGroupingD);
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

    function addGroupingList(ggl) {
        $.ajax({
            url: '<?= base_url(); ?>InsertProjectGroup',
            type: 'POST',
            data: ggl,
            success: function(response) {
                $('#modal-input-project-group').modal('hide');
                Swal.close();
                Swal.fire({
                    icon: response.status,
                    title: response.title,
                    text: response.message,
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: toast => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '<?= base_url() ?>Project'; // Reload the page
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

    var lastClickedGroupId = null;
    loadProjects(lastClickedGroupId);
    $('.group-option').on('click', function() {
        var namaHeadnya = $('#headernya-table');
        var groupId = $(this).data('group-id');
        var groupName = $(this).data('group-name');

        if (groupId == lastClickedGroupId) {
            namaHeadnya.text("All Project");
            lastClickedGroupId = null;
            loadProjects(lastClickedGroupId);
        } else {
            namaHeadnya.text(groupName);
            loadProjects(groupId);
            lastClickedGroupId = groupId;
        }

        $(this).toggleClass('pilihangroup');
        if ($(this).hasClass('pilihangroup')) {
            $(this).find('#alatCRUD').show();
        } else {
            $(this).find('#alatCRUD').hide();
        }
        $('.group-option').not(this).removeClass('pilihangroup').find('#alatCRUD').hide();

        event.stopPropagation();
    });

    $('.editgroup').on('click', function(event) {
        event.stopPropagation();
        var groupId = $(this).data('groups-id');
        var groupName = $(this).data('groups-name');
        var dataGroup = $(this).data('progroups');

        var groupArray = JSON.stringify(dataGroup).includes(',') ? dataGroup.split(',').map(item => item.trim()) : null;

        $('#group_project').val([]).trigger('change');
        $('#group_project').select2({
            placeholder: '-- Choose Group --',
            allowClear: true,
            minimumInputLength: 0,
            data: [
                <?php foreach ($ProjectRecords as $key) { ?> {
                        id: "<?= $key->project_id ?>",
                        text: "<?= $key->project_name ?>"
                    },
                <?php } ?>
            ],
            templateSelection: colorSelect
        });
        warnaMultiple();

        $('#group_id_project').val(groupId);
        $('#group_name').val(groupName);

        if (groupId) {
            $('#group_project').val(groupArray).trigger('change');
        } else {
            $('#group_project').val([]).trigger('change');
        }
        console.log('edit ' + groupId);
        $('#modal-input-project-group').modal('show');
    });

    $('.delgroup').on('click', function(event) {
        event.stopPropagation();
        var groupId = $(this).data('groups-id');
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus group ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                loadIng();
                $.ajax({
                    url: '<?= base_url(); ?>DeleteProjectGroup',
                    type: 'POST',
                    data: {
                        group_id: groupId
                    },
                    success: function(response) {
                        Swal.close();
                        Swal.fire({
                            icon: response.status,
                            title: response.title,
                            text: response.message,
                            toast: true,
                            position: 'center',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            didOpen: toast => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.reload();
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
        });
        // console.log('del ' + groupId);
    });

    function loadProjects(groupId) {
        $.ajax({
            url: '<?= base_url(); ?>GetGroupProject',
            type: 'POST',
            data: {
                grouping_project: groupId
            },
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                updateProjectTable(data);
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error fetching data: ', errorThrown);
                console.log(xhr.responseText);
            }
        });
    }

    function updateProjectTable(data) {
        var tableing = $('#tblProject').DataTable();
        tableing.clear();

        $.each(data.ProjectView, function(index, record) {
            var newRow = '<tr>';
            newRow += '<td>' + (index + 1) + '</td>';
            newRow += '<td>';
            newRow += '<div class="row align-items-center">';
            newRow += '<div class="col clickable" data-url="' + record.url + '" style="cursor: pointer;">';
            newRow += record.project_name + '<br>';
            newRow += 'Created : ' + record.creation_date;
            newRow += '</div>';
            newRow += '<div class="col-auto pin-button" data-project-id="' + record.project_id + '" title="Pin Project"><i class="' + (record.pin_pro == 1 ? 'fa-regular' : 'fa-solid') + ' fa-bookmark"></i></div>';
            newRow += '</div>';
            newRow += '</td>';
            newRow += '<td>';
            newRow += '<div>Start : ' + (record.start_date ? record.start_date : '') + '</div>';
            newRow += '<div>Due : ' + (record.due_date ? record.due_date : '') + '</div>';
            newRow += '</td>';
            newRow += '<td>';
            newRow += '<div class="progress-group">';
            newRow += '<div class="progress progress-sm">';
            newRow += '<div class="progress-bar ' + (record.percent < 100 ? 'bg-primary' : 'bg-success') + '" style="width: ' + record.percent + '%"></div>';
            newRow += '</div>';
            newRow += '<span class="float-center"><b>' + record.percent + ' % Complete</b></span>';
            newRow += '</div>';
            newRow += '</td>';
            newRow += '<td class="text-center">';
            newRow += '<a class="badge ' + (record.status_id == 'STW-1' ? 'badge-warning' : 'badge-success') + ' float">' + record.name_project_status + '</a>';
            newRow += '</td>';
            newRow += '<td class="text-center">';
            newRow += '<div class="btn-group">';
            newRow += '<button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">';
            newRow += '<i class="fas fa-bars"></i>';
            newRow += '</button>';
            newRow += '<div class="dropdown-menu" style="box-shadow: none; border-color: transparent; width: 50px;">';
            newRow += '<a class="dropdown-item btn btn-xs" href="' + record.url + '" title="View Detail" style="width: 60px;"><i class="fa fa-eye mr-1"></i>View</a>';
            newRow += '<a class="dropdown-item btn btn-xs" href="' + record.urlkanban + '" title="View Kanban" style="width: 60px;"><i class="fa fa-lg fa-brands fa-flipboard mr-1"></i>Board</a>';
            if ("<?= $member_id ?>" == 'System' || record.member_type_id == 'MT-1') {
                newRow += '<a class="dropdown-item btn btn-xs" id="btnDeleteProject" data-project-id="' + record.project_id + '" title="Delete Project" style="width: 60px;"><i class="fa fa-trash mr-1"></i>Delete</a>';
            }
            newRow += '</div>';
            newRow += '</div>';
            newRow += '</td>';
            newRow += '</tr>';

            tableing.row.add($(newRow));
        });

        tableing.draw();

        $(".clickable").on("click", function() {
            const url = $(this).data("url");
            window.location.href = url;
        });

        tableing.buttons().container().appendTo("#tblProject_wrapper .col-md-6:eq(0)");
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

    });
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