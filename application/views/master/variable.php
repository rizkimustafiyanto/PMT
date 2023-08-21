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
                  <h4>Variable</h4>
                </div>
                <div class="col-sm-6">
                  <div class="col-xs-12 text-right">
                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-variable">
                      <i class="fa fa-plus"></i> Add Variable
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
                    <th>Variable ID</th>
                    <th>Variable Name</th>
                    <th>Variable Type</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($VariableRecords)) {
                      foreach ($VariableRecords as $record) { ?>
                      <tr>
                        <td><?php echo $record->variable_id; ?></td>
                        <td><?php echo $record->variable_name; ?></td>
                        <td><?php echo $record->variable_type; ?></td>
                        <td class="text-center">

                          <a id="btnSelect" class="btn btn-xs btn-primary" data-variablename="<?= $record->variable_name ?>" data-variabletype="<?= $record->variable_type ?>" data-variableid="<?= $record->variable_id ?>" data-toggle="modal" data-target="#modal-variable-update"><i class="fa fa-pen"></i></a>

                          <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?php echo base_url() .
                              'DeleteVariable/' .
                              $record->variable_id; ?>"><i class="fa fa-trash"></i></a>
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

  <div class="modal fade" id="modal-variable">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Variable</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" action="<?php echo base_url(); ?>InsertVariable" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <label for="variableid">Variable ID</label>
                <input class="form-control" id="variable_id" placeholder="Variable Id" name="variable_id" maxlength="50" required>
                <br>
                <label for="variablename">Variable Name</label>
                <input class="form-control" id="variable_name" placeholder="Variable Name" name="variable_name" maxlength="50" required>
                <br>
                <label for="variabletype">Variable Type</label>
                <input class="form-control" id="variable_type" placeholder="Variable Type" name="variable_type" maxlength="50" required>
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


  <div class="modal fade" id="modal-variable-update">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Variable</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" action="<?php echo base_url(); ?>UpdateVariable" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <label for="variableid">Variable Id</label>
                <input class="form-control" id="variable_id_update" placeholder="Variable Id" name="variable_id_update" readonly="true" required>
                <br>
                <label for="variablename">Variable Name</label>
                <input class="form-control" id="variable_name_update" placeholder="Variable Name" name="variable_name_update" maxlength="50" required>
                <br>
                <label for="variabletype">Variable Type</label>
                <input class="form-control" id="variable_type_update" placeholder="Variable Type" name="variable_type_update" maxlength="50" required>
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


    //Variable
    var variable_name = $(this).data("variablename");
    var variable_type = $(this).data("variabletype");
    var variable_id = $(this).data("variableid");
    $("#variable_name_update").val(variable_name);
    $("#variable_type_update").val(variable_type);
    $("#variable_id_update").val(variable_id);


  });
  $(document).on("click", "#btnAdd", function() {

    // Variable
    $("#variable_name").val("");
    $("#variable_type").val("");
    $("#variable_id").val("");

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