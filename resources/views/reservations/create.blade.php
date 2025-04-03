@extends('layouts.app')

@section('content')
    <h1 class="font-bold text-3xl text-center">Reserve Your Spot</h1>   

    <div class="flex justify-center mt-4 mb-4">
        <img src="/images/logos/montreal_roses_fc.svg" 
                alt="Montreal Roses Logo" 
                class="team-logo"
                style="max-width: 100px; max-height: 100px;">
        <img src="{{ asset($opponents[$game->opponent] ?? '/images/logos/default.svg') }}" 
                alt="{{ $game->opponent }} logo" 
                class="team-logo"
                style="max-width: 100px; max-height: 100px;">
    </div>
    <p class="font-bold text-center">Montreal Roses - {{ $game->opponent }}</p>
    <p class="text-center">{{ \Carbon\Carbon::parse($game->game_date)->format('l M d, Y') }}, {{ $game->kickoff_time }}</p>

    @if($game->reservations->where('status', 'confirmed')->count() > 0)
                    <div class="flex justify-center mt-4"><p class="text-center max-w-96 text-indigo-500">Sorry, this spot is already taken!</p>
                    </div>
    @elseif($game->reservations->count() > 4)
        <div class="flex justify-center mt-4"><p class="text-center max-w-96 text-indigo-500">Nothing is confirmed yet, but there are already a number of reservations. Check back later!</p>
        </div>

    @elseif($game->reservations->count() > 0)
        <div class="flex justify-center mt-4"><p class="text-center max-w-96">Someone else is also interested in this spot. Nothing has been confirmed yet, so you can still make a reservation.<br>
            Leave your name and email address and I will get back to you to confirm!</p>
        </div>
        <form class="text-center mt-6" action="{{ route('reservations.store', $game) }}" method="POST">
            @csrf
            <label for="user_name">Your Name:</label><br>
            <input type="text" name="user_name" id="user_name" required><br><br>
            <label for="user_email">Your Email:</label><br>
            <input type="email" name="user_email" id="user_email" required><br><br>
            
            <button class="btn" type="submit">Make Reservation</button>
        </form>
    @else
         <div class="flex justify-center mt-4">
            <p class="text-center max-w-96">Leave your name and email address and I will get back to you to confirm!</p>
        </div>
        <form class="text-center mt-6" action="{{ route('reservations.store', $game) }}" method="POST">
            @csrf
            <label for="user_name">Your Name:</label><br>
            <input type="text" name="user_name" id="user_name" required><br><br>
            <label for="user_email">Your Email:</label><br>
            <input type="email" name="user_email" id="user_email" required><br><br>
            
            <button class="btn" type="submit">Make Reservation</button>
        </form>
    @endif
    <div class="text-center mt-8 underline">
        <a href="{{ route('games.index', $game) }}">Back to list of games</a>
    </div>
@endsection
