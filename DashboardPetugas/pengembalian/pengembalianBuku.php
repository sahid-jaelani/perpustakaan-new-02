<?php 
//Halaman pengelolaan pengembalian Buku Perustakaaan
require "../../config/config.php";
$dataPeminjam = queryReadData("SELECT pengembalian.id_pengembalian, pengembalian.id_buku, buku.judul, buku.kategori, pengembalian.nisn, member.nama, member.kelas, member.jurusan, admin.nama_admin, pengembalian.buku_kembali, pengembalian.keterlambatan
FROM pengembalian
INNER JOIN buku ON pengembalian.id_buku = buku.id_buku
INNER JOIN member ON pengembalian.nisn = member.nisn
INNER JOIN admin ON pengembalian.id_admin = admin.id")
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style.css">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Kelola pengembalian buku || admin</title>
  </head>
  <body style="background: url(../../assets/bg.jpg) center / cover fixed;">
    
  <nav class="navbar fixed-top navbar-expand-lg ">
  <div class="container-fluid bg-primary">
    <a class="navbar-brand" href="#">
      <img src="../../assets/logoNav.png" alt="logo" width="220px">
        </a>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../dashboardPetugas.php" style="color: white;">Dashboard</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
    <div class="p-4 mt-5">
      <div class="mt-5">
    <label style="color: white; "><h2>List of pengembalian</h2></label>
      <div class="table-responsive mt-3">
    <table class="table table-striped table-hover">
     <thead class="text-center">
      <tr>
        <th class="bg-success text-light">Id Pengembalian</th>
        <th class="bg-success text-light">Id Buku</th>
        <th class="bg-success text-light">Judul Buku</th>
        <th class="bg-success text-light">Kategori</th>
        <th class="bg-success text-light">Nisn</th>
        <th class="bg-success text-light">Nama Siswa</th>
        <th class="bg-success text-light">Kelas</th>
        <th class="bg-success text-light">Jurusan</th>
        <th class="bg-success text-light">Nama Admin</th>
        <th class="bg-success text-light">Tanggal Pengembalian</th>
        <th class="bg-success text-light">Keterlambatan</th>
        <th class="bg-success text-light">Delete</th>
      </tr>
    </thead>
        <?php foreach ($dataPeminjam as $item) : ?>
      <tr>
        <td><?= $item["id_pengembalian"]; ?></td>
        <td><?= $item["id_buku"]; ?></td>
        <td><?= $item["judul"]; ?></td>
        <td><?= $item["kategori"]; ?></td>
        <td><?= $item["nisn"]; ?></td>
        <td><?= $item["nama"]; ?></td>
        <td><?= $item["kelas"]; ?></td>
        <td><?= $item["jurusan"]; ?></td>
        <td><?= $item["nama_admin"]; ?></td>
        <td><?= $item["buku_kembali"]; ?></td>
        <td><?= $item["keterlambatan"]; ?></td>
        <td>
          <div class="action">
           <a href="deletePengembalian.php?id=<?= $item["id_pengembalian"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ?');"><label for="">Hpaus</label></a>
           </div>
          </td>
      </tr>
        <?php endforeach; ?>
    </table>
  </div>
 </div>
</div>
    
<footer class="fixed-bottom shadow-lg bg-subtle p-1" style="color:white;">
      <div class="container-fluid d-flex justify-content-between" >
      <p class="pt-1">Created by <span class="text-info">Sahid Jaelani</span> © 2023</p>
      </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>