<?php

namespace App\Http\Controllers;
use App\Models\Adicionales;
use App\Models\Tipos;
use Illuminate\Http\Request;


class AdicionalesController extends Controller
{
    public function main()
    {
        $adicionales = Adicionales::join('tipos','extras.idtipo','=','tipos.id' )
                                    ->select('extras.*','tipos.nombre as tipo_nombre')
                                    ->get();
                $tipos = Tipos::all();

        return view('adicionales.catalogo_adicionales',compact('adicionales','tipos'));

   
    }
    public function adds(){
    $adicionales=Adicionales::all();
    
    return response()->json($adicionales);

    }
     function save(Request $r){
        $context = $r -> all();
        

        // dd($context);
        switch($context['operacion']){
            case 'Agregar':  
            //Se incertan datos recibidos de la peticion
            $adicional= new Adicionales();
            $adicional -> nombre = $context['nombre'];
            $adicional->descripcion=$context['descripcion'];
            $adicional->idtipo=$context['idtipo'];
            $adicional->precio=$context['precio'];
            $exitoso=$adicional -> save();
            
            break;

            case 'Editar':
            $adicional= Adicionales::find($context['id']);
            $adicional -> nombre = $context['nombre'];
            $adicional->descripcion=$context['descripcion'];
            $adicional->idtipo=$context['idtipo'];
        
            $exitoso=$adicional -> save();                        
            break;

            case 'Eliminar':
                $usuario= Adicionales::find($context['id']);
                $exitoso=$usuario -> delete();    
                break;
        }
        if($exitoso){
            return redirect()->route('catalogo_adicionales')->with('success','Operacion exitosa');
        }
        else{
            return redirect()->route('catalogo_adicionales')->with('error','Algo salio mal');
        }
         
}
}