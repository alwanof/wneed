<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('title_a');
            $table->string('title_b')->nullable();
            $table->string('desc_a')->nullable();
            $table->string('desc_b')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('prevalence')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->boolean('available')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('agent_id');
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
        Schema::dropIfExists('items');
    }
}
