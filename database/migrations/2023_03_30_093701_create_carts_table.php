<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer("total_price")->nullable(false);
            $table->bigInteger("customer_id")->index()->nullable(false)->unsigned();
            $table->bigInteger("product_id")->nullable(false)->unsigned()->index();
            $table->foreign("customer_id","product_id")->references("id","id")->on("users","products")->onDelete("cascade");
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
        Schema::dropIfExists('carts');
    }
};
