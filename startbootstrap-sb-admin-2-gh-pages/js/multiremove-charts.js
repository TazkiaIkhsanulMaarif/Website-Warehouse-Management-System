$(document).ready(function () {
  $(".btn-remove").on("click", function () {
    var selectedItems = []; // Array untuk menyimpan id_pesanan yang dipilih

    // Mengumpulkan id_pesanan yang dicentang
    $('input[name="selected_items[]"]:checked').each(function () {
      selectedItems.push($(this).val());
    });

    if (selectedItems.length > 0) {
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover the selected items!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          // Mengirim permintaan AJAX untuk menghapus data
          $.ajax({
            url: "./ajax/delete_pesanan.php",
            type: "POST",
            data: {
              id_pesanan: selectedItems,
            },
            success: function (data) {
              console.log(data); // Tambahkan ini untuk melihat respons dari server
              if (data == "success") {
                swal(
                  "Success!",
                  "The selected items have been removed.",
                  "success"
                ).then(() => {
                  // Refresh halaman setelah menghapus data
                  location.reload();
                });
              } else {
                swal("Error!", "Failed to remove the selected items", "error");
              }
            },
            error: function () {
              swal("Error!", "Failed to remove the selected items", "error");
            },
          });
        }
      });
    } else {
      swal(
        "No items selected!",
        "Please select at least one item to remove.",
        "warning"
      );
    }
  });
});
