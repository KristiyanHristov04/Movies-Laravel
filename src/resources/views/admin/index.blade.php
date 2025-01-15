@extends('shared.layout')

@section('content')
    <div class="p-5">
        <h1 class="text-center text-3xl">Административно табло</h1>
        @session('success')
            @include('shared.partials.success-message')
        @endsession
        @session('error')
            @include('shared.partials.error-message')
        @endsession

        <div class="flex flex-wrap justify-center gap-3 mt-6">
            <div class="block max-w-[18rem] rounded-lg bg-[#36b87d] text-white shadow-secondary-1">
                <div class="border-b-2 border-black/20 px-6 py-3"><i class="fa-solid fa-video"></i> Филми</div>
                <div class="p-6">
                    <h5 class="mb-2 text-xl font-medium leading-tight">
                        Общ брой: {{ $moviesCount }}
                    </h5>
                    <p class="text-base">
                        Информация за общият брой филми в системата.
                    </p>
                </div>
            </div>

            <div class="block max-w-[18rem] rounded-lg bg-[#36b87d] text-white shadow-secondary-1">
                <div class="border-b-2 border-black/20 px-6 py-3"><i class="fa-solid fa-clapperboard"></i> Режисьори</div>
                <div class="p-6">
                    <h5 class="mb-2 text-xl font-medium leading-tight">
                        Общ брой: {{ $directorsCount }}
                    </h5>
                    <p class="text-base">
                        Информация за общият брой режисьори в системата.
                    </p>
                </div>
            </div>

            <div class="block max-w-[18rem] rounded-lg bg-[#36b87d] text-white shadow-secondary-1">
                <div class="border-b-2 border-black/20 px-6 py-3"><i class="fa-solid fa-book"></i> Жанрове</div>
                <div class="p-6">
                    <h5 class="mb-2 text-xl font-medium leading-tight">
                        Общ брой: {{ $genresCount }}
                    </h5>
                    <p class="text-base">
                        Информация за общият брой жанрове в системата.
                    </p>
                </div>
            </div>

            <div class="block max-w-[18rem] rounded-lg bg-[#36b87d] text-white shadow-secondary-1">
                <div class="border-b-2 border-black/20 px-6 py-3"><i class="fa-solid fa-user"></i> Потребители</div>
                <div class="p-6">
                    <h5 class="mb-2 text-xl font-medium leading-tight">
                        Общ брой: {{ $usersCount }}
                    </h5>
                    <p class="text-base">
                        Информация за общият брой потребители в системата.
                    </p>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('js/message.js') }}"></script>
    @endsection
