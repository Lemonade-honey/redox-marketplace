@extends('layouts.app')

@push('style')
    @livewireStyles
@endpush

@section('body')
    <x-main-header title="List Products" />

    @include('includes.alert')
    <div class="my-5 flex justify-end">
        <a href="{{ route('master.product.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Create New</a>
    </div>

    @livewire("list-master-products")
    @livewireScripts
@endsection