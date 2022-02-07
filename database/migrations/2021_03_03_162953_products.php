<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id')->autoIncrement()->from(0);
            $table->string('label'); 
            $table->foreignId('category_id')->constrained('categories'); //->references('cat')->on('cat_id)
            $table->integer('quantity');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->decimal('buying_cost', $precision = 8, $scale = 2);
            $table->decimal('selling_cost', $precision = 8, $scale = 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
