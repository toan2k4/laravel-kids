<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';
    public function index()
    {
        $orders = Order::with('customer')->latest()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $customers = Customer::pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('products', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {

        // lấy product_id, quantity và price
        $product_id = $request->product_id;
        $qty = array_intersect_key($request->qty, $product_id);
        $price = array_intersect_key($request->price, $product_id);

        $totalPrice = 0;
        foreach ($product_id as $key) {
            $totalPrice += $qty[$key] * $price[$key];
        }

        try {
            DB::beginTransaction();

            // customer_id
            if (empty($request->customer_id)) {
                $dataCustomer = $request->only(['name', 'email', 'phone', 'address']);
                $customer = Customer::create($dataCustomer);
                $customer_id = $customer->id;
            } else {
                $customer_id = $request->customer_id;
            }

            // insert Order
            $order = Order::create([
                'customer_id' => $customer_id,
                'total_amount' => $totalPrice,
            ]);

            foreach ($product_id as $id) {
                $order->details()->attach($id, [
                    'qty' => $qty[$id],
                    'price' => $price[$id]
                ]);
            }

            DB::commit();

            return redirect()->route('orders.index')
                ->with('success', 'Thêm order thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'details']);
        return view(self::PATH_VIEW . __FUNCTION__, compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->load(['customer', 'details']);
        $products = Product::all();
        $customers = Customer::pluck('name', 'id')->all();
        $product_id = [];
        $qty = [];
        foreach ($order->details as $value) {
            $product_id[] = $value->pivot->product_id;
            $qty[$value->pivot->product_id] = $value->pivot->qty;
        }
        return view(self::PATH_VIEW . __FUNCTION__, compact('order', 'products', 'customers', 'product_id', 'qty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        // lấy product_id, quantity và price
        $product_id = $request->product_id;
        $qty = array_intersect_key($request->qty, $product_id);
        $price = array_intersect_key($request->price, $product_id);

        // tính total price
        $totalPrice = 0;
        foreach ($product_id as $key) {
            $totalPrice += $qty[$key] * $price[$key];
        }


        $customer_id = $request->customer_id;
        $dataCustomer = $request->only(['name', 'email', 'phone', 'address']);
        try {
            DB::beginTransaction();

            // customer_id
            $customer = Customer::find($customer_id);
            $customer->update($dataCustomer);

            $data = [];
            foreach ($product_id as $id) {

                $data[$id] = [
                    'qty' => $qty[$id],
                    'price' => $price[$id]
                ];

            }
            $order->details()->sync($data);

            DB::commit();

            return back()
                ->with('success', 'Sửa order thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            $order->details()->sync([]);
            $order->delete();

            return back()
                ->with('success', 'Xóa order thành công');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());

        }
    }
}
