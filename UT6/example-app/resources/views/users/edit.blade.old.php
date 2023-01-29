<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 leading-tight">
            Editar usuario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- @section('content') --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <label class="form-label">Nombre</label>
                        <p class="form-control">{{$user->name}}</p>

                        <label class="form-label">Email</label>
                        <p class="form-control">{{$user->email}}</p>

                        <h2 class="h5 text-primary font-weight-bold">Listado de Roles</h2>
                        {!!Form::model($user, ['route'=>['users.update', $user], 'method'=>'put'])!!}
                                @foreach ($roles as $role)
                                    <div>
                                        <label>
                                            {!!Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1'])!!}
                                            {{$role->name}}
                                        </label>
                                    </div>
                                @endforeach
                                {!!Form::submit('Asignar rol', ['class'=>'btn btn-primary mt-2'])!!}
                            {!!Form::close()!!}
                    </div>
                </div>
            {{-- @stop --}}
        </div>
    </div>


</x-app-layout>
