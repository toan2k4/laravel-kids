@extends('admin.layouts.master')

@section('title')
    Chi tiết người dùng: {{ $supplier->name }}
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
            @foreach ($supplier->toArray() as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <a href="{{ route('suppliers.index')}}" class="btn btn-success">Back</a>
@endsection
