@extends('shared.layout')

@section('content')
    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col justify-center max-w-lg mx-auto px-4 space-y-6 font-[sans-serif] text-[#333]">
        @csrf
        @method('put')
        <div>
            <label class="mb-2 text-lg block" id="movieName">Име на филм:</label>
            <input type='text' value="{{ $movie->movie_name }}" id="movieName" name="movieName"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
            @error('movieName')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="mb-2 text-lg block" id="year">Година на издаване:</label>
            <input type='number' value="{{ $movie->year }}" id="year" name="year"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
                @error('year')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="mb-2 text-lg block" id="director">Режисьор:</label>
            <input type='text' value="{{ $movie->director }}" id="director" name="director"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
                @error('director')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="mb-2 text-lg block" id="genre">Жанр:</label>
            <input type='text' value="{{ $movie->genre }}" id="genre" name="genre"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
                @error('genre')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="mb-2 text-lg block" id="language">Език:</label>
            <input type='text' value="{{ $movie->language }}" id="language" name="language"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
                @error('language')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="mb-2 text-lg block" id="image">Снимка:</label>
            <input type='file' id="image" name="image"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
                @error('image')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit"
            class="mb-4 inline-block px-5 py-2.5 rounded-lg text-white text-md tracking-wider border-none outline-none bg-green-600 hover:bg-green-700 hover:cursor-pointer active:bg-green-600">Редактиране
            </button>
    </form>
@endsection
