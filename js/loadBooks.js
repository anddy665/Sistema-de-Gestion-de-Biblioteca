fetch("/Sistema-de-Gestion-de-Biblioteca/ajax/books.php")
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
      tableBody.innerHTML = ""; // Limpiar la tabla antes de agregar nuevos libros
      books.forEach((book) => {
        tableBody.innerHTML += `
          <tr>
            <td>${book.id}</td>
            <td>${book.title}</td>
            <td>${book.author}</td>
            <td>${book.genre}</td>
            <td>${book.publication_year}</td>
            <td>${book.status}</td>
          </tr>
        `;
      });
    } else {
      console.error("Error:", data.message);
    }
  })
  .catch((error) => console.error("Error fetching books:", error));
