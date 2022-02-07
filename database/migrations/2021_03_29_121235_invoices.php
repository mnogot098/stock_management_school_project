<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Invoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->autoIncrement()->from(1000);
            $table->timestamp('date')->useCurrent();
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->decimal('amount', $precision = 8, $scale = 2);
            $table->boolean('finalized')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
