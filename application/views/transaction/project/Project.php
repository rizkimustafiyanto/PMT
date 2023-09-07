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
<?php
$project_wrk_id = '';
$project_name = '';
$project_type = '';
$description = '';
$record_status = '';
$name_record_status = '';
$creation_id = '';
$status_wrk_id = '';
$name_project_status = '';
$start_date = '';
$due_date = '';
$percentage = 0;

if (!empty($ProjectWrkRecords)) {
    foreach ($ProjectWrkRecords as $record) {
        $project_wrk_id = $record->project_wrk_id;
        $project_name = $record->project_name;
        $project_type = $record->project_type;
        $start_date = $record->start_date;
        $due_date = $record->due_date;
        $description = $record->description;
        $record_status = $record->record_status;
        $name_record_status = $record->name_record_status;
        $creation_id = $record->creation_id;
        $status_wrk_id = $record->status_wrk_id;
        $percentage = $record->percentage;
        $name_project_status = $record->name_project_status;
    }
}

$total_member = 0;

if (!empty($ProjectMemberTotalRecords)) {
    foreach ($ProjectMemberTotalRecords as $recordTotal) {
        $total_member = $recordTotal->total_member;
    }
}

$member_type = '';

if (!empty($UserMemberRoleProject)) {
    foreach ($UserMemberRoleProject as $recordMemberRoleProject) {
        $member_type = $recordMemberRoleProject->member_type;
    }
}

foreach ($ProjectTypeRecords as $row) {
    if ($row->variable_id == $project_type) {
        $selected = $row->variable_name;
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
                        <h4>Project Workspace</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12 text-right">
                            <a class="btn btn-sm btn-danger" id="btnBack" href="<?= base_url() . 'ProjectWrk'; ?>">
                                <i class="fa fa-lg fa-reply"></i>
                            </a>
                            <a class="btn btn-sm btn-info" href="<?= base_url() . 'KanbanProject/' . $project_wrk_id; ?>">
                                <i class="fa fa-lg fa-eye"></i> Kanban
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
                            <?php if ($member_type == 'MT-1' || $member_id == 'System') {
                                if ($status_wrk_id == 'STW-1') { ?>
                                    <button type="button" class="btn btn-xs btn-primary" id="btnUpProject" data-toggle="modal" data-target="#modal-update-project-wrk">
                                        <i class="fa fa-lg fa-pen"></i>
                                    </button>
                            <?php }
                            } ?>
                            <button type="button" class="btn btn-sm btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </Div>
                    <div class="card-body">
                        <strong><i class="fas fa-quote-left mr-1"></i> Project Status</strong>
                        <p class="text-muted"><?= $name_project_status ?></p>
                        <hr>
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
                        <strong><i class="fas fa-info mr-1"></i> Description</strong>
                        <p class="text-muted"><?= $description ?></p>
                        <hr>
                        <div class="col-md-12 progress-group">
                            <label for="card_name">Progress</label>
                            <span class="float-right"><b><?= $percentage . ' %'; ?></b></span>
                            <div class="progress progress-sm" style="height: 35px;">
                                <div class="progress-bar bg-primary" style="width: <?= $percentage ?>%"></div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <!-- Batas Description -->
                <!-- Project Workspace Attachment -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Project Workspace Attachment</div>
                        <div class="card-tools">
                            <?php if ($status_wrk_id == 'STW-1') : ?>
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
                                                <?php if (($member_type == 'MT-1' || $member_id == 'System' || $member_id == $record->creation_user_id) && $status_wrk_id == 'STW-1') : ?>
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
                        <div class="card-title">
                            <div class="card-title">Members</div>
                        </div>
                        <div class="card-tools">
                            <?php if ($member_type == 'MT-1' || $member_id == 'System') {
                                if ($status_wrk_id == 'STW-1') { ?>
                                    <button type="button" class="btn btn-xs btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-project-member">
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
                            <?php if (!empty($ProjectMemberRecords)) :
                                foreach ($ProjectMemberRecords as $record) : ?>
                                    <?php $avatar = $record->gender_id == 'GR-001' ? 'avatar5.png' : 'avatar3.png'; ?>
                                    <li>
                                        <img src="<?= base_url() ?>assets/dist/img/<?= $avatar ?>" alt="User Image" style="width:60px">
                                        <a class="users-list-name" href="#"><?= $record->member_name ?></a>
                                        <span class="badge badge-success"><?= $record->member_type ?></span>
                                        <?php if (($member_type == 'MT-1' || $member_id == 'System') && $record->member_id != $creation_id &&  $status_wrk_id == 'STW-1') : ?>
                                            <a class="btn btn-xs btn-success" data-bs-toggle="dropdown">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        <?php endif; ?>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item tombol-hapus" href="<?= base_url() . 'DeleteProjectWrkMember/' . $record->project_wrk_member_id . '/' . $record->project_wrk_id; ?>">
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
                        <div class="card-title">Project List</div>
                        <div class="card-tools">
                            <?php if (
                                $member_type == 'MT-1' ||
                                $member_id == 'System' ||
                                $member_type == 'MT-2'
                            ) {
                                if ($status_wrk_id == 'STW-1') { ?>
                                    <button type="button" class="btn btn-xs btn-primary" id="btnAddProject" data-toggle="modal" data-target="#modal-input-project">
                                        <i class="fa fa-plus"></i> Add
                                    </button>
                            <?php }
                            } ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table text-nowrap table-bordered table-striped" style="font-size: 14px;" id="tblProject">
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Remaining Days</th>
                                    <th>Member</th>
                                    <th>Description</th>
                                    <th>Updated By</th>
                                    <?php if ($member_type == 'MT-1' || $member_id == 'System' || $member_type == 'MT-2') : ?>
                                        <?php if ($status_wrk_id == 'STW-1') : ?>
                                            <th class="text-center">Action</th>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($ProjectRecords)) :
                                    foreach ($ProjectRecords as $record) :
                                        $showCheckbox = ($status_wrk_id == 'STW-1' && ($member_type == 'MT-1' || $member_id == 'System' || $member_id == $record->creation_user_id || $record->member_id == $member_id));
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
                                            <td><?= $record->project_name ?></td>
                                            <td class="text-center">
                                                <span class="badge <?= $badgeClass ?>"><?= $remainingDays ?> Hari</span>
                                            </td>
                                            <td><?= $record->member_name ?></td>
                                            <td><?= $record->description ?></td>
                                            <td><?= $record->change_user_name ?></td>
                                            <?php if ($member_type == 'MT-1' || $member_id == 'System' || $member_type == 'MT-2') :
                                                if ($status_wrk_id == 'STW-1') : ?>
                                                    <td class="text-center">
                                                        <?php if ($member_type == 'MT-1' || $member_id == 'System' || $member_id == $record->creation_user_id) : ?>
                                                            <a id="slcProject" class="btn btn-xs btn-primary" data-item_id_list="<?= $record->project_id ?>" data-project_wrk_id_list="<?= $record->project_wrk_id ?>" data-project_item_name="<?= $record->project_name ?>" data-start="<?= $record->start_date ?>" data-due="<?= $record->due_date ?>" data-priority="<?= $record->priority_type_id ?>" data-list_status_item="<?= $record->status_id ?>" data-list_description_item="<?= $record->description; ?>" data-toggle="modal" data-target="#modal-update-project">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                            <a class="btn btn-xs btn-info" href="<?= base_url() . 'ProjectItem/' . $record->project_wrk_id . '/' . $record->project_id ?>"><i class="fa fa-eye"></i></a>
                                                            <a id="delProject" class="btn btn-xs btn-danger" data-del_project="<?= $record->project_id ?>"><i class="fa fa-trash"></i></a>
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
                            <?php if ($status_wrk_id == 'STW-1') { ?>
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
<div class="modal fade" id="modal-input-project-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Project Wrokspace Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= base_url(); ?>InsertProjectWrkMember" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_wrk_id" maxlength="20" value="<?= $project_wrk_id; ?>" required readonly="true">
                            <!-- //ubah -->
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
                            <!-- //ubah -->
                            <!-- <label>Member</label>
                            <select class="form-control select2bs4" name="" data-width=100%>
                                <?php foreach ($MemberRecords as $row) : ?>
                                    <option value="<?= $row->member_id; ?>"><?= $row->company_name . ' - ' . $row->member_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select> -->
                            <br>
                            <label>Member Type</label>
                            <select class="form-control select2bs4" name="member_type_id" data-width=100%>
                                <?php foreach ($MemberTypeRecords as $row) : ?>
                                    <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?>
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
<!--#EndProject Modal Insert Member-->

<!--#Project Modal Insert Attachment-->
<div class="modal fade" id="modal-input-attachment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Add Project Workspace Attachment</div>
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

<!-- #Workspace Modal Update -->
<div class="modal fade" id="modal-update-project-wrk">
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
                                    <?php foreach ($StatusProjectWrkRecords as $row) {
                                        $selectStatus = $row->variable_id == $status_wrk_id
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
                        <button type="button" class="btn btn-primary" id="UpdateProjectWrk">Update Project Wrokspace</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- #End Workspace Modal Update -->

<!-- Modal Insert Project -->
<div class="modal fade" id="modal-input-project">
    <div class="modal-dialog" style="max-width: 920px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Project</h4>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline" style="max-height: 300px;">
                                <div class="card-header">
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
                                        <input type="date" class="form-control" id="project_item_start">
                                    </div>
                                    <div class="col">
                                        <label for="dueItemProject">Due Date</label>
                                        <input type="date" class="form-control" id="project_item_due">
                                    </div>
                                </div>
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
<!-- Modal Insert Project -->

<!-- Modal Update Project -->
<div class="modal fade" id="modal-update-project">
    <div class="modal-dialog" style="max-width: 920px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Project</h4>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline" style="max-height: 300px;">
                                <div class="card-header">
                                    <input type="hidden" class="form-control" id="update_item_id" placeholder="Project ID" name="update_item_id" required readonly>
                                    <input type="hidden" class="form-control" id="update_project_wrk_id_item" placeholder="Project ID" name="update_project_wrk_id_item" required readonly>
                                    <h5 class="card-title" style="width: 90%;">
                                        <input type="text" id="update_item_name" name="update_item_name" class="form-control" placeholder="Project Name">
                                    </h5>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" href=""><i class="fa fa-pen"></i></a>
                                    </div>
                                </div>
                                <textarea class="editor" name="update_item_description" id="update_item_description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CheckingPriority">Priority Project</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="update_priority_project" value="PR-3">
                                        <label class="form-check-label">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="update_priority_project" value="PR-2">
                                        <label class="form-check-label">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="update_priority_project" value="PR-1">
                                        <label class="form-check-label">High</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="startItemProject">Start Date</label>
                                        <input type="date" class="form-control" id="update_item_start">
                                    </div>
                                    <div class="col">
                                        <label for="dueItemProject">Due Date</label>
                                        <input type="date" class="form-control" id="update_item_due">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="update_item_status" class="mr-2">Item Status</label>
                                <select class="form-control select2bs4" name="update_item_status" id="update_item_status">
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
                        <button type="button" class="btn btn-primary" id="UpdateProject">Update Project</button>
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
    $(document).on('click', '#UpdateProjectWrk', function() {
        var id = '<?= $project_wrk_id ?>';
        var title = $('#project_name').val();
        var projectType = $('#project_type').val();
        var projectStart = $('#project_start').val();
        var projectDue = $('#project_due').val();
        var description = tinymce.get('project_description').getContent();
        var projectStatus = $('#project_status').val();

        var UpdateProjectWrk = {
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
        var updateButton = document.getElementById("UpdateProjectWrk");
        updateButton.disabled = true;
        updateButton.textContent = "Updating...";
        updateButton.classList.add("disabled");

        // console.log(UpdateProjectWrk);
        updateProjectWrk(UpdateProjectWrk);
    })

    function updateProjectWrk(UpdateProjectWrk) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateProjectWrk',
            type: 'POST',
            data: UpdateProjectWrk,
            success: function(response) {
                $('#modal-update-project-wrk').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
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

    // Function Add Item Project
    $(document).on('click', '#btnAddProject', function() {
        handleSelectMember();
    })

    $(document).on('click', '#AddProject', function() {
        var itemId = '<?= $project_wrk_id ?>';
        var title = $('#item_name').val();
        var projectStart = $('#project_item_start').val();
        var projectDue = $('#project_item_due').val();
        var description = tinymce.get('item_description').getContent();
        var membersItem = $('#members_project_item').val();
        var priority = $("input[name='priority_project']:checked").val();

        var temp_start_date = "<?= $start_date; ?>";
        var temp_due_date = "<?= $due_date; ?>";

        if (!itemId || !title || !projectStart || !projectDue || !description || !membersItem || !priority) {
            validasiInfo('Please complete all fields before adding project items!');
            return;
        }

        if (projectStart < temp_start_date || projectStart > temp_due_date || (projectDue < temp_start_date || projectDue > temp_due_date)) {
            validasiInfo('Check interval date project, date project not valid!');
            return;
        }

        var AddingProject = {
            idProjectWrk: itemId,
            title: title,
            start: projectStart,
            due: projectDue,
            priority: priority,
            status: 'STL-1',
            description: description,
            membersItem: JSON.stringify(membersItem)
        };

        // TOOLS
        var addBtnProject = document.getElementById("AddProject");
        addBtnProject.disabled = true;
        addBtnProject.textContent = "Creating...";
        addBtnProject.classList.add("disabled");

        // console.log(AddingProject);
        addProject(AddingProject);
    })

    function addProject(AddingProject) {
        $.ajax({
            url: '<?= base_url(); ?>InsertProject',
            type: 'POST',
            data: AddingProject,
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
            // complete: function() {
            //     $('#loading-overlay').hide();
            // }
        });
    }
    // End Function Add Item Project

    // Function Update Item Project
    $(document).on('click', '#slcProject', function() {
        $('#update_item_id').val($(this).data('item_id_list'));
        $('#update_project_wrk_id_item').val($(this).data('project_wrk_id_list'));
        $('#update_item_name').val($(this).data('project_item_name'));
        tinymce.get('update_item_description').setContent($(this).data('list_description_item'));
        $("input[name='update_priority_project'][value='" + $(this).data('priority') + "']").prop("checked", true);
        $('#update_item_start').val($(this).data('start'));
        $('#update_item_due').val($(this).data('due'));
        $('#update_item_status').val($(this).data('list_status_item'));
    })

    $(document).on('click', '#UpdateProject', function() {
        var id = $('#update_item_id').val();
        var idProject = $('#update_project_wrk_id_item').val();
        var title = $('#update_item_name').val();
        var projectStart = $('#update_item_start').val();
        var projectDue = $('#update_item_due').val();
        var description = tinymce.get('update_item_description').getContent();
        var priority = $("input[name='update_priority_project']:checked").val();
        var projectStatus = $('#update_item_status').val();

        var temp_start_date = "<?= $start_date; ?>";
        var temp_due_date = "<?= $due_date; ?>";

        if (!idProject || !title || !projectStart || !projectDue || !description || !priority) {
            validasiInfo('Please complete all fields before modifying the project!');
            return;
        }

        if (projectStart < temp_start_date || projectStart > temp_due_date || (projectDue < temp_start_date || projectDue > temp_due_date)) {
            validasiInfo('Check interval date project, date project not valid!');
            return;
        }

        var UpdateItem = {
            id: id,
            idProjectWrk: idProject,
            title: title,
            start: projectStart,
            due: projectDue,
            priority: priority,
            description: description,
            status: projectStatus,
            flag: 0
        };


        // TOOLS
        var updateButton = document.getElementById("UpdateProject");
        updateButton.disabled = true;
        updateButton.textContent = "Updating...";
        updateButton.classList.add("disabled");

        // console.log(UpdateItem);
        updateItem(UpdateItem);
    })

    function updateItem(UpdateItem) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateProject',
            type: 'POST',
            data: UpdateItem,
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
    // End Function Update Item Project
    // Function Delete Project
    $(document).on('click', '#delProject', function() {
        var projectId = $(this).data('del_project');
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
                delProjected(projectId);
            }
        });
    })

    function delProjected(params) {
        $.ajax({
            url: '<?= base_url(); ?>DeleteProject',
            type: 'POST',
            data: {
                project_id: params
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
                console.log(error);
                // Tindakan jika terjadi kesalahan
            }
        })
    }
    // End Function Delete Project

    //#Insert Attachment
    $(document).on('click', '#btnAttachment', function() {
        var groupID = '<?= $project_wrk_id ?>';
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

    function handleSelectMember() {
        $('#members_project_item').val([]).trigger('change');
        $('#members_project_item').select2({
            placeholder: '-- Choose Members --',
            allowClear: true,
            minimumInputLength: 0,
            data: [
                <?php foreach ($MemberSelectRecord as $key) { ?> {
                        id: "<?= $key->member_id ?>",
                        text: "<?= $key->member_name ?>"
                    },
                <?php } ?>
            ]
        });
    }
    // # END TOOLS
</script>