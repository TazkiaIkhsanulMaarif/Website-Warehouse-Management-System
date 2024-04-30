$(document).ready(function () {
  // Event listener for "Tambah Barang" button
  $("#multiInsertForm").on("submit", function (e) {
    e.preventDefault();

    // Display confirmation dialog
    swal({
      title: "Konfirmasi",
      text: "Apakah Anda yakin ingin menambahkan barang-barang ini?",
      icon: "warning",
      buttons: ["Batal", "Tambah"],
      dangerMode: true,
    }).then(function (willAdd) {
      if (willAdd) {
        // Submit the form for multi-insert
        $.ajax({
          type: "POST",
          url: "./ajax/multi-insert-barang.php",
          data: new FormData(this),
          processData: false,
          contentType: false,
          success: function (response) {
            // Handle success response
            swal(
              "Berhasil",
              "Barang-barang telah ditambahkan.",
              "success"
            ).then(function () {
              // Reload the page
              location.reload();
            });
          },
          error: function (xhr, status, error) {
            // Handle error response
            swal(
              "Error",
              "Terjadi kesalahan saat menambahkan barang-barang.",
              "error"
            );
          },
        });
      }
    });
  });
});
