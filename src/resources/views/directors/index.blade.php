@extends('shared.layout')

@section('content')
    <div class="p-5">
        <h1 class="text-center text-3xl">Режисьори</h1>
        @session('success')
            @include('shared.partials.success-message')
        @endsession
        @session('error')
            @include('shared.partials.error-message')
        @endsession
        <div class="text-center">
            <a href="{{ route('directors.create') }}"
                class="mb-4 mt-4 inline-block px-5 py-2.5 rounded-lg text-white text-md tracking-wider border-none outline-none bg-green-600 hover:bg-green-700 hover:cursor-pointer active:bg-green-600">
                Добавяне на режисьор
            </a>
        </div>
        <div class="flex gap-2 flex-wrap justify-center">
            @foreach ($directors as $director)
                <div
                    class="bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full max-w-sm rounded-lg overflow-hidden font-[sans-serif]">
                    <div class="h-[40%]">
                        <img src="{{ asset('storage/' . $director->image_path) }}" class="w-full h-full" />
                    </div>

                    <div class="h-[60%] p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-gray-800 text-xl font-bold">
                                {{ $director->first_name . ' ' . $director->last_name }}</h3>
                            <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                                Година на раждане: {{ $director->born_year }}
                            </p>
                            <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                                Информация: {{ $director->about }}
                            </p>
                        </div>
                        <div class="flex gap-[10px] justify-center">
                            <a href="{{ route('directors.show', $director->id) }}" type="button"
                                class="inline-block mt-6 px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-cyan-600 hover:bg-cyan-700 hover:cursor-pointer active:bg-cyan-600">
                                Преглед
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="fixed bottom-[60px] w-[100%] px-5">
        {{ $directors->links('pagination::tailwind') }}
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/message.js') }}"></script>
@endsection
