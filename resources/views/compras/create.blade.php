@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center bg-gray-100">
    <div class="container max-w-md w-full p-2 bg-white rounded-lg shadow-md">
        <h2 class="mb-3 text-xl font-semibold text-center text-gray-800">Registrar Compra</h2>
        <div class="flex justify-end mb-8">
        <a href="{{ url('/') }}" class="text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">Volver al menú</a>
    </div>


        {{-- Mensajes --}}
        @if(session('success'))
        <div id="success-notification" class="fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="mb-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"><!-- resources/views/compras/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container position-relative mt-4" style="max-width: 800px;">
    <h2 class="mb-4 text-center">Registrar Compra</h2>

    {{-- Notificación de éxito --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <strong>¡Éxito!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    @endif

    {{-- Errores de validación --}}
    @if($errors->any())
      <div class="alert alert-warning">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('compras.store') }}" method="POST" class="border p-4 shadow rounded bg-white" id="form-compra">
        @csrf

        <div class="row g-3">
            {{-- Proveedor --}}
            <div class="col-md-6">
                <label for="proveedor" class="form-label">Proveedor</label>
                <select name="id_proveedor" id="proveedor" class="form-select form-select-sm" required>
                    <option value="">Seleccione...</option>
                    @foreach($proveedores as $proveedor)
                      <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Comprobante --}}
            <div class="col-md-6">
                <label for="comprobante" class="form-label">Comprobante</label>
                <input type="text" name="comprobante" id="comprobante" class="form-control form-control-sm" placeholder="Factura #123" required>
            </div>
        </div>

        {{-- Agregar producto --}}
        <div class="row g-2 align-items-end mt-3">
            <div class="col-md-7">
                <label class="form-label">Producto</label>
                <select id="producto" class="form-select form-select-sm">
                    <option value="">Seleccione...</option>
                    @foreach($productos as $producto)
                      <option value="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}">{{ $producto->nombre }} (Stock: {{ $producto->stock }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" id="cantidad" class="form-control form-control-sm" min="1" placeholder="0">
            </div>
            <div class="col-md-2 d-grid">
                <button type="button" class="btn btn-primary btn-sm" onclick="agregarProducto()">Agregar</button>
            </div>
        </div>

        {{-- Tabla temporal --}}
        <div class="table-responsive mt-3">
            <table class="table table-sm table-hover" id="tablaProductos">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        {{-- Oculto para JSON --}}
        <input type="hidden" name="productos_json" id="productos_json">

        {{-- Botón registrar --}}
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-success btn-sm">Registrar Compra</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    let productos = [];

    function agregarProducto() {
        const sel = document.getElementById('producto');
        const cant = parseInt(document.getElementById('cantidad').value, 10);
        const id  = sel.value;
        const nombre = sel.options[sel.selectedIndex]?.getAttribute('data-nombre');

        if (!id || cant <= 0) {
            return alert('Seleccione un producto y cantidad válidos');
        }
        productos.push({ id_producto: parseInt(id,10), cantidad: cant });
        actualizarTabla();
    }

    function eliminarProducto(idx) {
        productos.splice(idx, 1);
        actualizarTabla();
    }

    function actualizarTabla() {
        const tbody = document.querySelector('#tablaProductos tbody');
        tbody.innerHTML = '';
        productos.forEach((p, i) => {
            const nombre = document.querySelector(`#producto option[value="${p.id_producto}"]`).innerText;
            tbody.innerHTML += `
                <tr>
                    <td class="small">${nombre}</td>
                    <td class="text-center small">${p.cantidad}</td>
                    <td class="text-center"><button type="button" class="btn btn-outline-danger btn-sm" onclick="eliminarProducto(${i})">×</button></td>
                </tr>`;
        });
    }

    document.getElementById('form-compra')
        .addEventListener('submit', function(e) {
            if (productos.length === 0) {
                e.preventDefault();
                return alert('Debe agregar al menos un producto.');
            }
            document.getElementById('productos_json').value = JSON.stringify(productos);
        });
</script>
@endpush
@endsection

            <strong class="font-bold">¡Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif
        @if($errors->any())
        <div class="mb-2 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">¡Advertencia!</strong>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('compras.store') }}" method="POST" class="space-y-2" id="form-compra">
            @csrf

            {{-- Proveedor --}}
            <div class="space-y-1">
                <label for="proveedor" class="block text-gray-700 text-sm font-bold mb-1">Proveedor:</label>
                <select name="id_proveedor" id="proveedor" class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm" required>
                    <option value="">Seleccione un proveedor</option>
                    @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Comprobante --}}
            <div class="space-y-1">
                <label for="comprobante" class="block text-gray-700 text-sm font-bold mb-1">Comprobante:</label>
                <input type="text" name="comprobante" id="comprobante" class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm" placeholder="Ej. Factura #123" required>
            </div>

            {{-- Selector de producto + cantidad --}}
            <div class="space-y-1">
                <label class="block text-gray-700 text-sm font-bold mb-1">Agregar Producto:</label>
                <div class="flex space-x-1">
                    <select id="producto" class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm">
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}">{{ $producto->nombre }} (Stock: {{ $producto->stock }})</option>
                        @endforeach
                    </select>
                    <input type="number" id="cantidad" class="shadow appearance-none border rounded w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm" placeholder="Cantidad" min="1">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline text-xs" onclick="agregarProducto()">Agregar</button>
                </div>
            </div>

            {{-- Tabla temporal --}}
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden text-xs" id="tablaProductos">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-2 py-1 border-b-2 border-gray-200 text-left  font-semibold uppercase tracking-wider">Producto</th>
                            <th class="px-2 py-1 border-b-2 border-gray-200 text-left  font-semibold uppercase tracking-wider">Cantidad</th>
                            <th class="px-2 py-1 border-b-2 border-gray-200 text-left  font-semibold uppercase tracking-wider">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            <td colspan="3" class="px-2 py-2 border-b border-gray-200  text-sm">No hay productos agregados</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Oculto para JSON --}}
            <input type="hidden" name="productos_json" id="productos_json">

            {{-- Botón guardar --}}
            <div class="text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline text-xs">Registrar Compra</button>
            </div>
        </form>
    </div>
</div>

<script>
    let productos = [];

    function agregarProducto() {
        const sel = document.getElementById('producto');
        const cant = parseInt(document.getElementById('cantidad').value, 10);
        const id = sel.value;
        const nombre = sel.options[sel.selectedIndex].getAttribute('data-nombre');

        if (!id || cant <= 0) {
            alert('Seleccione un producto y cantidad válida');
            return;
        }
        productos.push({
            id_producto: parseInt(id, 10),
            cantidad: cant
        });
        actualizarTabla();
        document.getElementById('producto').value = "";
        document.getElementById('cantidad').value = "";
    }

    function eliminarProducto(idx) {
        productos.splice(idx, 1);
        actualizarTabla();
    }

    function actualizarTabla() {
        const tbody = document.querySelector('#tablaProductos tbody');
        tbody.innerHTML = '';
        if (productos.length === 0) {
            tbody.innerHTML = `<tr><td colspan="3" class="px-2 py-2 border-b border-gray-200 text-sm">No hay productos agregados</td></tr>`;
            return;
        }
        productos.forEach((p, i) => {
            const nombre = document.querySelector(`#producto option[value="${p.id_producto}"]`).innerText;
            tbody.innerHTML += `
                  <tr>
                      <td class="px-2 py-1 border-b border-gray-200 text-sm"><span class="font-italic text-gray-800">${nombre}</span></td>
                      <td class="px-2 py-1 border-b border-gray-200 text-sm"><span class="font-semibold text-blue-600">${p.cantidad}</span></td>
                      <td class="px-2 py-1 border-b border-gray-200 text-sm">
                          <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline text-xs" onclick="eliminarProducto(${i})">
                              Eliminar
                          </button>
                      </td>
                  </tr>`;
        });
    }

    // Antes de enviar, actualiza el hidden
    document.getElementById('form-compra')
        .addEventListener('submit', function(e) {
            if (productos.length === 0) {
                e.preventDefault();
                alert('Debe agregar al menos un producto.');
                return;
            }
            document.getElementById('productos_json').value = JSON.stringify(productos);
        });

    // Auto-remove the success notification after 3 seconds
    window.onload = function() {
        const successNotification = document.getElementById('success-notification');
        if (successNotification) {
            setTimeout(() => {
                successNotification.remove();
            }, 3000); // 3000 milliseconds = 3 seconds
        }
    };
</script>
@endsection
