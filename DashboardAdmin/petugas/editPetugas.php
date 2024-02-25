<?php
require '../../config/config.php';
$id = $_GET['id'];
if (isset($_POST["tombol"])) {
   if (editPetugas($_POST, $id) > 0) {
      header('location: ./petugas.php');
   } else {
      echo "<script>
    alert('Gagal update petugas!');
    </script>";
   }
}
$admin = queryReadData("SELECT * FROM admin WHERE id=$id");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style.css">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <link rel="icon" href="../../assets/logoh.png" type="image/png">
     <title>Update || petugas</title>
    </head>
  <body style="background: url(../../assets/bg.jpg) center / cover fixed;">
  <div class="container">
    <div class="card p-2 mt-5">
      <h1 class="pt-5 text-center fw-bold">Tambah Petugas</h1>
      <hr>
    <form action="" method="post" class="row g-3 p-4 needs-validation" novalidate>
      <?php foreach($admin as $item){ ?>
    <label for="validationCustom01" class="form-label">Nama</label>
  <div class="input-group mt-0">
    <span class="input-group-text" id="basic-addon1"></span>
    <input type="text" class="form-control" name="nama" id="validationCustom01" required VALUE="<?= $item["nama_admin"]; ?>">
    <div class="invalid-feedback">
        Nama
    </div>
  </div>
  <label for="validationCustom02" class="form-label">Password</label>
  <div class="input-group mt-0">
    <span class="input-group-text" id="basic-addon1"></span>
    <input type="password" class="form-control" id="validationCustom02" name="password" required value="<?= $item["password"]; ?>">
    <div class="invalid-feedback">
        Password
    </div>
  </div>
  <label for="validationCustom02" class="form-label">Kode</label>
  <div class="input-group mt-0">
    <span class="input-group-text" id="basic-addon1"></span>
    <input type="text" class="form-control" id="validationCustom02" name="kode_petugas" required VALUE="<?= $item["kode_admin"]; ?>">
    <div class="invalid-feedback">
        Kode Admin
    </div>
  </div>
  <label for="validationCustom02" class="form-label">No Tlp</label>
  <div class="input-group mt-0">
    <span class="input-group-text" id="basic-addon1"></span>
    <input type="text" class="form-control" id="validationCustom02" name="no_tlp" required VALUE="<?= $item["no_tlp"]; ?>">
    <div class="invalid-feedback">
        No Tlp
    </div>
  </div>
  <label for="validationCustom02" class="form-label">Role</label>
  <div class="input-group mt-0">
    <span class="input-group-text" id="basic-addon1"></span>
    <select class="form-select" id="" name="role">
        <option value="<?= $item["role"]; ?>"><?= $item["role"]; ?></option>
        <option value="admin">admin</option>
        <option value="petugas">petugas</option>
    </select>
    <?php } ?>
    <div class="invalid-feedback">
        
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-success" type="submit" name="tombol">Update</button>
    <button class="btn btn-warning" type="reset">Reset</button>
    <a class="btn btn-danger" href="petugas.php">Kembali</a>
  </div>
</form>
</div>
<?php if(isset($error)) : ?>
    <div class="alert alert-danger mt-2" role="alert">Nama atau Password Salah!</div>
<?php endif; ?>
  </div>
  
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>