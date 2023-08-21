<?php
$project_id = '';
$board_id = '';
$list_id = '';
$card_id = '';
$card_checklist_id = '';
$checklist_name = '';
$percentage = '';
$record_status = '';
$name_record_status = '';
$list_type_id = '';

if (!empty($CardChecklistRecord)) {
    foreach ($CardChecklistRecord as $record) {
        $project_id = $record->project_id;
        $board_id = $record->board_id;
        $list_id = $record->list_id;
        $card_id = $record->card_id;
        $card_checklist_id = $record->card_checklist_id;
        $checklist_name = $record->checklist_name;
        $percentage = $record->percentage;
        $record_status = $record->record_status;
        $name_record_status = $record->name_record_status;
        $list_type_id = $record->list_type_id;
    }
}

$member_type = '';

if (!empty($UserMemberRoleProject)) {
    foreach ($UserMemberRoleProject as $recordMemberRoleProject) {
        $member_type = $recordMemberRoleProject->member_type;
    }
}
?>

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
                        <h4>Detail Checklist</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-xs-12 text-right">
                            <a class="btn btn-danger" id="btnBack" href="<?php echo base_url() .
                                                                                'DetailCard/' .
                                                                                $project_id .
                                                                                '/' .
                                                                                $board_id .
                                                                                '/' .
                                                                                $list_id .
                                                                                '/' .
                                                                                $card_id; ?>">
                                <i class="fa fa-lg fa-reply"></i>
                            </a>
                            <?php if (
                                $member_type == 'MT-1' ||
                                $member_id == 'System'
                            ) {
                                if (
                                    $list_type_id == 'STL-1' ||
                                    $list_type_id == 'STL-2'
                                ) { ?>
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
                            <!--Menentukan Type User Card-->
                            <input type="hidden" class="form-control" id="member_type" placeholder="member_type" name="member_type" maxlength="20" readonly="true" value="<?php echo $member_type; ?>" required>
                            <input type="hidden" class="form-control" id="member_id_role" placeholder="member_id" name="member_id" maxlength="20" readonly="true" value="<?php echo $member_id; ?>" required>
                            <input type="hidden" class="form-control" id="list_type_id" placeholder="list_type_id" name="list_type_id" maxlength="20" readonly="true" value="<?php echo $list_type_id; ?>" required>
                            <!--Menentukan Type User card-->
                            <input type="hidden" class="form-control" id="card_checklist_id" placeholder="Card Checklist ID" name="card_checklist_id" maxlength="11" readonly="true" value="<?php echo $card_checklist_id; ?>" required>
                            <input type="hidden" class="form-control" id="card_id" placeholder="Card ID" name="card_id" maxlength="11" value="<?php echo $card_id; ?>" required readonly="true">

                            <input type="hidden" class="form-control" id="percentage" placeholder="Percentage" name="percentage" maxlength="50" value="<?php echo $percentage; ?>" required readonly="true">
                            <div class="col-lg-6">
                                <label for="checklist_name">Checklist Name*</label>
                                <input class="form-control" id="checklist_name" placeholder="Checklist Name" name="checklist_name" maxlength="50" value="<?php echo $checklist_name; ?>" required>
                            </div>

                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong><?php echo $checklist_name; ?></strong>
                            </p>
                            <div class="progress-group">
                                <span class="float-right"><b><?php echo $percentage; ?></b>/100</span>
                                <div class="progress progress-sm">
                                    <?php if ($record->percentage < 100) { ?>
                                        <div class="progress-bar bg-primary" style="width: <?php echo $record->percentage; ?>%"></div>
                                    <?php } else { ?>
                                        <div class="progress-bar bg-success" style="width: <?php echo $record->percentage; ?>%"></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- /.progress-group -->

                        </div>
                    </div>
                    <div class="card-header">
                        <div class="col-md-12">
                            <h4>Checklist Item List</h4>
                        </div>
                        <div class="col-md-12 text-left">
                            <?php if (
                                $member_type == 'MT-1' ||
                                $member_id == 'System'
                            ) {
                                if (
                                    $list_type_id == 'STL-1' ||
                                    $list_type_id == 'STL-2'
                                ) { ?>
                                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-checklist-item">
                                        <i class="fa fa-plus"></i> Add
                                    </button>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="card-body">

                        <table id="tblChecklistItemList" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <?php if ($list_type_id == 'STL-2') { ?>
                                        <th style="width: 50px;">Ceklis</th>
                                    <?php } ?>
                                    <th>Checklist Item Name</th>
                                    <th>Member</th>
                                    <th>Start Date</th>
                                    <th>Due Date</th>

                                    <th class="text-center">Status</th>
                                    <?php if (
                                        $member_type == 'MT-1' ||
                                        $member_id == 'System'
                                    ) {
                                        if (
                                            $list_type_id == 'STL-1' ||
                                            $list_type_id == 'STL-2'
                                        ) { ?>
                                            <th class="text-center">Action</th>
                                    <?php }
                                    } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($ChecklistItemRecord)) {
                                    foreach ($ChecklistItemRecord
                                        as $record) { ?>
                                        <tr>
                                            <?php if ($list_type_id == 'STL-2') { ?>
                                                <td class="text-center">
                                                    <?php if (
                                                        $member_type == 'MT-1' ||
                                                        $member_id == 'System' ||
                                                        $record->member_id == $member_id
                                                    ) {
                                                        if ($list_type_id == 'STL-2') { ?>
                                                            <input type="checkbox" name="my-checkbox" id="CheckedList" style="cursor:pointer" data-data_1="<?= $record->checklist_item_id ?>" data-data_2="<?= $record->card_checklist_id ?>" <?php if (
                                                                                                                                                                                                                                                    $record->flag_status == 100
                                                                                                                                                                                                                                                ) {
                                                                                                                                                                                                                                                    $statuscheck = 'checked';
                                                                                                                                                                                                                                                    $tamp_status = 'unchecked';
                                                                                                                                                                                                                                                    echo $statuscheck;
                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                    $statuscheck = 'unchecked';
                                                                                                                                                                                                                                                    $tamp_status = 'checked';
                                                                                                                                                                                                                                                    echo $statuscheck;
                                                                                                                                                                                                                                                } ?> data-data_3="<?= $tamp_status ?>"><?php }
                                                                                                                                                                                                                                                                                } ?>
                                                </td>
                                            <?php } ?>
                                            <td><?php echo $record->checklist_item_name; ?></td>
                                            <td><?php echo $record->member_name; ?></td>
                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->start_date)
                                                ); ?></td>
                                            <td><?php echo date(
                                                    'Y-m-d',
                                                    strtotime($record->due_date)
                                                ); ?></td>
                                            <td class="text-center">
                                                <?php if (
                                                    $record->flag_status == 100
                                                ) { ?>
                                                    <a class="badge badge-pill badge-success float">
                                                        <?= 'Done' ?></a>
                                                <?php } else { ?>
                                                    <a class="badge badge-pill badge-primary float">
                                                        <?= 'On Process' ?></a><?php } ?>
                                            </td>
                                            <?php if (
                                                $member_type == 'MT-1' ||
                                                $member_id == 'System'
                                            ) {
                                                if (
                                                    $list_type_id == 'STL-1' ||
                                                    $list_type_id == 'STL-2'
                                                ) { ?>
                                                    <td class="text-center">
                                                        <a id="btnSelect" class="btn btn-xs btn-primary" data-data_1="<?= $record->checklist_item_id ?>" data-data_2="<?= $record->card_checklist_id ?>" data-data_3="<?= $record->checklist_item_name ?>" data-data_4="<?= $record->flag_status ?>" data-data_5="<?= $record->member_id ?>" data-data_6="<?= date(
                                                                                                                                                                                                                                                                                                                                                                'Y-m-d',
                                                                                                                                                                                                                                                                                                                                                                strtotime($record->start_date)
                                                                                                                                                                                                                                                                                                                                                            ) ?>" data-data_7="<?= date(
                                                                                                                                                                                                                                                                                                                                                                                    'Y-m-d',
                                                                                                                                                                                                                                                                                                                                                                                    strtotime($record->due_date)
                                                                                                                                                                                                                                                                                                                                                                                ) ?>" data-toggle="modal" data-target="#modal-update-checklist-item"><i class="fa fa-pen"></i></a>
                                                        <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?php echo base_url() .
                                                                                                                                'DeleteChecklistItem/' .
                                                                                                                                $record->project_id .
                                                                                                                                '/' .
                                                                                                                                $record->board_id .
                                                                                                                                '/' .
                                                                                                                                $record->list_id .
                                                                                                                                '/' .
                                                                                                                                $record->card_id .
                                                                                                                                '/' .
                                                                                                                                $record->card_checklist_id .
                                                                                                                                '/' .
                                                                                                                                $record->checklist_item_id; ?>"><i class="fa fa-trash"></i></a>
                                                    </td>
                                            <?php }
                                            } ?>
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
<div class="modal fade" id="modal-input-checklist-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Checklist Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>InsertChecklistItem" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="Board ID" name="board_id" maxlength="11" value="<?php echo $board_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="List ID" name="list_id" maxlength="11" value="<?php echo $list_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="Card ID" name="card_id" maxlength="11" value="<?php echo $card_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="Card Checklist ID" name="card_checklist_id" maxlength="11" value="<?php echo $card_checklist_id; ?>" required readonly="true">

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
                            <label for="start_date">Start Date*</label>
                            <div class="input-group date" id="startDateInsert" data-target-input="nearest">
                                <input type="text" id="" placeholder="Start Date" name="start_date" class="form-control datetimepicker-input" data-target="#startDateInsert" />
                                <div class="input-group-append" data-target="#startDateInsert" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <br>
                            <label for="due_date">Due Date*</label>
                            <div class="input-group date" id="dueDateInsert" data-target-input="nearest">
                                <input type="text" id="" placeholder="End Date" name="due_date" class="form-control datetimepicker-input" data-target="#dueDateInsert" />
                                <div class="input-group-append" data-target="#dueDateInsert" data-toggle="datetimepicker">
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
                <h4 class="modal-title">Edit Checklist Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>UpdateChecklistItem" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <input type="hidden" class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="Board ID" name="board_id" maxlength="11" value="<?php echo $board_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="List ID" name="list_id" maxlength="11" value="<?php echo $list_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="" placeholder="Card ID" name="card_id" maxlength="11" value="<?php echo $card_id; ?>" required readonly="true">
                            <input type="hidden" class="form-control" id="card_checklist_id_update" placeholder="Card Checklist ID" name="card_checklist_id" readonly="true" maxlength="11" required>
                            <input type="hidden" class="form-control" id="checklist_item_id" placeholder="Checklist Item ID" name="checklist_item_id" readonly="true" maxlength="11" required>


                            <label for="checklist_item_name">Checklist Item Name</label>
                            <input class="form-control" id="checklist_item_name" placeholder="Checklist Item Name" name="checklist_item_name" maxlength="100" required>
                            <br>
                            <label>Member</label>
                            <select class="form-control select2bs4" id="member_id" name="member_id" data-width=100%>
                                <?php foreach ($CardMemberRecord as $row) : ?>
                                    <option value="<?php echo $row->member_id; ?>"><?php echo $row->member_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <label for="start_date">Start Date*</label>
                            <div class="input-group date" id="startDateUpdate" data-target-input="nearest">
                                <input type="text" id="start_date" placeholder="Start Date" name="start_date" class="form-control datetimepicker-input" data-target="#startDateUpdate" />
                                <div class="input-group-append" data-target="#startDateUpdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <br>
                            <label for="due_date">Due Date*</label>
                            <div class="input-group date" id="dueDateUpdate" data-target-input="nearest">
                                <input type="text" id="due_date" placeholder="End Date" name="due_date" class="form-control datetimepicker-input" data-target="#dueDateUpdate" />
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
    // $(document).ready(function () {

    //});
    if ($("#member_type").val() == "MT-1" || $("#member_id_role").val() == "System") {
        if ($("#list_type_id").val() == "STL-5" || $("#list_type_id").val() == "STL-4" || $("#list_type_id").val() ==
            "STL-3") {
            document.getElementById("checklist_name").disabled = true;
        } else {
            document.getElementById("checklist_name").enabled = true;
        }

    } else {
        document.getElementById("checklist_name").disabled = true;
    }


    $("#tblChecklistItemList")
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
        .appendTo("#tblChecklistItemList_wrapper .col-md-6:eq(0)");

    $('#startDateInsert').datetimepicker({
        format: 'yyyy-MM-DD'
    });

    $('#dueDateInsert').datetimepicker({
        format: 'yyyy-MM-DD'
    });

    $('#startDateUpdate').datetimepicker({
        format: 'yyyy-MM-DD'
    });

    $('#dueDateUpdate').datetimepicker({
        format: 'yyyy-MM-DD'
    });

    $("#btn-update").click(function() {
        var card_checklist_id = $("#card_checklist_id").val();
        var card_id = $("#card_id").val();
        var checklist_name = $("#checklist_name").val();
        var percentage = $("#percentage").val();

        $.ajax({
            url: '<?php echo base_url(); ?>UpdateCardChecklist',
            data: {
                card_checklist_id: card_checklist_id,
                card_id: card_id,
                checklist_name: checklist_name,
                percentage: percentage,
            },
            type: "post",
            async: true,
            dataType: 'json',
            cache: false,
            success: function(response) {
                if (response != null) {
                    window.location.href = "<?php echo base_url() .
                                                'DetailChecklistItem/' .
                                                '' .
                                                $project_id .
                                                '/' .
                                                $board_id .
                                                '/' .
                                                $list_id .
                                                '/' .
                                                $card_id .
                                                '/' .
                                                $card_checklist_id; ?> "
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

    $(document).on("click", "#btnSelect", function() {

        //card_checklist_id_update

        //checklist_item_name
        var checklist_item_id = $(this).data("data_1");
        var card_checklist_id = $(this).data("data_2");
        var checklist_item_name = $(this).data("data_3");
        var member_id = $(this).data("data_5");
        var start_date = $(this).data("data_6");
        var due_date = $(this).data("data_7");

        $("#checklist_item_id").val(checklist_item_id);
        $("#card_checklist_id_update").val(card_checklist_id);
        $("#checklist_item_name").val(checklist_item_name);
        $("#member_id").val(member_id).trigger('change');
        $("#start_date").val(start_date);
        $("#due_date").val(due_date);



    });



    $(document).on("click", "#CheckedList", function() {


        var checklist_item_id = $(this).data("data_1");
        var card_checklist_id = $(this).data("data_2");
        var status = $(this).data("data_3");

        $.ajax({
            url: '<?php echo base_url(); ?>UpdateChecklistItemChecked',
            data: {
                checklist_item_id: checklist_item_id,
                card_checklist_id: card_checklist_id,
                status: status,
            },
            type: "post",
            async: true,
            dataType: 'json',
            cache: false,
            success: function(response) {
                if (response != null) {
                    window.location.href = "<?php echo base_url() .
                                                'DetailChecklistItem/' .
                                                '' .
                                                $project_id .
                                                '/' .
                                                $board_id .
                                                '/' .
                                                $list_id .
                                                '/' .
                                                $card_id .
                                                '/' .
                                                $card_checklist_id; ?> "
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


    // $("input[data-bootstrap-switch]").each(function(){
    //   $(this).bootstrapSwitch('state', $(this).prop('checked'));


    // });
</script>