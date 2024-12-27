@extends('layouts.app')

@section('content')
<h3><b>Import Customer</b></h3>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('customers.import') }}" method="POST" enctype="multipart/form-data">
        @csrf        
        <div class="mb-3">
            <label for="file">Choose File</label>
            <input type="file" class="form-control" name="file" id="file" required>
            @error('file')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>                
        <button type="submit" class="btn btn-primary">Import</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
@endsection