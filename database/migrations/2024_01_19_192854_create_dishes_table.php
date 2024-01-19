<?php
// database/migrations/xxxx_xx_xx_create_dishes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->unique();
            $table->string('image_url');
            $table->unsignedInteger('price'); // Change 'price' to 'unsignedInteger'
            $table->unsignedInteger('rating')->default(0); // Add 'rating' column with default value 0
            // Add any additional columns you need for the 'dishes' table
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
        Schema::dropIfExists('dishes');
    }
}
