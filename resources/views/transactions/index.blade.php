{{-- Tampilan untuk menampilkan data transaksi dari database berupa tabel--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Transactions') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ $message }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Produk Pesanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti Pembayaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($checkouts as $checkout)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $checkout->order_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $checkout->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $checkout->phone_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-700">
                                            @foreach($checkout->items as $item)
                                                <div>{{ $item->product->name }}</div>
                                            @endforeach
                                        </div>
                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap">
                                         @foreach($checkout->items as $item)
                                            <div>Rp. {{ number_format($item->product->price, 2) }}</div>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $checkout->items->sum('quantity') }} Produk
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="openModal('{{ asset('storage/'.$checkout->payment_proof) }}')">
                                            <img src="{{ asset('storage/'.$checkout->payment_proof) }}" 
                                                 alt="Bukti Pembayaran" 
                                                 class="w-16 h-16 object-cover rounded hover:opacity-75 transition cursor-pointer">
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $checkout->status == 'sukses' ? 'bg-green-100 text-green-800' : 
                                               ($checkout->status == 'gagal' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($checkout->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('transactions.update-status', $checkout) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" onchange="this.form.submit()" 
                                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                                <option value="pending" {{ $checkout->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="sukses" {{ $checkout->status == 'sukses' ? 'selected' : '' }}>Sukses</option>
                                                <option value="gagal" {{ $checkout->status == 'gagal' ? 'selected' : '' }}>Gagal</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $checkouts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk preview gambar -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75" onclick="closeModal()"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Bukti Pembayaran
                                </h3>
                                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-2">
                                <img id="modalImage" src="" alt="Bukti Pembayaran" class="w-full h-auto max-h-[70vh] object-contain">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk membuka modal dengan gambar spesifik
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Tutup modal dengan ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        function confirmDelete(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this product?')) {
                event.target.closest('form').submit();
            }
        }
    </script>
</x-app-layout>
