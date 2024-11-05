@extends('transactions.layout')

@section('content')

@auth
    <p>Username: {{ auth()->user()->name }}{{ auth()->user()->type == 1 ? "(Admin)" : "(User)" }}</p>
@endauth
<div class="card mt-5">
  <h2 class="card-header">Vending Machine</h2>
  <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No.</th>
                    <th>Product Name</th>
                    <th>Customer Name</th>
                    <th>Purchased Price</th>
                    <th>Purchased Quantity</th>
                    <th>Total Amount</th>
                    <th>Transaction Date Time</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $transaction->product->name ?? 'DELETED PRODUCT' }}</td>
                    <td>{{ $transaction->user->name ?? 'DELETED User' }}</td>
                    <td>{{ $transaction->purchased_price }} USD</td>
                    <td>{{ $transaction->purchased_quantity }}</td>
                    <td>{{ $transaction->price_total }} USD</td>
                    <td>{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; vertical-align: middle; height: 100px;">There are no data.</td>
                </tr>
            @endforelse
            </tbody>

        </table>

        {!! $transactions->appends(request()->except('page'))->render() !!}

  </div>
</div>
@endsection
