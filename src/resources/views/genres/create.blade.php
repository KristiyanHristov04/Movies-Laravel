@extends('shared.layout')

@section('content')
    <form action="{{ route('genres.store') }}" method="POST"
        class="flex flex-col justify-center max-w-lg mx-auto px-4 space-y-6 font-[sans-serif] text-[#333]">
        @csrf
        <div>
            <label class="mb-2 text-lg block" id="genre">Жанр:</label>
            <input type='text' value="{{ old('genre') }}" id="genre" name="genre"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
            @error('genre')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit"
            class="mb-4 inline-block px-5 py-2.5 rounded-lg text-white text-md tracking-wider border-none outline-none bg-green-600 hover:bg-green-700 hover:cursor-pointer active:bg-green-600">Добавяне
            </button>
    </form>
@endsection
