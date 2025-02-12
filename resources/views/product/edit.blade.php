@extends('layout')

@section('page_name')
   Edit product
@endsection

@section('content')

    <div class="container d-flex justify-content-center mt-5 mb-5">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
            <h3 class="text-center text-warning mb-3">Edit Product</h3>

            <form method="POST" enctype="multipart/form-data" action="{{ route('product.save', ['id' => $id->id]) }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Enter product name" value="{{ $id->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Enter product description" rows="4" required>{{ $id->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <input name="brand" type="text" class="form-control" placeholder="Enter brand" value="{{ $id->brand }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input name="category" type="text" class="form-control" placeholder="Enter category" value="{{ $id->category }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input name="fileToUpload" type="file" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input name="price" type="number" step="0.01" class="form-control" placeholder="Enter price" value="{{ $id->price }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input name="quantity" type="number" class="form-control" placeholder="Enter amount" value="{{ $id->quantity }}" required>
                </div>

                <button type="submit" class="btn btn-warning w-100">Update Product</button>
            </form>
        </div>
    </div>


@endsection
