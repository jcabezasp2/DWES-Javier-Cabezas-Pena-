@extends('adminlte::page')

@section('title', 'Dashboard Administración')

@section('content_header')
    <h1>Listado de roles</h1>
@stop

@section('content')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@if (session('success'))
<div class="max-w-4xl mx-auto mt-8 bg-green-700 text-white p-3 rounded-lg">
    {{ session('success') }}
</div>
@endif

<div class="overflow-x-auto mx-auto my-12 relative shadow-md sm:rounded-lg bg-white">
<div class="p-5 bg-white flex items-center justify-center">
    <a href="{{ route('roles.create') }}"
        class="btn btn-primary px-4 py-2 rounded-lg bg-blue-800 hover:opacity-80 text-white">Crear rol</a>
</div>
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
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($roles  as $role)
            <tr class="bg-white border-b  hover:bg-gray-50 ">
                <td class="py-4 px-6 ">
                    {{ $role->id }}
                </td>
                <td class="py-4 px-6 ">
                    {{ $role->name }}
                </td>
                <td class="py-4 px-6">

                    {{ $role->guard_name }}
                </td>
                <td class="py-4 px-6">
                    {{ $role->created_at }}
                </td>
                <td class="py-4 px-5 flex items-center gap-x-2.5">
                    <a href="{{ route('roles.edit', $role->id) }}"
                        class="font-medium text-blue-600  hover:underline">
                        Edit
                    </a>
                    @if ($role->id != 1)
                    {{-- Delete Article --}}
                    <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="px-2 font-medium text-red-600  hover:underline">
                            Delete
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
        @empty
            <h3 class="text-2xl text-center font-bold p-5">No hay roles</h3>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
<div class="p-4">
    {{ $roles->links() }}
</div>
</div>


@stop
