@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Lista de Productos</h2>
    
    <!-- Contenedor para el producto escaneado -->
    <div id="producto-container" class="mb-6 p-4 bg-gray-200 shadow-md rounded">
        <h3 class="text-xl font-semibold text-gray-700">Producto Escaneado</h3>
        <p class="text-gray-500">Aparecerá aquí al escanear una etiqueta NFC.</p>
    </div>

    <div class="overflow-auto rounded-lg border border-gray-300 shadow-lg">
        <!-- Tabla eliminada: Los productos no deben mostrarse hasta el escaneo -->
        <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Talla</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria }}</td>
                    <td>{{ $producto->talla }}</td>
                    <td>{{ $producto->color }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td><img src="{{ asset('images/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="50"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>




@endsection