@extends('admin.layouts.master')

@section('title')
    Chi tiết người dùng: {{ $product->name }}
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
            {{-- @dd($product->toArray()) --}}
            @foreach ($product->toArray() as $key => $value)
                <tr>
                    @php
                        if($key == 'supplier_id') continue;
                    @endphp
                    <td>
                        {{ $key }}
                    </td>
                    <td>
                        @php
                            if($key == 'image'){
                                echo '<img src="'.\Storage::url( $value).'" width="50px">';
                            }elseif ($key == 'supplier') {
                                echo $value['name'];
                            }else {
                                echo $value;
                            }
                        @endphp
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <a href="{{ route('products.index') }}" class="btn btn-success">Back</a>
@endsection
