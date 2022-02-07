<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Shipments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id('id')->autoIncrement()->from(1000);
            $table->date('date'); 
            $table->foreignId('type_id')->constrained('shipment_type'); 
            $table->integer('quantity');
            $table->foreignId('product_id')->constrained('products'); 
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->decimal('total_price', $precision = 8, $scale = 2);
            $table->boolean('finalized')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
