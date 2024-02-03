<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Koperasi Simpan Pinjam</title>
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
            color: #C04000;
            font-size: 40px;
        }

        .table-header th {
            background-color: #C19A6B !important;
            color: white;
        }

        .table-data td {
            background-color: #D7D4CD !important;
        }

    </style>
</head>

<body>
    <div class="container col-md-8">
        <div class="row justify-content-center">
            <div class="col">
                <img src="img/Logo3.jpg" width="50" class="mb-5">
                <h3 class="text-center">Data Koperasi Simpan Pinjam PA</h3>
                <br />

                <div class="table-responsive">
                    <table border="1" class="table table-hover table-bordered">
                        <thead>
                            <tr class="text-center table-header"> <!-- Add the class here -->
                                <th>ID Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Alamat Anggota</th>
                                <th>No. Telepon</th>
                                <th>Simpanan</th>
                                <th>Pinjaman</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <?php
                        require 'config.php';

                        // Check if the MongoDB connection is established
                        if (isset($db_project) && $db_project) {
                            $anggotaCollection = $db_project->simpan_pinjam;
                            $anggotaData = $anggotaCollection->find();

                            foreach ($anggotaData as $anggota) {
                                echo "<tr class='text-center' style='background-color: #D7D4CD'>";
                                echo "<td style='display:none;'>" . ($anggota['_id'] ?? '') . "</td>";
                                echo "<td>" . ($anggota['Id_Anggota'] ?? '') . "</td>";
                                echo "<td>" . ($anggota['Nama_Anggota'] ?? '') . "</td>";
                                echo "<td>" . ($anggota['Alamat_Anggota'] ?? '') . "</td>";
                                echo "<td>" . ($anggota['No_Telp'] ?? '') . "</td>";
                                echo "<td>" . ($anggota['Simpanan'] ?? '') . "</td>";
                                echo "<td>" . ($anggota['Pinjaman'] ?? '') . "</td>";
                                echo "<td>";
                                echo "<a href='edit.php?id=" . $anggota['_id'] . "' class='btn btn-warning bi bi-pen' onclick='return confirm(\"Yakin Data Akan DiUpdate ?\");'> Update </a>";
                                echo "</td>";
                                echo "<td>";
                                echo "<a href='delete.php?id=" . $anggota['_id'] . "' class='btn btn-danger bi bi-eraser' onclick='return confirm(\"Yakin Data Akan Dihapus ?\");'> Remove </a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>Failed to connect to MongoDB.</td></tr>";
                        }
                        ?>
                    </table>
                    <a href="create.php" class="btn btn-primary bi bi-patch-plus" style="font-family: Tekton Pro"> Create Data </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
