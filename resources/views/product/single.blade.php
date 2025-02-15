@vite(['resources/css/single_product.css']);

@extends('layout')

@section('page_name')
    {{ $id->name }}
@endsection

@section('content')


    <div class="single_product container">
            <!-- Left side - Photo -->
            <div class="single_product_left">
                @if($id->image)
                    <img src="{{ asset('storage/' . $id->image) }}" alt="product_image">
                @endif
            </div>

            <!-- Right side - text and button -->
            <div class="single_product_right">

                    <h4 class="single_product_brand">{{ $id->brand }}</h4>
                    <h3 class="single_product_name">{{ $id->name }}</h3>
                    <p class="single_product_description">{{ $id->description }}</p>

                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <p class="single_product_admin_amount">Amount: {{ $id->quantity }} </p>

                    @else
                        <p class="single_product_amount {{ $id->quantity > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $id->quantity > 0 ? 'In stock' : 'Out of stock' }}
                        </p>
                    @endif

                    <p class="single_product_price">{{ number_format($id->price, 2) }}&euro;</p>

                    <a href="{{ url()->previous() }}" class="single_product_back">Back</a>

                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <div class="single_product_admin_functions">
                                <a class="single_product_edit" href="{{ route('product.edit', $id->id) }}">
                                    <i class='bx bx-pencil' ></i>
                                    Edit
                                </a>
                            <a class="single_product_delete" href="{{ route('product.delete', $id->id) }}">
                                <i class='bx bx-trash' ></i>
                                Delete
                            </a>
                        </div>
                    @endif

                    <!-- Cart form -->
                    @auth
                        <form class="single_product_cart" method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id->id }}">
                            <input type="number" name="amount" class="" placeholder="Enter amount" min="1" required>
                            <button type="submit" class="">Add to Cart</button>

                        </form>
                    @else
                        <a class="single_product_login" href="{{ route('login') }}">You must be logged in to add a product to your cart</a>
                    @endauth


            </div>
        </div>





@endsection
