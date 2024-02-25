<?php 
session_start();

if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../../sign/member/sign_in.php");
  exit;
}
require "../../config/config.php";
$idPeminjaman = $_GET["id"];
$query = queryReadData("SELECT peminjaman.id_peminjaman, peminjaman.id_buku, buku.judul, peminjaman.nisn, member.nama, peminjaman.id_admin, peminjaman.tgl_peminjaman, peminjaman.tgl_pengembalian, no_telpon, harga
FROM peminjaman
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN member ON peminjaman.nisn = member.nisn
WHERE peminjaman.id_peminjaman = $idPeminjaman");

// Jika tombol submit kembalikan diklik
if(isset($_POST["kembalikan"]) ) {
  
  if(pengembalian($_POST) > 0) {
    echo "<script>
    alert('Terimakasih telah mengembalikan buku!');window.location='TransaksiPeminjaman.php';
    </script>";
  }else 
    echo "<script>
    alert('Buku gagal dikembalikan');
    </script>";
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style.css">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Form Pengembalian Buku || Member</title>
     <link rel="icon" href="../../assets/logoh.png" type="image/png">
  </head>
  <body style="background: url(../../assets/bg.jpg);">

    
    <div class="p-1 mt-1">
      <div class="card p-3 mt-5">
    <form action="" method="post">
    <h3>Form Pengembalian buku</h3>
    <?php foreach ($query as $item) : ?>
    <div class="mt-3 d-flex flex-wrap gap-3">
     <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Id Peminjaman</label>
      <input type="number" class="form-control" placeholder="id peminjaman" name="id_peminjaman" id="id_peminjaman" value="<?= $item["id_peminjaman"]; ?>" readonly>
    </div>
     <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Id Buku</label>
      <input type="text" class="form-control" placeholder="id peminjaman" name="id_buku" id="id_buku" value="<?= $item["id_buku"]; ?>" readonly>
    </div>
     <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Judul Buku</label>
      <input type="text" class="form-control" placeholder="Judul Buku" name="judul" id="judul" value="<?= $item["judul"]; ?>" readonly>
    </div>
    </div>
    
  <div class="d-flex flex-wrap gap-3">
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Nisn Siswa</label>
      <input type="number" class="form-control" placeholder="Nisn Siswa" name="nisn" id="nisn" value="<?= $item["nisn"]; ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Nama Siswa</label>
      <input type="text" class="form-control" placeholder="Nama Siswa" name="nama" id="nama" value=" <?= $item["nama"]; ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Id Admin Perpustakaan</label>
      <input type="number" class="form-control" placeholder="Id Admin" name="id_admin" id="id_admin" value="<?= $item["id_admin"]; ?>" readonly>
    </div>
    <div class="mb-3">
      <!-- <label for="exampleFormControlInput1" class="form-label">Id Admin Perpustakaan</label> -->
      <input hidden type="text" class="form-control"  name="no_telpon" id="id_admin" value="<?= $item["no_telpon"]; ?>" readonly>
    </div>
  </div>
  
  <div class="d-flex flex-wrap gap-4">
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Tanggal Buku Dipinjam</label>
      <input type="date" class="form-control" name="tgl_peminjaman" id="tgl_peminjaman" value="<?= $item["tgl_peminjaman"]; ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Tenggat Pengembalian Buku</label>
      <input type="date" class="form-control" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= $item["tgl_pengembalian"]; ?>"  oninput="hitungDenda()" readonly>
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Hari Pengembalian Buku</label>
      <input type="date" class="form-control" name="buku_kembali" id="buku_kembali" value="<?php echo date('Y-m-d');?>" oninput="hitungDenda()"> <!--readonly-->
    </div>
  </div>
  <?php endforeach; ?> 
  
  <div class="d-flex flex-wrap gap-4">
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Keterlambatan</label>
      <input type="text" class="form-control" name="keterlambatan" id="keterlambatan" oninput="hitungDenda()" readonly>
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Harga</label>
       <input type="number" class="form-control" name="harga" id="harga" readonly value="<?= $item["harga"]; ?>">
    </div>
  </div>
  <a class="btn btn-danger" href="TransaksiPeminjaman.php"> Batal</a>
  <button type="submit" class="btn btn-success" name="kembalikan">Kembalikan</button>
    </form>
    </div>
  </div>
  <br><br>
  <footer class="fixed-bottom shadow-lg bg-subtle p-1" style="color:white;">
      <div class="container-fluid d-flex justify-content-between" >
      <p class="mt-1">Created by <span class="text-info">Sahid Jaelani</span> © 2023</p>
      </div>
    </footer>
    <!--JAVASCRIPT -->
    <script src="../../style/js/script.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>