@extends('layout')
@section('content')

<h2>Edit Payment</h2>

<form method="POST" action="/payments/{{ $payment->id }}">
@csrf
@method('PUT')
<input name="amount" type="number" step="0.01" value="{{ $payment->amount }}" required>
<input name="payment_date" type="date" value="{{ $payment->payment_date }}" required>
<input name="description" value="{{ $payment->description }}" placeholder="Description">
<button class="btn">Update Payment</button>
</form>

@endsection