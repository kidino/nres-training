<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('product.create') }}" class="inline-block mb-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Create New</a>

            <form method="GET" action="{{ route('product.index') }}" class="mb-3 flex items-center">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search products..."
                    class="px-3 py-2 border border-gray-300 rounded mr-2 focus:outline-none focus:ring-2 focus:ring-blue-200"
                >
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Search</button>
            </form>

            <div class="mb-3">
                {{ $products->links() }}
            </div>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($products as $product)
                                    <tr class="@if($loop->odd) bg-gray-50 @endif">
                                        <td class="px-4 py-2 text-gray-700">{{ $product->id }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $product->name }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $product->price }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $product->quantity }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('product.edit', $product->id) }}" class="inline-block px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 mr-2">Edit</a>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">No products found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


            </div>
        </div>
    </div>
</x-app-layout>
