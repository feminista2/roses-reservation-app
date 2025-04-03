@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Reservations</h1>
<table class="w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">Game</th>
            <th class="border px-4 py-2">User Name</th>
            <th class="border px-4 py-2">User Email</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $reservation)
        <tr class="border">
            <td class="border px-4 py-2"><strong>{{ \Carbon\Carbon::parse($reservation->game->game_date)->format('l M d, Y') }}, {{ $reservation->game->kickoff_time }}</strong><br>{{ $reservation->game->opponent }}  <img src="{{ asset($opponents[$reservation->game->opponent] ?? '/images/logos/default.svg') }}" 
                alt="{{ $reservation->game->opponent }} logo" 
                class="team-logo"
                style="max-width: 100px; max-height: 100px;">

            </td>
            <td class="border px-4 py-2">{{ $reservation->user_name }}</td>
            <td class="border px-4 py-2">{{ $reservation->user_email }}</td>
            <td class="border px-4 py-2">{{ $reservation->status }}</td>
            <td class="border px-4 py-2">                
                @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->email === $reservation->user_email)
                        <a href="{{ route('reservations.edit', $reservation) }}" class="btn">Edit</a>
                        
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn mt-2">
                                Delete
                            </button>
                        </form>
                    @endif
                    
                    @if(auth()->user()->isAdmin())
                        <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn mt-2">Confirm</button>
                        </form>
                    @endif
                @endauth
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection