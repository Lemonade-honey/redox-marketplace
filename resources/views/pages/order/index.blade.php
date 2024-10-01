@extends('layouts.guest')

@section('body')

<header>
    <x-main-header title="My Orders" />
</header>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID Order
                </th>
                <th scope="col" class="px-6 py-3">
                    Products
                </th>
                <th scope="col" class="px-6 py-3">
                    Total
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $item)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $item->id }}
                </th>
                <td class="px-6 py-4">
                    {{ count($item->orders) }} products
                </td>
                <td class="px-6 py-4">
                    {{ number_format($item->total) }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->created_at->diffForHumans() }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->status }}
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('order.detail', $item->id) }}" class="font-medium text-blue-600 hover:underline">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>

@endsection