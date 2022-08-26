<!DOCTYPE html>
<html>
<head>
    <title>Edit Data | Data Pribadi</title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <br>
    <h4><center>EDIT DATA</center></h4>
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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_anggota
    if (isset($_GET['id_data'])) {
        $id_data=input($_GET["id_data"]);

        $sql="select * from anggota where id_data=$id_data";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_data=htmlspecialchars($_POST["id_data"]);
        $nama=input($_POST["nama"]);
        $ttl=input($_POST["ttl"]);
        $usia=input($_POST["usia"]);
        $keterangan=input($_POST["keterangan"]);

        //Query update data pada tabel anggota
        $sql="update anggota set
			nama='$nama',
			ttl='$ttl',
			usia='$usia',
			keterangan='$keterangan'
			where id_data=$id_data";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data pribadi gagal diupdate!</div>";

        }

    }

    ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" placeholder="Masukan Nama Lengkap" autocomplete="off"required/>

        </div>
        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="ttl" class="form-control" value="<?php echo $data['ttl']; ?>" placeholder="Masukan Tempat Lahir" autocomplete="off"required/>
        </div>
        <div class="form-group">
            <label>Usia</label>
            <input type="number" name="usia" class="form-control" value="<?php echo $data['usia']; ?>" placeholder="Masukan Usia Sekarang" autocomplete="off"required/>
        </div>
        <div class="form-group">
                  <label>Keterangan</label>
                  <select name="keterangan" class="form-control">
                    <option>--- Pilih Keterangan ---</option>
                    <option value="Remaja" <?php if ($data['keterangan'] == "Remaja") { echo "selected"; } ?>>Remaja</option>
                    <option value="Dewasa" <?php if ($data['keterangan'] == "Dewasa") { echo "selected"; } ?>>Dewasa</option>
                  </select>
                </div>

        <input type="hidden" name="id_data" value="<?php echo $data['id_data']; ?>" />
        <a href="index.php" class="btn btn-danger">Kembali</a>
        <button type="submit" name="submit" class="btn btn-warning">Simpan</button>
    </form>
</div>
</body>
</html>