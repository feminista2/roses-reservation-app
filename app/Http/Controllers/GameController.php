<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
     // Display all games
    public function index()
    {
        $games = Game::orderBy('game_date', 'asc')->get(); // Order games by date (ascending)
        $gameOptions = $this->getGameOptions(); // Fetch opponents list

        return view('games.index', [
            'games' => $games,
            'opponents' => $gameOptions['opponents'], // Pass logos to the view
             ]);
    }

    // Show a single game with reservations
    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    //Method to return predefined opponents and locations
   public function getGameOptions()
   {
	return [
	    'opponents' => [
		    'Calgary Wild FC' => '/images/logos/calgary_wild_fc.svg',  
            'Halifax Tides FC' => '/images/logos/halifax_tides_fc.svg',
            'Ottawa Rapid FC' => '/images/logos/ottawa_rapid_fc.svg',
            'AFC Toronto' => '/images/logos/afc_toronto.svg',
            'Vancouver Rise FC' => '/images/logos/vancouver_rise_fc.svg'
	    ],
	    'locations' => [
		'Centre sportif Bois-de-Boulogne'
	    ],
	];
    }

    // Create a new game
    public function create()
    {
	$gameOptions = $this->getGameOptions();
	return view('games.create', $gameOptions);        

    }

    //Edit a game
    public function edit(Game $game)
    {
	$gameOptions = $this->getGameOptions();
	return view('games.edit', array_merge($gameOptions, ['game' => $game]));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'opponent' => 'required|string|max:255',
            'game_date' => 'required|date',
            'kickoff_time' => 'required',
            'location' => 'required|string|max:255',
            'reservation_type' => 'required|string|max:255'
        ]);

        $game = Game::create($validated);

        return redirect()->route('games.index');
    }

    public function update(Request $request, Game $game)
    {
	$validated = $request->validate([
	    'opponent' => 'required|string|max:255',
            'game_date' => 'required|date',
            'kickoff_time' => 'required',
            'location' => 'required|string|max:255',
            'reservation_type' => 'required|string|max:255'
	]);

	$game->update($validated);

	return redirect()->route('games.index');
    }

}
