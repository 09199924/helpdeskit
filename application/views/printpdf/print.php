<h1 class="h1 mb-0 mt-3 text-gray-800 ml-4"></h1>

<div class="container bg-white">
    <h3 class="p-2 font-weight-bold text-primary">Print Laporan</h3>
    <div class="d-sm-flex justify-content-between align-items-center">
        <form method="post" class="mx-1 col-sm-12" action="<?= base_url('printpdf/print_laporan'); ?>">
            <div class="form-row">
            <div class="form-group col-sm-2">
                        <select id="inputMonth" class="form-control" onchange="filterTable()">
                            <option value="" selected>Filter Bulan..</option>
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
                    <div class="form-group col-sm-2">
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
                <div class="form-group col-sm-4">
                    <button type="button" onclick="printTable()" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </form>
    </div>
    <div class="d-sm-flex">
        <form class="form-inline mx-3 my-2 my-lg-0 mr-auto" onsubmit="return false;">
        <!-- <select id="Show" class="form-control mr-sm-2" onchange="showRows()">
    <option selected>All</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
</select>
            <button class="btn btn-outline-primary my-2 my-sm-0" type="button" onclick="showRows()">Show</button> -->
        </form>
        <form class="form-inline my-2 my-lg-0" onsubmit="return false;">
            <input class="form-control mr-sm-2" type="search" id="searchInput" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="searchTable()">Search</button>
        </form>
    </div>
    <div class="card-body">
        <table id="reportTable" class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Tiket</th>
                    <th>Departemen</th>
                    <th>Klien</th>
                    <th>Tgl Dibuat Laporan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($detail_laporan as $row) : ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['no_tiket']; ?></td>
                    <td><?= $row['departemen']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between">
            <button id="prevPage" class="btn btn-primary" onclick="prevPage()">Sebelumnya</button>
            <span id="pageInfo"></span>
            <button id="nextPage" class="btn btn-primary" onclick="nextPage()">Selanjutnya</button>
        </div>
</div>

<script>
    let currentPage = 1;
    const rowsPerPage = 10;
function printTable() {
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Print Laporan</title>');
    printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } table, th, td { border: 1px solid black; padding: 10px; } th { background-color: #f2f2f2; } </style>');
    printWindow.document.write('</head><body >');
    printWindow.document.write('<h1>Laporan Bulan Ini</h1>');
    printWindow.document.write(document.getElementById('reportTable').outerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

function searchTable() {
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
}

function showRows() {
    var select, table, tr, i, value;
    select = document.getElementById("Show");
    value = select.value;
    table = document.getElementById("reportTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        if (value === "All") {
            tr[i].style.display = "";
        } else {
            if (i <= parseInt(value)) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    updatePagination();
    }

    function filterTable() {
        var monthSelect, yearSelect, month, year, table, tr, td, i, date, txtValue;
        monthSelect = document.getElementById("inputMonth");
        yearSelect = document.getElementById("inputYear");
        month = monthSelect.value;
        year = yearSelect.value;
        table = document.getElementById("reportTable");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            td = tr[i].getElementsByTagName("td")[4]; // The 'Tanggal' column
            if (td) {
                txtValue = td.textContent || td.innerText;
                date = new Date(txtValue);
                if ((month === "" || (date.getMonth() + 1) == parseInt(month)) &&
                    (year === "" || date.getFullYear() == parseInt(year))) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
}
function updatePagination() {
        const table = document.getElementById("reportTable");
        const tr = table.getElementsByTagName("tr");
        const totalRows = tr.length - 1; // exclude header row
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        const pageInfo = document.getElementById("pageInfo");
        pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;

        for (let i = 1; i < tr.length; i++) {
            if (i > (currentPage - 1) * rowsPerPage && i <= currentPage * rowsPerPage) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }

    function nextPage() {
        const table = document.getElementById("reportTable");
        const tr = table.getElementsByTagName("tr");
        const totalRows = tr.length - 1; // exclude header row
        const totalPages = Math.ceil(totalRows / rowsPerPage);

        if (currentPage < totalPages) {
            currentPage++;
            updatePagination();
        }
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        updatePagination();
    });


</script>
