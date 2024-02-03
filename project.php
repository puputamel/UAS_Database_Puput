<?php

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db_project = $mongoClient->selectDatabase("koperasi");

$collection = $db_project->simpan_pinjam;


