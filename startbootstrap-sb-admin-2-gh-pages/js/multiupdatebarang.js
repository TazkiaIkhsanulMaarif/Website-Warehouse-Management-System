// Tambahkan event listener pada tombol "Update"
document.getElementById("updateBtn").addEventListener("click", handleUpdate);

// Fungsi untuk menghandle tombol Update
function handleUpdate() {
  var selectedItems = getSelectedItems();

  if (selectedItems.length === 0) {
    alert("Tidak ada barang yang dipilih!");
    return;
  }

  // Lakukan perubahan pada data yang dipilih
  for (var i = 0; i < selectedItems.length; i++) {
    var itemId = sele; // Fungsi untuk menghandle tombol Update
    function handleUpdate() {
      var selectedItems = getSelectedItems();

      if (selectedItems.length === 0) {
        alert("Tidak ada barang yang dipilih!");
        return;
      }

      // Ubah tombol Update menjadi Simpan dan Cancel
      document.getElementById("updateBtn").innerHTML = "Simpan";
      document
        .getElementById("updateBtn")
        .removeEventListener("click", handleUpdate);
      document
        .getElementById("updateBtn")
        .addEventListener("click", handleSave);
      document.getElementById("removeBtn").innerHTML = "Batal";

      // Lakukan perubahan pada semua baris yang diseleksi
      for (var i = 0; i < selectedItems.length; i++) {
        var itemId = selectedItems[i];
        var row = document.querySelector(
          "input[name='idbarang[]'][value='" + itemId + "']"
        ).parentNode.parentNode;
        var namaBarang = row.cells[1].innerHTML;
        var kategori = row.cells[2].innerHTML;
        var ukuran = row.cells[3].innerHTML;
        var harga = row.cells[4].innerHTML;

        // Ubah sel-sel di dalam baris menjadi input fields yang dapat diedit
        row.cells[1].innerHTML =
          "<input type='text' name='namaBarang[]' value='" + namaBarang + "'>";
        row.cells[2].innerHTML =
          "<input type='text' name='kategori[]' value='" + kategori + "'>";
        row.cells[3].innerHTML =
          "<input type='text' name='ukuran[]' value='" + ukuran + "'>";
        row.cells[4].innerHTML =
          "<input type='text' name='harga[]' value='" + harga + "'>";
      }
    }

    // Fungsi untuk menghandle tombol Simpan setelah perubahan pada update
    function handleSave() {
      var selectedItems = getSelectedItems();

      // Kirim data yang akan diupdate ke multi-update.php menggunakan AJAX
      var data = {
        idbarang: selectedItems,
        namaBarang: getUpdatedValues("namaBarang[]"),
        kategori: getUpdatedValues("kategori[]"),
        ukuran: getUpdatedValues("ukuran[]"),
        harga: getUpdatedValues("harga[]"),
      };

      // Contoh penggunaan AJAX dengan jQuery
      $.ajax({
        url: "multi-update.php",
        type: "POST",
        data: data,
        success: function (response) {
          // Handle respon dari server setelah update sukses
          console.log(response);

          // Reset tampilan tabel
          resetTable();
        },
        error: function (xhr, status, error) {
          // Handle error saat melakukan AJAX request
          console.log(error);
        },
      });
    }

    // Fungsi untuk mereset tampilan tabel setelah update atau batal
    function resetTable() {
      var selectedItems = getSelectedItems();

      // Ubah tombol Simpan dan Batal menjadi Update
      document.getElementById("updateBtn").innerHTML = "Update";
      document
        .getElementById("updateBtn")
        .removeEventListener("click", handleSave);
      document
        .getElementById("updateBtn")
        .addEventListener("click", handleUpdate);
      document.getElementById("removeBtn").innerHTML = "Remove";

      // Kembalikan baris yang telah diubah ke tampilan semula
      for (var i = 0; i < selectedItems.length; i++) {
        var itemId = selectedItems[i];
        var row = document.querySelector(
          "input[name='idbarang[]'][value='" + itemId + "']"
        ).parentNode.parentNode;

        var namaBarang = row.cells[1].getElementsByTagName("input")[0].value;
        var kategori = row.cells[2].getElementsByTagName("input")[0].value;
        var ukuran = row.cells[3].getElementsByTagName("input")[0].value;
        var harga = row.cells[4].getElementsByTagName("input")[0].value;

        row.cells[1].innerHTML = namaBarang;
        row.cells[2].innerHTML = kategori;
        row.cells[3].innerHTML = ukuran;
        row.cells[4].innerHTML = harga;
      }
    }

    // Fungsi untuk mendapatkan nilai yang diperbarui dari input fields
    function getUpdatedValues(fieldName) {
      var inputs = document.getElementsByName(fieldName);
      var values = [];

      for (var i = 0; i < inputs.length; i++) {
        values.push(inputs[i].value);
      }

      return values;
    }
    ctedItems[i];

    // Dapatkan input nilai baru dari tabel
    var namaBarang = document.getElementById("namaBarang-" + itemId).value;
    var kategori = document.getElementById("kategori-" + itemId).value;
    var ukuran = document.getElementById("ukuran-" + itemId).value;
    var harga = document.getElementById("harga-" + itemId).value;

    // Kirim data ke update.php menggunakan AJAX
    var data = {
      idbarang: itemId,
      namaBarang: namaBarang,
      kategori: kategori,
      ukuran: ukuran,
      harga: harga,
    };

    // Contoh penggunaan AJAX dengan jQuery
    $.ajax({
      url: "update.php",
      type: "POST",
      data: data,
      success: function (response) {
        // Handle respon dari server setelah update sukses
        console.log(response);
      },
      error: function (xhr, status, error) {
        // Handle error saat melakukan AJAX request
        console.log(error);
      },
    });
  }
}
