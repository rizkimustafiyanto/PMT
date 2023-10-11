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
                                    <h4>Management Member</h4>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-xs-12 text-right">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-member-manage">
                                            <i class="fa fa-plus"></i> Add Management Member
                                        </button>
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
                                    <?php if (!empty($ManageRecord)) {
                                        $no = 1;
                                        foreach ($ManageRecord as $record) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $record->member_name; ?></td>
                                                <td><?= $record->akses_name; ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-xs btn-primary" id="btnSelect" data-toggle="modal" data-target="#modal-member-manage-update" data-adman="<?= $record->management_member_id ?>" data-akses="<?= $record->akses ?>"><i class="fa fa-pen"></i></a>
                                                    <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?= base_url() . 'DeleteManage/' . $record->management_member_id; ?>"><i class="fa fa-trash"></i></a>
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

    <div class="modal fade" id="modal-member-manage">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Member Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="<?= base_url(); ?>InsertManage" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="member_id">Member</label>
                                <select class="form-control select2bs4" id="member_id" name="member_id">
                                    <?php foreach ($MemberSelect as $row) : ?>
                                        <option value="<?= $row->member_id; ?>"><?= $row->member_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                                <label for="access">Access</label>
                                <select class="form-control select2bs4" id="access" name="access">
                                    <option value="0">No Access</option>
                                    <option value="1">Access</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" id="btnSubmit" class="btn btn-primary" value="Submit" />
                        <input type="reset" class="btn btn-default" value="Reset" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-member-manage-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Member Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="<?= base_url(); ?>UpdateManage" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" id="management_id_update" name="management_id_update">
                                <label for="access_update">Access</label>
                                <select class="form-control select2bs4" id="access_update" name="access_update">
                                    <option value="0">No Access</option>
                                    <option value="1">Access</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" id="btnSubmit" class="btn btn-primary" value="Submit" />
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

    $(document).on("click", "#btnSelect", function() {
        var management_id = $(this).data("adman");
        var aksesmanagement = $(this).data("akses");
        $("#management_id_update").val(management_id);
        $("#access_update").val(aksesmanagement);
    });
</script>