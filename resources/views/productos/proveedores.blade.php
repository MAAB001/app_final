<!-- resources/views/proveedores/registro.blade.php -->

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Registrar Proveedor</h2>

        <!-- Botón para volver al menú -->
        <div class="flex justify-end mb-8">
            <a href="{{ url('/') }}" class="text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                Volver al menú
            </a>
        </div>

        <!-- Formulario de registro -->
        <form action="{{ route('proveedores.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="nombre" placeholder="Nombre del proveedor" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

            <input type="text" name="contacto" placeholder="Nombre del contacto" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

            <input type="text" name="direccion" placeholder="Dirección" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

            <input type="email" name="correo" placeholder="Correo electrónico" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

            <input type="text" name="telefono" placeholder="Teléfono" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

            <input type="text" name="empresa" placeholder="Empresa o Razón Social" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

            <input type="text" name="ruc" placeholder="RUC/NIT/CIF/RFC" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">

            <button type="submit"
                class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 rounded-lg">
                Guardar Proveedor
            </button>
        </form>
    </div>

    <!-- Notificación de éxito -->
    @if(session('mensaje'))
        <div id="notification" class="fixed top-4 right-4 max-w-xs w-full bg-green-500 text-white p-4 rounded-lg shadow-md transform transition-all duration-300">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <p class="text-lg font-semibold">{{ session('mensaje') }}</p>
            </div>
        </div>

        <script>
            setTimeout(() => {
                const notification = document.getElementById('notification');
                notification.classList.add('opacity-0');
                notification.classList.add('translate-x-full');
            }, 5000);
        </script>
    @endif
</body>




<!-- Aquí se mostrará el mensaje de éxito o error -->
<div id="message" class="mt-4 text-center font-semibold hidden"></div>

<!-- Aquí se agregarán los proveedores -->
<div id="proveedores-list" class="mt-6"></div>

<script>
    document.getElementById('proveedor-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita la recarga de la página

        const form = new FormData(this);

        fetch('{{ route('proveedores.store') }}', {
            method: 'POST',
            body: form
        })
        .then(response => response.json())
        .then(data => {
            // Verificamos si la respuesta tiene un mensaje
            const messageDiv = document.getElementById('message');
            if (data.mensaje) {
                // Mostrar mensaje de éxito
                messageDiv.textContent = data.mensaje;
                messageDiv.classList.remove('hidden');
                messageDiv.classList.add('text-green-500'); // Éxito
            }

            // Crear un nuevo div con los datos del proveedor
            const proveedorDiv = document.createElement('div');
            proveedorDiv.classList.add('bg-gray-100', 'p-4', 'rounded-lg', 'shadow-md', 'mb-4');
            proveedorDiv.innerHTML = `
                <h3 class="text-xl font-semibold">${data.nombre}</h3>
                <p><strong>Contacto:</strong> ${data.contacto}</p>
                <p><strong>Dirección:</strong> ${data.direccion}</p>
            `;

            // Agregar el nuevo proveedor a la lista
            document.getElementById('proveedores-list').appendChild(proveedorDiv);

            // Limpiar el formulario
            this.reset();
        })
        .catch(error => {
            console.error('Error al guardar el proveedor:', error);

            // Si hay un error (como duplicado), mostrar un mensaje de error
            const messageDiv = document.getElementById('message');
            messageDiv.textContent = 'Este proveedor ya existe.';
            messageDiv.classList.remove('hidden');
            messageDiv.classList.add('text-red-500'); // Error
        });
    });
</script>
