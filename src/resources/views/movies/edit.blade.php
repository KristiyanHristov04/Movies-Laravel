@extends('shared.layout')

@section('content')
    <h1 class="text-center my-4 text-4xl">Редактиране на филм</h1>
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
        <div class="mb-3">
            <label for="director_id" class="form-label mb-[8px] block">Режисьор:</label>
            <select name="director_id" id="director_id"
                class="form-control cursor-pointer w-[100%] rounded-md px-4 py-[10px]"
                style="border-color: rgb(156 163 175);">
                <option value="">Изберете режисьор</option>
                @foreach ($directors as $director)
                    <option {{ $movie->director_id == $director->id ? 'selected' : '' }} value="{{ $director->id }}">
                        {{ $director->first_name . ' ' . $director->last_name }}</option>
                @endforeach
            </select>
            @error('director_id')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="genre_id" class="form-label mb-[8px] block">Жанр:</label>
            <select name="genre_id" id="genre_id" class="form-control cursor-pointer w-[100%] rounded-md px-4 py-[10px]"
                style="border-color: rgb(156 163 175);">
                <option value="">Изберете жанр</option>
                @foreach ($genres as $genre)
                    <option {{ $movie->genre_id == $genre->id ? 'selected' : '' }} value="{{ $genre->id }}">
                        {{ $genre->name }}</option>
                @endforeach
            </select>
            @error('genre_id')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="language_id" class="form-label mb-[8px] block">Жанр:</label>
            <select name="language_id" id="language_id"
                class="form-control cursor-pointer w-[100%] rounded-md px-4 py-[10px]"
                style="border-color: rgb(156 163 175);">
                <option value="">Изберете език</option>
                @foreach ($languages as $language)
                    <option {{ $movie->language_id == $language->id ? 'selected' : '' }} value="{{ $language->id }}">
                        {{ $language->language_name }}</option>
                @endforeach
            </select>
            @error('language_id')
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
