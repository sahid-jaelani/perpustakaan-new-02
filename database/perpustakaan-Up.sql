-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 08:09 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `password` varchar(25) NOT NULL,
  `kode_admin` varchar(12) NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `role` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama_admin`, `password`, `kode_admin`, `no_tlp`, `role`) VALUES
(1, 'agung gimang', '1234', 'admin1', '0981726', 'admin'),
(2, 'esti sitanggang', '4321', 'admin2', '085870283409', 'petugas'),
(10, 'Sahid ', '12345', 'Admin4', '098790', 'admin'),
(11, 'Fuadi', '321', 'Fuad44', '09865', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `cover` varchar(255) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` date NOT NULL,
  `jumlah_halaman` int(11) NOT NULL,
  `buku_deskripsi` text NOT NULL,
  `isi_buku` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`cover`, `id_buku`, `kategori`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `jumlah_halaman`, `buku_deskripsi`, `isi_buku`) VALUES
('65cdacca79883.jpg', 'Z01', 'filsafat', 'Sejarah Indonesia ', 'Restu Gunawan, Amurwani Dwi Lestariningsih, dan Sardiman', 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud', '2017-02-15', 287, 'Mengajarkan tentang sejarah Indonesia', 'Kelas X Sejarah BS press.pdf'),
('65cdb0340f492.jpg', 'Z02', 'filsafat', 'PENDIDIKAN  AGAMA KRISTEN DAN BUDI PEKERTI', 'Janse Belandina Non-Serrano ', 'Andar Debataraja Lince Pellu', '2024-02-15', 271, 'Mengajarkan tentang agama Kriten', 'Kristen-BG-KLS-XII.pdf'),
('65cdb26cead35.jpg', 'Z03', 'filsafat', 'Pendididkan Agama Kristen', 'Stephen Suleeman', 'Christina Metallica Samosir', '2017-02-15', 215, 'Memberikan Ilmu yg bermanfaat', 'Kristen Kelas IX Isi BS press.pdf'),
('65cdb3d0e9638.jpg', 'Z04', 'filsafat', 'Matematika', 'Abdur Rahman As’ari', 'Agung Lukito', '2015-02-15', 343, 'Mengajarkan matematika dng baik', 'Matematika Sm1 SMP Kelas 7 BS press.pdf'),
('65cdb9f978ca0.jpg', 'Z05', 'filsafat', 'Pendidikan Pancasila ', 'Dwi Astuti setiawan', 'Kementerian Pendidikan', '2017-02-15', 200, 'Menambah ilmu pancasila', 'Pendidikan-Pancasila-BG-KLS-XII.pdf'),
('65cdbae614863.jpg', 'Z06', 'filsafat', 'Seni Musik', 'Pri Ario damar', 'Pusat Perbukuan Badan Standar', '2017-02-15', 200, 'Mengajarkan seni musik', 'Seni-Musik-BG-KLS-XII.pdf'),
('65d92b772b9f2.jpg', 'ZID07', 'informatika', 'Dasar-dasar Akutansi', 'Indrastuti Ristiyani Solichatun', 'Kementrian Pendidikan ', '2017-02-24', 312, 'memahami dasar akutansi', 'Dasar-Akuntansi-dan-Lembaga-Keuangan-BS-KLS-X.pdf'),
('65d92c299ed1f.jpg', 'ZID08', 'bisnis', 'Dasar Teknik Furnitur', 'Sudarmaji Nadya Mirasanti', 'Kementrian Pendidikan ', '2017-01-19', 146, 'memahami dasar teknik furnitur', 'Dasar-Teknik-Furniture-Semester-2-BS-KLS-X.pdf'),
('65d92cbdbe8db.jpg', 'ZID09', 'novel', 'Dasar-dasar Animasi', 'Nina Tri Daniati', 'Kementrian Pendidikan ', '2022-06-24', 327, 'memahami dasar animasi', 'Dasar-Animasi-BS-KLS-X.pdf'),
('65b1f040e1949.jpg', 'ZID10', 'bisnis', 'Rich Dad Poor Dad (Robert T. Kiyosaki) (z-lib.org)', 'Robert T. Kiyosaki', 'PT Gramedia', '2014-02-02', 100, 'pppp', 'Rich Dad Poor Dad (Robert T. Kiyosaki) (z-lib.org).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`kategori`) VALUES
('bisnis'),
('filsafat'),
('informatika'),
('novel'),
('sains');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `nisn` int(11) NOT NULL,
  `kode_member` varchar(12) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tgl_pendaftaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`nisn`, `kode_member`, `nama`, `password`, `jenis_kelamin`, `kelas`, `jurusan`, `no_tlp`, `tgl_pendaftaran`) VALUES
(12345, '12345', 'sahid', '$2y$10$n36ON1hkXlGd.TyqOqbOm.BA.Rsh4FpgTj2uEy3QjSQkSk83sle5G', 'Laki laki', 'XIII', 'Rekayasa Perangkat Lunak', '098765', '2024-02-09'),
(112211, '121', 'dihas', '$2y$10$P0PAVqSmsuV5RQYkCnxoU./9v0V7A4weKRI8P1mUTlSi.bqpGXOa2', 'Laki laki', 'XII', 'Desain Pemodelan Informasi Bangunan', '0987654', '2024-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `nisn` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status` enum('ya','tidak') NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `nisn` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `buku_kembali` date NOT NULL,
  `keterlambatan` enum('YA','TIDAK') NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_peminjaman`, `id_buku`, `nisn`, `id_admin`, `buku_kembali`, `keterlambatan`, `no_tlp`, `harga`) VALUES
(70, 108, 'ZID09', 12345, 10, '2024-02-24', 'TIDAK', '', 0),
(71, 109, 'ZID10', 12345, 2, '2024-02-24', 'TIDAK', '', 0),
(72, 110, 'ZID08', 12345, 10, '2024-02-24', 'TIDAK', '', 0),
(73, 111, 'ZID09', 12345, 11, '2024-02-24', 'TIDAK', '', 0),
(75, 117, 'ZID09', 12345, 2, '2024-02-24', 'TIDAK', '085870283409', 25000),
(76, 118, 'ZID09', 12345, 11, '2024-02-24', 'TIDAK', '09865', 14000),
(77, 119, 'ZID09', 12345, 2, '2024-02-24', 'TIDAK', '085870283409', 14000),
(78, 120, 'ZID10', 12345, 2, '2024-02-25', 'TIDAK', '085870283409', 25000),
(79, 121, 'ZID10', 112211, 2, '2024-02-25', 'TIDAK', '085870283409', 25000),
(80, 122, 'ZID10', 112211, 2, '2024-02-25', 'TIDAK', '085870283409', 40000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_admin` (`kode_admin`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kategori` (`kategori`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`nisn`),
  ADD UNIQUE KEY `kode_member` (`kode_member`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori_buku` (`kategori`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`nisn`) REFERENCES `member` (`nisn`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `pengembalian_ibfk_3` FOREIGN KEY (`nisn`) REFERENCES `member` (`nisn`),
  ADD CONSTRAINT `pengembalian_ibfk_4` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
