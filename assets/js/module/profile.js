//api
import * as api from "../api/api.js";

//global variable
let loginid = null;
let roleid = null;

$(document).ready(async function () {
  await getProfileInformation();
});

function resetProfile() {
  $("#firstname").val("").prop("disabled", false);
  $("#lastname").val("").prop("disabled", false);
  $("#email").val("").prop("disabled", false);
  $("#department").val("").prop("disabled", false);
  $("#position").val("").prop("disabled", false);
  $("#username").val("").prop("disabled", false);
  $("#password").val("").prop("disabled", false);
}

async function getProfileInformation() {
  loginid = document.getElementById("LoginID").value;
  try {
    api.showLoader();

    const response = await api.postData(`functions/getProfileInformation.php`, {
      loginid,
    });

    if (!response.success) {
      console.error("Server Error", response.error);
      swal.fire({
        icon: "error",
        title: "Oops...",
        text: "500 Internal server error. Please contact the administrator.",
      });
      return;
    }

    resetProfile();

    const data = response.data[0];

    $("#firstname").val(data.Firstname).prop("disabled", true);
    $("#lastname").val(data.Lastname).prop("disabled", true);
    $("#email").val(data.Email).prop("disabled", true);
    $("#department").val(data.Department).prop("disabled", true);
    $("#position").val(data.Role).prop("disabled", true);
    $("#username").val(data.Username).prop("disabled", true);
    $("#password").val("").prop("disabled", true);
  } catch (err) {
    console.error("Fetching errors: ", err);
    swal.fire({
      icon: "error",
      title: "Oops...",
      text:
        err.message ||
        "Unexpected error occured. Please contact the administrator.",
    });
    return;
  } finally {
    api.hideLoader();
  }
}

$(function () {
  //edit personal information
  $("#personalInfoEditBtn").on("click", function () {
    $("#firstname").prop("disabled", false);
    $("#lastname").prop("disabled", false);
    $("#email").prop("disabled", false);
    $("#department").prop("disabled", false);
    $("#position").prop("disabled", false);

    api.hideButton("personalInfoEditBtn");
    api.showButton("personalInfoUpdateBtn");
  });

  //edit security information
  $("#securityInfoEditBtn").on("click", function () {
    $("#username").prop("disabled", false);
    $("#password").prop("disabled", false);

    api.hideButton("securityInfoEditBtn");
    api.showButton("securityInfoUpdateBtn");
  });

  //update personal information
  $("#personalInfoUpdateBtn").on("click", async function () {
    loginid = $("#LoginID").val();
    roleid = $("#RoleID").val();
    const firstname = $("#firstname").val();
    const lastname = $("#lastname").val();
    const email = $("#email").val();
    const department = $("#department").val();
    const position = $("#position").val();

    try {
      api.showLoader();

      const response = await api.postData(
        `functions/updatePersonalInformation.php`,
        {
          loginid,
          roleid,
          firstname,
          lastname,
          email,
          department,
          position,
        },
      );

      if (!response.success) {
        console.error("Server error: ", response.error);
        swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Failed to update personal information. Please contact the administrator.",
        });
        return;
      }

      swal.fire({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        icon: "success",
        timer: 3000,
        title: "Personal Information updated successfully!",
      });

      await getProfileInformation();
      api.showButton("personalInfoEditBtn");
      api.hideButton("personalInfoUpdateBtn");
    } catch (err) {
      console.error("Fetching errors: ", err);
      swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Unexpected error occured. Please contact the administrator.",
      });
      return;
    } finally {
      api.hideLoader();
    }
  });
});
