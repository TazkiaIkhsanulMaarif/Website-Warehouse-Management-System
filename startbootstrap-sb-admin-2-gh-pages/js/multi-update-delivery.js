// script.js

$(document).ready(function () {
  function fetch_data() {
    $.ajax({
      url: "./data/get-data-delivery.php",
      method: "POST",
      dataType: "json",
      success: function (data) {
        var html = "";
        for (var count = 0; count < data.length; count++) {
          html += "<tr>";
          html +=
            '<td><input type="checkbox" id="' +
            data[count].id_pengiriman +
            '" data-namalengkap="' +
            data[count].namalenkap +
            '" data-kodetransaksi="' +
            data[count].kodetransaksi +
            '" data-status="' +
            data[count].status +
            '" data-alamat="' +
            data[count].alamat +
            '" data-tgl="' +
            data[count].tgl +
            '" class="check_box updateCheckbox" /></td>';
          html += "<td>" + data[count].namalenkap + "</td>";
          html += "<td>" + data[count].kodetransaksi + "</td>";
          html +=
            '<td><select name="status[]" class="form-control"></select></td>';
          html += "<td>" + data[count].alamat + "</td>";
          html += "<td>" + data[count].tgl + "</td></tr>";
        }
        $("#tableBody").html(html);
      },
    });
  }

  function fetchKodePesanan(callback) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "./ajax/fetch-kodepesanan.php", true);

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        callback(response);
      }
    };

    xhr.send();
  }

  fetch_data();

  $(document).on("click", ".check_box", function () {
    var html = "";
    if (this.checked) {
      var selectHtml = '<select name="status[]" class="form-control"></select>';
      html =
        '<td><input type="checkbox" id="' +
        $(this).attr("id_pengiriman") +
        '" data-namalengkap="' +
        $(this).data("namalengkap") +
        '" data-kodetransaksi="' +
        $(this).data("kodetransaksi") +
        '" data-status="' +
        $(this).data("status") +
        '" data-alamat="' +
        $(this).data("alamat") +
        '" data-tgl="' +
        $(this).data("tgl") +
        '" class="check_box updateCheckbox" checked /></td>';
      html +=
        '<td><input type="text" name="namalengkap[]" class="form-control" value="' +
        $(this).data("namalengkap") +
        '" /></td>';
      html +=
        '<td><input type="text" name="kodetransaksi[]" class="form-control" value="' +
        $(this).data("kodetransaksi") +
        '" /></td>';
      html += "<td>" + selectHtml + "</td>";
      html +=
        '<td><input type="text" name="alamat[]" class="form-control" value="' +
        $(this).data("alamat") +
        '" /></td>';
      html +=
        '<td><input type="text" name="tgl[]" class="form-control" value="' +
        $(this).data("tgl") +
        '" /><input type="hidden" name="hidden_id[]" value="' +
        $(this).attr("id_pengiriman") +
        '" /></td>';
    } else {
      html =
        '<td><input type="checkbox" id="' +
        $(this).attr("id_pengiriman") +
        '" data-namalengkap="' +
        $(this).data("namalengkap") +
        '" data-kodetransaksi="' +
        $(this).data("kodetransaksi") +
        '" data-status="' +
        $(this).data("status") +
        '" data-alamat="' +
        $(this).data("alamat") +
        '" data-tgl="' +
        $(this).data("tgl") +
        '" class="check_box updateCheckbox" /></td>';
      html += "<td>" + $(this).data("namalengkap") + "</td>";
      html += "<td>" + $(this).data("kodetransaksi") + "</td>";
      html += "<td>" + $(this).data("status") + "</td>";
      html += "<td>" + $(this).data("alamat") + "</td>";
      html += "<td>" + $(this).data("tgl") + "</td>";
    }
    $(this).closest("tr").html(html);
    if (this.checked) {
      var selectElement = $(this).closest("tr").find("select[name='status[]']");
      fetchKodePesanan(function (response) {
        for (var i = 0; i < response.length; i++) {
          var option = new Option(response[i].nama, response[i].id);
          selectElement.append(option);
        }
        selectElement.val($(this).data("status"));
      });
    }
  });

  $("#form").on("submit", function (event) {
    event.preventDefault();
    if ($(".check_box:checked").length > 0) {
      $.ajax({
        url: "multiple_update.php",
        method: "POST",
        data: $(this).serialize(),
        success: function () {
          alert("Data Updated");
          fetch_data();
        },
      });
    }
  });
});
