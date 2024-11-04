@extends('products.layout')

@section('content')

@if (session('login_success'))
    <div class="alert alert-success mt-3" role="alert"> {{ session('login_success') }} </div>
@endif

<div class="card mt-5">
  <h2 class="card-header">Vending Machine</h2>
  <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('products.create') }}"> <i class="fa fa-plus"></i> Create New Product</a>
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
                    <td>
                        <form action="{{ route('products.delete',$product->id) }}" method="POST">

                            <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
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
