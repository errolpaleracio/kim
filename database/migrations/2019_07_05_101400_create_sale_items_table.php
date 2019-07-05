<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->decimal('unit_price', 13, 2);
            $table->unsignedInteger('product_id')
            ->references('id')
            ->on('products')
            ->onUpdate('cascade')
            ->onDelete('restrict');
            $table->unsignedInteger('sales_id')
            ->references('id')
            ->on('sales')
            ->onUpdate('cascade')
            ->onDelete('restrict');
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
        Schema::dropIfExists('sale_items');
    }
}
