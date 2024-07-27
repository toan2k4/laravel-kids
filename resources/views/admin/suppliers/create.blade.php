@extends('admin.layouts.master')

@section('title')
    Thêm người dùng
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
    <form action="{{ route('suppliers.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="supplier_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="supplier_name" name="name" placeholder="enter name"
                value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="supplier_address" class="form-label">Address</label>
            <input type="text" class="form-control" id="supplier_address" name="address" placeholder="enter address"
                value="{{ old('address') }}">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="supplier_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="supplier_phone" name="phone" placeholder="enter phone"
                value="{{ old('phone') }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="supplier_exampleFormControlInput1" class="form-label">Email </label>
            <input type="email" class="form-control" id="supplier_exampleFormControlInput1" name="email"
                placeholder="name@example.com" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-success">Add supplier</button>
        </div>
    </form>
@endsection
