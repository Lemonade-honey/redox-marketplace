@extends('layouts.app')

@section('body')
    <header class="mb-10">
        <x-main-header title="Detail Order" />
        <x-breadcrumb :datas="$bread" last="Detail" />
    </header>

    @include('includes.alert')

    <section class="w-full p-4 border border-gray-100 shadow rounded-lg">
        <h2 class="mb-4 text-xl font-medium text-gray-900">User Order</h2>
        <p>Nama : {{ $order->user->name }}</p>
        <p>Email : {{ $order->user->email }}</p>
        <p>Alamat : {{ $order->user->profile->address }}</p>
        <p>Phone : {{ $order->user->profile->phone }}</p>
    </section>

    <section class="w-full p-4 mt-10 border border-gray-100 shadow rounded-lg">
        <h2 class="mb-4 text-xl font-medium text-gray-900">Payment</h2>
        <p>Status {{ $order->payment->status }}</p>
        <p>Price Rp. {{ number_format($order->total) }}</p>
    </section>

    <section class="w-full p-4 mt-10 border border-gray-100 shadow rounded-lg">
        <h2 class="mb-4 text-xl font-medium text-gray-900">Products</h2>
        
        @foreach ($order->orders as $product)
            <p>{{ $product['name'] }}, qty: {{ $product['qty'] }}</p>
            @foreach ($product['configs'] as $key => $item)
            <div class="mt-2 flex items-center gap-2">
                <p class="mb-2 text-lg font-medium text-gray-900">{{ $key }}</p>
                <p>{{ $item }}</p>
            </div>
            @endforeach
            <p>Catatan : {{ $product['massage'] }}</p>
        @endforeach
    </section>

    <section class="w-full p-4 mt-10 border border-gray-100 shadow rounded-lg">
        <form method="POST">
            @csrf
            <div class="mb-5">
                <x-basic-label for="status order" title="Order Status" />
                <select name="status_order" id="status order" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option @selected(old('status_order', $order->status) == 'PENDING')>PENDING</option>
                    <option @selected(old('status_order', $order->status) == 'PROCES')>PROCES</option>
                    <option @selected(old('status_order', $order->status) == 'FINISH')>FINISH</option>
                    <option @selected(old('status_order', $order->status) == 'CANCEL')>CANCEL</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" id="btn-submit">Update</button>
            </div>
        </form>
    </section>

@endsection