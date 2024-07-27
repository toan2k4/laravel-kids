<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    const PATH_VIEW = 'admin.customers.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest('id')->paginate(3);
        return view(self::PATH_VIEW . __FUNCTION__, compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        try {

            Customer::create($request->all());

            return redirect()->route('customers.index')
                ->with('success', 'Add customer success!');

        } catch (\Exception $exception) {

            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        try {
            
            $customer->update($request->all());

            return back()
                ->with('success', 'update customer success!');

        } catch (\Exception $exception) {

            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            
            $customer->delete();

            return back()
                ->with('success', 'delete customer success!');

        } catch (\Exception $exception) {

            return back()->with('error', $exception->getMessage());
        }
    }
}
