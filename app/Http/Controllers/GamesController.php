<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GamesController extends Controller
{
    public function index(): view
    {
        return view('index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($slug): view
    {
        $game = Http::withHeaders(config('services.igdb'))
            ->withBody(
                "fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating,
                slug, involved_companies.company.name, genres.name, aggregated_rating, summary, websites.*, videos.*,
                screenshots.*, similar_games.cover.url, similar_games.name, similar_games.rating,
                similar_games.platforms.abbreviation, similar_games.slug;
                where slug=\"{$slug}\";",
                "text/plain"
            )->post('https://api.igdb.com/v4/games')
            ->json();

        abort_if(!$game, 404);

        return view('show', [
            'game' => $this->formatGameForView($game[0])
        ]);
    }

    private function formatGameForView($game): Collection
    {
        return collect($game)->merge([
            'coverImageUrl' => str_replace('thumb', 'cover_big', $game['cover']['url']),

            'genre' => collect($game['genres'])->pluck('name')->implode(', '),

            'involvedCompanies' => $game['involved_companies'][0]['company']['name'],

            'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),

            'memberRating' => isset($game['rating']) ? round($game['rating']) : '0',

            'criticRating' => isset($game['aggregated_rating']) ? round($game['aggregated_rating']) : '0',

            'trailer' => 'https://youtube.com/embed/' . $game['videos'][0]['video_id'],

            'screenshots' => collect($game['screenshots'])->map(static function ($screenshot) {
                return [
                    'big' => str_replace('thumb', 'screenshot_big', $screenshot['url']),
                    'huge' => str_replace('thumb', 'screenshot_huge', $screenshot['url']),
                ];
            })->take(9),
            'similarGames' => collect($game['similar_games'])->map(function ($game) {
                return collect($game)->merge([
                    'coverImageUrl' => isset($game['cover'])

                        ? str_replace('thumb', 'cover_big', $game['cover']['url'])

                        : 'https://via.placeholder.com/264x352',

                    'rating' => isset($game['rating']) ? round($game['rating']) : 'N/A',

                    'platforms' => isset($game['platforms'])

                        ? collect($game['platforms'])->pluck('abbreviation')->implode(', ')
                        : null,
                ]);
            })->take(6),
            'social' => [
                'website' => collect($game['websites'])->first(),

                'facebook' => collect($game['websites'])->filter(static function ($website) {
                    return Str::contains($website['url'], 'facebook');
                })->first(),

                'twitter' => collect($game['websites'])->filter(static function ($website) {
                    return Str::contains($website['url'], 'twitter');
                })->first(),

                'instagram' => collect($game['websites'])->filter(static function ($website) {
                    return Str::contains($website['url'], 'instagram');
                })->first(),
            ]
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
