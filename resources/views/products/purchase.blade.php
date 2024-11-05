@extends('products.layout')

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Purchase Product ({{ $product->name }})</h2>
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <form action="{{ route('products.store.purchase', $product->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product Name:</strong> <br/>
                    {{ $product->name }}
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Price:</strong> <br/>
                    {{ $product->price }}
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="inputPurchaseQuantity" class="form-label"><strong>Purchase Quantity:</strong></label>
            <input
                type="number"
                name="purchased_quantity"
                value="1"
                min="1"
                max="{{ $product->available_quantity }}"
                class="form-control @error('purchased_quantity') is-invalid @enderror"
                id="inputPurchaseQuantity"
                placeholder="Purchase Quantity"
                onchange="calculateTotal()"
                oninput="calculateTotal()"
                autocomplete="off" required>
            @error('purchased_quantity')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Total Amount:</strong> <br/>
                    <span id="totalAmount">{{ $product->price }}</span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-cart-shopping"></i> Purchase</button>
    </form>

  </div>
</div>
@endsection

<script>
    function calculateTotal() {
        const price = {{ $product->price }};

        // Get the input value for purchased quantity
        const quantity = document.getElementById('inputPurchaseQuantity').value;

        // Calculate the total amount
        const totalAmount = price * quantity;

        // Display the total amount in the designated span
        document.getElementById('totalAmount').textContent = totalAmount.toFixed(3);
    }
</script>
