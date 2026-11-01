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
        <form action="simpan.php" method="POST">

            <div class="row mb-3 justify-content-center">
                <label for="nama" class="col-md-2 col-form-label">Nama</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                </div>
            </div>

            <div class="row mb-3 justify-content-center">
                <label for="telp" class="col-md-2 col-form-label">Telp</label>
                <div class="col-md-6">
                    <input type="tel" class="form-control" id="telp" name="telp" placeholder="Telp" required>
                </div>
            </div>

            <div class="row mb-3 justify-content-center">
                <label for="alamat" class="col-md-2 col-form-label">Alamat</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 text-start">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="supplier.php" class="btn btn-danger">Batal</a>
                </div>
            </div>

        </form>
    </div>
</body>
</html>
