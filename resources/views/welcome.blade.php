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
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white min-h-screen flex flex-col">

    <!-- Barra superior fija -->
    <div class="fixed top-0 right-0 p-6 z-10">
        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <a href="{{ url('/productos') }}" class="text-sm font-semibold underline hover:text-blue-600">Ir a Productos</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold underline hover:text-blue-600">Iniciar sesión</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-semibold underline hover:text-blue-600">Registrarse</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <!-- Contenido centrado -->
    <div class="flex-grow flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Bienvenido a la plataforma</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">Explora tu inventario o regístrate para comenzar</p>
        </div>
    </div>

</body>
</html>
