<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            🚗 ParkTech - Panel de Control
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Bienvenida -->
            <div class="bg-white rounded-xl shadow p-6 mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    ¡Bienvenido, {{ Auth::user()->name }}!
                </h1>

                <p class="text-gray-500 mt-2">
                    Rol:
                    <span class="font-semibold text-blue-600">
                        {{ Auth::user()->role }}
                    </span>
                </p>
            </div>

            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div class="bg-blue-600 text-white rounded-xl shadow p-6">
                    <h3 class="text-lg">👤 Usuarios</h3>
                    <p class="text-4xl font-bold mt-2">{{ $usuarios }}</p>
                </div>

                <div class="bg-green-600 text-white rounded-xl shadow p-6">
                    <h3 class="text-lg">🚗 Vehículos</h3>
                    <p class="text-4xl font-bold mt-2">{{ $vehiculos }}</p>
                </div>

                <div class="bg-yellow-500 text-white rounded-xl shadow p-6">
                    <h3 class="text-lg">🅿 Espacios</h3>
                    <p class="text-4xl font-bold mt-2">{{ $espacios }}</p>
                </div>

                <div class="bg-red-600 text-white rounded-xl shadow p-6">
                    <h3 class="text-lg">📋 Registros</h3>
                    <p class="text-4xl font-bold mt-2">{{ $registros }}</p>
                </div>

            </div>

            <!-- Módulos -->
            <h2 class="text-2xl font-bold mb-4 text-gray-700">
                Módulos del Sistema
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- ADMIN --}}
                @if(Auth::user()->role == 'ADMIN')

                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-2">👤 Gestión de Usuarios</h3>
                    <p class="text-gray-500 mb-4">
                        Crear, editar y eliminar usuarios del sistema.
                    </p>

                    <a href="{{ route('users.index') }}"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Administrar
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-2">🅿 Gestión de Espacios</h3>
                    <p class="text-gray-500 mb-4">
                        Administrar los espacios de parqueo.
                    </p>

                    <a href="{{ route('spaces.index') }}"
                       class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Administrar
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-2">🚙 Tipos de Vehículo</h3>
                    <p class="text-gray-500 mb-4">
                        Administrar las categorías de vehículos.
                    </p>

                    <a href="{{ route('vehicle_types.index') }}"
                       class="inline-block bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        Administrar
                    </a>
                </div>

                @endif


                {{-- ADMIN Y OPERADOR --}}
                @if(in_array(Auth::user()->role,['ADMIN','OPERADOR']))

                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-2">🚗 Gestión de Vehículos</h3>
                    <p class="text-gray-500 mb-4">
                        Registrar y administrar vehículos.
                    </p>

                    <a href="{{ route('vehicles.index') }}"
                       class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                        Administrar
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-2">📋 Registros de Parqueo</h3>
                    <p class="text-gray-500 mb-4">
                        Gestionar entradas y salidas de vehículos.
                    </p>

                    <a href="{{ route('parking-records.index') }}"
                       class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Administrar
                    </a>
                </div>

                @endif


                {{-- USER --}}
                @if(Auth::user()->role == 'USER')

                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-2">🚗 Mis Vehículos</h3>
                    <p class="text-gray-500 mb-4">
                        Consulta los vehículos registrados.
                    </p>

                    <a href="{{ route('vehicles.index') }}"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Ver
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-bold mb-2">📋 Mis Registros</h3>
                    <p class="text-gray-500 mb-4">
                        Consulta el historial de ingresos y salidas.
                    </p>

                    <a href="{{ route('parking-records.index') }}"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Ver
                    </a>
                </div>

                @endif

            </div>

        </div>
    </div>
</x-app-layout>