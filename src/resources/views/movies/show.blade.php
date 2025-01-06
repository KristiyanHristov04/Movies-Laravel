@extends('shared.layout')

@section('content')
    <div class="p-5">
        <h1 class="my-4 text-center text-3xl">В момента преглеждате: {{ $movie->movie_name }}</h1>
        <div class="flex gap-2 flex-wrap justify-center">
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
                    <a type="button"
                        class="inline-block mt-6 px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-orange-600 hover:bg-orange-700 hover:cursor-pointer active:bg-orange-600">
                        Редактирай
                    </a>
                    <form action="{{ route('movies.delete', $movie->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            class="inline-block mt-6 px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-red-600 hover:bg-red-700 hover:cursor-pointer active:bg-red-600">
                            Изтрий
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
