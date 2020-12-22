var selectedTable;

$(function() {
  // Clear error message
  $("#error").html("");

  // Get reservation information from url parameters
  var id = getUrlParameter("id");
  var date = getUrlParameter("d");
  var time = getUrlParameter("t");

  // Initialise maphilighting
  $(".map").maphilight({
    fillColor: '000088',
    stroke: false,
    fillOpacity: 0.5,
  });

  $('.table').click(function(e) {
    // If table is not booked yet
    if (!$(this).hasClass('booked')) {
      // Get currently selected table and disable its highlight
      var prevTableData = $("#" + selectedTable).mouseout().data('maphilight') || {};
      prevTableData.alwaysOn = false;
      $("#" + selectedTable).data('maphilight', prevTableData).trigger('alwaysOn.maphilight');

      // Get new selected table
      var tableData = $(this).mouseout().data('maphilight') || {};
      var tableID = parseInt($(this).attr("id"));

      selectedTable = parseInt(tableID);

      // Enable selected table highlight
      tableData.alwaysOn = true;
      $(this).data('maphilight', tableData).trigger('alwaysOn.maphilight');

      // Update next step button url parameters
      $("#nextStep").attr("href", "../review?id=" + id + "&d=" + date + "&t=" + time + "&ta=" + selectedTable);
    }
  });

  // Highlight all booked tables in red
  var data = $('.table.booked').mouseout().data('maphilight') || {};
  data.alwaysOn = true;
  data.fillColor = '880000';
  $('.table.booked').data('maphilight', data).trigger('alwaysOn.maphilight');

  $("#nextStep").click(function(e) {
    if(selectedTable == undefined) {
      $("#error").html("<i>Selecteer een tafel</i>");
      e.preventDefault();
    }
  });
});
