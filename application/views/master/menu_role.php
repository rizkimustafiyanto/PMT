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
                  <h4>Menu Role</h4>
                </div>
                <div class="col-sm-6">
                  <div class="col-xs-12 text-right">
                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd" data-toggle="modal" data-target="#modal-menu-role">
                      <i class="fa fa-plus"></i> Add Menu Role
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
                    <th>Menu</th>
                    <th>Sub Menu</th>
                    <th>Role</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($MenuRoleRecords)) {
                      foreach ($MenuRoleRecords as $record) { ?>
                      <tr>
                        <td><?php echo $record->menu_role_id; ?></td>
                        <td><?php echo $record->menu_name; ?></td>
                        <td><?php echo $record->sub_menu_name; ?></td>
                        <td><?php echo $record->role_name; ?></td>
                        <td class="text-center">


                          <a id="btnDelete" class="btn btn-xs btn-danger tombol-hapus" href="<?php echo base_url() .
                              'DeleteMenuRole/' .
                              $record->menu_role_id; ?>"><i class="fa fa-trash"></i></a>
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

  <div class="modal fade" id="modal-menu-role">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Menu Role</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" action="<?php echo base_url(); ?>InsertMenuRole" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <label for="rolename">Role</label>
                <select class="form-control select2bs4" id="role_id" name="role_id">
                  <?php foreach ($RoleRecords as $row): ?>
                    <option value="<?php echo $row->role_id; ?>"><?php echo $row->role_name; ?></option>
                  <?php endforeach; ?>
                </select>
                <br>
                <label for="menuname">Menu</label>
                <select class="form-control select2bs4" id="menu_id" name="menu_id">
                  <?php foreach ($MenuRecords as $row): ?>
                    <option value="<?php echo $row->menu_id; ?>"><?php echo $row->menu_name; ?></option>
                  <?php endforeach; ?>
                </select>
                <div id="divSubMenu">
                  <br>
                  <label for="submenuname">Sub Menu</label>
                  <select class="form-control select2bs4" id="sub_menu_id" name="sub_menu_id">
                    <option value="">-- Select --</option>
                  </select>
                </div>
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




</div>

<script>
  $("#divSubMenu").hide();



  // Selected Change Dropdown
  $("#menu_id").change(function() {
    var id = $("#menu_id").val();
    $.ajax({
      url: "GetSubMenuByMenuId",
      data: {
        menu_id: id
      },
      type: "post",
      async: true,
      dataType: 'json',
      cache: false,
      success: function(response) {
        var html = '';
        var is = '';
        if (response != null) {
          for (is = 0; is < response.length; is++) {
            html += '<option value=' + response[is].sub_menu_id + '>' + response[is].sub_menu_name + '</option>';
          }

          $("#divSubMenu").show();
        } else {
          html += '<option value=""></option>';
          $("#divSubMenu").hide();

        }
        //alert(data[0].sub_menu_id);

        $('#sub_menu_id').html(html);
      }

    })
  });


  $(document).on("click", "#btnAdd", function() {
    // Counter
    $("#menu_name").val("");
    $("#menu_url").val("");
    $("#menu_icon").val("");

  });
</script>