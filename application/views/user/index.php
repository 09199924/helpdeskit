<!-- Begin Page Content -->
<div class="container-fluid text-center">

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>

    <div class="row justify-content-center align-items-center">
        <!-- Profile Card -->
        <div class="col-lg-4 mb-3">
            <div class="card" style="border-top: 5px solid blue;">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="rounded-circle mx-auto mt-3" height="100px" width="100px" alt="Profile Picture">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['nama']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Jadi member sejak: <br><b><?= date('d F Y', $user['tanggal_input']); ?></b></small></p>
                    <a href="<?= base_url('user/ubahprofil'); ?>" class="btn btn-info"><i class="fas fa-user-edit"></i> Ubah Profil</a>
                </div>
            </div>
        </div>
        <!-- End of Profile Card -->


    </div> <!-- End of row -->

</div>
<!-- End of Page Content -->
