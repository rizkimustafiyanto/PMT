<?php
if (!empty($profiles)) {
    foreach ($profiles as $key) {
        $profile_foto = $key->gender_id;
        $profile_name = $key->member_name;
        $profile_divisi = $key->division_name;
        $profile_department = $key->department_name;
        $profile_email = $key->email;
    }
}

?>

<div class="content-wrapper" style="min-height: 1604.71px;">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="<?= base_url(); ?>logout" role="button">
                                            <i class="fa fa-power-off"></i> <strong>Logout</strong>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($profile_foto == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 90px; height: 90px;">
                            </div>
                            <h3 class="profile-username text-center"><?= $profile_name ?></h3>
                            <p class="text-muted text-center"><?= $profile_divisi ?></p>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>

                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Email</strong>
                            <p class="text-muted">
                                <?= $profile_email ?>
                            </p>
                            <hr>
                            <strong><i class="fas fa-building mr-1"></i> Department</strong>
                            <p class="text-muted"><?= $profile_department ?></p>
                            <!-- <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                            <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                            </p> -->
                            <!-- <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                            <p class="text-muted">Berakit-rakit ke hulu berenang-renang ke tepian. Bersakit-sakit dahulu bersenang-senang kemudian</p> -->
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

</div>