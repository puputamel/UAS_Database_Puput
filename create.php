<?php
session_start();
require 'config.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $Id_Anggota = $_POST['Id_Anggota'];
    $Nama_Anggota = $_POST['Nama_Anggota'];
    $Alamat_Anggota = $_POST['Alamat_Anggota'];
    $No_Telp = $_POST['No_Telp'];
    $Simpanan = $_POST['Simpanan'];
    $Pinjaman = $_POST['Pinjaman'];

    // Insert data into MongoDB
    $insertResult = $collection->insertOne([
        "Id_Anggota" => $Id_Anggota,
        "Nama_Anggota" => $Nama_Anggota,
        "Alamat_Anggota" => $Alamat_Anggota,
        "No_Telp" => $No_Telp,
        "Simpanan" => $Simpanan,
        "Pinjaman" => $Pinjaman
    ]);

    if ($insertResult->getInsertedCount() > 0) {
        // Data inserted successfully
        header('Location: index.php');
        exit;
    } else {
        // Failed to insert data
        echo "<script>
                alert('Gagal menambahkan data Anggota. Silakan coba lagi.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Anggota</title>
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
                <h3 class="text-center mb-4">Tambah Data Anggota</h3>

                <form method="POST">
                    <div class="form-group">
                        <label for="Id_Anggota">ID Anggota</label>
                        <input type="text" class="form-control" name="Id_Anggota" required="required">
                    </div>
                    <div class="form-group">
                        <label for="Nama_Anggota">Nama Anggota</label>
                        <input type="text" class="form-control" name="Nama_Anggota" required="required">
                    </div>
                    <div class="form-group">
                        <label for="Alamat_Anggota">Alamat Anggota</label>
                        <input type="text" class="form-control" name="Alamat_Anggota" required="required">
                    </div>
                    <div class="form-group">
                        <label for="No_Telp">No. Telepon</label>
                        <input type="text" class="form-control" name="No_Telp" required="required">
                    </div>
                    <div class="form-group">
                        <label for="Simpanan">Simpanan</label>
                        <input type="text" class="form-control" name="Simpanan" required="required">
                    </div>
                    <div class="form-group">
                        <label for="Pinjaman">Pinjaman</label>
                        <input type="text" class="form-control" name="Pinjaman" required="required">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary bi bi-check-circle"
                        style="font-family: Tekton Pro"> Submit </button>
                    <a href="index.php" class="btn btn-danger bi bi-arrow-right-circle"
                        style="font-family: Tekton Pro"> Batal </a>
    
