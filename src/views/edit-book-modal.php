<div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editBookForm">
            <input type="hidden" id="editBookId"> 
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAuthor" class="form-label">Author</label>
                        <input type="text" class="form-control" id="editAuthor" required>
                    </div>
                    <div class="mb-3">
                        <label for="editGenre" class="form-label">Genre</label>
                        <input type="text" class="form-control" id="editGenre">
                    </div>
                    <div class="mb-3">
                        <label for="editYear" class="form-label">Publication Year</label>
                        <input type="number" class="form-control" id="editYear" min="1000" max="9999">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
