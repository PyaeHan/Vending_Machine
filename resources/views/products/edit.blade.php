@extends('products.layout')

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Edit Product</h2>
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="inputName" class="form-label"><strong>Product Name:</strong></label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $product->name) }}"
                class="form-control @error('name') is-invalid @enderror"
                id="inputName"
                placeholder="Product Name"
                autocomplete="off" required>
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputPrice" class="form-label"><strong>Price:</strong></label>
            <input
                type="number"
                name="price"
                value="{{ old('price', $product->price) }}"
                step="0.001"
                min="0.001"
                class="form-control @error('price') is-invalid @enderror"
                id="inputPrice"
                placeholder="Price"
                autocomplete="off" required>
            @error('price')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputAvailableQuantity" class="form-label"><strong>Available Quantity:</strong></label>
            <input
                type="number"
                name="available_quantity"
                value="{{ old('available_quantity', $product->available_quantity) }}"
                min="0"
                class="form-control @error('available_quantity') is-invalid @enderror"
                id="inputAvailableQuantity"
                placeholder="Available Quantity"
                autocomplete="off" required>
            @error('available_quantity')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
    </form>

  </div>
</div>
@endsection
