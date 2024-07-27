@extends('admin.layouts.master')
@section('tieude')
    Danh sách Order
@endsection
@section('content')
    <div class="">
        <a href="{{ route('orders.create') }}" class="btn btn-success">Add</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name order</th>
                <th scope="col">Total</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->updated_at }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success">Show</a>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{route('orders.destroy', $order->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('bạn có chắc chắn muốn xóa khoong')" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

@endsection
