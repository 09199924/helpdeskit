    <!-- Begin Page Content -->
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 justify-content-x">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>
    <div class="card mb-3 justify-content-x " style="max-width: 540px;">
        
            
            
                <div class="rounded-circle">
                <img src="<?= base_url('assets/img/profile/') . $image; ?>" class="card-img" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $user; ?></h5>
                    <p class="card-text"><?= $email; ?></p>
                    <p class="card-text"><small class="text-muted">Jadi member sejak: <br><b><?= date('d F Y', $tanggal_input); ?></b></small></p>
                </div>
                <div class="btn btn-info ml-3 my-3">
                    <a href="<?= base_url('member/ubahprofil'); ?>" class="text text-white"><i class="fas fa-user-edit"></i> Ubah Profil</a>
                </div>
            
        
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->