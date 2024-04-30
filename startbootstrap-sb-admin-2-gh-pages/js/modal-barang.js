$(document).ready(function () {
  $("#barangModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_pengiriman = button.data("id"); // Extract ID Pengiriman from data-id attribute
    var modal = $(this);

    // Clear the list of ordered items
    modal.find("#orderedItemsList").empty();

    // Fetch the ordered items via AJAX
    $.ajax({
      url: "./ajax/fetch_ordered_items.php", // File that fetches the ordered items
      method: "POST",
      data: {
        id_pengiriman: id_pengiriman,
      },
      dataType: "json",
      success: function (response) {
        // Populate the list of ordered items
        modal
          .find(".modal-title")
          .text("Ordered Items - ID Pengiriman: " + id_pengiriman);

        if (response.length > 0) {
          var orderedItemsList = $("<ul></ul>"); // Create a new unordered list
          $.each(response, function (index, item) {
            orderedItemsList.append("<li>" + item.nama_brg + "</li>"); // Append each item as a list item
          });
          modal.find("#orderedItemsList").append(orderedItemsList); // Append the list to the modal body
        } else {
          modal.find("#orderedItemsList").append("<li>No items found.</li>");
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        var errorMessage = "Error retrieving ordered items.";

        if (jqXHR.status === 400) {
          var response = JSON.parse(jqXHR.responseText);
          if (response.error) {
            errorMessage += " " + response.error;
          }
        }

        modal
          .find("#orderedItemsList")
          .append("<li>" + errorMessage + " " + errorThrown + "</li>");

        // Show Swal error notification
        swal("Error", errorMessage, "error");
      },
    });
  });
});
