
function setReturnDate(select) {
  const returnDateInput = document.getElementById('tgl_pengembalian');
  const currentDate = new Date();
  let returnDate = new Date();

  if (select.value === "1") {
    returnDate.setDate(currentDate.getDate() + 3); 
  } else if (select.value === "2") {
    returnDate.setDate(currentDate.getDate() + 5); 
  } else if (select.value === "3") {
    returnDate.setDate(currentDate.getDate() + 7); 
  }

  // Format tanggal untuk input HTML
  const formattedReturnDate = returnDate.toISOString().split('T')[0];
  returnDateInput.value = formattedReturnDate;
}

function setPrice() {
  const priceInput = document.getElementsByName('harga')[0];
  const paketSelect = document.getElementById('paket');

  // Ambil nilai paket yang dipilih
  const selectedPaket = parseInt(paketSelect.value);

  // Set harga berdasarkan nilai paket
  if (selectedPaket === 1) {
    priceInput.value = 3000;
  } else if (selectedPaket === 2) {
    priceInput.value = 5000;
  } else if (selectedPaket === 3) {
    priceInput.value = 15000;
  }
}

// Panggil fungsi setPrice saat pilihan paket berubah
document.getElementById('paket').addEventListener('change', setPrice);</>

// Fungsi untuk mengatur tanggal pinjam dengan hari ini
function setTodayDate() {
  const todayDateInput = document.getElementById('tgl_peminjaman');
  const currentDate = new Date();

  // Format tanggal untuk input HTML
  const formattedTodayDate = currentDate.toISOString().split('T')[0];
  todayDateInput.value = formattedTodayDate;
}

// Panggil fungsi setTodayDate saat halaman dimuat
window.onload = function() {
  setTodayDate();
};
