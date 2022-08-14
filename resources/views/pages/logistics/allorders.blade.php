@extends('layouts.app')

@section('content')

<main class="md:w-2/3 lg:w-3/4 px-4 mx-auto">

    <div class="flex py-2">
        <a href="" class="px-3 mr-2 py-1 inline-block text-sm text-blue-500 border border-gray-300 rounded-md hover:text-blue-500 hover:border-blue-600">
            Back to Menu
        </a>
        <a href="{{route('logistics.orders')}}" class="px-3 py-1 inline-block text-sm text-blue-500 border border-gray-300 rounded-md hover:text-blue-500 hover:border-blue-600">
            Orders to dispatch
        </a>
    </div>

    @foreach ($orders as $order)

    <article class="border border-gray-200 bg-white shadow-sm rounded mb-5 p-3 lg:p-5">
        <h3 class="text-xl font-semibold mb-5">Current orders</h3>



        <!-- item-order 2 -->
        <article class="p-3 lg:p-5 mb-5 bg-white border border-blue-600 rounded-md">
            <header class="lg:flex justify-between mb-4">
                <div class="mb-4 lg:mb-0">
                    <p class="font-semibold">
                        <span>Order ID: {{$order->id}} </span>
                        @if($order->dispatched)
                        <span class="text-green-500"> • Dispatched </span>
                        @else
                        <span class="text-red-500"> • Pending </span>
                        @endif

                    </p>
                    <p class="text-gray-500"> {{$order->created_at}} </p>
                </div>
                <div>

                    <!-- <button class="px-3 py-1 inline-block text-white text-sm bg-blue-600 border border-blue-600 rounded-md hover:bg-blue-700">
                        Track order
                    </button> -->

                </div>
            </header>
            <div class="grid md:grid-cols-3 gap-2">
                <div>
                    <p class="text-gray-400 mb-1">Person</p>
                    <ul class="text-gray-600">
                        <li>{{ $order->billing_name }}</li>
                        <li>Phone: {{$order->billing_phone}}</li>
                        <li>Email: {{$order->billing_email}}</li>
                    </ul>
                </div>
                <!-- <div>
                    <p class="text-gray-400 mb-1">Delivery address</p>
                    <ul class="text-gray-600">
                        <li>{{$order->billing_address}}</li>
                        <li>{{$order->billing_city}}, {{$order->billing_country}}</li>
                        <li>{{$order->billing_postalcode}}</li>
                    </ul>
                </div> -->

                @foreach ($omnivas as $omniva)
                @if (isset($omniva[0]))



                @if ($omniva[0]->order_id == $order->id)




                <!-- terminals -->
                <div>
                    <p class="text-gray-400 mb-1">Delivery terminal</p>
                    <ul class="text-gray-600">
                        <li class=" font-bold text-red-400">{{ $omniva[0]->name }}</li>
                        <li class="font-semibold">{{ $omniva[0]->city }}, {{ $omniva[0]->street }}</li>
                        <li class="text-sm mt-1">Terminal ID: {{ $omniva[0]->terminalId }}</li>
                        <li class="text-sm mt-1 font-bold">Order ID: <span class="font-bold text-red-400">{{$order->id}}</span></li>
                    </ul>
                </div>
                @endif
                @else
                @endif
                @endforeach


                <div>
                    <p class="text-gray-400 mb-1">Payment</p>
                    <ul class="text-gray-600">
                        <li class="text-green-400">Visa card **** Unknown</li>
                        <li>Shipping fee: €10.00</li>
                        <li>Total paid: €{{number_format($order->billing_subtotal / 100 + env('SHIPPING_FEE') / 100, 2)}}</li>
                    </ul>
                </div>
            </div> <!-- grid.// -->

            <hr class="my-4">

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2">
                @foreach ($orderedproducts as $orderedproduct)
                @if($orderedproduct->order_id == $order->id)
                @foreach ($products as $product)
                @if($product->id == $orderedproduct->product_id)
                <figure class="flex flex-row mb-4">
                    <div>
                        <a href="#" class="block w-20 h-20 rounded border border-gray-200 overflow-hidden">
                            <img src="{{ asset('images/products/' . $product->image_path) }}" alt="{{$product->name}}" class="w-full h-full object-fit p-1 object-contain">
                        </a>
                    </div>
                    <figcaption class="ml-3">
                        <p><a href="#" class="text-gray-600 hover:text-blue-600">{{$product->name}}</a></p>
                        <p class="mt-1 font-semibold">{{ $orderedproduct->quantity }}x = €{{number_format($product->price / 100, 2)}}</p>
                    </figcaption>
                </figure>
                @endif
                @endforeach
                @endif
                @endforeach


            </div> <!-- grid.// -->
        </article>
        <!-- item-order 2 //end -->

    </article> <!-- card.// -->
    @endforeach
    {{ $orders->links() }}
</main>

@endsection