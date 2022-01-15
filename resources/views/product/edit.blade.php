<div class="modal fade" id="form-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{!! route('product.update',1) !!}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
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