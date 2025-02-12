@extends('layout')

@section('page_name')
    {{ $id->name }}
@endsection

@section('content')


    <div class="card shadow-sm p-3 m-5 bg-white rounded" style="max-width: 400px;">
        @if($id->image)
            <img src="{{ asset('storage/' . $id->image) }}" alt="product_image" class="card-img-top rounded" style="max-height: 200px; object-fit: cover;">
        @endif

        <div class="card-body text-center">
            <h3 class="card-title text-primary">{{ $id->name }}</h3>
            <p class="card-text text-muted">{{ $id->description }}</p>
            <p class="h5 text-success fw-bold">{{ number_format($id->price, 2) }}&euro;</p>

            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100">Back</a>

            @if(Auth::check() && Auth::user()->role === 'admin')
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('product.edit', $id->id) }}" class="btn btn-warning">✏ Edit</a>
                    <a href="{{ route('product.delete', $id->id) }}" class="btn btn-danger">🗑 Delete</a>
                </div>
            @endif
        </div>

            <form method="POST" action="{{ route('cart.add') }}">

                @csrf

                <input type="hidden" name="id" value="{{ $id->id }}">
                <input type="text" name="amount" placeholder="Enter amount">
                <button>Add to cart</button>
            </form>
    </div>


@endsection
