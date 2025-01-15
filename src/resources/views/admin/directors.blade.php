@extends('shared.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/directors.css') }}">
    </link>
@endsection


@section('content')
    <div class="p-5">
        <h1 class="text-center text-3xl">Режисьори</h1>
        @session('success')
            @include('shared.partials.success-message')
        @endsession
        @session('error')
            @include('shared.partials.error-message')
        @endsession

        <div class="flex flex-col mt-6">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        #</th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Име</th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Фамилия</th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Година на раждане</th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Информация</th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Операции</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @foreach ($directors as $director)
                                    <tr>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ ($directors->currentPage() - 1) * $directors->perPage() + $counter++ + 1 }}

                                        </td>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $director->first_name }}</td>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $director->last_name }}</td>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $director->born_year }}</td>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            <p class="long-text">{{ $director->about }}</p>
                                        </td>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.directors.edit', ['id' => $director->id]) }}"
                                                type="button"
                                                class="cursor-pointer inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400"><i
                                                    class="fa-solid fa-pen-to-square"></i> Редактиране</a>
                                            <form action="{{ route('admin.directors.delete', ['id' => $director->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400 dark:focus:text-red-400"><i
                                                        class="fa-solid fa-trash"></i> Изтриване</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed bottom-[60px] w-[100%] pr-9">
            {{ $directors->links('pagination::tailwind') }}
        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('js/message.js') }}"></script>
    @endsection
