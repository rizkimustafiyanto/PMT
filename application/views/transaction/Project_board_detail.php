<?php
$board_id = '';
$project_id = '';
$board_name = '';
$description = '';
$record_status = '';
$name_record_status = '';
$start_date = '';
$finish_date = '';

if (!empty($ProjectBoardRecords)) {
    foreach ($ProjectBoardRecords as $record) {
        $board_id = $record->board_id;
        $project_id = $record->project_id;
        $board_name = $record->board_name;
        $description = $record->description;
        $record_status = $record->record_status;
        $name_record_status = $record->name_record_status;
        $status_id = $record->status_id;
        $status_project_name = $record->status_project_name;
        $start_date = $record->start_date;
        $finish_date = $record->finish_date;
    }
}

$member_type = '';

if (!empty($UserMemberRoleProject)) {
    foreach ($UserMemberRoleProject as $recordMemberRoleProject) {
        $member_type = $recordMemberRoleProject->member_type;
    }
}

$temp_card_id = '';
?>
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
                        <h2>Detail Board Project</h2>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-xs-12 text-right">
                            <a class="btn btn-danger" id="btnBack" href="<?php echo base_url() .
                                                                                'DetailProject/' .
                                                                                $project_id; ?>">
                                <i class="fa fa-lg fa-reply"></i>
                            </a>
                            <?php if (
                                $member_type == 'MT-1' ||
                                $member_id == 'System'
                            ) {
                                if ($status_id == 'STB-1') { ?>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!--Menentukan Type User WorkSpace-->
                            <input type="hidden" class="form-control" id="member_type" placeholder="member_type" name="member_type" maxlength="20" readonly="true" value="<?php echo $member_type; ?>" required>
                            <input type="hidden" class="form-control" id="member_id_role" placeholder="member_id" name="member_id" maxlength="20" readonly="true" value="<?php echo $member_id; ?>" required>
                            <!--Menentukan Type User WorkSpace-->
                            <input type="hidden" class="form-control" id="board_id" placeholder="Board ID" name="board_id" maxlength="11" readonly="true" value="<?php echo $board_id; ?>" required>
                            <input type="hidden" class="form-control" id="project_id" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <div class="col-md-3">
                                <label>Project Status</label>
                                <div class="input-group date">
                                    <input class="form-control" id="" placeholder="Project Status" name="" maxlength="20" value="<?php echo $status_project_name; ?>" required readonly="true">
                                    <?php if (
                                        $member_type == 'MT-1' ||
                                        $member_id == 'System'
                                    ) {
                                        if ($status_id == 'STB-1') { ?>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" id="btn_change" data-toggle="modal" data-target="#modal-change-status"><i class="fa fa-exchange-alt" aria-hidden="true"></i> Change</button>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <label for="board_name">Board Name*</label>
                                <input class="form-control" id="board_name" placeholder="Board Name" name="board_name" maxlength="50" value="<?php echo $board_name; ?>" required>
                                <br>
                            </div>
                            <div class="col-md-3">
                                <label for="start_date_update">Start Date*</label>
                                <div class="input-group date" id="startDateUpdate" data-target-input="nearest">
                                    <input type="text" id="start_date_update" placeholder="Start Date" name="start_date_update" class="form-control datetimepicker-input" data-target="#startDateUpdate" value="<?php echo date(
                                                                                                                                                                                                                    'Y-m-d',
                                                                                                                                                                                                                    strtotime($start_date)
                                                                                                                                                                                                                ); ?>" />
                                    <div class="input-group-append" data-target="#startDateUpdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-3">
                                <label for="finish_date_update">Finish Date*</label>
                                <div class="input-group date" id="finishDateUpdate" data-target-input="nearest">
                                    <input type="text" id="finish_date_update" placeholder="End Date" name="finish_date_update" class="form-control datetimepicker-input" data-target="#finishDateUpdate" value="<?php echo date(
                                                                                                                                                                                                                        'Y-m-d',
                                                                                                                                                                                                                        strtotime($finish_date)
                                                                                                                                                                                                                    ); ?>" />
                                    <div class="input-group-append" data-target="#finishDateUpdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" placeholder="Description" name="description" maxlength="1000"><?php echo $description; ?></textarea>
                                <br>
                            </div>
                            <div class="col-md-3">
                                <label>Status</label>
                                <select class="form-control select2bs4" id="status" name="status" data-width=100%>
                                    <?php foreach ($StatusRecords as $row) {
                                        $selected =
                                            $row->variable_id == $record_status
                                            ? 'selected'
                                            : ''; ?>
                                        <option value="<?= $row->variable_id ?>" <?= $selected ?> class="">
                                            <?= $row->name_record_status ?></option>
                                    <?php
                                    } ?>
                                </select>
                                <br>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="card-title">
                            <h4>Project Card List</h4>
                        </div>
                        <div class="col-xs-12 text-right">
                            <?php if (
                                $member_type == 'MT-1' ||
                                $member_id == 'System'
                            ) {
                                if ($status_id == 'STW-1') { ?>
                                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-board">
                                        <i class="fa fa-plus"></i> Add Project Board
                                    </button>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tblCardList" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Card Name</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($CardRecord)) {
                                    foreach ($CardRecord as $record) { ?>
                                        <tr>
                                            <td><?php echo $record->card_id; ?></td>
                                            <td><?php echo $record->card_name; ?></td>
                                        </tr>
                                <?php }
                                } ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->


                </div>
            </div>



        </div>
    </section>
</div>



<!--#Region Modal Insert-->
<div class="modal fade" id="modal-input-board-list">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Board Item List </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>InsertBoardItemList" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <label>List Name</label>
                            <select class="form-control select2bs4" name="list_name" data-width=100%>
                                <?php foreach ($ListRecords as $row) : ?>
                                    <option value="<?php echo $row->variable_id; ?>"><?php echo $row->list_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <input type="hidden" class="form-control" id="" placeholder="Board ID" name="board_id" maxlength="11" value="<?php echo $board_id; ?>" required readonly="true">
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
                            <input type="hidden" class="form-control" id="" placeholder="Board ID" name="board_id" maxlength="11" value="<?php echo $board_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="list_id" placeholder="List ID" name="list_id" maxlength="11" required readonly="true">

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

<!--#Region Modal Update-->
<div class="modal fade" id="modal-update-board-list">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Board Item List </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>UpdateItemList" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">


                            <input type="hidden" class="form-control" id="list_id_update" placeholder="List ID" name="list_id" maxlength="11" readonly="true" required>




                            <input type="hidden" class="form-control" id="board_id_update" placeholder="Board ID" name="board_id" maxlength="11" required readonly="true">



                            <label for="list_name">List Name*</label>
                            <input class="form-control" id="list_name_update" placeholder="List Name" name="list_name" maxlength="50" required>
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
<!--#EndRegion Modal Update-->

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
            <form role="form" action="<?php echo base_url(); ?>ChangeStatusProjectProjectBoard" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="Board ID" name="board_id" maxlength="11" value="<?php echo $board_id; ?>" required readonly="true">
                            <label>Project Status</label>
                            <select class="form-control select2bs4" name="status_id" id="status_id" data-width=100%>
                                <?php foreach ($StatusBoardRecords as $row) {
                                    $selected =
                                        $row->variable_id == $status_id
                                        ? 'selected'
                                        : ''; ?>
                                    <option value="<?= $row->variable_id ?>" <?= $selected ?> class="">
                                        <?= $row->board_status ?></option>
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
    $('#startDateUpdate').datetimepicker({
        format: 'yyyy-MM-DD'

    });

    $('#finishDateUpdate').datetimepicker({
        format: 'yyyy-MM-DD'

    });

    if ($("#member_type").val() == "MT-1" || $("#member_id_role").val() == "System") {
        document.getElementById("board_name").enabled = true;
        document.getElementById("description").enabled = true;
        document.getElementById("status").enabled = true;

        if (`<?php echo $status_id; ?>` == "STB-2") {
            document.getElementById("board_name").disabled = true;
            document.getElementById("description").disabled = true;
            document.getElementById("status").disabled = true;
        }


    } else {
        document.getElementById("board_name").disabled = true;
        document.getElementById("description").disabled = true;
        document.getElementById("status").disabled = true;
    }

    $('#startDateInsert').datetimepicker({
        format: 'yyyy-MM-DD'

    });

    $('#dueDateInsert').datetimepicker({
        format: 'yyyy-MM-DD'

    });



    $(document).on("click", "#btnSelectAdd", function() {
        //dealer
        var list_id = $(this).data("list_id");

        $("#list_id").val(list_id);
        //$("#status_update").val(status).trigger("change");;
        // $('#modal-booking-service-update').modal('show');

    });

    $(document).on("click", "#btnSelectItemList", function() {
        var list_id = $(this).data("list_id");
        var board_id = $(this).data("board_id");
        var list_name = $(this).data("list_name");

        //------------------------------------------
        $("#list_id_update").val(list_id);
        $("#board_id_update").val(board_id);
        $("#list_name_update").val(list_name).trigger('change');

    });

    $("#tblCardList")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            order: [
                [0, "desc"]
            ]

        })
        .buttons()
        .container()
        .appendTo("#tblCardList_wrapper .col-md-6:eq(0)");


    //Function Update Member    
    $("#btn-update").click(function() {
        var board_id = $("#board_id").val();
        var project_id = $("#project_id").val();
        var board_name = $("#board_name").val();
        var description = $("#description").val();
        var status = $("#status").val();
        var start_date_update = $("#start_date_update").val();
        var finish_date_update = $("#finish_date_update").val();

        $.ajax({
            url: '<?php echo base_url(); ?>UpdateBoardProject',
            data: {
                board_id: board_id,
                project_id: project_id,
                board_name: board_name,
                description: description,
                status: status,
                start_date_update: start_date_update,
                finish_date_update: finish_date_update,
            },
            type: "post",
            async: true,
            dataType: 'json',
            cache: false,
            success: function(response) {
                if (response != null) {
                    window.location.href = "<?php echo base_url() .
                                                'DetailBoardProject/' .
                                                '' .
                                                $project_id .
                                                '/' .
                                                $board_id; ?> "
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
</script>