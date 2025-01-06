@extends('shared.layout')

@section('content')
<div>
    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="movieName">Movie Name:</label>
            <input type="text" id="movieName" name="movieName" required>
        </div>
        <div>
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" required>
        </div>
        <div>
            <label for="director">Director:</label>
            <input type="text" id="director" name="director" required>
        </div>
        <div>
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required>
        </div>
        <div>
            <label for="language">Language:</label>
            <input type="text" id="language" name="language" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <button type="submit">Create Movie</button>
    </form>
</div>
@endsection
