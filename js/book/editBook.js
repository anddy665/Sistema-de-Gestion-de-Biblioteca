document.addEventListener('click', (event) => {
    if (event.target.classList.contains('edit-btn')) {
        const button = event.target;
        const id = button.getAttribute('data-id');
        const title = button.getAttribute('data-title');
        const author = button.getAttribute('data-author');
        const genre = button.getAttribute('data-genre');
        const year = button.getAttribute('data-year');
        const status = button.getAttribute('data-status');

        document.getElementById('editBookId').value = id;
        document.getElementById('editBookTitle').value = title;
        document.getElementById('editBookAuthor').value = author;
        document.getElementById('editBookGenre').value = genre;
        document.getElementById('editBookYear').value = year;
        document.getElementById('editBookStatus').value = status;

        new bootstrap.Modal(document.getElementById('editBookModal')).show();
    }
});


document.getElementById('editBookForm').addEventListener('submit', (event) => {
    event.preventDefault();

    const id = document.getElementById('editBookId').value;
    const title = document.getElementById('editBookTitle').value;
    const author = document.getElementById('editBookAuthor').value;
    const genre = document.getElementById('editBookGenre').value;
    const year = document.getElementById('editBookYear').value;
    const status = document.getElementById('editBookStatus').value;

    fetch('/Sistema-de-Gestion-de-Biblioteca/api/books.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'update',
            id,
            title,
            author,
            genre,
            year,
            status
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Book updated successfully!');
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error updating book:', error));
});
