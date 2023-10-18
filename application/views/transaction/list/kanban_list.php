<!-- Dropdown Toggle -->
<script src="<?= base_url(); ?>assets/dist/js/addition/js.js"></script>
<div class="content-wrapper">
    <!-- <div style="height: 20px;"></div> -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row mb-1">
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-sm card-default">
            <div class="card-header">
                <div class="row" style="margin-bottom: -10px;">
                    <div class="col-sm-6">
                        <p>Project <strong>
                                <a href="<?= base_url() ?>Project/List/<?= enkripbro($ProjectId) ?>" class="text-muted">
                                    <?= $project_name ?>
                                </a>
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card card-danger elevation-1">
                                <div class="card-header" style="font-size: 10px;">
                                    <div class="card-title" style="font-size: 12px;"><?= $stcukName ?></div>
                                    <div class="card-tools" style="font-size: 10px;">
                                        <?php if ($batas_akses) : ?>
                                            <a class="btn btn-tool" id="addListSTL-3" data-status_stl="STL-3" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body sortable" id="sortable-STL-3" data-status="STL-3">
                                    <?php if (!empty($ListRecords)) {
                                        foreach ($ListRecords as $row) : if (($row->status_id) == 'STL-3') :
                                                $tipeItem = ($row->priority_type_id == 'PR-3') ? 'success' : (($row->priority_type_id == 'PR-2') ? 'warning' : 'danger');
                                    ?>
                                                <div class="card card-<?= $tipeItem ?> card-outline " style="cursor: move; font-size:small;" data-id="<?= $row->list_id ?>">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-8"><?= $row->list_name ?></div>
                                                            <div class="col-md-4 text-right p-0"><a class="btn btn-tool" href="<?= base_url() . 'Project/List/Task/' . enkripbro($ProjectId) . '/' . enkripbro($row->list_id); ?>"><i class="fa fa-pen" style="font-size: 10px;"></i></a></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row" style="font-size: 12px;">
                                                            <div class="col-6">
                                                                <p class="mb-0">Due:</p>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <p class="mb-0"><span class="text-muted"><?= date("d M y", strtotime($row->due_date)) ?></span></p>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="font-size: 12px;">
                                                            <div class="col-6">
                                                                <p class="mb-0">Member:</p>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <?php foreach ($ProjectMemberRecords as $key) :
                                                                    if ($row->list_id == $key->list_id) :
                                                                        if ($key->photo_url) : ?>
                                                                            <img src="<?= base_url(); ?>../api-hris/upload/<?= $key->photo_url ?>" alt="User Image" class="rounded-circle" style="width: 15px; height: 15px;" title="<?= $key->member_name ?>">
                                                                        <?php else : ?>
                                                                            <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($key->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 15px; height: 15px;" title="<?= $key->member_name ?>">
                                                                <?php endif;
                                                                    endif;
                                                                endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php endif;
                                        endforeach;
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card card-primary elevation-1">
                                <div class="card-header" style="font-size: 10px;">
                                    <div class="card-title" style="font-size: 12px;"><?= $todoName ?></div>
                                    <div class="card-tools" style="font-size: 10px;">
                                        <?php if ($batas_akses) : ?>
                                            <a class="btn btn-tool" id="addListSTL-1" data-status_stl="STL-1" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body sortable" id="sortable-STL-1" data-status="STL-1">
                                    <?php if (!empty($ListRecords)) {
                                        foreach ($ListRecords as $row) : if (($row->status_id) == 'STL-1') :
                                                $tipeItem = ($row->priority_type_id == 'PR-3') ? 'success' : (($row->priority_type_id == 'PR-2') ? 'warning' : 'danger');
                                    ?>
                                                <div class="card card-<?= $tipeItem ?> card-outline " style="cursor: move; font-size:small;" data-id="<?= $row->list_id ?>">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-8"><?= $row->list_name ?></div>
                                                            <div class="col-md-4 text-right p-0"><a class="btn btn-tool" href="<?= base_url() . 'Project/List/Task/' . enkripbro($ProjectId) . '/' . enkripbro($row->list_id); ?>"><i class="fa fa-pen" style="font-size: 10px;"></i></a></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row" style="font-size: 12px;">
                                                            <div class="col-6">
                                                                <p class="mb-0">Due:</p>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <p class="mb-0"><span class="text-muted"><?= date("d M y", strtotime($row->due_date)) ?></span></p>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="font-size: 12px;">
                                                            <div class="col-6">
                                                                <p class="mb-0">Member:</p>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <?php foreach ($ProjectMemberRecords as $key) :
                                                                    if ($row->list_id == $key->list_id) : ?>
                                                                        <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($key->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 15px; height: 15px;" title="<?= $key->member_name ?>">
                                                                <?php endif;
                                                                endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php endif;
                                        endforeach;
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card card-warning elevation-1">
                                <div class="card-header" style="font-size: 10px;">
                                    <div class="card-title" style="font-size: 12px;"><?= $inprogressName ?></div>
                                    <div class="card-tools" style="font-size: 10px;">
                                        <?php if ($batas_akses) : ?>
                                            <a class="btn btn-tool" id="addListSTL-2" data-status_stl="STL-2" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body sortable" id="sortable-STL-2" data-status="STL-2">
                                    <?php if (!empty($ListRecords)) {
                                        foreach ($ListRecords as $row) : if (($row->status_id) == 'STL-2') :
                                                $tipeItem = ($row->priority_type_id == 'PR-3') ? 'success' : (($row->priority_type_id == 'PR-2') ? 'warning' : 'danger');
                                    ?>
                                                <div class="card card-<?= $tipeItem ?> card-outline " style="cursor: move; font-size:small;" data-id="<?= $row->list_id ?>">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-8"><?= $row->list_name ?></div>
                                                            <div class="col-md-4 text-right p-0"><a class="btn btn-tool" href="<?= base_url() . 'Project/List/Task/' . enkripbro($ProjectId) . '/' . enkripbro($row->list_id); ?>"><i class="fa fa-pen" style="font-size: 10px;"></i></a></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row" style="font-size: 12px;">
                                                            <div class="col-6">
                                                                <p class="mb-0">Due:</p>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <p class="mb-0"><span class="text-muted"><?= date("d M y", strtotime($row->due_date)) ?></span></p>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="font-size: 12px;">
                                                            <div class="col-6">
                                                                <p class="mb-0">Member:</p>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <?php foreach ($ProjectMemberRecords as $key) :
                                                                    if ($row->list_id == $key->list_id) : ?>
                                                                        <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($key->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 15px; height: 15px;" title="<?= $key->member_name ?>">
                                                                <?php endif;
                                                                endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php endif;
                                        endforeach;
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card card-success elevation-1">
                                <div class="card-header" style="font-size: 10px;">
                                    <div class="card-title" style="font-size: 12px;"><?= $doneName ?></div>
                                    <div class="card-tools" style="font-size: 10px;">
                                        <?php if ($batas_akses) : ?>
                                            <a class="btn btn-tool" id="addListSTL-4" data-status_stl="STL-4" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body sortable" id="sortable-STL-4" data-status="STL-4">
                                    <?php if (!empty($ListRecords)) {
                                        foreach ($ListRecords as $row) : if (($row->status_id) == 'STL-4') :
                                                $tipeItem = ($row->priority_type_id == 'PR-3') ? 'success' : (($row->priority_type_id == 'PR-2') ? 'warning' : 'danger');
                                    ?>
                                                <div class="card card-<?= $tipeItem ?> card-outline " style="cursor: move; font-size:small;" data-id="<?= $row->list_id ?>">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-8"><?= $row->list_name ?></div>
                                                            <div class="col-md-4 text-right p-0"><a class="btn btn-tool" href="<?= base_url() . 'Project/List/Task/' . enkripbro($ProjectId) . '/' . enkripbro($row->list_id); ?>"><i class="fa fa-pen" style="font-size: 10px;"></i></a></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row" style="font-size: 12px;">
                                                            <div class="col-6">
                                                                <p class="mb-0">Due:</p>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <p class="mb-0"><span class="text-muted"><?= date("d M y", strtotime($row->due_date)) ?></span></p>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="font-size: 12px;">
                                                            <div class="col-6">
                                                                <p class="mb-0">Member:</p>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <?php foreach ($ProjectMemberRecords as $key) :
                                                                    if ($row->list_id == $key->list_id) : ?>
                                                                        <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($key->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 15px; height: 15px;" title="<?= $key->member_name ?>">
                                                                <?php endif;
                                                                endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php endif;
                                        endforeach;
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--#Project Modal Insert Item -->
<div class="modal fade" id="modal-input-detail" tabindex="-1" role="dialog" aria-labelledby="modal-input-detail-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Card</h5>
            </div>
            <form id="list_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <input type="hidden" class="form-control" id="stl_status" placeholder="Project ID" name="stl_status" maxlength="20" required readonly>
                                    <h5 class="card-title" style="width: 90%;"><input type="text" id="list_name" class="form-control" placeholder="Card Name"></h5>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" href=""><i class="fa fa-pen"></i></a>
                                    </div>
                                </div>
                                <textarea class="editor" name="list_description" id="list_description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="priority_list">Priority Card</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_list" value="PR-3" id="pr3">
                                        <label class="form-check-label" for="pr3">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_list" value="PR-2" id="pr2">
                                        <label class="form-check-label" for="pr2">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_list" value="PR-1" id="pr1">
                                        <label class="form-check-label" for="pr1">High</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-lg-12 justify-content-between">
                                <div>
                                    <label for="members_list" class="mr-2">Assign Member</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="pmemberc" id="pmemberc" onchange="handleClickAddItem()">
                                    <label for="pmemberc" class="mr-2">All Member</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="members_list" name="members_list[]" multiple="multiple" style="width: 100%;"></select>
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
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="AddList">Create Card</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!--#EndProject Modal Insert Item -->

<script>
    $(document).ready(function() {
        var aksessing = '<?= $batas_akses ?>';
        // Bawaan adminLTE sortable
        if (aksessing) {
            $("#sortable-STL-3, #sortable-STL-1, #sortable-STL-2, #sortable-STL-4").sortable({
                connectWith: ".sortable",
                start: function(event, ui) {
                    console.log("pindahin");
                },
                stop: function(event, ui) {
                    var project_id = ui.item.data("id");
                    var newStatus = ui.item.closest(".sortable").data("status");

                    var updateData = {
                        id: project_id,
                        idProject: '<?= $ProjectId ?>',
                        status: newStatus,
                        flag: 1
                    };
                    console.log('oke');

                    $.ajax({
                        url: '<?= base_url(); ?>UpdateList',
                        type: "POST",
                        data: updateData,
                        success: function(response) {
                            console.log(response.message);
                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText);
                        }
                    });
                }
            });

        }
    });


    // Function Add Item Project
    $(document).on('click', '#addListSTL-1 ,#addListSTL-2, #addListSTL-3, #addListSTL-4', function() {
        var itemStatus = $(this).data('status_stl');
        console.log(itemStatus);
        $('#stl_status').val(itemStatus);
        handleClickAddItem();
        date2In1();
    })

    $(document).on('click', '#AddList', function() {
        var dateRange = $('#dateRange').val();
        var dates = dateRange.split(' - ');
        var itemId = '<?= $ProjectId ?>';
        var title = $('#list_name').val();
        var itemStart = dates[0];
        var itemDue = dates[1];
        var description = $('#list_description').summernote('code');
        var membersItem = $('#members_list').val();
        var priority = $("input[name='priority_list']:checked").val();
        var itemStatus = $('#stl_status').val();

        var temp_start_date = "<?= date('Y-m-d', strtotime($tempstart)); ?>";
        var temp_due_date = "<?= date('Y-m-d', strtotime($tempdue)); ?>";

        if (!itemId || !title || !itemStart || !itemDue || !description || !membersItem || !priority) {
            validasiInfo('Mohon lengkapi semua isian sebelum menambahkan item proyek!');
            return;
        }

        if (itemStart < temp_start_date || itemStart > temp_due_date || (itemDue < temp_start_date || itemDue > temp_due_date)) {
            validasiInfo('Check interval date project, date project not valid!');
            return;
        }

        var AddItem = {
            idProject: itemId,
            title: title,
            start: itemStart,
            due: itemDue,
            priority: priority,
            status: itemStatus,
            description: description,
            membersList: JSON.stringify(membersItem)
        };

        var addBtnProject = document.getElementById("AddList");
        addBtnProject.disabled = true;
        addBtnProject.textContent = "Creating...";
        addBtnProject.classList.add("disabled");
        // console.log(AddItem);
        loadIng();
        addItemProject(AddItem);
    });

    function addItemProject(AddItem) {
        $.ajax({
            url: '<?= base_url(); ?>InsertList',
            type: 'POST',
            data: AddItem,
            success: function(response) {
                $('#modal-input-detail').modal('hide');
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
                        window.location.href = '<?= base_url() ?>/Project/List/Task/' + response.project + '/' + response.card; // Reload the page
                    }
                });

            },
            error: function(xhr, status, error) {
                console.log(error);
            },
            // complete: function() {
            //     $('#loading-overlay').hide();
            // }
        });
    }
    // End Function Add Item Project



    // #TOOOLS
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

    function date2In1() {
        var startDate = moment('<?= $tempstart ?? date('Y-m-d') ?>', 'YYYY-MM-DD');
        var dueDate = moment('<?= $tempdue ?? date('Y-m-d', strtotime('+7 days')) ?>', 'YYYY-MM-DD');

        $("#dateRange").daterangepicker({
            opens: 'left',
            autoApply: true,
            startDate: startDate,
            endDate: dueDate,
            locale: {
                format: 'YYYY-MM-DD',
            }
        });
        dateRangeTheme();
    }

    function handleClickAddItem() {
        const membsArray = [];
        <?php foreach ($MemberSelectRecord as $key) { ?>
            membsArray.push({
                id: "<?= $key->member_id ?>",
                text: "<?= $key->company_initial ?>" + " - " + "<?= $key->company_brand_name ?>" + " - " + "<?= $key->member_name ?>"
            });
        <?php } ?>

        $('#members_list').select2({
            placeholder: '-- Choose Members --',
            allowClear: true,
            minimumInputLength: 0,
            data: membsArray,
            templateSelection: colorSelect
        });

        const checks = document.getElementById("pmemberc");
        if (checks.checked) {
            $('#members_list').val(membsArray.map(item => item.id)).trigger('change');
        } else {
            $('#members_list').val([]).trigger('change');
        }
        warnaMultiple();
    }
    // #ENDTOOLS
</script>