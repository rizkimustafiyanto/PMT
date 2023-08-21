<?php
$list_id = '';
$board_id = '';
$list_name = '';
$project_id = '';
$record_status = '';
$name_record_status = '';

if (!empty($BoardItemListRecord)) {
    foreach ($BoardItemListRecord as $record) {
        $list_id = $record->list_id;
        $board_id = $record->board_id;
        $list_name = $record->list_name;
        $project_id = $record->project_id;
        $record_status = $record->record_status;
        $name_record_status = $record->name_record_status;
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
                        <h4>Detail Item List</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-primary" id="btn-update">
                                Update
                            </button>
                            <a class="btn btn-danger" id="btnBack" href="<?php echo base_url() .
                                                                                'DetailBoardProject/' .
                                                                                $project_id .
                                                                                '/' .
                                                                                $board_id; ?>">
                                Back
                            </a>
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
                            <div class="col-md-4">
                                <label for="list_id">List ID</label>
                                <input class="form-control" id="list_id" placeholder="List ID" name="list_id" maxlength="11" readonly="true" value="<?php echo $list_id; ?>" required>
                                <br>
                            </div>
                            <div class="col-md-4">
                                <label for="board_id">Board ID</label>
                                <input class="form-control" id="board_id" placeholder="Board ID" name="board_id" maxlength="11" value="<?php echo $board_id; ?>" required readonly="true">
                                <br>
                            </div>
                            <div class="col-md-4">
                                <label for="list_name">List Name*</label>
                                <input class="form-control" id="list_name" placeholder="List Name" name="list_name" maxlength="50" value="<?php echo $list_name; ?>" required>
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <div class="col-md-12">
                            <h4>Card List</h4>
                        </div>
                        <div class="col-md-12 text-left">
                            <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-card">
                                <i class="fa fa-plus"></i> Add
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <table id="tblCardList" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Card ID</th>
                                    <th>List ID</th>
                                    <th>Card Name</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>Due Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($CardRecord)) {
                                    foreach ($CardRecord as $record) { ?>
                                        <tr>
                                            <td><?php echo $record->card_id; ?></td>
                                            <td><?php echo $record->list_id; ?></td>
                                            <td><?php echo $record->card_name; ?></td>
                                            <td><?php echo $record->description; ?></td>
                                            <td><?php echo $record->start_date; ?></td>
                                            <td><?php echo $record->due_date; ?></td>
                                            <td class="text-center">
                                                <?php if (
                                                    $record->record_status == 'A'
                                                ) { ?>
                                                    <a class="badge badge-pill badge-success float">
                                                        <?= $record->name_record_status ?></a>
                                                <?php } else { ?>
                                                    <a class="badge badge-pill badge-danger float">
                                                        <?= $record->name_record_status ?></a><?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <a id="btnSelect" class="btn btn-xs btn-primary" href="<?php echo base_url() .
                                                                                                            'DetailCard/' .
                                                                                                            $record->project_id .
                                                                                                            '/' .
                                                                                                            $record->board_id .
                                                                                                            '/' .
                                                                                                            $record->list_id .
                                                                                                            '/' .
                                                                                                            $record->card_id; ?>"><i class="fa fa-pen"></i></a>
                                                <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?php echo base_url() .
                                                                                                                        'DeleteCard/' .
                                                                                                                        $record->project_id .
                                                                                                                        '/' .
                                                                                                                        $record->board_id .
                                                                                                                        '/' .
                                                                                                                        $record->list_id .
                                                                                                                        '/' .
                                                                                                                        $record->card_id; ?>"><i class="fa fa-trash"></i></a>
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
        </div>
    </section>
</div>

<!--#Region Modal Insert-->
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
                            <label for="project_id">Project ID</label>
                            <input class="form-control" id="" placeholder="Project ID" name="project_id" maxlength="20" value="<?php echo $project_id; ?>" required readonly="true">
                            <br>
                            <label for="board_id">Board ID</label>
                            <input class="form-control" id="" placeholder="Board ID" name="board_id" maxlength="11" value="<?php echo $board_id; ?>" required readonly="true">
                            <br>
                            <label for="list_id">List ID</label>
                            <input class="form-control" id="" placeholder="List ID" name="list_id" maxlength="11" value="<?php echo $list_id; ?>" required readonly="true">
                            <br>
                            <label for="card_name">Card Name*</label>
                            <input class="form-control" id="" placeholder="Card Name" name="card_name" maxlength="50" required>
                            <br>
                            <label for="description">Description*</label>
                            <textarea class="form-control" id="" placeholder="Description" name="description" maxlength="1000" required></textarea>
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

<script>
    $("#tblCardList")
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
        .appendTo("#tblCardList_wrapper .col-md-6:eq(0)");

    $('#startDateInsert').datetimepicker({
        icons: {
            time: 'far fa-clock'
        }
    });

    $('#dueDateInsert').datetimepicker({
        icons: {
            time: 'far fa-clock'
        }
    });



    //Function Update Member    
    $("#btn-update").click(function() {
        var list_id = $("#list_id").val();
        var board_id = $("#board_id").val();
        var list_name = $("#list_name").val();

        $.ajax({
            url: '<?php echo base_url(); ?>UpdateItemList',
            data: {
                list_id: list_id,
                board_id: board_id,
                list_name: list_name,
            },
            type: "post",
            async: true,
            dataType: 'json',
            cache: false,
            success: function(response) {
                if (response != null) {
                    window.location.href = "<?php echo base_url() .
                                                'DetailItemList/' .
                                                '' .
                                                $project_id .
                                                '/' .
                                                $board_id .
                                                '/' .
                                                $list_id; ?> "
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