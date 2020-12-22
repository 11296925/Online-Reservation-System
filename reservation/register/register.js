$(function() {
  $("#error").html("");

  var error = getUrlParameter('e');
  if (error === '1') {
    $("#error").html("<i>We kunnen dit verzoek momenteel niet verwerken</i>");
  } else if (error === '2') {
    $("#error").html("<i>E-mailadres is verplicht</i>");
  } else if (error === '3' || error === '4') {
    $("#error").html("<i>Naam is verplicht</i>");
  } else if (error === '5') {
    $("#error").html("<i>Wachtword is verplicht</i>");
  } else if (error === '6') {
    $("#error").html("<i>E-mailadres is niet geldig</i>");
  } else if (error === '7' || error === '8') {
    $("#error").html("<i>Naam is niet geldig</i>");
  } else if (error === '9') {
    $("#error").html("<i>Wachtwoord voldoet niet aan eisen</i>");
  } else if (error === '10') {
    $("#error").html("<i>Dit e-mailadres is al in gebruik</i>");
  }
});

function validateRegister() {
  var email = $("#email").val();
  var firstname = $("#firstname").val();
  var lastname = $("#lastname").val();
  var password = $("#password").val();
  var passwordCheck = $("#passwordCheck").val();

  if (email === '' || email === null) {
    $("#error").html("<i>E-mailadres is verplicht</i>");
    return false;
  } else if (!emailValidation(email)) {
    $("#error").html("<i>E-mailadres is niet geldig</i>");
    return false;
  } else if (firstname === '' || firstname === null || lastname === '' || lastname === null) {
    $("#error").html("<i>Naam is verplicht</i>");
    return false;
  } else if (password === '' || password === null) {
    $("#error").html("<i>Wachtword is verplicht</i>");
    return false;
  } else if (password !== passwordCheck) {
    $("#error").html("<i>Wachtwoorden komen niet over een</i>");
    return false;
  } else if (!passwordValidation(password)) {
    $("#error").html("<i>Wachtword voldoet niet aan eisen</i>");
    return false;
  } else {
    return true;
  }
}

function emailValidation(email) {
  var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regex.test(String(email).toLowerCase());
}

function passwordValidation(password) {
  var regex = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}/;
  return regex.test(String(password));
}
