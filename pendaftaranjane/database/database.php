<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_pendaftar";

    $db = mysqli_connect($hostname, $username, $password, $dbname);

    if ($db->connect_error) {
        echo "database koneksi error " ;
        die("error!");
    }

?>