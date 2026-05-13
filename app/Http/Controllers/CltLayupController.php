<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\CltLayup;
use Illuminate\Http\Request;

class CltLayupController extends Controller
{
    public function index(Supplier $supplier)
    {
        $layups = $supplier->layups;

        return view(
            'layups.index',
            compact('supplier', 'layups')
        );
    }

    public function create(Supplier $supplier)
    {
        return view(
            'layups.create',
            compact('supplier')
        );
    }

    public function store(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required'
        ]);

        CltLayup::create([
            'supplier_id' => $supplier->id,
            'name' => $request->name
        ]);

        return redirect()->route(
            'suppliers.layups.index',
            $supplier
        );
    }

    public function show(Supplier $supplier, CltLayup $layup)
    {
        //
    }

    public function edit(Supplier $supplier, CltLayup $layup)
    {
        return view(
            'layups.edit',
            compact('supplier', 'layup')
        );
    }

    public function update(
        Request $request,
        Supplier $supplier,
        CltLayup $layup
    ) {
        $request->validate([
            'name' => 'required'
        ]);

        $layup->update([
            'name' => $request->name
        ]);

        return redirect()->route(
            'suppliers.layups.index',
            $supplier
        );
    }

    public function destroy(
        Supplier $supplier,
        CltLayup $layup
    ) {
        $layup->delete();

        return redirect()->route(
            'suppliers.layups.index',
            $supplier
        );
    }
}