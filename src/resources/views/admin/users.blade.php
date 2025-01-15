@extends('shared.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    </link>
@endsection

@section('content')
    <div class="p-5">
        <h1 class="text-center text-3xl">Потребители</h1>
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
                                        Имейл</th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Админ</th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Операции</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ ($users->currentPage() - 1) * $users->perPage() + $counter++ + 1 }}

                                        </td>
                                        <td class="long-text text-center px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $user->name }}</td>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $user->email }}</td>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $user->is_admin == 0 ? 'Не' : ($user->email == 'admin@films.bg' ? 'Да(главен)' : 'Да') }}
                                        </td>
                                        <td class="text-center px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if (!$user->is_admin)
                                                <form action="{{ route('admin.users.promote', ['id' => $user->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="cursor-pointer inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400"><i
                                                            class="fa-solid fa-circle-chevron-up"></i> Направи админ</button>
                                                </form>
                                            @else
                                                @if ($user->email != 'admin@films.bg' && $user->id != Auth::user()->id)
                                                    <form action="{{ route('admin.users.demote', ['id' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="cursor-pointer inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400"><i class="fa-solid fa-circle-chevron-down"></i> Направи потребител</button>
                                                @endif
                                                </form>
                                            @endif
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
            {{ $users->links('pagination::tailwind') }}
        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('js/message.js') }}"></script>
    @endsection
