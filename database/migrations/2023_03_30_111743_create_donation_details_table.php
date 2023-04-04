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
        Schema::create('donation_details', function (Blueprint $table) {
            $table->id();
            $table->string("receiver_name");
            $table->date("date_of_donation");
            $table->unsignedBigInteger("customer_id")->index()->nullable(false);
            $table->foreign("customer_id")->references("id")->on("users")->onDelete("cascade");
            $table->unsignedBigInteger("ngo_id")->index()->nullable(false);
            $table->foreign("ngo_id")->references("id")->on("ngos")->onDelete("cascade");
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
        Schema::dropIfExists('donation_details');
    }
};
