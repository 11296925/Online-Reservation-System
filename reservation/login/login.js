$(function() {
  // Clear error message
  $("#error").html("");

  // Check if login method returned error and display error to user
  var error = getUrlParameter('e');
  if (error === '1') {
    $("#error").html("<i>We kunnen dit verzoek momenteel niet verwerken</i>");
  } else if (error === '2') {
    $("#error").html("<i>E-mailadres is verplicht</i>");
  } else if (error === '3') {
    $("#error").html("<i>Wachtword is verplicht</i>");
  } else if (error === '4') {
    $("#error").html("<i>Het e-mailadres of wachtwoord is onjuist</i>");
  }
});

function validateLogin() {
  var email = $("#email").val();
  var password = $("#password").val();

  if (email === '' || email === null) {
    $("#error").html("<i>Email adres is verplicht</i>");
    return false;
  } else if (password === '' || password === null) {
    $("#error").html("<i>Wachtword is verplicht</i>");
    return false;
  }

  return true;
}
