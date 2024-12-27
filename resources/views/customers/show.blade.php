@extends('layouts.app')

@section('content')
<div class="container">    
    <h3>{{$customer->name}}</h3>
    <table class="table table-striped">
        <tbody>
            <tr><td>Id</td> : <td>{{ $customer->id }}</td></tr>
            <tr><td>Name</td> : <td>{{ $customer->Name }}</td></tr>
            <tr><td>Email</td> : <td>{{ $customer->email }}</td></tr>
            <tr><td>Phone Number</td> : <td>{{ $customer->phone_number }}</td></tr>
            <tr><td>Address</td> : <td>{{ $customer->address }}</td></tr>
            <tr><td>Created At</td> : <td>{{ $customer->created_at->format('Y-m-d H:i') }}</td></tr>
        </tbody>
    </table>
    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection