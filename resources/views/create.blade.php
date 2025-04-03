@extends('layouts.app')

@section('content')
    <h1>Reserve a spot for {{ $game->opponent }} - {{ $game->game_date }}</h1>

    <form action="{{ route('reservations.store', $game) }}" method="POST">
        @csrf
        <label for="user_id">Your User ID:</label>
        <input type="text" name="user_id" required>
        <button type="submit">Reserve</button>
    </form>
@endsection
