@extends('layouts.app')

@section('content')
    <h1>Edit Game: {{ $game->opponent }} on {{ $game->game_date }}</h1>

    <form action="{{ route('games.update', $game) }}" method="POST">
        @csrf
        @method('PUT') <!-- This tells Laravel the request is for an update -->

        <label>Opponent:</label><br>
        <select name="opponent" class="form-control"> 
            @foreach ($opponents as $teamName => $logoPath)
                <option value="{{ $teamName }} " {{ old('opponent', $game->opponent) == $teamName ? 'selected' : '' }}>{{ $teamName}}</option>
            @endforeach
        </select><br><br>

        <label>Game Date:</label><br>
        <input type="date" name="game_date" value="{{ old('game_date', $game->game_date) }}"><br><br>

        <label>Kickoff Time:</label><br>
        <input type="time" name="kickoff_time" value="{{ old('kickoff_time', $game->kickoff_time) }}"><br><br>

        <label>Location:</label><br>
        <select name="location">
            @foreach ($locations as $place)
                <option value="{{ $place }}" {{ old('location', $game->location) == $place ? 'selected' : '' }}>
                    {{ $place }}
                </option>
            @endforeach
        </select><br><br>

        <label>Reservation Type:</label><br>
        <input type="text" size="80" name="reservation_type" value="{{ old('reservation_type', $game->reservation_type) }}"><br><br>
        <button class="btn" type="submit">Update Game</button>
    </form>

    <a href="{{ route('games.index') }}">Back to Games List</a>
@endsection

