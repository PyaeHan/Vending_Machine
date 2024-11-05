<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::sortable()->latest()->paginate(5);

        return view('products.index', compact('products'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        Product::create($request->validated());

        return redirect()->route('products.index')
        ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return redirect()->route('products.index')
        ->with('success','Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
        ->with('success','Product deleted successfully.');
    }

    /**
     * Purchase Product Page
     */
    public function purchase($id): View | RedirectResponse
    {
        $product = Product::findOrFail($id);
        if ($product->available_quantity < 1) {
            return redirect()->route('products.index')
            ->with('purchase_error','Sorry, product out of stocks.');
        }
        return view('products.purchase',compact('product'));
    }

    /**
     * Store purchase and transaction data
     */
    public function storePurchase(PurchaseRequest $request, $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        if ($request->purchased_quantity > $product->available_quantity) {
            return redirect()->route('products.index')
            ->with('purchase_error','Sorry for the inconvenience.Insufficient product stocks.');
        }

        DB::beginTransaction();
        try {
            // Update the product available_quantity
            $new_available_quantity = $product->available_quantity - $request->purchased_quantity;
            $product->available_quantity = $new_available_quantity;
            $product->save();

            // Store the transaction data
            $transaction_data = [
                'product_id' => $product->id,
                'user_id' => auth()->user()->id,
                'purchased_price' => $product->price,
                'purchased_quantity' => $request->purchased_quantity,
                'price_total' => $product->price * $request->purchased_quantity,
            ];
            Transaction::create($transaction_data);

            DB::commit(); // Commit the transaction if both updates are successful
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction if an error occurs

            // Handle the exception (log it, return an error response, etc.)
            info($e->getMessage());
            return redirect()->route('products.index')
            ->with('purchase_error','Sorry, unable to purchase.');
        }
        return redirect()->route('products.index')
            ->with('purchase_success','Product purchased successfully.');
    }
}
