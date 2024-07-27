@extends('admin.layouts.master')

@section('title')
    Sửa người dùng: {{ $customer->name }}
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
    <form action="{{ route('customers.update', $customer) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="customer_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="customer_name" name="name" placeholder="enter name"
                value="{{ $customer->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="customer_address" class="form-label">Address</label>
            <input type="text" class="form-control" id="customer_address" name="address" placeholder="enter address"
                value="{{ $customer->address }}">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="customer_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="customer_phone" name="phone" placeholder="enter phone"
                value="{{ $customer->phone }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="customer_exampleFormControlInput1" class="form-label">Email </label>
            <input type="email" class="form-control" id="customer_exampleFormControlInput1" name="email"
                placeholder="name@example.com" value="{{ $customer->email }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-success">Add Customer</button>
        </div>
    </form>
@endsection
