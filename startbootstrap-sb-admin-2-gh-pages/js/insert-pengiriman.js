$(document).ready(function () {
  $(document).on("click", ".btn-purchase", function () {
    var checkboxes = document.getElementsByName("selected_items[]");
    var selectedItems = [];

    // Mengambil nilai dari checkbox yang dipilih
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        selectedItems.push(checkboxes[i].value);
      }
    }

    if (selectedItems.length === 0) {
      swal(
        "No Order Selected",
        "Please select at least one order to proceed.",
        "error"
      );
      return;
    }

    var addresses = []; // Array untuk menyimpan alamat
    var inputDates = []; // Array untuk menyimpan tanggal

    function getAddress() {
      return new Promise(function (resolve, reject) {
        swal({
          title: "Input Address",
          text: "Please enter your address:",
          content: "input",
          button: {
            text: "Proceed",
            closeModal: false,
          },
        }).then(function (address) {
          if (!address) {
            swal("Cancelled", "Your purchase has been cancelled.", "error");
            reject();
          } else {
            addresses = Array(selectedItems.length).fill(address);
            resolve();
          }
        });
      });
    }

    function getInputDate() {
      return new Promise(function (resolve, reject) {
        swal({
          title: "Input Date",
          text: "Please enter the date (DD-MM-YYYY):",
          content: {
            element: "input",
            attributes: {
              type: "date",
            },
          },
          button: {
            text: "Proceed",
            closeModal: false,
          },
        }).then(function (inputDate) {
          if (!inputDate) {
            swal("Cancelled", "Your purchase has been cancelled.", "error");
            reject();
          } else {
            inputDates = Array(selectedItems.length).fill(inputDate);
            resolve(inputDate);
          }
        });
      });
    }

    function getKodePesanan() {
      return new Promise(function (resolve, reject) {
        $.ajax({
          url: "./ajax/get-kode-pesanan.php",
          type: "POST",
          data: {
            id_pesanan: selectedItems.join(","),
          },
          success: function (response) {
            var kodePesanan = response.split(",").map(function (item) {
              return item.trim();
            });
            resolve(kodePesanan);
          },
          error: function (xhr, status, error) {
            reject(error);
          },
        });
      });
    }

    function getIdUser() {
      return new Promise(function (resolve, reject) {
        $.ajax({
          url: "./ajax/get-id-user.php",
          type: "POST",
          data: {
            id_pesanan: selectedItems.toString(),
          },
          success: function (response) {
            var userId = response.split(",").map(function (item) {
              return item.trim();
            });
            resolve(userId);
          },
          error: function (xhr, status, error) {
            reject(error);
          },
        });
      });
    }

    function getIdStatus(inputDate) {
      return new Promise(function (resolve, reject) {
        $.ajax({
          url: "./ajax/get-daftar-status.php",
          type: "POST",
          data: {
            tanggal: inputDate,
          },
          success: function (response) {
            var daftarStatus = response.trim();
            resolve(daftarStatus);
          },
          error: function (xhr, status, error) {
            reject(error);
          },
        });
      });
    }

    getAddress()
      .then(getInputDate)
      .then(getKodePesanan)
      .then(function (kodePesanan) {
        return Promise.all([
          getIdUser(),
          getIdStatus(inputDates[0]),
          Promise.resolve(kodePesanan),
        ]);
      })
      .then(function (results) {
        var userId = results[0];
        var daftarStatus = results[1];
        var kodePesanan = results[2];

        function getIdPengiriman() {
          return new Promise(function (resolve, reject) {
            $.ajax({
              url: "./ajax/insert-daftar-pengiriman.php",
              type: "POST",
              data: {
                kode_pesanan: kodePesanan.join(","),
                alamat: addresses.join(","),
                tanggal: inputDates.join(","),
                idstatus: Array(selectedItems.length)
                  .fill(daftarStatus[0])
                  .join(","),
                id_user: userId.join(","),
              },
              success: function (response) {
                var idPengiriman = response.split(",").map(function (item) {
                  return item.trim();
                });
                resolve(idPengiriman);
              },
              error: function (xhr, status, error) {
                reject(error);
              },
            });
          });
        }

        swal({
          title: "Confirmation",
          text:
            "Are you sure you want to proceed with the purchase?\n\n" +
            "Kode Pesanan: " +
            kodePesanan.join(",") +
            "\n" +
            "Tanggal: " +
            inputDates.join(",") +
            "\n" +
            "Alamat: " +
            addresses.join(",") +
            "\n" +
            "User ID: " +
            userId.join(",") +
            "\n" +
            "ID Pengiriman: ...", // Tempat ID Pengiriman akan ditampilkan
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then(function (confirm) {
          if (confirm) {
            getIdPengiriman()
              .then(function (idPengiriman) {
                var idPengirimanText =
                  "ID Pengiriman: " + idPengiriman.join(",");
                // Update swal dengan ID Pengiriman
                swal({
                  title: "Confirmation",
                  text:
                    "Are you sure you want to proceed with the purchase?\n\n" +
                    "Kode Pesanan: " +
                    kodePesanan.join(",") +
                    "\n" +
                    "Tanggal: " +
                    inputDates.join(",") +
                    "\n" +
                    "Alamat: " +
                    addresses.join(",") +
                    "\n" +
                    "User ID: " +
                    userId.join(",") +
                    "\n" +
                    "Status ID: " +
                    Array(selectedItems.length)
                      .fill(daftarStatus[0])
                      .join(",") +
                    "\n" +
                    idPengirimanText, // Tampilkan ID Pengiriman di sini
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                }).then(function (confirm) {
                  if (confirm) {
                    $.ajax({
                      url: "./ajax/insert_pengiriman.php",
                      type: "POST",
                      data: {
                        id_pengiriman: idPengiriman.join(","),
                        kode_pesanan: kodePesanan.join(","),
                        tanggal: inputDates.join(","),
                        alamat: addresses.join(","),
                        id_user: userId.join(","),
                        idstatus: Array(selectedItems.length)
                          .fill(daftarStatus[0])
                          .join(","),
                      },
                      success: function (response) {
                        console.log(response); // Tambahkan ini untuk melihat respons dari server
                        if (response === "success") {
                          swal(
                            "Success",
                            "Your purchase has been successfully processed.",
                            "success"
                          ).then(() => {
                            // Refresh halaman setelah menghapus data
                            location.reload();
                          });
                        } else {
                          swal("Error", "eror", "error");
                        }
                      },
                      error: function (xhr, status, error) {
                        var errorMessage =
                          "An error occurred while processing your purchase.";

                        if (xhr.status === 0) {
                          errorMessage =
                            "Could not connect to the server. Please check your internet connection.";
                        }

                        swal(
                          "Error",
                          errorMessage + "\n\nError details: " + error,
                          "error"
                        );
                      },
                    });
                  } else {
                    swal(
                      "Cancelled",
                      "Your purchase has been cancelled.",
                      "error"
                    );
                  }
                });
              })
              .catch(function (error) {
                swal(
                  "Error",
                  "An error occurred while retrieving data. Error: " + error,
                  "error"
                );
              });
          } else {
            swal("Cancelled", "Your purchase has been cancelled.", "error");
          }
        });
      })
      .catch(function (error) {
        swal("Error", "An error occurred while retrieving data.", "error");
      });
  });
});
