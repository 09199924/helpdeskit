        <!-- Sidebar -->
        <ul class="navbar-nav sdb-coba sidebar accordion p-2" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <img src="<?= base_url('assets/img/desainlogo.svg')?>" width="90" height="100">
                <div class="sidebar-brand-text mx-3 text-white">SIHEPI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Looping Menu-->
            <div class="sidebar-heading">
                Home
            </div>
            <li class="nav-item rounded active">
                <!-- Nav Item - Dashboard -->
            <li class="nav-item rounded">
                <a class="nav-link " href="<?= base_url('user'); ?>">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span></a>
            </li>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item rounded active">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item rounded">
                    <!-- 
                <a class="nav-link pb-0" href="<?= base_url('home/detailbuku'); ?>">
                    <i class="fa fa-fw fa book"></i>
                    <span>New Request</span></a> -->
                    <?php
                    // Misalkan $role adalah variabel yang menyimpan peran pengguna


                    // Mulai blok kondisi
                    if ($role == 1) {
                        // Jika peran adalah 1, tampilkan link ini
                        ?>
                        <a class="nav-link" href="<?= base_url('home/detailbuku'); ?>">
                            <i class="fa fa-fw fa-book"></i> <!-- Perbaikan typo di sini -->
                            <span>New Request</span>
                        </a>
                        <?php
                    } else {
                        // Jika peran bukan 1, tampilkan sesuatu yang lain
                        ?>
                        <a class="nav-link ms-1" href="<?= base_url('datalaporan'); ?>">
                        <i class="fas fa-solid fa-table"></i>
                            <span>Data Laporan</span>
                        </a>
                        <a class="nav-link ms-1" href="<?= base_url('laporan'); ?>">
                        <i class="fas fa-solid fa-envelope"></i>
                            <span>Laporan Masuk</span>
                        </a>
                        <?php
                    }
                    ?>

            </li>
            <li class="nav-item rounded">
                <?php
                // Misalkan $role adalah variabel yang menyimpan peran pengguna


                    // Mulai blok kondisi
                    if ($role == 1) {
                        // Jika peran adalah 1, tampilkan link ini
                        ?>
                <a class="nav-link" href="<?= base_url('buku/kategori'); ?>">
                <i class="fa fa-fw fa-book"></i>
                    <span>Tiket</span></a>
                    <?php
                    } else {
                        // Jika peran bukan 1, tampilkan sesuatu yang lain
                        ?>
                        
                        <?php
                    }
                    ?>
            </li>
            
            <!-- Divider -->
            
            <hr class="sidebar-divider mt-3">
            <?php
            if ($role == 2 ) {
                
            ?>
            <div class="sidebar-heading">
                Laporan
            </div>
            <li class="nav-item rounded active">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item rounded">
                        <a class="nav-link " href="<?= base_url('download'); ?>">
                            <i class="fas fa-solid fa-download"></i> <!-- Perbaikan typo di sini -->
                            <span>Download Laporan</span>
                        </a>
                        <a class="nav-link " href="<?= base_url('printpdf'); ?>">
                            <i class="fas fa-solid fa-print"></i> <!-- Perbaikan typo di sini -->
                            <span>Print Laporan</span>
                        </a>
                    
            </li>
            </li>
            <?php } ?> 
            </li>

        </ul>
        <!-- End of Sidebar --   > 
        
        