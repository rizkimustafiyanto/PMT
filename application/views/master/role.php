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
                  <h4>Role</h4>
                </div>
                <div class="col-sm-6">
                  <div class="col-xs-12 text-right">
                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-role">
                      <i class="fa fa-plus"></i> Add Role
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
              <?= $this->session->flashdata('success') ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?= $this->session->unset_userdata('success') ?>

          <?php endif; ?>

          <?php if ($this->session->flashdata('error')): ?>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Role Name</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($RoleRecords)) {
                      foreach ($RoleRecords as $record) { ?>
                      <tr>
                        <td><?php echo $record->role_id; ?></td>
                        <td><?php echo $record->role_name; ?></td>
                        <td class="text-center">

                          <a id="btnSelect" class="btn btn-xs btn-primary" data-rolename="<?= $record->role_name ?>" data-roleid="<?= $record->role_id ?>" data-toggle="modal" data-target="#modal-role-update"><i class="fa fa-pen"></i></a>

                          <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?php echo base_url() .
                              'DeleteRole/' .
                              $record->role_id; ?>"><i class="fa fa-trash"></i></a>
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <!-- Modal -->

  <div class="modal fade" id="modal-role">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Role</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" action="<?php echo base_url(); ?>InsertRole" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <label for="rolename">Role Name</label>
                <input class="form-control" id="role_name" placeholder="Role Name" name="role_name" maxlength="50" required>
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


  <div class="modal fade" id="modal-role-update">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Role</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" action="<?php echo base_url(); ?>UpdateRole" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <input type="hidden" value="" name="role_id_update" id="role_id_update" />
                <label for="rolename">Role Name</label>
                <input class="form-control" id="role_name_update" placeholder="Role Name" name="role_name_update" maxlength="50" required>
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
  $(document).on("click", "#btnSelect", function() {
    //Counter
    var role_name = $(this).data("rolename");
    var role_id = $(this).data("roleid");
    $("#role_name_update").val(role_name);
    $("#role_id_update").val(role_id);
  });

  $(document).on("click", "#btnAdd", function() {
    // Counter
    $("#role_name").val("");
  });

  //SweetAlert Hapus
  $('.tombol-hapus').on('click', function(e) {

e.preventDefault();
const href = $(this).attr('href');

Swal.fire({
  title: 'Apakah anda yakin',
  text: "akan menghapus data ini ?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Hapus Data'
}).then((result) => {
  if (result.isConfirmed) {
    document.location.href = href;
    Swal.fire(
      'Dihapus!',
      'Data berhasil dihapus',
      'success'
    )
  }
})

});
</script>