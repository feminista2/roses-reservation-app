@extends('layouts.app')

@section('content')
    <h1>{{ $game->opponent }} vs {{ $game->game_date }}</h1>
    <p>Location: {{ $game->location }}</p>

    @if ($game->reservations()->exists())
        <p>This game has already been reserved.</p>
    @else
        <p><a href="{{ route('reservations.create', $game) }}">Sign up to attend this game</a></p>
    @endif

    <a href="{{ route('games.index') }}">Back to Games List</a>
@endsection