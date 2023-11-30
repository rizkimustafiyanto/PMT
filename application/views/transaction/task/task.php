<!-- Dropdown Toggle -->
<script src="<?= base_url(); ?>assets/dist/js/addition/js.js"></script>

<!-- Styling -->
<style>
    #viewImageTask {
        margin: 20px 0;
    }

    .slick-slide {
        text-align: center;
        position: relative;
    }

    .slick-slide img {
        display: inline-block;
        max-width: 100%;
        max-height: 100%;
        border-radius: 5px;
    }

    .delete-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: red;
        color: white;
        border: none;
        padding: 5px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 1;
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
<div class="content-wrapper">
    <div style="height: 5px;"></div>
    <!-- Main content -->
    <section class="content">
        <!-- <div class="loading-container">
            <div class="loading-circle"></div>
        </div> -->
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
                        <h4>Card</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-12 text-right">
                            <a class="btn btn-sm btn-info" href="<?= base_url() . 'Project/KanbanList/' . enkripbro($project_id); ?>" id="btnBoard">
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
                                <?php if ($batas_akses && $status_id != 'STL-4') : ?>
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
                        </div>
                    </Div>
                    <div class="card-body">
                        <div class="row col-md-12" style="margin-bottom: -15px;">
                            <div class="col-md-6">
                                <strong><i class="fas fa-file-alt mr-1"></i> Project Name</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="<?= base_url() ?>Project/List/<?= enkripbro($project_id) ?>" class="text-muted">
                                    <p><?= $project_name ?></p>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="row col-md-12" style="margin-bottom: -15px;">
                            <div class="col-md-6">
                                <strong><i class="fas fa-file-alt mr-1"></i> Card Name</strong>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted"><?= $list_name ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row col-md-12" style="margin-bottom: -15px;">
                            <div class="col-md-6">
                                <strong><i class="fas fa-receipt mr-1"></i> Priority</strong>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted"><?= $list_type ?></p>
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
                                <strong><i class="fas fa-quote-left mr-1"></i> Status</strong>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted"><?= $status_name ?></p>
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
                            <span class="float-right"><b><?= (strpos($percentage, '.') !== false) ? number_format($percentage, 2) : $percentage ?> %</b></span>
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
                            <div class="col-md-9" data-card-widget="collapse" style="cursor: pointer;">
                                Task List
                            </div>
                            <div class="card-tools">
                                <button id="sortedas" type="button" class="btn btn-default"><span id="sortIcon" class="fas"></span></button>
                                <button id="sortByDue" type="button" class="btn btn-default">DUE</button>
                                <?php if (($batas_akses) || ($member_type == 'MT-3')) : ?>
                                    <button type="button" class="btn btn-tool" id="btnAddTask" data-toggle="modal" data-target="#modal-input-task">
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
                        <div class="form-group row">
                            <label for="sortCriteria" class="col-sm-2 col-form-label">Sort By:</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="sortCriteria">
                                    <option value="title">Title (Alphabetic)</option>
                                    <option value="lastchange">Last Change</option>
                                    <option value="priority">Priority</option>
                                </select>
                            </div>
                        </div>
                        <div class="scrollable" style="max-height: 300px; overflow-y: auto;">
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                                <?php if (!empty($TaskRecords)) : ?>
                                    <?php foreach ($TaskRecords as $record) :
                                        $showCheckbox = ($status_id != 'STL-4' && ($member_type == 'MT-2' || $member_id == 'System' || $member_id == $record->creation_user_id));
                                        $remainingDays = 0;
                                        $prior = $record->priority_type_id;
                                        $badgeClass = '';
                                        $startDate = strtotime($record->start_date);
                                        $dueDate = strtotime($record->due_date);
                                        $currentTime = time();

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

                                        $badgePrior =  ($prior == 'PR-1') ? 'danger' : (($prior == 'PR-2') ? 'warning' : 'success');


                                        $remainingDays = round(($dueDate - $currentTime) / (60 * 60 * 24));
                                        $statusW = $record->status_id;
                                        $bgPriority = ($statusW != 'STL-4' && $remainingDays <= '0') ? '#F08080' : '';

                                        $avatar = $record->gender_id == 'GR-001' ? 'avatar5.png' : 'avatar3.png';
                                        $photo_url = $record->photo_url;
                                        if (empty($photo_url) || !file_exists(FCPATH . '../api-hris/upload/' . $photo_url)) {
                                            $photo_url = 'assets/dist/img/' . $avatar;
                                        } else {
                                            $photo_url = '../api-hris/upload/' . $record->photo_url;
                                        }

                                        $groupingMem = false;
                                        $isiGroup = [];
                                        if ($TaskMemberRecords) :
                                            foreach ($TaskMemberRecords as $col) :
                                                $isiGroup[] = $col->member_id;
                                                if ($member_id == $col->member_id) {
                                                    $groupingMem = true;
                                                }
                                            endforeach;
                                        endif;


                                    ?>
                                        <li class="overflow-auto text-nowrap" style="background-color: <?= $bgPriority ?>;">
                                            <div class="bg-<?= $badgePrior ?>" style="width: 5px; height: 10px; display: inline-block; margin-right: -20px;"></div>
                                            <div class="icheck-primary d-inline">
                                                <label for="todo1"></label>
                                                <input type="checkbox" value="" data-task_id_check="<?= $record->task_id ?>" name="todo1" id="todo1" <?= ($statusW == 'STL-4') ? 'checked' : '' ?> <?= (($batas_akses) || ($member_id == $record->creation_user_id) || ($member_id == $record->member_id) || $groupingMem) ? '' :  'disabled'; ?>>
                                            </div>
                                            <span class="text title"><?= $record->task_name ?></span>
                                            <div class="tools" style="margin-top:2px;">
                                                <?php if ($showCheckbox) : ?>
                                                    <i class="fas fa-edit" data-task_id="<?= $record->task_id ?>" data-list_id="<?= $record->list_id ?>" data-task_name="<?= $record->task_name ?>" data-start="<?= $record->start_date ?>" data-due="<?= $record->due_date ?>" data-priority="<?= $record->priority_type_id ?>" data-task_member="<?= ($record->member_id) ? $record->member_id : implode(', ', $isiGroup) ?>"></i>
                                                    <i class="fas fa-trash" data-task_id="<?= $record->task_id ?>" data-list_id="<?= $record->list_id ?>" data-task_name="<?= $record->task_name ?>"></i>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ($statusW != 'STL-4') : ?>
                                                <small class="badge <?= $badgeClass ?> float-right" style="margin-top: 5px; margin-right: 8px;"><i class="far fa-clock"></i> <?= $remainingDays ?> Days</small>
                                            <?php else : ?>
                                                <small class="badge badge-success float-right" style="margin-top: 5px; margin-right: 8px;">DONE</small>
                                            <?php endif; ?>

                                            <span class="text-muted float-right">
                                                ||
                                                <?php if ($record->member_id) : ?>
                                                    <img src="<?= base_url() . $photo_url ?>" alt="User Image" class="rounded-circle profile-trigger" style="width: 15px; height: 15px;" title="<?= $record->member_name ?>" data-member-name="<?= $record->member_name ?>" data-member-company="<?= $record->company_name ?>" data-src="<?= base_url() . $photo_url ?>">
                                                <?php else : ?>
                                                    <?php if ($TaskMemberRecords) :
                                                        foreach ($TaskMemberRecords as $key) :
                                                            $avatar1 = $key->gender_id == 'GR-001' ? 'avatar5.png' : 'avatar3.png';
                                                            $photo_url1 = $key->photo_url;
                                                            if (empty($photo_url1) || !file_exists(FCPATH . '../api-hris/upload/' . $photo_url1)) {
                                                                $photo_url1 = 'assets/dist/img/' . $avatar1;
                                                            } else {
                                                                $photo_url1 = '../api-hris/upload/' . $key->photo_url;
                                                            }
                                                    ?>
                                                            <img src="<?= base_url() . $photo_url1 ?>" alt="User Image" class="rounded-circle profile-trigger" style="width: 15px; height: 15px;" title="<?= $key->member_name ?>" data-member-name="<?= $key->member_name ?>" data-member-company="<?= $key->company_name ?>" data-src="<?= base_url() . $photo_url1 ?>">
                                                <?php endforeach;
                                                    endif;
                                                endif; ?>
                                                ||
                                            </span>
                                            <span class="text priority" style="display: none;"><?= $prior ?></span>
                                            <span class="text lastchange" style="display: none;"><?= ($record->change_datetime) ? $record->change_datetime : $record->created_at ?></span>
                                            <!-- <span class="text-muted">|| <?= $record->member_name ?> ||</span> -->
                                        </li>
                                    <?php
                                    endforeach;
                                else : ?>
                                    <div class="text-center">No Task</div>
                                <?php endif; ?>
                            </ul>
                        </div>
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
                            <p id="empty-comment" class="text-center">Empty Comment</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form id="send-comment-form">
                            <input type="hidden" id="current-member-id" value="<?= $this->session->userdata('member_id') ?>">
                            <div class="row col-md-12 p-0">
                                <textarea id="message-input" class="form-control" placeholder="Type your comment..." <?= ($member_id == 'System' || $member_type || $member_prj_type) && $status_id != 'STL-4' ? '' : 'readonly' ?> autocomplete="off" oninput="adjustInputHeight(this)" style="height: 40px; width: 88%;" onpaste="handlePaste(event)"></textarea>
                                <button type="button" class="btn" <?= ($member_id == 'System' || $member_type || $member_prj_type) && $status_id != 'STL-4' ? '' : 'disabled' ?> style="width: 4%;" onclick="toggleEmojiPicker()"><i class="fa-solid fa-laugh-beam"></i></button>
                                <button type="button" class="btn" <?= ($member_id == 'System' || $member_type || $member_prj_type) && $status_id != 'STL-4' ? '' : 'disabled' ?> style="width: 4%;" id="upload-button"><i class="fas fa-paperclip"></i></button>
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
                                            <textarea id="image-description" class="form-control" placeholder="Image Description" autocomplete="off" oninput="adjustInputHeight(this)" style="height: 40px;"></textarea>
                                        </div>
                                        <div style="width: 20%;padding-left: 5px;">
                                            <button class="btn" id="confirm-upload"><i class="fa-solid fa-paper-plane"></i></button>
                                            <button class="btn" id="cancel-upload"><i class="fa-solid fa-xmark"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn" <?= ($member_id == 'System' || $member_type || $member_prj_type) && $status_id != 'STL-4' ? '' : 'disabled' ?> style="width: 4%;"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card direct-chat direct-chat-msg file-attachment" style="display: none;">
                    <div class="card-header">
                        <h5>Sending File</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center" id="viewImageTask"></div>
                    </div>
                    <div class="card-footer">
                        <div id="file-inputing" class="row">
                            <div style="width: 90%;">
                                <input type="hidden" class="form-control" id="file-element" placeholder="Image Description">
                                <textarea class="form-control" id="file-description" placeholder="Image Description" autocomplete="off" oninput="adjustInputHeight(this)" style="height: 40px;"></textarea>
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
            <!-- List Attachment -->
            <div class="col-lg-12">
                <div class="card collapsed-card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-md-11" data-card-widget="collapse" style="cursor: pointer;">Card Attachment</div>
                            <div class="card-tools">
                                <?php if (($member_id == 'System' || $member_type || $member_prj_type) && $status_id != 'STL-4') : ?>
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
                                            <td><?= $record->member_upload ?></td>
                                            <td class="text-center">
                                                <a id="btnDownload" class="btn btn-xs btn-success" href="<?= base_url('DownloadAttachment/' . $record->attachment_url) ?>">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a href="<?= base_url('ViewAttachment/' . $record->attachment_url) ?>" target="_blank" class="btn btn-xs btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <?php if (($member_type == 'MT-2' || $member_id == 'System' || $member_id == $creator || $member_id == $record->creation_user_id) && $status_id != 'STL-4') : ?>
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
            <!-- Batas List Attachment -->
            <!-- Card Member -->
            <div class="col-lg-12">
                <div class="card collapsed-card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-md-11" data-card-widget="collapse" style="cursor: pointer;">Members</div>
                            <div class="card-tools">
                                <?php if ($batas_akses && $status_id != 'STL-4') : ?>
                                    <button type="button" class="btn btn-xs btn-tool" id="btnAddMember" data-toggle="modal" data-target="#modal-input-list-member">
                                        <i class="fa fa-user-plus"></i>
                                    </button>
                                <?php
                                endif; ?>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="col-md-12 text-center">
                            <span class="badge badge-warning"><?= $total_member ?> Members</span>
                        </div>
                        <ul class="users-list clearfix">
                            <?php if (!empty($ListMemberRecords)) :
                                foreach ($ListMemberRecords as $record) :
                                    $typeM = $record->variable_id;
                                    $avatar = $record->gender_id == 'GR-001' ? 'avatar5.png' : 'avatar3.png';
                                    $photo_url = $record->photo_url;
                                    if (empty($photo_url) || !file_exists(FCPATH . '../api-hris/upload/' . $photo_url)) {
                                        $photo_url = 'assets/dist/img/' . $avatar;
                                    } else {
                                        $photo_url = '../api-hris/upload/' . $record->photo_url;
                                    }

                                    $warnaType = ($typeM == 'MT-1') ? 'primary' : (($typeM == 'MT-2') ? 'success' : 'danger');
                            ?>
                                    <li>
                                        <img src="<?= base_url() . $photo_url ?>" alt="User Image" style="width: 60px; height: 60px;">
                                        <a class="users-list-name" href="javascript:void(0);"><?= $record->member_name ?></a>
                                        <a class="btn btn-xs btn-<?= $warnaType ?>" <?= $typeM == 'MT-4' ? 'style="background-color:purple;border-color:purple;"' : '' ?> data-bs-toggle="dropdown" <?= ($batas_akses && $status_id != 'STL-4') ? '' : 'disabled' ?>>
                                            <?= $record->member_type ?>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <?php foreach ($MemberTypeRecords as $row) : ?>
                                                    <a class="dropdown-item" data-list_member_id="<?= $record->list_member_id ?>" data-member_id='<?= $record->member_id ?>' data-mtype_id='<?= $row->variable_id ?>' id="slcMember" data-toggle="modal" data-target="#modal-update-list-member">
                                                        <i class="fa fa-pen"></i> <?= $row->variable_name ?>
                                                    </a>
                                                <?php endforeach; ?>
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
                                        <div class="col-md-9" style="max-width: 100%;">
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
<div class="modal fade" id="modal-input-list-member" role="dialog" aria-labelledby="modal-input-list-member-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Card Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="row col-lg-12 justify-content-between">
                            <div style="margin-left: 10px;">
                                <label for="MemberItem" class="mr-2">Assign Member</label>
                            </div>
                            <div>
                                <input type="checkbox" name="pmemberc" id="pmemberc" onchange="toggleMember()">
                                <label for="pmemberc" class="mr-2">All Member</label>
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <select class="form-control" id="member_id" name="member_id[]" multiple="multiple" style="width: 100%;"></select>
                        </div>
                        <div class="col-lg-12">
                            <label>Member Type</label>
                            <select class="form-control select2bs4" name="member_type_id" id="member_type_id" data-width="100%" style="width: 100%;">
                                <option value="">-- Choose Type --</option>
                                <?php foreach ($MemberTypeRecords as $row) : ?>
                                    <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnMember">Add Member</button>
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
                <div class="modal-title">Add Card Attachment</div>
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
                            <br>
                            <div style="display:none;">
                                <label>Attachment Type</label>
                                <select class="form-control select2bs4" name="attachment_type" id="attachment_type" data-width=100%>
                                    <?php foreach ($AttachmentTypeRecord as $row) : ?>
                                        <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
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

<!-- Modal Update -->
<div class="modal fade" id="modal-update-list" role="dialog" aria-labelledby="modal-update-label" aria-hidden="true">
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
                                    <h5 class="card-title" style="width: 90%;">
                                        <input type="text" id="list_name" class="form-control" placeholder="Project Name" value="<?= $list_name ?>" autocomplete="off">
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
                                <label for="CheckingPriority">Priority Card</label>
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
                                <label for="dateRange">Date Range</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dateRange">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="list_status" class="mr-2">List Status</label>
                                <select class="form-control select2bs4" name="list_status" id="list_status" style="width: 100%;">
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
<div class="modal fade" id="modal-input-task" role="dialog" aria-labelledby="modal-input-task-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 420px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Task</h5>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="task_name">Task Name</label>
                        <input type="text" class="form-control" id="task_name" placeholder="Task Name" autocomplete="off">
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
                                <label class="form-check-label">Normal</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="priority_task" value="PR-1">
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
                            <label for="AssignMember" class="mr-2">Assign Member</label>
                        </div>
                        <div>
                            <input type="checkbox" name="ppersonalc" id="ppersonalc" onchange="togglePersonal()">
                            <label for="project_manage" class="mr-2">Personal</label>
                        </div>
                    </div>
                    <div class="form-group" id="ppersonal">
                        <select class="form-control" id="members_task" name="members_task[]" multiple="multiple"></select>
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
<div class="modal fade" id="modal-update-task" role="dialog" aria-labelledby="modal-update-task-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 420px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Task</h5>
            </div>
            <form id="">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="update_task_id" placeholder="Project ID" name="update_task_id" required readonly>
                        <input type="hidden" class="form-control" id="update_list_id_task" placeholder="Project ID" name="update_list_id_task" required readonly>
                        <label for="task_name">Task Name</label>
                        <input type="text" class="form-control" id="update_task_name" placeholder="Task Name" autocomplete="off">
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
                                <label class="form-check-label">Normal</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="update_priority_task" value="PR-1">
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
                    <div class="row col-lg-12 justify-content-between">
                        <div>
                            <label for="AssignMember" class="mr-2">Assign Member</label>
                        </div>
                        <div>
                            <input type="checkbox" name="ppersonalcu" id="ppersonalcu" onchange="togglePersonalU()">
                            <label for="project_manage" class="mr-2">Personal</label>
                        </div>
                    </div>
                    <div class="form-group" id="ppersonalu">
                        <select class="form-control" id="update_members_task" name="update_members_task[]" multiple="multiple"></select>
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
    document.addEventListener("DOMContentLoaded", function() {
        const taskList = document.querySelector(".todo-list");
        const sortCriteria = document.querySelector("#sortCriteria");
        const sortButton = document.querySelector("#sortedas");
        const sortByDueButton = document.querySelector("#sortByDue");

        let isDescending = false;

        function sortByDue() {
            const tasks = Array.from(taskList.children);
            if (tasks.length === 0) {
                return; // Tidak ada tugas untuk diurutkan
            }
            tasks.sort((a, b) => {
                const aValue = parseInt(a.querySelector(".badge .far").nextSibling.textContent);
                const bValue = parseInt(b.querySelector(".badge .far").nextSibling.textContent);

                if (isDescending) {
                    return bValue - aValue;
                } else {
                    return aValue - bValue;
                }
            });

            // Hapus semua tugas dari daftar
            taskList.innerHTML = "";

            // Tambahkan tugas yang sudah diurutkan kembali ke daftar
            tasks.forEach(task => taskList.appendChild(task));
        }

        function updateSortButtonIcon(isDescending) {
            if (isDescending) {
                sortIcon.classList.remove("fa-sort-asc");
                sortIcon.classList.add("fa-sort-desc");
            } else {
                sortIcon.classList.remove("fa-sort-desc");
                sortIcon.classList.add("fa-sort-asc");
            }
        }

        function parsePriority(priorityString) {
            if (priorityString === "PR-1") {
                return 3;
            } else if (priorityString === "PR-2") {
                return 2;
            } else {
                return 1;
            }
        }

        function sortByPriority() {
            const tasks = Array.from(taskList.children);
            if (tasks.length === 0) {
                return; // Tidak ada tugas untuk diurutkan
            }
            tasks.sort((a, b) => {
                const aValue = parsePriority(a.querySelector(".priority").textContent);
                const bValue = parsePriority(b.querySelector(".priority").textContent);
                return isDescending ? bValue - aValue : aValue - bValue;
            });
            tasks.forEach(task => taskList.removeChild(task));
            tasks.forEach(task => taskList.appendChild(task));
        }

        function sortByLastChange() {
            const tasks = Array.from(taskList.children);
            if (tasks.length === 0) {
                return; // Tidak ada tugas untuk diurutkan
            }
            tasks.sort((a, b) => {
                const aValue = new Date(a.querySelector(".lastchange").textContent);
                const bValue = new Date(b.querySelector(".lastchange").textContent);
                return isDescending ? bValue - aValue : aValue - bValue;
            });
            tasks.forEach(task => taskList.removeChild(task));
            tasks.forEach(task => taskList.appendChild(task));
        }

        function sortTasks(criteria) {
            if (criteria === "title") {
                const tasks = Array.from(taskList.children);
                if (tasks.length === 0) {
                    return; // Tidak ada tugas untuk diurutkan
                }
                tasks.sort((a, b) => {
                    const aValue = a.querySelector(".title").textContent;
                    const bValue = b.querySelector(".title").textContent;
                    return isDescending ? bValue.localeCompare(aValue) : aValue.localeCompare(bValue);
                });

                tasks.forEach(task => taskList.removeChild(task));
                tasks.forEach(task => taskList.appendChild(task));
            } else if (criteria === "lastchange") {
                sortByLastChange();
            } else if (criteria === "priority") {
                sortByPriority();
            }
        }

        sortCriteria.addEventListener("change", function() {
            const selectedCriteria = this.value;
            sortTasks(selectedCriteria);
        });
        sortButton.addEventListener("click", function() {
            isDescending = !isDescending;
            const selectedCriteria = sortCriteria.value;
            sortTasks(selectedCriteria);
            updateSortButtonIcon(isDescending);
        });
        sortByDueButton.addEventListener("click", function() {
            sortByDue();
        });

        sortTasks("title");
        updateSortButtonIcon(isDescending);

        const referrer = document.referrer;
        console.log(referrer);
        const previousDetail = "<?= base_url() ?>Project/List/<?= $project_id ?>";
        if (referrer === previousDetail) {
            $('#btnBoard').toggle(false);
        }
    });


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

    document.addEventListener('click', function(event) {
        var emojiPicker = document.querySelector('.emoji-picker');
        if (emojiPicker.style.display === 'block' && !emojiPicker.contains(event.target)) {
            emojiPicker.style.display = 'none';
        }
    });
</script>

<script>
    //Function Update List
    $(document).on('click', '#btnUpList', function() {
        var priority = '<?= $priority_type ?>';
        $("input[name='priority_list'][value='" + priority + "']").prop("checked", true);
        date2In1();
    })

    $(document).on('click', '#btnUpdateList', function() {
        var dateRange = $('#dateRange').val();
        var dates = dateRange.split(' - ');
        var id = '<?= $list_id ?>';
        var title = $('#list_name').val();
        var listStart = dates[0];
        var listDue = dates[1];
        // var listStart = $('#list_start').val();
        // var listDue = $('#list_due').val();
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
        loadIng();
        updateList(UpdateList);
    })

    function updateList(UpdateList) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateList',
            type: 'POST',
            data: UpdateList,
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

    // Function Add Task
    $(document).on('click', '#btnAddTask, #btnAddMember, i.fa-edit', function() {
        var $memberSelect = $('.select2-selection');
        var terpilihText = $('.select2-selection__rendered');
        var savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            $memberSelect.css({
                'background-color': '##343a40',
                'border-color': '#6c757d',
                'color': '#fff'
            });
            terpilihText.css({
                'color': 'white'
            })
        } else {
            $memberSelect.css({
                'background-color': '#fff',
                'color': '#333'
            });
            terpilihText.css({
                'color': '#333'
            })
        }
        date2In1();
        handleSelectMember();
        togglePersonal();
    })

    $(document).on('click', '#AddTask', function() {
        var dateRange = $('#dateRange2').val();
        var dates = dateRange.split(' - ');
        var listId = '<?= $list_id ?>';
        var title = $('#task_name').val();
        var taskStart = dates[0];
        var taskDue = dates[1];
        // var taskStart = $('#task_start').val();
        // var taskDue = $('#task_due').val();
        var membersTask = $('#members_task').val();
        var priority = $("input[name='priority_task']:checked").val();
        var personal = 0;

        const checks = document.getElementById("ppersonalc");
        if (checks.checked) {
            personal = 1;
        } else {
            console.log('ok');
            if (membersTask == "") {
                validasiInfo('Please complete assign member before adding project task!');
                return;
            }
        }

        var temp_start_date = "<?= $start_date; ?>";
        var temp_due_date = "<?= $due_date; ?>";

        if (!listId || !title || !taskStart || !taskDue || !priority) {
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
            membersTask: JSON.stringify(membersTask),
            personal: personal
        };

        // TOOLS
        var addBtnProject = document.getElementById("AddTask");
        addBtnProject.disabled = true;
        addBtnProject.textContent = "Creating...";
        addBtnProject.classList.add("disabled");

        // console.log(AddingItem);
        loadIng();
        addTask(AddingItem);
    })

    function addTask(AddingItem) {
        $.ajax({
            url: '<?= base_url(); ?>InsertTask',
            type: 'POST',
            data: AddingItem,
            success: function(response) {
                Swal.close();
                $('#modal-input-task').modal('hide');
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
                        window.location.reload(); // Reload the page
                    }
                });

            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
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

        var memberType = '<?= $member_type ?>';
        var memberNow = $(this).data('task_member');
        const checks = document.getElementById("ppersonalcu");
        var memberArray = JSON.stringify(memberNow).includes(',') ? memberNow.split(',').map(item => item.trim()) : 1;
        checks.checked = !Array.isArray(memberArray);
        togglePersonalU();

        var membersData = [];

        <?php if ($MemberSelectRecord) :
            foreach ($MemberSelectRecord as $key) { ?>
                membersData.push({
                    id: "<?= $key->member_id ?>",
                    text: "<?= $key->member_name ?>"
                });
        <?php }
        endif; ?>

        $('#update_members_task').empty().select2({
            placeholder: '-- Choose Members --',
            allowClear: true,
            minimumInputLength: 0,
            data: membersData,
            templateSelection: colorSelect
        });
        warnaMultiple();

        if (!checks.checked) {
            $('#update_members_task').val(memberArray).trigger('change');
        }

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

        $('#modal-update-task').modal('show');
    })

    $(document).on('click', '#UpdateTask', function() {
        var dateRange = $('#dateRange2up').val();
        var dates = dateRange.split(' - ');
        var id = $('#update_task_id').val();
        var list_id = $('#update_list_id_task').val();
        var title = $('#update_task_name').val();
        var projectStart = dates[0];
        var projectDue = dates[1];
        // var projectStart = $('#update_task_start').val();
        // var projectDue = $('#update_task_due').val();
        var priority = $("input[name='update_priority_task']:checked").val();
        var member_task = $('#update_members_task').val();
        var frog = 2;
        const checks = document.getElementById("ppersonalcu");
        if (checks.checked) {
            member_task = '<?= $member_id ?>';
        } else {
            frog = 21;
        }


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
            memberId: JSON.stringify(member_task),
            flag: frog
        };


        // TOOLS
        var updateButton = document.getElementById("UpdateTask");
        updateButton.disabled = true;
        updateButton.textContent = "Updating...";
        updateButton.classList.add("disabled");

        // console.log(UpdateTask);
        loadIng();
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
            loadIng();
            updateTask(UpdateTask);
        } else {
            var UpdateTask = {
                id: id,
                list_id: '<?= $list_id ?>',
                title: '',
                start: '',
                due: '',
                priority: '',
                status: 'STL-1',
                memberId: '',
                flag: 1
            };
            loadIng();
            updateTask(UpdateTask);
        }
    });

    function updateTask(UpdateTask) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateTask',
            type: 'POST',
            data: UpdateTask,
            success: function(response) {
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
                // console.log(delData);
                loadIng();
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
    // End Function Delete Task

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
            member_id: JSON.stringify(memberId),
            member_type_id: memberType
        };

        // TOOLS
        var addBtn = document.getElementById("btnMember");
        addBtn.disabled = true;
        addBtn.textContent = "Adding...";
        addBtn.classList.add("disabled");

        // console.log(AddingMember);
        loadIng();
        InMember(AddingMember);
    })

    function InMember(AddingMember) {
        $.ajax({
            url: '<?= base_url(); ?>InsertListMember',
            type: 'POST',
            data: AddingMember,
            success: function(response) {
                $('#modal-input-list-member').modal('hide');
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
        var listId = '<?= $list_id ?>';
        var listMId = $(this).data('list_member_id');
        var memberId = $(this).data('member_id');
        var memberType = $(this).data('mtype_id');

        var UpdatingMember = {
            list_id: listId,
            list_member_id: listMId,
            member_id: memberId,
            member_type_id: memberType,
            r_status: 'A'
        };
        // console.log(UpdatingMember);
        UpMember(UpdatingMember);
    })

    function UpMember(UpdatingMember) {
        $.ajax({
            url: '<?= base_url(); ?>UpdateListMember',
            type: 'POST',
            data: UpdatingMember,
            success: function(response) {
                $('#modal-update-list-member').modal('hide');
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
    function togglePersonal() {
        const checks = document.getElementById("ppersonalc");
        const membersGroup = document.getElementById("ppersonal");

        if (checks.checked) {
            membersGroup.style.display = "none";
            $('#members_task').empty()
        } else {
            membersGroup.style.display = "block";
            var membersData = [];

            <?php if ($MemberSelectRecord) :
                foreach ($MemberSelectRecord as $key) { ?>
                    membersData.push({
                        id: "<?= $key->member_id ?>",
                        text: "<?= $key->member_name ?>"
                    });
            <?php }
            endif; ?>

            $('#members_task').empty().select2({
                placeholder: '-- Choose Members --',
                allowClear: true,
                minimumInputLength: 0,
                data: membersData,
                templateSelection: colorSelect
            });
            warnaMultiple();
        };
    };

    function togglePersonalU() {
        const checks = document.getElementById("ppersonalcu");
        const membersGroup = document.getElementById("ppersonalu");

        if (checks.checked) {
            membersGroup.style.display = "none";
            $('#update_members_task').empty()
        } else {
            membersGroup.style.display = "block";
            var membersData = [];

            <?php if ($MemberSelectRecord) :
                foreach ($MemberSelectRecord as $key) { ?>
                    membersData.push({
                        id: "<?= $key->member_id ?>",
                        text: "<?= $key->member_name ?>"
                    });
            <?php }
            endif; ?>

            $('#update_members_task').empty().select2({
                placeholder: '-- Choose Members --',
                allowClear: true,
                minimumInputLength: 0,
                data: membersData,
                templateSelection: colorSelect
            });
            warnaMultiple();
        };
    };

    function handleSelectMember() {
        const checks = document.getElementById("pmemberc");
        const membsArray = [];
        <?php if ($ProjectMemberRecords) : if ($member_type == 'MT-3') { ?>
                membsArray.push({
                    id: "<?= $member_id ?>",
                    text: "It's You"
                });
                <?php } else {
                foreach ($ProjectMemberRecords as $key) { ?>
                    membsArray.push({
                        id: "<?= $key->member_id ?>",
                        text: "<?= $key->company_initial ?>" + " - " + "<?= $key->company_brand_name ?>" + " - " + "<?= $key->member_name ?>"
                    });
        <?php }
            }
        endif; ?>

        $('#member_id').select2({
            placeholder: '-- Choose Members --',
            allowClear: true,
            minimumInputLength: 0,
            data: membsArray,
            templateSelection: colorSelect
        });

        if (checks.checked) {
            $('#member_id').val(membsArray.map(item => item.id)).trigger('change');
        } else {
            $('#member_id').val([]).trigger('change');
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

    function goBack() {
        history.go(-1);
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








<!-- PASTE IMAGE IN COMMENT -->
<script>
    var messanger = $(".messanger");
    var viewElement = $("#file-element");
    var viewDescription = $("#file-description");
    var viewAttachment = $(".file-attachment");
    var viewUpload = $("#viewImageTask");
    const confirmUploadView = document.getElementById('confirm-upload-view');
    const cancelUploadView = document.getElementById('cancel-upload-view');
    var uploadedImages = [];

    // Fungsi pengiriman gambar satu per satu secara berurutan
    function sendImagesSequentially(index = 0) {
        if (index < uploadedImages.length) {
            var url = uploadedImages[index];
            var isianDeskripsion = '<img src="' + url + '" alt="Gambar" style="max-height:40%; max-width:40%;" onclick="bukaGambarBaru(event)"><br>' + viewDescription.val();
            sendingMessagePhoto(isianDeskripsion);

            setTimeout(function() {
                sendImagesSequentially(index + 1);
            }, 1000);
        } else {
            setTimeout(function() {
                viewDescription.val('');
            }, 1000);
        }
    }

    // Menangani event paste
    function handlePaste(event) {
        var items = (event.clipboardData || event.originalEvent.clipboardData).items;
        var files = [];
        for (var index in items) {
            var item = items[index];
            if (item.kind === 'file') {
                var blob = item.getAsFile();
                files.push(blob);
            }
        }
        if (files.length > 0) {
            uploadPastedFiles(files);
            messanger.hide();
        }
    }

    // Mengunggah file yang disalin or manipulate
    function uploadPastedFiles(files) {
        files.forEach(function(file, index) {
            var data = new FormData();
            data.append('image', file);

            setTimeout(function() {
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
            }, index * 1000); // Jeda untuk declare perfile supaya url kebaca
        });
    }


    // Menampilkan file yang diunggah
    function displayUploadedFile(url) {
        uploadedImages.push(url);
        updateImageSlider();
        console.log(uploadedImages);
    }

    // Memperbarui slider gambar
    function updateImageSlider() {
        if ($('#viewImageTask').hasClass('slick-initialized')) {
            $('#viewImageTask').slick('unslick');
        }

        viewUpload.empty();
        uploadedImages.forEach(function(url) {
            var imgElement = '<div class="uploaded-image" data-url="' + url + '">';
            imgElement += '<img src="' + url + '" alt="Gambar" style="max-height:40%; max-width:40%;" onclick="bukaGambarBaru(event)">';
            imgElement += '<button class="delete-btn" onclick="deleteImage(this)">Delete</button></div>';
            viewUpload.append(imgElement);
        });

        $('#viewImageTask').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: true
        });
        viewAttachment.show();
    }

    // Menghapus gambar
    function deleteImage(btn) {
        var imageUrl = $(btn).siblings('img').attr('src');
        var index = uploadedImages.indexOf(imageUrl);
        if (index > -1) {
            uploadedImages.splice(index, 1);
        }
        $(btn).parent('.uploaded-image').remove();
        updateImageSlider();
    }

    // Konfirmasi pengiriman gambar
    function handleConfirmUploadView() {
        sendImagesSequentially();
        viewUpload.empty();
        messanger.show();
        viewElement.val('');
        viewAttachment.hide();
    }

    // Handle tombol 'Enter' pada file description
    $("#file-description").keydown(function(event) {
        if (event.keyCode === 13 && !event.shiftKey) {
            event.preventDefault();
            sendImagesSequentially();
            viewUpload.empty();
            messanger.show();
            viewElement.val('');
            viewAttachment.hide();
        }
    });

    // Batal mengunggah
    function handleCancelUploadView() {
        viewUpload.empty();
        viewElement.val('');
        messanger.show();
        viewAttachment.hide();
        viewDescription.val('');
    }

    // Event Listener untuk konfirmasi dan pembatalan upload
    confirmUploadView.addEventListener('click', handleConfirmUploadView);
    cancelUploadView.addEventListener('click', handleCancelUploadView);
</script>

<!-- Comment -->
<script>
    // UPLOAD IMAGE COMMENT MAIN
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
    var angkaTheme = 0;
    var changeTh = 0;

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
                    var newData = JSON.stringify(response);
                    var savedTheme = localStorage.getItem('theme');
                    var warnaChat = (savedTheme === 'dark') ? '#009978' : '#CDFBCC';
                    angkaTheme = (savedTheme === 'dark') ? 1 : 2;

                    if (newData !== previousData || angkaTheme !== changeTh) {
                        changeTh = angkaTheme;
                        previousData = newData;

                        var previousScrollHeight = commentContainer[0].scrollHeight;
                        commentContainer.empty();

                        var previousDate = null;

                        $.each(response.messages, function(index, message) {
                            var timestamp = message.created_at;
                            var date = new Date(timestamp);
                            var formattedDate = ('0' + date.getDate()).slice(-2) + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + date.getFullYear();
                            var formattedTime = ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
                            var potoBox = (message.gender_id === 'GR-001') ? '5.png' : '3.png';
                            var potoLive = message.photo_url;
                            var commentHtml = '';

                            if (message.message.trim() !== '') {
                                var messageClass = (message.sender_id == response.current_member_id) ? 'right' : '';
                                var senderName = (message.sender_name === '<?= $this->session->userdata("member_name") ?>') ? 'Anda' : message.sender_name;

                                if (formattedDate !== previousDate) {
                                    commentHtml += '<div class="direct-chat-msg text-center" style="margin-bottom:0px;margin-top:20px;">' +
                                        '<div class="direct-chat-info clearfix">-----------------------   ' +
                                        '<span class="badge badge-warning text-center">' + formattedDate + '</span>' +
                                        '   -----------------------</div>' +
                                        '</div>';
                                    previousDate = formattedDate;
                                }

                                commentHtml += '<div class="direct-chat-msg ' + messageClass + '">' +
                                    '<style>' +
                                    // #87CEEB #FFF0F5 #FFFFF0
                                    (messageClass === 'right' ? '.direct-chat-msg.right .direct-chat-text { background-color: #009978; }' : '') +
                                    '</style>' +
                                    '<div class="direct-chat-info clearfix">' +
                                    '<span class="direct-chat-name ' + (messageClass === 'right' ? 'float-right' : 'float-left') + '">' + senderName + '</span>' +
                                    '</div>';

                                if (potoLive) {
                                    commentHtml += '<img class="direct-chat-img" src="<?= base_url(); ?>../api-hris/upload/' + potoLive + '" alt="User Image" class="rounded-circle" style="width: 40px; height: 40px;" title="' + senderName + '">';
                                } else {
                                    commentHtml += '<img class="direct-chat-img" src="<?= base_url(); ?>assets/dist/img/avatar' + potoBox + '" alt="User Avatar" style="width: 40px; height: 40px;">';
                                }

                                var messageWithLinks = untukUrlLink(message.message);
                                commentHtml += '<div class="direct-chat-text">' + messageWithLinks + ' ' +
                                    '<span class="direct-chat-timestamp float-right text-sm">' + formattedTime + '</span>' +
                                    '</div>' +
                                    '</div>';
                            }

                            commentContainer.append(commentHtml);
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
        var message = $("#message-input").val().trim();
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
                groupId: '<?= $list_id ?>',
                flag_notif: 1
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
                groupId: '<?= $list_id ?>',
                flag_notif: 1
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