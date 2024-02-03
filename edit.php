<?php
session_start();
require 'config.php';

// Inisialisasi $collection
$collection = $db_project->simpan_pinjam;

if (isset($_GET['id'])) {
    $objectId = $_GET['id'];

    // Periksa apakah $objectId adalah string yang valid sebagai ObjectId
    if (!preg_match('/^[a-f\d]{24}$/i', $objectId)) {
        echo "Invalid ObjectID format";
        exit;
    }

    $rest = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($objectId)]);
}

if (isset($_POST['submit'])) {
    // Ambil data dari formulir
    $Id_Anggota = $_POST['Id_Anggota'];
    $Nama_Anggota = $_POST['Nama_Anggota'];
    $Alamat_Anggota = $_POST['Alamat_Anggota'];
    $No_Telp = $_POST['No_Telp'];
    $Simpanan = $_POST['Simpanan'];
    $Pinjaman = $_POST['Pinjaman'];

    // Perbarui dokumen di MongoDB
    $updateResult = $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($objectId)],
        [
            '$set' => [
                'Nama_Anggota' => $Nama_Anggota,
                'Alamat_Anggota' => $Alamat_Anggota,
                'No_Telp' => $No_Telp,
                'Simpanan' => $Simpanan,
                'Pinjaman' => $Pinjaman,
                'Id_Anggota' => $Id_Anggota, // tambahkan ini
            ],
        ]
    );

    if ($updateResult->getModifiedCount() > 0) {
        // Jika ada perubahan, arahkan kembali ke index.php
        header("Location: index.php");
        exit;
    } else {
        echo "<script>
            alert('Gagal mengupdate data Anggota');
            document.location.href = 'index.php'; // Redirect to index.php
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Anggota</title>
    <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- Style -->
    <style>
        .bl {
            padding: 10px;
        }

        .container {
            width: 100%;
            margin-top: 2%;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.7);
            padding: 5%;
        }

        table {
            font-family: Tekton Pro;
            text-align: center;
        }

        h3 {
            font-family: Cheeky Rabbit;
            font-weight: bold;
            color: #534D9D;
            font-size: 40px;
        }
    </style>
</head>

<body>
    <div class="container col-md-8">
        <div class="row justify-content-center">
            <div class="col">
                <h3 class="text-center">Edit Data Anggota</h3>
                <form method="POST">
                    <table class="table table-hover">
                        <tr>
                            <td><label for="Id_Anggota">ID Anggota</label></td>
                            <td><input type="text" class="form-control" name="Id_Anggota" value="<?php echo isset($rest) ? $rest->Id_Anggota : ''; ?>"></td>
                        </tr>

                        <tr>
                            <td><label for="Nama_Anggota">Nama Anggota</label></td>
                            <td><input type="text" class="form-control" name="Nama_Anggota" value="<?php echo isset($rest) ? $rest->Nama_Anggota : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="Alamat_Anggota">Alamat Anggota</label></td>
                            <td><input type="text" class="form-control" name="Alamat_Anggota" value="<?php echo isset($rest) ? $rest->Alamat_Anggota : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="No_Telp">No. Telepon</label></td>
                            <td><input type="text" class="form-control" name="No_Telp" value="<?php echo isset($rest) ? $rest->No_Telp : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="Simpanan">Simpanan</label></td>
                            <td><input type="text" class="form-control" name="Simpanan" value="<?php echo isset($rest) ? $rest->Simpanan : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="Pinjaman">Pinjaman</label></td>
                            <td><input type="text" class="form-control" name="Pinjaman" value="<?php echo isset($rest) ? $rest->Pinjaman : ''; ?>"></td>
                        </tr>
                    </table>
                    <div align="right">
                        <button type="submit" name="submit" class="btn btn-primary bi bi-check-circle"> Submit </button>
                        <a href="index.php" class="btn btn-danger bi bi-arrow-right-circle"> Cancel </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
