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
                  <h4>Member Role</h4>
                </div>
                <div class="col-sm-6">
                  <div class="col-xs-12 text-right">
                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-member-role">
                      <i class="fa fa-plus"></i> Add Member Role
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
              <table id="tblMemberRole" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID Member</th>
                    <th>Member Name</th>
                    <th>Role Name</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($tempmember_role)) {
                    foreach ($tempmember_role as $record) { ?>
                      <tr>
                        <td><?php echo $record->member_id; ?></td>
                        <td><?php echo $record->member_name; ?></td>
                        <td><?php echo $record->role_name; ?></td>
                        <?php if ($record->record_status == 'A') { ?>
                          <td class="text-center"><a class="badge badge-pill badge-success float"> <?= $record->name_record_status ?></a></td>
                        <?php } else { ?>
                          <td class="text-center"><a class="badge badge-pill badge-danger float"> <?= $record->name_record_status ?></a></td>
                        <?php } ?>
                        <td class="text-center">
                          <a id="btnSelect" class="btn btn-xs btn-primary" data-data_1="<?= $record->member_role_id ?>" data-data_2="<?= $record->member_id ?>" data-data_3="<?= $record->record_status ?>" data-data_4="<?= $record->change_no ?>" data-data_5="<?= $record->creation_user_id ?>" data-data_6="<?= $record->creation_datetime ?>" data-data_7="<?= $record->change_user_id ?>" data-data_8="<?= $record->change_datetime ?>" data-data_9="<?= $record->member_name ?>" data-data_10="<?= $record->role_id ?>" data-data_11="<?= $record->role_name ?>" data-toggle="modal" data-target="#modal-member-role-update"><i class="fa fa-pen"></i></a>
                          <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?php echo base_url() .
                                                                                                'DeleteMemberRole/' .
                                                                                                $record->member_role_id; ?>"><i class="fa fa-trash"></i></a>

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
  <!-- /.content -->

  <!--#Region Modal Insert-->
  <div class="modal fade" id="modal-member-role">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Member Role</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" action="<?php echo base_url(); ?>InsertMemberRole" method="post">


          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">

                <!--Region Member Id -->
                <label>Member name</label>
                <select class="form-control select2bs4" name="p_member_id">
                  <?php foreach ($tempmember as $row) : ?>
                    <option value="<?php echo $row->member_id; ?>"><?php echo $row->member_name; ?></option>
                  <?php endforeach; ?>
                </select>
                <br>
                <!--EndRegion Member Id -->

                <!--Region role id -->
                <label>Role Name</label>
                <select class="form-control select2bs4" name="p_role_id">
                  <?php foreach ($temprole as $row) : ?>
                    <option value="<?php echo $row->role_id; ?>"><?php echo $row->role_name; ?></option>
                  <?php endforeach; ?>
                </select>
                <br>
                <!--EndRegion role id -->
              </div>
            </div>
          </div>

          <div class="modal-footer justify-content-between">
            <input type="submit" id="btnSubmit" class="btn btn-primary" value="Submit" />
            <input type="reset" class="btn btn-default" value="Reset" />
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--#EndRegion Modal Insert-->

  <!--#Region Modal Update-->
  <div class="modal fade" id="modal-member-role-update">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Member</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" action="<?php echo base_url(); ?>UpdateMemberRole" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">

                <!--Region member role id -->
                <input type="hidden" id="vmember_role_id" placeholder="Member Role Id" name="p_member_role_id" maxlength="11" required>
                <br>
                <!--EndRegion member role id -->

                <!--Region member id -->
                <label>Member Name</label>
                <select class="form-control select2bs4" name="p_member_id" id="vmember_id">
                  <?php foreach ($tempmember as $row) : ?>
                    <option value="<?php echo $row->member_id; ?>"><?php echo $row->member_name; ?></option>
                  <?php endforeach; ?>
                </select>
                <br>
                <!--EndRegion member id -->

                <!--Region role id -->
                <label>Role Name</label>
                <select class="form-control select2bs4" name="p_role_id" id="vrole_id">
                  <?php foreach ($temprole as $row) : ?>
                    <option value="<?php echo $row->role_id; ?>"><?php echo $row->role_name; ?></option>
                  <?php endforeach; ?>
                </select>
                <br>
                <!--EndRegion role id -->

                <!--Region record status -->
                <label>status</label>
                <select class="form-control select2bs4" name="p_record_status" id="vrecord_status">
                  <option value="A">Active</option>
                  <option value="D">Deactive</option>
                </select>
                <br>
                <!--EndRegion record status -->

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
  $("#tblMemberRole")
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
    .appendTo("#tblMemberRole_wrapper .col-md-6:eq(0)");

  $(document).on("click", "#btnSelect", function() {
    var vmember_role_id = $(this).data("data_1");
    var vmember_id = $(this).data("data_2");
    var vrole_id = $(this).data("data_10");
    var vrecord_status = $(this).data("data_3");
    //------------------------------------------
    $("#vmember_role_id").val(vmember_role_id);
    $("#vmember_id").val(vmember_id).trigger('change');
    $("#vrole_id").val(vrole_id).trigger('change');
    $("#vrecord_status").val(vrecord_status).trigger('change');

  });
</script>