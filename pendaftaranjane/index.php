<?php 
    include "database/database.php";
    session_start();
    if (isset($_SESSION["in_login"])) {
        header("Location: dashboard-admin.php");
        exit;
    }
    if (isset($_SESSION["is_login"])) {
        header("Location: dashboard.php");
        exit;
    }

    if(isset($_POST['daftar'])){
        $nama = $_POST['nama'];
        $asal_sekolah = $_POST['asal_sekolah'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat = $_POST['alamat'];
        $nomor_hp = $_POST['nomor_hp'];
        $agama = $_POST['agama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $email = $_POST['email'];
        $jurusan = $_POST['jurusan'];

        // Cek apakah email dan nomor hp sudah terdaftar
        $check_hp = mysqli_query($db, "SELECT * FROM pendaftar WHERE no_hp = '$nomor_hp'"); // Memeriksa apakah nomor hp sudah terdaftar
        if (mysqli_num_rows($check_hp) > 0) { // Jika nomor hp sudah terdaftar
            echo "<script>alert('Nomor HP sudah terdaftar.'); window.history.back();</script>";
            exit();
        }

    
        $check_email = mysqli_query($db, "SELECT * FROM pendaftar WHERE email = '$email'"); // Memeriksa apakah email sudah terdaftar
        if (mysqli_num_rows($check_email) > 0) { // Jika email sudah terdaftar
            echo "<script>alert('Email sudah terdaftar.'); window.history.back();</script>";
            exit();
        }

        $sql = "INSERT INTO pendaftar (nama, asal_sekolah, tempat_lahir, tanggal_lahir, alamat, no_hp, agama, jenis_kelamin, email, jurusan) VALUES ('$nama', '$asal_sekolah', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$nomor_hp', '$agama', '$jenis_kelamin', '$email', '$jurusan')";

        if($db->query($sql)){ // Kondisi untuk menjalankan fungsi login
            $message = "pendaftar Berhasil Silahkan Login";
            echo "<script>
                    alert('$message');
                    window.location.href='login.php';
                  </script>";
            exit();
        } else {
            echo "Terjadi kesalahan saat mendaftar.";
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB pendaftar</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<header>
        <div class="container">
            <h1>Selamat Datang di Website pendaftar</h1>
        </div>
    </header>

    <div class="container">
        <h2>Silahkan Daftarkan Data Anda</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan nama Anda" required>
            </div>

            <div class="form-group">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" name="asal_sekolah" id="asal_sekolah" placeholder="Masukkan asal sekolah Anda" required>
            </div>

            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir Anda" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat Anda" required>
            </div>

            <div class="form-group">
                <label for="nomor_hp">Nomor HP</label>
                <input type="number" name="nomor_hp" id="nomor_hp" placeholder="Masukkan nomor HP Anda" required>
            </div>

            <div class="form-group">
                <label for="agama">Agama</label>
                <select name="agama" id="agama" required>
                    <option value="">--Pilih--</option>
                    <option value="islam">Islam</option>
                    <option value="kristen">Kristen</option>
                    <option value="katolik">Katolik</option>
                    <option value="budha">Budha</option>
                    <option value="hindu">Hindu</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="">--Pilih--</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan email Anda" required>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select name="jurusan" id="jurusan" required>
                    <option value="">--Pilih--</option>
                    <option value="rpl">RPL</option>
                    <option value="tkj">TKJ</option>
                    <option value="titl">TITL</option>
                    <option value="dpib">DPIB</option>
                    <option value="tkr">TKR</option>
                </select>
            </div>

            <button type="submit" name="daftar">Daftar</button>
            <p>
            sudah mendaftar? <a href="login.php">Login disini</a>
        </p>
        </form>
        
    </div>
        
</body>
</html>