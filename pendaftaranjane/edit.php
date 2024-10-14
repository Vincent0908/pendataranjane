<?php
    include "database/database.php";
    session_start();

    $id = $_GET['id'];
    $sql = "SELECT * FROM pendaftar WHERE id = '$id'";
    $query = mysqli_query($db, $sql);
    $data = mysqli_fetch_array($query);
    
    if(isset($_POST['edit'])){
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

        $sql = "UPDATE pendaftar SET 
            nama = '$nama', 
            asal_sekolah = '$asal_sekolah', 
            tempat_lahir = '$tempat_lahir', 
            tanggal_lahir = '$tanggal_lahir', 
            alamat = '$alamat', 
            no_hp = '$nomor_hp', 
            agama = '$agama', 
            jenis_kelamin = '$jenis_kelamin', 
            email = '$email', 
            jurusan = '$jurusan' 
            WHERE id = '$id'";

        mysqli_query($db, $sql);
        header('Location: dashboard-admin.php'); // Redirect back to the admin page
        exit;
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
            <h1>Selamat Datang </h1>
        </div>
    </header>

    <div class="container">
        <h2>Silahkan edit Data Anda</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="<?php echo $data['nama']; ?>" placeholder="Masukkan nama Anda" required>
            </div>

            <div class="form-group">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" value="<?= $data['asal_sekolah'] ?>" name="asal_sekolah" id="asal_sekolah"  placeholder="Masukkan asal sekolah Anda" required>
            </div>

            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" value="<?= $data['tempat_lahir'] ?>" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir Anda" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" value="<?= $data['tanggal_lahir'] ?>" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" value="<?= $data['alamat'] ?>" name="alamat" id="alamat" placeholder="Masukkan alamat Anda" required>
            </div>

            <div class="form-group">
                <label for="nomor_hp">Nomor HP</label>
                <input type="number" value="<?= $data['no_hp'] ?>" name="nomor_hp" id="nomor_hp" placeholder="Masukkan nomor HP Anda" required>
            </div>

            <div class="form-group">
                <label for="agama">Agama</label>
                <select name="agama" id="agama" required>
                    <option value=""><?= $data['agama'] ?></option>
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
                    <option value=""><?= $data['jenis_kelamin'] ?></option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="<?= $data['email'] ?>" name="email" id="email" placeholder="Masukkan email Anda" required>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select name="jurusan" id="jurusan" required>
                    <option value=""><?= $data['jurusan'] ?></option>
                    <option value="rpl">RPL</option>
                    <option value="tkj">TKJ</option>
                    <option value="titl">TITL</option>
                    <option value="dpib">DPIB</option>
                    <option value="tkr">TKR</option>
                </select>
            </div>

            <button type="submit" name="edit">EDIT</button>
            <p>
            Kembali ke <a href="login.php">Dashboard</a>
        </p>
        </form>
        
    </div>
        
</body>
</html>