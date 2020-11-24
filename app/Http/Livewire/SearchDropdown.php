<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public string $search = '';
    public array $searchResults = [];

    public function render(): view
    {
        if (strlen($this->search) >= 2) {
            $this->searchResults = Http::withHeaders(config('services.igdb'))
                ->withBody(
                    "
                search \"{$this->search}\";
                fields name, slug, cover.url;
            limit 8;
            ",
                    'text/plain'
                )->post('https://api.igdb.com/v4/games')
                ->json();
        }

        return view('livewire.search-dropdown');
    }
}
