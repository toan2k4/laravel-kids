@extends('admin.layouts.master')
@section('tieude')
    Thêm Customers
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif


    <form action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Chọn sản phẩm
                    </div>
                    <div class="card-body">
                        <div class=" overflow-y-scroll" style="height: 300px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Chọn</td>
                                        <td>Name</td>
                                        <td>Price</td>
                                        <td>Quantity</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($products as $key => $product)
                                        {{-- @foreach ($order->products as $pro) --}}
                                            <tr>
                                                <td><input type="checkbox" name="product_id[{{ $product->id }}]"
                                                        value="{{ $product->id }}" @checked(in_array($product->id, $product_id))></td>
                                                <td>{{ $product->name }}</td>
                                                <td>
                                                    <input type="hidden" name="price[{{ $product->id }}]"
                                                        value="{{ $product->price }}">
                                                    {{ $product->price }}

                                                </td>
                                                <td><input type="number" min="1"
                                                        value="{{ in_array($product->id, $product_id) ? $qty[$product->id] : 1}}"
                                                        name="qty[{{ $product->id }}]">
                                                </td>
                                            </tr>
                                        {{-- @endforeach --}}
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Thông tin người dùng
                    </div>
                    <div class="card-body">
                        <h5 class="text-center my-3">Thông tin người dùng</h5>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="hidden" value="{{ $order->customer->id }}" name="customer_id">
                            <input type="text" class="form-control" id="name" value="{{ $order->customer->name }}" name="name"
                                placeholder="Enter name">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" value="{{ $order->customer->email }}" name="email"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" value="{{ $order->customer->phone }}" name="phone"
                                placeholder="Enter phone">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" value="{{ $order->customer->address }}" name="address"
                                placeholder="Enter address">
                        </div>


                    </div>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Add Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-primary  mt-3">Back</a>

    </form>
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function matchCustom(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if (data.text.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                modifiedData.text += ' (matched)';

                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        $(".js-example-matcher").select2({
            matcher: matchCustom
        });
    </script>
@endsection
