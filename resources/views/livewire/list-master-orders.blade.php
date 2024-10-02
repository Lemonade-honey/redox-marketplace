<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
        <div class="w-full flex gap-3">
            <div class="w-full">
                <x-basic-label for="" title="Status Order" />
                <select wire:model.live="orderStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option>All</option>
                    <option>PENDING</option>
                    <option>PROCES</option>
                    <option>FINISH</option>
                    <option>CANCEL</option>
                </select>
            </div>
            <div class="w-full">
                <x-basic-label for="" title="Status Payment" />
                <select wire:model.live="paymentStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option>All</option>
                    <option>NOT_CONFIRMED</option>
                    <option>SUCCESSFUL</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end">
            <div class="w-full sm:w-3/4">
                <x-basic-label for="" title="Search" />
                <input type="search" wire:model.live.debounce.400ms="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Search...">
            </div>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-green-200">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Order ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        User
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Payment
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Create
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                </tr>
            </thead>
            <tbody wire:poll.keep-alive>
                @forelse ($orders as $key => $item)
                <tr class="bg-white border-b hover:bg-gray-100">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $item->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $item->user->email }}
                    </th>
                    <td class="px-6 py-4">
                        Rp. {{ number_format($item->total) }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="{{ $item->payment->status == 'SUCCESSFUL' ? 'bg-green-100 text-green-800 border-green-400' : 'bg-red-100 text-red-800 border-red-400' }} text-xs font-medium me-2 px-2.5 py-0.5 rounded border">{{ $item->payment->status }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if ($item->status == 'FINISH')
                        <span class="bg-green-100 text-green-800 border-green-400 text-xs font-medium me-2 px-2.5 py-0.5 rounded border">{{ $item->status }}</span>
                        @elseif($item->status == 'PROCES')
                        <span class="bg-blue-100 text-blue-800 border-blue-400 text-xs font-medium me-2 px-2.5 py-0.5 rounded border">{{ $item->status }}</span>
                        @elseif($item->status == 'PENDING')
                        <span class="bg-yellow-100 text-yellow-800 border-yellow-400 text-xs font-medium me-2 px-2.5 py-0.5 rounded border">{{ $item->status }}</span>
                        @else
                        <span class="bg-red-100 text-red-800 border-red-400 text-xs font-medium me-2 px-2.5 py-0.5 rounded border">{{ $item->status }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('master.order.detail', $item->id) }}" class="font-medium text-blue-600 hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-900 font-medium text-md">Tidak Ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex items-center gap-3 mt-4">
        <p class="text-sm">Per Page</p>
        <select name="filter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-1" wire:model.change="perPage">
            <option>10</option>
            <option>50</option>
            <option>100</option>
        </select>
    </div>

    <div class="w-full mt-10 sm:flex sm:justify-end">
        {{ $orders->links() }}
    </div>
</div>