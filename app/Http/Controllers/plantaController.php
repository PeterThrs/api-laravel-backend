<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planta;
use Illuminate\Support\Facades\Validator;

class plantaController extends Controller
{
    
    public function index(){
       $plantas =  Planta::all();
    $data = [
        'plantas' => $plantas,
        'status '=>200
    ];
       return response()->json($data,200);
    }

    public function store(Request $request){
        $validator = Validator::make ($request->all(),[
        'nombre_comun'=> 'required|max:255',
        'nombre_cientifico' => 'required|max:255|unique:planta',
        'familia'=>'required|max:255',
        'tipo' => 'required|max:255',
        'origen' => 'required|max:255',
       'descripcion' => 'required|max:255',
       'imagen'=> 'required'
        ]);

        if($validator ->fails()){
            $data = [
                'mesage'=> 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }

        $planta = Planta::create ([
        'nombre_comun'=> $request->nombre_comun,
        'nombre_cientifico' => $request->nombre_cientifico,
        'familia'=> $request->familia,
        'tipo' => $request->tipo,
        'origen' => $request->origen,
        'descripcion' => $request->descripcion,
        'imagen'=> $request->imagen
        ]);

        if(!$planta){
            $data=[
                'message' => 'Error al crear planta',
                'status' => 500
            ];
            return response()->json($data,500);
        }
        $data = [
            'planta' => $planta,
            'status' => 201
        ];
        return response()->json($data,201);
    }

    public function show($id){
        $planta = Planta::find($id);
        if(!$planta) {
            $data = [
                'message' => 'Planta no encontrada',
                    'status' => 404
                ];
                return response()->json($data,404);    
        }
        $data = [
            'plantaa' => $planta,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function destroy($id){
        $planta = Planta::find($id);
        if(!$planta){
            $data =[
                'message' => 'Planta no encontrada',
                    'status' => 404
            ];
            return response()->json($data,404);
        }
        $planta->delete();

        $data = [
            'message' => 'Planta eliminada',
                    'status' => 200
        ];
        return response()->json($data,200);
    }

    public function update(Request $request,$id){
        $planta = Planta::find($id);
        if(!$planta){
            $data = [
                'message' => 'Planta no encontrada',
                    'status' => 404
            ];
            return response()-> json($data,404);
        }
        $validator = Validator::make($request->all(),[
            'nombre_comun'=> 'required|max:255',
            'nombre_cientifico' => 'required|max:255',
            'familia'=>'required|max:255',
            'tipo' => 'required|max:255',
            'origen' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'imagen'=> 'required'
        ]);

        if($validator->fails()){
            $data = [
                'mesage'=> 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }
        $planta ->nombre_comun = $request->nombre_comun;
        $planta ->nombre_cientifico = $request->nombre_cientifico;
        $planta ->familia = $request->familia;
        $planta ->tipo = $request->tipo;
        $planta ->origen = $request->origen;
        $planta ->descripcion = $request->descripcion;
        $planta ->imagen = $request->imagen;

        // $planta->save();
        $planta->save($request->only(['nombre_comun', 'nombre_cientifico', 'familia', 'tipo', 'origen','descripcion', 'imagen']));


        $data=[
            'message' => 'Planta actualizada',
            'planta' => $planta,
            'status' => 200
        ];
        return response()->json($data,200);

    }

    public function updatePartial(Request $request, $id){
        $planta = Planta::find($id);

        if(!$planta){
            $data = [
                'message' => 'Planta no encontrada',
                'status' => 404
            ];
            return response()-> json($data,404);
        }
        $validator = Validator::make($request->all(),[
            'nombre_comun'=> 'max:255',
            'nombre_cientifico' => 'max:255|unique:planta',
            'familia'=>'max:255',
            'tipo' => 'max:255',
            'origen' => 'max:255',
            'descripcion' => 'max:255',
        ]);

        if($validator->fails()){
            $data = [
                'mesage'=> 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }
        if($request->has('nombre_comun')){
            $planta->nombre_comun = $request->nombre_comun;
        }
        if($request->has('nombre_cientifico')){
            $planta->nombre_cientifico = $request->nombre_cientifico;
        }
        if($request->has('familia')){
            $planta->familia = $request->familia;
        }
        if($request->has('tipo')){
            $planta->tipo = $request->tipo;
        }
        if($request->has('origen')){
            $planta->origen = $request->origen;
        }
        if($request->has('descripcion')){
            $planta->descripcion = $request->descripcion;
        }
        if($request->has('imagen')){
            $planta->imagen = $request->imagen;
        }
        $planta -> save();
        $data=[
            'message' => 'Planta actualizada',
            'planta' => $planta,
            'status' => 200
        ];
        return response()->json($data,200);
    }
}
