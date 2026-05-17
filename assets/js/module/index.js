import * as api from "../api/api.js";

async function showHidePassword() {
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

async function clearInput() {
  const inputFields = ["username", "password"];

  inputFields.forEach((id) => {
    document.getElementById(id).value = "";
  });
}

async function login() {
  // Get the VALUES, not the DOM elements
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value;

  try {
    api.showLoader();

    const response = await api.postData(`functions/login.php`, {
      username,
      password,
    });

    if (!response.success) {
      console.error("Server Error: ", response.message);
      swal.fire({
        icon: "error",
        title: "Oops...",
        text: response.message || "Login Failed.",
      });

      $("#error").text(response.message);
      clearInput();

      return false;
    }

    window.location.href = response.redirect;
  } catch (err) {
    console.error("Fetching Error: ", err);
    swal.fire({
      icon: "error",
      title: "Oops...",
      text:
        err.message ||
        "Unexpected error occured. Please contact the administrator.",
    });
  } finally {
    api.hideLoader();
  }
}

$(function () {
  // Toggle password visibility
  $(document).on("click", "#toggleIcon", async function () {
    await showHidePassword();
  });

  // Sign in button click
  $(document).on("click", "#btnSignIn", async function (e) {
    e.preventDefault(); // Prevent form submit if button is inside a form
    await login();
  });

  // Optional: Press Enter to login
  $(document).on("keypress", "#username, #password", async function (e) {
    if (e.which === 13) {
      e.preventDefault();
      await login();
    }
  });
});
