$(document).ready(async function () {
  const loginID = document.getElementById("LoginID");

  if (loginID) {
    await populate_sidebar();
  }
});

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
      items.forEach((item) => {
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

// SESSION ERRORS
// function validate_session() {
//   $.ajax({
//     url: BASE_URL + "functions/validate_session.php",
//     type: "GET",
//     dataType: "json",
//     success: function (response) {
//       if (response.status === "success") {
//         // User is logged in
//         $("#result").html("<p>User is logged in.</p>");
//       } else {
//         // User is not logged in, redirect to index.php
//         Swal.fire({
//           Permission: "Your session has expired.",
//           text: "You will be redirected to the Login page.",
//           icon: "error", // you can use 'success', 'error', 'warning', 'info', 'question'
//           confirmButtonText: "OK",
//         }).then((result) => {
//           if (result.isConfirmed) {
//             // Code to execute after clicking OK button
//             window.location.href = "index.php";
//           }
//         });
//       }
//     },
//     error: function (xhr, status, error) {
//       console.error(xhr.responseText);
//     },
//   });
// }

// document.addEventListener("click", function (event) {
//   validate_session();
// });
