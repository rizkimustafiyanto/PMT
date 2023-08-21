<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    .dropdown-menu li {
        position: relative;
    }

    .dropdown-menu .dropdown-submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: -7px;
    }

    .dropdown-menu .dropdown-submenu-left {
        right: 100%;
        left: auto;
    }

    .dropdown-menu>li:hover>.dropdown-submenu {
        display: block;
    }
</style>
<script>
    tinymce.init({
        selector: '.editor',
        menubar: false,
        statusbar: false,
        plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
        toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
        skin: 'bootstrap',
        toolbar_drawer: 'floating',
        min_height: 200,
        autoresize_bottom_margin: 16,
        setup: (editor) => {
            editor.on('init', () => {
                editor.getContainer().style.transition = "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
            });
            editor.on('focus', () => {
                editor.getContainer().style.boxShadow = "0 0 0 .2rem rgba(0, 123, 255, .25)",
                    editor.getContainer().style.borderColor = "#80bdff"
            });
            editor.on('blur', () => {
                editor.getContainer().style.boxShadow = "",
                    editor.getContainer().style.borderColor = ""
            });
        }
    });
</script>
<!-- Dropdown Toggle -->
<script src="<?php echo base_url(); ?>assets/dist/js/addition/js.js"></script>
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
        <div class="card card-sm card-default">
            <div class="card-header">
                <div class="row ">
                    <div class="col-sm-6">
                        <h2>Detail Project</h2>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-xs-12 text-right">
                            <a class="btn btn-danger" id="btnBack" href="#" onclick="history.go(-1); return false;">
                                <i class="fa fa-lg fa-reply"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row">
                        <?php if (!empty($CardStatus)) { ?>
                            <div class="col-lg-3">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <div class="card-title">Stuck</div>
                                        </div>
                                        <div class="card-tools">
                                            <a class="btn btn-tool" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body sortable" data-status="STL-3">
                                        <?php foreach ($CardStatus as $row) : if (($row->status_id) == 'STL-3') : ?>
                                                <div class="card card-primary card-outline " style="cursor: move;" data-id="<?= $row->card_id ?>">
                                                    <div class="card-header">
                                                        <h5 class="card-title"><?= $row->card_name ?></h5>
                                                        <div class="card-tools">
                                                            <a class="btn btn-tool" href="<?php echo base_url() . 'DetailCard/' . $row->project_id . '/' . $row->card_id; ?>"><i class="fa fa-pen"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>
                                                            <?= $row->description ?>
                                                        </p>
                                                    </div>
                                                </div>
                                        <?php endif;
                                        endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <div class="card-title">To Do</div>
                                        </div>
                                        <div class="card-tools">
                                            <a class="btn btn-tool" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body sortable" data-status="STL-1">
                                        <?php foreach ($CardStatus as $row) : if (($row->status_id) == 'STL-1') :
                                        ?>
                                                <div class="card card-primary card-outline " style="cursor: move;" data-id="<?= $row->card_id ?>">
                                                    <div class="card-header">
                                                        <h5 class="card-title"><?= $row->card_name ?></h5>
                                                        <div class="card-tools">
                                                            <a class="btn btn-tool" href="<?php echo base_url() . 'DetailCard/' . $row->project_id . '/' . $row->card_id; ?>"><i class="fa fa-pen"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>
                                                            <?= $row->description ?>
                                                        </p>
                                                    </div>
                                                </div>
                                        <?php endif;
                                        endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <div class="card-title">In Progress</div>
                                        </div>
                                        <div class="card-tools">
                                            <a class="btn btn-tool" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body sortable" data-status="STL-2">
                                        <?php foreach ($CardStatus as $row) : if (($row->status_id) == 'STL-2') :
                                        ?>
                                                <div class="card card-primary card-outline " style="cursor: move;" data-id="<?= $row->card_id ?>">
                                                    <div class="card-header">
                                                        <h5 class="card-title"><?= $row->card_name ?></h5>
                                                        <div class="card-tools">
                                                            <a class="btn btn-tool" href="<?php echo base_url() . 'DetailCard/' . $row->project_id . '/' . $row->card_id; ?>"><i class="fa fa-pen"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>
                                                            <?= $row->description ?>
                                                        </p>
                                                    </div>
                                                </div>
                                        <?php endif;
                                        endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <div class="card-title">Done</div>
                                        </div>
                                        <div class="card-tools">
                                            <a class="btn btn-tool" data-toggle="modal" data-target="#modal-input-detail"><i class="fa fa-plus"></i></a>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body sortable" data-status="STL-4">
                                        <?php foreach ($CardStatus as $row) : if (($row->status_id) == 'STL-4') :
                                        ?>
                                                <div class="card card-primary card-outline " style="cursor: move;" data-id="<?= $row->card_id ?>">
                                                    <div class="card-header">
                                                        <h5 class="card-title"><?= $row->card_name ?></h5>
                                                        <div class="card-tools">
                                                            <a class="btn btn-tool" href="<?php echo base_url() . 'DetailCard/' . $row->project_id . '/' . $row->card_id; ?>"><i class="fa fa-pen"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>
                                                            <?= $row->description ?>
                                                        </p>
                                                    </div>
                                                </div>
                                        <?php endif;
                                        endforeach; ?>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-input-detail">
    <div class="modal-dialog" style="max-width: 920px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Project</h4>
            </div>
            <form role="form" action="<?php echo base_url(); ?>InsertProjectMember" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-info card-outline" style="max-height: 300px;">
                                <div class="card-header">
                                    <h5 class="card-title" style="width: 90%;"><input type="text" id="project_name" class="form-control" placeholder="Project Name"></h5>
                                    <div class="card-tools">
                                        <a class="btn btn-tool" href=""><i class="fa fa-pen"></i></a>
                                    </div>
                                </div>
                                <textarea class="editor" name="content"></textarea>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Komentar</h5>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="direct-chat-messages" id="comment-container" style="display: none;">
                                    </div>
                                    <div class="empty-message-container d-flex align-items-center justify-content-center">
                                        <p id="empty-comment" class="text-center">Komentar Kosong</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <form id="send-comment-form">
                                        <input type="hidden" id="current-member-id" value="<?= $this->session->userdata('member_id') ?>">
                                        <div class="input-group">
                                            <input type="text" id="comment-input" class="form-control" placeholder="Type your comment...">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="CheckingPriority">Priority Project</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">Low</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">High</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-inline">
                                <label for="AssignMember" class="mr-2">Assign Member</label>
                                <select class="form-control select2bs4" name="member_id" data-width="73%" id="memberSelect" style="display: none;">
                                    <option value="" selected disabled>-- Select an option --</option>
                                    <?php foreach ($MemberRecords as $row) : ?>
                                        <option value="<?php echo $row->member_id; ?>">
                                            <?php
                                            $companyName = '';
                                            if ($row->company_name == "PT Persada Lampung Raya") {
                                                $companyName = 'PLR';
                                            } else if ($row->company_name == "PT Persada Palembang Raya") {
                                                $companyName = 'PPR';
                                            } else if ($row->company_name == "PT Gita Riau Makmur") {
                                                $companyName = 'GRM';
                                            } // Add more cases as needed
                                            echo $companyName . ' - ' . $row->member_name;
                                            ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top: 5px;">
                                <?php $potoBox = '5.png' ?>
                                <img src="<?= base_url(); ?>assets/dist/img/avatar<?= $potoBox ?>" class="mr-3 img-circle" alt="User Avatar" style="width: 50px; height: 50px;">
                            </div>
                            <div class="form-inline">
                                <label for="dateproject" class="mr-2">Date Project</label>
                                <input type="date" class="form-control">
                                <div style="margin-left: 10px;"></div>
                                <label for="dateproject" class="mr-2">To</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <input type="submit" id="btnSubmit" class="btn btn-primary" value="Simpan Project">
                    </div>
                </div>

            </form>

        </div>
    </div>

    <!-- Batas Insert Project Card -->
</div>

<script>
    $(document).ready(function() {
        // bawaan adminLTE sortable
        $(".sortable").sortable({
            connectWith: ".sortable",
            update: function(event, ui) {
                var cardId = ui.item.data("id");
                var newStatus = ui.item.closest(".sortable").data("status");

                $.ajax({
                    url: '<?php echo base_url(); ?>updateCardStatus',
                    type: "POST",
                    data: {
                        card_id: cardId,
                        new_status: newStatus
                    },
                    success: function(response) {
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Success',
                        //     text: 'Status Berhasil Diubah',
                        //     toast: true,
                        //     position: 'center',
                        //     showConfirmButton: false,
                        //     timer: 3000,
                        //     timerProgressBar: true,
                        //     didOpen: toast => {
                        //         toast.addEventListener('mouseenter', Swal.stopTimer)
                        //         toast.addEventListener('mouseleave', Swal.resumeTimer)
                        //     }
                        // });
                        console.log("Status card berhasil diperbarui");
                    },
                    error: function(xhr, status, error) {
                        console.log("Terjadi kesalahan saat memperbarui status card");
                        alert(xhr.responseText);
                    }
                });
            }
        });
    });
</script>