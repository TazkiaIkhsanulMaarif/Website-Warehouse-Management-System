$(document).ready(function () {
  // Event listener for address update icon
  $(".updateAddressBtn").click(function () {
    var status = $(this).data("status");
    var id_pengiriman = $(this).data("id");

    // Check if address update is allowed
    if (status === "Pending") {
      // Show the update address modal
      $("#updateAddressModal").modal("show");
      // Set the delivery ID in the modal
      $("#updateAddressModal").data("id-pengiriman", id_pengiriman);
    } else {
      // Address update not allowed
      Swal.fire(
        "Address update not allowed",
        "You cannot update the address for this delivery.",
        "warning"
      );
    }
  });

  // Event listener for save address button
  $("#saveAddressBtn").click(function () {
    var newAddress = $("#newAddress").val();
    var id_pengiriman = $("#updateAddressModal").data("id-pengiriman");

    // Check if newAddress is empty
    if (!newAddress) {
      swal("Error", "Please enter a new address.", "error");
      return;
    }

    // Perform address update action
    $.ajax({
      type: "POST",
      url: "./ajax/updateaddress.php",
      data: {
        newAddress: newAddress,
        id_pengiriman: id_pengiriman,
      },
      success: function (response) {
        // Handle success response
        swal("Success", "Address has been updated.", "success").then(
          (result) => {
            // Reload the page
            location.reload();
          }
        );
      },
      error: function (xhr, status, error) {
        // Handle error response
        swal("Error", "An error occurred while updating the address.", "error");
      },
    });
  });
});
