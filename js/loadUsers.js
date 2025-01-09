fetch('/Sistema-de-Gestion-de-Biblioteca/ajax/users.php')
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const users = data.data;
            const tableBody = document.getElementById('userListTableBody');
            tableBody.innerHTML = '';
            users.forEach(user => {
                tableBody.innerHTML += `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.full_name}</td>
                        <td>${user.email}</td>
                        <td>${user.phone_number}</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                `;
            });
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => console.error('Error fetching users:', error));
