<?php
session_start();

if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../../sign/admin/sign_in.php");
  exit;
}
require "../../config/config.php";

$member = queryReadData("SELECT * FROM admin");

if(isset($_POST["search"]) ) {
  $member = searchMember($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style.css">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Petugas terdaftar</title>
     <link rel="icon" href="../../assets/logoh.png" type="image/png">
  </head>
  <body style="background: url(../../assets/bg.jpg) center / cover fixed; ">
  <nav class="navbar fixed-top navbar-expand-lg ">
  <div class="container-fluid bg-primary" >
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
          <a class="nav-link active" aria-current="page" href="../dashboardAdmin.php" style="color: white;">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text" href="tambahpetugas.php">Tambah Petugas</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
    <div class="p-4 mt-5">
      <!--search engine --->
     <form action="" method="post" class="mt-5">
       <div class="input-group d-flex justify-content-end mb-3">
         
       </div>
      </form>
      <label style="color: white;"><h2>List Of Petugas</h2></label>
      <div class="table-responsive mt-3">
        <table class="table table-striped table-hover " >
        <thead class="text-center" style="background-color: black;">
          <tr>
            <th class="bg-success text-light">id</th>
            <th class="bg-success text-light">Nama</th>
            <th class="bg-success text-light">Password</th>
            <th class="bg-success text-light">Kode</th>
            <th class="bg-success text-light">no_tlp</th>
            <th class="bg-success text-light">role</th>
            <th colspan="2" class="bg-success text-light">opsi</th>
          </tr>
        </thead>
      <?php foreach($member as $item) : ?>
      <tr>
        <td><?=$item["id"];?></td>
        <td><?=$item["nama_admin"];?></td>
        <td><?=$item["password"];?></td>
        <td><?=$item["kode_admin"];?></td>
        <td><?=$item["no_tlp"];?></td>
        <td><?=$item["role"];?></td>
        <td>
          <div class="action">
             <a href="deletePetugas.php?id=<?= $item["id"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ?');"><label for="">Hapus</label></a>
           </div>
        </td>
        <td>
          <div class="action">
             <a href="editPetugas.php?id=<?= $item["id"]; ?>" class="btn btn-success" onclick="return confirm('Yakin ingin Update data ?');"><label for="">Edit</label></a>
          </div>
        </td>
       </tr>
      <?php endforeach;?>
    </table>
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