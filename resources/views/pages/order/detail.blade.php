@extends('layouts.guest')

@section('body')

<div class="mx-auto max-w-screen-md px-4 2xl:px-0">
    <div class="mx-auto max-w-3xl">
        <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">Order summary</h2>
        <h3 class="font-semibold text-gray-900">ID: {{ $order->id }}</h3>

        <div class="mt-4 space-y-4 border-b border-t border-gray-200 py-8 sm:mt-8">
            <h4 class="text-lg font-semibold text-gray-900">Billing information</h4>

            <div class="">
                <p>Status : {{ $order->payment->status == "SUCCESSFUL" ? 'Sudah Bayar' : 'Belum Bayar' }}</p>
                @if ($order->payment->status == "NOT_CONFIRMED")
                <p>Link: <a href="https://{{ $order->payment->link_url }}" target="__blank" class="hover:underline text-blue-600 truncate">Bayar Disini</a></p>
                @endif
            </div>
        </div>

        <ol class="w-full items-center mt-4 sm:flex border-b border-gray-200">
            <li class="relative mb-6 sm:mb-0">
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white shrink-0">
                        <svg class="w-2.5 h-2.5 {{ $order->payment->status == "SUCCESSFUL" ? 'text-blue-800' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5"></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <h3 class="text-lg font-semibold text-gray-900">Payment</h3>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400">{{ date('F d, Y', strtotime($order->created_at)) }}</time>
                    @if ($order->payment->status == "SUCCESSFUL")
                        <p class="text-base font-normal text-gray-500">Order telah dibayar</p>
                    @else
                        <p class="text-base font-normal text-gray-500">Menunggu Pembayaran. <a href="https://{{ $order->payment->link_url }}" target="__blank" class="hover:underline text-blue-600">Bayar sekarang</a></p>
                    @endif
                </div>
            </li>
            <li class="relative mb-6 sm:mb-0">
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white shrink-0">
                        <svg class="w-2.5 h-2.5 {{ $order->status == 'PROCESS' ? 'text-blue-800' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5"></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <h3 class="text-lg font-semibold text-gray-900">Process</h3>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400">December 23, 2021</time>
                    <p class="text-base font-normal text-gray-500">Order sedang di proses</p>
                </div>
            </li>
            <li class="relative mb-6 sm:mb-0">
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white shrink-0">
                        <svg class="w-2.5 h-2.5 {{ $order->status == 'FINISH' ? 'text-blue-800' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5"></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <h3 class="text-lg font-semibold text-gray-900">Finish</h3>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400">January 5, 2022</time>
                    <p class="text-base font-normal text-gray-500">Order telah diselesaikan</p>
                </div>
            </li>
        </ol>

        <h2 class="text-xl mt-4 space-y-4 font-semibold text-gray-900 sm:text-2xl">Order Products</h2>

        <div class="mt-4 sm:mt-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-left font-medium text-gray-900 md:table-fixed">
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($order->orders as $item)
                        <tr>
                            <td class="whitespace-nowrap py-4 md:w-[384px]">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('market.detail', $item['id']) }}" class="flex items-center aspect-square w-10 h-10 shrink-0">
                                        <img class="h-auto w-full max-h-full" src="{{ asset('storage') . '/' . $item['image'] }}" alt="imac image" />
                                    </a>
                                    <div class="">
                                        <div class="flex gap-1">
                                            <a href="{{ route('market.detail', $item['id']) }}" class="hover:underline">{{ $item['name'] }}</a>
                                            @foreach ($item['configs'] as $key => $value)
                                            <p class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $value }}</p>
                                            @endforeach
                                        </div>
                                        <p class="text-xs max-w-sm">{{ $item['massage'] }}</p>
                                    </div>
                                </div>
                            </td>
            
                            <td class="p-4 text-base font-normal text-gray-900">x{{ $item['qty'] }}</td>
            
                            <td class="p-4 text-right text-base font-bold text-gray-900">Rp. {{ number_format($item['price']) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 space-y-6">
                <div class="space-y-4">
                    <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                        <dt class="text-lg font-bold text-gray-900">Total</dt>
                        <dd class="text-lg font-bold text-gray-900">Rp. {{ number_format($order->total) }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection