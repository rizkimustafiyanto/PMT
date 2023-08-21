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
                  <h4>Menu</h4>
                </div>
                <div class="col-sm-6">
                  <div class="col-xs-12 text-right">
                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-menu">
                      <i class="fa fa-plus"></i> Add Menu
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
                    <th>Menu Name</th>
                    <th>Menu Url</th>
                    <th>Menu Icon</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($MenuRecords)) {
                      foreach ($MenuRecords as $record) { ?>
                      <tr>
                        <td><?php echo $record->menu_id; ?></td>
                        <td><?php echo $record->menu_name; ?></td>
                        <td><?php echo $record->menu_url; ?></td>
                        <td><?php echo $record->menu_icon; ?></td>
                        <td class="text-center">

                          <a id="btnSelect" class="btn btn-xs btn-primary" data-menuname="<?= $record->menu_name ?>" data-menuurl="<?= $record->menu_url ?>" data-menuid="<?= $record->menu_id ?>" data-menuicon="<?= $record->menu_icon ?>" data-toggle="modal" data-target="#modal-menu-update"><i class="fa fa-pen"></i></a>

                          <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?php echo base_url() .
                              'DeleteMenu/' .
                              $record->menu_id; ?>"><i class="fa fa-trash"></i></a>
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

  <div class="modal fade" id="modal-menu">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Menu</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" action="<?php echo base_url(); ?>InsertMenu" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <label for="countername">Menu Name</label>
                <input class="form-control" id="menu_name" placeholder="Menu Name" name="menu_name" maxlength="50" required>
                <br>
                <label for="counterformatno">Menu Url</label>
                <input class="form-control" id="menu_url" placeholder="Menu Url" name="menu_url" maxlength="50">
                <br>
                <label for="counterformatno">Menu Icon</label>
                <input class="form-control" id="menu_icon" placeholder="Menu Icon" name="menu_icon" maxlength="50" required>
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


  <div class="modal fade" id="modal-menu-update">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Menu</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" action="<?php echo base_url(); ?>UpdateMenu" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <input type="hidden" value="" name="menu_id_update" id="menu_id_update" />
                <label for="countername">Menu Name</label>
                <input class="form-control" id="menu_name_update" placeholder="Menu Name" name="menu_name_update" maxlength="50" required>
                <br>
                <label for="counterformatno">Menu Url</label>
                <input class="form-control" id="menu_url_update" placeholder="Menu Url" name="menu_url_update">
                <br>
                <label for="counterformatno">Menu Icon</label>
                <input class="form-control" id="menu_icon_update" placeholder="Menu Icon" name="menu_icon_update" maxlength="50" required>
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
    var menu_name = $(this).data("menuname");
    var menu_url = $(this).data("menuurl");
    var menu_icon = $(this).data("menuicon");
    var menu_id = $(this).data("menuid");
    $("#menu_name_update").val(menu_name);
    $("#menu_url_update").val(menu_url);
    $("#menu_icon_update").val(menu_icon);
    $("#menu_id_update").val(menu_id);
  });

  $(document).on("click", "#btnAdd", function() {
    // Counter
    $("#menu_name").val("");
    $("#menu_url").val("");
    $("#menu_icon").val("");

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