@extends('shared.layout')

@section('content')
    <div class="p-5">
        <h1 class="text-center text-3xl">Филми</h1>
        <a href="{{ route('movies.create') }}"
            class="mb-4 inline-block px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-green-600 hover:bg-green-700 hover:cursor-pointer active:bg-green-600">
            Добави нов филм
        </a>
        <div class="flex gap-2 flex-wrap">
            @foreach ($movies as $movie)
                <div
                    class="bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full max-w-sm rounded-lg overflow-hidden font-[sans-serif]">
                    <div class="h-[215px]">
                        <img src="{{ asset('storage/' . $movie->image_path) }}" class="w-full h-full" />
                    </div>

                    <div class="p-6">
                        <h3 class="text-gray-800 text-xl font-bold">{{ $movie->movie_name }}</h3>
                        <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                            Година: {{ $movie->year }}
                        </p>
                        <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                            Режисьор: {{ $movie->director }}
                        </p>
                        <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                            Жанр: {{ $movie->genre }}
                        </p>
                        <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                            Език: {{ $movie->language }}
                        </p>
                        <button type="button"
                            class="mt-6 px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-cyan-600 hover:bg-cyan-700 active:bg-cyan-600">
                            Преглед
                        </button>
                        <button type="button"
                            class="mt-6 px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-orange-600 hover:bg-orange-700 active:bg-orange-600">
                            Редактирай
                        </button>
                        <button type="button"
                            class="mt-6 px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-red-600 hover:bg-red-700 active:bg-red-600">
                            Изтрий
                        </button>
                    </div>
                </div>
                {{-- <li>
                <h2>{{ $movie->movie_name }} ({{ $movie->year }})</h2>
                <p>Director: {{ $movie->director }}</p>
                <p>Genre: {{ $movie->genre }}</p>
                <p>Language: {{ $movie->language }}</p>
                <img src="{{ asset('storage/' . $movie->image_path) }}" alt="{{ $movie->movie_name }}" width="100">
            </li> --}}
            @endforeach
        </div>
    </div>
@endsection
