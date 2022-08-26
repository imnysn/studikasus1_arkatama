<!DOCTYPE html>
<html>
<head>
    <title>Data Pribadi</title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <br>
    <h4><center>DATA PRIBADI</center></h4>
<?php

    include "koneksi.php";

    //Cek apakah ada nilai dari method GET dengan nama id_anggota
    if (isset($_GET['id_data'])) {
        $id_data=htmlspecialchars($_GET["id_data"]);

        $sql="delete from anggota where id_data='$id_data' ";
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");

            }
            else {
                echo "<div class='alert alert-danger'> Data pribadi gagal dihapus!</div>";

            }
        }
?>

    <div class="box-header">
             <a class="btn btn-success" href="create.php"><b>Tambah Data</b></a>
           </div>
    <table class="table table-bordered table-hover">
        <br>
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Tempat Lahir</th>
            <th>Usia</th>
            <th>Keterangan</th>
            <th colspan='2'>Aksi</th>

        </tr>
        </thead>
        <?php
        include "koneksi.php";
        $sql="select * from anggota order by id_data desc";

        $hasil=mysqli_query($kon,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["nama"]; ?></td>
                <td><?php echo $data["ttl"];   ?></td>
                <td><?php echo $data["usia"];   ?></td>
                <td><?php echo $data["keterangan"];   ?></td>
                <td>
                    <a href="update.php?id_data=<?php echo htmlspecialchars($data['id_data']); ?>" class="btn btn-warning" role="button">Update</a>
                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_data=<?php echo $data['id_data']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>

</div>
</body>
</html>