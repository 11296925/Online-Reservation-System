$(function() {
  // Get images for restaurants
  restaurants.forEach(function(item) {
    $.getJSON("api?term=" + item, function(data) {
      $("#restaurant" + item + "img").attr("src", data.url);
    });
  });
});
