@extends('layout')
@section('content')

<h2>Add Payment</h2>

<form method="POST" action="/payments">
@csrf
<input name="amount" type="number" step="0.01" placeholder="Amount" required>
<input name="payment_date" type="date" required>
<input name="description" placeholder="Description">
<button class="btn">Add Payment</button>
</form>

@endsection