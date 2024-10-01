<nav class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap">{{ env("APP_NAME") }}</span>
        </a>
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <div class="flex items-center lg:space-x-2">
                @auth
                <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 font-medium leading-none text-gray-900">
                    <span class="sr-only">Cart</span>
                    <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                    </svg> 
                    <span class="hidden sm:flex">My Cart</span>
                    <svg class="hidden sm:flex w-4 h-4 text-gray-900 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                    </svg>              
                </button>
        
                <div id="myCartDropdown1" class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg">
                    @if(isset(auth()->user()->cart->carts) && count(auth()->user()->cart->carts) > 0)
                    @foreach (auth()->user()->cart->carts as $key => $item)
                    <div class="grid grid-cols-2">
                        <div>
                            <a href="{{ route('market.detail', $key) }}" class="truncate text-sm font-semibold leading-none text-gray-900 hover:underline">{{ $item['name'] }}</a>
                            <p class="mt-0.5 truncate text-sm font-normal text-gray-500">Rp. {{ number_format($item['price'] * $item['qty']) }}</p>
                        </div>
                    
                        <div class="flex items-center justify-end gap-6">
                            <p class="text-sm font-normal leading-none text-gray-500">Qty: {{ $item['qty'] }}</p>
                    
                            <a href="{{ route('cart.delete', $key) }}" data-tooltip-target="tooltipRemoveItem1a" type="button" class="text-red-600 hover:text-red-700">
                                <span class="sr-only"> Remove </span>
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <div id="tooltipRemoveItem1a" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
                                Remove item
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                
                    <a href="{{ route('order.create') }}" title="" class="mb-2 bg-blue-500 me-2 inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300" role="button"> Proceed to Checkout </a>
                    @else

                    <div class="text-sm p-2 text-gray-400">No Product in Cart</div>

                    @endif
                </div>
        
                <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 font-medium leading-none text-gray-900">
                    <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                    Account
                    <svg class="w-4 h-4 text-gray-900 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                    </svg> 
                </button>
        
                <div id="userDropdown1" class="hidden z-10 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow">
                    <ul class="p-2 text-start text-sm font-medium text-gray-900">
                        <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100"> My Account </a></li>
                        <li><a href="{{ route('order.index') }}" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100"> My Orders </a></li>
                        <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100"> Settings </a></li>
                        <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100"> Favourites </a></li>
                        <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100"> Delivery Addresses </a></li>
                    </ul>
                
                    <div class="p-2 text-sm font-medium text-gray-900">
                        <a href="{{ route('logout') }}" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm text-red-700 hover:bg-gray-100"> Sign Out </a>
                        @if (in_array(auth()->user()->role, ['ADMIN', 'SUPERADMIN']))
                        <a href="{{ route('dashboard') }}" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100">Dashboard</a>
                        @endif
                    </div>
                </div>
                @endauth
                @guest
                <a href="{{ route('login') }}" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 font-medium leading-none text-gray-900">
                    <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                    Account
                </a>
                @endguest
        
                <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="/" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">Home</a>
                </li>
                <li>
                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">About</a>
                    </li>
                <li>
                    <a href="{{ route('market.index') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Markets</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Pricing</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Contact</a>
                </li>
            </ul>
        </div>

    </div>
</nav>  