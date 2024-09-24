@extends('layouts.guest')

@section('body')
<section class="bg-white py-8 antialiased md:py-16">
    <form action="#" method="POST" class="mx-auto max-w-screen-md px-4 2xl:px-0">
        @csrf
        <div class="mx-auto max-w-3xl">
            <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">Order summary</h2>
    
            <div class="mt-6 space-y-4 border-b border-t border-gray-200 py-8 sm:mt-8">
                <h4 class="text-lg font-semibold text-gray-900">Billing & Delivery information</h4>
        
                <dl>
                    <dt class="text-base font-medium text-gray-900">Individual</dt>
                    <dd class="mt-1 text-base font-normal text-gray-500">Bonnie Green - +1 234 567 890, San Francisco, California, United States, 3454, Scott Street</dd>
                </dl>
        
                <button type="button" data-modal-target="billingInformationModal" data-modal-toggle="billingInformationModal" class="text-base font-medium text-blue-700 hover:underline">Edit</button>
            </div>
    
            <div class="mt-6 sm:mt-8">
                <div class="relative overflow-x-auto border-b border-gray-200">
                    <table class="w-full text-left font-medium text-gray-900 md:table-fixed">
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($carts as $item)
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
                    <h4 class="text-xl font-semibold text-gray-900">Order summary</h4>
        
                    <div class="space-y-4">
                        <div class="space-y-2">
            
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-gray-500">Original</dt>
                                <dd class="text-base font-medium text-gray-900">Rp. {{ number_format($total) }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-gray-500">Tax</dt>
                                <dd class="text-base font-medium text-gray-900">Rp. 0</dd>
                            </dl>
                        </div>
        
                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                            <dt class="text-lg font-bold text-gray-900">Total</dt>
                            <dd class="text-lg font-bold text-gray-900">Rp. {{ number_format($total) }}</dd>
                        </dl>
                    </div>
        
                    <div class="flex items-start sm:items-center">
                        <input id="terms-checkbox-2" type="checkbox" value="" class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500" required />
                        <label for="terms-checkbox-2" class="ms-2 text-sm font-medium text-gray-900"> I agree with the <a href="#" title="" class="text-blue-700 underline hover:no-underline">Terms and Conditions</a> of use of the Flowbite marketplace </label>
                    </div>
        
                    <div class="gap-4 sm:flex sm:items-center">
                        <a href="{{ route('market.index') }}" class="w-full flex justify-center rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">Return to Shopping</a>
            
                        <button type="submit" class="mt-4 flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:mt-0">Send the order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

@endsection