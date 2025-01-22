document.addEventListener('click', (event) => {
    if (event.target.classList.contains('edit-btn')) {
        const button = event.target;
        const id = button.getAttribute('data-id');
        const title = button.getAttribute('data-title');
        const author = button.getAttribute('data-author');
        const genre = button.getAttribute('data-genre');
        const publicationYear = button.getAttribute('data-publication-year');
        const status = button.getAttribute('data-status');

        document.getElementById('editBookId').value = id;
        document.getElementById('editTitle').value = title;
        document.getElementById('editAuthor').value = author;
        document.getElementById('editGenre').value = genre;
        document.getElementById('editPublicationYear').value = publicationYear;
        document.getElementById('editStatus').value = status;

        new bootstrap.Modal(document.getElementById('editBookModal')).show();
    }
});

document.getElementById('editBookForm').addEventListener('submit', (event) => {
    event.preventDefault();

    const id = document.getElementById('editBookId').value;
    const title = document.getElementById('editTitle').value;
    const author = document.getElementById('editAuthor').value;
    const genre = document.getElementById('editGenre').value;
    const publicationYear = document.getElementById('editPublicationYear').value;
    const status = document.getElementById('editStatus').value;

    fetch('/Sistema-de-Gestion-de-Biblioteca/api/books.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'update',
            id,
            title,
            author,
            genre,
            publication_year: publicationYear,
            status,
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
