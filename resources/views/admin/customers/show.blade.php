@extends('admin.layouts.master')

@section('title')
    Chi tiết người dùng: {{ $customer->name }}
@endsection

@section('content')
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customer->toArray() as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <a href="{{ route('customers.index')}}" class="btn btn-success">Back</a>
@endsection
