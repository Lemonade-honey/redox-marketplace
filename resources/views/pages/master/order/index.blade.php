@extends('layouts.app')

@section('body')
    <header>
        <x-main-header title="List Order Comming" />
    </header>
    @livewire("list-master-orders")
@endsection