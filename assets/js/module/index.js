function showHidePassword() {
  const password = document.getElementById("password");
  const icon = document.getElementById("toggleIcon");

  if (password.type === "password") {
    password.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    password.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}

function clearInput() {
  const inputFields = ["username", "password"];

  inputFields.forEach((id) => {
    document.getElementById(id).value = "";
  });
}

function login() {
  // Get the VALUES, not the DOM elements
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value;

  $.ajax({
    url: "functions/login.php",
    type: "POST",
    dataType: "json",
    cache: false,
    data: {
      username: username,
      password: password,
    },
    beforeSend: function () {
      $("#loader").css("display", "flex");
    },
    success: function (response) {
      $("#loader").hide();

      if (response.status === "success") {
        window.location.href = response.redirect;
      } else {
        $("#error").text(response.message);
        clearInput();
      }
    },
    error: function (xhr, status, error) {
      $("#loader").hide();
      console.error("AJAX Error:", error);
      swal.fire({
        icon: "error",
        title: "Something went wrong!",
        text: "Unexpected error occured. Please contact the administrator.",
      });
    },
  });
}

$(function () {
  // Toggle password visibility
  $(document).on("click", "#toggleIcon", function () {
    showHidePassword();
  });

  // Sign in button click
  $(document).on("click", "#btnSignIn", function (e) {
    e.preventDefault(); // Prevent form submit if button is inside a form
    login();
  });

  // Optional: Press Enter to login
  $(document).on("keypress", "#username, #password", function (e) {
    if (e.which === 13) {
      e.preventDefault();
      login();
    }
  });
});
