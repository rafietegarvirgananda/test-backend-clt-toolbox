<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\CltLayup;
use App\Models\CltLayer;
use Illuminate\Http\Request;

class SupplierImportExportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | EXPORT ALL LAYUPS
    |--------------------------------------------------------------------------
    */

    public function export(Supplier $supplier)
    {
        $layups = CltLayup::with('layers')
            ->where('supplier_id', $supplier->id)
            ->get();

        $data = [
            'supplier' => $supplier->name,
            'layups' => []
        ];

        foreach ($layups as $layup) {

            $layupData = [
                'name' => $layup->name,
                'layers' => []
            ];

            foreach ($layup->layers as $layer) {

                $layupData['layers'][] = [

                    'layer_order' => $layer->layer_order,
                    'thickness'   => $layer->thickness,
                    'width'       => $layer->width,
                    'angle'       => $layer->angle,

                ];
            }

            $data['layups'][] = $layupData;
        }

        return response()->json(
            $data,
            200,
            [
                'Content-Disposition' =>
                    'attachment; filename='.$supplier->name.'-layups.json'
            ],
            JSON_PRETTY_PRINT
        );
    }

    /*
    |--------------------------------------------------------------------------
    | IMPORT LAYUPS
    |--------------------------------------------------------------------------
    */

    public function import(
        Request $request,
        Supplier $supplier
    ) {

        $request->validate([
            'json_file' => 'required|file|mimes:json'
        ]);

        $json = json_decode(
            file_get_contents(
                $request->file('json_file')->path()
            ),
            true
        );

        /*
        |--------------------------------------------------------------------------
        | SUPPORT OLD & NEW FORMAT
        |--------------------------------------------------------------------------
        */

        if (isset($json['layup'])) {

            // FORMAT LAMA
            $layupsData = [
                $json['layup']
            ];

        } elseif (isset($json['layups'])) {

            // FORMAT BARU
            $layupsData = $json['layups'];

        } else {

            return back()->with(
                'error',
                'Invalid JSON structure'
            );
        }

        $conflicts = [];

        /*
        |--------------------------------------------------------------------------
        | IMPORT LOOP
        |--------------------------------------------------------------------------
        */

        foreach ($layupsData as $layupJson) {

            $layup = CltLayup::firstOrCreate(

                [
                    'supplier_id' => $supplier->id,
                    'name' => $layupJson['name']
                ]
            );

            foreach ($layupJson['layers'] as $layerData) {

                $existingLayer = CltLayer::where(
                    'layup_id',
                    $layup->id
                )
                ->where(
                    'layer_order',
                    $layerData['layer_order']
                )
                ->first();

                /*
                |--------------------------------------------------------------------------
                | CONFLICT CHECK
                |--------------------------------------------------------------------------
                */

                if ($existingLayer) {

                    $isConflict =

                        $existingLayer->thickness != $layerData['thickness']
                        ||

                        $existingLayer->width != $layerData['width']
                        ||

                        $existingLayer->angle != $layerData['angle'];

                    if ($isConflict) {

                        $conflicts[] = [

                            'layup_id' => $layup->id,

                            'existing' => [

                                'layer_order' =>
                                    $existingLayer->layer_order,

                                'thickness' =>
                                    $existingLayer->thickness,

                                'width' =>
                                    $existingLayer->width,

                                'angle' =>
                                    $existingLayer->angle,
                            ],

                            'incoming' => [

                                'layer_order' =>
                                    $layerData['layer_order'],

                                'thickness' =>
                                    $layerData['thickness'],

                                'width' =>
                                    $layerData['width'],

                                'angle' =>
                                    $layerData['angle'],
                            ]
                        ];

                        continue;
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | INSERT / UPDATE
                |--------------------------------------------------------------------------
                */

                CltLayer::updateOrCreate(

                    [
                        'layup_id' => $layup->id,
                        'layer_order' => $layerData['layer_order']
                    ],

                    [
                        'thickness' => $layerData['thickness'],
                        'width' => $layerData['width'],
                        'angle' => $layerData['angle']
                    ]
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CONFLICT PAGE
        |--------------------------------------------------------------------------
        */

        if (count($conflicts)) {

            session([
                'import_conflicts' => $conflicts
            ]);

            return redirect()->route(
                'suppliers.conflicts',
                $supplier
            );
        }

        return back()->with(
            'success',
            'Layups imported successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESOLVE CONFLICTS
    |--------------------------------------------------------------------------
    */

    public function resolveConflicts(
        Request $request,
        Supplier $supplier
    ) {

        $request->validate([

            'layup_id' => 'required',
            'layer_order' => 'required',
            'action_type' => 'required'

        ]);

        if ($request->action_type === 'incoming') {

            CltLayer::updateOrCreate(

                [
                    'layup_id' => $request->layup_id,

                    'layer_order' => $request->layer_order
                ],

                [
                    'thickness' => $request->thickness,
                    'width' => $request->width,
                    'angle' => $request->angle
                ]
            );
        }

        $conflicts = session(
            'import_conflicts',
            []
        );

        array_shift($conflicts);

        session([
            'import_conflicts' => $conflicts
        ]);

        if (count($conflicts) === 0) {

            return redirect()
                ->route(
                    'suppliers.layups.index',
                    $supplier
                )
                ->with(
                    'success',
                    'All conflicts resolved'
                );
        }

        return redirect()->route(
            'suppliers.conflicts',
            $supplier
        );
    }
}