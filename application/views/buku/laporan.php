<h1 class="h1 mb-0 mt-3 text-gray-800 ml-4"></h1>

<div class="container bg-white">
    <h3 class="font-weight-bold p-2 text-primary text-center">Informasi Tiket Masuk</h3>
    <div class="d-sm-flex">
        <form class="form-inline mx-3 my-2 my-lg-0 mr-auto">
            <select id="Show" class="form-control mr-sm-2" onchange="showRows()">
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
        </form>
        <form class="form-inline my-2 my-lg-0">
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
                    <th>Pesan</th>
                    <th>Kategori</th>
                    <th>Urgent</th>
                    <th>Created</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($laporanMasuk as $row) : ?>
                    <tr>
                        <td class="id-cell"><?= $row['id']; ?></td>
                        <td><?= $row['no_tiket']; ?></td>
                        <td><?= $row['departemen']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['judul_laporan']; ?></td>
                        <td><?= $row['sub_kategori']; ?></td>
                        <td><?= $row['tingkat_urgency']; ?></td>
                        <td><?= $row['created']; ?></td>
                        <td><a href="<?= base_url('laporan/acceptLaporan/' . $row['no_tiket']) ?>" class="btn btn-primary">Accept</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
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

        // Reset row numbers after search
        resetRowNumbers();
    }

    function showRows() {
        var select, table, tr, i, value;
        select = document.getElementById("Show");
        value = select.value;
        table = document.getElementById("reportTable");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
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

        // Reset row numbers after filtering
        resetRowNumbers();
    }

    function resetRowNumbers() {
        var table, tr, td, i;
        table = document.getElementById("reportTable");
        tr = table.getElementsByTagName("tr");

        var visibleRows = 1;
        for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            if (tr[i].style.display !== "none") {
                td = tr[i].getElementsByClassName("id-cell")[0];
                if (td) {
                    td.textContent = visibleRows; // Set new row number
                    visibleRows++;
                }
            }
        }
    }

    // Initialize row numbers on page load
    document.addEventListener("DOMContentLoaded", resetRowNumbers);
</script>
