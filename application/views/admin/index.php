<!-- Main Content -->
<div id="content" class="bg-light">
    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg judull navbar-light topbar mb-0 static-top shadow">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center w-100">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-lg-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                
                <h1 class="font-weight-bold text-center text-white flex-grow-1 m-0">Dashboard</h1>
                
                <?php if ($role == 2) { ?>
                <div class="d-flex flex-row-reverse align-items-center">
                    <span class="d-flex gap-2 text-center border p-2 text-dark bg-light fw-bold align-items-center" style="width: auto;">
                        <img src="<?= base_url('assets/img/users-solid.svg')?>" alt="" style='width:30px; margin-right:10px'>   
                        <div class="text-left">
                            <div class="h4 mb-0 font-weight-bold text-dark"><?= $this->ModelUser->getUserWhere(['role_id' => 1])->num_rows(); ?></div>
                            <div>orang</div>
                        </div> 
                    </span>
                </div>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">
            <!-- Card Example -->
            <div class="col-xl-5 col-md-6 mb-4 ml-5 mt-5">
                <div class="card shadow h-100 py-2">
                    <div class="card-header text-xl font-weight-bold text-warning text-uppercase mb-1">Dalam Perbaikan</div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-dark text-uppercase mb-1">Jumlah</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800"><?php if($role == 1){ echo $jumlah_perbaikan_user; } else { echo $jumlah_perbaikan; }?></div>
                            </div>
                            <div class="col-auto">
                                <img src="<?= base_url('assets/img/maintenance.svg')?>" alt="" style='width:90px; margin-right:10px'> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Example -->
            <div class="col-xl-5 col-md-6 mb-4 ml-5 mt-5">
                <div class="card shadow h-100 py-2">
                    <div class="card-header text-xl font-weight-bold text-success text-uppercase mb-1">Tiket Selesai</div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-dark text-uppercase mb-1">Jumlah</div>
                                <div class="h1 mb-0 font-weight-bold text-gray-800"><?php if($role == 1){ echo $perbaikan_selesai_user; } else { echo $perbaikan_selesai; }?></div>
                            </div>
                            <div class="col-auto">
                                <img src="<?= base_url('assets/img/complete.svg')?>" alt="" style='width:90px; margin-right:10px'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($role == 2): ?> <!-- Check if the user is an admin -->
        <div class="container bg-white">
            <h3 class="p-1 text-center text-primary font-weight-bold">Laporan Bulan Ini</h3>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Pending</th>
                                <th>Done</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data_perbaikan as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['isRepair'] != 1 ? 'Pending' : '-' ?></td>
                                <td><?= $row['isRepair'] == 1 ? 'Done' : '-' ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
