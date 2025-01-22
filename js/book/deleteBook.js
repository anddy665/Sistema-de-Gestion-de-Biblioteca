document.addEventListener('click', (event) => {
    if (event.target.classList.contains('delete-book-btn')) {
        const id = event.target.getAttribute('data-id');

        if (confirm('Are you sure you want to delete this book?')) {
            fetch('/Sistema-de-Gestion-de-Biblioteca/api/books.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'delete', id }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Book deleted successfully!');
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error deleting book:', error));
        }
    }
});