@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">    
    <h1>Customers List</h1>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8"><a href="{{ route('customers.export') }}" class="btn btn-primary" style="margin-right:10px;">Export Customer</a><a href="{{ route('customers.download.template') }}" class="btn btn-primary" style="margin-right:10px;">Download Template</a><a href="{{ route('customers.import.form') }}" class="btn btn-primary" style="margin-right:10px;">Import Customer</a><a href="{{ route('customers.create') }}" class="btn btn-primary">Add New Customer</a></div>
    </div>    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('customers.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('customers.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('customers.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
</div>
@endsection

