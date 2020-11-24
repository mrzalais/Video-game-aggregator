<div class="relative" x-data="{ isVisible: true }" @click.away="isVisible = false">
    <input
        wire:model.debounce.300ms="search"
        type="text"
        class="bg-gray-800 text-sm rounded-full focus:outline-none
                    focus:shadow-outline w-64 px-3 pl-8 py-1"
        placeholder="Search (Press '/' to focus)"
        x-ref="search"
        @keydown.window="
            if (event.keyCode === 191) {
            event.preventDefault();
            $refs.search.focus()
            }
        "
        @focus="isVisible = true"
        @keydown.escape.window="isVisible = false"
        @keydown="isVisible = true"
        @keydown.shift.tab="isVisible = false"
    >
    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="fill-current text-gray-400 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
             width="32" height="32">
            <title>search</title>
            <path d="M30,28.59,22.45,21A11,11,0,1,0,21,22.45L28.59,30ZM5,14a9,9,0,1,1,9,9A9,9,0,0,1,5,14Z"/>
            <path fill="none" d="M0 0H32V32H0z" data-name="&lt;Transparent Rectangle>"/>
        </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3" style="position: absolute"></div>

    @if (strlen($search) >= 2)
        <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2" x-show.transition.opacity.duration.1000="isVisible">
            @if (count($searchResults) > 0)
                <ul>
                    @foreach ($searchResults as $game)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('games.show', $game['slug']) }}"
                               class="block hover:bg-gray-700 flex items-center transition ease-in-out
                               duration-150 px-3 py-3"
                               @if ($loop->last) @keydown.tab="isVisible = false" @endif
                            >
                                @if (isset($game['cover']))
                                    <img src="{{ str_replace('thumb', 'cover_small', $game['cover']['url']) }}"
                                         alt="cover"
                                         class="w-10">
                                @else
                                    <img src="https://via.placeholder.com/264x352" alt="game cover" class="w-10">
                                @endif
                                <span class="span ml-4">{{ $game['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>
