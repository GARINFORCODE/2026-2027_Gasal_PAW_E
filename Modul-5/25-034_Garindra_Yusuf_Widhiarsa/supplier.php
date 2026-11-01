<?php 
require 'koneksi.php';

$supplier = $DBH->prepare("SELECT * FROM supplier");
$supplier->execute();
$supplier = $supplier->fetchAll();

?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Master Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-end align-items-center mb-3">
            <a href="tambah_supplier.php" class="btn btn-success">Tambah Data</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($supplier as $row): ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php echo $row['telp'] ?></td>
                            <td><?php echo $row['alamat'] ?></td>
                            <td>
                                <a href="edit_supplier.php?id=<?php echo $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data supplier ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
