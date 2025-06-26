<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-3 flex items-center justify-between">
                <a href="{{ route('product.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Create New</a>
                <form method="GET" action="{{ route('product.index') }}" class="flex items-center">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products..."
                        class="px-3 py-2 border border-gray-300 rounded mr-2 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Search</button>
                </form>
            </div>

            <div class="mb-3">
                {{ $products->links() }}
            </div>


            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg" x-data="productModal()">
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
                                    <td class="px-4 py-2 text-gray-700">RM {{ number_format($product->price, 2) }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $product->quantity }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <button
                                            class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 mr-2"
                                            @click="openModal({ 
                                                id: {{ $product->id }},
                                                name: @js($product->name),
                                                description: @js($product->description),
                                                price: {{ $product->price }},
                                                quantity: {{ $product->quantity }},
                                                photo: @js($product->photo),
                                                editUrl: '{{ route('product.edit', $product->id) }}',
                                                deleteUrl: '{{ route('product.destroy', $product->id) }}'
                                            })"
                                        >View</button>
                                        <a href="{{ route('product.edit', $product->id) }}" class="inline-block px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 mr-2">Edit</a>
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete {{$product->name}}?')" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
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

                <!-- Modal using x-modal component -->
                <x-modal name="product-view-modal" :show="false" maxWidth="md">
                    <div x-show="show" x-transition class="p-5">
                        <h3 class="text-lg font-bold mb-4" x-text="product.name"></h3>
                        <template x-if="product.photo">
                            <img :src="'/storage/' + product.photo" alt="" class="mb-4 w-full h-48 object-contain rounded border" />
                        </template>
                        <div class="mb-2">
                            <span class="font-semibold">Description:</span>
                            <span x-text="product.description"></span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Price:</span>
                            <span x-text="'RM' + parseFloat(product.price).toFixed(2)"></span>
                        </div>
                        <div class="mb-4">
                            <span class="font-semibold">Quantity:</span>
                            <span x-text="product.quantity"></span>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <a :href="product.editUrl" class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</a>
                            <form :action="product.deleteUrl" method="POST" x-ref="deleteForm" @submit.prevent="deleteProduct">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                            </form>
                            <button @click="closeModal" class="px-3 py-1 bg-gray-400 text-white rounded hover:bg-gray-500">Close</button>
                        </div>
                    </div>
                </x-modal>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function productModal() {
    return {
        show: false,
        product: {
            id: null,
            name: '',
            description: '',
            price: '',
            quantity: '',
            photo: '',
            editUrl: '',
            deleteUrl: ''
        },
        openModal(product) {
            this.product = product;
            this.show = true;
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'product-view-modal' }));
        },
        closeModal() {
            this.show = false;
            window.dispatchEvent(new CustomEvent('close-modal', { detail: 'product-view-modal' }));
        },
        deleteProduct() {
            if (confirm('Are you sure?')) {
                this.$refs.deleteForm.submit();
            }
        }
    }
}
</script>
    }
}
</script>
