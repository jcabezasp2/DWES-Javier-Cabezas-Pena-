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

                @if($project->id)
                    @method('PUT')
                @endif
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Escribe tu proyecto") }}</h2>

                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Title
                        </label>
                        <input value="{{ old('name') ?? $project->name }}" name="name" type="text" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                        @error('title')
                            <p class="text-sm text-red-500"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Description
                        </label>
                        <textarea  rows="5" cols="50" name="description" id="description"
                            class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 ">
                        {{ old('description') ?? $project->description }}
                        </textarea>

                        @error('description')
                            <p class="text-sm text-red-500"> {{ $message }} </p>
                        @enderror
                    </div>
                     {{-- Campo de imagen --}}
                    <div class="mb-6">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Image
                        </label>
                        <input name="image" type="file" id="image"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">


                        @error('image')
                            <p class="text-sm text-red-500"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 " for="description">
                            {{ __('User_id') }}
                        </label>
                        <input name="user_id" value="{{ auth()->user()->id }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            id="user_id" type="int" readonly>

                        @error('usuario')
                            <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">{{ __("Categoría") }}
                        </label>
                        <select id="category_id" name="category_id" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @foreach(\App\Models\Category::get() as $category)
                                <option {{ (int) old("category_id", $project->category_id) === $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{ $textButton }}</button>

                </div>
                </form>
        </div>
    </div>


</x-app-layout>
