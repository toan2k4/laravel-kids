@extends('admin.layouts.master')

@section('title')
    Thêm sản phẩm
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
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="product_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="product_name" name="name" placeholder="enter name"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="product_price" name="price" placeholder="enter price"
                        value="{{ old('price') }}">
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="supplier_id" class="form-label">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control">
                        <option hidden value="">Chọn</option>
                        @foreach ($suppliers as $key => $item)
                            <option value="{{ $key }}" @selected(old('supplier_id') == $key)>{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stock_qty" class="form-label">Stock Quantity </label>
                    <input type="number" class="form-control" id="stock_qty" name="stock_qty"
                        value="{{ old('stock_qty') }}">
                    @error('stock_qty')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="description" class="form-label">description </label>
                    <textarea name="description" class="form-control" id="description" cols="10" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="product_image" name="image"
                        value="{{ old('image') }}">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Add product</button>
        </div>
    </form>
@endsection
