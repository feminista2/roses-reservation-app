@extends('layouts.app')

@section('content')
    <h1>Game Details</h1>
    <p class="fixture-date">{{ \Carbon\Carbon::parse($game->game_date)->translatedFormat('l j F, Y') }}</p>
    <p>Kickoff Time: {{ \Carbon\Carbon::parse($game->kickoff_time)->format('H:i') }}</p>

<p class="fixture">
    Montreal Roses FC vs {{ $game->opponent }}
    <img src="{{ asset($opponents[$game->opponent] ?? '/images/logos/default.svg') }}" 
         alt="{{ $game->opponent }} logo" 
         class="team-logo">
    
</p>    
<p>Location: {{ $game->location }}</p>
<p>Reservation Info: {{ $game->reservation_type }}</p>

    @if ($game->reservations()->exists())
        <p>This game has already been reserved.</p>
    @else
        <p><a href="{{ route('reservations.create', $game) }}">Sign up to attend this game</a></p>
    @endif

    <a href="{{ route('games.index') }}">Back to Games List</a>
@endsection