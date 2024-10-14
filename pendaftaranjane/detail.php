<?php 
    include 'database/database.php';

    session_start();
    // validasi apakah user sudah login
    if (!isset($_SESSION['in_login']) || $_SESSION['in_login'] !== true) {
        header("Location: login.php");
        exit;
    }
    
    if (isset($_POST['kembali'])) {
        header('location: dashboard-admin.php');
        exit;
    }
    
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM pendaftar WHERE id = '$id'";
    $result = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($result);

    $id = $_GET['id'];
$sql = "SELECT * FROM pendaftar WHERE id = '$id'";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - WEB pendaftar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }
        header {
            background: #35424a;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #35424a;
            color: white;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background: #e8491d;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h2>Selamat datang</h2>
            <p>Berikut adalah detail data dan status pendaftar :</p>
        </header>

        <section>
            <table>
                <thead>
                <tr>
                    <th colspan="2">Data dan status pendaftar anda</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td><?= htmlspecialchars($data['nama']) ?></td>
                    </tr>
                    <tr>
                        <td>Asal Sekolah</td>
                        <td><?= htmlspecialchars($data['asal_sekolah']) ?></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td><?= htmlspecialchars($data['tempat_lahir']) ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td><?= htmlspecialchars($data['tanggal_lahir']) ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td><?= htmlspecialchars($data['jenis_kelamin']) ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?= htmlspecialchars($data['alamat']) ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Handphone</td>
                        <td><?= htmlspecialchars($data['no_hp']) ?></td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td><?= htmlspecialchars($data['agama']) ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= htmlspecialchars($data['email']) ?></td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td><?= htmlspecialchars($data['jurusan']) ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?= htmlspecialchars($data['status']) ?></td>
                    </tr>
                    <!-- Tambahkan baris lain untuk data pengguna lainnya -->
                </tbody>
            </table>
        </section>
        <form action="" method="POST">
            <button type="submit" name="kembali">Kembali</button>
        </form>
    </div>
</body>
</html>