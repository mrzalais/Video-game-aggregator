<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GameCardSmall extends Component
{
    public $game;

    public function __construct($game)
    {
        $this->game = $game;
    }

    public function render(): view
    {
        return view('components.game-card-small');
    }
}
