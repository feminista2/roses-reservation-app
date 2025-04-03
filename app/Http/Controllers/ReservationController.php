<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Game;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Show the reservation form for a specific game
    public function create(Game $game)
    {
        // Check if a reservation already exists for this game
        $reservationExists = $game->reservations()->exists();

        // Fetch predefined opponent logos
        $opponents = [
            'Calgary Wild FC' => '/images/logos/calgary_wild_fc.svg',  
            'Halifax Tides FC' => '/images/logos/halifax_tides_fc.svg',
            'Ottawa Rapid FC' => '/images/logos/ottawa_rapid_fc.svg',
            'AFC Toronto' => '/images/logos/afc_toronto.svg',
            'Vancouver Rise FC' => '/images/logos/vancouver_rise_fc.svg'
        ];

        return view('reservations.create', compact('game', 'reservationExists', 'opponents'));
    }

    // Store a new reservation
    public function store(Request $request, Game $game)
    {
        
         \Log::info('Reservation request received:', $request->all());


        // Validate the user input
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email',
        ]);

        // Check if a reservation already exists for this game
        if ($game->reservations()->where('status', 'confirmed')->exists()) {
            return redirect()->route('games.index')->with('error', 'This game is already reserved.');
        }

        // Create a new reservation
        $reservation = new Reservation();
        $reservation->game_id = $game->id;
        $reservation->user_name = $request->user_name;
        $reservation->user_email = $request->user_email; // Add email to reservation
        $reservation->save();

        // Redirect to the Games page with a success message
        return redirect()->route('games.index')->with('success', 'Your reservation has been submitted. I will get back to you shortly!');
    }

    // Show all reservations (Admin View)
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Admins see all reservations
            $reservations = Reservation::with('game')
            ->whereHas('game') // Ensure the reservation is linked to a game
            ->orderBy(Game::select('game_date')->whereColumn('games.id', 'reservations.game_id'), 'asc')
            ->get();

            $opponents = [
                'Calgary Wild FC' => '/images/logos/calgary_wild_fc.svg',  
                'Halifax Tides FC' => '/images/logos/halifax_tides_fc.svg',
                'Ottawa Rapid FC' => '/images/logos/ottawa_rapid_fc.svg',
                'AFC Toronto' => '/images/logos/afc_toronto.svg',
                'Vancouver Rise FC' => '/images/logos/vancouver_rise_fc.svg'
            ];
        } 
        else {
            // Regular users only see their own reservations
            $reservations = Reservation::where('user_email', $user->email)->with('game')->get();

            $opponents = [
                'Calgary Wild FC' => '/images/logos/calgary_wild_fc.svg',  
                'Halifax Tides FC' => '/images/logos/halifax_tides_fc.svg',
                'Ottawa Rapid FC' => '/images/logos/ottawa_rapid_fc.svg',
                'AFC Toronto' => '/images/logos/afc_toronto.svg',
                'Vancouver Rise FC' => '/images/logos/vancouver_rise_fc.svg'
            ];
          }

        return view('reservations.index', compact('reservations', 'opponents'));
    }

    // Show the edit form for a reservation
    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    // Update a reservation
    public function update(Request $request, Reservation $reservation)
{
    // Validate input
    $request->validate([
        'user_name' => 'required|string|max:255',
        'user_email' => 'required|email',
    ]);

    // Update reservation
    $reservation->update([
        'user_name' => $request->user_name,
        'user_email' => $request->user_email,
    ]);

    // Redirect back to the reservations index for this game
    return redirect()->route('reservations.index', ['game' => $reservation->game_id])
        ->with('success', 'Reservation updated successfully!');
}

    // Delete a reservation
    public function destroy(Reservation $reservation)
{
    $gameId = $reservation->game_id; // Store the game ID before deleting

    $reservation->delete(); // Delete the reservation

    return redirect()->route('reservations.index', ['game' => $gameId])
        ->with('success', 'Reservation deleted successfully!');
}

    // Confirm a reservation
    public function confirm(Reservation $reservation)
{
    // Set all reservations for the game to "pending" before confirming one
    Reservation::where('game_id', $reservation->game_id)->update(['status' => 'pending']);

    // Set the selected reservation to "confirmed"
    $reservation->update(['status' => 'confirmed']);

    return redirect()->route('reservations.index', $reservation->game_id)->with('success', 'Reservation confirmed!');
}


}
