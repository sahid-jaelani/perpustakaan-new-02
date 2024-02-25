<?php 
require "../../config/config.php"; 

$hapus = $_GET["id"];
if(deletePetugas($hapus) > 0) {
    echo "<script>
    alert('Member berhasil dihapus!');
    document.location.href = 'petugas.php';
    </script>";
  }else {
    echo "<script>
    alert('Member gagal dihapus!');
    document.location.href = 'petugas.php';
    </script>";
}
?>
