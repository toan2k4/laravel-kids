@extends('admin.layouts.master')
@section('tieude')
    Danh sách orders
@endsection
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Tên trường</th>
                <th scope="col">Giá trị</th>
            </tr>
        </thead>
        <tbody>
            {{-- @dd($order->toArray()) --}}
            @foreach ($order->toArray() as $col => $value)
                @php
                    if ($col == 'customer_id') {
                        continue;
                    }
                @endphp
                <tr>
                    <td>{{ $col }}</td>
                    <td class="align-items-center">

                        @php

                            if ($col == 'customer') {
                                echo $value['name'];
                            } elseif ($col == 'details') {
                                $html = '';
                                foreach ($value as $key => $item) {
                                    $html .=
                                        '
                                        <tr>
                                            <td>' .
                                        ($key + 1) .
                                        '</td>
                                            <td>' .
                                        $item['name'] .
                                        '</td>
                                            <td>' .
                                        $item['pivot']['price'] .
                                        '</td>
                                            <td>' .
                                        $item['pivot']['qty'] .
                                        '</td>
                                        </tr>
                                    ';
                                }
                                echo '<table class="table table-bordered" border="1">
                                            <tr>
                                                <td>STT</td>
                                                <td>Name</td>
                                                <td>Price</td>
                                                <td>Quantity</td>
                                            </tr>
                                            ' .
                                    $html .
                                    '
                                        </table>';
                            } else {
                                echo $value;
                            }
                        @endphp
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <a href="{{ route('orders.index') }}" class="btn btn-success text-left">Back</a>

    </div>
@endsection
