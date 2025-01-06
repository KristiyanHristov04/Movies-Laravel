<form action="{{ route('movies.index') }}" method="GET"
    class="flex gap-2">
    <select name="sortByYear" class="py-3 px-4 pe-9 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
        <option>-- Филтирай по година --</option>
        <option value="newest" {{ request('sortByYear') === 'newest' ? 'selected' : '' }} class='py-3 px-5 hover:bg-gray-50 text-gray-800 text-sm cursor-pointer'>Най-нови</option>
        <option value="oldest" {{ request('sortByYear') === 'oldest' ? 'selected' : '' }} class='py-3 px-5 hover:bg-gray-50 text-gray-800 text-sm cursor-pointer'>Най-стари</option>
    </select>

    <div
        class='flex max-w-xs w-full bg-gray-100 px-4 py-2 rounded outline outline-transparent border focus-within:border-blue-600 focus-within:bg-transparent transition-all'>
        <input type='text' name="search" value="{{ request('search') }}" placeholder='Търсене на филм..'
            class='w-full text-sm bg-transparent rounded outline-none pr-2' />
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                class="cursor-pointer fill-gray-400">
                <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                </path>
            </svg>
        </button>
    </div>
</form>
