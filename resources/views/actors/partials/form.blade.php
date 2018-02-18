<div class="form-group">
    <label>Actor name</label>
    @include('movies.partials.errors', ['name' => 'name'])
    <input type="text" name="name" class="form-control" value="{{ old('name', $name) }}">
</div>
<div class="form-group">
    <label>Birthday</label>
    @include('movies.partials.errors', ['name' => 'birthday'])
    <input type="date" name="birthday" class="form-control" value="{{ old('birthday', $birthday) }}">
</div>
<div class="form-group">
    <label>Deathday</label>
    @include('movies.partials.errors', ['name' => 'deathday'])
    <input type="date" name="deathday" class="form-control" value="{{ old('deathday', $deathday) }}">
</div>
<div class="form-group">
    <label>Movies</label>
    <select multiple name="movies[]" class="form-control">
        @foreach($movies as $movie)
            <option value="{{ $movie->id }}">{{ $movie->name }}</option>
        @endforeach
    </select>
</div>


