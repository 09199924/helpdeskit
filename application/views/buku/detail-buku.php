<div class="container">
    <div class="d-sm-flex justify-content-around text-center">
        <div class="card" style="width: 18rem; height:20rem;">
        <img src="<?= base_url('assets/img/laptoperror.svg')?>"width="90px" height="90px" style="size: 140px;" class="card-img-top" alt="End User">
          <div class="card-body">
            <h5 class="card-title text-center">End User</h5>
            <p class="card-text text-center">Layanan terkait komputer, printer, video conference, user management, wifi, anti virus, app office</p>
            <a href="<?= base_url('request/enduser'); ?>" class="btn btn-primary">Pilih</a>
          </div>
        </div>
        <div class="card" style="width: 18rem; height:20rem;">
          <img src="<?= base_url('assets/img/errorsinyal.svg')?>"width="90px" height="90px" style="size: 140px;" class="card-img-top" alt="Infra">
          <div class="card-body">
            <h5 class="card-title text-center">Infra</h5>
            <p class="card-text text-center">Layanan jaringan (Wifi,Kabel), Telephon, Internet, Email, VPN dan Data Center</p>
            <a href="<?= base_url('request/infra');?>" class="btn btn-primary">Pilih</a>
          </div>
        </div>
    </div>
</div>