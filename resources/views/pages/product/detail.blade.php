@extends('layouts.app')

@section('body')
    <header>
        <x-main-header title="Detail Product" />
        <x-breadcrumb :datas="$bread" last="Detail Product"/>
    </header>

    @include('includes.alert')

    <div class="p-4 w-full border border-gray-100 shadow rounded-lg h-min mt-10">
        <h2 class="text-xl sm:text-2xl font-semibold mb-4">General</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div class="">
                <x-basic-label for="name" title="Images Product" />
                <div id="default-carousel" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                        <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.com/docs/images/carousel/carousel-1.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                        <!-- Item 2 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.com/docs/images/carousel/carousel-2.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                        <!-- Item 3 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.com/docs/images/carousel/carousel-3.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                        <!-- Item 4 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.com/docs/images/carousel/carousel-4.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                        <!-- Item 5 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.com/docs/images/carousel/carousel-5.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                            <svg class="w-4 h-4 text-blue-600 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                            <svg class="w-4 h-4 text-blue-600 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>

            </div>
            <div class="">
                <div class="mb-5">
                    <x-basic-label for="name" title="Product Name" />
                    <x-basic-input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" disabled />
                </div>
                <div class="mb-5">
                    <x-basic-label for="categorie" title="Product Categorie" />
                    <x-basic-input type="text" id="categorie" name="categorie" value="{{ $product->name }}" disabled />
                </div>
                <div class="mb-5">
                    <x-basic-label for="Price" title="Price" />
                    <x-basic-input type="number" id="Price" name="price" value="{{ $product->price }}" disabled/>
                </div>
                <div class="mb-5">
                    <x-basic-label for="address" title="Description" />
                    <div class="w-full">
                        @php echo $product->description @endphp
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-xl sm:text-2xl font-semibold my-4">Configuration</h2>
        <div class="">
            @foreach ($product->configs as $key => $item)
                <div class="flex items-center gap-4 mb-3">
                    <h3 class="text-lg font-semibold">{{ $key }}</h3>
                    <div class="flex flex-wrap items-center gap-2">
                        @foreach ($item as $value)
                            <div class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{ $value }}</div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 flex justify-end">
            <a href="{{ route('master.product.edit', $product->id) }}" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" id="btn-submit">Edit Product</a>
        </div>
    </div>

    <div class="p-4 w-full border border-gray-100 shadow rounded-lg h-min mt-10">
        <h2 class="text-xl sm:text-2xl font-semibold mb-4">Management</h2>
        <form action="#" method="post">
            @csrf
            <div class="mb-5">
                <x-basic-label for="status" title="Product Status" />
                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option @selected(old('status') == 'ACTIVE')>ACTIVE</option>
                    <option @selected(old('status') == 'NOT ACTIVE')>NOT ACTIVE</option>
                </select>
            </div>
            <div class="mb-5">
                <x-basic-label for="stock" title="Product Stock" />
                <x-basic-input type="number" id="stock" name="stock" value="{{ old('stock', $product->stocks) }}" required />
            </div>

            <div class="flex justify-end mt-10">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" id="btn-submit">Update</button>
            </div>
        </form>
    </div>

    <div class="p-4 w-full border border-gray-100 shadow rounded-lg h-min mt-10">
        <h2 class="text-xl sm:text-2xl font-semibold mb-4">Statistic</h2>
        <div class="mb-10">
            <div class="p-4 border border-gray-100 shadow rounded-lg">
                <p class="">Solds</p>
                <p class="text-lg font-medium pl-0 sm:pl-10">{{ number_format(834883) }}</p>
            </div>
        </div>
        <div id="chart"></div>
    </div>

    <div class="p-4 w-full border border-gray-100 shadow rounded-lg h-min mt-10">
        <h2 class="text-xl sm:text-2xl text-red-500 font-semibold mb-4">Delete Product</h2>
        <p class="text-sm">Produk akan dihapus secara permanen, beserta product gambar dan relasinya</p>
        <div class="flex justify-center mt-5">
            <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" id="btn-delete">DELETE</button>
        </div>
    </div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
          
    var options = {
            series: [{
            name: "STOCK ABC",
            data: [1000, 203, 1233, 43993, 283823]
        }],
        chart: {
            type: 'area',
            height: 350,
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        labels: [21, 22, 23, 25, 26, 27],
        yaxis: {
            opposite: true
        },
        legend: {
            horizontalAlign: 'left'
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
<script>
    document.getElementById("btn-delete").addEventListener("click", () => {
        const random = Math.floor(Math.random() * 1000)

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "{{ route('master.product.delete', $product->id) }}"
            }
        })
    })
</script>
@endpush