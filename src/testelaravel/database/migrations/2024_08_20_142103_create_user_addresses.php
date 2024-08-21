<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();

            $table->string('street');
            $table->string('district');
            $table->string('number')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');

            $table->foreignUlid('user_ulid')
                ->index()
                ->constrained('users')
                ->references('ulid')
                ->noActionOnUpdate()
                ->noActionOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
};
