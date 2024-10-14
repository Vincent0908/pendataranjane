<?php 
    include 'database/database.php';
    session_start();
    
    // Periksa apakah admin sudah login
    if (!isset($_SESSION['in_login']) || $_SESSION['in_login'] !== true) {
    header("Location: logAdmin.php");
    exit;
}


    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header('location: login.php');
        exit;
    }

    if (isset($_POST['tambah'])) {
        header("location: tambah.php");
    }

    $update_message = '';
if (isset($_SESSION['update_message'])) {
    $update_message = $_SESSION['update_message'];
    unset($_SESSION['update_message']);
}
// Logika pembaruan status
if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sqlupdate = "UPDATE pendaftar SET status = '$status' WHERE id = '$id'";
    $query = mysqli_query($db, $sqlupdate);

    if ($query) {
        $_SESSION['update_message'] = "Status berhasil diperbarui";
    } else {
        $_SESSION['update_message'] = "Gagal memperbarui status: " . mysqli_error($db);
    }
    
    // Redirect setelah reload untuk menghindari pengiriman ulang formulir
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

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
        color: #333;
    }
    .container {
        width: 90%;
        max-width: 1200px;
        margin: auto;
        overflow: hidden;
        padding: 20px;
    }
    header {
        background: #35424a;
        color: white;
        padding: 30px 0;
        text-align: center;
        margin-bottom: 30px;
    }
    header h2 {
        margin-bottom: 10px;
        font-size: 2rem;
    }
    header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 15px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #35424a;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #ddd;
    }
    select, button {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    select {
        background-color: white;
        cursor: pointer;
    }
    button {
        background-color: #e8491d;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #333;
    }
    a {
        display: inline-block;
        margin-right: 10px;
        padding: 5px 10px;
        background-color: #e8491d;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }
    a:hover {
        background-color: #333;
    }
    form[action=""] {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    form[action=""] button {
        width: 48%;
        padding: 10px;
        font-size: 16px;
    }
    [role="alert"] {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    @media (max-width: 768px) {
        .container {
            width: 95%;
        }
        table, thead, tbody, th, td, tr {
            display: block;
        }
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        tr {
            margin-bottom: 15px;
            border: 1px solid #ccc;
        }
        td {
            border: none;
            position: relative;
            padding-left: 50%;
        }
        td:before {
            content: attr(data-label);
            position: absolute;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            font-weight: bold;
        }
        form[action=""] {
            flex-direction: column;
        }
        form[action=""] button {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>
</head>
<body>
    <div "container">
        <header>
            <h2>Selamat datang admin <?= $_SESSION['nama'] ?></h2>
            <p>Berikut adalah data dan status pendaftar yang sudah mendaftar:</p>
        </header>

        <?php if (!empty($update_message)): ?>
                <div role="alert">
                    <span><?= $update_message ?></span>
                </div>
            <?php endif; ?>

        <section>
        <table "w-full border-collapse">
                    <thead>
                        <tr>
                            <th>Nama Pendaftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sqlget = "SELECT * FROM pendaftar";
                    $query = mysqli_query($db, $sqlget);

                    while ($data = mysqli_fetch_array($query)) {
                        echo "
                        <tr>
                            <td>{$data['nama']}</td>
                            <td>
                                <form action='' method='post'>
                                    <select name='status'>
                                        <option value='Menunggu' " . ($data['status'] == 'Menunggu' ? 'selected' : '') . ">Menunggu</option>
                                        <option value='Diterima' " . ($data['status'] == 'Diterima' ? 'selected' : '') . ">Diterima</option>
                                        <option value='Ditolak' " . ($data['status'] == 'Ditolak' ? 'selected' : '') . ">Ditolak</option>
                                    </select>
                                    <input type='hidden' name='id' value='{$data['id']}'>
                                    <button type='submit' name='update_status'>Update Status</button>
                                </form>
                            </td>
                            <td>
                                <div>
                                    <a href='detail.php?id={$data['id']}'>Detail</a>
                                    <a href='delete.php?id={$data['id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>
                                </div>
                            </td>
                        </tr>
                        ";
                    }
                    ?>
                    </tbody>
                </table>
        </section>
        <form action="" method="POST">
            <button type="submit" name="logout">Logout</button>
            <button type="submit" name="tambah">Tambah Data</button>
        </form>
    </div>
</body>
</html>