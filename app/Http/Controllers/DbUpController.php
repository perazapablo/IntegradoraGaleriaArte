<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Clientes;
use App\Models\Usuarios;
use App\Models\Generos;
use App\Models\Ocupaciones;
use App\Models\Edad;
use App\Models\Productos;
use App\Models\FormaPago;
use App\Models\Tamanio;
use App\Models\Canal;
use App\Models\Adicionales;

use Faker\Factory as Faker;

use App\Services\ServicioVenta;
use stdClass;

class DbUpController extends Controller
{

    public function Cliente(){
        
        set_time_limit(300);
        $faker= Faker::create();
        $edad=Edad::all();
        $genero=Generos::all();
        $ocupacion=Ocupaciones::all();
        for($i=0;$i<=100;$i++){
            $nuevo_usuario = Usuarios::create([
                    'idrol'    => 3,
                    'email'    => $faker->email,
                    'password' => bcrypt(123456),
                    'fecha_creacion' => $faker->dateTimeBetween("-1 year","now")
                ]);
            $nombre=$faker->name;
            $apellido=$faker->lastName;
            $cliente=new Clientes();
            $cliente->idusuario=$nuevo_usuario->id;
            $cliente->nombre=$nombre.' '.$apellido;
            $cliente->email=$nuevo_usuario->email;
            $cliente->idgenero=$genero->random()->id;
            $cliente->idedad=$edad->random()->id;
            $cliente->idocupacion=$ocupacion->random()->id;
            $cliente->fecha_creacion=$nuevo_usuario->fecha_creacion;
            $cliente->save();
        }
        return "100 clientes creados con éxito";
    }

    public function Crear_Orden(){
        set_time_limit(200);
        $servicio=new ServicioVenta();
        $faker= Faker::create();
        $clientes=Clientes::all();
        $productos=Productos::all();
        $extras=Adicionales::all();
        $canales=Canal::all();
        $forma_pago=FormaPago::all();
        $tamanios=Tamanio::all();
        for($i= 0;$i<= 100;$i++){
            $orden=new stdClass();
            $canal_elegido = $canales->random();
            $orden->idcanal = $canal_elegido->id;
            $orden->canal= $canal_elegido->nombre;
            $orden->fecha=$faker->dateTimeBetween("-1 year","now");
            $orden->idcliente=$clientes->random()->id;
            $orden->idforma_pago=$forma_pago->random()->id;
            $orden->productos=[];

            $numero_productos=$faker->numberBetween(1,count($productos));
            $lista_productos=$productos->random($numero_productos);

            foreach($lista_productos as $producto){
                $numero_extras=$faker->numberBetween(1,3);
                $lista_extras=$extras->random($numero_extras);
                $extras_aleatorios=[];
                foreach($lista_extras as $extra){
                    $extras_aleatorios[]=[
                        "id"=>$extra["id"],
                        "nombre"=> $extra["nombre"],
                        "cantidad"=>$faker->numberBetween(1,3),
                        "precio"=>$extra["precio"],
                        "idtipo"=>$extra["idtipo"],
                    ];
                }

                $orden->productos[]=[
                    "id"=>$producto->id,
                    "cantidad"=>$faker->numberBetween(1,5),
                    "precio"=>$producto->precio,
                    "tamanio"=>$tamanios->random()->id,
                    "adicionales"=>$extras_aleatorios,
                ];
            }
            $servicio->guardar_orden($orden);
        }
        return "100 ordenes creadas correctamente";
    }

}
