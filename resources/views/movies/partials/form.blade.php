<div class="form-group">
    <label>Movie name</label>
    @include('movies.partials.errors', ['name' => 'name'])
    <input type="text" name="name" class="form-control" value="{{ old('name', $name) }}">
</div>
<div class="form-group">
    <label>Movie description</label>
    @include('movies.partials.errors', ['name' => 'description'])
    <input type="text" name="description" class="form-control" value="{{ old('description', $description) }}">
</div>
<div class="form-group">
    <label>Year</label>
    @include('movies.partials.errors', ['name' => 'year'])
    <input type="number" name="year" class="form-control" value="{{ old('year', $year) }}">
</div>
<div class="form-group">
    <label>Rating</label>
    @include('movies.partials.errors', ['name' => 'rating'])
    <input type="number" name="rating" class="form-control" value="{{ old('rating', $rating) }}">
</div>
<div class="form-group">
    <label>Category</label>
    @include('movies.partials.errors', ['name' => 'category'])
    <select name="category_id" class="form-control">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
