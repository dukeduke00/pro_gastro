@extends('layout')

@section('page_name')
    ProGastro
@endsection

@section('content')

    <div class="container mt-5 mb-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="product_image" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body text-center">
                            <a href="{{ route('product.single', $product->id) }}" class="text-decoration-none">
                                <h5 class="card-title text-primary">{{ $product->name }}</h5>
                            </a>
                            <p class="h6 text-success fw-bold">{{ number_format($product->price, 2) }}&euro;</p>
                            <a href="{{ route('product.single', $product->id) }}" class="btn btn-outline-primary w-100">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
