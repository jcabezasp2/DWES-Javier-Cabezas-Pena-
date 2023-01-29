<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 leading-tight">
            Listado de permisos
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="max-w-4xl mx-auto mt-8 bg-green-700 text-white p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto mx-auto my-12 relative shadow-md sm:rounded-lg bg-white">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Id
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Nombre
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Guard
                    </th>
                    <th scope="col" class="py-3 px-6">
                       Created_at
                    </th>
                    <th scope="col" class="py-3 px-6">

                     </th>
                </tr>
            </thead>
            <tbody>

                @forelse ($permissions  as $permission)
                    <tr>
                        <td class="py-4 px-6 ">
                            {{ $permission->id }}
                        </td>
                        <td class="py-4 px-6 ">
                            {{ $permission->name }}
                        </td>
                        <td class="py-4 px-6 ">
                            {{ $permission->guard_name }}
                        </td>
                        <td>
                            {{ $permission->created_at }}
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{-- {{ route('?', $permission) }} --}}">Mostrar</a>
                        </td>
                    </tr>
                @empty
                    <h3 class="text-2xl text-center font-bold p-5">No hay permisos</h3>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-4">
            {{ $permissions->links() }}
        </div>
    </div>


</x-app-layout>
