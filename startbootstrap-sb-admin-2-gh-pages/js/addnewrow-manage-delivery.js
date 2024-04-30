function addNewRow() {
  var newRow = $("<tr>");

  newRow.append(
    $("<td>").html("<input type='checkbox' class='form-check-input'>")
  );
  newRow.append(
    $("<td>").html(
      "<input type='text' name='nama_lengkap[]' class='form-control'>"
    )
  );
  newRow.append(
    $("<td>").html(
      "<input type='text' name='kode_transaksi[]' class='form-control'>"
    )
  );
  newRow.append(
    $("<td>").html(
      "<select name='status[]' class='form-control'><option value='Pending'>Pending</option><option value='Shipped'>Shipped</option><option value='Delivered'>Delivered</option></select>"
    )
  );
  newRow.append(
    $("<td>").html("<input type='text' name='alamat[]' class='form-control'>")
  );
  newRow.append(
    $("<td>").html("<input type='date' name='tanggal[]' class='form-control'>")
  );
  newRow.append(
    $("<td>").html(
      "<select name='kode_pesanan[]' class='form-control'></select>"
    )
  );

  $("#dataTable tbody").append(newRow);

  // Get the select elements and populate them with options
  var kodePesananSelect = newRow.find("select[name='kode_pesanan[]']");

  getKodePesananOptions(function (kodePesananOptions) {
    kodePesananSelect.html(kodePesananOptions);
  });

  // Checkbox click event
  newRow.find("input[type='checkbox']").on("click", function () {
    var checkbox = $(this);
    var kodePesananSelect = checkbox
      .closest("tr")
      .find("select[name='kode_pesanan[]']");

    if (checkbox.is(":checked")) {
      kodePesananSelect.prop("disabled", false);
    } else {
      kodePesananSelect.prop("disabled", true);
    }
  });

  // Hide the "Multi-Insert" button and show "Simpan", "Batal", and "Add Row" buttons
  $("#multiInsertBtn").hide();

  if ($("#saveBtn").length === 0) {
    var buttonGroupDiv = $("<div>").addClass("btn-group mx-1");

    var saveBtn = $("<button>").html("Simpan").attr({
      onclick: "insertDataAndShowConfirmation()",
      id: "saveBtn",
      type: "button",
      class: "btn btn-success",
    });

    buttonGroupDiv.append(saveBtn);
    $("#form").append(buttonGroupDiv);
  }

  if ($("#cancelBtn").length === 0) {
    var buttonGroupDiv = $("<div>").addClass("btn-group mx-1");

    var cancelBtn = $("<button>").html("Batal").attr({
      onclick: "cancelInsert()",
      id: "cancelBtn",
      type: "button",
      class: "btn btn-danger",
    });

    buttonGroupDiv.append(cancelBtn);
    $("#form").append(buttonGroupDiv);
  }

  if ($("#addRowBtn").length === 0) {
    var buttonGroupDiv = $("<div>").addClass("btn-group mx-1");

    var addRowBtn = $("<button>").html("Add Row").attr({
      onclick: "addNewRow()",
      id: "addRowBtn",
      type: "button",
      class: "btn btn-primary",
    });

    buttonGroupDiv.append(addRowBtn);
    $("#form").append(buttonGroupDiv);
  }
}

function insertDataAndShowConfirmation() {
  var rowData = [];

  $("#dataTable tbody tr").each(function () {
    var data = {};
    $(this)
      .find("input, select")
      .each(function () {
        var name = $(this).attr("name");
        var value = $(this).val().trim();

        if (value === "") {
          swal("Peringatan", "Harap isi semua kolom!", "warning");
          return;
        }

        data[name] = value;
      });

    rowData.push(data);
  });

  if (rowData.length > 0) {
    showConfirmation(rowData);
  }
}

function showConfirmation(rowData) {
  swal({
    title: "Apakah Anda ingin menyimpan data ini?",
    text: JSON.stringify(rowData, null, 2),
    icon: "warning",
    buttons: {
      cancel: "Batal",
      confirm: "Simpan",
    },
  }).then(function (confirm) {
    if (confirm) {
      saveData(rowData);
    }
  });
}

function cancelInsert() {
  $("#dataTable tbody tr").remove();

  $("#dataTable").hide();
  $("#addRowBtn").show();

  $("#saveBtn").remove();
  $("#cancelBtn").remove();

  $("#multiInsertBtn").show();
}

function saveData(rowData) {
  // Kirim data ke server menggunakan AJAX
  $.ajax({
    url: "./ajax/delivery-insert.php",
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify(rowData),
    success: function () {
      swal("Sukses", "Data berhasil disimpan", "success").then(function () {
        resetForm();
      });
    },
    error: function () {
      swal("Gagal", "Terjadi kesalahan saat menyimpan data", "error");
    },
  });
}

function resetForm() {
  $("#dataTable tbody tr").remove();

  $("#saveBtn").hide();
  $("#cancelBtn").hide();
  $("#addRowBtn").hide();

  $("#multiInsertBtn").show();
}

function getKodePesananOptions(callback) {
  // Ambil data kode pesanan dari database menggunakan AJAX
  $.ajax({
    url: "./ajax/delivery-kode-pesanan.php",
    type: "GET",
    success: function (kodePesananList) {
      var kodePesananOptions = "";
      kodePesananList.forEach(function (kodePesanan) {
        kodePesananOptions +=
          "<option value='" + kodePesanan + "'>" + kodePesanan + "</option>";
      });
      callback(kodePesananOptions);
    },
  });
}

function getNamaPengirimOptions(callback) {
  // Ambil data nama pengirim dari database menggunakan AJAX
  $.ajax({
    url: "./ajax/delivery-nama-pengirim.php",
    type: "GET",
    success: function (namaPengirimList) {
      var namaPengirimOptions = "";
      namaPengirimList.forEach(function (namaPengirim) {
        namaPengirimOptions +=
          "<option value='" + namaPengirim + "'>" + namaPengirim + "</option>";
      });
      callback(namaPengirimOptions);
    },
  });
}
