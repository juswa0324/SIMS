//api
import * as api from "../api/api.js";

$(document).ready(async function () {
  const loginID = document.getElementById("LoginID");

  if (loginID) {
    await populate_sidebar();
  }
});

async function populate_sidebar() {
  const permission = document.getElementById("Permission").value || null;
  const sidebar = document.querySelector("#sidebar-menu");
  if (!sidebar) return console.error("Sidebar not found");

  const items = JSON.parse(permission);

  // STEP 1: Build tree from flat list
  const itemsById = {};
  items.forEach((i) => {
    i.children = [];
    itemsById[i.id] = i;
  });

  const tree = [];
  items.forEach((i) => {
    if (!i.parentID) {
      tree.push(i); // top-level
    } else if (itemsById[i.parentID]) {
      itemsById[i.parentID].children.push(i); // attach to parent
    }
  });

  // STEP 2: Collect all links for backend resolution
  const linksSet = new Set();
  (function collectLinks(items) {
    items.forEach((i) => {
      if (i.link && !i.link.includes("()")) linksSet.add(i.link);
      if (i.children.length) collectLinks(i.children);
    });
  })(tree);

  // STEP 3: Recursive rendering
  function renderMenu(items) {
    const ul = document.createElement("ul");
    ul.className = "sidebar-menu pl-0";

    function renderItems(items, parentUl) {
      items.forEach(async (item) => {
        if (item.Deleted === 1) return;

        const li = document.createElement("li");
        li.className = "nav-item";
        if (item.children.length) li.classList.add("treeview");
        li.id = item.id || item.Permission[0].toLowerCase();

        // Add arrow if has children
        const arrow = item.children.length
          ? '<i class="right fas fa-angle-left"></i>'
          : "";

        const a = document.createElement("a");
        a.className = "nav-link";
        a.innerHTML = `<i class="${item.icon}"></i> <p>${item.Permission}${arrow}</p>`;

        // Set link
        if (item.link && item.link.includes("()")) {
          li.setAttribute("onclick", item.link);
          a.href = "javascript:void(0)";
        } else {
          a.href = item.link || "#";
        }

        li.appendChild(a);

        a.addEventListener("click", async (e) => {
          e.preventDefault();

          const link = item.link;

          if (!item.link) return;

          const allowed = await validateLinkPermission(link);

          if (!allowed) return;

          window.location.href = link;
        });

        // Recursively render children
        if (item.children.length) {
          const subUl = document.createElement("ul");
          subUl.className = "nav nav-treeview pl-1";
          renderItems(item.children, subUl);
          li.appendChild(subUl);
        }

        parentUl.appendChild(li);
      });
    }

    renderItems(items, ul);
    return ul;
  }

  sidebar.innerHTML = "";
  sidebar.appendChild(renderMenu(tree));
}

async function validateLinkPermission(link) {
  try {
    api.showLoader();

    let isValid = true;

    const response = await api.postData(
      `functions/validateLinkPermission.php`,
      {
        link,
      },
    );

    if (!response.success) {
      console.error("Server error: ", response.error);
      swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Failed to validate link permission.",
      });
      return;
    }

    if (!response.hasAccess) {
      console.error("Error: Access Denied!");
      const returnToPreviousPage = (
        await swal.fire({
          icon: "error",
          title: "Access Denied!",
        })
      ).isConfirmed;

      if (!returnToPreviousPage) return;

      window.location.reload();

      isValid = false;
    }

    return isValid;
  } catch (err) {
    console.error("Fetching Errors: ", err);
    swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Unexpected error occured. Please contact the administrator.",
    });
    return;
  } finally {
    api.hideLoader();
  }
}

// SESSION ERRORS
async function validate_session() {
  try {
    api.showLoader();

    const response = await api.getData("functions/validate_session.php");

    if (!response.success) {
      console.error("Server Error:", response.error);
      swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Failed to validate session. Please contact the administrator.",
      });
      return;
    }

    if (!response.active) {
      const backToLoginPage = (
        await swal.fire({
          icon: "info",
          title: "Your session has expired!",
          text: "You will be redirected to login page.",
        })
      ).isConfirmed;

      if (!backToLoginPage) return;

      window.location.replace("index.php");
    }

    $("#result").html("<p>User is logged in.</p>");
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
}

$(function () {
  $(document).on("mouseenter", ".sidebar-menu a", function () {
    const $this = $(this);
    $this
      .data("prehovercolor", $this.css("background-image"))
      .css("background-image", "linear-gradient(#FFFFFF, #FFFFFF)")
      .css("color", "#000000");
    $this.find("path").css("fill", "#000000");
  });

  $(document).on("mouseleave", ".sidebar-menu a", function () {
    const $this = $(this);
    $this
      .css("background-image", $this.data("prehovercolor"))
      .css("color", "#FFFFFF");
    $this.find("path").css("fill", "#FFFFFF");
  });

  setInterval(validate_session, 300000);

  $(document).on("click", function () {
    validate_session();
  });
});
