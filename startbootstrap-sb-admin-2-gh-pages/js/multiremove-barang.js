// Tambahkan event listener pada tombol "Remove"
document.getElementById("removeBtn").addEventListener("click", handleRemove);

// Fungsi untuk menghandle tombol Remove
function handleRemove() {
  var selectedItems = getSelectedItems();

  if (selectedItems.length === 0) {
    alert("Tidak ada barang yang dipilih!");
    return;
  }

  Swal.fire({
    title: "Konfirmasi",
    text: "Apakah Anda yakin ingin menghapus barang yang dipilih?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      // Kirim data yang akan dihapus ke multiremove.php menggunakan AJAX
      var data = {
        idbarang: selectedItems,
      };

      // Contoh penggunaan AJAX dengan jQuery
      $.ajax({
        url: "multiremove.php",
        type: "POST",
        data: data,
        success: function (response) {
          // Handle respon dari server setelah remove sukses
          console.log(response);
          Swal.fire("Sukses", "Barang berhasil dihapus!", "success");

          // Refresh atau lakukan tindakan lain setelah menghapus data
        },
        error: function (xhr, status, error) {
          // Handle error saat melakukan AJAX request
          console.log(error);
          Swal.fire(
            "Error",
            "Terjadi kesalahan saat menghapus barang!",
            "error"
          );
        },
      });
    }
  });
}
