@extends('layout')

@section('page_name')
    Add product
@endsection

@section('content')

    <form  style="margin: 100px 600px"  class=" d-flex justify-content-center gap-3 flex-column" method="POST" enctype="multipart/form-data" action="{{ route("product.store") }}">


        @csrf
        <input name="name" type="text" placeholder="Name">
        <textarea name="description" type="text" placeholder="Description" rows="4"></textarea>
        <input name="brand" type="text" placeholder="Brand">
        <input name="category" type="text" placeholder="Category">
        <input name="fileToUpload" type="file" placeholder="Image">
        <input name="price" type="number" step="0.01" placeholder="Price">
        <input name="quantity" type="number" placeholder="Quantity">

        <button>Add product</button>

    </form>

@endsection

