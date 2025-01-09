document.getElementById('addUserForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('/Sistema-de-Gestion-de-Biblioteca/src/Auth/addUser.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('User added successfully!');
                // Opcional: Cierra el modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
                modal.hide();

                // Limpia el formulario
                this.reset();

                // Actualiza la tabla
                loadUsers();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
});
