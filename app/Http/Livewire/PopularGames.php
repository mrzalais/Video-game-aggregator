<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PopularGames extends Component
{
    public array $popularGames = [];

    public function loadPopularGames(): void
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;

        $popularGamesUnformatted = Cache::remember('popular-games', 7, function () {
            return Http::withHeaders(config('services.igdb'))
                ->withBody(
                    "fields name, cover.url, first_release_date, total_rating_count, rating,
                    platforms.abbreviation, rating, slug;
            where platforms = (48,49,130,6)
            & total_rating_count > 500
            & rating > 90;
            sort rating desc;
            limit 12;",
                    'text/plain'
                )->post('https://api.igdb.com/v4/games')
                ->json();
        });

        $this->popularGames = $this->formatForView($popularGamesUnformatted);

        collect($this->popularGames)->filter(function ($game) {
            return $game['rating'];
        })->each(function ($game) {
            $this->emit('gameWithRatingAdded', [
                'slug' => $game['slug'],
                'rating' => $game['rating'] / 100
            ]);
        });
    }

    private function formatForView($games): array
    {
        return collect($games)->map(static function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => str_replace('thumb', 'cover_big', $game['cover']['url']),
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
                'rating' => isset($game['rating']) ? round($game['rating']) : 'N/A',
            ]);
        })->toArray();
    }

    public function render(): view
    {
        return view('livewire.popular-games');
    }
}
