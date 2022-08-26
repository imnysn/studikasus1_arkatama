<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data | Data Pribadi</title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <br>
     <h4><center>TAMBAH DATA</center></h4>
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama=input($_POST["nama"]);
        $ttl=input($_POST["ttl"]);
        $usia=input($_POST["usia"]);
        $keterangan=input($_POST["keterangan"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into anggota (nama,ttl,usia,keterangan) values
		('$nama','$ttl','$usia','$keterangan')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data pribadi gagal disimpan!</div>";

        }

    }
    ?>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" autocomplete="off"required/>

        </div>
        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="ttl" class="form-control" placeholder="Masukan Tempat Lahir" autocomplete="off"required/>

        </div>
        <div class="form-group">
            <label>Usia</label>
            <input type="number" min="1" name="usia" class="form-control" placeholder="Masukan Usia Sekarang" autocomplete="off"required/>
        </div>
        <div class="form-group">
                  <label>Keterangan</label>
                  <select name="keterangan" class="form-control">
                    <option>--- Pilih Ketarangan ---</option>
                    <option value="Remaja">Remaja</option>
                    <option value="Dewasa">Dewasa</option>
                  </select>
                </div>

        <a href="index.php" class="btn btn-danger">Kembali</a>
        <button type="submit" name="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
</body>
</html>