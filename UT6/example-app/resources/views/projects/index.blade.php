
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 leading-tight">
            Listado de proyectos
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="max-w-4xl mx-auto mt-8 bg-green-700 text-white p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto mx-auto my-12 relative shadow-md sm:rounded-lg bg-white">
        <div class="p-5 bg-white flex items-center justify-center">
            <a href="{{ route('projects.create') }}"
                class="px-4 py-2 rounded-lg bg-blue-800 hover:opacity-80 text-white">Crear Proyecto</a>
        </div>
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Número.
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Titulo
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Descripcion
                    </th>
                    <th scope="col" class="py-3 px-6">
                        User_id
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Category_id
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Image
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects  as $project)
                    <tr class="bg-white border-b  hover:bg-gray-50 ">
                        <td class="py-4 px-6 ">
                            {{ $project->id }}
                        </td>
                        <td class="py-4 px-6 ">
                            {{ $project->name }}
                        </td>
                        <td class="py-4 px-6">

                            {{ $project->description }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $project->user->name }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $project->category->title }}
                        </td>
{{--                         <td class="py-4 px-6">
                             {{Storage::disk('images')->size($project->image)}}
                        </td> --}}
                        <td class="py-4 px-6">
                            <img class="w-[50px]" src="{{ asset('images/'.$project->image) }}" alt="">
                        </td>
                        <td class="py-4 px-5 flex items-center gap-x-2.5">
                            <a href="{{ route('projects.edit', $project->id) }}"
                                class="font-medium text-blue-600  hover:underline">
                                Edit
                            </a>

                            {{-- Delete Article --}}
                            <form action="{{ route('projects.destroy', $project->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="px-2 font-medium text-red-600  hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <h3 class="text-2xl text-center font-bold p-5">No hay proyectos</h3>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-4">
            {{ $projects->links() }}
        </div>
    </div>


</x-app-layout>
