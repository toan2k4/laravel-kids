@extends('admin.layouts.master')

@section('title')
    Sửa nhà cung cấp: {{ $supplier->name }}
@endsection

@section('content')
    <div class="mt-3">
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>
    <form action="{{ route('suppliers.update', $supplier) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="supplier_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="supplier_name" name="name" placeholder="enter name"
                value="{{ $supplier->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="supplier_address" class="form-label">Address</label>
            <input type="text" class="form-control" id="supplier_address" name="address" placeholder="enter address"
                value="{{ $supplier->address }}">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="supplier_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="supplier_phone" name="phone" placeholder="enter phone"
                value="{{ $supplier->phone }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="supplier_exampleFormControlInput1" class="form-label">Email </label>
            <input type="email" class="form-control" id="supplier_exampleFormControlInput1" name="email"
                placeholder="name@example.com" value="{{ $supplier->email }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-success">Add supplier</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-primary">Back</a>
        
        </div>
    </form>
@endsection
