<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('supplier')->latest('id')->paginate(3);
        return view(self::PATH_VIEW . __FUNCTION__, compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        try {
            $product = $request->except('image');

            if ($request->hasFile('image')) {
                $product['image'] = Storage::put('products', $request->file('image'));
            }


            Product::create($product);

            return redirect()->route('products.index')
                ->with('success', 'Add customer success!');

        } catch (\Exception $exception) {
            if (Storage::exists($product['image']) && isset($product['image'])) {
                Storage::delete($product['image']);
            }
            return back()->with('error', $exception->getMessage());

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['supplier']);
        return view(self::PATH_VIEW . __FUNCTION__, compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('suppliers', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('products', $request->file('image'));
                if (Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }
            }

            // dd($data);
            $product->update($data);

            return back()
                ->with('success', 'update product success!');

        } catch (\Exception $exception) {
            if (Storage::exists($data['image']) && isset($data['image'])) {
                Storage::delete($data['image']);
            }
            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->orders()->sync([]);
        $product->delete();

        return back()
            ->with('success', 'Delete product success!');
    }
}
