
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 leading-tight">
            Listado de usuarios
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
                        Email
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Roles
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users  as $user)
                <td class="py-4 px-6 ">
                    {{ $user->id }}
                </td>
                <td class="py-4 px-6 ">
                    {{ $user->name }}
                </td>
                <td class="py-4 px-6 ">
                    {{ $user->email }}
                </td>
                @empty
                    <h3 class="text-2xl text-center font-bold p-5">No hay usuarios</h3>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-4">
            {{ $projects->links() }}
        </div>
    </div>


</x-app-layout>
