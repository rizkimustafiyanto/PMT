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
                        <h4>Project</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12 text-right">
                            <a class="btn btn-sm btn-danger" id="btnBack" href="<?= base_url() . 'Project'; ?>">
                                <i class="fa fa-lg fa-reply"></i>
                            </a>
                            <a class="btn btn-sm btn-info" href="<?= base_url() . 'KanbanList/' . $project_id; ?>">
                                <i class="fa fa-lg fa-brands fa-flipboard"></i> Board
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
                            <?php if (($member_id == 'System' || $member_id == $creator || $member_type == 'MT-2') && $status_id != 'STW-2') : ?>
                                <button type="button" class="btn btn-xs btn-tool" style="font-size: 10px;" id="btnUpProject" data-toggle="modal" data-target="#modal-update-project">
                                    <i class="fa fa-lg fa-pen"></i>
                                </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-sm btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </Div>
                    <div class="card-body">
                        <strong><i class="fas fa-file-alt mr-1"></i> Project Name</strong>
                        <p class="text-muted"><?= $project_name ?></p>
                        <hr>
                        <strong><i class="fas fa-receipt mr-1"></i> Project Type</strong>
                        <p class="text-muted"><?= $selected ?></p>
                        <hr>
                        <strong><i class="far fa-calendar-alt mr-1"></i> Start Date</strong>
                        <p class="text-muted"><?= $start_date ?> </p>
                        <hr>
                        <strong><i class="far fa-calendar-alt mr-1"></i> Due Date</strong>
                        <p class="text-muted"><?= $due_date ?> </p>
                        <hr>
                        <strong><i class="fas fa-quote-left mr-1"></i> Status</strong>
                        <p class="text-muted"><?= $name_project_status ?></p>
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
                <!-- Project Attachment -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Project Attachment</div>
                        <div class="card-tools">
                            <?php if ($status_id != 'STW-2') : ?>
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
                                                <?php if (($member_id == 'System' || $member_id == $record->member_id || $member_type == 'MT-2') && $status_id != 'STW-2') : ?>
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
                <!-- Batas Card Attachment -->
                <!-- Card Member -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Members</div>
                        <div class="card-tools">
                            <?php if (($member_id == 'System' || $member_id == $creator || $member_type == 'MT-2') && $status_id != 'STW-2') : ?>
                                <button type="button" class="btn btn-xs btn-tool" id="btnAdd" data-toggle="modal" data-target="#modal-input-project-member">
                                    <i class="fa fa-user-plus"></i>
                                </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="font-size: small;">
                        <div class="col-md-12 text-center">
                            <span class="badge badge-warning"><?= $total_member ?> Members</span>
                        </div>
                        <ul class="users-list clearfix">
                            <?php if (!empty($ProjectMemberRecords)) :
                                foreach ($ProjectMemberRecords as $record) :
                                    $avatar = $record->gender_id == 'GR-001' ? 'avatar5.png' : 'avatar3.png';
                                    $typeM = $record->variable_id;
                            ?>
                                    <li>
                                        <img src="<?= base_url() ?>assets/dist/img/<?= $avatar ?>" alt="User Image" style="width:60px">
                                        <a class="users-list-name" href="javascript:void(0);"><?= $record->member_name ?></a>
                                        <span class="badge badge-<?= ($typeM == 'MT-1') ? 'primary' : (($typeM == 'MT-2') ? 'success' : 'danger') ?>"><?= $record->member_type ?></span>
                                        <?php if (($member_type == 'MT-1' || $member_id == 'System') && $record->member_id != $creation_id &&  $status_id != 'STL-4') : ?>
                                            <a class="btn btn-xs btn-success" data-bs-toggle="dropdown">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        <?php endif; ?>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" data-project_member_id="<?= $record->project_member_id ?>" data-member_id='<?= $record->member_id ?>' data-mtype_id='<?= $typeM ?>' id="slcMember" data-toggle="modal" data-target="#modal-update-project-member">
                                                    <i class="fa fa-pen"></i> Update Member
                                                </a>
                                                <a class="dropdown-item" data-project_member_id="<?= $record->project_member_id ?>" data-member_id='<?= $record->member_id ?>' id="btnDelMember">
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
                        <div class="card-title">List</div>
                        <div class="card-tools">
                            <?php if (($member_id == 'System' || $member_id == $creator || $member_type == 'MT-2') && $status_id != 'STW-2') : ?>
                                <button type="button" class="btn btn-xs btn-tool" id="btnAddList" data-toggle="modal" data-target="#modal-input-list">
                                    <i class="fa fa-file-circle-plus"></i>
                                </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table text-nowrap table-bordered table-striped" style="font-size: 14px;" id="tblProject">
                            <thead>
                                <tr>
                                    <th>List Name</th>
                                    <th>Remaining Days</th>
                                    <th>Status</th>
                                    <th>Member</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($ListRecords)) :
                                    foreach ($ListRecords as $record) :
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
                                        $statusClass = ($statusW == 'STL-1') ? 'badge-primary' : (($statusW == 'STL-2') ? 'badge-warning' : (($statusW == 'STL-3') ? 'badge-danger' : 'badge-success'));

                                ?>
                                        <tr>
                                            <td><?= $record->list_name ?></td>
                                            <td class="text-center">
                                                <span class="badge <?= $badgeClass ?>"><?= $remainingDays ?> Day</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge <?= $statusClass ?>"><?= $record->list_status ?></span>
                                            </td>
                                            <td>
                                                <?php foreach ($ProjectListRecords as $key) :
                                                    if ($record->list_id == $key->list_id) : ?>
                                                        <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($key->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 15px; height: 15px;" title="<?= $key->member_name ?>">
                                                <?php endif;
                                                endforeach; ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-xs btn-info" href="<?= base_url() . 'Task/' . $record->project_id . '/' . $record->list_id ?>"><i class="fa fa-eye"></i></a>
                                                <?php if (($member_type == 'MT-1' || $member_type == 'MT-2' || $member_id == 'System' || $member_id == $record->creation_user_id) && $status_id == 'STW-1') : ?>
                                                    <a id="slcList" class="btn btn-xs btn-primary" data-list_id="<?= $record->list_id ?>" data-project_id="<?= $record->project_id ?>" data-list_name="<?= $record->list_name ?>" data-start="<?= $record->start_date ?>" data-due="<?= $record->due_date ?>" data-priority="<?= $record->priority_type_id ?>" data-list_status="<?= $record->status_id ?>" data-list_description="<?= $record->description; ?>" data-toggle="modal" data-target="#modal-update-list">
                                                        <i class="fa fa-pen"></i>
                                                    </a>
                                                    <a id="delList" class="btn btn-xs btn-danger" data-del_list="<?= $record->list_id ?>"><i class="fa fa-trash"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Batas Card To Do List -->
                <!-- Log Activity -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">LOG Activity</div>
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
                            <p id="empty-comment" class="text-center" style="margin-top: 20px;">Empty Comment</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form id="send-comment-form">
                            <input type="hidden" id="current-member-id" value="<?= $this->session->userdata('member_id') ?>">
                            <div class="input-group">
                                <input type="text" id="message-input" class="form-control" placeholder="Type your comment..." <?= ($status_id == 'STW-1') ? '' : 'disabled' ?>>
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary" <?= ($status_id == 'STW-1') ? '' : 'disabled' ?>>Send</button>
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
<div class="modal fade" id="modal-input-project-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Project Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Member</label>
                                <div class="input-group">
                                    <select class="form-control select2bs4" name="member_id" data-width="100%" id="member_id">
                                        <option value="">-- Select an option --</option>
                                        <?php foreach ($MemberRecords as $row) : ?>
                                            <option value="<?= $row->member_id; ?>">
                                                <?php
                                                if ($row->company_name == "PT Persada Lampung Raya") {
                                                    echo 'PLR - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Persada Palembang Raya") {
                                                    echo 'PPR - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Gita Riau Makmur") {
                                                    echo 'GRM - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Genta Lampung Makmur") {
                                                    echo 'GLM - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Universal Traktor Indonesia") {
                                                    echo 'UTI - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Persada Bangka Raya") {
                                                    echo 'PBR - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Persada Solusi Data") {
                                                    echo 'PSD - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Mega Truckindo Utama") {
                                                    echo 'MTU - ' . $row->member_name;
                                                } else {
                                                    echo $row->company_name . '   -   ' . $row->member_name;
                                                }
                                                ?>

                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Member Type</label>
                                <select class="form-control select2bs4" name="member_type_id" id="member_type_id" data-width=100%>
                                    <?php foreach ($MemberTypeRecords as $row) : ?>
                                        <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" id="btnMember">Add Member</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--#EndProject Modal Insert Member-->

<!--#Project Modal Update Member-->
<div class="modal fade" id="modal-update-project-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Project Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Member</label>
                                <div class="input-group">
                                    <input type="hidden" id="project_member_id_update" class="form-control" placeholder="Member Id" value="" readonly>
                                    <select class="form-control select2bs4" name="member_id_update" data-width="100%" id="member_id_update">
                                        <option value="">-- Choose Member --</option>
                                        <?php foreach ($MemberRecords as $row) : ?>
                                            <option value="<?= $row->member_id; ?>">
                                                <?php
                                                if ($row->company_name == "PT Persada Lampung Raya") {
                                                    echo 'PLR - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Persada Palembang Raya") {
                                                    echo 'PPR - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Gita Riau Makmur") {
                                                    echo 'GRM - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Genta Lampung Makmur") {
                                                    echo 'GLM - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Universal Traktor Indonesia") {
                                                    echo 'UTI - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Persada Bangka Raya") {
                                                    echo 'PBR - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Persada Solusi Data") {
                                                    echo 'PSD - ' . $row->member_name;
                                                } else if ($row->company_name == "PT Mega Truckindo Utama") {
                                                    echo 'MTU - ' . $row->member_name;
                                                } else {
                                                    echo $row->company_name . '   -   ' . $row->member_name;
                                                }
                                                ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Member Type</label>
                                <select class="form-control select2bs4" name="member_type_id_update" id="member_type_id_update" data-width=100%>
                                    <?php foreach ($MemberTypeRecords as $row) : ?>
                                        <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" id="btnUpMember">Update Member</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--#EndProject Modal Update Member-->

<!--#Project Modal Insert Attachment-->
<div class="modal fade" id="modal-input-attachment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Add Project Attachment</div>
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
                            <div style="display:none;">
                                <label>Attachment Type</label>
                                <select class="form-control select2bs4" name="attachment_type" id="attachment_type" data-width=100%>
                                    <?php foreach ($AttachmentTypeRecord as $row) : ?>
                                        <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
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

<!--  Modal Update -->
<div class="modal fade" id="modal-update-project">
    <div class="modal-dialog" style="max-width: 920px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Project</h4>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline" style="max-height: 300px;">
                                <div class="card-header">
                                    <h5 class="card-title" style="width: 90%;">
                                        <input type="text" id="project_name" class="form-control" placeholder="Project Name" value="<?= $project_name ?>">
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
                                <label for="project_type" class="mr-2">Project Type</label>
                                <select class="form-control select2bs4" name="project_type" id="project_type">
                                    <?php foreach ($ProjectTypeRecords as $row) :
                                        $selectType = $row->variable_id == $project_type ? 'selected' : ''; ?>
                                        <option value="<?= $row->variable_id; ?>" <?= $selectType ?>><?= $row->variable_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="startProject">Start Date</label>
                                        <input type="date" class="form-control" id="project_start" value="<?= $start_date ?>">
                                    </div>
                                    <div class="col">
                                        <label for="endProject">End Date</label>
                                        <input type="date" class="form-control" id="project_due" value="<?= $due_date ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="project_status" class="mr-2">Project Status</label>
                                <select class="form-control select2bs4" name="project_status" id="project_status">
                                    <option value="STW-1" selected>-- Select an option --</option>
                                    <?php foreach ($StatusProjectRecords as $row) {
                                        $selectStatus = $row->variable_id == $status_id
                                            ? 'selected' : ''; ?>
                                        <option value="<?= $row->variable_id ?>" <?= $selectStatus ?> class=""><?= $row->project_status ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="UpdateProject">Update Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- #End Modal Update -->

<!-- Modal Insert List -->
<div class="modal fade" id="modal-input-list">
    <div class="modal-dialog" style="max-width: 920px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New List</h4>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline" style="max-height: 300px;">
                                <div class="card-header">
                                    <h5 class="card-title" style="width: 90%;"><input type="text" id="list_name" class="form-control" placeholder="Item Name"></h5>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" href=""><i class="fa fa-pen"></i></a>
                                    </div>
                                </div>
                                <textarea class="editor" name="list_description" id="list_description"></textarea>
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
                                <label for="MemberItem" class="mr-2">Assign Member</label>
                                <select class="form-control" id="members_list_item" name="members_list_item[]" multiple="multiple"></select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="startItemList">Start Date</label>
                                        <input type="date" class="form-control" id="list_start">
                                    </div>
                                    <div class="col">
                                        <label for="dueItemList">Due Date</label>
                                        <input type="date" class="form-control" id="list_due">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="AddList">Create List</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Insert List -->

<!-- Modal Update List -->
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
                                    <input type="hidden" class="form-control" id="update_list_id" placeholder="List ID" name="update_list_id" required readonly>
                                    <input type="hidden" class="form-control" id="update_project_id" placeholder="List ID" name="update_project_id" required readonly>
                                    <h5 class="card-title" style="width: 90%;">
                                        <input type="text" id="update_list_name" name="update_list_name" class="form-control" placeholder="List Name">
                                    </h5>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" href=""><i class="fa fa-pen"></i></a>
                                    </div>
                                </div>
                                <textarea class="editor" name="update_list_description" id="update_list_description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CheckingPriority">Priority List</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="update_priority_list" value="PR-3">
                                        <label class="form-check-label">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="update_priority_list" value="PR-2">
                                        <label class="form-check-label">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="update_priority_list" value="PR-1">
                                        <label class="form-check-label">High</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="startItemList">Start Date</label>
                                        <input type="date" class="form-control" id="update_list_start">
                                    </div>
                                    <div class="col">
                                        <label for="dueItemList">Due Date</label>
                                        <input type="date" class="form-control" id="update_list_due">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="update_list_status" class="mr-2">List Status</label>
                                <select class="form-control select2bs4" name="update_list_status" id="update_list_status">
                                    <?php foreach ($StatusItemRecords as $row) { ?>
                                        <option value="<?= $row->variable_id ?>" class=""><?= $row->list_name ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="UpdateList">Update List</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Update List -->

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
    $("#tblProject").DataTable({
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
        .appendTo("#tblProject_wrapper .col-md-6:eq(0)");

    //Function Update Project
    $(document).on('click', '#UpdateProject', function() {
        var id = '<?= $project_id ?>';
        var title = $('#project_name').val();
        var projectType = $('#project_type').val();
        var projectStart = $('#project_start').val();
        var projectDue = $('#project_due').val();
        var description = $('#project_description').summernote('code');
        var projectStatus = $('#project_status').val();

        var UpdateProject = {
            id: id,
            title: title,
            projectType: projectType,
            start: projectStart,
            due: projectDue,
            description: description,
            status: projectStatus,
            flag: 0
        };

        // TOOLS
        var updateButton = document.getElementById("UpdateProject");
        updateButton.disabled = true;
        updateButton.textContent = "Updating...";
        updateButton.classList.add("disabled");

        // console.log(UpdateProject);
        updateProject(UpdateProject);
    })

    function updateProject(UpdateProject) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateProject',
            type: 'POST',
            data: UpdateProject,
            success: function(response) {
                $('#modal-update-project').modal('hide');
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

    // Function Add List
    $(document).on('click', '#btnAddList', function() {
        handleSelectMember();
    })

    $(document).on('click', '#AddList', function() {
        var itemId = '<?= $project_id ?>';
        var title = $('#list_name').val();
        var projectStart = $('#list_start').val();
        var projectDue = $('#list_due').val();
        var description = $('#list_description').summernote('code');
        var membersList = $('#members_list_item').val();
        var priority = $("input[name='priority_list']:checked").val();

        var temp_start_date = "<?= $start_date; ?>";
        var temp_due_date = "<?= $due_date; ?>";

        if (!itemId || !title || !projectStart || !projectDue || !description || !membersList || !priority) {
            validasiInfo('Please complete all fields before adding project items!');
            return;
        }

        if (projectStart < temp_start_date || projectStart > temp_due_date || (projectDue < temp_start_date || projectDue > temp_due_date)) {
            validasiInfo('Check interval date project, date project not valid!');
            return;
        }

        var AddingProject = {
            idProject: itemId,
            title: title,
            start: projectStart,
            due: projectDue,
            priority: priority,
            status: 'STL-1',
            description: description,
            membersList: JSON.stringify(membersList)
        };

        // TOOLS
        var addBtnProject = document.getElementById("AddList");
        addBtnProject.disabled = true;
        addBtnProject.textContent = "Creating...";
        addBtnProject.classList.add("disabled");

        // console.log(AddingProject);
        addProject(AddingProject);
    })

    function addProject(AddingProject) {
        $.ajax({
            url: '<?= base_url(); ?>InsertList',
            type: 'POST',
            data: AddingProject,
            success: function(response) {
                $('#modal-input-list').modal('hide');
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
    // End Function Add List

    // Function Update List
    $(document).on('click', '#slcList', function() {
        $('#update_list_id').val($(this).data('list_id'));
        $('#update_project_id').val($(this).data('project_id'));
        $('#update_list_name').val($(this).data('list_name'));
        $('#update_list_description').summernote('code', $(this).data('list_description'));
        $("input[name='update_priority_list'][value='" + $(this).data('priority') + "']").prop("checked", true);
        $('#update_list_start').val($(this).data('start'));
        $('#update_list_due').val($(this).data('due'));
        $('#update_list_status').val($(this).data('list_status'));
    })

    $(document).on('click', '#UpdateList', function() {
        var id = $('#update_list_id').val();
        var idProject = $('#update_project_id').val();
        var title = $('#update_list_name').val();
        var projectStart = $('#update_list_start').val();
        var projectDue = $('#update_list_due').val();
        var description = $('#update_list_description').summernote('code');
        var priority = $("input[name='update_priority_list']:checked").val();
        var projectStatus = $('#update_list_status').val();

        var temp_start_date = "<?= $start_date; ?>";
        var temp_due_date = "<?= $due_date; ?>";

        if (!idProject || !title || !projectStart || !projectDue || !description || !priority) {
            validasiInfo('Please complete all fields before modifying the list!');
            return;
        }

        if (projectStart < temp_start_date || projectStart > temp_due_date || (projectDue < temp_start_date || projectDue > temp_due_date)) {
            validasiInfo('Check interval date list, date list not valid!');
            return;
        }

        var UpdateItem = {
            id: id,
            idProject: idProject,
            title: title,
            start: projectStart,
            due: projectDue,
            priority: priority,
            description: description,
            status: projectStatus,
            flag: 0
        };


        // TOOLS
        var updateButton = document.getElementById("UpdateList");
        updateButton.disabled = true;
        updateButton.textContent = "Updating...";
        updateButton.classList.add("disabled");

        // console.log(UpdateItem);
        updateList(UpdateItem);
    })

    function updateList(UpdateItem) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateList',
            type: 'POST',
            data: UpdateItem,
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
    // Function Delete List
    $(document).on('click', '#delList', function() {
        var listId = $(this).data('del_list');
        var deleteData = {
            list_id: listId,
            group_id: '<?= $project_id ?>'
        }
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
                delListed(deleteData);
            }
        });
    })

    function delListed(params) {
        $.ajax({
            url: '<?= base_url(); ?>DeleteList',
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
    // End Function Delete List

    //#Insert Attachment
    $(document).on('click', '#btnAttachment', function() {
        var groupID = '<?= $project_id ?>';
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
        var groupID = '<?= $project_id ?>';

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
        var projectId = '<?= $project_id ?>';
        var memberId = $('#member_id').val();
        var memberType = $('#member_type_id').val();
        var member_status = 'A';

        if (!projectId || !memberId || !memberType) {
            validasiInfo('Please complete all fields before adding member items!');
            return;
        }

        var AddingMember = {
            project_id: projectId,
            member_id: memberId,
            member_type_id: memberType,
            r_status: member_status,
            group_id: '<?= $project_id ?>',
            object: memberId
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
            url: '<?= base_url(); ?>InsertProjectMember',
            type: 'POST',
            data: AddingMember,
            success: function(response) {
                $('#modal-input-project-member').modal('hide');
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

    //#Update MEMBER
    $(document).on('click', '#slcMember', function() {
        $('#project_member_id_update').val($(this).data('project_member_id'));
        $('#member_id_update').val($(this).data('member_id'));
        $('#member_type_id_update').val($(this).data('mtype_id'));
    })

    $(document).on('click', '#btnUpMember', function() {
        var projectId = '<?= $project_id ?>';
        var projectMId = $('#project_member_id_update').val();
        var memberId = $('#member_id_update').val();
        var memberType = $('#member_type_id_update').val();
        var member_status = 'A';

        if (!projectId || !memberId || !memberType) {
            validasiInfo('Please complete all fields before updating member project!');
            return;
        }

        var UpdatingMember = {
            project_id: projectId,
            project_member_id: projectMId,
            member_id: memberId,
            member_type_id: memberType,
            r_status: member_status
        };


        // TOOLS
        var upBtn = document.getElementById("btnUpMember");
        upBtn.disabled = true;
        upBtn.textContent = "Updating...";
        upBtn.classList.add("disabled");

        // console.log(UpdatingMember);
        UpMember(UpdatingMember);
    })

    function UpMember(UpdatingMember) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateProjectMember',
            type: 'POST',
            data: UpdatingMember,
            success: function(response) {
                $('#modal-update-project-member').modal('hide');
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
        var projectMemberId = $(this).data('project_member_id');
        var memberId = $(this).data('member_id');
        var deleteData = {
            project_member_id: projectMemberId,
            group_id: '<?= $project_id ?>',
            object: memberId
        }
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
                // console.log(deleteData);
                DelMember(deleteData);
            }
        });
    })

    function DelMember(deleteData) {
        $.ajax({
            url: '<?= base_url(); ?>DeleteProjectMember',
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

    function colorSelect(member) {
        return $('<span style="color: blue;">' + member.text + '</span>');
    }

    function handleSelectMember() {
        $('#members_list_item').val([]).trigger('change');
        $('#members_list_item').select2({
            placeholder: '-- Choose Members --',
            allowClear: true,
            minimumInputLength: 0,
            data: [
                <?php foreach ($MemberSelectRecord as $key) { ?> {
                        id: "<?= $key->member_id ?>",
                        text: "<?= $key->member_name ?>"
                    },
                <?php } ?>
            ],
            templateSelection: colorSelect
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
                groupId: '<?= $project_id ?>'
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
                groupId: '<?= $project_id ?>'
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