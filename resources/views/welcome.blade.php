@extends('layout')

@section('page_name')
    ProGastro
@endsection

@section('content')

    @foreach ($products as $product)
        <div class="product">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Slika proizvoda" width="150">
            @endif
        </div>
    @endforeach
@endsection
