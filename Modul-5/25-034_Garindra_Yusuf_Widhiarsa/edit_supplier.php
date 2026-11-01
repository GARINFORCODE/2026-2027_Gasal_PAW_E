<?php
require 'koneksi.php';

$id = $_GET['id'];

$supplier = $DBH->prepare("SELECT * FROM supplier WHERE id = '$id'");
$supplier->execute();
$supplier = $supplier->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $supplier['id']; ?>">
            <div class="row mb-3 justify-content-center">
                <label for="nama" class="col-md-2 col-form-label">Nama</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($supplier['nama']); ?>" required>
                </div>
            </div>

            <div class="row mb-3 justify-content-center">
                <label for="telp" class="col-md-2 col-form-label">Telp</label>
                <div class="col-md-6">
                    <input type="tel" class="form-control" id="telp" name="telp" value="<?= htmlspecialchars($supplier['telp']); ?>" required>
                </div>
            </div>

            <div class="row mb-3 justify-content-center">
                <label for="alamat" class="col-md-2 col-form-label">Alamat</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($supplier['alamat']); ?>" required>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 text-start">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="supplier.php" class="btn btn-danger">Batal</a>
                </div>
            </div>

        </form>
    </div>

    <script>
        document.getElementById("formSupplier").addEventListener("submit", function(acara) {
            acara.preventDefault();
            alert("Form berhasil divalidasi. supplier belum disimpan ke supplierbase karena halaman ini masih berupa frontend HTML.");
        });
    </script>
</body>
</html>
