@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif


@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


    <h1 class="font-bold text-3xl text-center">Montreal Roses Home Games</h1>
    <div class="flex justify-center mt-4 mb-4">
        <img src="/images/logos/montreal_roses_fc.svg" 
                alt="Montreal Roses Logo" 
                class="team-logo"
                style="max-width: 100px; max-height: 100px;">
    </div>

    @if($games->isEmpty())
        <p>No games scheduled yet.</p>
    @else
        <div class="grid gap-6">
    @foreach ($games as $game)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 lg:grid-cols-4 gap-6 border border-gray-300 p-4 rounded-lg shadow-lg">
            <!-- Column 1: Date and Time, Location -->
            <div class="flex flex-col items-center text-center">
                <p class="text-lg font-semibold">{{ \Carbon\Carbon::parse($game->game_date)->format('l M d, Y') }}, {{ $game->kickoff_time }}</p>
                <p class="text-gray-500 mt-2">{{ $game->location }}</p>
            </div>

            <!-- Column 2: Opponent Name and Logo -->
            <div class="flex flex-col items-center">
                <!-- Use the passed opponent name -->
                <p class="text-lg font-semibold">{{ $game->opponent }}</p>
                
                <!-- Use the correct path for the logo -->
                <img src="{{ asset($opponents[$game->opponent] ?? '/images/logos/default.svg') }}" 
                alt="{{ $game->opponent }} logo" 
                class="team-logo"
                style="max-width: 100px; max-height: 100px;">
            </div>

            <!-- Column 3: Reservation Info -->
            <div class="flex flex-col items-center text-center">
                <p class="text-gray-800 p-4">{{ $game->reservation_type }}</p>
            </div>


            <!-- Column 4: Reservation Status or Button -->
            <div class="flex flex-col justify-between items-center">

                <!-- Reservation Status or Button (Visible to all) -->
                @if($game->reservations->where('status', 'confirmed')->count() > 0)
                    <p class="text-indigo-500">Reserved</p>
                @elseif($game->reservations->count() > 5)
                    <p class="text-indigo-500">Reservation pending</p>
                @elseif($game->reservations->count() > 0)
                    <p class="text-indigo-500 text-center">Someone else is also interested, but you can still try.</p>
                    <a href="{{ route('reservations.create', $game->id) }}" class="btn">Reserve</a>
                @else
                    <a href="{{ route('reservations.create', $game->id) }}" class="btn">Reserve</a>
                @endif

                @auth
                    @if(auth()->user()->isAdmin()) 
                    <!-- Admin Edit Button -->
                    <a href="{{ route('games.edit', $game->id) }}" class="btn ml-2">Edit Game</a>
                    @endif
                @endauth
            </div>
        </div>
    @endforeach
</div>
    @endif

    @auth
        @if(auth()->user()->isAdmin()) 
            <div class="m-8">
                <a href="{{ route('games.create') }}" class="btn">Add a new game</a>
            </div>
        @endif
    @endauth

@endsection


