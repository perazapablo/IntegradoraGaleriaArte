<?php

namespace App\Http\Controllers;
use App\Models\Productos;

use Illuminate\Http\Request;

class UnityObrasController extends Controller
{
    public function show($target)
    {
        // dd($target);
        $obra = Productos::where('target_name', $target)->first();
        if($obra){

            return response()->json($obra);
        }
        else{
            return response()->json("NADA");
        }
    }

    // Unity llama esto al presionar "Comprar"
    public function comprar(Request $request)
    {
        $obra = Productos::findOrFail($request->id);

        if ($obra->status == 1) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Esta obra ya fue vendida'
            ]);
        }

        $obra->update(['status' => 1]);

        return response()->json([
            'success'  => true,
            'mensaje'  => 'Compra realizada con éxito',
            'redirect' => url('/productos/' . $obra->id)
        ]);
    }
}
