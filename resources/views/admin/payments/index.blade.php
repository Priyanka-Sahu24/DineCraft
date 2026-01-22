@extends('layout')
@section('content')

<h2>Manage Payments</h2>

<a href="/payments/create" class="btn">Add Payment</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<div class="table-container">
<table>
<tr>
    <th>ID</th>
    <th>Amount</th>
    <th>Date</th>
    <th>Description</th>
    <th>Actions</th>
</tr>
@foreach($payments as $p)
<tr>
    <td>{{ $p->id }}</td>
    <td>{{ $p->amount }}</td>
    <td>{{ $p->payment_date }}</td>
    <td>{{ $p->description }}</td>
    <td>
        <a href="/payments/{{ $p->id }}/edit">Edit</a>
        <form method="POST" action="/payments/{{ $p->id }}" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="btn">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
</div>

@endsection