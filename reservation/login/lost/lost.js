$(function() {
  // Clear error message
  $("#error").html("");
});

function validateLost() {
  var email = $("#email").val();

  // Check if email field is empty
  if (email === '' || email === null) {
    $("#error").html("<i>Email adres is verplicht</i>");
    return false;
  } else if (!emailValidation(email)) {
    $("#error").html("<i>Email adres is niet geldig</i>");
    return false;
  }

  return true;
}

// Validate email using regular expressions
// (Regex from: http://jsfiddle.net/ghvj4gy9/embedded/result,s/)
function emailValidation(email) {

  var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regex.test(String(email).toLowerCase());
}
