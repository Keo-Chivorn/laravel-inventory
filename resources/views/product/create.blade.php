<div class="modal fade" id="form-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{!! route('product.store') !!}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="col-form-label">Quantity</label>
                        <input type="number"name="quantity"  class="form-control" id="quantity">
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-form-label">Category</label>
                        <select name="category" id="category">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="sumbit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>