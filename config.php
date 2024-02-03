<?php

require 'vendor/autoload.php';

use MongoDB\Client;

$mongoClient = new Client("mongodb://localhost:27017");
$databaseName = "koperasi"; // Sesuaikan dengan nama database yang baru

$db_project = $mongoClient->$databaseName; // Menggunakan $databaseName sebagai nama database

$collection = $db_project->simpan_pinjam; // Sesuaikan dengan nama collection yang baru

