
<x-app-layout>
<div class="container px-12 py-8 mx-auto">
    <h3 class="text-2xl font-bold text-white">Productos</h3>
    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($products as $product)

        <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-md shadow-md">
            <div class="w-full">
                <img src="{{asset('images/'.$product->image_path) }}" alt="" class="w-full max-h-60">
            </div>
            <div class="flex items-end justify-end w-full bg-cover">

            </div>
            <div class="px-5 py-3">
                <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
                <span class="mt-2 text-gray-500">${{ $product->price }}</span>
            </div>

        </div>
        @endforeach
    </div>
</div>
</x-app-layout>
