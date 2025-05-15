@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">

    <div class="flex justify-end mb-8">
        <a href="{{ url('/') }}" class="text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">Volver al menú</a>
    </div>

    <h2 class="text-3xl font-bold text-center mb-8 text-gray-900">Lista de Productos</h2>

    <div id="producto-container" class="mb-8 p-6 bg-gray-100 shadow-md rounded-lg">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Producto Escaneado</h3>
        <p class="text-gray-700">Aparecerá aquí al escanear una etiqueta NFC.</p>
    </div>

    <div class="overflow-auto rounded-lg border border-gray-200 shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Talla</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proveedor</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($productos as $producto)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->categoria }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->talla }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->color }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->precio }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->stock }}</td>
                       <td class="text-sm text-gray-900">
    {{ optional($producto->proveedor)->nombre ?? 'Sin proveedor' }}
</td>

</td>

</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<script>
    // Recargar la página cada 5 segundos
    setTimeout(function(){
        location.reload();
    }, 5000); // 5000 milisegundos = 5 segundos
</script>

</div>
@endsection
