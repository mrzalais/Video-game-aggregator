<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MostAnticipated extends Component
{
    public array $mostAnticipated = [];

    public function loadMostAnticipatedGames(): void
    {
        $current = Carbon::now()->timestamp;
        $afterFourMonths = Carbon::now()->addMonths(2)->timestamp;

        $mostAnticipatedUnformatted = Http::withHeaders(config('services.igdb'))
            ->withBody(
                "
                fields name, cover.url, first_release_date, rating_count, platforms.abbreviation, rating,
                total_rating_count, summary;
                where platforms = (48,49,130,6)
                & (first_release_date >= {$current}
                & first_release_date < {$afterFourMonths});
                sort total_rating_count asc;
                limit 4;
                ",
                'text/plain'
            )->post('https://api.igdb.com/v4/games')
            ->json();

        $this->mostAnticipated = $this->formatForView($mostAnticipatedUnformatted);
    }

    private function formatForView($games): array
    {
        return collect($games)->map(static function ($game) {
            return collect($game)->merge([
                'coverImageUrl' => str_replace('thumb', 'cover_small', $game['cover']['url']),
                'first_release_date' => Carbon::parse($game['first_release_date'])->format('M d, Y')
            ]);
        })->toArray();
    }


    public function render(): view
    {
        return view('livewire.most-anticipated');
    }
}
