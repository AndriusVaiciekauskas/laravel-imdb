<div class="form-group">
    <label>Category name</label>
    @include('categories.partials.errors', ['name' => 'name'])
    <input type="text" name="name" class="form-control" value="{{ old('name', $name) }}">
</div>
<div class="form-group">
    <label>Category description</label>
    @include('categories.partials.errors', ['name' => 'description'])
    <input type="text" name="description" class="form-control" value="{{ old('description', $description) }}">
</div>
