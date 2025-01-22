document.addEventListener('click', (event) => {
    if (event.target.classList.contains('delete-user-btn')) {
        const id = event.target.getAttribute('data-id');

        if (confirm('Are you sure you want to delete this user?')) {
            fetch('/Sistema-de-Gestion-de-Biblioteca/api/users.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'delete', id }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('User deleted successfully!');
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error deleting user:', error));
        }
    }
});