@extends('admin.layouts.master')

@section('title')
    Danh sách người dùng
@endsection

@section('content')
    <div class="">
        <a href="{{ route('suppliers.create') }}" class="btn btn-success">Add</a>
    </div>

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

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Stt</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        <a href="{{ route('suppliers.show', $item) }}" class="btn btn-primary mt-3">Show</a>
                        <a href="{{ route('suppliers.edit', $item) }}" class="btn btn-warning mt-3">Edit</a>

                        <form action="{{ route('suppliers.destroy', $item) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick="return confirm('Are you sure!')"
                                class="btn btn-danger mt-3">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    {{ $suppliers->links() }}
@endsection
