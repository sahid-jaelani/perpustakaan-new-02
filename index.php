<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>E-perpus.eo</title>
    <link rel="icon" href="assets/logoh.png" type="image/png">
  </head>
  <body style="background: url(assets/bg.jpg) center / cover fixed; ">
    <!--Navbar-->
   <nav class="navbar fixed-top navbar-expand-lg justify-space-between" >
  <div class="container-fluid bg-primary">
    <img src="assets/logoNav.png" alt="logo" width="220px">
    <a href="sign/link_login.html" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php" style="color: white;">Home</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="sign/link_login.html" style="color: white;">Sign in</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="sign/member/sign_up.php" style="color: white;">Register</a>
        </li>
      </ul>
    </div>
</nav>

    <section id="homeSection" class="p-5" style="backdrop-filter: blur(4px);">
      <div class="d-flex flex-wrap justify-content-center">
        <div class="col mt-5">
          <?php 
          require "config/config.php";
          // query read semua buku
          $buku = queryReadData("SELECT * FROM buku ORDER BY id_buku DESC");
          //search buku
          if(isset($_POST["search"]) ) {
            $buku = search($_POST["keyword"]);
          }
          //read buku informatika
          if(isset($_POST["informatika"]) ) {
          $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'informatika'");
          }
          //read buku bisnis
          if(isset($_POST["bisnis"]) ) {
          $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'bisnis'");
          }
          //read buku filsafat
          if(isset($_POST["filsafat"]) ) {
          $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'filsafat'");
          }
          //read buku novel
          if(isset($_POST["novel"]) ) {
          $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'novel'");
          }
          //read buku sains
          if(isset($_POST["sains"]) ) {
          $buku = queryReadData("SELECT * FROM buku WHERE kategori = 'sains'");
          }
          ?>
<style>
    .layout-card-custom {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem; 
    }

    @media screen and (max-width: 500px) {
  .card {
    width: 7.7rem !important;
  }
  .card-img-top{
    height: 170px !important;
  }
}
    
  </style>
  <!--Btn filter data kategori buku-->
  <div class="d-flex gap-2 mt-2 justify-content-center">
      <form action="" method="post">
        <div class="layout-card-custom">
         <button class="btn btn-outline-light" type="submit">Semua</button>
         <button type="submit" name="informatika" class="btn btn-outline-light">Informatika</button>
         <button type="submit" name="bisnis" class="btn btn-outline-light">Bisnis</button>
         <button type="submit" name="filsafat" class="btn btn-outline-light">Filsafat</button>
         <button type="submit" name="novel" class="btn btn-outline-light">Novel</button>
         <button type="submit" name="sains" class="btn btn-outline-light">Sains</button>
         </div>
        </form>
       </div>
       
       <form action="" method="post" class="mt-2">
       <div class="input-group d-flex justify-content-end mb-5">
         <input class="border p-1 rounded rounded-end-0 bg-tertiary" type="text" name="keyword" id="keyword" placeholder="Cari buku atau kategori...">
         <button class="border border-start-3 bg-outline-primary rounded rounded-start-0" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
       </div>
      </form>
      
      <!--Card buku-->
    <div class="layout-card-custom" style="backdrop-filter: blur(4px);">
       <?php foreach ($buku as $item) : ?>
       <div class="card" style="width: 10rem;">
         <a href="sign/member/sign_in.php"><img src="imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="200px"></a>
         <div class="card-body">
           <h6 class="card-title"><?= $item["judul"]; ?></h6>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Kategori : <?= $item["kategori"]; ?></li>
          </ul>
        </div>
       <?php endforeach; ?>
      </div>
      </div>
    </section>
    
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>