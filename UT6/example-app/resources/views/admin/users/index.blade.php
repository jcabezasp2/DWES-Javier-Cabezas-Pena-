@extends('adminlte::page')

@section('title', 'Dashboard Administración')

@section('content_header')
    <h1>Lista de usuarios</h1>
@stop

@section('content')
@if (session('success'))
<div class="max-w-4xl mx-auto mt-8 bg-green-700 text-white p-3 rounded-lg">
    {{ session('success') }}
</div>
@endif
@vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <tr>
                <td class="py-4 px-6 ">
                    {{ $user->id }}
                </td>
                <td class="py-4 px-6 ">
                    {{ $user->name }}
                </td>
                <td class="py-4 px-6 ">
                    {{ $user->email }}
                </td>
                <td>
                    {{-- {{dd($user)}} --}}
                    {{ implode(
                        ', ',
                        $user->roles->map(function ($role) {
                                return $role->name;
                            })->toArray(),
                    ) }}
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('users.edit', $user) }}">Editar</a>
                </td>
            </tr>
        @empty
            <h3 class="text-2xl text-center font-bold p-5">No hay usuarios</h3>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
<div class="p-4">
    {{ $users->links() }}
</div>
</div>

@stop
