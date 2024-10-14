<?php 
    // include 'database/database.php';
    // session_start();

    // // validasi untuk mengecek apakah user sudah login, jika sudah login langsung menuju ke dashboard
    // if (isset($_SESSION["in_login"])) {
    //     header("Location: dashboard.php");
    //     exit;
    // }

    // if (isset($_POST['login'])) {
    //     $email = $_POST['email'];
    //     $nama = $_POST['nama'];

    //     $sql = "SELECT * FROM pendaftar WHERE email = '$email' AND nama = '$nama'";
    //     $result = mysqli_query($db, $sql);

    //     if (mysqli_num_rows($result) > 0) { //cek apakah email dan password ada didatabase dan valid
    //         $_SESSION['nama'] = $data['nama']; //membuat session untuk menampung data selama user login
    //         $_SESSION['id'] = $data['id']; //Session untuk mengambil data id di database untuk keperluan dashboard
    //         $_SESSION ['in_login'] = true; // SESSION untuk validasi jika user nantinya sudah login
    //         header('location: dashboard.php');
    //     } else {
    //         echo "<script>alert('Email atau nama pengguna salah')</script>";
    //     }

    // }

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB pendaftar</title>
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
            max-width: 500px;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }
        header {
            background: #35424a;
            color: white;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e8491d 3px solid;
            text-align: center;
        }
        header h1 {
            margin: 0;
            padding-bottom: 20px;
        }
        form {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"],
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
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
        }
        button:hover {
            background: #333;
        }
    </style>
</head>
<body>
<header>
        <div class="container">
            <h1>Selamat Datang di Website pendaftar</h1>
        </div>
    </header>

    <div class="container">
        <h2>Silahkan Login Untuk Melihat Detail pendaftar Anda</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Masukkan Email">
            </div>

            <div class="form-group">
                <label for="nama">Nama Siswa</label>
                <input type="text" name="nama" id="nama" required placeholder="Masukkan Nama Anda">
            </div>

            <button type="submit" name="login">Login</button>
            <p>
            Belum mendaftar? <a href="index.php">Daftar disini</a>
        </p>
        </form>
    </div>
</body>
</html> -->

<?php 
    include 'database/database.php';
    session_start();

    // validasi untuk mengecek apakah user sudah login, jika sudah login langsung menuju ke dashboard
    if (isset($_SESSION["in_login"])) {
        header("Location: dashboard-admin.php");
        exit;
    }
    if (isset($_SESSION["is_login"])) {
        header("Location: dashboard.php");
        exit;
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $nama = $_POST['nama'];

        $sql = "SELECT * FROM pendaftar WHERE email = '$email' AND nama = '$nama'";
        $result = mysqli_query($db, $sql);

        if ($data = mysqli_fetch_assoc($result)) {
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['id'] = $data['id'];
            $_SESSION['is_login'] = true;
            header('location: dashboard.php');
            exit;
        } else {
            echo "<script>alert('Email atau nama pengguna salah')</script>";
        }
    }

    
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <!-- ... (sisa konten head tetap sama) ... -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB pendaftar</title>
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
            max-width: 500px;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }
        header {
            background: #35424a;
            color: white;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e8491d 3px solid;
            text-align: center;
        }
        header h1 {
            margin: 0;
            padding-bottom: 20px;
        }
        form {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"],
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
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
        }
        button:hover {
            background: #333;
        }
    </style>
</head>
</head>
<body>
    <!-- ... (sisa konten body tetap sama) ... -->
    <header>
        <div class="container">
            <h1>Selamat Datang di Website pendaftar</h1>
        </div>
    </header>

    <div class="container">
        <h2>Silahkan Login Untuk Melihat Detail pendaftar Anda</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Masukkan Email">
            </div>

            <div class="form-group">
                <label for="nama">Nama Siswa</label>
                <input type="text" name="nama" id="nama" required placeholder="Masukkan Nama Anda">
            </div>

            <button type="submit" name="login">Login</button>
            <p>
            Belum mendaftar? <a href="index.php">Daftar disini</a>
        </p>
        </form>
    </div>
</body>
</html>