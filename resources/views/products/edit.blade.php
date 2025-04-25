<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Product Details Form -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Product Details</h3>
                            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @include('products.form')
                            </form>
                        </div>

                        <!-- Product Image Form -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Product Image</h3>
                            <div class="mb-4">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-64 h-64 object-cover rounded-lg shadow-md">
                            </div>
                            <form action="{{ route('products.update-image', $product) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                        Update Image
                                    </label>
                                    <input type="file" name="image" id="image" accept="image/*" required
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Update Image
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 