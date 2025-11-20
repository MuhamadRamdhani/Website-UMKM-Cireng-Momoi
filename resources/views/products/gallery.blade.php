{{-- Tampilan untuk menampilkan detail gambar dari product --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Gallery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">{{ $product->name }}</h3>
                        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                            &larr; Back to products
                        </a>
                    </div>

                    <!-- Main Image -->
                    <div class="mb-8">
                        <img id="mainImage" src="{{ asset('storage/'.$product->thumbnail) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-96 object-contain rounded-lg shadow-md">
                    </div>

                    <!-- Thumbnail Gallery -->
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        <!-- Thumbnail -->
                        <div class="cursor-pointer border-2 border-blue-400 p-1 rounded">
                            <img src="{{ asset('storage/'.$product->thumbnail) }}" 
                                 alt="Thumbnail" 
                                 class="w-full h-24 object-cover"
                                 onclick="changeMainImage('{{ asset('storage/'.$product->thumbnail) }}')">
                        </div>

                        <!-- Other Images -->
                        @foreach($product->images as $image)
                            <div class="cursor-pointer border p-1 rounded hover:border-blue-400">
                                <img src="{{ asset('storage/'.$image->image_path) }}" 
                                     alt="Product image" 
                                     class="w-full h-24 object-cover"
                                     onclick="changeMainImage('{{ asset('storage/'.$image->image_path) }}')">
                            </div>
                        @endforeach
                    </div>

                    <!-- Product Info -->
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-2">Product Information</h4>
                        <p class="text-gray-700 mb-2"><span class="font-medium">Price:</span> Rp {{ number_format($product->price, 2) }}</p>
                        <p class="text-gray-700 mb-2"><span class="font-medium">Stock:</span> {{ $product->stock }}</p>
                        <p class="text-gray-700"><span class="font-medium">Description:</span> {{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
        }
    </script>
</x-app-layout>