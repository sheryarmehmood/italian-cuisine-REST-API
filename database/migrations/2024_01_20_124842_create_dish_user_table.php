<?php
// In the migration file (create_dish_user_table.php)
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishUserTable extends Migration
{
    public function up()
    {
        Schema::create('dish_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('dish_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('rating');

            // Add a unique constraint to ensure a user can only rate a dish once
            $table->unique(['user_id', 'dish_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('dish_user');
    }
}
