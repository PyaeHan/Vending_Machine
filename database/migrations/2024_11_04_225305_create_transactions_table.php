<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null'); // Foreign key for products, set to null on delete
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Foreign key for users, set to null on delete
            $table->decimal('purchased_price', 8, 3);
            $table->integer('purchased_quantity');
            $table->decimal('price_total', 8, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
