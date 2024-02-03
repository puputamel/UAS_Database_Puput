<?php
session_start();
require 'config.php';

// Inisialisasi $collection
$collection = $db_project->simpan_pinjam;

if (isset($_GET['id'])) {
    $rest = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

    // Check if data exists
    if (!$rest) {
        echo "<script>
                alert('Data Anggota tidak ditemukan!');
                document.location.href = 'index.php';
              </script>";
        exit;
    }

    $Id_Anggota = $rest->Id_Anggota; // Pindahkan deklarasi variable ke sini
}

if (isset($_POST['submit'])) {
    $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

    echo "<script>
            alert('Data Anggota berhasil dihapus!');
            document.location.href = 'index.php';
          </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Delete Data Anggota</title>
    <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

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

    h3 {
        font-family: Cheeky Rabbit;
        font-weight: bold;
        color: #534D9D;
        font-size: 40px;
    }

    h5 {
        font-family: Tekton Pro;
        color: #534D9D;
        text-align: center;
        font-size: 20px;
    }
</style>

<body>
    <div class="container col-md-8">
        <div class="row justify-content-center">
            <div class="col">
                <h3 class="text-center mb-4">Delete Data Anggota</h3>
                <h5 class="mb-4"> Apakah Anda yakin akan menghapus data anggota dengan
                    ID Anggota <?php echo isset($Id_Anggota) ? $Id_Anggota : ''; ?> ? </h5>
            </div>
            <form method="POST">
                <div class="form-group mb-3" align="center">
                    <button type="submit" name="submit" class="btn btn-danger bi bi-eraser"> Remove </button>
                    <a href="index.php" class="btn btn-primary bi bi-arrow-right-circle"> Cancel </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
