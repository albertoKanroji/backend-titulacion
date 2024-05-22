<?php

namespace App\Http\Controllers;

use App\Models\Ejercicios;
use App\Models\RespuestaOpcion;
use App\Models\Rutinas;
use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\DB;
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
        //122344 =dkjfhjghkdhfghdgeruihg == dkjfhjghkdhfghdgeruihg
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
    public function getData(Request $request)
    {
        try {
            // Obtener el ID del cliente desde la solicitud
            $clienteId = $request->input('clienteId');

            // Buscar al cliente por su ID
            $cliente = Customers::find($clienteId);

            // Verificar si se encontró al cliente
            if (!$cliente) {
                return response()->json([
                    'success' => false,
                    'status' => 404,
                    'message' => 'Cliente no encontrado',
                    'data' => null
                ], 404);
            }

            // Devolver la información del cliente
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Información del cliente obtenida correctamente',
                'data' => $cliente
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al obtener la información del cliente: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'apellido2' => 'required|string',
            'correo' => 'required|email|unique:customers,correo,' . $id,
            'peso' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
            'rutina' => 'nullable|string',
            'profileIsComplete' => 'nullable|string',
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
            $cliente = Customers::find($id);

            if (!$cliente) {
                return response()->json([
                    'success' => false,
                    'status' => 404,
                    'message' => 'Cliente no encontrado',
                    'data' => null
                ], 404);
            }

            $cliente->nombre = $request->input('nombre');
            $cliente->apellido = $request->input('apellido');
            $cliente->apellido2 = $request->input('apellido2');
            $cliente->correo = $request->input('correo');
            $cliente->rutina = $request->input('rutina');
            $cliente->profileIsComplete = $request->input('profileIsComplete');
            $cliente->peso = $request->input('peso');
            $cliente->altura = $request->input('altura');

            if ($request->input('peso') && $request->input('altura')) {
                $peso = $request->input('peso');
                $altura = $request->input('altura') / 100; // Convertimos la altura a metros
                $cliente->IMC = round($peso / ($altura * $altura), 2);
            }
            $cliente->profileIsComplete = 'si';

            $cliente->save();


            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Cliente actualizado correctamente',
                'data' => $cliente
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Error al actualizar el cliente: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
