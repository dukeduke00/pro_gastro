@vite(['resources/css/products.css']);

@extends('layout')

@section('page_name')
{{ $pageName }}
@endsection

@section('content')

    @if($products->isEmpty())
        <p class="alert alert-warning text-center">We did not find any products.</p>
    @else
    <div class="all_products container mt-5 mb-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($products as $product)
                <div class="col ">
                    <div class="card h-100 product_single">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="product_image" class="card-img-top" style="height: 100%;  object-fit: cover;">
                        @endif

                        <div class="product_info">
                            <p><a class="product_name" href="{{ route('product.single', $product->id) }}">{{ $product->name }}</a></p>
                            <p class="product_price">{{ number_format($product->price, 2) }}&euro;</p>
                            <p class="product_amount {{ $product->quantity > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $product->quantity > 0 ? 'In stock' : 'Out of stock' }}
                            </p>
                            <a href="{{ route('product.single', $product->id) }}" class="product_details">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    @if ($products->lastPage() > 1)
        <ul class="pagination">
            {{-- Dugme "Prva" --}}
            @if ($products->currentPage() > 3)
                <li><a href="{{ $products->url(1) }}">1</a></li>
                @if ($products->currentPage() > 4)
                    <li class="dots">...</li>
                @endif
            @endif

            {{-- Prikaz prethodne dve stranice --}}
            @for ($i = max(1, $products->currentPage() - 2); $i < $products->currentPage(); $i++)
                <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
            @endfor

            {{-- Trenutna stranica --}}
            <li class="active"><a href="javascript:void(0)">{{ $products->currentPage() }}</a></li>

            {{-- Prikaz sledeće dve stranice --}}
            @for ($i = $products->currentPage() + 1; $i <= min($products->lastPage(), $products->currentPage() + 2); $i++)
                <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
            @endfor

            {{-- Dots i poslednja stranica --}}
            @if ($products->currentPage() < $products->lastPage() - 2)
                @if ($products->currentPage() < $products->lastPage() - 3)
                    <li class="dots">...</li>
                @endif
                <li><a href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a></li>
            @endif
        </ul>
    @endif



    @endif

@endsection
