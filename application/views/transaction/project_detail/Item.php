<script src="https://cdn.tiny.cloud/1/087fxjs3wg3ubismshgbk9o11djxj7gsnwek1b5ysuegqf5s/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<?php
$item_id = '';
$project_id = '';
$item_name = '';
$start_date = '';
$due_date = '';
$status_id = '';
$priority_type_id = '';
$item_status = '';
$description = '';
$priority_type = '';
$member_name = '';
$creation_id = '';

if (!empty($ItemRecords)) {
    foreach ($ItemRecords as $key) {
        $item_id = $key->item_id;
        $project_id = $key->project_id;
        $item_name = $key->item_name;
        $start_date = $key->start_date;
        $due_date = $key->due_date;
        $status_id = $key->status_id;
        $priority_type_id = $key->priority_type_id;
        $item_status = $key->item_status;
        $description = $key->description;
        $priority_type = $key->priority_type;
        $member_name = $key->member_name;
        $creation_id = $key->creation_user_id;
    }
}

$total_member = 0;

if (!empty($ItemMemberTotalRecords)) {
    foreach ($ItemMemberTotalRecords as $recordTotal) {
        $total_member = $recordTotal->total_member;
    }
}

$member_type = '';

if (!empty($UserMemberType)) {
    foreach ($UserMemberType as $key) {
        $member_type = $key->member_type;
    }
}
?>

<!-- Dropdown Toggle -->
<script src="<?= base_url(); ?>assets/dist/js/addition/js.js"></script>

<!-- Styling -->
<style>
    .dropdown-menu li {
        position: relative;
    }

    .dropdown-menu .dropdown-submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: -7px;
    }

    .dropdown-menu .dropdown-submenu-left {
        right: 100%;
        left: auto;
    }

    .dropdown-menu>li:hover>.dropdown-submenu {
        display: block;
    }
</style>
<script>
    tinymce.init({
        selector: '.editor',
        menubar: false,
        statusbar: false,
        plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
        toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
        skin: 'bootstrap',
        toolbar_drawer: 'floating',
        min_height: 200,
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

        <!-- /.card-header -->
        <div class="card card-sm card-default">
            <div class="card-header" style="margin-bottom: -8px;">
                <div class="row ">
                    <div class="col-sm-6">
                        <h4>Item</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12 text-right">
                            <a class="btn btn-sm btn-danger" href="<?= base_url() . 'ProjectItem/' . $project_wrk_id . '/' . $project_id ?>">
                                <i class="fa fa-lg fa-reply"></i>
                            </a>
                            <!-- <a class="btn btn-sm btn-info" href="<?= base_url() . 'KanbanDetail/' . $project_wrk_id; ?>">
                                <i class="fa fa-lg fa-eye"></i> Kanban
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- Description -->
                <div class="card">
                    <Div class="card-header">
                        <div class="card-title">
                            Description
                        </div>
                        <div class="card-tools">
                            <?php
                            if (($member_type == 'MT-1' || $member_id == 'System') && $status_id != 'STL-4') {
                            ?>
                                <button type="button" class="btn btn-xs btn-primary" id="btnUpItem" data-toggle="modal" data-target="#modal-update-item">
                                    <i class="fa fa-lg fa-pen"></i>
                                </button>
                            <?php
                            }
                            ?>
                            <button type="button" class="btn btn-sm btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </Div>
                    <div class="card-body">
                        <strong><i class="fas fa-quote-left mr-1"></i> Item Status</strong>
                        <p class="text-muted"><?= $item_status ?></p>
                        <hr>
                        <strong><i class="fas fa-file-alt mr-1"></i> Item Name</strong>
                        <p class="text-muted"><?= $item_name ?></p>
                        <hr>
                        <strong><i class="fas fa-receipt mr-1"></i> Priority Level</strong>
                        <p class="text-muted"><?= $priority_type ?></p>
                        <hr>
                        <strong><i class="far fa-calendar-alt mr-1"></i> Start Date</strong>
                        <p class="text-muted"><?= $start_date ?> </p>
                        <hr>
                        <strong><i class="far fa-calendar-alt mr-1"></i> Due Date</strong>
                        <p class="text-muted"><?= $due_date ?> </p>
                        <hr>
                        <strong><i class="fas fa-info mr-1"></i> Description</strong>
                        <p class="text-muted"><?= $description ?></p>
                        <hr>
                    </div>
                </div>
                <!-- Batas Description -->
                <!-- Card Member -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="card-title">Members</div>
                        </div>
                        <div class="card-tools">
                            <?php if ($member_type == 'MT-1' || $member_id == 'System') {
                                if ($status_id != 'STL-4') { ?>
                                    <button type="button" class="btn btn-xs btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-item-member">
                                        <i class="fa fa-plus"></i> Add Member
                                    </button>
                            <?php }
                            } ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="col-md-12 text-center">
                            <span class="badge badge-warning"><?= $total_member ?> Members</span>
                        </div>
                        <ul class="users-list clearfix">
                            <?php if (!empty($ItemMemberRecords)) :
                                foreach ($ItemMemberRecords as $record) : ?>
                                    <?php $avatar = $record->gender_id == 'GR-001' ? 'avatar5.png' : 'avatar3.png'; ?>
                                    <li>
                                        <img src="<?= base_url() ?>assets/dist/img/<?= $avatar ?>" alt="User Image" style="width:60px">
                                        <a class="users-list-name" href="#"><?= $record->member_name ?></a>
                                        <span class="badge badge-success"><?= $record->member_type ?></span>
                                        <?php if (($member_type == 'MT-1' || $member_id == 'System') && $record->member_id != $creation_id &&  $status_id != 'STL-4') : ?>
                                            <a class="btn btn-xs btn-success" data-bs-toggle="dropdown">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        <?php endif; ?>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item tombol-hapus" href="<?= base_url() . 'DeleteItemMember/' . $record->item_member_id; ?>">
                                                    <i class="fa fa-trash"></i> Delete Member
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- Batas Card Member -->
            </div>
            <div class="col-lg-6">
                <!-- Item Attachment -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Item Attachment</div>
                        <div class="card-tools">
                            <?php if ($status_id != 'STL-4') : ?>
                                <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-input-attachment">
                                    <i class="fa fa-plus"></i> Add Attachment
                                </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tblAttachment" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Attachment Name</th>
                                    <th>Attachment Type</th>
                                    <th>Member Upload</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($AttachmentRecord)) :
                                    foreach ($AttachmentRecord as $record) : ?>
                                        <tr>
                                            <td><?= $record->attachment_name ?></td>
                                            <td><?= $record->attachment_type_name ?></td>
                                            <td><?= $record->member_upload ?></td>
                                            <td class="text-center">
                                                <a id="btnDownload" class="btn btn-xs btn-success disabled" href="<?= base_url('DownloadAttachment/' . $record->attachment_url) ?>">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a href="<?= base_url('ViewAttachment/' . $record->attachment_url) ?>" target="_blank" class="btn btn-xs btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <?php if (($member_type == 'MT-1' || $member_id == 'System' || $member_id == $record->creation_user_id) && $status_id != 'STL-4') : ?>
                                                    <a id="btnDelAttachment" data-attachment_id='<?= $record->attachment_id ?>' data-attachment_url='<?= $record->attachment_url ?>' class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                <?php endforeach;
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Batas Item Attachment -->
                <!-- Card Ubah Activity -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Activity</div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card direct-chat direct-chat-msg">
                            <div class="card-header d-flex align-items-center" style="height: 60px; display: flex; justify-content: space-between;">
                                <p class="mb-0" style="width: fit-content;">Log Activity</p>
                                <input id="search-input" class="form-control mb-0" type="text" style="margin-left: auto; width:auto;" placeholder="Search...">
                            </div>
                            <div class="card-body p-0">
                                <?php
                                if (!empty($CardLogRecord)) {
                                    // Mengambil isi log
                                    $logs = array();
                                    foreach ($CardLogRecord as $record) {
                                        $logs[] = $record->log;
                                    }

                                    // Mengurutkan log secara dscending
                                    rsort($logs);

                                    // Menampilkan log yang sudah diurutkan
                                    echo '<div class="direct-chat-messages overflow-auto">';
                                    foreach ($logs as $log) {
                                        echo '<div class="text-nowrap log-item">' . $log . '</div>';
                                    }
                                    echo '</div>';
                                } else {
                                    echo '<div class="text-center">No Activity</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Batas Log Activity -->
                <!-- Message -->
                <div class="card direct-chat direct-chat-msg">
                    <div class="card-header">
                        <h3 class="card-title">Comment</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="direct-chat-messages" style="height:205px;">
                            <?php if (!empty($CardCommentRecord)) {
                                foreach ($CardCommentRecord as $record) { ?>
                                    <?php if ($record->member_id != $member_id) { ?>
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-left"><?= $record->member_name; ?></span>
                                                <span class="direct-chat-timestamp float-right">
                                                    <?php
                                                    echo $record->change_datetime;
                                                    if ($record->change_no > 0) {
                                                        echo '  (edited)';
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <img class="direct-chat-img" src="<?= base_url(); ?>assets/dist/img/user1-128x128.jpg" alt="message user image">
                                            <div class="direct-chat-text">
                                                <?= $record->comment; ?>
                                            </div>
                                            <?php if ($record->member_id == $member_id) { ?>
                                                <!-- .direct-chat-text -->
                                            <?php } ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-right"><?= $record->member_name; ?></span>
                                                <span class="direct-chat-timestamp float-left">
                                                    <?php
                                                    echo $record->change_datetime;
                                                    if ($record->change_no > 0) {
                                                        echo '  (edited)';
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <img class="direct-chat-img" src="<?= base_url(); ?>assets/dist/img/user2-160x160.jpg" alt="message user image">
                                            <div class="direct-chat-text">
                                                <?= $record->comment; ?>
                                            </div>
                                        </div>
                            <?php }
                                }
                            } ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="<?= base_url(); ?>InsertCardComment" method="post">
                            <input type="hidden" name="project_wrk_id" placeholder="" value="<?= $project_wrk_id; ?>">
                            <?php if ($status_id == 'STW-1') { ?>
                                <div class="input-group">
                                    <textarea class="form-control" placeholder="Type Comment ..." name="comment" maxlength="1000" rows="5" required></textarea>
                                </div>
                                <br>
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </span>
                            <?php } else { ?>
                                <div class="input-group">
                                    <textarea class="form-control" placeholder="Type Comment ..." name="comment" maxlength="1000" rows="5" required disabled></textarea>
                                </div>
                                <br>
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary" disabled>Save</button>
                                </span>
                            <?php } ?>
                        </form>
                    </div>
                </div>
                <!-- Batas Message -->
            </div>
        </div>
    </section>
</div>

<!--#Project Modal Insert Member-->
<div class="modal fade" id="modal-input-item-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Item Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_wrk_id" maxlength="20" value="<?= $project_wrk_id; ?>" required readonly="true">
                            <label>Member</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="member_id" data-width="100%" id="member_id">
                                    <option value="">-- Select an option --</option>
                                    <?php foreach ($MemberSelectRecord as $row) : ?>
                                        <option value="<?= $row->member_id; ?>">
                                            <?= $row->member_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <br>
                            <label>Member Type</label>
                            <select class="form-control select2bs4" name="member_type_id" id="member_type_id" data-width=100%>
                                <?php foreach ($MemberTypeRecord as $row) : ?>
                                    <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnMember">Add Member</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--#EndProject Modal Insert Member-->

<!--#Project Modal Insert Attachment-->
<div class="modal fade" id="modal-input-attachment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Add Item Attachment</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="attachment_name">Attachment Name</label>
                            <input class="form-control" id="attachment_name" placeholder="Attachment Name" name="attachment_name" maxlength="50" required>
                            <br>
                            <label>Attachment Type</label>
                            <select class="form-control select2bs4" name="attachment_type" id="attachment_type" data-width=100%>
                                <?php foreach ($AttachmentTypeRecord as $row) : ?>
                                    <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <label for="attachment_url">Attachment</label>
                            <input class="form-control" type="file" name="attachment_file" id="attachment_file" required accept=".jpeg,.jpg,.png,.pdf">
                            <small>
                                <font color="red">Type file: jpeg/jpg/png/pdf</font>
                            </small>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" id="btnAttachment">Add Attachment</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--#EndProject Modal Insert Attachment-->

<!-- Modal Update -->
<div class="modal fade" id="modal-update-item">
    <div class="modal-dialog" style="max-width: 920px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Item</h4>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline" style="max-height: 300px;">
                                <div class="card-header">
                                    <h5 class="card-title" style="width: 90%;">
                                        <input type="text" id="item_name" class="form-control" placeholder="Item Name" value="<?= $item_name ?>">
                                    </h5>
                                    <div class="card-tools">
                                        <div style="margin-top: 5px; margin-right: 10px;"><i class="fa fa-pen" style="color: gray;"></i></div>
                                    </div>
                                </div>
                                <textarea class="editor" name="project_description" id="project_description"><?= $description ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CheckingPriority">Priority Item</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_item" value="PR-3">
                                        <label class="form-check-label">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_item" value="PR-2">
                                        <label class="form-check-label">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_item" value="PR-1">
                                        <label class="form-check-label">High</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="startItem">Start Date</label>
                                        <input type="date" class="form-control" id="item_start" value="<?= $start_date ?>">
                                    </div>
                                    <div class="col">
                                        <label for="dueItem">End Date</label>
                                        <input type="date" class="form-control" id="item_due" value="<?= $due_date ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="item_status" class="mr-2">Item Status</label>
                                <select class="form-control select2bs4" name="item_status" id="item_status">
                                    <option value="<?= $status_id ?>" selected>-- Select an option --</option>
                                    <?php foreach ($StatusItemRecords as $row) {
                                        $selectStatus = $row->variable_id == $status_id
                                            ? 'selected' : ''; ?>
                                        <option value="<?= $row->variable_id ?>" <?= $selectStatus ?> class=""><?= $row->list_name ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="btnUpdateItem">Update Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- #End Modal Update -->

<script>
    $("#tblAttachment").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            searching: false,
            order: [
                [0, "desc"]
            ]

        })
        .buttons()
        .container()
        .appendTo("#tblAttachment_wrapper .col-md-6:eq(0)");
    $("#tblItem").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            searching: false,
            order: [
                [0, "desc"]
            ]

        })
        .buttons()
        .container()
        .appendTo("#tblItem_wrapper .col-md-6:eq(0)");

    //Function Update Project
    $(document).on('click', '#btnUpItem', function() {
        var priority = '<?= $priority_type_id ?>';
        $("input[name='priority_item'][value='" + priority + "']").prop("checked", true);
    })

    $(document).on('click', '#btnUpdateItem', function() {
        var id = '<?= $item_id ?>';
        var title = $('#item_name').val();
        var projectStart = $('#item_start').val();
        var projectDue = $('#item_due').val();
        var priority = $("input[name='priority_item']:checked").val();
        var description = tinymce.get('project_description').getContent();
        var projectStatus = $('#item_status').val();
        var temp_start_date = '<?= $prj_start ?>';
        var temp_due_date = '<?= $prj_due ?>';

        var UpdateItem = {
            id: id,
            idProject: '<?= $project_id ?>',
            title: title,
            start: projectStart,
            due: projectDue,
            priority: priority,
            description: description,
            status: projectStatus,
            flag: 0
        };

        if (!id || !title || !projectStart || !projectDue || !description || !priority || !projectStatus) {
            validasiInfo('Please complete all fields before modifying the item!');
            return;
        }

        if (projectStart < temp_start_date || projectStart > temp_due_date || (projectDue < temp_start_date || projectDue > temp_due_date)) {
            validasiInfo('Check interval date item, date item not valid!');
            return;
        }

        // TOOLS
        var updateButton = document.getElementById("btnUpdateItem");
        updateButton.disabled = true;
        updateButton.textContent = "Updating...";
        updateButton.classList.add("disabled");

        // console.log(UpdateItem);
        updateItem(UpdateItem);
    })

    function updateItem(UpdateItem) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateProjectItem',
            type: 'POST',
            data: UpdateItem,
            success: function(response) {
                $('#modal-update-item').modal('hide');
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
            }
            // complete: function() {
            //     $('#loading-overlay').hide();
            // }
        });
    }
    // End Function Update Project
    //#Insert MEMBER
    $(document).on('click', '#btnMember', function() {
        var itemId = '<?= $item_id ?>';
        var memberId = $('#member_id').val();
        var memberType = $('#member_type_id').val();

        if (!itemId || !memberId || !memberType) {
            validasiInfo('Please complete all fields before adding member items!');
            return;
        }

        var AddingMember = {
            item_id: itemId,
            member_id: memberId,
            member_type_id: memberType
        };


        // TOOLS
        var addBtn = document.getElementById("btnMember");
        addBtn.disabled = true;
        addBtn.textContent = "Adding...";
        addBtn.classList.add("disabled");

        // console.log(AddingMember);
        InMember(AddingMember);
    })

    function InMember(AddingMember) {
        $.ajax({
            url: '<?= base_url(); ?>InsertItemMember',
            type: 'POST',
            data: AddingMember,
            success: function(response) {
                $('#modal-input-item-member').modal('hide');
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
            }
            // complete: function() {
            //     $('#loading-overlay').hide();
            // }
        });
    }
    //#Insert Attachment
    $(document).on('click', '#btnAttachment', function() {
        var groupID = '<?= $item_id ?>';
        var attachmentName = $('#attachment_name').val();
        var attachmentType = $('#attachment_type').val();

        // Mengambil file yang dipilih oleh pengguna
        var attachmentFile = $('#attachment_file')[0].files[0];

        var AttachmentAdd = new FormData();
        AttachmentAdd.append('group_id', groupID);
        AttachmentAdd.append('attachment_name', attachmentName);
        AttachmentAdd.append('attachment_type', attachmentType);
        AttachmentAdd.append('attachment_file', attachmentFile); // Menambahkan file ke FormData

        if (!groupID || !attachmentName || !attachmentType || !attachmentFile) {
            validasiInfo('Please complete all fields before adding attachment items!');
            return;
        }

        // TOOLS
        var addBtn = document.getElementById("btnAttachment");
        addBtn.disabled = true;
        addBtn.textContent = "Adding...";
        addBtn.classList.add("disabled");

        // console.log(AttachmentAdd);
        InAttachment(AttachmentAdd);
    })

    function InAttachment(AttachmentAdd) {
        $.ajax({
            url: '<?= base_url(); ?>InsertAttachment',
            type: 'POST',
            data: AttachmentAdd,
            processData: false, // Diperlukan agar FormData tidak diproses secara otomatis
            contentType: false, // Diperlukan agar FormData tidak memiliki tipe konten
            success: function(response) {
                $('#modal-input-attachment').modal('hide');
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
                console.log(status);
            }
            // complete: function() {
            //     $('#loading-overlay').hide();
            // }
        });
    }
    //Del Attachment
    $(document).on('click', '#btnDelAttachment', function() {
        var attachment_id = $(this).data('attachment_id');
        var attachment_url = $(this).data('attachment_url');
        $.ajax({
            url: '<?= base_url() ?>DeleteAttachment',
            type: 'POST',
            data: {
                attachment_id: attachment_id,
                attachment_url: attachment_url
            },
            success: function(response) {
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
                console.log(xhr);
            }
        })
    })
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
    // # END TOOLS
</script>