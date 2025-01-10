@extends('shared.layout')

@section('content')
    <div class="p-5">
        <h1 class="my-4 text-center text-3xl">В момента преглеждате: {{ $director->first_name . ' ' . $director->last_name }}
        </h1>
        <div class="flex gap-2 flex-wrap justify-center">
            <div
                class="bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full max-w-md rounded-lg overflow-hidden font-[sans-serif]">
                <div class="h-[40%]">
                    <img src="{{ asset('storage/' . $director->image_path) }}" class="w-full h-full" />
                </div>
                <div class="h-[60%] p-6 flex flex-col justify-between">
                    <h3 class="text-gray-800 text-xl font-bold">{{ $director->first_name . ' ' . $director->last_name }}</h3>
                    <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                        Година на раждане: {{ $director->born_year }}
                    </p>
                    <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                        Режисьор: {{ $director->first_name . ' ' . $director->last_name }}
                    </p>
                    <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                        Информация: {{ $director->about }}
                    </p>

                    <div class="flex justify-center">
                        <a href="{{ route('movies.index', ['search' => $director->first_name . ' ' . $director->last_name]) }}"
                            class="inline-block mt-6 px-5 py-2.5 rounded-lg text-white text-center text-sm tracking-wider border-none outline-none bg-cyan-600 hover:bg-cyan-700 hover:cursor-pointer active:bg-cyan-600">
                            Покажи всички филми
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
