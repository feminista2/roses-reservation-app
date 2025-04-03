@extends('layouts.app')

@section('content')
    <div class="container text-center mx-auto">
        <h1 class ="m-8 text-5xl font-bold">Go to a Montreal Roses game with Mich!</h1>
        <div class="flex justify-center mt-4 mb-4">
        <img src="/images/logos/montreal_roses_fc.svg" 
                alt="Montreal Roses Logo" 
                class="team-logo"
                style="max-width: 100px; max-height: 100px;">
        </div>
    </div>
    <div class="container text-center mx-auto max-w-xl">
        <p class="pb-8 text-lg">Montreal finally has a professional women's &#9917; football (or soccer, if that's what you want to call it) team! For this inaugural season of the Norther Super League, I wanted to show my support to the team by getting two season tickets in the supporters' section.</p>
    </div>
    <div class="container text-center mx-auto max-w-xl">
        <p class="pb-8 text-lg">&#9917&#127801&#128153</p>
    </div>
    <div class="container text-center mx-auto max-w-xl">
        <p class="pb-4 text-lg">I intend to go to as many games as possible and want to bring a friend. If that's you, have a look at the schedule and send me a request for the game you'd like to attend.</p>
    </div>
    <div class="container text-center mx-auto max-w-xl mb-8">
        <p class="pb-8 text-lg">If the spot is already taken, it will be marked and you can't send a request.</p>
                    <a href="{{ route('games.index') }}" class="btn btn-primary">View Games</a>
    </div>
   
    <div class="container text-center mx-auto max-w-xl">
        <p class="pb-4 text-lg">If you want to be able to view your reservation(s) once submitted, you can register and log in. You don't need to do that though, it's just for your convenience.</p>
    </div>
    <div class="container text-center mx-auto max-w-xl">
        <p class="pb-10 text-lg">I will get in touch with you either way.</p>
    </div>
    <div class="container text-center mx-auto max-w-xl">
        <p class="pb-8 text-lg">&#9917&#127801&#128153</p>
    </div>
    <div class="container text-center mx-auto max-w-xl">
        <p class="pb-10 text-lg">Want to learn more about the club? Visit the <a class="underline decoration-indigo-500" href="https://en.rosesmtl.ca/">Mtl Roses FC website</a>.</p>
    </div>
    
@endsection
