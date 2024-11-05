@extends('products.layout')

@section('content')

@if (session('login_success'))
    <div class="alert alert-success mt-3" role="alert"> {{ session('login_success') }} </div>
@endif
@if (session('access_error'))
    <div class="alert alert-danger mt-3" role="alert"> {{ session('access_error') }} </div>
@endif

@auth
    <p>Username: {{ auth()->user()->name }}{{ auth()->user()->type == 1 ? "(Admin)" : "(User)" }}</p>
    <a class="btn btn-secondary btn-sm" href="{{ route('logout') }}">Logout</a>
@endauth
<div class="card mt-5">
  <h2 class="card-header">Vending Machine</h2>
  <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        @if (session('purchase_success'))
            <div class="alert alert-success" role="alert"> {{ session('purchase_success') }} </div>
        @endif
        @if (session('purchase_error'))
            <div class="alert alert-danger" role="alert"> {{ session('purchase_error') }} </div>
        @endif

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="d-grid gap-2">
                    <a class="btn btn-info btn-sm" href="{{ route('transactions.index') }}">
                        @if (auth()->user()->type == 1)
                            <i class="fa fa-clipboard-list"></i> Transaction List
                        @else
                            <i class="fa fa-history"></i> Purchase History
                        @endif
                    </a>
                </div>
                @if (auth()->user()->type == 1)
                    <div class="d-grid gap-2">
                        <a class="btn btn-success btn-sm" href="{{ route('products.create') }}"> <i class="fa fa-plus"></i> Create New Product</a>
                    </div>
                @endif
            </div>
        </div>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No.</th>
                    <th>@sortablelink('name', 'Product Name')</th>
                    <th>@sortablelink('price', 'Price')</th>
                    <th>@sortablelink('available_quantity', 'Available Quantity')</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }} USD</td>
                    <td>{{ $product->available_quantity }}</td>
                    @if (auth()->user()->type == 1)
                        <td>
                            <form action="{{ route('products.delete', $product->id) }}" method="POST" onsubmit="return confirmDelete()">

                                <a class="btn btn-primary btn-sm" href="{{ route('products.edit', $product->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                                <a class="btn btn-success btn-sm" href="{{ route('products.purchase', $product->id) }}"><i class="fa-solid fa-cart-shopping"></i></a>
                            </form>
                        </td>
                    @else
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ route('products.purchase', $product->id) }}">Purchase</a>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; vertical-align: middle; height: 100px;">There are no data.</td>
                </tr>
            @endforelse
            </tbody>

        </table>

        {!! $products->appends(request()->except('page'))->render() !!}

  </div>
</div>
@endsection

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this product?");
    }
</script>
