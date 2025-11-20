{{-- Tampilan untuk menampilkan data customer dari database berupa tabel --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaksi Terakhir</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($customers as $customer)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $customer->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $customer->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $customer->latestCheckout->phone_number ?? ($customer->phone ?? '-') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ Str::limit($customer->latestCheckout->address ?? ($customer->address ?? '-'), 30) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($customer->latestCheckout)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $customer->latestCheckout->status == 'sukses' ? 'bg-green-100 text-green-800' : 
                                                ($customer->latestCheckout->status == 'gagal' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($customer->latestCheckout->status) }}
                                            </span>
                                            <div class="text-xs text-gray-500">
                                                {{ $customer->latestCheckout->created_at->format('d M Y') }}
                                            </div>
                                        @else
                                            <span class="text-gray-400">Belum ada transaksi</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>