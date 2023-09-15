<?php
$list_name = '';
$start_date = '';
$due_date = '';
$priority_type = '';
$status_id = '';
$status_name = '';
$percentage = 0;
$description = '';
$list_type = '';

if (!empty($ListRecords)) {
    foreach ($ListRecords as $record) {
        $list_name = $record->list_name;
        $priority_type = $record->priority_type_id;
        $start_date = $record->start_date;
        $due_date = $record->due_date;
        $description = $record->description;
        $status_name = $record->list_status;
        $status_id = $record->status_id;
        $percentage = $record->percentage;
        $list_type = $record->priority_type;
    }
}

$total_member = 0;

if (!empty($ListMemberTotalRecords)) {
    foreach ($ListMemberTotalRecords as $recordTotal) {
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
                        <h4>List</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12 text-right">
                            <a class="btn btn-sm btn-danger" href="<?= base_url() . 'List/' . $project_id; ?>">
                                <i class="fa fa-lg fa-reply"></i>
                            </a>
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
                            <?php if (($member_type == 'MT-2' || $member_id == 'System' || $member_id == $creator) && $status_id != 'STL-4') : ?>
                                <button type="button" class="btn btn-xs btn-tool" id="btnUpList" style="font-size: 10px;" data-toggle="modal" data-target="#modal-update-list">
                                    <i class="fa fa-lg fa-pen"></i>
                                </button>
                            <?php
                            endif;
                            ?>
                            <button type="button" class="btn btn-sm btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </Div>
                    <div class="card-body">
                        <strong><i class="fas fa-file-alt mr-1"></i> List Name</strong>
                        <p class="text-muted"><?= $list_name ?></p>
                        <hr>
                        <strong><i class="fas fa-receipt mr-1"></i> Priority</strong>
                        <p class="text-muted"><?= $list_type ?></p>
                        <hr>
                        <strong><i class="far fa-calendar-alt mr-1"></i> Start Date</strong>
                        <p class="text-muted"><?= $start_date ?> </p>
                        <hr>
                        <strong><i class="far fa-calendar-alt mr-1"></i> Due Date</strong>
                        <p class="text-muted"><?= $due_date ?> </p>
                        <hr>
                        <strong><i class="fas fa-quote-left mr-1"></i> Status</strong>
                        <p class="text-muted"><?= $status_name ?></p>
                        <hr>
                        <strong><i class="fas fa-info mr-1"></i> Description</strong>
                        <p class="text-muted"><?= $description ?></p>
                        <hr>
                        <div class="col-md-12 progress-group">
                            <label for="card_name">Progress</label>
                            <span class="float-right"><b><?= $percentage . ' %'; ?></b></span>
                            <div class="progress progress-sm" style="height: 10px;border-radius: 20px;">
                                <div class="progress-bar bg-success" style="width: <?= $percentage ?>%"></div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <!-- Batas Description -->
                <!-- List Attachment -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">List Attachment</div>
                        <div class="card-tools">
                            <?php if ($status_id != 'STL-4') : ?>
                                <button type="button" class="btn btn-xs btn-tool" data-toggle="modal" data-target="#modal-input-attachment">
                                    <i class="fas fa-file"></i>
                                </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tblAttachment" class="table table-bordered table-striped" style="font-size: small;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Uploaded By</th>
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
                                                <?php if (($member_type == 'MT-2' || $member_id == 'System' || $member_id == $creator) && $status_id != 'STL-4') : ?>
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
                <!-- Batas List Attachment -->
                <!-- Card Member -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="card-title">Members</div>
                        </div>
                        <div class="card-tools">
                            <?php if ($member_type == 'MT-1' || $member_id == 'System') {
                                if ($status_id != 'STL-4') { ?>
                                    <button type="button" class="btn btn-xs btn-tool" id="btnAdd" data-toggle="modal" data-target="#modal-input-list-member">
                                        <i class="fa fa-user-plus"></i>
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
                            <?php if (!empty($ListMemberRecords)) :
                                foreach ($ListMemberRecords as $record) : ?>
                                    <?php $avatar = $record->gender_id == 'GR-001' ? 'avatar5.png' : 'avatar3.png'; ?>
                                    <li>
                                        <img src="<?= base_url() ?>assets/dist/img/<?= $avatar ?>" alt="User Image" style="width:60px">
                                        <a class="users-list-name" href="javascript:void(0);"><?= $record->member_name ?></a>
                                        <span class="badge badge-success"><?= $record->member_type ?></span>
                                        <?php if (($member_type == 'MT-2' || $member_id == 'System' || $member_id == $creator) && $status_id != 'STL-4') : ?>
                                            <a class="btn btn-xs btn-success" data-bs-toggle="dropdown">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        <?php endif; ?>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" data-list_member_id="<?= $record->list_member_id ?>" data-member_id='<?= $record->member_id ?>' id="btnDelMember">
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
                <!-- Card To Do List -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Task List</div>
                        <div class="card-tools">
                            <?php if ($status_id != 'STL-4') : ?>
                                <button type="button" class="btn btn-tool" id="btnAddTask" data-toggle="modal" data-target="#modal-input-task">
                                    <i class="fa fa-file-circle-plus"></i>
                                </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($TaskRecords)) : ?>
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                                <?php foreach ($TaskRecords as $record) :
                                    $showCheckbox = ($status_id != 'STL-4' && ($member_type == 'MT-2' || $member_id == 'System' || $member_id == $record->creation_user_id));
                                    $remainingDays = 0;
                                    $badgeClass = '';
                                    $startDate = strtotime($record->start_date);
                                    $dueDate = strtotime($record->due_date);
                                    $currentTime = time();

                                    if ($currentTime <= $startDate) {
                                        $remainingDays = round(($dueDate - $currentTime) / (60 * 60 * 24));
                                        $badgeClass = 'badge-success';
                                    } elseif ($currentTime < $dueDate) {
                                        $remainingDays = round(($dueDate - $currentTime) / (60 * 60 * 24));
                                        $badgeClass = (round($remainingDays) <= 2) ? 'badge-danger' : 'badge-warning';
                                    } elseif ($currentTime >= $dueDate) {
                                        $remainingDays = round(($dueDate - $currentTime) / (60 * 60 * 24));
                                        $badgeClass = (round($remainingDays) <= 0) ? 'badge-secondary' : 'badge-secondary';
                                        $remainingDays = round($remainingDays * (-1));
                                    }
                                    $remainingDays = round($remainingDays);
                                    $statusW = $record->status_id;
                                ?>

                                    <li>
                                        <div class="icheck-primary d-inline">
                                            <label for="todo1"></label>
                                            <input type="checkbox" value="" data-task_id_check="<?= $record->task_id ?>" name="todo1" id="todo1" <?= ($statusW == 'STL-4') ? 'checked' : '' ?>>
                                        </div>
                                        <span class="text"><?= $record->task_name ?></span>
                                        <small class="badge <?= $badgeClass ?>"><i class="far fa-clock"></i> <?= $remainingDays ?> Hari</small>
                                        <div class="tools">
                                            <?php if ($showCheckbox) : ?>
                                                <i class="fas fa-edit" data-task_id="<?= $record->task_id ?>" data-list_id="<?= $record->list_id ?>" data-task_name="<?= $record->task_name ?>" data-start="<?= $record->start_date ?>" data-due="<?= $record->due_date ?>" data-priority="<?= $record->priority_type_id ?>" data-task_member="<?= $record->member_id ?>"></i>
                                                <i class="fas fa-trash" data-task_id="<?= $record->task_id ?>" data-list_id="<?= $record->list_id ?>" data-task_name="<?= $record->task_name ?>"></i>
                                            <?php endif; ?>
                                        </div>
                                    </li>

                                <?php
                                endforeach;
                                ?>
                            </ul>
                        <?php else : ?>
                            <div class="text-center">No Task</div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Batas Card To Do List -->
                <!-- Log Activity -->
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
                        <?php if (!empty($LogRecord)) { ?>
                            <div class="direct-chat-messages overflow-auto" id="logact">
                                <?php foreach ($LogRecord as $record) { ?>
                                    <div class="row" style="font-size: smaller;">
                                        <div class="col-md-9 overflow-auto text-nowrap" style="max-width: 100%;">
                                            <?= $record->log ?>
                                        </div>
                                        <div class="col-md-3 text-center p-0 text-muted"><?= date("[H:i] D m y", strtotime($record->creation_datetime)) ?></div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="text-center">No Activity</div>
                        <?php }
                        ?>
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
                        <div class="direct-chat-messages" id="comment-container">
                        </div>
                        <div class="empty-comment-container d-flex align-items-center justify-content-center">
                            <p id="empty-comment" class="text-center">Empty Comment</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form id="send-comment-form">
                            <input type="hidden" id="current-member-id" value="<?= $this->session->userdata('member_id') ?>">
                            <div class="input-group">
                                <input type="text" id="message-input" class="form-control" placeholder="Type your comments..." <?= ($status_id == 'STL-4') ? 'disabled' : '' ?>>
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary" <?= ($status_id == 'STL-4') ? 'disabled' : '' ?>>Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Batas Message -->
            </div>
        </div>
    </section>
</div>

<!--#Project Modal Insert Member-->
<div class="modal fade" id="modal-input-list-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add List Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Member</label>
                            <div class="input-group">
                                <select class="form-control select2bs4" name="member_id" data-width="100%" id="member_id">
                                    <?php if ($member_type == 'MT-3') : ?>
                                        <option value="<?= $member_id ?>">It's You</option>
                                    <?php else :  ?>
                                        <option value="">-- Select an option --</option>
                                        <?php foreach ($ProjectMemberRecords as $row) : ?>
                                            <option value="<?= $row->member_id; ?>">
                                                <?= $row->member_name ?>
                                            </option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                            <br>
                            <label>Member Type</label>
                            <select class="form-control select2bs4" name="member_type_id" id="member_type_id" data-width=100%>
                                <?php foreach ($MemberTypeRecords as $row) : ?>
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
                <div class="modal-title">Add List Attachment</div>
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
<div class="modal fade" id="modal-update-list">
    <div class="modal-dialog" style="max-width: 920px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update List</h4>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline" style="max-height: 300px;">
                                <div class="card-header">
                                    <h5 class="card-title" style="width: 90%;">
                                        <input type="text" id="list_name" class="form-control" placeholder="Project Name" value="<?= $list_name ?>">
                                    </h5>
                                    <div class="card-tools">
                                        <div style="margin-top: 5px; margin-right: 10px;"><i class="fa fa-pen" style="color: gray;"></i></div>
                                    </div>
                                </div>
                                <textarea class="editor" name="list_description" id="list_description"><?= $description ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CheckingPriority">Priority List</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_list" value="PR-3">
                                        <label class="form-check-label">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_list" value="PR-2">
                                        <label class="form-check-label">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_list" value="PR-1">
                                        <label class="form-check-label">High</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="startProject">Start Date</label>
                                        <input type="date" class="form-control" id="list_start" value="<?= $start_date ?>">
                                    </div>
                                    <div class="col">
                                        <label for="endProject">End Date</label>
                                        <input type="date" class="form-control" id="list_due" value="<?= $due_date ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="list_status" class="mr-2">List Status</label>
                                <select class="form-control select2bs4" name="list_status" id="list_status">
                                    <option value="<?= $status_id ?>" selected>-- Select an option --</option>
                                    <?php foreach ($StatusTaskRecords as $row) {
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
                        <button type="button" class="btn btn-primary" id="btnUpdateList">Update List</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- #End Modal Update -->

<!-- Modal Insert Task -->
<div class="modal fade" id="modal-input-task">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Task</h4>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="task_name">Task Name</label>
                        <input type="text" class="form-control" id="task_name" placeholder="Task Name">
                    </div>
                    <div class="form-group">
                        <label for="CheckingPriority">Priority Task</label>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="priority_task" value="PR-3">
                                <label class="form-check-label">Low</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="priority_task" value="PR-2">
                                <label class="form-check-label">Medium</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="priority_task" value="PR-1">
                                <label class="form-check-label">High</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="MemberTask" class="mr-2">Assign Member</label>
                        <select class="form-control select2bs4" id="members_task" name="members_task">
                            <option value="" selected disabled>-- Select an option --</option>
                            <?php foreach ($MemberSelectRecord as $row) : ?>
                                <option value="<?= $row->member_id; ?>">
                                    <?= $row->member_name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="startTaskProject">Start Date</label>
                                <input type="date" class="form-control" id="task_start">
                            </div>
                            <div class="col">
                                <label for="dueTaskProject">Due Date</label>
                                <input type="date" class="form-control" id="task_due">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="AddTask">Create Task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Insert Task -->

<!-- Modal Update Task -->
<div class="modal fade" id="modal-update-task">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Task</h4>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="update_task_id" placeholder="Project ID" name="update_task_id" required readonly>
                        <input type="hidden" class="form-control" id="update_list_id_task" placeholder="Project ID" name="update_list_id_task" required readonly>
                        <label for="task_name">Task Name</label>
                        <input type="text" class="form-control" id="update_task_name" placeholder="Task Name">
                    </div>
                    <div class="form-group">
                        <label for="CheckingPriority">Priority Task</label>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="update_priority_task" value="PR-3">
                                <label class="form-check-label">Low</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="update_priority_task" value="PR-2">
                                <label class="form-check-label">Medium</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="update_priority_task" value="PR-1">
                                <label class="form-check-label">High</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="MemberTask" class="mr-2">Assign Member</label>
                        <select class="form-control select2bs4" id="update_members_task" name="update_members_task">
                            <?php foreach ($MemberSelectRecord as $row) : ?>
                                <option value="<?= $row->member_id; ?>">
                                    <?= $row->member_name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="startTaskProject">Start Date</label>
                                <input type="date" class="form-control" id="update_task_start">
                            </div>
                            <div class="col">
                                <label for="dueTaskProject">Due Date</label>
                                <input type="date" class="form-control" id="update_task_due">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="UpdateTask">Update Task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Update Project -->

<script>
    $("#tblProjectMember").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            order: [
                [0, "desc"]
            ]

        })
        .buttons()
        .container()
        .appendTo("#tblProjectMember_wrapper .col-md-6:eq(0)");

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

    //Function Update List
    $(document).on('click', '#btnUpList', function() {
        var priority = '<?= $priority_type ?>';
        $("input[name='priority_list'][value='" + priority + "']").prop("checked", true);
    })

    $(document).on('click', '#btnUpdateList', function() {
        var id = '<?= $list_id ?>';
        var title = $('#list_name').val();
        var listStart = $('#list_start').val();
        var listDue = $('#list_due').val();
        var priority = $("input[name='priority_list']:checked").val();
        var description = $('#list_description').summernote('code');
        var listStatus = $('#list_status').val();

        var UpdateList = {
            id: id,
            idProject: '<?= $project_id ?>',
            title: title,
            start: listStart,
            due: listDue,
            priority: priority,
            description: description,
            status: listStatus,
            flag: 0
        };

        var temp_start_date = "<?= $prj_start; ?>";
        var temp_due_date = "<?= $prj_due; ?>";

        if (!id || !title || !listStart || !listDue || !description || !priority) {
            validasiInfo('Please complete all fields before updating list!');
            return;
        }

        if (listStart < temp_start_date || listStart > temp_due_date || (listDue < temp_start_date || listDue > temp_due_date)) {
            validasiInfo('Check interval date list, date list not valid!');
            return;
        }

        // TOOLS
        var updateButton = document.getElementById("btnUpdateList");
        updateButton.disabled = true;
        updateButton.textContent = "Updating...";
        updateButton.classList.add("disabled");

        // console.log(UpdateList);
        updateList(UpdateList);
    })

    function updateList(UpdateList) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateList',
            type: 'POST',
            data: UpdateList,
            success: function(response) {
                $('#modal-update-list').modal('hide');
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
    // End Function Update List

    // Function Add Task
    $(document).on('click', '#AddTask', function() {
        var listId = '<?= $list_id ?>';
        var title = $('#task_name').val();
        var taskStart = $('#task_start').val();
        var taskDue = $('#task_due').val();
        var membersTask = $('#members_task').val();
        var priority = $("input[name='priority_task']:checked").val();

        var temp_start_date = "<?= $start_date; ?>";
        var temp_due_date = "<?= $due_date; ?>";

        if (!listId || !title || !taskStart || !taskDue || !membersTask || !priority) {
            validasiInfo('Please complete all fields before adding project task!');
            return;
        }

        if (taskStart < temp_start_date || taskStart > temp_due_date || (taskDue < temp_start_date || taskDue > temp_due_date)) {
            validasiInfo('Check interval date task, date task not valid!');
            return;
        }

        var AddingItem = {
            list_id: listId,
            title: title,
            start: taskStart,
            due: taskDue,
            priority: priority,
            status: 'STL-1',
            membersTask: membersTask
        };

        // TOOLS
        var addBtnProject = document.getElementById("AddTask");
        addBtnProject.disabled = true;
        addBtnProject.textContent = "Creating...";
        addBtnProject.classList.add("disabled");

        // console.log(AddingItem);
        addTask(AddingItem);
    })

    function addTask(AddingItem) {
        $.ajax({
            url: '<?= base_url(); ?>InsertTask',
            type: 'POST',
            data: AddingItem,
            success: function(response) {
                $('#modal-input-task').modal('hide');
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
    // End Function Add Task

    // Function Update Task
    $(document).on('click', 'i.fa-edit', function() {
        $('#update_task_id').val($(this).data('task_id'));
        $('#update_list_id_task').val($(this).data('list_id'));
        $('#update_task_name').val($(this).data('task_name'));
        $("input[name='update_priority_task'][value='" + $(this).data('priority') + "']").prop("checked", true);
        $('#update_task_start').val($(this).data('start'));
        $('#update_task_due').val($(this).data('due'));
        $('#update_members_task').val($(this).data('task_member'));

        $('#modal-update-task').modal('show');
    })

    $(document).on('click', '#UpdateTask', function() {
        var id = $('#update_task_id').val();
        var list_id = $('#update_list_id_task').val();
        var title = $('#update_task_name').val();
        var projectStart = $('#update_task_start').val();
        var projectDue = $('#update_task_due').val();
        var priority = $("input[name='update_priority_task']:checked").val();
        var member_task = $('#update_members_task').val();

        var temp_start_date = "<?= $start_date; ?>";
        var temp_due_date = "<?= $due_date; ?>";

        if (!list_id || !title || !projectStart || !projectDue || !priority) {
            validasiInfo('Please complete all fields before modifying the item!');
            return;
        }

        if (projectStart < temp_start_date || projectStart > temp_due_date || (projectDue < temp_start_date || projectDue > temp_due_date)) {
            validasiInfo('Check interval date item, date item not valid!');
            return;
        }

        var UpdateTask = {
            id: id,
            list_id: list_id,
            title: title,
            start: projectStart,
            due: projectDue,
            priority: priority,
            status: '',
            memberId: member_task,
            flag: 2
        };


        // TOOLS
        var updateButton = document.getElementById("UpdateTask");
        updateButton.disabled = true;
        updateButton.textContent = "Updating...";
        updateButton.classList.add("disabled");

        // console.log(UpdateTask);
        updateTask(UpdateTask);
        $('#modal-update-task').modal('hide');
    })

    $(document).on('change', 'input[name="todo1"]', function() {
        var isChecked = $(this).is(":checked");
        var id = $(this).data('task_id_check');
        if (isChecked) {
            var UpdateTask = {
                id: id,
                list_id: '<?= $list_id ?>',
                title: '',
                start: '',
                due: '',
                priority: '',
                status: 'STL-4',
                memberId: '',
                flag: 1
            };
            updateTask(UpdateTask);
        } else {
            var UpdateTask = {
                id: id,
                list_id: '<?= $list_id ?>',
                title: '',
                start: '',
                due: '',
                priority: '',
                status: 'STL-2',
                memberId: '',
                flag: 1
            };
            updateTask(UpdateTask);
        }
    });

    function updateTask(UpdateTask) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateTask',
            type: 'POST',
            data: UpdateTask,
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
                console.log(error);
            }
            // complete: function() {
            //     $('#loading-overlay').hide();
            // }
        });
    }

    // End Function Update Task
    // Function Delete Task
    $(document).on('click', 'i.fa-trash', function() {
        var taskId = $(this).data('task_id');
        var listId = $(this).data('list_id');
        var taskName = $(this).data('task_name');

        var delData = {
            id: taskId,
            list_id: listId,
            title: taskName
        }
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to delete this item?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                delTasked(delData);
            }
        });
    })

    function delTasked(params) {
        $.ajax({
            url: '<?= base_url(); ?>DeleteTask',
            type: 'POST',
            data: params,
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
                console.log(error);
                // Tindakan jika terjadi kesalahan
            }
        })
    }
    // End Function Delete Task

    //#Insert Attachment
    $(document).on('click', '#btnAttachment', function() {
        var groupID = '<?= $list_id ?>';
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
        var groupID = '<?= $list_id ?>';

        var deleteData = {
            attachment_id: attachment_id,
            attachment_url: attachment_url,
            group_id: groupID
        }
        Swal.fire({
            title: 'Confirmation!',
            text: 'Are you sure you want to delete this attachment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                DelAttach(deleteData);
            }
        });
    })

    function DelAttach(deleteData) {
        $.ajax({
            url: '<?= base_url() ?>DeleteAttachment',
            type: 'POST',
            data: deleteData,
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
    }

    //#Insert MEMBER
    $(document).on('click', '#btnMember', function() {
        var listId = '<?= $list_id ?>';
        var memberId = $('#member_id').val();
        var memberType = $('#member_type_id').val();

        if (!listId || !memberId || !memberType) {
            validasiInfo('Please complete all fields before adding member items!');
            return;
        }

        var AddingMember = {
            list_id: listId,
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
            url: '<?= base_url(); ?>InsertListMember',
            type: 'POST',
            data: AddingMember,
            success: function(response) {
                $('#modal-input-list-member').modal('hide');
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

    //#Del MEMBER
    $(document).on('click', '#btnDelMember', function() {
        var listMemberId = $(this).data('list_member_id');
        var memberId = $(this).data('member_id');
        // console.log(DeleteMember);
        var deleteData = {
            list_member_id: listMemberId,
            group_id: '<?= $list_id ?>',
            object: memberId
        }
        // TOOLS
        Swal.fire({
            title: 'Confirmation!',
            text: 'Are you sure you want to delete this member?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                DelMember(deleteData);
            }
        });
    })

    function DelMember(deleteData) {
        $.ajax({
            url: '<?= base_url(); ?>DeleteListMember',
            type: 'POST',
            data: deleteData,
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
                console.log(error);
            }
            // complete: function() {
            //     $('#loading-overlay').hide();
            // }
        });
    }

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

    function actBot() {
        var logAct = document.getElementById("logact");
        if (logAct !== null) {
            logAct.scrollTop = logAct.scrollHeight;
        }
    }

    window.onload = function() {
        actBot();
    };
    // # END TOOLS
</script>

<!-- Comment -->
<script>
    var emptyMessage = $("#empty-comment");
    var commentContainer = $("#comment-container");
    var sendMessage = $("#send-comment-form");
    var scrolling = false;

    function fetchMessages() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url(); ?>get_comments',
            data: {
                groupId: '<?= $list_id ?>'
            },
            dataType: 'json',
            success: function(response) {
                commentContainer.show();
                emptyMessage.hide();
                if (response === null) {
                    commentContainer.empty();
                    currentSenderId = null;
                } else if (response.messages !== null && response.messages.length > 0) {
                    var previousScrollHeight = commentContainer[0].scrollHeight;
                    commentContainer.empty();

                    $.each(response.messages, function(index, message) {
                        var potoBox = (message.gender_id === 'GR-001') ? '5.png' : '3.png';
                        if (message.message.trim() !== '') {
                            var messageClass = (message.sender_id == response.current_member_id) ? 'right' : '';
                            var senderName = (message.sender_name === '<?= $this->session->userdata("member_name") ?>') ? 'Anda' : message.sender_name;

                            commentContainer.append(
                                '<div class="direct-chat-msg ' + messageClass + '">' +
                                '<div class="direct-chat-infos clearfix">' +
                                '<span class="direct-chat-name ' + (messageClass === 'right' ? 'float-right' : 'float-left') + '">' + senderName + '</span>' +
                                '<span class="direct-chat-timestamp ' + (messageClass === 'right' ? 'float-left' : 'float-right') + '">' + message.created_at + '</span>' +
                                '</div>' +
                                '<img class="direct-chat-img" src="<?= base_url(); ?>assets/dist/img/avatar' + potoBox + '" alt="User Avatar" style="width: 40px; height: 40px;">' +
                                '<div class="direct-chat-text">' + message.message + '</div>' +
                                '</div>'
                            );
                        }
                    });

                    var newScrollHeight = commentContainer[0].scrollHeight;

                    if (!scrolling || previousScrollHeight < newScrollHeight) {
                        commentContainer.scrollTop(newScrollHeight);
                    }
                } else {
                    commentContainer.hide();
                    emptyMessage.show();
                }
            },
            error: function(error) {
                console.log("Error fetching messages:", error);
            }
        });
    }

    commentContainer.on('scroll', function() {
        scrolling = commentContainer.scrollTop() + commentContainer.innerHeight() < commentContainer[0].scrollHeight;
    });

    setInterval(function() {
        fetchMessages();
    }, 1000);

    $("#send-comment-form").submit(function(event) {
        event.preventDefault();
        var currentMemberId = $("#current-member-id").val();
        var message = $("#message-input").val();

        $.ajax({
            type: 'POST',
            url: '<?= base_url(); ?>insert_comment',
            data: {
                senderId: '',
                currentMemberId: currentMemberId,
                message: message,
                groupId: '<?= $list_id ?>'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var messageClass = (response.message.sender_id == response.current_member_id) ? 'right' : '';
                    commentContainer.append(
                        '<div class="direct-chat-msg ' + messageClass + '">' +
                        '<div class="direct-chat-infos clearfix">' +
                        '<span class="direct-chat-name ' + (messageClass === 'right' ? 'float-right' : 'float-left') + '">' + response.message.sender_name + '</span>' +
                        '<span class="direct-chat-timestamp ' + (messageClass === 'right' ? 'float-left' : 'float-right') + '">' + response.message.created_at + '</span>' +
                        '</div>' +
                        '<img class="direct-chat-img" src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" alt="message user image">' +
                        '<div class="direct-chat-text">' + response.message.message + '</div>' +
                        '</div>'
                    );

                    $("#message-input").val('');

                    var newScrollHeight = commentContainer[0].scrollHeight;
                    commentContainer.scrollTop(newScrollHeight);
                    console.log('Berhasil');
                } else {
                    console.log("Error inserting message:", response.error);
                }
            },
            error: function(error) {
                console.log("Error inserting message:", error);
            }
        });
    });

    fetchMessages();
    emptyMessage.hide();
    commentContainer.show();
    sendMessage.show();
</script>