<div class="container bg-white">
    <h3 class="p-2 font-weight-bold text-primary">Tiket Yang Telah Dibuat</h3>
    <div class="d-sm-flex justify-content-between align-items-center">
        <!-- Form Filter -->
        <form>
            <div class="form-row">
                <!-- Tambahkan elemen form filter di sini jika diperlukan -->
            </div>
        </form>
    </div>
    <div class="d-sm-flex">
        <!-- Form Show -->
        <form class="form-inline my-2 my-lg-0 mr-auto">
            <!-- Tambahkan elemen form show di sini jika diperlukan -->
        </form>
        <!-- Form Search -->
        <form class="form-inline my-2 my-lg-0 ">
            <!-- Tambahkan elemen form pencarian di sini jika diperlukan -->
        </form>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Tiket</th>
                    <th>Departemen</th>
                    <th>Klien</th>
                    <th>Tgl Dibuat Lapoan</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if($role == 1 && !empty($detail_laporan_user)) { 
                    $i = 1;
                    foreach($detail_laporan_user as $row) {
                        ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row['no_tiket']; ?></td>
                            <td><?= $row['departemen']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['tanggal']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                } else { 
                    echo '<tr><td colspan="5">No Data</td></tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
