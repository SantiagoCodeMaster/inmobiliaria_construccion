<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductoController extends Controller
{
    use AuthorizesRequests;
    /**
     * Leer (Read): Muestra una lista de todos los productos.
     */
    public function index()
    {
        // Autorizar: ¿Puede el usuario ver cualquier producto?
        // Esto dispara tu GlobalPolicy
        $this->authorize('viewAny', Producto::class);

        $productos = Producto::all();
        
        return response()->json([
            'status' => 'success',
            'data' => $productos
        ], 200);
    }

    /**
     * Crear (Create): Guarda un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        // Autorizar: ¿Puede el usuario crear un producto?
        $this->authorize('create', Producto::class);

        // 1. Validar los datos recibidos
        $request->validate([
            'tipo_obra' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'planes'    => 'required|string',
            'precio'    => 'required|numeric|min:0',
        ]);

        // 2. Crear el producto
        $producto = Producto::create($request->all());

        // 3. Retornar respuesta
        return response()->json([
            'status' => 'success',
            'message' => 'Producto creado correctamente',
            'data' => $producto
        ], 201);
    }

    /**
     * Leer (Read): Muestra un producto específico por su ID.
     */
    public function show($id)
    {
        // Primero buscamos el producto
        $producto = Producto::findOrFail($id);

        // Autorizar: ¿Puede el usuario ver este producto en específico?
        $this->authorize('view', $producto);

        return response()->json([
            'status' => 'success',
            'data' => $producto
        ], 200);
    }

    /**
     * Actualizar (Update): Actualiza la información de un producto existente.
     */
    public function update(Request $request, $id)
    {
        // Primero buscamos el producto
        $producto = Producto::findOrFail($id);

        // Autorizar: ¿Puede el usuario actualizar este producto?
        $this->authorize('update', $producto);

        // Validar los datos (permitimos que sean opcionales con 'sometimes')
        $request->validate([
            'tipo_obra' => 'sometimes|required|string|max:255',
            'planes'    => 'sometimes|required|string',
            'precio'    => 'sometimes|required|numeric|min:0',
        ]);

        // Actualizar el registro
        $producto->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Producto actualizado correctamente',
            'data' => $producto
        ], 200);
    }

    /**
     * Eliminar (Delete): Elimina un producto de la base de datos.
     */
    public function destroy($id)
    {
        // Primero buscamos el producto
        $producto = Producto::findOrFail($id);

        // Autorizar: ¿Puede el usuario eliminar este producto?
        $this->authorize('delete', $producto);
        
        $producto->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Producto eliminado correctamente'
        ], 200); 
    }
}