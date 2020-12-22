$(function() {
  // Clear error message
  $("#error").html("");

  var id = getUrlParameter("id");

  // Initialise date picker
  flatpickr("#datePicker");
  $("#datePicker").flatpickr({});

  $("#datePicker").change(function() {
    var dateObject = $(this).val();
    // Modify next step button url when date picker is changed
    $("#nextStep").attr("href", "../time?id=" + id + "&d="
      + dateObject.toString());
  });

  $("#nextStep").click(function(e) {
    if($("#datePicker").val() == "") {
      $("#error").html("<i>Voer een datum in</i>");
      e.preventDefault();
    }
  });
});
