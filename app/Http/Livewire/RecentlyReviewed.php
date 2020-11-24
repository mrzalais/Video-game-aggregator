<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public array $recentlyReviewed = [];

    public function loadRecentlyReviewed(): void
    {
        $current = Carbon::now()->timestamp;
        $before = Carbon::now()->subMonths(2)->timestamp;

        $recentlyReviewedUnformatted = Http::withHeaders(config('services.igdb'))
            ->withBody(
                "fields name, cover.url, first_release_date, rating_count, rating, platforms.abbreviation,
                 rating, summary, slug;
            where platforms = (48,49,130,6)
            & rating != null
            & (first_release_date >= {$before}
            & first_release_date <= {$current})
            & rating_count > 5;
            sort rating desc;
            limit 3;",
                'text/plain'
            )->post('https://api.igdb.com/v4/games')
            ->json();

        $this->recentlyReviewed = $this->formatForView($recentlyReviewedUnformatted);

        collect($this->recentlyReviewed)->filter(function ($game) {
            return $game['rating'];
        })->each(function ($game) {
            $this->emit('reviewGameWithRatingAdded', [
                'slug' => 'review_' . $game['slug'],
                'rating' => $game['rating'] / 100
            ]);
        });
    }

    private function formatForView($games): array
    {
        return collect($games)->map(static function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => str_replace('thumb', 'cover_big', $game['cover']['url']),
                'rating' => isset($game['rating']) ? round($game['rating']) : null,
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
            ]);
        })->toArray();
    }

    public function render(): view
    {
        return view('livewire.recently-reviewed');
    }
}
