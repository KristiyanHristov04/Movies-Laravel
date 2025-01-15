@extends('shared.layout')

@section('content')
    <h1 class="text-center my-4 text-4xl">Редактиране на режисьор</h1>
    <form action="{{ route('admin.directors.update', $director->id) }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col justify-center max-w-lg mx-auto px-4 space-y-6 font-[sans-serif] text-[#333]">
        @csrf
        @method('put')
        <div>
            <label class="mb-2 text-lg block" for="first_name">Име:</label>
            <input type='text' value="{{ $director->first_name }}" id="first_name" name="first_name"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
            @error('first_name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="mb-2 text-lg block" for="last_name">Фамилия:</label>
            <input type='text' value="{{ $director->last_name }}" id="last_name" name="last_name"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
            @error('last_name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="mb-2 text-lg block" for="born_year">Година на раждане:</label>
            <input type='number' value="{{ $director->born_year }}" id="born_year" name="born_year"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
            @error('born_year')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="mb-2 text-lg block" for="about">Информация:</label>
            <textarea id="about" name="about"
                class="px-4 py-2.5 text-md rounded-md bg-white border border-gray-400 w-full outline-blue-500">{{ $director->about }}</textarea>
            @error('about')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="mb-2 text-lg block" for="image">Снимка:</label>
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
