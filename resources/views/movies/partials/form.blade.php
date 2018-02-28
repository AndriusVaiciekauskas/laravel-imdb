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
    <label>Release date</label>
    @include('movies.partials.errors', ['name' => 'release_date'])
    <input type="date" name="release_date" class="form-control" value="{{ old('release_date', $release_date) }}">
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
<div class="form-group">
    <label>Actors</label>
    <select class="actors-select form-control" name="actors[]" multiple="multiple">
        @foreach($actors as $actor)
            @if(isset($movie_actors) && $movie_actors->contains($actor))
                <option value="{{ $actor->id }}" selected>{{ $actor->name }}</option>
            @else
                <option value="{{ $actor->id }}">{{ $actor->name }}</option>
            @endif
        @endforeach
    </select>
</div>
