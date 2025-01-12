// Al hacer clic en "Edit"
document.addEventListener('click', (event) => {
    if (event.target.classList.contains('edit-btn')) {
        const button = event.target;
        const id = button.getAttribute('data-id');
        const fullName = button.getAttribute('data-full-name');
        const email = button.getAttribute('data-email');
        const phoneNumber = button.getAttribute('data-phone-number');

        // Prellenar el formulario de edición
        document.getElementById('editUserId').value = id;
        document.getElementById('editFullName').value = fullName;
        document.getElementById('editEmail').value = email;
        document.getElementById('editPhoneNumber').value = phoneNumber;

        // Mostrar el modal de edición
        new bootstrap.Modal(document.getElementById('editUserModal')).show();
    }
});

// Manejar el envío del formulario de edición
document.getElementById('editUserForm').addEventListener('submit', (event) => {
    event.preventDefault();

    const id = document.getElementById('editUserId').value;
    const fullName = document.getElementById('editFullName').value;
    const email = document.getElementById('editEmail').value;
    const phoneNumber = document.getElementById('editPhoneNumber').value;

    fetch('/Sistema-de-Gestion-de-Biblioteca/ajax/users.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'update',
            id,
            full_name: fullName,
            email,
            phone_number: phoneNumber,
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('User updated successfully!');
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error updating user:', error));
});
