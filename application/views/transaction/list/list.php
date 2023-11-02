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
    <div style="height: 5px;"></div>
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
                            <a class="btn btn-sm btn-danger" id="btnBack" href="<?= base_url() ?>Project">
                                <i class="fa fa-lg fa-reply"></i>
                            </a>
                            <a class="btn btn-sm btn-info" href="<?= base_url() . 'Project/KanbanList/' . enkripbro($project_id); ?>">
                                <i class="fa fa-lg fa-brands fa-flipboard"></i> Board
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <!-- Description -->
                <div class="card">
                    <Div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-md-10" data-card-widget="collapse" style="cursor: pointer;">
                                Description
                            </div>
                            <div class="card-tools">
                                <?php if ($batas_akses && $status_id != 'STW-2') : ?>
                                    <button type="button" class="btn btn-xs btn-tool" style="font-size: 10px;" id="btnUpProject" data-toggle="modal" data-target="#modal-update-project">
                                        <i class="fa fa-lg fa-pen"></i>
                                    </button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-sm btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </Div>
                    <div class="card-body">
                        <div class="row col-md-12" style="margin-bottom: -15px;">
                            <div class="col-md-6">
                                <strong><i class="fas fa-file-alt mr-1"></i> Project Name</strong>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted"><?= $project_name ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row col-md-12" style="margin-bottom: -15px;">
                            <div class="col-md-6">
                                <strong><i class="far fa-calendar-alt mr-1"></i> Start Date</strong>
                                <p class="text-muted" style="margin-left: 10px;"><?= date('d M Y', strtotime($start_date)) ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="far fa-calendar-alt mr-1"></i> Due Date</strong>
                                <p class="text-muted" style="margin-left: 10px;"><?= date('d M Y', strtotime($due_date)) ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row col-md-12" style="margin-bottom: -15px;">
                            <div class="col-md-6">
                                <strong><i class="fas fa-receipt mr-1"></i> Project Collaboration</strong>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted"><?= ($collab_name) ? $collab_name : '-' ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row col-md-12" style="margin-bottom: -15px;">
                            <div class="col-md-6">
                                <strong><i class="fas fa-quote-left mr-1"></i> Status</strong>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted"><?= $name_project_status ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <strong><i class="fas fa-info mr-1"></i> Description</strong>
                            <p class="text-muted"><?= $description ?></p>
                        </div>
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
            </div>
            <div class="col-lg-8">

                <!-- Card To Do List -->
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-md-11" data-card-widget="collapse" style="cursor: pointer;">
                                Card
                            </div>
                            <div class="card-tools">
                                <?php if ($batas_akses) : ?>
                                    <button type="button" class="btn btn-xs btn-tool" id="btnAddList" data-toggle="modal" data-target="#modal-input-list">
                                        <i class="fa fa-file-circle-plus"></i>
                                    </button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table text-nowrap table-bordered table-striped" style="font-size: 14px;" id="tblProject">
                            <thead>
                                <tr>
                                    <th>Card Name</th>
                                    <!-- <th>Remaining Days</th>
                                    <th>Status</th> -->
                                    <th>Member</th>
                                    <th class="col-md-1">Action</th>
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

                                        $statusW = $record->status_id;
                                        $statusClass = ($statusW == 'STL-1') ? 'badge-primary' : (($statusW == 'STL-2') ? 'badge-warning' : (($statusW == 'STL-3') ? 'badge-danger' : 'badge-success'));
                                        $completed = $record->percentage;
                                        $completed = (empty($completed)) ? 0 : $completed;
                                        if (strlen($completed) > 4) {
                                            $completed = number_format($completed, 2);
                                        }

                                        if ($dueDate !== $startDate) {
                                            $percentage = ($currentTime - $startDate) / ($dueDate - $startDate) * 100;
                                            $percentage = max(0, min(100, $percentage));
                                        } else {
                                            $percentage = 100;
                                        }

                                        if ($percentage <= 25) {
                                            $badgeClass = 'badge-success';
                                        } elseif ($percentage <= 75) {
                                            $badgeClass = 'badge-warning';
                                        } else {
                                            $badgeClass = 'badge-danger';
                                        }

                                        $remainingDays = round(($dueDate - $currentTime) / (60 * 60 * 24));

                                        $encry_pro_id = enkripbro($record->project_id);
                                        $encry_lst_id = enkripbro($record->list_id);
                                        $url = base_url() . 'Project/List/Task/' . $encry_pro_id . '/' . $encry_lst_id;

                                ?>
                                        <tr>
                                            <td>
                                                <div class="col clickable" data-url="<?= $url ?>" style="cursor: pointer;">
                                                    <div class="row">
                                                        <div class="col-md-6"><?= $record->list_name ?></div>
                                                        <div class="col-md-6 text-right">
                                                            <?php if ($completed == '100') : ?>
                                                                <span class="badge <?= $statusClass ?>"><?= $record->list_status ?></span>
                                                            <?php else : ?>
                                                                <span class="badge <?= $badgeClass ?>"><i class="far fa-clock"></i> <?= $remainingDays ?> Days</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="progress-group" style="margin-top: 5px;">
                                                        <div class="progress progress-sm" style="height: 8px; border-radius: 20px;">
                                                            <div class="progress-bar <?= ($completed < 100) ? 'bg-primary' : 'bg-success'; ?>" style="width: <?= $completed; ?>%"></div>
                                                        </div>
                                                        <span class="float-center small"><b><?= $completed; ?> %</b></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php foreach ($ProjectListRecords as $key) :
                                                    if ($record->list_id == $key->list_id) :
                                                        $photo_url = $key->photo_url;
                                                        if (empty($photo_url) || !file_exists(FCPATH . '../api-hris/upload/' . $photo_url)) {
                                                            $photo_url = 'assets/dist/img/avatar' . ($key->gender_id == 'GR-001' ? '5' : '3') . '.png';
                                                        } else {
                                                            $photo_url = '../api-hris/upload/' . $key->photo_url;
                                                        }
                                                ?>
                                                        <img src="<?= base_url() . $photo_url ?>" alt="User Image" class="rounded-circle profile-trigger" style="width: 20px; height: 20px;" title="<?= $key->member_name ?>" data-member-name="<?= $key->member_name ?>" data-member-company="<?= $key->company_name ?>" data-src="<?= base_url() . $photo_url; ?>">
                                                <?php
                                                    endif;
                                                endforeach;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" data-offset="+130" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-bars"></i>
                                                    </button>
                                                    <div class="dropdown-menu" style="box-shadow: none; border-color: transparent;">
                                                        <a class="dropdown-item btn btn-xs" href="<?= $url ?>" title="View Detail" style="width: 60px;"><i class="fa fa-eye mr-1"></i>View</a>
                                                        <?php if ($batas_akses || $member_id == $record->creation_user_id) : ?>
                                                            <a id="slcList" class="dropdown-item btn btn-xs" style="width: 60px;" data-list_id="<?= $record->list_id ?>" data-project_id="<?= $record->project_id ?>" data-list_name="<?= $record->list_name ?>" data-start="<?= $record->start_date ?>" data-due="<?= $record->due_date ?>" data-priority="<?= $record->priority_type_id ?>" data-list_status="<?= $record->status_id ?>" data-list_description='<?= $record->description; ?>' data-toggle="modal" data-target="#modal-update-list" title="Update Card">
                                                                <i class="fa fa-pen mr-1"></i>Edit
                                                            </a>
                                                            <a id="delList" class="dropdown-item btn btn-xs" style="width: 60px;" data-del_list="<?= $record->list_id ?>" title="Delete Card"><i class="fa fa-trash mr-1"></i>Delete</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
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

                <!-- Message -->
                <div class="card messanger">
                    <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                        <h3 class="card-title">Comment</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="direct-chat-messages" id="comment-container" style="height: 400px;">
                        </div>
                        <div class="empty-comment-container d-flex align-items-center justify-content-center">
                            <p id="empty-comment" class="text-center" style="margin-top: 20px;">Empty Comment</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form id="send-comment-form">
                            <input type="hidden" id="current-member-id" value="<?= $this->session->userdata('member_id') ?>">
                            <div class="row col-md-12 p-0">
                                <textarea id="message-input" class="form-control" placeholder="Ketik komentar Anda..." <?= ($status_id != 'STW-2') ? '' : 'disabled' ?> autocomplete="off" oninput="adjustInputHeight(this)" onkeydown="handleKeyDown(event)" style="height: 40px;width: 88%;" onpaste="handlePaste(event)"></textarea>
                                <button type="button" class="btn" <?= ($batas_akses && $status_id != 'STW-2') ? '' : 'disabled' ?> style="width: 4%;" onclick="toggleEmojiPicker()"><i class="fa-solid fa-laugh-beam"></i></button>
                                <button type="button" class="btn" <?= ($batas_akses && $status_id != 'STW-2') ? '' : 'disabled' ?> style="width: 4%;" id="upload-button"><i class="fas fa-paperclip"></i></button>
                                <div class="emoji-picker" style="display: none;">
                                    <div class="emoji-list">
                                        <?php if ($Emojis) :
                                            foreach ($Emojis as $key) : ?>
                                                <span class="emoji" onclick="insertEmoji('<?= $key->emoji_text ?>')"><?= $key->emoji_text ?></span>
                                        <?php endforeach;
                                        endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4" id="image-upload-dialog" style="display: none;">
                                    <h3>Unggah Gambar</h3>
                                    <input class="form-control" type="file" id="file-input" accept="image/*">
                                    <div class="row">
                                        <div style="width: 80%;padding-left: 10px;">
                                            <textarea id="image-description" class="form-control" placeholder="Image Description" autocomplete="off" oninput="adjustInputHeight(this)" onkeydown="handleDown1(event)" style="height: 40px;"></textarea>
                                        </div>
                                        <div style="width: 20%;padding-left: 5px;">
                                            <button class="btn" id="confirm-upload"><i class="fa-solid fa-paper-plane"></i></button>
                                            <button class="btn" id="cancel-upload"><i class="fa-solid fa-xmark"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn" <?= ($batas_akses && $status_id != 'STW-2') ? '' : 'disabled' ?> style="width: 4%;"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card direct-chat direct-chat-msg file-attachment" style="display: none;">
                    <div class="card-header">
                        <h5>Sending File</h5>
                    </div>

                    <div class="card-body">
                        <div class="text-center" id="viewImage"></div>
                    </div>

                    <div class="card-footer">
                        <div id="file-inputing" class="row">
                            <div style="width: 90%;">
                                <input type="hidden" class="form-control" id="file-element" placeholder="Image Description">
                                <textarea class="form-control" id="file-description" placeholder="Image Description" autocomplete="off" oninput="adjustInputHeight(this)" onkeydown="handleDown2(event)" style="height: 40px;"></textarea>
                            </div>
                            <div style="width: 10%;">
                                <button class="btn" id="confirm-upload-view"><i class="fa-solid fa-paper-plane"></i></button>
                                <button class="btn" id="cancel-upload-view"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Batas Message -->
            </div>

            <!-- Project Attachment -->
            <div class="col-lg-12">
                <div class="card collapsed-card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-md-11" data-card-widget="collapse" style="cursor: pointer; width: max-content;">Project Attachment</div>
                            <div class="card-tools">
                                <?php if ($status_id != 'STW-2' && $member_type != 'MT-4') : ?>
                                    <button type="button" class="btn btn-xs btn-tool" data-toggle="modal" data-target="#modal-input-attachment">
                                        <i class="fas fa-file"></i>
                                    </button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tblAttachment" class="table table-bordered table-striped" style="font-size: small;">
                            <thead>
                                <tr>
                                    <th data-width="60%">Name</th>
                                    <th data-width="15%">Uploaded Date</th>
                                    <!-- <th>Type</th> -->
                                    <th data-width="15%">Uploaded By</th>
                                    <th data-width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($AttachmentRecord)) :
                                    foreach ($AttachmentRecord as $record) : ?>
                                        <tr>
                                            <td><?= $record->attachment_name . '.' . $record->attachment_type ?></td>
                                            <td><?= $record->creation_datetime ?></td>

                                            <!-- <td><?= $record->attachment_type_name ?></td> -->
                                            <td><?= $record->member_upload ?></td>
                                            <td class="text-center">
                                                <a id="btnDownload" class="btn btn-xs btn-success" href="<?= base_url('DownloadAttachment/' . $record->attachment_url) ?>">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a href="<?= base_url('ViewAttachment/' . $record->attachment_url) ?>" target="_blank" class="btn btn-xs btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <?php if (($member_id == 'System' || $member_id == $record->creation_user_id || $member_type == 'MT-2') && $status_id != 'STW-2') : ?>
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
            </div>
            <!-- Batas Card Attachment -->

            <!-- Card Member -->
            <div class="col-lg-12">
                <div class="card collapsed-card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-md-11" data-card-widget="collapse" style="cursor: pointer;">Members</div>
                            <div class="card-tools">
                                <?php if ($batas_akses && $status_id != 'STW-2') : ?>
                                    <button type="button" class="btn btn-xs btn-tool ml-auto" id="btnAddMember" data-toggle="modal" data-target="#modal-input-project-member">
                                        <i class="fa fa-user-plus"></i>
                                    </button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0" style="font-size: small;">
                        <div class="col-md-12 text-center">
                            <span class="badge badge-warning"><?= $total_member ?> Members</span>
                        </div>
                        <ul class="users-list clearfix">
                            <?php if (!empty($ProjectMemberRecords)) :
                                foreach ($ProjectMemberRecords as $record) :
                                    $typeM = $record->variable_id;
                                    $cekIngUs = $batas_akses && $status_id != 'STW-2';
                                    $warnaMembs = ($typeM == 'MT-1') ? 'primary' : (($typeM == 'MT-2') ? 'success' : (($typeM == 'MT-I') ? 'secondary' : 'danger'));

                                    $avatar = $record->gender_id == 'GR-001' ? 'avatar5.png' : 'avatar3.png';
                                    $photo_url = $record->photo_url;
                                    if (empty($photo_url) || !file_exists(FCPATH . '../api-hris/upload/' . $photo_url)) {
                                        $photo_url = 'assets/dist/img/' . $avatar;
                                    } else {
                                        $photo_url = '../api-hris/upload/' . $record->photo_url;
                                    }
                            ?>
                                    <li>
                                        <img src="<?= base_url() . $photo_url ?>" alt="User Image" class="rounded-circle" style="width: 60px; height: 60px;" title="<?= $record->member_name ?>">
                                        <a class="users-list-name" href="javascript:void(0);"><?= $record->member_name ?></a>
                                        <a class="btn btn-xs btn-<?= $warnaMembs ?>" <?= $typeM == 'MT-4' ? 'style="background-color:purple;border-color:purple;"' : '' ?> data-bs-toggle="dropdown" <?= ($typeM != 'MT-1') ? (($cekIngUs && $member_type != 'MT-3') ? '' : 'disabled') : 'disabled' ?>>
                                            <span class="badge"><?= $record->member_type ?></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <?php if ($typeM != 'MT-I') :
                                                    foreach ($MemberTypeRecords as $row) : ?>
                                                        <a class="dropdown-item" data-project_member_id="<?= $record->project_member_id ?>" data-member_id="<?= $record->member_id ?>" data-mtype_id="<?= $row->variable_id ?>" id="slcMember">
                                                            <i class="fa fa-pen"></i> <?= $row->variable_name ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                    <a class="dropdown-item" data-project_member_id="<?= $record->project_member_id ?>" data-member_id="<?= $record->member_id ?>" id="btnDelMember">
                                                        <i class="fa fa-trash"></i> Delete Member
                                                    </a>
                                                <?php else : ?>
                                                    <a class="dropdown-item" data-project_member_id="<?= $record->project_member_id ?>" data-member_id="<?= $record->member_id ?>" id="btnDelMember">
                                                        <i class="fa fa-trash"></i> Delete Member
                                                    </a>
                                                <?php endif; ?>
                                            </li>
                                        </ul>
                                    </li>
                            <?php endforeach;
                            endif; ?>
                        </ul>

                    </div>
                </div>
            </div>
            <!-- Batas Card Member -->

            <!-- Log Activity -->
            <div class="col-lg-12">
                <div class="card collapsed-card">
                    <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                        <div class="card-title">LOG Activity</div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($LogRecord)) { ?>
                            <div class="direct-chat-messages overflow-auto" id="logact">
                                <?php foreach ($LogRecord as $record) { ?>
                                    <div class="row" style="font-size: smaller;">
                                        <div class="col-md-9">
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
            </div>
            <!-- Batas Log Activity -->

        </div>
    </section>
</div>

<!--#Project Modal Insert Member-->
<div class="modal fade" id="modal-input-project-member" role="dialog" aria-labelledby="modal-input-project-member-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="card-header">
                    <div class="row">
                        <div class="btn btn-primary col-lg-6" id="member-btn">
                            Member
                        </div>
                        <div class="btn col-lg-6" id="previllage-member-btn">
                            Management Member
                        </div>
                    </div>
                </div>
                <div id="regular-div">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Member</label>
                                    <div class="input-group">
                                        <select class="form-control select2bs4" name="member_id_select_regular[]" data-width="100%" id="member_id_select_regular" multiple="multiple">
                                            <option value="" selected disabled>-- Choose Member --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Member Type</label>
                                    <select class="form-control select2bs4" name="member_type_id_regular" id="member_type_id_regular" data-width=100%>
                                        <option value="">-- Choose Type --</option>
                                        <?php foreach ($MemberTypeRecords as $row) : ?>
                                            <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="button" class="btn btn-primary" id="btnMember">Add Member</button>
                    </div>
                </div>
                <div id="previllage-div" style="display: none;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Management Member</label>
                                    <div class="input-group">
                                        <select class="form-control select2bs4" name="previllage_member_id_select[]" data-width="100%" id="previllage_member_id_select" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer justify-content-between">
                        <button type="button" class="btn btn-primary" id="btnMemberPrevillage">Add Management Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--#EndProject Modal Insert Member-->

<!--#Project Modal Insert Attachment-->
<div class="modal fade" id="modal-input-attachment" role="dialog" aria-labelledby="modal-input-attachment-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                            <input class="form-control" id="attachment_name" placeholder="Attachment Name" name="attachment_name" maxlength="50" autocomplete="off" required>
                            <div style="display:none;">
                                <label>Attachment Type</label>
                                <select class="form-control select2bs4" name="attachment_type" id="attachment_type" data-width=100%">
                                    <?php foreach ($AttachmentTypeRecord as $row) : ?>
                                        <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between">
                                <label for="attachment_url">Attachment</label>
                                <small>
                                    <font color="red">Type file: jpeg/jpg/png/pdf</font>
                                </small>
                            </div>
                            <div class="text-center">
                                <div class="input-file" id="drop-area">
                                    <input type="file" name="attachment_file" id="attachment_file" required accept=".jpeg,.jpg,.png,.pdf" style="display: none;">
                                    <label for="attachment_file" class="file-label">Drag & drop your files here or click to browse</label>
                                </div>

                                <br>
                            </div>

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
<div class="modal fade" id="modal-update-project" role="dialog" aria-labelledby="modal-update-project-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Project</h5>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h5 class="card-title" style="width: 90%;">
                                        <input type="text" id="project_name" class="form-control" placeholder="Project Name" value="<?= $project_name ?>" autocomplete="off">
                                    </h5>
                                    <div class="card-tools">
                                        <div style="margin-top: 5px; margin-right: 10px;"><i class="fa fa-pen" style="color: gray;"></i></div>
                                    </div>
                                </div>
                                <textarea class="editor" name="project_description" id="project_description"><?= $description ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group" style="display: none;">
                                <label for="project_type" class="mr-2">Project Type</label>
                                <?php if ($selected) : ?>
                                    <select class="form-control select2bs4" name="project_type" id="project_type">
                                        <?php foreach ($ProjectTypeRecords as $row) :
                                            $selectType = $row->variable_id == $project_type ? 'selected' : ''; ?>
                                            <option value="<?= $row->variable_id; ?>" <?= $selectType ?>><?= $row->variable_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php else : ?>
                                    <input type="text" name="project_type1" id="project_type1" class="form-control" value="<?= $project_type ?>">
                                <?php endif; ?>
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
                                <select class="form-control" id="collab_project" name="collab_project[]" multiple="multiple" style="width: 100%;"></select>
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
                            <div class="form-group">
                                <label for="project_status" class="mr-2">Project Status</label>
                                <select class="select2bs4" name="project_status" id="project_status" style="width: 100%;">
                                    <option value="STW-1" selected>-- Select an option --</option>
                                    <?php foreach ($StatusProjectRecords as $row) {
                                        $selectStatus = $row->variable_id == $status_id ? 'selected' : ''; ?>
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

<!-- Modal Insert Card -->
<div class="modal fade" id="modal-input-list" role="dialog" aria-labelledby="modal-input-list-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Card</h5>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h5 class="card-title" style="width: 90%;">
                                        <input type="text" id="list_name" class="form-control" placeholder="Card Name" autocomplete="off">
                                    </h5>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" href=""><i class="fa fa-pen"></i></a>
                                    </div>
                                </div>
                                <textarea class="editor" name="list_description" id="list_description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CheckingPriority">Priority Card</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_list" value="PR-3">
                                        <label class="form-check-label">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_list" value="PR-2">
                                        <label class="form-check-label">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="priority_list" value="PR-1">
                                        <label class="form-check-label">High</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dateRange">Date Range</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dateRange2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-lg-12 justify-content-between">
                                <div>
                                    <label for="MemberItem" class="mr-2">Assign Member</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="pmemberc" id="pmemberc" onchange="toggleMember()">
                                    <label for="pmemberc" class="mr-2">All Member</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="members_list_item" name="members_list_item[]" multiple="multiple" style="width: 100%;"></select>
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
<!-- Modal Insert Card -->

<!-- Modal Update Card -->
<div class="modal fade" id="modal-update-list" role="dialog" aria-labelledby="modal-update-list-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Card</h5>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <input type="hidden" class="form-control" id="update_list_id" placeholder="List ID" name="update_list_id" required readonly>
                                    <input type="hidden" class="form-control" id="update_project_id" placeholder="List ID" name="update_project_id" required readonly>
                                    <h5 class="card-title" style="width: 90%;">
                                        <input type="text" id="update_list_name" name="update_list_name" class="form-control" placeholder="List Name" autocomplete="off">
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
                                <label for="CheckingPriority">Priority Card</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="update_priority_list" value="PR-3">
                                        <label class="form-check-label">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="update_priority_list" value="PR-2">
                                        <label class="form-check-label">Normal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="update_priority_list" value="PR-1">
                                        <label class="form-check-label">High</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dateRange">Date Range</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dateRange2up">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="update_list_status" class="mr-2">Card Status</label>
                                <select class="form-control select2bs4" name="update_list_status" id="update_list_status" style="width: 100%;">
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
<!-- Modal Update Card -->

<!-- Styling Table -->
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
    $("#tblProject").DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            searching: false
        })
        .buttons()
        .container()
        .appendTo("#tblProject_wrapper .col-md-6:eq(0)");

    const clickableElements = document.querySelectorAll(".clickable");
    clickableElements.forEach(function(element) {
        element.addEventListener("click", function() {
            const url = element.getAttribute("data-url");
            window.location.href = url;
        });
    });
    document.addEventListener('click', function(event) {
        var emojiPicker = document.querySelector('.emoji-picker');
        if (emojiPicker.style.display === 'block' && !emojiPicker.contains(event.target)) {
            emojiPicker.style.display = 'none';
        }
    });
</script>
<!-- END Styling Table -->

<script>
    $(document).on('click', '#btnUpProject', function() {
        var colb = '<?= $collab_member ?>';
        var posisiKoma = colb.includes(",");
        const checks = document.getElementById("pcollabc");
        if (posisiKoma) {
            checks.checked = true;
            toggleCollab();
        } else {
            checks.checked = false;
            toggleCollab();
        }
        date2In1();
    });

    //Function Update Project
    $(document).on('click', '#UpdateProject', function() {
        var dateRange = $('#dateRange').val();
        var dates = dateRange.split(' - ');
        var id = '<?= $project_id ?>';
        var title = $('#project_name').val();
        var projectType = ('<?= $selected ?>') ? $("#project_type").val() : $("#project_type1").val();
        var projectStart = dates[0];
        var projectDue = dates[1];
        var description = $('#project_description').summernote('code');
        var projectStatus = $('#project_status').val();

        var pcollabC = document.getElementById("pcollabc");
        var collabing = $('#collab_project').val();
        var projectCollab = '<?= $this->session->userdata("company_id") ?>';
        var projectCollabString = pcollabC.checked ? collabing.map(function(pc) {
            return '"' + pc + '"';
        }).join(', ') : JSON.stringify(projectCollab);

        var UpdateProject = {
            id: id,
            title: title,
            projectType: projectType,
            start: projectStart,
            due: projectDue,
            description: description,
            status: projectStatus,
            collab_member: projectCollabString,
            flag: 0
        };

        // TOOLS
        var updateButton = document.getElementById("UpdateProject");
        updateButton.disabled = true;
        updateButton.textContent = "Updating...";
        updateButton.classList.add("disabled");

        // console.log(UpdateProject);
        loadIng();
        updateProject(UpdateProject);
    })

    function updateProject(UpdateProject) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateProject',
            type: 'POST',
            data: UpdateProject,
            success: function(response) {
                $('#modal-update-project').modal('hide');
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
        date2In1();
    })

    $(document).on('click', '#AddList', function() {
        var dateRange = $('#dateRange2').val();
        var dates = dateRange.split(' - ');
        var itemId = '<?= $project_id ?>';
        var title = $('#list_name').val();
        var projectStart = dates[0];
        var projectDue = dates[1];
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
        loadIng();
        addProject(AddingProject);
    })

    function addProject(AddingProject) {
        $.ajax({
            url: '<?= base_url(); ?>InsertList',
            type: 'POST',
            data: AddingProject,
            success: function(response) {
                $('#modal-input-list').modal('hide');
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
                        window.location.href = '<?= base_url() ?>Project/List/Task/' + response.project + '/' + response.card; // Reload the page
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
        // $('#update_list_start').val($(this).data('start'));
        // $('#update_list_due').val($(this).data('due'));
        $('#update_list_status').val($(this).data('list_status'));

        var startData = $(this).data('start');
        var dueData = $(this).data('due');
        var today = moment().format('YYYY-MM-DD');
        var sevenDaysLater = moment().add(7, 'days').format('YYYY-MM-DD');
        var startDate = startData ? moment(startData, 'YYYY-MM-DD') : moment(today, 'YYYY-MM-DD');
        var dueDate = dueData ? moment(dueData, 'YYYY-MM-DD') : moment(sevenDaysLater, 'YYYY-MM-DD');

        $("#dateRange2up").daterangepicker({
            opens: 'left',
            autoApply: true,
            startDate: startDate,
            endDate: dueDate,
            locale: {
                format: 'YYYY-MM-DD',
            }
        });
        dateRangeTheme();
    })

    $(document).on('click', '#UpdateList', function() {
        var dateRange = $('#dateRange2up').val();
        var dates = dateRange.split(' - ');
        var id = $('#update_list_id').val();
        var idProject = $('#update_project_id').val();
        var title = $('#update_list_name').val();
        var projectStart = dates[0];
        var projectDue = dates[1];
        // var projectStart = $('#update_list_start').val();
        // var projectDue = $('#update_list_due').val();
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
        loadIng();
        updateList(UpdateItem);
    })

    function updateList(UpdateItem) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateList',
            type: 'POST',
            data: UpdateItem,
            success: function(response) {
                $('#modal-update-list').modal('hide');
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
                // console.log(deleteData);
                loadIng();
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
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('attachment_file');
        const label = document.querySelector('.file-label');
        const dropArea = document.getElementById('drop-area');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length) {
                input.files = files;
                const fileName = files[0].name;
                label.innerText = fileName;
            }
        }

        input.addEventListener('change', function(e) {
            const fileName = e.target.value.split('\\').pop();
            label.innerText = fileName || 'Drag & drop your files here or click to browse';
        });

    });
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
        loadIng();
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
        var memberId = JSON.stringify($('#member_id_select_regular').val());
        var memberType = $('#member_type_id_regular').val();
        var member_status = 'A';

        var AddingMember = {
            project_id: projectId,
            member_id: memberId,
            member_type_id: memberType,
            r_status: member_status,
            group_id: '<?= $project_id ?>',
            object: memberId
        };
        console.log(AddingMember);

        if (!projectId || !memberId.length || !memberType) {
            validasiInfo('Please complete all fields before adding member items!');
            return;
        }

        // TOOLS
        var addBtn = document.getElementById("btnMember");
        addBtn.disabled = true;
        addBtn.textContent = "Adding...";
        addBtn.classList.add("disabled");

        loadIng();
        InMember(AddingMember);
    })
    $(document).on('click', '#btnMemberPrevillage', function() {
        var projectId = '<?= $project_id ?>';
        var memberId = JSON.stringify($('#previllage_member_id_select').val());
        var memberType = 'MT-I';
        var member_status = 'A';

        var AddingMember = {
            project_id: projectId,
            member_id: memberId,
            member_type_id: memberType,
            r_status: member_status,
            group_id: projectId,
            object: memberId
        };

        if (!projectId || !memberId || !memberType) {
            validasiInfo('Please complete all fields before adding member items!');
            return;
        }

        // TOOLS
        var addBtn = document.getElementById("btnMemberPrevillage");
        addBtn.disabled = true;
        addBtn.textContent = "Adding...";
        addBtn.classList.add("disabled");

        // console.log(AddingMember);
        loadIng();
        InMember(AddingMember);
    })

    function InMember(AddingMember) {
        $.ajax({
            url: '<?= base_url(); ?>InsertProjectMember',
            type: 'POST',
            data: AddingMember,
            success: function(response) {
                $('#modal-input-project-member').modal('hide');
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
        const prj_memberID = $(this).data('project_member_id');
        const memberID = $(this).data('member_id');
        const memberType = $(this).data('mtype_id');

        var UpdatingMember = {
            project_id: '<?= $project_id ?>',
            project_member_id: prj_memberID,
            member_id: memberID,
            member_type_id: memberType,
            r_status: 'A'
        };
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
    $(document).ready(function() {
        document.getElementById("member-btn").addEventListener("click", function() {
            document.getElementById("regular-div").style.display = "block";
            document.getElementById("previllage-div").style.display = "none";
            document.getElementById("member-btn").classList.add("btn-primary");
            document.getElementById("previllage-member-btn").classList.remove("btn-primary");
        });

        document.getElementById("previllage-member-btn").addEventListener("click", function() {
            document.getElementById("regular-div").style.display = "none";
            document.getElementById("previllage-div").style.display = "block";
            document.getElementById("previllage-member-btn").classList.add("btn-primary");
            document.getElementById("member-btn").classList.remove("btn-primary");
        });
    })

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
        const colb = '<?= $collab_member ?>';
        const colbArray = JSON.parse("[" + colb + "]");
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
        $('#collab_project').val(colbArray).trigger('change');
        warnaMultiple();
    }

    function toggleCollab() {
        const checks = document.getElementById("pcollabc");
        const projectCollab = document.getElementById("pcollab");

        if (checks.checked) {
            projectCollab.style.display = "block";
            handleCollab();
        } else {
            projectCollab.style.display = "none";
            handleCollab();
        }
    };

    $(document).on('click', '#btnAddMember', function() {
        var coling = '<?= $collab_member ?>';
        $.ajax({
            url: '<?= base_url() ?>MemberSelect',
            type: 'POST',
            data: {
                pro_group: coling
            },
            dataType: 'JSON',
            success: function(data) {
                var select = $('#member_id_select_regular');
                var membersData = [];
                $.each(data.SelectM, function(index, isi) {
                    membersData.push({
                        id: isi.member_id,
                        text: isi.company_initial + ' - ' + isi.company_brand_name + ' - ' + isi.member_name
                    });
                });

                select.empty().select2({
                    placeholder: '-- Choose Members --',
                    allowClear: true,
                    minimumInputLength: 0,
                    data: membersData,
                    templateSelection: colorSelect
                });
                warnaMultiple();
            },
            error: function() {
                console.error('Error Ajaxnya');
            }
        });
        var selectpre = $('#previllage_member_id_select');
        selectpre.empty().select2({
            placeholder: '-- Choose Members --',
            allowClear: true,
            minimumInputLength: 0,
            data: [
                <?php if ($ManageRecord) :
                    foreach ($ManageRecord as $row) : ?> {
                            id: "<?= $row->member_id ?>",
                            text: "<?= $row->company_initial ?>" + ' - ' + "<?= $row->member_name ?>"
                        },
                <?php endforeach;
                endif; ?>
            ],
            templateSelection: colorSelect
        });
        warnaMultiple();
    });

    function handleSelectMember() {
        const membsArray = [];
        <?php if ($MemberSelectRecord) : foreach ($MemberSelectRecord as $key) { ?>
                membsArray.push({
                    id: "<?= $key->member_id ?>",
                    text: "<?= $key->company_initial ?>" + " - " + "<?= $key->company_brand_name ?>" + " - " + "<?= $key->member_name ?>"
                });
        <?php }
        endif; ?>

        $('#members_list_item').select2({
            placeholder: '-- Choose Members --',
            allowClear: true,
            minimumInputLength: 0,
            data: membsArray,
            templateSelection: colorSelect
        });

        const checks = document.getElementById("pmemberc");
        if (checks.checked) {
            $('#members_list_item').val(membsArray.map(item => item.id)).trigger('change');
        } else {
            $('#members_list_item').val([]).trigger('change');
        }
        warnaMultiple();
    }

    function toggleMember() {
        const checks = document.getElementById("pmemberc");
        const memberCollab = document.getElementById("pmember");

        if (checks.checked) {
            handleSelectMember();
        } else {
            handleSelectMember();
        }
    };

    function actBot() {
        var logAct = document.getElementById("logact");
        if (logAct !== null) {
            logAct.scrollTop = logAct.scrollHeight;
        }
    }

    function date2In1() {
        var startDate = moment('<?= $start_date ?? date('Y-m-d') ?>', 'YYYY-MM-DD');
        var dueDate = moment('<?= $due_date ?? date('Y-m-d', strtotime('+7 days')) ?>', 'YYYY-MM-DD');

        $("#dateRange,#dateRange2").daterangepicker({
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
    window.onload = function() {
        actBot();
    };
    // # END TOOLS
</script>

<!-- PASTE IMAGE IN COMMENT -->
<script>
    var messanger = $(".messanger");
    var viewElement = $("#file-element");
    var viewDescription = $("#file-description");
    var viewAttachment = $(".file-attachment");
    var viewUpload = $("#viewImage");
    const confirmUploadView = document.getElementById('confirm-upload-view');
    const cancelUploadView = document.getElementById('cancel-upload-view');

    function handlePaste(event) {
        var items = (event.clipboardData || event.originalEvent.clipboardData).items;
        for (var index in items) {
            var item = items[index];
            if (item.kind === 'file') {
                var blob = item.getAsFile();
                uploadPastedFile(blob);
                messanger.hide();
                break;
            }
        }
    }

    function uploadPastedFile(file) {
        var data = new FormData();
        data.append('image', file);

        $.ajax({
            url: '<?= base_url() ?>ProcImageMessage',
            method: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                displayUploadedFile(url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function displayUploadedFile(url) {
        var imgElement = '<img src="' + url + '" alt="Gambar" style="max-height:40%; max-width:40%;" onclick="bukaGambarBaru(event)">';
        viewElement.empty();
        viewAttachment.show();
        viewUpload.append(imgElement);
        viewElement.val(imgElement);
    }

    function handleConfirmUploadView() {
        viewDescription.val(viewElement.val() + '<br>' + viewDescription.val());
        sendingMessagePhoto(viewDescription.val());
        viewUpload.empty();
        messanger.show();
        viewElement.val('');
        viewDescription.val('');
        viewAttachment.hide();
    }
    $("#file-description").keydown(function(event) {
        if (event.keyCode === 13 && !event.shiftKey) {
            event.preventDefault();
            viewDescription.val(viewElement.val() + '<br>' + viewDescription.val());
            sendingMessagePhoto(viewDescription.val());
            viewUpload.empty();
            messanger.show();
            viewElement.val('');
            viewDescription.val('');
            viewAttachment.hide();
        }
    });

    function handleCancelUploadView() {
        viewUpload.empty();
        viewElement.val('');
        messanger.show();
        viewAttachment.hide();
        viewDescription.val('');
    }

    confirmUploadView.addEventListener('click', handleConfirmUploadView);
    cancelUploadView.addEventListener('click', handleCancelUploadView);
</script>


<!-- Comment -->
<script>
    const uploadButton = document.getElementById('upload-button');
    const imageUploadDialog = document.getElementById('image-upload-dialog');
    const fileInput = document.getElementById('file-input');
    const imageDescriptionInput = document.getElementById('image-description');
    const confirmUploadButton = document.getElementById('confirm-upload');
    const cancelUploadButton = document.getElementById('cancel-upload');

    function uploadImage() {
        const selectedFile = fileInput.files[0];
        const description = imageDescriptionInput.value;

        if (selectedFile) {
            var isian = '';
            var data = new FormData();
            data.append('image', selectedFile);
            $.ajax({
                url: '<?= base_url() ?>ProcImageMessage',
                method: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    var imgElement = '<img src="' + url + '" alt="Gambar" style="max-height:40%; max-width:40%;" onclick="bukaGambarBaru(event)">';
                    isian = imgElement + '\n' + description;
                    sendingMessagePhoto(isian);
                    // console.log(imgElement);
                },
                error: function(data) {
                    console.log(data);
                },
                complete: function() {
                    const descriptionImage = document.getElementById('image-description');
                    descriptionImage.style.height = 40 + 'px';
                    descriptionImage.style.overflow = "hidden";
                    fileInput.value = '';
                    imageDescriptionInput.value = '';
                    imageUploadDialog.style.display = 'none';
                }
            });
        }
    }

    function cancelUpload() {
        fileInput.value = '';
        imageDescriptionInput.value = '';
        imageUploadDialog.style.display = 'none';
    }

    uploadButton.addEventListener('click', function() {
        imageUploadDialog.style.display = 'block';
    });

    confirmUploadButton.addEventListener('click', uploadImage);

    cancelUploadButton.addEventListener('click', cancelUpload);

    $("#image-description").keydown(function(event) {
        if (event.keyCode === 13 && !event.shiftKey) {
            event.preventDefault();
            uploadImage();
        }
    });

    // END UPLOAD IMAGE COMMENT MAIN



    // COMMENT MAIN
    var emptyMessage = $("#empty-comment");
    var commentContainer = $("#comment-container");
    var sendMessage = $("#send-comment-form");
    var scrolling = false;
    var previousData = null;

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
                    var newData = JSON.stringify(response);

                    if (newData !== previousData) {
                        previousData = newData;

                        var previousScrollHeight = commentContainer[0].scrollHeight;
                        commentContainer.empty();

                        $.each(response.messages, function(index, message) {
                            var potoBox = (message.gender_id === 'GR-001') ? '5.png' : '3.png';
                            var potoLive = message.photo_url;
                            if (message.message.trim() !== '') {
                                var messageClass = (message.sender_id == response.current_member_id) ? 'right' : '';
                                var senderName = (message.sender_name === '<?= $this->session->userdata("member_name") ?>') ? 'Anda' : message.sender_name;

                                var commentHtml = '<div class="direct-chat-msg ' + messageClass + '">' +
                                    '<style>' +
                                    (messageClass === 'right' ? '.direct-chat-msg.right .direct-chat-text { background-color: #90EE90; }' : '') +
                                    '</style>' +
                                    '<div class="direct-chat-info clearfix">' +
                                    '<span class="direct-chat-name ' + (messageClass === 'right' ? 'float-right' : 'float-left') + '">' + senderName + '</span>' +
                                    '<span class="direct-chat-timestamp ' + (messageClass === 'right' ? 'float-left' : 'float-right') + '">' + message.created_at + '</span>' +
                                    '</div>';


                                if (potoLive) {
                                    commentHtml += '<img class="direct-chat-img" src="<?= base_url(); ?>../api-hris/upload/' + potoLive + '" alt="User Image" class="rounded-circle" style="width: 40px; height: 40px;" title="' + senderName + '">';
                                } else {
                                    commentHtml += '<img class="direct-chat-img" src="<?= base_url(); ?>assets/dist/img/avatar' + potoBox + '" alt="User Avatar" style="width: 40px; height: 40px;">';
                                }

                                var messageWithLinks = untukUrlLink(message.message);
                                commentHtml += '<div class="direct-chat-text">' + messageWithLinks + '</div>' + '</div>';
                                commentContainer.append(commentHtml);
                            }
                        });

                        commentContainer.scrollTop(commentContainer[0].scrollHeight);
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

    function untukUrlLink(text) {
        var urlRegex = /(<img[^>]+>|https?:\/\/[^\s]+)/g;
        return text.replace(urlRegex, function(match) {
            if (match.startsWith('<img')) {
                return match;
            } else if (match.match(/^https?:\/\/[^\s]+/)) {
                return '<a href="' + match + '" target="_blank">' + match + '</a>';
            }
        });
    }



    commentContainer.on('scroll', function() {
        scrolling = commentContainer.scrollTop() + commentContainer.innerHeight() < commentContainer[0].scrollHeight;
    });

    setInterval(function() {
        fetchMessages();
    }, 1000);

    $("#message-input").keydown(function(event) {
        if (event.keyCode === 13 && !event.shiftKey) {
            event.preventDefault();
            sendingMessage();
        }
    });

    sendMessage.submit(function(event) {
        event.preventDefault();
        sendingMessage();
    });

    function sendingMessage() {
        var currentMemberId = $("#current-member-id").val();
        var message = $("#message-input").val();
        if (message === null || message.trim() === '') {
            return;
        }
        message = message.replace(/\n/g, '<br>');
        message = convertEmojiToHtmlDec(message);
        $.ajax({
            type: 'POST',
            url: '<?= base_url(); ?>insert_comment',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: {
                senderId: '',
                currentMemberId: currentMemberId,
                message: message,
                groupId: '<?= $project_id ?>',
                flag_notif: 0
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

                    $("#message-input").val(''); // Kosongkan textarea setelah pengiriman
                    var newScrollHeight = commentContainer[0].scrollHeight;
                    commentContainer.scrollTop(newScrollHeight);
                    const messageInput = document.getElementById('message-input');
                    messageInput.style.height = 40 + 'px';
                    messageInput.style.overflow = "hidden";
                } else {
                    console.log("Error inserting message:", response.error);
                }
            },
            error: function(error) {
                console.log("Error inserting message:", error);
            }
        });
    }


    fetchMessages();
    emptyMessage.hide();
    commentContainer.show();
    sendMessage.show();

    function sendingMessagePhoto(isian) {
        var currentMemberId = $("#current-member-id").val();
        var message = isian;
        message = message.replace(/\n/g, '<br>');
        message = convertEmojiToHtmlDec(message);
        $.ajax({
            type: 'POST',
            url: '<?= base_url(); ?>insert_comment',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: {
                senderId: '',
                currentMemberId: currentMemberId,
                message: message,
                groupId: '<?= $project_id ?>',
                flag_notif: 0
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
                } else {
                    console.log("Error inserting message:", response.error);
                }
            },
            error: function(error) {
                console.log("Error inserting message:", error);
            }
        });
    }
</script>