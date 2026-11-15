<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$mulai = $_GET['tanggal_mulai'] ?? '';
$selesai = $_GET['tanggal_selesai'] ?? '';

$labels = []; $data_total = []; $rekap = [];
$total_pendapatan = 0; $total_pelanggan = 0;

if (!empty($mulai) && !empty($selesai)) {
    $tgl_mulai = mysqli_real_escape_string($koneksi, $mulai);
    $tgl_selesai = mysqli_real_escape_string($koneksi, $selesai);

    $q = "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian
          FROM transaksi WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai'
          GROUP BY DATE(waktu_transaksi) ORDER BY tgl ASC";
    $res = mysqli_query($koneksi, $q);
    while ($r = mysqli_fetch_assoc($res)) {
        $labels[] = $r['tgl'];
        $data_total[] = (int) $r['total_harian'];
        $rekap[] = $r;
        $total_pendapatan += $r['total_harian'];
    }

    $qp = "SELECT COUNT(DISTINCT pelanggan_id) AS jml FROM transaksi
           WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
    $rp = mysqli_fetch_assoc(mysqli_query($koneksi, $qp));
    $total_pelanggan = $rp['jml'] ?? 0;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan dan Grafik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body>
<div class="container my-4">
    <div class="no-print">
        <h1 class="h3 mb-3">Filter Laporan Penjualan</h1>
        <form method="GET" class="row g-2 align-items-end mb-3">
            <div class="col-md-4">
                <label class="form-label">Dari</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="<?= $mulai ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Sampai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="<?= $selesai ?>" required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </div>
        </form>
    </div>

    <?php if (!empty($labels)): ?>
    <div class="no-print mb-3">
        <button onclick="window.print()" class="btn btn-warning">Cetak</button>
        <a href="export_excel.php?tanggal_mulai=<?= $mulai ?>&tanggal_selesai=<?= $selesai ?>" class="btn btn-success">Excel</a>
    </div>

    <h2 class="h4">Rekap Laporan Penjualan <small class="text-muted"><?= $mulai ?> sampai <?= $selesai ?></small></h2>

    <div style="max-width: 800px;">
        <canvas id="myChart"></canvas>
    </div>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($labels); ?>,
                datasets: [{ label: 'Total Penjualan', data: <?= json_encode($data_total); ?> }]
            },
            options: {
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>

    <h2 class="h4 mt-4">Rekapitulasi</h2>
    <table class="table table-bordered">
        <tr class="table-info"><th>No</th><th>Total Pendapatan</th><th>Tanggal Transaksi</th></tr>
        <?php $no = 1; foreach ($rekap as $row): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>Rp. <?= number_format($row['total_harian'], 0, ',', '.'); ?></td>
            <td><?= $row['tgl']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="card" style="max-width: 400px;">
        <table class="table table-bordered mb-0">
            <tr class="table-info"><th>Jumlah Pelanggan</th><th>Jumlah Pendapatan</th></tr>
            <tr>
                <td><?= $total_pelanggan; ?> Orang</td>
                <td>Rp. <?= number_format($total_pendapatan, 0, ',', '.'); ?></td>
            </tr>
        </table>
    </div>
    <?php elseif (!empty($mulai) && !empty($selesai)): ?>
    <div class="alert alert-warning">Tidak ada transaksi pada rentang tanggal tersebut.</div>
    <?php endif; ?>
</div>
</body>
</html>
