<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido - Laravel</title>

    <!-- Tailwind CSS desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet" />
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-200 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 text-gray-800 dark:text-white min-h-screen flex flex-col items-center justify-center">

    @if (Route::has('login'))
        @auth
            <div class="fixed top-0 right-0 p-6 z-10 space-x-4">
                @if (Auth::user()->rol === 'admin')
                    <a href="{{ route('register') }}" class="text-sm font-semibold underline hover:text-blue-600">Registrar admin o empleado</a>
                @else
                    <a href="{{ url('/productos') }}" class="text-sm font-semibold underline hover:text-blue-600">Ir a Productos</a>
                @endif
                <a href="{{ route('logout') }}" class="text-sm font-semibold underline hover:text-red-600"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @else
            <div class="text-center px-4">
                <h1 class="text-5xl font-bold mb-4 text-blue-800 dark:text-white">Bienvenido a la plataforma</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">Administra productos, ventas y proveedores fácilmente</p>

                <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
                    Iniciar sesión
                </a>
            </div>
        @endauth
    @endif

    @auth
    <!-- Encabezado -->
    <div class="text-center mb-10 mt-6">
        <h2 class="text-4xl font-extrabold text-blue-900 dark:text-white">Bienvenido al sistema</h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 mt-2">Selecciona un módulo para comenzar</p>
    </div>

    <!-- Panel para usuarios autenticados -->
    <div class="w-full max-w-6xl px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-8">

            @if (Auth::user()->rol === 'empleado' || Auth::user()->rol === 'admin')
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition p-6 border-l-8 border-blue-600">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Productos Disponibles</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Explora todo tu inventario con facilidad.</p>
                <a href="{{ url('/productos') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md font-semibold transition">Ver Productos</a>
            </div>
            @endif

            @if (Auth::user()->rol === 'empleado' || Auth::user()->rol === 'admin')
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition p-6 border-l-8 border-green-600">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Registrar Venta</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Agrega ventas y genera detalles fácilmente.</p>
                <a href="{{ url('/ventas') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md font-semibold transition">Registrar Venta</a>
            </div>
            @endif

            @if (Auth::user()->rol === 'admin')
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition p-6 border-l-8 border-purple-600">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Proveedores</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Gestiona y contacta a tus proveedores fácilmente.</p>
                <a href="{{ url('/proveedores') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-md font-semibold transition">Ver Proveedores</a>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition p-6 border-l-8 border-yellow-500">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Ingresar Producto con IVA</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Agrega nuevos productos con cálculo automático del IVA.</p>
                <a href="{{ url('/ingresar-producto') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-md font-semibold transition">Ingresar Producto</a>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition p-6 border-l-8 border-orange-500">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Compras Proveedor</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Registra entradas al inventario mediante compras.</p>
                <a href="{{ url('/compras') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-md font-semibold transition">Registrar Compra</a>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition p-6 border-l-8 border-red-500">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Historial de Movimientos</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">Consulta todos los movimientos del inventario.</p>
                <a href="{{ url('/movimientos') }}" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-md font-semibold transition">Ver Historial</a>
            </div>
            @endif
        </div>
    </div>
    @endauth

</body>
</html>
