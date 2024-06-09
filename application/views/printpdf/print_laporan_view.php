<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Bulanan</h1>
        <p>Bulan: <?= $month ?></p>
        <p>Tahun: <?= $year ?></p>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Tiket</th>
                    <th>Departemen</th>
                    <th>Klien</th>
                    <th>Tgl Selesai</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($laporan)) : ?>
                    <?php foreach ($laporan as $index => $row) : ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $row['no_tiket']; ?></td>
                            <td><?= $row['departemen']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['created']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">No data available for the selected month and year.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <p>Total Perbaikan Selesai: <?= $total_perbaikan_selesai; ?></p>
    </div>
</body>
</html>
