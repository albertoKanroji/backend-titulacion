<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'apellido2' => 'required|string',
            'correo' => 'required|email|unique:customers',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 422,
                'message' => 'Error de validación',
                'data' => $validator->errors()
            ], 422);
        }

        try {
            $usuarioData = $request->all();
            $usuarioData['password'] = Hash::make($request->password);
            $usuario = Customers::create($usuarioData);
            return response()->json([
                'success' => true,
                'status' => 201,
                'message' => 'Usuario creado correctamente',
                'data' => $usuario
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            // Error de la base de datos
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error en la base de datos al crear usuario: ' . $e->getMessage(),
                'data' => null
            ]);
        } catch (\Exception $e) {
            // Otro tipo de error
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al crear usuario: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'correo' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 422,
                'message' => 'Error de validación',
                'data' => $validator->errors()
            ], 422);
        }

        try {
            // Buscar al cliente por su correo electrónico
            $cliente = Customers::where('correo', $request->correo)->first();

            // Verificar si el cliente existe y la contraseña es correcta
            if (!$cliente || !Hash::check($request->password, $cliente->password)) {
                return response()->json([
                    'success' => false,
                    'status' => 401,
                    'message' => 'Credenciales inválidas',
                    'data' => null
                ], 401);
            }

            // Si las credenciales son válidas, generar un token para el cliente
            $token = $this->generateToken($cliente);

            // Devolver la respuesta con el token y los datos del cliente
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Inicio de sesión exitoso',
                'data' => [
                    'token' => $token,
                    'cliente' => $cliente
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al iniciar sesión: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    private function generateToken($cliente)
    {
        // Aquí puedes generar un token único para el cliente
        // Por ejemplo, puedes utilizar una combinación de su ID y una cadena aleatoria
        return md5($cliente->id . '_' . uniqid());
    }
}
