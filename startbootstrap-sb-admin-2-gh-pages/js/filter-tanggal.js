$(document).ready(function () {
  $("#datepicker").on("change", function () {
    var selectedDate = $(this).val();
    filterDeliveriesByDate(selectedDate);
  });

  function filterDeliveriesByDate(selectedDate) {
    // Filter the deliveries based on selected date using AJAX
    $.ajax({
      type: "POST",
      url: "./ajax/filter_deliveries.php",
      data: {
        selectedDate: selectedDate,
      },
      success: function (response) {
        // Handle success response
        $("#dataTable tbody").html(response);
      },
      error: function (xhr, status, error) {
        // Handle error response
        console.log(error);
      },
    });
  }
});
