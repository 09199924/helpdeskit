<div class="container mt-5 pt-5" >
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5 kartulogin">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="card-body p-4">
                        <img src="<?= base_url('assets/img/desainlogo.svg')?>" width="200px" class=" mt-5 mx-auto d-block" alt="Logo"> <!-- Tambahkan class mb-3, mx-auto, dan d-block untuk penataan gambar -->
                        
                            <h1 class="h4 text-white fw-bold mb-4 text-center">Sistem Helpdesk IT</h1>
                            <?= $this->session->flashdata('pesan'); ?>
                            <form class="user" method="post" action="<?= base_url('autentifikasi'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" value="<?= set_value('email'); ?>" id="email" placeholder="Masukkan Alamat Email" name="email">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password">
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Masuk
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('autentifikasi/registrasi'); ?>">Daftar Member!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
