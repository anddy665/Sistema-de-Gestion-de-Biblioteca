<div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editBookForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editBookId" name="id">
                    <div class="mb-3">
                        <label for="editBookTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editBookTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editBookAuthor" class="form-label">Author</label>
                        <input type="text" class="form-control" id="editBookAuthor" name="author" required>
                    </div>
                    <div class="mb-3">
                        <label for="editBookGenre" class="form-label">Genre</label>
                        <input type="text" class="form-control" id="editBookGenre" name="genre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editBookYear" class="form-label">Publication Year</label>
                        <input type="number" class="form-control" id="editBookYear" name="year" required>
                    </div>
                    <div class="mb-3">
                        <label for="editBookStatus" class="form-label">Status</label>
                        <select class="form-select" id="editBookStatus" name="status" required>
                            <option value="Available">Available</option>
                            <option value="Borrowed">Borrowed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
