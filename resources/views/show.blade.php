@extends('layouts.app')

@section('content')
    <h1>{{ $game->opponent }} - {{ $game->game_date }}</h1>
    <p>Location: {{ $game->location }}</p>

    <h2>Reservations</h2>
    <ul>
        @foreach ($game->reservations as $reservation)
            <li>{{ $reservation->user->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('reservations.create', $game) }}">Reserve a spot</a>
@endsection

