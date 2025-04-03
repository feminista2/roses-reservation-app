@extends('layouts.app')

@section('content')
    <h1>Montreal Roses Home Games</h1>
    
@if(auth()->check() && auth()->user()->isAdmin())
    <a href="{{ route('games.create') }}">Add a new game</a>
@endif
    <ul>
        @foreach ($games as $game)
            <li>
                <a href="{{ route('games.show', $game) }}">{{ $game->opponent }} on {{ $game->game_date }}</a>
            </li>
        @endforeach
    </ul>
@endsection

