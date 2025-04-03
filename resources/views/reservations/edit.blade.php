@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Reservation</h1>
<form action="{{ route('reservations.update', $reservation) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="user_name">Name:</label>
    <input type="text" name="user_name" id="user_name" value="{{ $reservation->user_name }}" required>

    <label for="user_email">Email:</label>
    <input type="email" name="user_email" id="user_email" value="{{ $reservation->user_email }}" required>

    <button type="submit" class="btn">Update</button>
</form>
@endsection