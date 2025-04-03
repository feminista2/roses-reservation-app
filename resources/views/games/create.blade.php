@extends('layouts.app')

@section('content')
    <h1>Create a Game</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('games.store') }}" method="POST">
        @csrf

        <!-- Opponent Dropdown -->
        <label>Opponent:</label><br>
        <select name="opponent" class="form-control"> 
    		@foreach ($opponents as $teamName => $logoPath)
        		<option value="{{ $teamName }}">{{ $teamName}}</option>
    		@endforeach
        </select><br><br>


        <!-- Game Date -->
        <label>Game Date:</label><br>
		<input type="date" name="game_date" value="{{ old('game_date') }}"><br><br>

        <!-- Kickoff Time -->
        <label>Kickoff Time:</label><br>
        <input type="time" name="kickoff_time" value="{{ old('kickoff_time') }}"><br><br>

        <!-- Location Dropdown -->
        <label>Location:</label><br>
        <select name="location">
    		@foreach ($locations as $place)
        		<option value="{{ $place }}" {{ old('location') == $place ? 'selected' : '' }}>
        			 {{ $place }}
        		</option>
    		@endforeach
        </select>

        <!-- Reservation Type -->
        <label>Reservation Type</label><br>
        <input type="text" name="reservation_type" value="{{ old('reservation_type') }}"><br><br>

	<button type="submit">Add Game</button>
    </form>
@endsection

