document
  .getElementById("addUserForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);
    formData.append('action', 'create')

    fetch("/Sistema-de-Gestion-de-Biblioteca/src/Controller/UserController.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(data.message);
          this.reset();
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("addUserModal")
          );
          modal.hide();

          fetch("/Sistema-de-Gestion-de-Biblioteca/src/Controller/UserController.php")
            .then((response) => response.json())
            .then((data) => {
              const users = data.data;
              const tableBody = document.getElementById("userListTableBody");
              tableBody.innerHTML = "";
              users.forEach((user) => {
                tableBody.innerHTML += `
                  <tr>
                      <td>${user.id}</td>
                      <td>${user.full_name}</td>
                      <td>${user.email}</td>
                      <td>${user.phone_number}</td>
                      <td>
                       <button class="btn btn-warning btn-sm edit-btn" data-id="${user.id}" data-full-name="${user.full_name}" data-email="${user.email}" data-phone-number="${user.phone_number}">
                        Edit
                       </button>
                       <button class="btn btn-danger btn-sm delete-btn" data-id="${user.id}">Delete</button>
                     </td>
                  </tr>
                `;
              });
            })
            .catch((error) => console.error("Error fetching users:", error));
        } else {
          alert("Error: " + data.message);
        }
      })
      .catch((error) => console.error("Error:", error));
  });
