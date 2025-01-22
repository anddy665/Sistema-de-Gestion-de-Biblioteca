document
    .getElementById("addBookForm")
    .addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch("/Sistema-de-Gestion-de-Biblioteca/src/Books/addBook.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert(data.message);
                    this.reset();
                    const modal = bootstrap.Modal.getInstance(
                        document.getElementById("addBookModal")
                    );
                    modal.hide();

                    fetch("/Sistema-de-Gestion-de-Biblioteca/api/books.php")
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
                                    tableBody.innerHTML += `
                                    <tr>
                                        <td>${book.id}</td>
                                        <td>${book.title}</td>
                                        <td>${book.author}</td>
                                        <td>${book.genre}</td>
                                        <td>${book.publication_year}</td>
                                        <td>${book.status}</td>
                                        <td>
                                         <button class="btn btn-warning btn-sm edit-btn" 
                                                 data-id="${book.id}" 
                                                 data-title="${book.title}" 
                                                 data-author="${book.author}" 
                                                 data-genre="${book.genre}" 
                                                 data-publication-year="${book.publication_year}" 
                                                 data-status="${book.status}">
                                          Edit
                                         </button>
                                         <button class="btn btn-danger btn-sm delete-btn" data-id="${book.id}">Delete</button>
                                       </td>
                                    </tr>
                                `;
                                });
                            } else {
                                console.error("Error:", data.message);
                            }
                        })
                        .catch((error) => console.error("Error fetching books:", error));
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch((error) => console.error("Error:", error));
    });
