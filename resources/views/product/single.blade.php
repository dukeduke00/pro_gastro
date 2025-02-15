@extends('layout')

@section('page_name')
    {{ $id->name }}
@endsection

@section('content')


    <div class="card shadow-sm p-3 m-5 bg-white rounded" style="max-width: 900px;">
        <div class="row g-0 align-items-center">
            <!-- Leva strana - Slika (veća) -->
            <div class="col-md-7">
                @if($id->image)
                    <img src="{{ asset('storage/' . $id->image) }}" alt="product_image"
                         class="img-fluid rounded" style="height: 380px; width: 100%; object-fit: cover;">
                @endif
            </div>

            <!-- Desna strana - Tekst i dugmad (malo šire) -->
            <div class="col-md-5">
                <div class="card-body text-center">
                    <h3 class="card-title text-primary">{{ $id->name }}</h3>
                    <p class="card-text text-muted">{{ $id->description }}</p>
                    <p class="h5 text-success fw-bold">{{ number_format($id->price, 2) }}&euro;</p>

                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-100 mb-2">Back</a>

                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('product.edit', $id->id) }}" class="btn btn-warning w-45">✏ Edit</a>
                            <a href="{{ route('product.delete', $id->id) }}" class="btn btn-danger w-45">🗑 Delete</a>
                        </div>
                    @endif

                    <!-- Forma za dodavanje u korpu -->
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id->id }}">

                        <div class="input-group">
                            <input type="number" name="amount" class="form-control text-center" placeholder="Enter amount" min="1" required>
                            <button type="submit" class="btn btn-success">🛒 Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
