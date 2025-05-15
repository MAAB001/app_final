@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 py-8">
    <div class="w-full max-w-xl bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 space-y-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white">Registrar Venta</h2>
        <div class="flex justify-end mb-8">
        <a href="{{ url('/') }}" class="text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">Volver al menú</a>
    </div>

        {{-- Mensajes de sesión --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ url('/ventas') }}" method="POST" class="space-y-4" id="ventaForm">
            @csrf

            {{-- Usuario --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Usuario:</label>
                <input type="text" name="id_usuario" class="mt-1 w-full px-4 py-2 border rounded-md bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white" value="{{ auth()->user()->id }}" readonly>
            </div>

            {{-- Productos --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Seleccionar Producto:</label>
                <select name="productos[]" class="mt-1 w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white" multiple required>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}" data-stock="{{ $producto->stock }}">
                            {{ $producto->nombre }} - ${{ number_format($producto->precio, 2) }} (Stock: {{ $producto->stock }})
                        </option>
                    @endforeach
                </select>
                <small class="text-sm text-gray-500 dark:text-gray-400">Usa Ctrl (o Cmd en Mac) para seleccionar varios productos.</small>
            </div>

            {{-- Cantidad --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" class="mt-1 w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white" min="1" required>
                <div id="stockMessage" class="text-red-500 text-sm mt-2" style="display:none;">No hay suficiente stock para uno o más productos seleccionados.</div>
            </div>

            {{-- Subtotal --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subtotal:</label>
                <input type="text" id="subtotal" class="mt-1 w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white" readonly>
            </div>

            {{-- IVA --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">IVA (19%):</label>
                <input type="text" id="iva" class="mt-1 w-full px-4 py-2 border rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white" readonly>
            </div>

            {{-- Total --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-600">Total:</label>
                <input type="text" name="total" id="total" class="mt-1 w-full px-4 py-2 border rounded-md  bg-white dark:bg-gray-700 text-gray-800 dark:text-white" readonly>
            </div>

            {{-- Botón --}}
            <div class="text-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md" id="submitBtn">
                    Registrar Venta
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script para cálculo y validación de stock --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const selectProducto = document.querySelector("select[name='productos[]']");
    const inputCantidad = document.getElementById("cantidad");
    const subtotalInput = document.getElementById("subtotal");
    const ivaInput = document.getElementById("iva");
    const totalInput = document.getElementById("total");
    const stockMessage = document.getElementById("stockMessage");
    const submitBtn = document.getElementById("submitBtn");

    function calcularTotales() {
        let subtotal = 0;
        const cantidad = parseInt(inputCantidad.value) || 0;
        const selectedOptions = Array.from(selectProducto.selectedOptions);

        let isStockAvailable = true;

        selectedOptions.forEach(option => {
            const precio = parseFloat(option.getAttribute("data-precio")) || 0;
            const stock = parseInt(option.getAttribute("data-stock")) || 0;
            
            // Verificar si hay suficiente stock
            if (stock < cantidad) {
                isStockAvailable = false;
            }

            subtotal += precio * cantidad;
        });

        if (!isStockAvailable) {
            stockMessage.style.display = "block";
            submitBtn.disabled = true;
        } else {
            stockMessage.style.display = "none";
            submitBtn.disabled = false;
        }

        const iva = subtotal * 0.19;
        const total = subtotal + iva;

        subtotalInput.value = subtotal.toFixed(2);
        ivaInput.value = iva.toFixed(2);
        totalInput.value = total.toFixed(2);
    }

    selectProducto.addEventListener("change", calcularTotales);
    inputCantidad.addEventListener("input", calcularTotales);
});
</script>
@endsection

