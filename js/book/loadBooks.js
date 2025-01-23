function loadBooks(page = 1) {
  fetch(`/Sistema-de-Gestion-de-Biblioteca/api/books.php?page=${page}&limit=10`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      if (data.success) {
        const books = data.data;
        const tableBody = document.getElementById("bookListTableBody");
        tableBody.innerHTML = "";
        books.forEach((book) => {
          console.log(book.id);  // Asegúrate de que el ID esté disponible
          tableBody.innerHTML += `
            <tr>
                <td>${book.id}</td>
                <td>${book.title}</td>
                <td>${book.author}</td>
                <td>${book.genre}</td>
                <td>${book.publication_year}</td>
                <td>${book.status}</td>
                <td>
                  <button class="btn btn-warning btn-sm edit-btn" data-id="${book.id}" data-title="${book.title}" data-author="${book.author}" data-genre="${book.genre}" data-publication-year="${book.publication_year}" data-status="${book.status}">
                    Edit
                  </button>
                  <button class="btn btn-danger btn-sm delete-book-btn" data-id="${book.id}">Delete</button>
                </td>
            </tr>
          `;
        });

        // Handle pagination (mismo código para la paginación)
        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";

        const prevPage = page > 1
          ? `<li class="page-item"><a class="page-link" href="#" onclick="loadBooks(${page - 1})">Previous</a></li>`
          : '';
        pagination.innerHTML += prevPage;

        for (let i = 1; i <= data.total_pages; i++) {
          pagination.innerHTML += `
            <li class="page-item ${i === data.current_page ? "active" : ""}">
              <a class="page-link" href="#" onclick="loadBooks(${i})">${i}</a>
            </li>
          `;
        }

        const nextPage = page < data.total_pages
          ? `<li class="page-item"><a class="page-link" href="#" onclick="loadBooks(${page + 1})">Next</a></li>`
          : '';
        pagination.innerHTML += nextPage;
      } else {
        console.error("Error:", data.message);
      }
    })
    .catch((error) => console.error("Error fetching books:", error));
}

// Load books on page load
loadBooks();
