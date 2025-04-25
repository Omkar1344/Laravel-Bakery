@csrf

<div class="mb-4">
    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
    <textarea name="description" id="description" rows="3" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
</div>

<div class="mb-4">
    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
    <input type="text" name="category" id="category" value="{{ old('category', $product->category ?? '') }}" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
</div>

<div class="mb-4">
    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? '') }}" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
</div>

<div class="mb-4">
    <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
    <input type="file" name="image" id="image" accept="image/*" {{ isset($product) ? '' : 'required' }}
        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
    
    @if(isset($product) && $product->image)
        <div class="mt-2">
            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="h-32 w-32 object-cover rounded-lg">
        </div>
    @endif
</div>

<div class="flex justify-end mt-6">
    <button type="submit"
        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{ isset($product) ? 'Update Product' : 'Create Product' }}
    </button>
</div> 