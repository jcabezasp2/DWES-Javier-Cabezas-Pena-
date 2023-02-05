@extends('adminlte::page')

@section('title', 'Dashboard Administración')

@section('content_header')
    <h1>Edicion de usuarios</h1>
@stop

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!!Form::model($user, ['route'=>['users.update', $user], 'method'=>'put'])!!}
            @csrf
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Datos del usuario') }}</h2>

                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Nombre
                    </label>
                    <input readonly value="{{ old('name') ?? $user->name }}" name="name" type="text" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                    @error('name')
                        <p class="text-sm text-red-500"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Email
                    </label>
                    <input readonly value="{{ old('name') ?? $user->email }}" name="email" type="text" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                    @error('email')
                        <p class="text-sm text-red-500"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-6 flex flex-col">

                    @foreach ($roles as $role)
                        <div class="inline-flex items-center mb-6">
                            <label>
                                {!!Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1'])!!}
                                {{$role->name}}
                            </label>
                        </div>
                    @endforeach

                    @error('roles[]')
                        <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {!!Form::submit('Asignar rol', ['class'=>'text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg'])!!}
            </div>
        {!!Form::close()!!}
    </div>
</div>


@stop
