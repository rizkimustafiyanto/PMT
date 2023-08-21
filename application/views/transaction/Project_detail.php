<?php
$project_id = '';
$project_name = '';
$project_type = '';
$description = '';
$record_status = '';
$name_record_status = '';
$creation_id = '';
$status_id = '';
$name_project_status = '';

if (!empty($ProjectRecords)) {
    foreach ($ProjectRecords as $record) {
        $project_id = $record->project_id;
        $project_name = $record->project_name;
        $project_type = $record->project_type;
        $description = $record->description;
        $record_status = $record->record_status;
        $name_record_status = $record->name_record_status;
        $creation_id = $record->creation_id;
        $status_id = $record->status_id;
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
?>

<!-- Dropdown Toggle -->
<script src="<?php echo base_url(); ?>assets/dist/js/addition/js.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
        <!-- Insert Project Card -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Project</h4>
            </div>
            <form role="form" action="<?php echo base_url(); ?>InsertProjectMember" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline" style="max-height: 300px;">
                                <div class="card-header">
                                    <h5 class="card-title" style="width: 90%;"><input type="text" id="project_name" class="form-control" placeholder="Project Name"></h5>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" href=""><i class="fa fa-pen"></i></a>
                                    </div>
                                </div>
                                <textarea class="editor" name="content"></textarea>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Komentar</h5>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="direct-chat-messages" id="comment-container" style="display: none;">
                                    </div>
                                    <div class="empty-message-container d-flex align-items-center justify-content-center">
                                        <p id="empty-comment" class="text-center">Komentar Kosong</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <form id="send-comment-form">
                                        <input type="hidden" id="current-member-id" value="<?= $this->session->userdata('member_id') ?>">
                                        <div class="input-group">
                                            <input type="text" id="comment-input" class="form-control" placeholder="Type your comment...">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CheckingPriority">Priority Project</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">High</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-inline">
                                <label for="AssignMember" class="mr-2">Assign Member</label>
                                <select class="form-control select2bs4" name="member_id" data-width="74%" id="memberSelect" style="display: none;">
                                    <option value="">-- Select an option --</option>
                                    <?php foreach ($MemberRecords as $row) : ?>
                                        <option value="<?php echo $row->member_id; ?>">
                                            <?php
                                            $companyName = '';
                                            if ($row->company_name == "PT Persada Lampung Raya") {
                                                $companyName = 'PLR';
                                            } else if ($row->company_name == "PT Persada Palembang Raya") {
                                                $companyName = 'PPR';
                                            } else if ($row->company_name == "PT Gita Riau Makmur") {
                                                $companyName = 'GRM';
                                            } // Add more cases as needed

                                            echo $companyName . ' - ' . $row->member_name;
                                            ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top: 5px;">
                                <?php $potoBox = '5.png' ?>
                                <img src="<?= base_url(); ?>assets/dist/img/avatar<?= $potoBox ?>" class="mr-3 img-circle" alt="User Avatar" style="width: 50px; height: 50px;">
                            </div>
                            <div class="form-inline">
                                <label for="dateproject" class="mr-2">Date Project</label>
                                <input type="date" class="form-control">
                                <div style="margin-left: 10px;"></div>
                                <label for="dateproject" class="mr-2">To</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <input type="submit" id="btnSubmit" class="btn btn-primary" value="Simpan Project">
                    </div>
                </div>

            </form>
        </div>
        <!-- Batas Insert Project Card -->

        <!-- /.card-header -->
        <div class="card card-sm card-default">
            <div class="card-header">
                <div class="row ">
                    <div class="col-sm-6">
                        <h2>Detail Project</h2>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-xs-12 text-right">
                            <a class="btn btn-danger" id="btnBack" href="<?php echo base_url() . 'Project'; ?>">
                                <i class="fa fa-lg fa-reply"></i>
                            </a>
                            <a class="btn btn-info" href="<?php echo base_url() . 'KanbanDetail/' . $project_id; ?>">
                                <i class="fa fa-lg fa-eye"></i> Kanban
                            </a>
                            <?php if (
                                $member_type == 'MT-1' ||
                                $member_id == 'System'
                            ) {
                                if ($status_id == 'STW-1') { ?>
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
            <div class="col-md-6">
                <div class="card">
                    <Div class="card-header">
                        <div class="card-title">
                            <h4>Description</h4>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </Div>
                    <div class="card-body">
                        <div class="row">
                            <!--Menentukan Type User WorkSpace-->
                            <input type="hidden" class="form-control" id="member_type" placeholder="member_type" name="member_type" maxlength="20" readonly="true" value="<?php echo $member_type; ?>" required>
                            <input type="hidden" class="form-control" id="member_id_role" placeholder="member_id" name="member_id" maxlength="20" readonly="true" value="<?php echo $member_id; ?>" required>
                            <!--Menentukan Type User WorkSpace-->
                            <div class="col-md-12">
                                <label>Project Status</label>
                                <div class="input-group date">
                                    <input class="form-control" id="" placeholder="Project Status" name="status_id" maxlength="20" value="<?php echo $name_project_status; ?>" required readonly="true">
                                    <?php if (
                                        $member_type == 'MT-1' ||
                                        $member_id == 'System'
                                    ) {
                                        if ($status_id == 'STW-1') { ?>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" id="btn_change" data-toggle="modal" data-target="#modal-change-status"><i class="fa fa-exchange-alt" aria-hidden="true"></i> Change</button>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                                <br>
                            </div>

                            <div class="col-md-12">
                                <label for="project_id">Project ID</label>
                                <input class="form-control" id="project_id" placeholder="Project ID" name="project_id" maxlength="20" readonly="true" value="<?php echo $project_id; ?>" required>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <label for="project_name">Project Name*</label>
                                <input class="form-control" id="project_name" placeholder="Project Name" name="project_name" maxlength="50" value="<?php echo $project_name; ?>" required>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <label>Project Type</label>
                                <select class="form-control select2bs4" name="project_type" id="project_type" data-width=100%>
                                    <?php foreach ($ProjectTypeRecords
                                        as $row) {
                                        $selected =
                                            $row->variable_id == $project_type
                                            ? 'selected'
                                            : ''; ?>
                                        <option value="<?= $row->variable_id ?>" <?= $selected ?> class="">
                                            <?= $row->variable_name ?></option>
                                    <?php
                                    } ?>
                                </select>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" placeholder="Description" name="description" maxlength="1000" rows="5"><?php echo $description; ?></textarea>
                                <br>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Member -->
            <div class="col-md-6">
                <div class="card" style="height:600px;">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Members</h4>
                        </div>
                        <div class="card-tools">
                            <?php if ($member_type == 'MT-1' || $member_id == 'System') {
                                if ($status_id == 'STW-1') { ?>
                                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-project-member">
                                        <i class="fa fa-plus"></i> Add Project Member
                                    </button>
                            <?php }
                            } ?>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" style="height:440px; overflow: auto;">
                        <div class="col-md-12 text-center">
                            <span class="badge badge-warning"><?= $total_member; ?> Members</span>
                        </div>
                        <ul class="users-list clearfix">
                            <?php if (!empty($ProjectMemberRecords)) {
                                foreach ($ProjectMemberRecords as $record) { ?>
                                    <li>
                                        <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($record->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" style="width:120px">
                                        <a class="users-list-name" href="#"><?= $record->member_name; ?></a>
                                        <span class="badge badge-success"><?= $record->member_type; ?></span>
                                        <?php if ($member_type == 'MT-1' || $member_id == 'System') {
                                            if ($status_id == 'STW-1') {
                                                if ($record->member_id != $creation_id) { ?>
                                                    <a class="btn btn-xs btn-success" data-bs-toggle="dropdown">
                                                        <i class="fas fa-bars"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="#">Action &raquo;</a>
                                                            <ul class="dropdown-menu dropdown-submenu">
                                                                <li>
                                                                    <a id="btnSelectMemberProject" class="dropdown-item" data-project_member_id="<?= $record->project_member_id ?>" data-project_id="<?= $record->project_id ?>" data-member_id="<?= $record->member_id ?>" data-member_type_id="<?= $record->member_type_id ?>" data-toggle="modal" data-target="#modal-project-member-update">
                                                                        <i class="fa fa-pen"></i> Edit Member
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item tombol-hapus" href="<?= base_url() . 'DeleteProjectMember/' . $record->project_member_id . '/' . $record->project_id; ?>">
                                                                        <i class="fa fa-trash"></i> Delete Member
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                        <?php }
                                            }
                                        } ?>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- The Limit Card Member -->
        </div>

        <div class="card card-sm card-default">
            <div class="card-header">
                <div class="row ">
                    <div class="col-sm-6">
                        <h2>Card List</h2>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-xs-12 text-right">
                            <?php if (
                                $member_type == 'MT-1' ||
                                $member_id == 'System' ||
                                $member_type == 'MT-2'
                            ) {
                                if ($status_id == 'STW-1') { ?>
                                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-card">
                                        <i class="fa fa-plus"></i> Add Card
                                    </button>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- High -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>High</h4>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tblCardHeight" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Priority</th>
                                    <th>Card ID</th>
                                    <th>Card Name</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>Due Date</th>
                                    <th>Last Updated</th>
                                    <th>Percentage</th>
                                    <th>Status Project</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($CardHeightRecord)) {
                                    foreach ($CardHeightRecord as $record) { ?>
                                        <tr>
                                            <td><a class="badge badge-pill badge-danger float">
                                                    <?= $record->priority_type ?></a></td>
                                            <td><?php echo $record->card_id; ?></td>
                                            <td><?php echo $record->card_name; ?></td>
                                            <td><?php echo $record->description; ?></td>
                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->start_date)
                                                ); ?></td>
                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->due_date)
                                                ); ?></td>

                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->last_update)
                                                ); ?></td>
                                            <td>
                                                <div class="progress-group">
                                                    <span class="float-center"><b><?php echo $record->percentage; ?></b>/100</span>
                                                    <div class="progress progress-sm">
                                                        <?php if (
                                                            $record->percentage < 100
                                                        ) { ?>
                                                            <div class="progress-bar bg-primary" style="width: <?php echo $record->percentage; ?>%"></div>
                                                        <?php } else { ?>
                                                            <div class="progress-bar bg-success" style="width: <?php echo $record->percentage; ?>%"></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <!-- /.progress-group -->
                                            </td>

                                            <td><?php if (
                                                    $record->status_id == 'STL-2'
                                                ) { ?><a class="badge badge-pill badge-warning float">
                                                        <?= $record->list_status ?></a>
                                                <?php } elseif (
                                                    $record->status_id == 'STL-4'
                                                ) { ?><a class="badge badge-pill badge-success float">
                                                        <?= $record->list_status ?></a><?php } else { ?>
                                                    <a class="badge badge-pill badge-danger float">
                                                        <?= $record->list_status ?></a><?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <a id="btnSelect" class="btn btn-xs btn-primary" href="<?php echo base_url() .
                                                                                                            'DetailCard/' .
                                                                                                            $record->project_id .
                                                                                                            '/' .
                                                                                                            $record->card_id; ?>"><i class="fa fa-pen"></i></a>
                                                <?php if (
                                                    $member_type == 'MT-1' ||
                                                    $member_id == 'System' ||
                                                    $member_id ==
                                                    $record->creation_user_id
                                                ) {
                                                    if (
                                                        $status_id == 'STW-1' &&
                                                        $record->status_id == 'STL-2'
                                                    ) { ?>
                                                        <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?php echo base_url() .
                                                                                                                                'DeleteCard/' .
                                                                                                                                $record->card_id .
                                                                                                                                '/' .
                                                                                                                                $record->project_id; ?>"><i class="fa fa-trash"></i></a>
                                                <?php }
                                                } ?>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->


                </div>
            </div>
            <!-- Batas High -->
            <!-- Medium -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Medium</h4>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tblCardMedium" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Priority</th>
                                    <th>Card ID</th>
                                    <th>Card Name</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>Due Date</th>
                                    <th>Last Updated</th>
                                    <th>Percentage</th>
                                    <th>Status Project</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($CardMediumRecord)) {
                                    foreach ($CardMediumRecord as $record) { ?>
                                        <tr>
                                            <td><a class="badge badge-pill badge-warning float">
                                                    <?= $record->priority_type ?></a></td>
                                            <td><?php echo $record->card_id; ?></td>
                                            <td><?php echo $record->card_name; ?></td>
                                            <td><?php echo $record->description; ?></td>
                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->start_date)
                                                ); ?></td>
                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->due_date)
                                                ); ?></td>
                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->last_update)
                                                ); ?></td>
                                            <td>
                                                <div class="progress-group">
                                                    <span class="float-center"><b><?php echo $record->percentage; ?></b>/100</span>
                                                    <div class="progress progress-sm">
                                                        <?php if (
                                                            $record->percentage < 100
                                                        ) { ?>
                                                            <div class="progress-bar bg-primary" style="width: <?php echo $record->percentage; ?>%"></div>
                                                        <?php } else { ?>
                                                            <div class="progress-bar bg-success" style="width: <?php echo $record->percentage; ?>%"></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <!-- /.progress-group -->
                                            </td>

                                            <td><?php if (
                                                    $record->status_id == 'STL-2'
                                                ) { ?><a class="badge badge-pill badge-warning float">
                                                        <?= $record->list_status ?></a>
                                                <?php } elseif (
                                                    $record->status_id == 'STL-4'
                                                ) { ?><a class="badge badge-pill badge-success float">
                                                        <?= $record->list_status ?></a><?php } else { ?>
                                                    <a class="badge badge-pill badge-danger float">
                                                        <?= $record->list_status ?></a><?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <a id="btnSelect" class="btn btn-xs btn-primary" href="<?php echo base_url() .
                                                                                                            'DetailCard/' .
                                                                                                            $record->project_id .
                                                                                                            '/' .
                                                                                                            $record->card_id; ?>"><i class="fa fa-pen"></i></a>
                                                <?php if (
                                                    $member_type == 'MT-1' ||
                                                    $member_id == 'System' ||
                                                    $member_id ==
                                                    $record->creation_user_id
                                                ) {
                                                    if (
                                                        $status_id == 'STW-1' &&
                                                        $record->status_id == 'STL-2'
                                                    ) { ?>
                                                        <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?php echo base_url() .
                                                                                                                                'DeleteCard/' .
                                                                                                                                $record->card_id .
                                                                                                                                '/' .
                                                                                                                                $record->project_id; ?>"><i class="fa fa-trash"></i></a>
                                                <?php }
                                                } ?>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->


                </div>
            </div>
            <!-- Batas Medium -->
            <!-- Low -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Low</h4>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tblCardLow" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Priority</th>
                                    <th>Card ID</th>
                                    <th>Card Name</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>Due Date</th>
                                    <th>Last Updated</th>
                                    <th>Percentage</th>
                                    <th>Status Project</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($CardLowRecord)) {
                                    foreach ($CardLowRecord as $record) { ?>
                                        <tr>
                                            <td><a class="badge badge-pill badge-primary float">
                                                    <?= $record->priority_type ?></a></td>
                                            <td><?php echo $record->card_id; ?></td>
                                            <td><?php echo $record->card_name; ?></td>
                                            <td><?php echo $record->description; ?></td>
                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->start_date)
                                                ); ?></td>
                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->due_date)
                                                ); ?></td>
                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->last_update)
                                                ); ?></td>
                                            <td>
                                                <div class="progress-group">
                                                    <span class="float-center"><b><?php echo $record->percentage; ?></b>/100</span>
                                                    <div class="progress progress-sm">
                                                        <?php if (
                                                            $record->percentage < 100
                                                        ) { ?>
                                                            <div class="progress-bar bg-primary" style="width: <?php echo $record->percentage; ?>%"></div>
                                                        <?php } else { ?>
                                                            <div class="progress-bar bg-success" style="width: <?php echo $record->percentage; ?>%"></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <!-- /.progress-group -->
                                            </td>

                                            <td><?php if (
                                                    $record->status_id == 'STL-2'
                                                ) { ?><a class="badge badge-pill badge-warning float">
                                                        <?= $record->list_status ?></a>
                                                <?php } elseif (
                                                    $record->status_id == 'STL-4'
                                                ) { ?><a class="badge badge-pill badge-success float">
                                                        <?= $record->list_status ?></a><?php } else { ?>
                                                    <a class="badge badge-pill badge-danger float">
                                                        <?= $record->list_status ?></a><?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <a id="btnSelect" class="btn btn-xs btn-primary" href="<?php echo base_url() .
                                                                                                            'DetailCard/' .
                                                                                                            $record->project_id .
                                                                                                            '/' .
                                                                                                            $record->card_id; ?>"><i class="fa fa-pen"></i></a>
                                                <?php if (
                                                    $member_type == 'MT-1' ||
                                                    $member_id == 'System' ||
                                                    $member_id ==
                                                    $record->creation_user_id
                                                ) {
                                                    if (
                                                        $status_id == 'STW-1' &&
                                                        $record->status_id == 'STL-2'
                                                    ) { ?>
                                                        <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?php echo base_url() .
                                                                                                                                'DeleteCard/' .
                                                                                                                                $record->card_id .
                                                                                                                                '/' .
                                                                                                                                $record->project_id; ?>"><i class="fa fa-trash"></i></a>
                                                <?php }
                                                } ?>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->


                </div>
            </div>
            <!-- Batas Low -->
        </div>


    </section>
</div>

<!--#Region Modal Insert-->
<div class="modal fade" id="modal-input-project-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Project Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>InsertProjectMember" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <!-- //ubah -->
                            <label>Member</label>
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search..." onkeypress="searchFunction()">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>

                                <select class="form-control" name="member_id" data-width="100%" id="memberSelect" style="display: none;">
                                    <option value="">-- Select an option --</option>
                                    <?php foreach ($MemberRecords as $row) : ?>
                                        <option value="<?php echo $row->member_id; ?>">
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
                                    <option value="<?php echo $row->member_id; ?>"><?php echo $row->company_name . ' - ' . $row->member_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select> -->
                            <br>
                            <label>Member Type</label>
                            <select class="form-control select2bs4" name="member_type_id" data-width=100%>
                                <?php foreach ($MemberTypeRecords as $row) : ?>
                                    <option value="<?php echo $row->variable_id; ?>"><?php echo $row->variable_name; ?>
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

<!--#Region Modal update-->
<div class="modal fade" id="modal-project-member-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Project Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>UpdateProjectMember" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <input type="hidden" class="form-control" id="project_member_id" placeholder="Project Member ID" name="project_member_id" maxlength="11" required readonly="true">


                            <input type="hidden" class="form-control" id="project_idd" placeholder="Project ID" name="project_id" maxlength="20" required readonly="true">

                            <label>Member</label>
                            <select class="form-control select2bs4" id="member_id" name="member_id" data-width=100%>
                                <?php foreach ($MemberRecords as $row) : ?>
                                    <option value="<?php echo $row->member_id; ?>"><?php echo $row->member_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <label>Member Type</label>
                            <select class="form-control select2bs4" id="member_type_id" name="member_type_id" data-width=100%>
                                <?php foreach ($MemberTypeRecords as $row) : ?>
                                    <option value="<?php echo $row->variable_id; ?>"><?php echo $row->variable_name; ?>
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
<!--#EndRegion Modal update-->

<!--#Region Modal Insert Card-->
<div class="modal fade" id="modal-input-card">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Card</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>InsertCard" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <label for="card_name">Card Name*</label>
                            <input class="form-control" id="" placeholder="Card Name" name="card_name" maxlength="50" required>
                            <br>
                            <label for="start_date">Start Date*</label>
                            <div class="input-group date" id="startDateInsert" data-target-input="nearest">
                                <input type="text" id="start_date" placeholder="Start Date" name="start_date" class="form-control datetimepicker-input" data-target="#startDateInsert" />
                                <div class="input-group-append" data-target="#startDateInsert" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <br>
                            <label for="due_date">Due Date*</label>
                            <div class="input-group date" id="dueDateInsert" data-target-input="nearest">
                                <input type="text" id="due_date" placeholder="End Date" name="due_date" class="form-control datetimepicker-input" data-target="#dueDateInsert" />
                                <div class="input-group-append" data-target="#dueDateInsert" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <br>
                            <label>Priority</label>
                            <select class="form-control select2bs4" id="" name="priority_type_id" data-width=100%>
                                <?php foreach ($PriorityTypeRecords as $row) : ?>
                                    <option value="<?php echo $row->variable_id; ?>"><?php echo $row->priority_type; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <label for="description">Description*</label>
                            <textarea class="form-control" id="" placeholder="Description" name="description" maxlength="1000" rows="5" required></textarea>
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
<!--#EndRegion Modal Insert Card-->

<!--#Region Modal Change-->
<div class="modal fade" id="modal-change-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Status Project</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>ChangeStatusProjectProject" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <label>Project Status</label>
                            <select class="form-control select2bs4" name="status_id" id="status_id" data-width=100%>
                                <?php foreach ($StatusProjectRecords
                                    as $row) {
                                    $selected =
                                        $row->variable_id == $status_id
                                        ? 'selected'
                                        : ''; ?>
                                    <option value="<?= $row->variable_id ?>" <?= $selected ?> class="">
                                        <?= $row->project_status ?></option>
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


<script>
    $('#startDateInsert').datetimepicker({
        format: 'yyyy-MM-DD'

    });

    $('#dueDateInsert').datetimepicker({
        format: 'yyyy-MM-DD'

    });

    if ($("#member_type").val() == "MT-1" || $("#member_id_role").val() == "System") {
        document.getElementById("project_name").enabled = true;
        document.getElementById("project_type").enabled = true;
        document.getElementById("description").enabled = true;

        if (`<?php echo $status_id; ?>` == "STW-2") {
            document.getElementById("project_name").disabled = true;
            document.getElementById("project_type").disabled = true;
            document.getElementById("description").disabled = true;
        }


    } else {
        document.getElementById("project_name").disabled = true;
        document.getElementById("project_type").disabled = true;
        document.getElementById("description").disabled = true;
    }

    $(document).on("click", "#btnSelectMemberProject", function() {
        var project_member_id = $(this).data("project_member_id");
        var project_id = $(this).data("project_id");
        var member_id = $(this).data("member_id");
        var member_type_id = $(this).data("member_type_id");
        //------------------------------------------
        $("#project_member_id").val(project_member_id);
        $("#project_idd").val(project_id);
        $("#member_id").val(member_id).trigger('change');
        $("#member_type_id").val(member_type_id).trigger('change');
    });



    $("#tblProjectMember")
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
        .appendTo("#tblProjectMember_wrapper .col-md-6:eq(0)");

    $("#tblCardHeight")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],

        })
        .buttons()
        .container()
        .appendTo("#tblCardHeight_wrapper .col-md-6:eq(0)");

    $("#tblCardMedium")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],

        })
        .buttons()
        .container()
        .appendTo("#tblCardMedium_wrapper .col-md-6:eq(0)");

    $("#tblCardLow")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],

        })
        .buttons()
        .container()
        .appendTo("#tblCardLow_wrapper .col-md-6:eq(0)");

    //Function Update Member    
    $("#btn-update").click(function() {
        var project_id = $("#project_id").val();
        var project_name = $("#project_name").val();
        var project_type = $("#project_type").val();
        var description = $("#description").val();
        $.ajax({
            url: '<?php echo base_url(); ?>UpdateProject',
            data: {
                project_id: project_id,
                project_name: project_name,
                project_type: project_type,
                description: description,
            },
            type: "post",
            async: true,
            dataType: 'json',
            cache: false,
            success: function(response) {
                if (response != null) {
                    window.location.href = "<?php echo base_url() .
                                                'DetailProject/' .
                                                '' .
                                                $project_id; ?> "
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


    // Function Seacrh
    function searchFunction() {
        var input, filter, select, options, i;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        select = document.getElementById("memberSelect");
        options = select.getElementsByTagName("option");
        var results = [];

        if (filter.trim() !== "") {
            select.style.display = "";
        } else {
            select.style.display = "none";
        }

        for (i = 0; i < options.length; i++) {
            var optionText = options[i].innerHTML.toUpperCase();
            if (optionText.indexOf(filter) > -1) {
                options[i].style.display = "";
                results.push(options[i]);
            } else {
                options[i].style.display = "none";
            }
        }

        if (results.length === 1) {
            var fullName = results[0].innerHTML.trim();
            var lastName = fullName.split(" - ")[1];
            select.value = results[0].value;
            input.value = lastName;
            select.style.display = "none";
        }
    }

    document.getElementById("searchInput").addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            var select = document.getElementById("memberSelect");
            var options = select.getElementsByTagName("option");
            var filteredOptions = Array.prototype.filter.call(options, function(option) {
                return option.style.display !== "none";
            });
            if (filteredOptions.length === 1) {
                var fullName = filteredOptions[0].innerHTML.trim();
                var lastName = fullName.split(" - ")[1];
                select.value = filteredOptions[0].value;
                this.value = lastName;
                select.style.display = "none";
            }
        }
    });

    document.getElementById("memberSelect").addEventListener("change", function() {
        var selectedOption = this.options[this.selectedIndex];
        var fullName = selectedOption.innerHTML.trim();
        var lastName = fullName.split(" - ")[1];
        var input = document.getElementById("searchInput");
        input.value = lastName;
        this.style.display = "none";
    });

    document.addEventListener("DOMContentLoaded", function() {
        var select = document.getElementById("memberSelect");
        select.addEventListener("focus", function() {
            this.size = this.options.length;
        });

        select.addEventListener("blur", function() {
            this.size = 1;
        });
    });
</script>