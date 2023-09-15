<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PMT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- Calendar -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fullcalendar6/theme.css">
  <!-- <script src="<?= base_url(); ?>assets/plugins/fullcalendar/main.min.js"></script> -->
  <script src="<?= base_url(); ?>assets/plugins/fullcalendar6/dist/index.global.min.js"></script>
  <!-- dropzonejs -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->

  <!-- jQuery -->
  <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>

  <!-- Popper and Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
  </script>

  <!-- Responsivevoice -->
  <!-- Get API Key -> https://responsivevoice.org/ -->
  <script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>

  <!-- load file audio bell GID -->
  <audio id="tingtung" src="<?= base_url(); ?>assets/audio/tingtung.mp3"></audio>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="<?= base_url(); ?>assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js">
  </script>
  <!-- InputMask -->
  <script src="<?= base_url(); ?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?= base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="<?= base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
  </script>
  <!-- Bootstrap Switch -->
  <script src="<?= base_url(); ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- BS-Stepper -->
  <script src="<?= base_url(); ?>assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <!-- dropzonejs -->
  <script src="<?= base_url(); ?>assets/plugins/dropzone/min/dropzone.min.js"></script>
  <!-- AdminLTE for demo purposes -->

  <!-- Tambahan -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/summernote/summernote.min.css">
  <script src="<?= base_url() ?>assets/plugins/summernote/summernote.min.js"></script>
  <!-- Slick Slider -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item">
          <a href="<?= base_url(); ?>Home" class="nav-link">Back To Home</a>
        </li> -->
        <li class="nav-item">
          <div class="row"><strong>Selamat Datang, <?= $this->session->userdata('member_name'); ?></strong></div>
          <div class="row">Date <?= date('d M Y') ?></div>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);" id="themeBtn">
            <i class="fas fa-adjust"></i> Change
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false">
            <i class="far fa-comments"></i>
            <?php
            $memberID = $this->session->userdata('member_id');
            $messages = $this->Messages_model->Get([$memberID, 0, 0, 3]);
            $totalMessage = 0;
            if (!empty($messages)) :
              foreach ($messages as $row) {
                $totalMessage = $row->new_message;
                break;
              }
            endif;
            if ($totalMessage != null && $totalMessage != 0) {
              echo '<span class="badge badge-danger navbar-badge">' . $totalMessage . '</span>';
            }
            ?>
          </a>
          <?php
          $messagesCol = $this->Messages_model->Get([$memberID, 0, 0, 4]);
          $kataDicari = 'Darurat';
          if (!empty($messagesCol)) : ?>
            <div id="dropdownMessage" class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
              <?php
              foreach ($messagesCol as $row) :
                $potoB = $row->gender_id;
                $isiPesan = $row->message;
              ?>
                <a href="<?= base_url(); ?>Message" class="dropdown-item">
                  <div class="media">
                    <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($potoB == 'GR-001') ? '5.png' : '3.png' ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                      <h3 class="dropdown-item-title">
                        <?= $row->sender_name; ?>
                        <span class="float-right text-sm text-<?= stripos($isiPesan, $kataDicari) !== false ? 'danger' : (empty($isiPesan) ? 'muted' : 'warning'); ?>"><i class="fas fa-star"></i></span>
                      </h3>
                      <p class="text-sm"><?= $isiPesan; ?></p>
                      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i><?= $row->created_at; ?></p>
                    </div>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="javascript:void(0);" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="javascript:void(0);" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="javascript:void(0);" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="javascript:void(0);" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>Profile" aria-expanded="false">
            <i class="far fa-user"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- Navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-3">
      <!-- Brand Logo -->
      <a href="javascript:void(0);" class="brand-link">
        <img src="<?php echo base_url(); ?>assets/dist/img/logo_psd.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
        <span class="brand-text font-weight-bold">PMT</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url(); ?>assets/dist/img/avatar<?= (($this->session->userdata('gender_id')) == 'GR-001') ? '5.png' : '3.png' ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="javascript:void(0);" class="d-block"><?= $this->session->userdata('member_name'); ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php
            $url = current_url();
            $parsed_url = parse_url($url);
            $current_url =  $parsed_url['path'];

            // data main menu
            $this->db->distinct();
            $this->db->select(
              'c.menu_id, c.menu_name, c.menu_url, c.menu_icon'
            );
            $this->db->from('gm_menu_role a');
            $this->db->join('gm_role b', 'a.role_id = b.role_id', 'left');
            $this->db->join('gm_menu c', 'a.menu_id = c.menu_id', 'left');
            $this->db->where('a.role_id', $this->session->userdata('role_id'));
            $main_menu = $this->db->get();

            foreach ($main_menu->result() as $main) {
              // Query untuk mencari data sub menu
              $this->db->select(
                'c.sub_menu_id, c.sub_menu_name, c.sub_menu_url, c.sub_menu_icon'
              );
              $this->db->from('gm_menu_role a');
              $this->db->join(
                'gm_sub_menu c',
                'a.sub_menu_id = c.sub_menu_id'
              );
              $this->db->where(
                'a.role_id',
                $this->session->userdata('role_id')
              );
              $this->db->where('a.menu_id', $main->menu_id);

              $this->db->order_by('c.sub_menu_name', 'asc');
              $sub_menu = $this->db->get();

              // periksa apakah ada sub menu
              if ($sub_menu->num_rows() > 0) {
                // Tentukan apakah sub menu aktif
                $is_submenu_open = false;
                foreach ($sub_menu->result() as $sub) {
                  if ($sub->sub_menu_url == $current_url) {
                    $is_submenu_open = true;
                    break;
                  }
                }
            ?>
                <!-- main menu dengan sub menu -->
                <li class="nav-item <?= $is_submenu_open ? 'menu-open' : ''; ?>">
                  <a class="nav-link" href="<?= $main->menu_url; ?>">
                    <i class="<?= $main->menu_icon; ?>"></i>
                    <p>
                      <?= $main->menu_name; ?>
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <!-- sub menu nya disini -->
                  <ul class="nav nav-treeview">
                    <?php foreach ($sub_menu->result() as $sub) { ?>
                      <li class="nav-item">
                        <a class="nav-link <?= ($sub->sub_menu_url == $current_url) ? 'active' : ''; ?>" href="<?= $sub->sub_menu_url; ?>">
                          <i class="<?= $sub->sub_menu_icon; ?>"></i>
                          <p><?= $sub->sub_menu_name; ?></p>
                        </a>
                      </li>
                    <?php } ?>
                  </ul>
                </li>
              <?php
              } else {
                // main menu tanpa sub menu
              ?>
                <li class="nav-item">
                  <a class="nav-link <?= ($main->menu_url == $current_url) ? 'active' : ''; ?>" href="<?= $main->menu_url; ?>">
                    <i class="<?= $main->menu_icon; ?>"></i>
                    <p><?= $main->menu_name; ?>
                      <?php
                      $memberID = $this->session->userdata('member_id');
                      $messages = $this->Messages_model->Get([$memberID, 0, 0, 3]);
                      $totalMessage = 0;

                      if (!empty($messages)) :
                        foreach ($messages as $row) {
                          $totalMessage = $row->new_message;
                          break;
                        }
                      endif;

                      if ($main->menu_name == 'Message' && $totalMessage != null && $totalMessage != 0) {
                        echo '<span class="badge badge-info right">' . $totalMessage . '</span>';
                      }
                      ?>
                    </p>
                  </a>
                </li>
            <?php
              }
            }
            ?>
          </ul>
        </nav>

        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>