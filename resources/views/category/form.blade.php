<div class="modal-body">
    <div class="form-group">
        <label for="name  class="col-form-label">Name</label>
        <input type="text" value="{!! isset($category) ? $category->name : null !!}"  name="name" class="form-control" id="name">
    </div>
    <div class="form-group">
        <label for="description" class="col-form-label">Description</label>
        <textarea class="form-control" name="description" id="description">{!!  isset($category) ? $category->description : null !!}</textarea>
    </div>
</div>