<?php
$project_id = '';
$card_id = '';
$card_name = '';
$description = '';
$start_date = '';
$due_date = '';
$record_status = '';
$name_record_status = '';

$status_id = '';
$list_status = '';
$priority_type_id = '';
$percentage = 0;
$project_status_id = '';

if (!empty($CardRecord)) {
    foreach ($CardRecord as $record) {
        $project_id = $record->project_id;
        $card_id = $record->card_id;
        $card_name = $record->card_name;
        $description = $record->description;
        $start_date = $record->start_date;
        $due_date = $record->due_date;
        $record_status = $record->record_status;
        $name_record_status = $record->name_record_status;
        $status_id = $record->status_id;
        $list_status = $record->list_status;
        $priority_type_id = $record->priority_type_id;
        $percentage = $record->percentage;
        $creation_id = $record->creation_id;
        $project_status_id = $record->project_status_id;
    }
}

$total_member = 0;

if (!empty($CardMemberTotalRecords)) {
    foreach ($CardMemberTotalRecords as $recordTotal) {
        $total_member = $recordTotal->total_member;
    }
}

$member_type = '';

if (!empty($UserMemberRoleCard)) {
    foreach ($UserMemberRoleCard as $recordMemberRoleCard) {
        $member_type = $recordMemberRoleCard->member_type;
    }
}

$creation_project = '';

if (!empty($UserMemberRoleProject)) {
    foreach ($UserMemberRoleProject as $recordMemberRoleCard) {
        $creation_project = $recordMemberRoleCard->creation_project;
    }
}
?>
<style>
    .direct-chat-messages {
        white-space: nowrap;
        overflow-x: auto;
        padding: 10px;
        border: 1px solid #ccc;
    }

    .search-result {
        display: inline-block;
        margin-right: 10px;
    }

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
<!-- Dropdown Toggle -->
<script src="<?php echo base_url(); ?>assets/dist/js/addition/js.js"></script>

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
            <div class="card-header">
                <div class="row ">
                    <div class="col-sm-6">
                        <h2>Detail Card</h2>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-xs-12 text-right">
                            <a class="btn btn-danger" id="btnBack" href="<?php echo base_url() . 'DetailProject/' . $project_id; ?>">
                                <i class="fa fa-lg fa-reply"></i>
                            </a>
                            <?php if (
                                $member_type == 'MT-1' ||
                                $member_id == 'System' ||
                                $member_id == $creation_id
                            ) {
                                if ($status_id == 'STL-2') { ?>
                                    <button type="button" class="btn btn-primary" id="btn-update">
                                        <i class="fa fa-lg fa-save"></i> Update
                                    </button>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= $this->session->unset_userdata('success') ?>

        <?php endif; ?>

        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= $this->session->unset_userdata('error') ?>

        <?php endif; ?>

        <div class="row">
            <div class="col-lg-6">
                <!-- Semula Keterangan -->
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title">Keterangan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <!--Menentukan Type User Card-->
                            <input type="hidden" class="form-control" id="member_type" placeholder="member_type" name="member_type" maxlength="20" readonly="true" value="<?php echo $member_type; ?>" required>
                            <input type="hidden" class="form-control" id="member_id_role" placeholder="member_id" name="member_id" maxlength="20" readonly="true" value="<?php echo $member_id; ?>" required>
                            <input type="hidden" class="form-control" id="status_id_check" placeholder="status_id_check" name="status_id_check" maxlength="20" readonly="true" value="<?php echo $status_id; ?>" required>
                            <!--Menentukan Type User Card-->
                            <input type="hidden" class="form-control" id="project_id" placeholder="Card ID" name="project_id" maxlength="11" readonly="true" value="<?php echo $project_id; ?>" required>
                            <input type="hidden" class="form-control" id="card_id" placeholder="Card ID" name="card_id" maxlength="11" readonly="true" value="<?php echo $card_id; ?>" required>

                            <input type="hidden" class="form-control" id="percentage" placeholder="Card ID" name="percentage" maxlength="11" readonly="true" value="<?php echo $percentage; ?>" required>

                            <!-- Semula -->
                            <div class="col-md-12">
                                <label>Project Status</label>
                                <div class="input-group date">
                                    <input class="form-control" id="" placeholder="Project Status" name="status_id" maxlength="20" value="<?php echo $list_status; ?>" required readonly="true">
                                    <?php if (
                                        $member_type == 'MT-1' ||
                                        $member_id == 'System' ||
                                        $member_type == 'MT-2'
                                    ) {
                                        if ($project_status_id == 'STW-1') {
                                            if (
                                                $status_id == 'STL-1' ||
                                                $status_id == 'STL-2' ||
                                                $status_id == 'STL-3'
                                            ) { ?>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" id="btn_change" data-toggle="modal" data-target="#modal-change-status"><i class="fa fa-exchange-alt" aria-hidden="true"></i> Change</button>
                                                </div>
                                    <?php }
                                        }
                                    } ?>
                                </div>
                                <br>
                            </div>

                            <div class="col-md-12">
                                <label for="card_name">Card Name*</label>
                                <input class="form-control" id="card_name" placeholder="Card Name" name="card_name" maxlength="50" value="<?php echo $card_name; ?>" required>
                                <br>
                            </div>

                            <div class="col-md-12">
                                <label for="description">Description*</label>
                                <textarea class="form-control" id="description" placeholder="Description" name="description" maxlength="1000" required><?php echo $description; ?></textarea>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <label>Priority</label>
                                <select class="form-control select2bs4" name="priority_type_id" id="priority_type_id" data-width=100%>
                                    <?php foreach ($PriorityTypeRecords
                                        as $row) {
                                        $selected =
                                            $row->variable_id ==
                                            $priority_type_id
                                            ? 'selected'
                                            : ''; ?>
                                        <option value="<?= $row->variable_id ?>" <?= $selected ?> class="">
                                            <?= $row->priority_type ?></option>
                                    <?php
                                    } ?>
                                </select>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <label for="start_date">Start Date*</label>
                                <div class="input-group date" id="startDateInsert" data-target-input="nearest">
                                    <input type="text" id="start_date" placeholder="Start Date" name="start_date" class="form-control datetimepicker-input" data-target="#startDateInsert" value="<?php echo date(
                                                                                                                                                                                                        'Y-m-d',
                                                                                                                                                                                                        strtotime($start_date)
                                                                                                                                                                                                    ); ?>" />
                                    <div class="input-group-append" data-target="#startDateInsert" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <label for="due_date">Due Date*</label>
                                <div class="input-group date" id="dueDateInsert" data-target-input="nearest">
                                    <input type="text" id="due_date" placeholder="End Date" name="due_date" class="form-control datetimepicker-input" data-target="#dueDateInsert" value="<?php echo date('Y-m-d', strtotime($due_date)); ?>" />
                                    <div class="input-group-append" data-target="#dueDateInsert" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <br>
                            </div>

                            <div class="col-md-12 progress-group">
                                <label for="card_name">Progress</label>
                                <span class="float-right"><b><?php echo $percentage .
                                                                    ' %'; ?></b></span>
                                <div class="progress progress-sm" style="height: 35px;">
                                    <div class="progress-bar bg-primary" style="width: <?php echo $percentage ?>%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Batas Semula keterangan -->
                <!-- Card Attachment -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Card Attachment List</div>
                        <div class="card-tools">
                            <?php if ($status_id == 'STL-2') : ?>
                                <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-card-attachment">
                                    <i class="fa fa-plus"></i> Add Attachment
                                </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tblCardAttachment" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Attachment Name</th>
                                    <th>Attachment Type</th>
                                    <th>Member Upload</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($CardAttachmentRecord)) :
                                    foreach ($CardAttachmentRecord as $record) : ?>
                                        <tr>
                                            <td><?= $record->attachment_name ?></td>
                                            <td><?= $record->attachment_type_name ?></td>
                                            <td><?= $record->member_upload ?></td>
                                            <td class="text-center">
                                                <a id="btnDownload" class="btn btn-xs btn-success" href="<?= base_url('Download/' . $record->project_id . '/' . $record->card_id . '/' . $record->card_attachment_id . '/' . $record->attachment_url) ?>">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a href="<?= base_url('Upload/' . $record->attachment_url) ?>" target="_blank" class="btn btn-xs btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <?php if ($member_type == 'MT-1' || $member_id == 'System' || $member_id == $record->creation_user_id) :
                                                    if ($status_id == 'STL-2') : ?>
                                                        <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?= base_url('DeleteCardAttachment/' . $record->project_id . '/' . $record->card_id . '/' . $record->card_attachment_id) ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                <?php endif;
                                                endif; ?>
                                            </td>
                                        </tr>
                                <?php endforeach;
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Batas Card Attachment -->
                <!-- Card Member -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="card-title">Members</div>
                        </div>
                        <div class="card-tools">
                            <?php if ($member_type == 'MT-1' || $member_id == 'System' || $member_id == $creation_id) : ?>
                                <?php if ($status_id == 'STL-2') : ?>
                                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-card-member">
                                        <i class="fa fa-plus"></i> Add Card Member
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="height:290px; overflow: auto;">
                        <div class="col-md-12 text-center">
                            <span class="badge badge-warning"><?= $total_member ?> Members</span>
                        </div>
                        <ul class="users-list clearfix">
                            <?php if (!empty($CardMemberRecord)) : ?>
                                <?php foreach ($CardMemberRecord as $record) : ?>
                                    <?php $avatar = $record->gender_id == 'GR-001' ? 'avatar5.png' : 'avatar3.png'; ?>
                                    <li>
                                        <img src="<?= base_url() ?>assets/dist/img/<?= $avatar ?>" alt="User Image" style="width:120px">
                                        <a class="users-list-name" href="#"><?= $record->member_name ?></a>
                                        <span class="badge badge-success"><?= $record->member_type ?></span>
                                        <?php if (($member_type == 'MT-1' || $member_id == 'System' || $member_id == $creation_id) && $record->member_id != $creation_id && $record->member_id != $creation_project && $status_id == 'STL-2') : ?>
                                            <a class="btn btn-xs btn-success" data-bs-toggle="dropdown">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        <?php endif; ?>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item tombol-hapus" href="<?= base_url() ?>DeleteCardMember/<?= $record->project_id ?>/<?= $record->card_id ?>/<?= $record->card_member_id ?>">
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
                    <div class="card-header border-transparent">
                        <div class="card-title">Item List</div>
                        <div class="card-tools">
                            <?php if (
                                $member_type == 'MT-1' ||
                                $member_id == 'System' ||
                                $member_type == 'MT-2'
                            ) {
                                if ($status_id == 'STL-2') { ?>
                                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-checklist-item">
                                        <i class="fa fa-plus"></i> Add
                                    </button>
                            <?php }
                            } ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table text-nowrap" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <?php if ($status_id == 'STL-2') : ?>
                                            <th>Ceklis</th>
                                        <?php endif; ?>
                                        <th>Project Item</th>
                                        <th>Member</th>
                                        <th>Remaining Days</th>
                                        <th>Updated By</th>
                                        <?php if ($member_type == 'MT-1' || $member_id == 'System' || $member_type == 'MT-2') : ?>
                                            <?php if ($status_id == 'STL-2') : ?>
                                                <th class="text-center">Action</th>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($ChecklistItemRecord)) :
                                        foreach ($ChecklistItemRecord as $record) :
                                            $showCheckbox = ($status_id == 'STL-2' && ($member_type == 'MT-1' || $member_id == 'System' || $member_id == $record->creation_user_id || $record->member_id == $member_id));
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

                                    ?>
                                            <tr>
                                                <?php if ($showCheckbox) : ?>
                                                    <td class="text-center">
                                                        <input type="checkbox" name="my-checkbox" id="CheckedList" style="cursor:pointer" data-data_1="<?= $record->checklist_item_id ?>" data-data_2="<?= $record->card_id ?>" <?= ($record->flag_status == 100) ? 'checked' : '' ?> data-data_3="<?= ($record->flag_status == 100) ? 'unchecked' : 'checked' ?>">
                                                    </td>
                                                <?php endif; ?>
                                                <td><?= $record->checklist_item_name ?></td>
                                                <td><?= $record->member_name ?></td>
                                                <td class="text-center">
                                                    <span class="badge <?= $badgeClass ?>"><?= $remainingDays ?> Hari</span>
                                                </td>
                                                <td><?= $record->change_user_name ?></td>
                                                <?php if ($member_type == 'MT-1' || $member_id == 'System' || $member_type == 'MT-2') :
                                                    if ($status_id == 'STL-2') : ?>
                                                        <td class="text-center">
                                                            <?php if ($member_type == 'MT-1' || $member_id == 'System' || $member_id == $record->creation_user_id) : ?>
                                                                <a id="btnSelect" class="btn btn-xs btn-primary" data-data_1="<?= $record->checklist_item_id ?>" data-data_2="<?= $record->card_id ?>" data-data_3="<?= $record->checklist_item_name ?>" data-data_4="<?= $record->flag_status ?>" data-data_5="<?= $record->member_id ?>" data-data_6="<?= date('Y-m-d', strtotime($record->start_date)) ?>" data-data_7="<?= date('Y-m-d', strtotime($record->due_date)) ?>" data-toggle="modal" data-target="#modal-update-checklist-item"><i class="fa fa-pen"></i></a>
                                                                <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?= base_url() . 'DeleteChecklistItem/' . $record->project_id . '/' . $record->card_id . '/' . $record->checklist_item_id ?>"><i class="fa fa-trash"></i></a>
                                                            <?php else : ?>
                                                                Not Action
                                                            <?php endif; ?>
                                                        </td>
                                                <?php endif;
                                                endif; ?>
                                            </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Batas Card To Do List -->
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
                                                <span class="direct-chat-name float-left"><?php echo $record->member_name; ?></span>
                                                <span class="direct-chat-timestamp float-right">
                                                    <?php
                                                    echo $record->change_datetime;
                                                    if ($record->change_no > 0) {
                                                        echo '  (edited)';
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <img class="direct-chat-img" src="<?php echo base_url(); ?>assets/dist/img/user1-128x128.jpg" alt="message user image">
                                            <div class="direct-chat-text">
                                                <?php echo $record->comment; ?>
                                            </div>
                                            <?php if ($record->member_id == $member_id) { ?>
                                                <!-- .direct-chat-text -->
                                            <?php } ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-right"><?php echo $record->member_name; ?></span>
                                                <span class="direct-chat-timestamp float-left">
                                                    <?php
                                                    echo $record->change_datetime;
                                                    if ($record->change_no > 0) {
                                                        echo '  (edited)';
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <img class="direct-chat-img" src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" alt="message user image">
                                            <div class="direct-chat-text">
                                                <?php echo $record->comment; ?>
                                            </div>
                                        </div>
                            <?php }
                                }
                            } ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="<?php echo base_url(); ?>InsertCardComment" method="post">
                            <input type="hidden" name="project_id" placeholder="" value="<?php echo $project_id; ?>">
                            <input type="hidden" name="card_id" placeholder="" value="<?php echo $card_id; ?>">
                            <?php if ($status_id == 'STL-2') { ?>
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
        <!-- Batas Card Ubah Activity -->
</div>
</div>
</section>
</div>

<!--#Region Modal Change-->
<div class="modal fade" id="modal-change-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Change Status Project</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>ChangeStatusProjectProjectBoardCard" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="Card ID" name="card_id" value="<?php echo $card_id; ?>" maxlength="11" required readonly="true">
                            <label>Status</label>
                            <select class="form-control select2bs4" name="status_id" id="status_id" data-width=100%>
                                <?php foreach ($ListStatusRecords as $row) {
                                    $selected =
                                        $row->variable_id == $status_id
                                        ? 'selected'
                                        : ''; ?>
                                    <option value="<?= $row->variable_id ?>" <?= $selected ?> class="">
                                        <?= $row->list_name ?></option>
                                <?php
                                } ?>
                            </select>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="submit" id="btnSubmit" class="btn btn-primary" value="Save" />
                    <input type="reset" class="btn btn-default" value="Reset" />
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--#EndRegion Modal Change-->

<!--#Region Modal Insert-->
<div class="modal fade" id="modal-input-card-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Add Card Member</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>InsertCardMember" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="Card ID" name="card_id" maxlength="11" value="<?php echo $card_id; ?>" required readonly="true">

                            <label>Member</label>
                            <select class="form-control select2bs4" name="member_id" data-width=100%>
                                <?php foreach ($ProjectMemberRecords
                                    as $row) : ?>
                                    <option value="<?php echo $row->member_id; ?>"><?php echo $row->member_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>

                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="submit" id="btnSubmit" class="btn btn-primary" value="Save" />
                    <input type="reset" class="btn btn-default" value="Reset" />
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--#EndRegion Modal Insert-->

<!--#Region Modal Insert-->
<div class="modal fade" id="modal-input-card-attachment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Add Card Attachment</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>InsertCardAttachment" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">

                            <input type="hidden" class="form-control" id="" placeholder="Card ID" name="card_id" maxlength="11" value="<?php echo $card_id; ?>" required readonly="true">

                            <label for="attachment_name">Attachment Name</label>
                            <input class="form-control" id="" placeholder="Attachment Name" name="attachment_name" maxlength="50" required>
                            <br>
                            <label>Attachment Type</label>
                            <select class="form-control select2bs4" name="attachment_type" data-width=100%>
                                <?php foreach ($AttachmentTypeRecord
                                    as $row) : ?>
                                    <option value="<?php echo $row->variable_id; ?>"><?php echo $row->variable_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <label for="attachment_url">Attachment</label>
                            <input class="form-control" type="file" name="image" id="image" required accept=".jpeg,.jpg,.png,.pdf">
                            <small>
                                <font color="red">Type file : jpeg/jpg/png/pdf/xlsx/docx</font>
                            </small>
                            <br>


                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="submit" id="btnSubmit" class="btn btn-primary" value="Save" />
                    <input type="reset" class="btn btn-default" value="Reset" />
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--#EndRegion Modal Insert-->

<!--#Region Modal Insert-->
<div class="modal fade" id="modal-input-checklist-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Add Project Item</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>InsertChecklistItem" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="Card ID" name="card_id" maxlength="11" value="<?php echo $card_id; ?>" required readonly="true">

                            <label for="checklist_item_name">Checklist Item Name</label>
                            <input class="form-control" id="" placeholder="Checklist Item Name" name="checklist_item_name" maxlength="100" required>
                            <br>
                            <label>Member</label>
                            <select class="form-control select2bs4" name="member_id" data-width=100%>
                                <?php foreach ($CardMemberRecord as $row) : ?>
                                    <option value="<?php echo $row->member_id; ?>"><?php echo $row->member_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <input type="hidden" class="form-control" id="" placeholder="Temp Start Date" name="temp_start_date" maxlength="100" value="<?php echo date(
                                                                                                                                                            'Y-m-d',
                                                                                                                                                            strtotime($start_date)
                                                                                                                                                        ); ?>">
                            <input type="hidden" class="form-control" id="" placeholder="Temp Due Date" name="temp_due_date" maxlength="100" value="<?php echo date(
                                                                                                                                                        'Y-m-d',
                                                                                                                                                        strtotime($due_date)
                                                                                                                                                    ); ?>">
                            <label for="start_date">Start Date*</label>
                            <div class="input-group date" id="startDateInsertCheck" data-target-input="nearest">
                                <input type="text" id="" placeholder="Start Date" name="start_date" class="form-control datetimepicker-input" data-target="#startDateInsertCheck" required />
                                <div class="input-group-append" data-target="#startDateInsertCheck" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <br>
                            <label for="due_date">Due Date*</label>
                            <div class="input-group date" id="dueDateInsertCheck" data-target-input="nearest">
                                <input type="text" id="" placeholder="End Date" name="due_date" class="form-control datetimepicker-input" data-target="#dueDateInsertCheck" required />
                                <div class="input-group-append" data-target="#dueDateInsertCheck" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <br>

                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="submit" id="btnSubmit" class="btn btn-primary" value="Save" />
                    <input type="reset" class="btn btn-default" value="Reset" />
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--#EndRegion Modal Insert-->

<!--#Region Modal Update checklist item-->
<div class="modal fade" id="modal-update-checklist-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Edit Project Item</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>UpdateChecklistItem" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="Card ID" name="card_id" maxlength="11" value="<?php echo $card_id; ?>" required readonly="true">

                            <input type="hidden" class="form-control" id="checklist_item_id" placeholder="Checklist Item ID" name="checklist_item_id" readonly="true" maxlength="11" required>

                            <label for="checklist_item_name">Checklist Item Name</label>
                            <input class="form-control" id="checklist_item_name" placeholder="Checklist Item Name" name="checklist_item_name" maxlength="100" required>
                            <br>
                            <label>Member</label>
                            <select class="form-control select2bs4" id="member_id_check" name="member_id" data-width=100%>
                                <?php foreach ($CardMemberRecord as $row) : ?>
                                    <option value="<?php echo $row->member_id; ?>"><?php echo $row->member_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <input type="hidden" class="form-control" id="" placeholder="Temp Start Date" name="temp_start_date" maxlength="100" value="<?php echo date(
                                                                                                                                                            'Y-m-d',
                                                                                                                                                            strtotime($start_date)
                                                                                                                                                        ); ?>">
                            <input type="hidden" class="form-control" id="" placeholder="Temp Due Date" name="temp_due_date" maxlength="100" value="<?php echo date(
                                                                                                                                                        'Y-m-d',
                                                                                                                                                        strtotime($due_date)
                                                                                                                                                    ); ?>">
                            <label for="start_date">Start Date*</label>
                            <div class="input-group date" id="startDateUpdate" data-target-input="nearest">
                                <input type="text" id="start_date_check" placeholder="Start Date" name="start_date" class="form-control datetimepicker-input" data-target="#startDateUpdate" />
                                <div class="input-group-append" data-target="#startDateUpdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <br>
                            <label for="due_date">Due Date*</label>
                            <div class="input-group date" id="dueDateUpdate" data-target-input="nearest">
                                <input type="text" id="due_date_check" placeholder="End Date" name="due_date" class="form-control datetimepicker-input" data-target="#dueDateUpdate" />
                                <div class="input-group-append" data-target="#dueDateUpdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="submit" id="btnUpdate" class="btn btn-primary" value="Update" />
                    <input type="reset" class="btn btn-default" value="Reset" />
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--#EndRegion Modal Update checklist item-->



<script>
    if ($("#member_type").val() == "MT-1" || $("#member_id_role").val() == "System" || $("#member_id_role").val() == '<?php echo $creation_id; ?>') {
        if ($("#status_id_check").val() == "STL-5" || $("#status_id_check").val() == "STL-4" || $("#status_id_check").val() == "STL-3") {
            if ($("#status_id_check").val() == "STL-3") {
                document.getElementById("status_id").enabled = true;
            } else {
                document.getElementById("status_id").disabled = true;
            }
            document.getElementById("card_name").disabled = true;
            document.getElementById("description").disabled = true;
            document.getElementById("start_date").disabled = true;
            document.getElementById("due_date").disabled = true;
            document.getElementById("priority_type_id").disabled = true;
        } else {
            document.getElementById("card_name").enabled = true;
            document.getElementById("status_id").enabled = true;
            document.getElementById("description").enabled = true;
            document.getElementById("start_date").enabled = true;
            document.getElementById("due_date").enabled = true;
            document.getElementById("priority_type_id").enabled = true;
        }
    } else {
        document.getElementById("card_name").disabled = true;
        document.getElementById("status_id").enabled = true;
        document.getElementById("description").disabled = true;
        document.getElementById("start_date").disabled = true;
        document.getElementById("due_date").disabled = true;
        document.getElementById("priority_type_id").disabled = true;

    }



    $(document).on("click", "#btnSelect", function() {
        //card_checklist_id_update
        //checklist_item_name
        var checklist_item_id = $(this).data("data_1");
        var card_id = $(this).data("data_2");
        var checklist_item_name = $(this).data("data_3");
        var member_id_check = $(this).data("data_5");
        var start_date_check = $(this).data("data_6");
        var due_date_check = $(this).data("data_7");

        $("#checklist_item_id").val(checklist_item_id);
        $("#card_id_update").val(card_id);
        $("#checklist_item_name").val(checklist_item_name);
        $("#member_id_check").val(member_id_check).trigger('change');
        $("#start_date_check").val(start_date_check);
        $("#due_date_check").val(due_date_check);
    });

    $("#tblChecklistItemList")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],

        })
        .buttons()
        .container()
        .appendTo("#tblChecklistItemList_wrapper .col-md-6:eq(0)");

    $("#tblCardAttachment")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            order: [
                [0, "desc"]
            ]

        })
        .buttons()
        .container()
        .appendTo("#tblCardAttachment_wrapper .col-md-6:eq(0)");

    $("#btn-update").click(function() {
        var card_id = $("#card_id").val();
        var project_id = $("#project_id").val();
        var card_name = $("#card_name").val();
        var description = $("#description").val();
        var start_date = $("#start_date").val();
        var due_date = $("#due_date").val();
        var priority_type_id = $("#priority_type_id").val();

        console.log('tes');

        $.ajax({
            url: '<?php echo base_url(); ?>UpdateCard',
            data: {
                card_id: card_id,
                project_id: project_id,
                card_name: card_name,
                description: description,
                start_date: start_date,
                due_date: due_date,
                priority_type_id: priority_type_id,

            },
            type: "post",
            async: true,
            dataType: 'json',
            cache: false,
            success: function(response) {
                if (response != null) {
                    window.location.href = "<?php echo base_url() .
                                                'DetailCard/' .
                                                $project_id .
                                                '/' .
                                                $card_id; ?> "
                } else {
                    alert("Data Null");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // Ketika terjadi error        
                alert(xhr.responseText);
                // munculkan alert      
            }
        })
    });

    $(document).on("click", "#CheckedList", function() {
        var checklist_item_id = $(this).data("data_1");
        var card_id = $(this).data("data_2");
        var status = $(this).data("data_3");

        $.ajax({
            url: '<?php echo base_url(); ?>UpdateChecklistItemChecked',
            data: {
                checklist_item_id: checklist_item_id,
                card_id: card_id,
                status: status
            },
            type: "post",
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = "<?php echo base_url() . 'DetailCard/' . $project_id . '/' . $card_id; ?>";
                } else {
                    alert("Data Null");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
                //Di echo thrownError aja
            }
        });
    });



    $('#startDateInsert').datetimepicker({
        format: 'yyyy-MM-DD'
    });

    $('#dueDateInsert').datetimepicker({
        format: 'yyyy-MM-DD'
    });

    $('#startDateInsertCheck').datetimepicker({
        format: 'yyyy-MM-DD'
    });

    $('#dueDateInsertCheck').datetimepicker({
        format: 'yyyy-MM-DD'
    });

    $('#startDateUpdate').datetimepicker({
        format: 'yyyy-MM-DD'
    });

    $('#dueDateUpdate').datetimepicker({
        format: 'yyyy-MM-DD'
    });

    document.getElementById('search-input').addEventListener('input', function(e) {
        var searchQuery = e.target.value.toLowerCase();
        var logItems = document.getElementsByClassName('log-item');

        for (var i = 0; i < logItems.length; i++) {
            var logItem = logItems[i];
            var logText = logItem.textContent.toLowerCase();

            if (logText.indexOf(searchQuery) > -1) {
                logItem.style.display = 'block';
            } else {
                logItem.style.display = 'none';
            }
        }
    });
</script>