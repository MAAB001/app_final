<head>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Registrar Producto con IVA</h2>

        <div class="flex justify-end mb-8">
        <a href="{{ url('/') }}" class="text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">Volver al menú</a>
    </div>


    <form action="{{ route('productos.store') }}" method="POST" class="space-y-4">
      @csrf

      <input type="text" name="nombre" placeholder="Nombre del producto" required
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

      <select name="categoria"
        class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
        <option value="zapatos">Zapatos</option>
        <option value="blusa">Blusa</option>
        <option value="pantalón">Pantalón</option>
        <option value="falda">Falda</option>
        <option value="vestido">Vestido</option>
        <option value="otros">Otros</option>
      </select>

      <input type="text" name="talla" placeholder="Talla"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

      <input type="text" name="color" placeholder="Color"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

      <input type="number" step="0.01" name="precio" id="precio" placeholder="Precio sin IVA" required
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

      <input type="number" step="0.01" name="iva" id="iva" placeholder="IVA (19%)" readonly
        class="w-full px-4 py-2 border bg-gray-100 text-gray-700 rounded-lg">

      <input type="number" step="0.01" name="precio_total" id="precio_total" placeholder="Precio con IVA" readonly
        class="w-full px-4 py-2 border bg-gray-100 text-gray-700 rounded-lg">

      <input type="number" name="stock" placeholder="Stock"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

      <input type="text" name="rfid_tag" placeholder="RFID tag"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

      {{-- Campo reemplazado: Selección de proveedor --}}
      <select name="id_proveedor" required
        class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
        <option value="">Seleccione un proveedor</option>
        @foreach($proveedores as $proveedor)
          <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
        @endforeach
      </select>

      <button type="submit"
        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 rounded-lg">
        Guardar Producto
      </button>
    </form>
  </div>

  <script>
    document.getElementById('precio').addEventListener('input', function () {
      const precioSinIva = parseFloat(this.value) || 0;
      const iva = precioSinIva * 0.19;
      const total = precioSinIva + iva;

      document.getElementById('iva').value = iva.toFixed(2);
      document.getElementById('precio_total').value = total.toFixed(2);
    });
  </script>
</body>
