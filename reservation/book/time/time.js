var selectedTime = 0;

$(function() {
  // Clear error message
  $("#error").html("");

  // Get url parameters
  var id = getUrlParameter("id");
  var date = getUrlParameter("d");

  /*
  bookedTimes.forEach(function(elem) {
    $("#" + elem).css("background-color", "#ffcc99");
    $("#" + elem).css("opcaity", "0.2");
  });
  */

  $(".timebutton").click(function(e) {
    // Reset current selected time color
    if (selectedTime !== 0) {
      $("#" + selectedTime).css("background-color", "lightgrey");
    }

    // Set current selected time color
    //if (!bookedTimes.includes(selectedTime)) {
    $(this).css("background-color", "#66ccff");
    //}

    selectedTime = parseInt(this.id);

    // Update next step button url parameters
    $("#nextStep").attr("href", "../table?id=" + id + "&d=" + date + "&t=" + selectedTime);
  });

  $("#nextStep").click(function(e) {
    if(selectedTime == 0) {
      $("#error").html("<i>Selecteer een tijd</i>");
      e.preventDefault();
    }
  });
});
