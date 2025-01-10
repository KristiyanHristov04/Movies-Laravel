@extends('shared.layout')

@section('content')
    {{-- Movie Modal --}}
    <div id="modal"
        class="modal fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-6 relative">
            <div class="flex items-center pb-3 border-b border-gray-300">
                <h3 class="text-gray-800 text-xl font-bold flex-1">Трейлър</h3>
                <button id="modal-close-button">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500"
                        viewBox="0 0 320.591 320.591">
                        <path
                            d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                            data-original="#000000"></path>
                        <path
                            d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                            data-original="#000000"></path>
                    </svg>
                </button>
            </div>

            <div class="my-6">
                <iframe id="frame" src="" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
    <div class="p-5">
        <h1 class="text-center text-3xl">Филми</h1>
        @session('success')
            @include('shared.partials.success-message')
        @endsession
        @session('error')
            @include('shared.partials.error-message')
        @endsession
        <div class="text-center">
            <a href="{{ route('movies.create') }}"
                class="mb-4 mt-4 inline-block px-5 py-2.5 rounded-lg text-white text-md tracking-wider border-none outline-none bg-green-600 hover:bg-green-700 hover:cursor-pointer active:bg-green-600">
                Добавяне на филм
            </a>
        </div>
        <div class="flex gap-2 flex-wrap justify-center">
            @foreach ($movies as $movie)
                <div
                    class="bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full max-w-sm rounded-lg overflow-hidden font-[sans-serif]">
                    @if ($movie->trailer_youtube_link)
                        <div class="h-[40%] image-container">
                            <button data-trailer_link="{{ $movie->trailer_youtube_link }}" class="trailer-button"><i
                                    class="fa-solid fa-circle-play"></i> Трейлър</button>
                            <img src="{{ asset('storage/' . $movie->image_path) }}" class="w-full h-full" />
                        </div>
                    @else
                        <div class="h-[40%] image-container">
                            <p class="missing-trailer">Липсва трейлър</p>
                            <img src="{{ asset('storage/' . $movie->image_path) }}" class="w-full h-full" />
                        </div>
                    @endif


                    <div class="h-[60%] p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-gray-800 text-xl font-bold">{{ $movie->movie_name }}</h3>
                            <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                                Година: {{ $movie->year }}
                            </p>
                            <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                                Режисьор: <a class="hover:underline" href="{{ route('directors.show', ["id" => $movie->director->id]) }}">{{ $movie->director->first_name . ' ' . $movie->director->last_name }}</a>
                            </p>
                            <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                                Жанр: {{ $movie->genre->name }}
                            </p>
                            <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                                Език: {{ $movie->language->language_name }}
                            </p>
                        </div>
                        <div class="flex gap-[10px] justify-center">
                            <a href="{{ route('movies.show', $movie->id) }}" type="button"
                                class="inline-block mt-6 px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-cyan-600 hover:bg-cyan-700 hover:cursor-pointer active:bg-cyan-600">
                                Преглед
                            </a>
                            @if (Auth::user())
                                @if (Auth::user()->id == $movie->user_id)
                                    <a href="{{ route('movies.edit', $movie->id) }}" type="button"
                                        class="inline-block mt-6 px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-purple-600 hover:bg-purple-700 hover:cursor-pointer active:bg-purple-700">
                                        Редактиране
                                    </a>
                                @endif

                                @if (Auth::id() == $movie->user_id)
                                    <form action="{{ route('movies.delete', $movie->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="inline-block mt-6 px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-red-600 hover:bg-red-700 hover:cursor-pointer active:bg-red-600">
                                            Изтриване
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="fixed bottom-[60px] w-[100%] px-5">
        {{ $movies->links('pagination::tailwind') }}
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('js/movie-trailer.js') }}"></script>
    <script src="{{ asset('js/message.js') }}"></script>
@endsection
