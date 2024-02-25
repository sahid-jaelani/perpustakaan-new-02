<?php
// Halaman pengelolaan peminjaman buku perpustakaan
require "../../config/config.php";
session_start();
$dataPeminjam = queryReadData("SELECT peminjaman.id_peminjaman, peminjaman.id_buku, buku.judul, peminjaman.nisn, member.nama, member.kelas, member.jurusan, peminjaman.id_admin,  peminjaman.tgl_peminjaman, peminjaman.tgl_pengembalian,peminjaman.status
FROM peminjaman 
INNER JOIN member ON peminjaman.nisn = member.nisn
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku");

if (isset($_POST['submit'])) {
   accBuku($_POST['status']);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style.css">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Kelola peminjaman buku || admin</title>
     <link rel="icon" href="../../assets/logoh.png" type="image/png">
  </head>
  <body style="background: url(../../assets/bg.jpg) center / cover fixed; ">
    
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
    <label style="color: white;"><h2>List of Peminjaman</h2></label>
      <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
        <thead class="text-center">
          <tr>
            <th class="bg-success text-light">Id Peminjaman</th>
            <th class="bg-success text-light">Id Buku</th>
            <th class="bg-success text-light">Judul Buku</th>
            <th class="bg-success text-light">Nisn Siswa</th>
            <th class="bg-success text-light">Nama siswa</th>
            <th class="bg-success text-light">Kelas</th>
            <th class="bg-success text-light">Jurusan</th>
            <th class="bg-success text-light">Id Admin</th>
            <th class="bg-success text-light">Tanggal Peminjaman</th>
            <th class="bg-success text-light">Tanggal Pengembalian</th>
            <th colspan="2" class="bg-success text-light">Status</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($dataPeminjam as $item) : ?>
               <?php if ($item['status'] == 'tidak') { ?>
               <tr>
                  <td><?= $item["id_peminjaman"]; ?></td>
                  <td><?= $item["id_buku"]; ?></td>
                  <td><?= $item["judul"]; ?></td>
                  <td><?= $item["nisn"]; ?></td>
                  <td><?= $item["nama"]; ?></td>
                  <td><?= $item["kelas"]; ?></td>
                  <td><?= $item["jurusan"]; ?></td>
                  <td><?= $item["id_admin"]; ?></td>
                  <td><?= $item["tgl_peminjaman"]; ?></td>
                  <td><?= $item["tgl_pengembalian"]; ?></td>
                  <td>
                     <form action="" method="post">
                        <input type="hidden" value="<?= $item["id_peminjaman"]; ?>" name="status">
                        <button type="submit" id="status" name="submit" class="btn btn-outline-success">Terima</button>
                     </form>
                  </td>
               </tr>
               <?php } else { ?>
               <?php continue; ?>
               <?php } ?>
               <?php endforeach; ?>
        </tbody>

    </table>
    </div>
    </div>
  </div>
  

  <footer class="fixed-bottom shadow-lg bg-subtle p-1" style="color:white;">
      <div class="container-fluid d-flex justify-content-between" >
      <p class="mt-1">Created by <span class="text-info">Sahid Jaelani</span> © 2023</p>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>