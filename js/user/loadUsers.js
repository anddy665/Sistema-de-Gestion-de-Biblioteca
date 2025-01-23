function loadUsers(page = 1) {
  fetch(`/Sistema-de-Gestion-de-Biblioteca/api/users.php?page=${page}&limit=10`)
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
                  <button class="btn btn-danger btn-sm delete-user-btn" data-id="${user.id}">Delete</button>
                </td>
            </tr>
          `;
        });


        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";


        const prevPage = page > 1 ? `<li class="page-item"><a class="page-link" href="#" onclick="loadUsers(${page - 1})">Previous</a></li>` : '';
        pagination.innerHTML += prevPage;


        for (let i = 1; i <= data.total_pages; i++) {
          pagination.innerHTML += `
            <li class="page-item ${i === data.current_page ? "active" : ""}">
              <a class="page-link" href="#" onclick="loadUsers(${i})">${i}</a>
            </li>
          `;
        }


        const nextPage = page < data.total_pages ? `<li class="page-item"><a class="page-link" href="#" onclick="loadUsers(${page + 1})">Next</a></li>` : '';
        pagination.innerHTML += nextPage;
      } else {
        console.error("Error:", data.message);
      }
    })
    .catch((error) => console.error("Error fetching users:", error));
}


loadUsers();
