  <?php
  $host = "127.0.0.1";
  $username = "root";
  $password = "";
  $database_name = "perpustakaan";
  $connection = mysqli_connect($host, $username, $password, $database_name);

  // === FUNCTION KHUSUS ADMIN START ===

  // MENAMPILKAN DATA KATEGORI BUKU
  function queryReadData($dataKategori) {
    global $connection;
    $result = mysqli_query($connection, $dataKategori);
    $items = [];
    while($item = mysqli_fetch_assoc($result)) {
      $items[] = $item;
    }     
    return $items;
  } 

  // Menambahkan data buku 
  function tambahBuku($dataBuku) {
    global $connection;
    
    $cover = upload();
    $idBuku = htmlspecialchars($dataBuku["id_buku"]);
    $kategoriBuku = $dataBuku["kategori"];
    $judulBuku = htmlspecialchars($dataBuku["judul"]);
    $pengarangBuku = htmlspecialchars($dataBuku["pengarang"]);
    $penerbitBuku = htmlspecialchars($dataBuku["penerbit"]);
    $tahunTerbit = $dataBuku["tahun_terbit"];
    $jumlahHalaman = $dataBuku["jumlah_halaman"];
    $deskripsiBuku = htmlspecialchars($dataBuku["buku_deskripsi"]);
    $isi_buku = upload_isi();

    if(!$cover || !$isi_buku) {
      return 0;
  } 
    
    $queryInsertDataBuku = "INSERT INTO buku VALUES('$cover', '$idBuku', '$kategoriBuku', '$judulBuku', '$pengarangBuku', '$penerbitBuku', '$tahunTerbit', $jumlahHalaman, '$deskripsiBuku','$isi_buku')";
    
    mysqli_query($connection, $queryInsertDataBuku);
    return mysqli_affected_rows($connection);
    
  }       

  // Function upload gambar 
  function upload() {
    $namaFile = $_FILES["cover"]["name"];
    $ukuranFile = $_FILES["cover"]["size"];
    $error = $_FILES["cover"]["error"];
    $tmpName = $_FILES["cover"]["tmp_name"];
    
    // cek apakah ada gambar yg diupload
    if($error === 4) {
      echo "<script>
      alert('Silahkan upload cover buku terlebih dahulu!')
      </script>";
      return 0;
    }
    
    // cek kesesuaian format gambar
    $jpg = "jpg";
    $jpeg = "jpeg";
    $png = "png";
    $svg = "svg";
    $bmp = "bmp";
    $psd = "psd";
    $tiff = "tiff";
    $formatGambarValid = [$jpg, $jpeg, $png, $svg, $bmp, $psd, $tiff];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if(!in_array($ekstensiGambar, $formatGambarValid)) {
      echo "<script>
      alert('Format file tidak sesuai');
      </script>";
      return 0;
    }
    
    // batas ukuran file
    if($ukuranFile > 200000000) {
      echo "<script>
      alert('Ukuran file terlalu besar!');
      </script>";
      return 0;
    }
    
    //generate nama file baru, agar nama file tdk ada yg sama
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;
    
    move_uploaded_file($tmpName, '../../imgDB/' . $namaFileBaru);
    return $namaFileBaru;
  } 

  //upload isi buku dengan format pdf
  function upload_isi(){
    $namaFile = $_FILES['isi_buku']['name'];
    $x = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($x));
    $ukuranFile = $_FILES['isi_buku']['size'];
    $file_tmp = $_FILES['isi_buku']['tmp_name'];

    // Lokasi Penempatan file
    $dirUpload = "../../isi-buku/";
    $linkBerkas = $dirUpload . $namaFile;

    // Validasi Format File (contoh: hanya menerima format PDF)
    if ($ekstensiFile !== 'pdf') {
        echo "<script>
        alert('Format file tidak sesuai. Hanya file PDF yang diperbolehkan.');
        </script>";
        return 0;
    }

    // Kontrol Ukuran File (contoh: maksimum 2MB)
    if ($ukuranFile > 2000000000000) {
        echo "<script>
        alert('Ukuran file terlalu besar. Maksimum 2MB.');
        </script>";
        return 0;
    }

    // Menyimpan file
    if (move_uploaded_file($file_tmp, $linkBerkas)) {
        return $namaFile;
    } else {
        echo "<script>
        alert('Gagal mengunggah file. Silakan coba lagi.');
        </script>";
        return 0;
    }
  }


  // MENAMPILKAN SESUATU SESUAI DENGAN INPUTAN USER PADA * SEARCH ENGINE *
  function search($keyword) {
    // search data buku
    $querySearch = "SELECT * FROM buku 
    WHERE
    judul LIKE '%$keyword%' OR
    kategori LIKE '%$keyword%'
    ";
    return queryReadData($querySearch);
    
    // search data pengembalian || member
    $dataPengembalian = "SELECT * FROM pengembalian 
    WHERE 
    id_pengembalian '%$keyword%' OR
    id_buku LIKE '%$keyword%' OR
    judul LIKE '%$keyword%' OR
    kategori LIKE '%$keyword%' OR
    nisn LIKE '%$keyword%' OR
    nama LIKE '%$keyword%' OR
    nama_admin LIKE '%$keyword%' OR
    tgl_pengembalian LIKE '%$keyword%' OR
    keterlambatan LIKE '%$keyword%' OR
    denda LIKE '%$keyword%'";
    return queryReadData($dataPengembalian);
  }

  function searchMember ($keyword) {
      // search member terdaftar || admin
    $searchMember = "SELECT * FROM member WHERE 
    nisn LIKE '%$keyword%' OR 
    kode_member LIKE '%$keyword%' OR
    nama LIKE '%$keyword%' OR 
    jurusan LIKE '%$keyword%'
    ";
    return queryReadData($searchMember);
  }

  function anjay ($keyword) {
    // auto no tlp
  $autoSearch = "SELECT * FROM admin WHERE 
  no_tlp LIKE '%$keyword%'
  ";
  return queryReadData($anjay);
}


  // DELETE DATA Buku
  function delete($bukuId) {
    global $connection;
    $queryDeleteBuku = "DELETE FROM buku WHERE id_buku = '$bukuId'
    ";
    mysqli_query($connection, $queryDeleteBuku);
    
    return mysqli_affected_rows($connection);
  }

  // UPDATE || EDIT DATA BUKU 
  function updateBuku($dataBuku) {
    global $connection;

    $gambarLama = htmlspecialchars($dataBuku["coverLama"]);
    $idBuku = htmlspecialchars($dataBuku["id_buku"]);
    $kategoriBuku = $dataBuku["kategori"];
    $judulBuku = htmlspecialchars($dataBuku["judul"]);
    $pengarangBuku = htmlspecialchars($dataBuku["pengarang"]);
    $penerbitBuku = htmlspecialchars($dataBuku["penerbit"]);
    $tahunTerbit = $dataBuku["tahun_terbit"];
    $jumlahHalaman = $dataBuku["jumlah_halaman"];
    $deskripsiBuku = htmlspecialchars($dataBuku["buku_deskripsi"]);
    
    
    // pengecekan mengganti gambar || tidak
    if($_FILES["cover"]["error"] === 4) {
      $cover = $gambarLama;
    }else {
      $cover = upload();
    }
    // 4 === gagal upload gambar

    // 0 === berhasil upload gambar
    
    $queryUpdate = "UPDATE buku SET 
    cover = '$cover',
    id_buku = '$idBuku',
    kategori = '$kategoriBuku',
    judul = '$judulBuku',
    pengarang = '$pengarangBuku',
    penerbit = '$penerbitBuku',
    tahun_terbit = '$tahunTerbit',
    jumlah_halaman = $jumlahHalaman,
    buku_deskripsi = '$deskripsiBuku'
    WHERE id_buku = '$idBuku'
    ";
    
    mysqli_query($connection, $queryUpdate);
    return mysqli_affected_rows($connection);
  }

  // Hapus member yang terdaftar
  function deleteMember($nisnMember) {
    global $connection;
    
    $deleteMember = "DELETE FROM member WHERE nisn = $nisnMember";
    mysqli_query($connection, $deleteMember);
    return mysqli_affected_rows($connection);
  }

  // hapus petugas
  function deletePetugas($hapus) {
    global $connection;
    
    $deletepetugas = "DELETE FROM admin WHERE id = $hapus";
    mysqli_query($connection, $deletepetugas);
    return mysqli_affected_rows($connection);
  }

  // Hapus history pengembalian data BUKU
  function deleteDataPengembalian($idPengembalian) {
    global $connection;
    
    $deleteDataPengembalianBuku = "DELETE FROM pengembalian WHERE id_pengembalian = $idPengembalian";
    mysqli_query($connection, $deleteDataPengembalianBuku);
    return mysqli_affected_rows($connection);
  }


  // === FUNCTION KHUSUS ADMIN END ===


  // === FUNCTION KHUSUS MEMBER START ===


  // Peminjaman BUKU
  function pinjamBuku($dataBuku) {
    global $connection;
    
    $idBuku = $dataBuku["id_buku"];
    $nisn = $dataBuku["nisn"];
    $idAdmin = $dataBuku["id"];
    $tgl_peminjaman = $dataBuku["tgl_peminjaman"];
    $tgl_pengembalian = $dataBuku["tgl_pengembalian"];
    $no_telpon = $dataBuku["no_telpon"];
    $harga = $dataBuku["harga"];


    // cek apakah user memiliki denda 
    

    
    // cek batas user meminjam buku berdasarkan nisn 
    $nisnResult = mysqli_query($connection, "SELECT nisn FROM peminjaman WHERE nisn = $nisn");
    if(mysqli_fetch_assoc($nisnResult)) {
      echo "<script>
      alert('Anda sudah meminjam buku, Harap kembalikan dahulu buku yg anda pinjam!');window.location='../dashboardMember.php';
      </script>";
      return 0;
    }
    
    $queryPinjam = "INSERT INTO peminjaman(id_peminjaman, id_buku, nisn, id_admin, tgl_peminjaman, tgl_pengembalian, status, no_telpon, harga) VALUES ('', '$idBuku', $nisn, $idAdmin, '$tgl_peminjaman', '$tgl_pengembalian','tidak', '$no_telpon', '$harga')";
    mysqli_query($connection, $queryPinjam);
    return mysqli_affected_rows($connection);
  }

  // Pengembalian BUKU
  function pengembalian($dataBuku) {
    global $connection;
    
    // Variabel pengembalian
    $idPeminjaman = $dataBuku["id_peminjaman"];
    $idBuku = $dataBuku["id_buku"];
    $nisn = $dataBuku["nisn"];
    $idAdmin = $dataBuku["id_admin"];
    $tenggatPengembalian = $dataBuku["tgl_pengembalian"];
    $bukuKembali = $dataBuku["buku_kembali"];
    $keterlambatan = $dataBuku["keterlambatan"];
    $no_telpon = $dataBuku["no_telpon"];
    $harga = $dataBuku["harga"];
    
    if($bukuKembali > $tenggatPengembalian) {
      echo "<script>
      alert('Anda terlambat mengembalikan buku, harap bayar denda sesuai dengan jumlah yang ditentukan!');
      </script>";
    }
    
    // Menghapus data siswa yang sudah mengembalikan buku
    $hapusDataPeminjam = "DELETE FROM peminjaman WHERE id_peminjaman = $idPeminjaman";

    // Memasukkan data kedalam tabel pengembalian
    $queryPengembalian = "INSERT INTO pengembalian VALUES(null, $idPeminjaman, '$idBuku', $nisn, $idAdmin, '$bukuKembali', '$keterlambatan',  '$no_telpon', '$harga')";

    
    mysqli_query($connection, $hapusDataPeminjam);
    mysqli_query($connection, $queryPengembalian);
    return mysqli_affected_rows($connection);
  }

  function bayarDenda($data) {
    global $connection;
    $idPengembalian = $data["id_pengembalian"];
    $jmlDenda = $data["denda"];
    $jmlDibayar = $data["bayarDenda"];
    $calculate = $jmlDenda - $jmlDibayar;
    
    $bayarDenda = "UPDATE pengembalian SET denda = $calculate WHERE id_pengembalian = $idPengembalian";
    mysqli_query($connection, $bayarDenda);
    return mysqli_affected_rows($connection);
  }

  // === FUNCTION KHUSUS MEMBER END ===


  function pengembalianBuku($nisn)
  {
    global $connection;
    $sql_peminjaman = "SELECT * FROM peminjaman WHERE nisn=$nisn";
    $data_peminjaman = mysqli_query($connection, $sql_peminjaman);
    $result = mysqli_fetch_assoc($data_peminjaman);
    $hasil = mysqli_num_rows($data_peminjaman);

    if ($hasil > 0) {
      $id_peminjaman = $result['id_peminjaman'];
      $id_buku = $result['id_buku'];
      $nisn = $result['nisn'];
      $id_admin = $result['id_admin'];
      $tgl_peminjaman = $result['tgl_peminjaman'];
      $tgl_pengembalian = $result['tgl_pengembalian'];

      $tgl = date("Y-m-d");

      if ($tgl == $tgl_pengembalian) {


        $pengembalian = "INSERT INTO pengembalian(id_pengembalian, id_peminjaman, id_buku, nisn, id_admin, buku_kembali, keterlambatan) VALUES ('',$id_peminjaman,'$id_buku',$nisn,$id_admin,$tgl_pengembalian,'tidak')";
        $peminjaman = "DELETE FROM peminjaman WHERE nisn=$nisn";
        mysqli_query($connection, $pengembalian);
        mysqli_query($connection, $peminjaman);
        return true;
      }
    } else {
      return false;
    }
  }

  function accBuku($id_peminjaman)
  {
    global $connection;

    $sql = "UPDATE peminjaman SET status='ya' WHERE id_peminjaman='$id_peminjaman'";
    $result = mysqli_query($connection, $sql);


    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // Tambah petugas 
  function insertPetugas($data)
  {
    global $connection;

    $nama = $data['nama'];
    $password = $data['password'];
    $kode_petugas = $data['kode_petugas'];
    $no_tlp = $data['no_tlp'];
    $role = $data['role'];

    $sql = "INSERT INTO admin(id, nama_admin, password, kode_admin, no_tlp, role) VALUES ('','$nama','$password','$kode_petugas','$no_tlp','$role')";
    mysqli_query($connection, $sql);
    return mysqli_affected_rows($connection);
  }


  // Edit Petugas
  function editPetugas($data, $id)
  {
    global $connection;

    $nama = $data['nama'];
    $password = $data['password'];
    $kode_petugas = $data['kode_petugas'];
    $no_tlp = $data['no_tlp'];
    $role = $data['role'];

    $sql = "UPDATE admin SET nama_admin='$nama',password='$password',kode_admin='$kode_petugas',no_tlp='$no_tlp',role='$role' WHERE id=$id";
    mysqli_query($connection, $sql);
    return mysqli_affected_rows($connection);
  }


  ?>


