<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\CltLayup;
use App\Models\CltLayer;
use Illuminate\Http\Request;

class CltLayerController extends Controller
{
    public function index(
        Supplier $supplier,
        CltLayup $layup
    ) {
        $layers = $layup->layers;

        return view(
            'layers.index',
            compact('supplier', 'layup', 'layers')
        );
    }

    public function create(
        Supplier $supplier,
        CltLayup $layup
    ) {
        return view(
            'layers.create',
            compact('supplier', 'layup')
        );
    }

    public function store(
        Request $request,
        Supplier $supplier,
        CltLayup $layup
    ) {
        $request->validate([
            'layer_order' => 'required|integer',
            'thickness' => 'required|numeric',
            'width' => 'required|numeric',
            'angle' => 'required|numeric',
        ]);

        CltLayer::create([
            'layup_id' => $layup->id,
            'layer_order' => $request->layer_order,
            'thickness' => $request->thickness,
            'width' => $request->width,
            'angle' => $request->angle,
        ]);

        return redirect()->route(
            'suppliers.layups.layers.index',
            [$supplier, $layup]
        );
    }

    public function edit(
        Supplier $supplier,
        CltLayup $layup,
        CltLayer $layer
    ) {
        return view(
            'layers.edit',
            compact('supplier', 'layup', 'layer')
        );
    }

    public function update(
        Request $request,
        Supplier $supplier,
        CltLayup $layup,
        CltLayer $layer
    ) {
        $request->validate([
            'layer_order' => 'required|integer',
            'thickness' => 'required|numeric',
            'width' => 'required|numeric',
            'angle' => 'required|numeric',
        ]);

        $layer->update([
            'layer_order' => $request->layer_order,
            'thickness' => $request->thickness,
            'width' => $request->width,
            'angle' => $request->angle,
        ]);

        return redirect()->route(
            'suppliers.layups.layers.index',
            [$supplier, $layup]
        );
    }

    public function destroy(
        Supplier $supplier,
        CltLayup $layup,
        CltLayer $layer
    ) {
        $layer->delete();

        return redirect()->route(
            'suppliers.layups.layers.index',
            [$supplier, $layup]
        );
    }
}