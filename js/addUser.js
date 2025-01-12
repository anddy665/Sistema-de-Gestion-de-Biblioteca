document
  .getElementById("addUserForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevenir recarga de la página

    const formData = new FormData(this);

    fetch("/Sistema-de-Gestion-de-Biblioteca/src/Auth/addUser.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(data.message);
          this.reset(); // Limpia el formulario
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("addUserModal")
          );
          modal.hide(); // Cierra el modal

          // Actualiza la tabla de usuarios
          fetch("/Sistema-de-Gestion-de-Biblioteca/ajax/users.php")
            .then((response) => {
              if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
              }
              return response.json();
            })
            .then((data) => {
              if (data.success) {
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
              } else {
                console.error("Error:", data.message);
              }
            })
            .catch((error) => console.error("Error fetching users:", error));
        } else {
          alert("Error: " + data.message);
        }
      })
      .catch((error) => console.error("Error:", error));
  });
