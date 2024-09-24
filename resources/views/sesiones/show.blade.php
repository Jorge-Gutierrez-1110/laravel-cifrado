@extends('/plantilla/layout')

@section('contenido')
    <div class="relative overflow-x-auto">
        <h1 class="text-2xl font-bold mb-4">Detalles del Alumno</h1>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Password</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $alumno['email'] }}</td>
                    <td class="px-6 py-4">{{ $alumno['password'] }}</td>
                </tr>
            </tbody>
        </table>
        <a href="/sesiones/listado" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Volver al listado</a>
    </div>
@endsection
