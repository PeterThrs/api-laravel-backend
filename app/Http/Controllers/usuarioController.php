<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;

class usuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        // if($usuarios -> isEmpty()){
        //     $data = [
        //         'message' => 'No se encontraron estudiantes',
        //         'status' => 200
        //     ];
        //     return response()-> json($data, 200);
        // }

        $data = [
            'usuarios' => $usuarios,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:usuario',
            'password' => 'required',
            'phone' => 'required|digits:10',
            'img_url' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuario = Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'img_url' => $request->img_url
        ]);

        if (!$usuario) {
            $data = [
                'message' => 'Error al crear al usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $usuario,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'usuario' => $usuario,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $usuario->delete();

        $data = [
            'message' => 'Usuario Eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required|digits:10',
            'img_url' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->phone = $request->phone;
        $usuario->img_url = $request->img_url;

        $usuario->save($request->only(['name', 'email', 'password', 'phone', 'img_url']));

        $data = [
            'message' => 'Usuario Actualizado',
            'usuario' => $usuario,
            'status' => 200
        ];
        return response()->json($data, 200);

    }

    public function updatePartial(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => '',
            'email' => 'email',
            'password' => '',
            'phone' => 'digits:10',
            'img_url' => ''
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        if ($request->has('name')) {
            $usuario->name = $request->name;
        }
        if ($request->has('email')) {
            $usuario->email = $request->email;
        }
        if ($request->has('password')) {
            $usuario->password = $request->password;
        }
        if ($request->has('phone')) {
            $usuario->phone = $request->phone;
        }
        if ($request->has('img_url')) {
            $usuario->img_url = $request->img_url;
        }
        $usuario->save();

        $data = [
            'message' => 'Usuario Actualizado',
            'usuario' => $usuario,
            'status' => 200
        ];
        return response()->json($data, 200);

    }

}
