<?php
session_start();

if (!isset($_SESSION["signIn"])) {
   header("Location: ../../sign/member/sign_in.php");
   exit;
}
require "../../config/config.php";
$akunMember = $_SESSION["member"]["nisn"];
$dataPinjam = queryReadData("SELECT peminjaman.id_peminjaman, peminjaman.id_buku, buku.judul, peminjaman.nisn, member.nama, admin.nama_admin, peminjaman.tgl_peminjaman, peminjaman.tgl_pengembalian, peminjaman.status,  no_telpon, harga
FROM peminjaman
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN member ON peminjaman.nisn = member.nisn
INNER JOIN admin ON peminjaman.id_admin = admin.id
WHERE peminjaman.nisn = $akunMember");



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style.css">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Transaksi peminjaman Buku || Member</title>
     <link rel="icon" href="../../assets/logoh.png" type="image/png">
</head>
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
          <a class="nav-link active" aria-current="page" href="../dashboardMember.php" style="color: white;">Dashboard</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
  <div class="p-4 mt-5">
    <div class="mt-5 alert alert-primary" role="alert">Riwayat transaksi Peminjaman Buku Anda <span class="fw-bold text-capitalize"></span></div>
      
      <div class="table-responsive mt-3">
         <table class="table table-striped table-hover">
            <thead class="text-center">
               <tr>
                  <th class="bg-success text-light">Id Peminjaman</th>
                  <th class="bg-success text-light">Id Buku</th>
                  <th class="bg-success text-light">Judul Buku</th>
                  <th class="bg-success text-light">Nisn</th>
                  <th class="bg-success text-light">Nama</th>
                  <th class="bg-success text-light">Nama Admin</th>
                  <th class="bg-success text-light">No telpon</th>
                  <th class="bg-success text-light">Tanggal Peminjaman</th>
                  <th class="bg-success text-light">Tanggal Berakhir</th>
                  <th colspan="2px" class="bg-success text-light">Aksi</th>
               </tr>
            </thead>

            <tr>
               <?php foreach ($dataPinjam as $item) : ?>
               <td><?= $item["id_peminjaman"]; ?></td>
               <td><?= $item["id_buku"]; ?></td>
               <td><?= $item["judul"]; ?></td>
               <td><?= $item["nisn"]; ?></td>
               <td><?= $item["nama"]; ?></td>
               <td><?= $item["nama_admin"]; ?></td>
               <td><?= $item["no_telpon"]; ?></td>
               <td><?= $item["tgl_peminjaman"]; ?></td>
               <td><?= $item["tgl_pengembalian"]; ?></td>
               <td>
               <script>
                function myFunction() {
                alert("Anda harus bayar Rp<?= $item["harga"]; ?>\ndan konfirmasi ke No tlp yang tertera");
                }
              </script>
               <?php if ($item["status"] == 'ya') : ?>
                    <a class="btn btn-primary"href="bacabuku.php?id=<?= $item["id_buku"]; ?>">Baca Buku</a>
                    <a class="btn btn-danger" href="pengembalianBuku.php?id=<?= $item["id_peminjaman"]; ?>">kembalikan</a>
                  <?php elseif ($item["status"] == 'tidak') : ?>
                    <button class="btn btn-warning" onclick="myFunction()">Tunggu Konfirmasi</button>
                  <?php endif; ?>
               </td>
               <?php endforeach; ?>
            </tr>
         </table>
      </div>
   </div>
   <footer class="fixed-bottom shadow-lg bg-subtle p-1" style="color:white;">
      <div class="container-fluid d-flex justify-content-between" >
      <p class="mt-1">Created by <span class="text-info">Sahid Jaelani</span> © 2023</p>
      </div>
    </footer>
  </body>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
 