<div class="content-wrapper">
    <div style="height: 20px;"></div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-sm card-default">
                        <div class="card-header">
                            <div class="row ">
                                <div class="col-sm-6">
                                    <h2>All Project</h2>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-xs-12 text-right">
                                        <button type="button" class="btn btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-input-project">
                                            <i class="fa fa-plus"></i> Add Project
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tblProject" class="table table-bordered table-striped small">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Project Name</th>
                                        <th>Team Member</th>
                                        <th>Project Progress</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($ProjectRecords)) {
                                        $no = 1;
                                        foreach ($ProjectRecords as $record) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td>
                                                    <div><?= $record->project_name; ?></div>
                                                    <div><?php $tgl = new DateTime($record->creation_datetime);
                                                            $showTgl = $tgl->format('Y-m-d');
                                                            echo $showTgl ?>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <?php foreach ($ProjectMemberRecords as $row) {
                                                        if ($record->project_id == $row->project_id) : ?>
                                                            <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($row->gender_id == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 30px; height: 30px;">
                                                    <?php endif;
                                                    }; ?>
                                                </td>
                                                <td>
                                                    <div class="progress-group">
                                                        <div class="progress progress-sm">
                                                            <?php if ($record->percentage_avg < 100) { ?>
                                                                <div class="progress-bar bg-primary" style="width: <?= $record->percentage_avg; ?>%"></div>
                                                            <?php } else { ?>
                                                                <div class="progress-bar bg-success" style="width: <?= $record->percentage_avg; ?>%"></div>
                                                            <?php } ?>
                                                        </div>
                                                        <span class="float-center"><b><?= $record->percentage_avg; ?>% Complete</b></span>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a class="badge <?= ($record->status_id == 'STW-1') ? 'badge-warning' : 'badge-success'; ?> float"><?= $record->name_project_status ?></a>
                                                </td>
                                                <td class="text-left">
                                                    <a id="btnSelect" class="btn btn-xs btn-primary" href="<?= base_url() . 'DetailProject/' . $record->project_id; ?>"><i class="fa fa-pen"></i></a>
                                                    <?php if ($member_id == 'System' || $record->member_type_id == 'MT-1') {
                                                        if ($record->status_id == 'STW-1') { ?>
                                                            <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?= base_url() . 'DeleteProject/' . $record->project_id; ?>"><i class="fa fa-trash"></i></a>
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
                    <!-- /.card -->
                </div>
            </div>
            <form style="display: none;" action="<?= base_url(); ?>InsertProject" method="post">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="card-title"><strong>General</strong></div>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="project_name">Project Name</label>
                                        <input class="form-control" id="project_name" placeholder="Project Name" name="project_name" maxlength="50" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Project Description</label>
                                        <textarea class="form-control" id="description" placeholder="Description" name="description" maxlength="1000" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Project Status</label>
                                        <select class="form-control select2bs4" name="status_id" id="status_id" data-width=100%>
                                            <option value="" disabled selected>Choose Status</option>
                                            <?php foreach ($StatusProjectRecords as $row) : ?>
                                                <option value="<?= $row->variable_id ?>"><?= $row->project_status ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="project_type">Project Type</label>
                                        <select class="form-control select2bs4" id="project_type" name="project_type" style="width: 100%;">
                                            <option value="" disabled selected>Choose Type</option>
                                            <?php foreach ($ProjectTypeRecords as $row) : ?>
                                                <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Project Leader</label>
                                        <select class="form-control select2bs4" name="project_leader" id="project_leader" data-width=100%>
                                            <option value="" disabled selected>Choose Leader</option>
                                            <?php foreach ($tempmember as $row) { ?>
                                                <option value="<?= $row->member_id ?>"><?= $row->member_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <div class="card-title"><strong>Budget</strong></div>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="budget_estimated">Estimated Budget</label>
                                        <input class="form-control" id="budget_estimated" placeholder="Estimated Budget" name="budget_estimated" maxlength="50" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="budget_spend">Total Amount Spend</label>
                                        <input class="form-control" id="budget_spend" placeholder="Total Amount Spend" name="budget_spend" maxlength="50" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="project_estimated">Estimated Project Duration</label>
                                        <input class="form-control" id="project_estimated" placeholder="Estimated Project Duration" name="project_estimated" maxlength="50" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="reset" class="btn btn-secondary" value="Cancel" />
                    <input type="submit" id="btnSubmit" class="btn btn-success" value="Create New Project" />
                </div>
            </form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!--#Region Modal Insert-->
    <div class="modal fade" id="modal-input-project">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="<?= base_url(); ?>InsertProject" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="project_name">Project Name*</label>
                                <input class="form-control" id="" placeholder="Project Name" name="project_name" maxlength="50" required>
                                <br>
                                <label>Project Type</label>
                                <select class="form-control select2bs4" id="" name="project_type" data-width=100%>
                                    <?php foreach ($ProjectTypeRecords
                                        as $row) : ?>
                                        <option value="<?= $row->variable_id; ?>"><?= $row->variable_name; ?>
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
    <!--#EndRegion Modal Insert-->

    <div class="modal fade" id="modal-project-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="<?= base_url(); ?>UpdateProject" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="project_id">Project ID*</label>
                                <input class="form-control" id="project_id" placeholder="Project ID" name="project_id" maxlength="20" required readonly="true">
                                <br>
                                <label for="project_name">Project Name*</label>
                                <input class="form-control" id="project_name" placeholder="Project Name" name="project_name" maxlength="50" required>
                                <br>
                                <label for="project_type">Project Type*</label>
                                <input class="form-control" id="project_type" placeholder="Project Type" name="project_type" maxlength="50" required>
                                <br>

                                <label for="description">Description*</label>
                                <textarea class="form-control" id="description" placeholder="Description" name="description" maxlength="1000" required></textarea>
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

</div>


<script>
    // $(document).on("click", "#btnSelect", function () {
    //     var project_id = $(this).data("data_1");
    //     var project_name = $(this).data("data_2");
    //     var project_type = $(this).data("data_3");
    //     var description = $(this).data("data_4");
    //     //------------------------------------------
    //     $("#project_id").val(project_id);
    //     $("#project_name").val(project_name);
    //     $("#project_type").val(project_type);
    //     $("#description").val(description);
    //     //$("#voucher_category_id").val(voucher_category_id).trigger('change');
    // });

    $("#tblProject")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            order: [
                [0, "asc"]
            ]
        })
        .buttons()
        .container()
        .appendTo("#tblProject_wrapper .col-md-6:eq(0)");
</script>