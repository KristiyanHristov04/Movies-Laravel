@extends('shared.layout')

@section('content')
    <div class="p-5">
        <h1 class="text-center text-3xl">Добре дошъл, админе!</h1>
        @session('success')
            @include('shared.partials.success-message')
        @endsession
        @session('error')
            @include('shared.partials.error-message')
        @endsession

        {{-- <div class="fixed bottom-[60px] w-[100%] px-5">
            {{ $movies->links('pagination::tailwind') }}
        </div> --}}
@endsection

@section('scripts')
    <script src="{{ asset('js/message.js') }}"></script>
@endsection
