@extends('customer.layout')

@section('content')
<h1>Your Profile</h1>
@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
<form method="POST" action="/customer/profile/update">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" value="{{ $user->name }}" required><br>
    <label>Email:</label>
    <input type="email" name="email" value="{{ $user->email }}" required><br>
    <button type="submit">Update</button>
</form>
@endsection