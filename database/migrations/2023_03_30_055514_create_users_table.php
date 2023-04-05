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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->nullable();
            $table->string('f_name', 255)->nullable();
            $table->string('l_name', 255)->nullable();
            $table->string('phone', 25);
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('image', 255)->default("def.png");
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 80);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->string('street_address', 255)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('zip', 20)->nullable();
            $table->string('house_no', 50)->nullable();
            $table->string('apartment_no', 50)->nullable();
            $table->string('firebase_token', 255)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=>active, 2=>blocked, 3=>deleted');
            $table->tinyInteger('is_email_verified')->default(0);
            $table->tinyInteger('is_phone_verified')->default(0);
            $table->double('wallet_balance', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
