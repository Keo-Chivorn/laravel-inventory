
<div class="modal-body">
    <div class="form-group">
        <label for="name" class="col-form-label">Name</label>
        <input type="text" name="name" value="{!! isset($product) ? $product->name : null !!}" class="form-control" id="name">
    </div>
    <div class="form-group">
        <label for="quantity" class="col-form-label">Quantity</label>
        <input type="number"name="quantity" value="{!! isset($product) ? $product->quantity : null !!}" class="form-control" id="quantity">
    </div>
    <div class="form-group">
        <label for="image" class="col-form-label">Image</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>
    @php 
        use App\Models\Category;
        $categories = Category::all();
    @endphp
    <div class="form-group">
        <label for="category" class="col-form-label">Category</label>
        <select name="category" id="category">
            @foreach ($categories as $category)
                <option value="{!! $category->id !!}"
                @if (isset($product))
                    {!! $product->category->id == $category->id ? "selected" : "" !!}
                @endif
                >{!! $category->name !!}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="description" class="col-form-label">Description</label>
        <textarea class="form-control" name="description" id="description">{!! isset($product) ? $product->description : null !!}</textarea>
    </div>
</div>