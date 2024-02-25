<?php
session_start();

if (!isset($_SESSION["signIn"])) {
   header("Location: ../sign/admin/sign_in.php");
   exit;
}

if (isset($_SESSION['role'])) {
   if ($_SESSION['role'] == 'petugas') {
      header('location: ../DashboardPetugas/dashboardPetugas.php');
   }
} else {
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style.css">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <link rel="icon" href="../assets/logoh.png" type="image/png">
     <title>Admin Dashboard</title>
  </head>
  <body  style="background: url(../assets/bg.jpg) center / cover fixed; ">
    
    <nav class="navbar fixed-top ">
      <div class="container-fluid bg-primary">
        <a class="navbar-brand" href="#">
          <img src="../assets/logoNav.png" alt="logo" width="220px">
        </a>
  
        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../assets/adminLogo.png" alt="adminLogo" width="40px">
          </button>
        <ul style="margin-left: -7rem;" class="dropdown-menu position-absolute mt-3 p-2">
          <li>
            <a class="dropdown-item text-center" href="#">
            <img src="../assets/adminLogo.png" alt="adminLogo" width="30px">
            </a>
          </li>
          <li>
            <a class="dropdown-item text-center text-secondary" href="#"> <span class="text-capitalize"><?php echo $_SESSION['admin']['nama_admin']; ?></a>
            </span>
          </li>
          <hr>
          <li>
            <a class="dropdown-item text-center mb-2" href="#">Akun Terverifikasi <span class="text-primary"><i class="fa-solid fa-circle-check"></i></span></a>
          </li>
          <li>
            <a class="dropdown-item text-center p-2 bg-danger text-light rounded" href="signOut.php">Sign Out <i class="fa-solid fa-right-to-bracket"></i></a>
          </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="mt-5 p-4">
      <?php
      // Mendapatkan tanggal dan waktu saat ini
      $date = date('Y-m-d H:i:s'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)
      // Mendapatkan hari dalam format teks (e.g., Senin, Selasa, ...)
      $day = date('l');
      // Mendapatkan tanggal dalam format 1 hingga 31
      $dayOfMonth = date('d');
      // Mendapatkan bulan dalam format teks (e.g., Januari, Februari, ...)
      $month = date('F');
      // Mendapatkan tahun dalam format 4 digit (e.g., 2023)
      $year = date('Y');
      ?>

      <h1 class="mt-5 fw-bold" style="color: white ;">Dashboard - <span class="fs-4" style="color: white ;"> <?php echo $day. " ". $dayOfMonth." ". " ". $month. " ". $year; ?> </span></h1>
    <br>
      
      <div class="mt-4 p-3">

        <div class="d-flex flex-wrap justify-content-center gap-2">
        <div class="cardImg">
          <a href="member/member.php">
            <img src="../assets/dashboardCardMember/2.png" alt="daftar buku" style="max-width: 100%; border-radius: 5%;" width="200px">
          </a>
        </div>
        <div class="cardImg">
          <a href="buku/daftarBuku.php">
          <img src="../assets/dashboardCardMember/1.png" alt="daftar buku" style="max-width: 100%; border-radius: 5%;" width="200px">
          </a>
        </div>
        <div class="cardImg">
          <a href="petugas/petugas.php">
          <img src="../assets/dashboardCardMember/8.png" alt="daftar buku" style="max-width: 100%; border-radius: 5%;" width="200px">
          </a>
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