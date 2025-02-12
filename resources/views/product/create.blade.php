@extends('layout')

@section('page_name')
    Add product
@endsection

@section('content')

    <div class="container d-flex justify-content-center mt-5 mb-5">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
            <h3 class="text-center text-primary mb-3">Add product</h3>

            <form method="POST" enctype="multipart/form-data" action="{{ route('product.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Product name</label>
                    <input name="name" type="text" class="form-control" placeholder="Enter name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Enter description" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <input name="brand" type="text" class="form-control" placeholder="Enter brand" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input name="category" type="text" class="form-control" placeholder="Enter category" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product image</label>
                    <input name="fileToUpload" type="file" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input name="price" type="number" step="0.01" class="form-control" placeholder="Enter price" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input name="quantity" type="number" class="form-control" placeholder="Enter amount" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Add product</button>
            </form>
        </div>
    </div>


@endsection

