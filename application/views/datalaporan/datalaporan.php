<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan</title>
    <style>
        /* Additional custom styles for better responsiveness */
        @media (max-width: 576px) {
            .form-inline {
                flex-direction: column;
            }
            .form-inline .form-control,
            .form-inline .btn {
                width: 100%;
                margin-bottom: 10px;
            }
            .modal-dialog {
                max-width: 100%;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container bg-white p-2 px-2">
        <h3 class="font-weight-bold text-primary text-center">Data Laporan</h3>
        <div class="row m-2">
            <form class="col-12">
                <div class="form-row">
                    <div class="form-group col-6 col-md-2">
                        <select id="inputMonth" class="form-control" onchange="filterTable()">
                            <option value="" selected>Filter Bulan...</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="form-group col-6 col-md-2">
                        <select id="inputYear" class="form-control" onchange="filterTable()">
                            <option value="" selected>Filter Tahun...</option>
                            <?php
                            $currentYear = date('Y');
                            for ($year = $currentYear; $year >= 2000; $year--) {
                                echo "<option value='$year'>$year</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="row m-2">
            <form class="form-inline mx-3 my-2 my-lg-0 mr-auto col-12 col-md-auto" method="post" onsubmit="showRows(); return false;">
                <select id="Show" name="show" class="form-control mr-sm-2">
                    <option value="" selected>...</option>
                    <option value="All">All</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Show</button>
            </form>
            <form class="form-inline my-2 my-lg-0 col-12 col-md-auto">
                <input class="form-control mr-sm-2" type="search" id="searchInput" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="searchTable()">Search</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="reportTable" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Tiket</th>
                            <th>Departemen</th>
                            <th>Klien</th>
                            <th>Pesan</th>
                            <th>Kategori</th>
                            <th>Urgent</th>
                            <th>Created</th>
                            <th>Aksi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($laporan as $row) : ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['no_tiket']; ?></td>
                                <td><?= $row['departemen']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['judul_laporan']; ?></td>
                                <td><?= $row['sub_kategori']; ?></td>
                                <td><?= $row['tingkat_urgency']; ?></td>
                                <td><?= $row['created']; ?></td>
                                <?php if($row['isRepair'] == 1): ?>
                                    <td>Selesai</td>
                                <?php else: ?>
                                    <td><a href="<?= base_url('datalaporan/repair/' .$row['no_tiket'])?>" class="btn btn-warning">Perbaiki</a></td>
                                <?php endif; ?>
                                <td>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#detailModal"
                                        data-nama="<?= $row['nama']; ?>"
                                        data-departemen="<?= $row['departemen']; ?>"
                                        data-judul_laporan="<?= $row['judul_laporan']; ?>"
                                        data-no_tiket="<?= $row['no_tiket']; ?>"
                                        data-sub_kategori="<?= $row['sub_kategori']; ?>"
                                        data-tingkat_urgency="<?= $row['tingkat_urgency']; ?>"
                                        data-no_ext="<?= $row['no_ext']; ?>"
                                        data-image="<?= $row['image']; ?>"
                                        data-deskripsi="<?= $row['deskripsi']; ?>">Detail</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td id="modalNama"></td>
                        </tr>
                        <tr>
                            <th>Departemen</th>
                            <td id="modalDepartemen"></td>
                        </tr>
                        <tr>
                            <th>Judul Laporan</th>
                            <td id="modalJudulLaporan"></td>
                        </tr>
                        <tr>
                            <th>No Tiket</th>
                            <td id="modalNoTiket"></td>
                        </tr>
                        <tr>
                            <th>Sub Kategori</th>
                            <td id="modalSubKategori"></td>
                        </tr>
                        <tr>
                            <th>Tingkat Urgensi</th>
                            <td id="modalTingkatUrgency"></td>
                        </tr>
                        <tr>
                            <th>No Ext</th>
                            <td id="modalNoExt"></td>
                        </tr>
                        <tr>
                            <th>Gambar</th>
                            <td>
                                <button class="btn btn-info" id="viewImageBtn">View Image</button>
                            </td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td id="modalDeskripsi"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for viewing image -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">View Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImageSrc" src="" alt="Image" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#detailModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var nama = button.data('nama');
                var departemen = button.data('departemen');
                var judul_laporan = button.data('judul_laporan');
                var no_tiket = button.data('no_tiket');
                var sub_kategori = button.data('sub_kategori');
                var tingkat_urgency = button.data('tingkat_urgency');
                var no_ext = button.data('no_ext');
                var image = button.data('image');
                var deskripsi = button.data('deskripsi');

                var modal = $(this);
                modal.find('.modal-body #modalNama').text(nama);
                modal.find('.modal-body #modalDepartemen').text(departemen);
                modal.find('.modal-body #modalJudulLaporan').text(judul_laporan);
                modal.find('.modal-body #modalNoTiket').text(no_tiket);
                modal.find('.modal-body #modalSubKategori').text(sub_kategori);
                modal.find('.modal-body #modalTingkatUrgency').text(tingkat_urgency);
                modal.find('.modal-body #modalNoExt').text(no_ext);
                modal.find('.modal-body #viewImageBtn').attr('onclick', 'viewImage("' + image + '")');
                modal.find('.modal-body #modalDeskripsi').text(deskripsi);
            });

            // View image function
            window.viewImage = function(image) {
                var imageUrl = "<?= base_url('assets/img/upload/') ?>" + image; // Get the complete image URL
                $('#modalImageSrc').attr('src', imageUrl); // Set the src attribute of the image
                $('#imageModal').modal('show'); // Show the image modal
            };

            // Search function
            window.searchTable = function() {
                var input, filter, table, tr, td, i, j, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toLowerCase();
                table = document.getElementById("reportTable");
                tr = table.getElementsByTagName("tr");

                for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
                    tr[i].style.display = "none";
                    td = tr[i].getElementsByTagName("td");
                    for (j = 0; j < td.length; j++) {
                        if (td[j]) {
                            txtValue = td[j].textContent || td[j].innerText;
                            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                                break; // Show the row and break the loop if a match is found
                            }
                        }
                    }
                }
            };

            // Filter function
            window.filterTable = function() {
                var monthSelect, yearSelect, month, year, table, tr, td, i, date, txtValue;
                monthSelect = document.getElementById("inputMonth");
                yearSelect = document.getElementById("inputYear");
                month = monthSelect.value;
                year = yearSelect.value;
                table = document.getElementById("reportTable");
                tr = table.getElementsByTagName("tr");

                for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
                    tr[i].style.display = ""; // Show all rows by default
                    td = tr[i].getElementsByTagName("td")[7]; // The 'Created' column
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        date = new Date(txtValue);
                        if ((month !== "" && (date.getMonth() + 1) != parseInt(month)) ||
                            (year !== "" && date.getFullYear() != parseInt(year))) {
                            tr[i].style.display = "none";
                        }
                    }
                }
            };

            // Show rows function
            window.showRows = function() {
                var showSelect, show, table, tr, i;
                showSelect = document.getElementById("Show");
                show = showSelect.value;
                table = document.getElementById("reportTable");
                tr = table.getElementsByTagName("tr");

                if (show === "All") {
                    for (i = 1; i < tr.length; i++) {
                        tr[i].style.display = "";
                    }
                } else {
                    show = parseInt(show);
                    for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
                        if (i <= show) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            };

            // Event listener for the search input
            document.getElementById("searchInput").addEventListener("keyup", searchTable);

            // Event listener for the filter select elements
            document.getElementById("inputMonth").addEventListener("change", filterTable);
            document.getElementById("inputYear").addEventListener("change", filterTable);

            // Event listener for the show select element
            document.getElementById("Show").addEventListener("change", showRows);
        });
    </script>
</body>
</html>
