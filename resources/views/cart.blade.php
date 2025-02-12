@extends('layout')

@section('page_name')
    ProGastro
@endsection

@section('content')

    @if(isset($emptyCart) && $emptyCart)
        <p>Vaša korpa je prazna.</p>
    @else
        @foreach($combinedItems as $item)
            <p>Name: {{ $item['name'] }}</p>
            <input type="number" value="{{ $item['amount'] }}">
            <p>Price: {{ $item['price'] }}</p>
            <p>Total price: {{ $item['total'] }}</p>
            <hr>
        @endforeach

        <a href="{{ route('cart.finish') }}">Order now</a>
    @endif

@endsection
