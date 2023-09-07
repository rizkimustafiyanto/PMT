<script src="https://cdn.tiny.cloud/1/087fxjs3wg3ubismshgbk9o11djxj7gsnwek1b5ysuegqf5s/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.editor',
        menubar: false,
        statusbar: false,
        plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
        toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
        skin: 'bootstrap',
        toolbar_drawer: 'floating',
        min_height: 210,
        autoresize_bottom_margin: 16,
        setup: (editor) => {
            editor.on('init', () => {
                editor.getContainer().style.transition = "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
            });
            editor.on('focus', () => {
                editor.getContainer().style.boxShadow = "0 0 0 .2rem rgba(0, 123, 255, .25)",
                    editor.getContainer().style.borderColor = "#80bdff"
            });
            editor.on('blur', () => {
                editor.getContainer().style.boxShadow = "",
                    editor.getContainer().style.borderColor = ""
            });
        }
    });
</script>
<!-- Dropdown Toggle -->
<script src="<?= base_url(); ?>assets/dist/js/addition/js.js"></script>
<div class="content-wrapper">
    <div style="height: 20px;"></div>
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
                        <h4>Item</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-sm btn-danger" id="btnBack" href="#" onclick="history.go(-1); return false;">
                            <i class="fa fa-lg fa-reply"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="card-title">Stuck</div>
                                    </div>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" id="addItemSTL-3" data-status_stl="STL-3" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body sortable" data-status="STL-3">
                                    <?php if (!empty($ItemList)) {
                                        foreach ($ItemList as $row) : if (($row->status_id) == 'STL-3') :
                                                $tipeItem = ($row->priority_type_id == 'PR-3') ? 'success' : (($row->priority_type_id == 'PR-2') ? 'warning' : 'danger');
                                    ?>
                                                <div class="card card-<?= $tipeItem ?> card-outline " style="cursor: move; font-size:small;" data-id="<?= $row->item_id ?>">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-8"><?= $row->item_name ?></div>
                                                            <div class="col-md-4 text-right p-0"><a class="btn btn-tool" href="<?= base_url() . 'Item/' . $row->item_id . '/' . $ProjectId ?>"><i class="fa fa-eye"></i></a></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <?= $row->description ?>
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
                                                                <?php foreach ($ItemMemberRecords as $key) {
                                                                    if ($row->item_id == $key->item_id) : ?>
                                                                        <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($key->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 15px; height: 15px;">
                                                                <?php endif;
                                                                }; ?>
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
                            <div class="card card-primary">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="card-title">To Do</div>
                                    </div>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" id="addItemSTL-1" data-status_stl="STL-1" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body sortable" data-status="STL-1">
                                    <?php if (!empty($ItemList)) {
                                        foreach ($ItemList as $row) : if (($row->status_id) == 'STL-1') :
                                                $tipeItem = ($row->priority_type_id == 'PR-3') ? 'success' : (($row->priority_type_id == 'PR-2') ? 'warning' : 'danger');
                                    ?>
                                                <div class="card card-<?= $tipeItem ?> card-outline " style="cursor: move; font-size:small;" data-id="<?= $row->item_id ?>">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-8"><?= $row->item_name ?></div>
                                                            <div class="col-md-4 text-right p-0"><a class="btn btn-tool" href="<?= base_url() . 'Item/' . $row->item_id . '/' . $ProjectId ?>"><i class="fa fa-eye"></i></a></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <?= $row->description ?>
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
                                                                <?php foreach ($ItemMemberRecords as $key) {
                                                                    if ($row->item_id == $key->item_id) : ?>
                                                                        <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($key->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 15px; height: 15px;">
                                                                <?php endif;
                                                                }; ?>
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
                            <div class="card card-warning">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="card-title">In Progress</div>
                                    </div>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" id="addItemSTL-2" data-status_stl="STL-2" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body sortable" data-status="STL-2">
                                    <?php if (!empty($ItemList)) {
                                        foreach ($ItemList as $row) : if (($row->status_id) == 'STL-2') :
                                                $tipeItem = ($row->priority_type_id == 'PR-3') ? 'success' : (($row->priority_type_id == 'PR-2') ? 'warning' : 'danger');
                                    ?>
                                                <div class="card card-<?= $tipeItem ?> card-outline " style="cursor: move; font-size:small;" data-id="<?= $row->item_id ?>">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-8"><?= $row->item_name ?></div>
                                                            <div class="col-md-4 text-right p-0"><a class="btn btn-tool" href="<?= base_url() . 'Item/' . $row->item_id . '/' . $ProjectId ?>"><i class="fa fa-eye"></i></a></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <?= $row->description ?>
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
                                                                <?php foreach ($ItemMemberRecords as $key) {
                                                                    if ($row->item_id == $key->item_id) : ?>
                                                                        <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($key->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 15px; height: 15px;">
                                                                <?php endif;
                                                                }; ?>
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
                            <div class="card card-success">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="card-title">Done</div>
                                    </div>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" id="addItemSTL-4" data-status_stl="STL-4" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body sortable" data-status="STL-4">
                                    <?php if (!empty($ItemList)) {
                                        foreach ($ItemList as $row) : if (($row->status_id) == 'STL-4') :
                                                $tipeItem = ($row->priority_type_id == 'PR-3') ? 'success' : (($row->priority_type_id == 'PR-2') ? 'warning' : 'danger');
                                    ?>
                                                <div class="card card-<?= $tipeItem ?> card-outline " style="cursor: move; font-size:small;" data-id="<?= $row->item_id ?>">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-8"><?= $row->item_name ?></div>
                                                            <div class="col-md-4 text-right p-0"><a class="btn btn-tool" href="<?= base_url() . 'Item/' . $row->item_id . '/' . $ProjectId ?>"><i class="fa fa-eye"></i></a></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <?= $row->description ?>
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
                                                                <?php foreach ($ItemMemberRecords as $key) {
                                                                    if ($row->item_id == $key->item_id) : ?>
                                                                        <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($key->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 15px; height: 15px;">
                                                                <?php endif;
                                                                }; ?>
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
<div class="modal fade" id="modal-input-detail">
    <div class="modal-dialog" style="max-width: 920px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Project Item</h4>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline" style="max-height: 300px;">
                                <div class="card-header">
                                    <input type="hidden" class="form-control" id="stl_status" placeholder="Project ID" name="stl_status" maxlength="20" required readonly>
                                    <h5 class="card-title" style="width: 90%;"><input type="text" id="item_name" class="form-control" placeholder="Item Name"></h5>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" href=""><i class="fa fa-pen"></i></a>
                                    </div>
                                </div>
                                <textarea class="editor" name="item_description" id="item_description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CheckingPriority">Priority Project</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_project" value="PR-3">
                                        <label class="form-check-label">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_project" value="PR-2">
                                        <label class="form-check-label">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_project" value="PR-1">
                                        <label class="form-check-label">High</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="MemberItem" class="mr-2">Assign Member</label>
                                <select class="form-control" id="members_project_item" name="members_project_item[]" multiple="multiple"></select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="startItemProject">Start Date</label>
                                        <input type="date" class="form-control" id="item_start">
                                    </div>
                                    <div class="col">
                                        <label for="dueItemProject">Due Date</label>
                                        <input type="date" class="form-control" id="item_due">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="AddItem">Save Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--#EndProject Modal Insert Item -->

<script>
    $(document).ready(function() {
        // bawaan adminLTE sortable
        $(".sortable").sortable({
            connectWith: ".sortable",
            update: function(event, ui) {
                var project_id = ui.item.data("id");
                var newStatus = ui.item.closest(".sortable").data("status");

                var updateData = {
                    id: project_id,
                    idProject: '<?= $ProjectId ?>',
                    status: newStatus,
                    flag: 1
                };
                // console.log(updateData);
                $.ajax({
                    url: '<?= base_url(); ?>UpdateProjectItem',
                    type: "POST",
                    data: updateData,
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(response.message);
                        alert(xhr.responseText);
                    }
                });
            }
        });
    });

    // Function Add Item Project
    $(document).on('click', '#addItemSTL-1 ,#addItemSTL-2, #addItemSTL-3, #addItemSTL-4', function() {
        var itemStatus = $(this).data('status_stl');
        console.log(itemStatus);
        $('#stl_status').val(itemStatus);
        handleClickAddItem();
    })

    $(document).on('click', '#AddItem', function() {
        var itemId = '<?= $ProjectId ?>';
        var title = $('#item_name').val();
        var itemStart = $('#item_start').val();
        var itemDue = $('#item_due').val();
        var description = tinymce.get('item_description').getContent();
        var membersItem = $('#members_project_item').val();
        var priority = $("input[name='priority_project']:checked").val();
        var itemStatus = $('#stl_status').val();

        var temp_start_date = "<?= $tempstart ?>";
        var temp_due_date = "<?= $tempdue ?>";

        if (!itemId || !title || !itemStart || !itemDue || !description || !membersItem || !priority) {
            validasiInfo('Mohon lengkapi semua isian sebelum menambahkan item proyek!');
            return;
        }

        if (itemStart < temp_start_date || itemStart > temp_due_date || (itemDue < temp_start_date || itemDue > temp_due_date)) {
            validasiInfo('Check interval date item, date item not valid!');
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
            membersItem: JSON.stringify(membersItem)
        };

        // console.log(AddItem);
        addItemProject(AddItem);
    });

    function addItemProject(AddItem) {
        $.ajax({
            url: '<?= base_url(); ?>InsertProjectItem',
            type: 'POST',
            data: AddItem,
            success: function(response) {
                $('#modal-input-detail').modal('hide');
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

    function handleClickAddItem() {
        $('#members_project_item').val([]).trigger('change');
        $('#members_project_item').select2({
            placeholder: '-- Choose Members --',
            allowClear: true,
            minimumInputLength: 0,
            data: [
                <?php foreach ($ProjectMemberRecords as $key) { ?> {
                        id: "<?= $key->member_id ?>",
                        text: "<?= $key->member_name ?>"
                    },
                <?php } ?>
            ]
        });
    }
    // #ENDTOOLS
</script>