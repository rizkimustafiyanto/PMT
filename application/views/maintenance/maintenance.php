<div class="content-wrapper">
    <div style="height: 20px;"></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-sm card-default">
                        <div class="card-header">
                            <div class="row ">
                                <div class="col-sm-6">
                                    <h4>Maintenance</h4>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-xs-12 text-right">
                                        <a class="btn btn-sm btn-danger" id="btnBack" href="<?= base_url() . 'MaintenanceView'; ?>">
                                            <i class="fa fa-lg fa-door"></i> Activing
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-maintenance-active">
                                            <i class="fa fa-power"></i> Maintenance
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="managedMember" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Akses</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($MaintenanceRecords)) {
                                        $no = 1;
                                        foreach ($MaintenanceRecords as $record) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $record->reason; ?></td>
                                                <td><?= $record->status_down; ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-xs btn-primary" id="btnSelect" data-toggle="modal" data-target="#modal-downtime-update" data-adman="<?= $record->id_downtime ?>" data-reason="<?= $record->reason ?>"><i class="fa fa-pen"></i></a>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-maintenance-active">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Reason</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="reason_maintenance">Reason</label>
                                <input class="form-control" type="text" id="reason_maintenance" placeholder="Your Reason....">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" id="btnSubmitMaintenance" class="btn btn-primary" value="Submit" />
                        <input type="reset" class="btn btn-default" value="Reset" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-downtime-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" id="maintenance_id" name="maintenance_id">
                                <label for="access_update">Reason</label>
                                <input type="text" class="form-control" id="reason_maintenance_update">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" id="btnSubmitUpdate" class="btn btn-primary" value="Submit" />
                        <input type="reset" class="btn btn-default" value="Reset" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script>
    $("#managedMember")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            ordering: true

        })
        .buttons()
        .container()
        .appendTo("#managedMember_wrapper .col-md-6:eq(0)");

    $(document).on('click', '#btnSubmitMaintenance', function() {
        var reasonable = $('#reason_maintenance').val();

        $.ajax({
            url: '<?= base_url(); ?>insertDowntime',
            type: 'POST',
            data: {
                reason: reasonable
            },
            success: function(response) {
                $('#modal-maintenance-active').modal('hide');
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
                        window.location.reload();
                    }
                });
            }
        })
    })

    $(document).on("click", "#btnSelect", function() {
        var maintenance_id = $(this).data("adman");
        var resonMaintenance = $(this).data("reason");
        $("#maintenance_id").val(maintenance_id);
        $("#reason_maintenance_update").val(resonMaintenance);
    });

    $(document).on('click', '#btnSubmitUpdate', function() {
        var maintenanceID = $('#maintenance_id').val();
        var reasonMain = $('#reason_maintenance_update').val();

        $.ajax({
            url: '<?= base_url(); ?>updateDowntime',
            type: 'POST',
            data: {
                downtime_id: maintenanceID,
                reason: reasonMain,
                flag: 0
            },
            success: function(response) {
                $('#modal-downtime-update').modal('hide');
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
                        window.location.reload();
                    }
                });
            }
        })
    })
</script>