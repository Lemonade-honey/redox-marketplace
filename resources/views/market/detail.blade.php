@extends('layouts.guest')

@section('body')

@include('includes.alert')

<section class="py-8 bg-white md:py-16 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
            <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                <div>
                    <img class="w-full" src="{{ asset('storage') . '/' . $product->images->first()?->image }}" alt="" id="mainImage" />
                </div>
                
                <div class="mt-10 overflow-x-auto flex gap-5">
                    @foreach ($product->images as $item)
                    <div class="p-2 w-24 h-24 sm:w-32 sm:h-32 border hover:border-blue-400 cursor-pointer rounded-md flex-shrink-0 list-image overflow-hidden" data-id="1">
                        <img class="w-full" src="{{ asset('storage') . '/' . $item->image }}" alt="Front View" />
                    </div>
                    @endforeach
                </div>

                <hr class="my-6 md:my-8 border-gray-200" />

                <p class="mb-6 text-gray-600">
                    @php echo $product->description @endphp
                </p>
            </div>

            <div class="mt-6 sm:mt-8 lg:mt-0">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">
                    {{ $product->name }}
                </h1>
            <div class="mt-4 sm:gap-4">
                <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl">Rp. {{ number_format($product->price) }}</p>
            </div>

            <div class="mt-2">
                <p class="sm:text-sm">Stok {{ $product->stocks }}</p>
            </div>

            <form action="{{ route('cart.save', $product->id) }}" method="POST">
                @csrf
                <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                    <a href="#" title="" class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
                    role="button">
                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                        </svg>
                        Add to favorites
                    </a>
    
                    <button type="submit" class="w-full sm:w-max flex items-center justify-center text-white  bg-blue-700 hover:bg-blue-800 mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                        </svg>
                        Add to cart
                    </button>

                    <div class="flex justify-center items-center gap-2 mt-5 sm:mt-0">
                        <p>Jumlah</p>
                        <input type="number" name="qty" value="1" class="sm:w-16 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                    </div>
                </div>
    
                <hr class="my-6 md:my-8 border-gray-200" />
    
                <div class="mt-5 grid grid-cols-1 sm:grid-cols-2">
                    @foreach ($product->configs as $key => $item)
                    <div class="mt-2">
                        <h3 class="mb-2 text-lg font-medium text-gray-900">{{ $key }}</h3>
                        <ul class="w-full flex flex-wrap gap-3">
                            @foreach ($item as $value)
                            <li>
                                <input type="radio" id="{{ $value . "|" . $key }}" name="{{ $key }}" value="{{ $value }}" class="hidden peer" required />
                                <label for="{{ $value . "|" . $key }}" class="inline-flex items-center justify-between px-3 py-0.5 text-gray-500 bg-white border border-gray-200 rounded-xl cursor-pointer peer-checked:border-blue-600 peer-checked:text-white peer-checked:bg-blue-600 hover:text-gray-600 hover:bg-gray-100">                           
                                    <div class="w-full text-sm font-semibold">{{ $value }}</div>
                                </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
                <div class="mt-5">
                    <h3 class="mb-2 text-lg font-medium text-gray-900">Catatan tambahan</h3>
                    <textarea id="message" name="massage" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan pesan tambahan disini..."></textarea>
                </div>
            </form>

            <hr class="my-6 md:my-8 border-gray-200" />
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    const mainImage = document.getElementById("mainImage");
    const thumbnails = document.querySelectorAll(".list-image");
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener("click", function() {
            const clickedImage = this.querySelector("img").src;
            mainImage.src = clickedImage;
        });
    });
</script>
@endpush