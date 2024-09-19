@extends('layouts.guest')

@section('body')
<x-main-header title="Welcome to market" />

<div class="flex flex-wrap justify-center gap-5">
    @foreach ($products as $item)  
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow">
        <a href="#">
            <img class="p-8 rounded-t-lg" src="https://flowbite.com/docs/images/products/apple-watch.png" alt="product image" />
        </a>
        <div class="px-5 pb-5">
            <a href="#">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900">{{ $item->name }}</h5>
            </a>
            <div class="mt-2.5 mb-5 text-sm">
                {{ $item->categorie->name }}
            </div>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900">${{ number_format($item->price) }}</span>
                <a href="{{ route('market.detail', $item->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add to cart</a>
            </div>
        </div>
    </div>
    @endforeach

    {{-- <div role="status" class="max-w-sm w-full p-4 border border-gray-200 rounded shadow animate-pulse md:p-6">
        <div class="flex items-center justify-center h-48 mb-4 bg-gray-300 rounded">
            <svg class="w-10 h-10 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z"/>
                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
            </svg>
        </div>
        <div class="h-2.5 bg-gray-200 rounded-full w-48 mb-4"></div>
        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
        <div class="h-2 bg-gray-200 rounded-full mb-2.5"></div>
        <div class="h-2 bg-gray-200 rounded-full"></div>
        <div class="flex items-center mt-4">
            <div>
                <div class="h-2.5 bg-gray-200 rounded-full w-32 mb-2"></div>
                <div class="w-48 h-2 bg-gray-200 rounded-full"></div>
            </div>
        </div>
        <span class="sr-only">Loading...</span>
    </div> --}}
</div>

<div class="mt-5 p-2 flex justify-end">
    {{ $products->links() }}
</div>


@endsection