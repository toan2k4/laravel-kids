<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    const PATH_VIEW = 'admin.suppliers.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest('id')->paginate(3);
        return view(self::PATH_VIEW . __FUNCTION__, compact('suppliers'));
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
    public function store(StoreSupplierRequest $request)
    {
        try {

            Supplier::create($request->all());

            return redirect()->route('suppliers.index')
                ->with('success', 'Add Supplier success!');

        } catch (\Exception $exception) {

            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        try {
            
            $supplier->update($request->all());

            return back()
                ->with('success', 'update Supplier success!');

        } catch (\Exception $exception) {

            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {
            
            $supplier->delete();

            return back()
                ->with('success', 'delete Supplier success!');

        } catch (\Exception $exception) {

            return back()->with('error', $exception->getMessage());
        }
    }
}
