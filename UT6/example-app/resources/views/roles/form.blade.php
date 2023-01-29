<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

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

            <form class="w-full max-w-lg border-4" method="POST" action="{{ $route }}" enctype="multipart/form-data">
                @csrf

                @if($role->id)
                    @method('PUT')
                @endif
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Edicion de roles") }}</h2>

                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Nombre
                        </label>
                        <input value="{{ old('name') ?? $role->name }}" name="name" type="text" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                        @error('title')
                            <p class="text-sm text-red-500"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="guard" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Guard
                        </label>
                        <select id="category_id" name="category_id" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @foreach($guards as $guard)
                                <option {{ old("guard_name", $role->guard_name) === $guard ? 'selected' : '' }} value="{{ $guard }}">{{ $guard }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-6 flex flex-col">

                        @foreach (\App\Models\Permission::get() as $permission)
                            <div class="inline-flex items-center mb-6">
                                <label>
                                    {!!Form::checkbox('permissions[]', $permission->id, null, ['class'=>'mr-1'])!!}
                                    {{$permission->name}}
                                </label>
                            </div>
                        @endforeach

                        @error('permissions[]')
                            <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{ $textButton }}</button>

                </div>
                </form>
        </div>
    </div>


</x-app-layout>
