<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index()->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('dist');
            $table->string('aprt');
            $table->string('house');
            $table->string('bell')->nullable();
            $table->double('lat');
            $table->double('lng');
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('total')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('note_a')->nullable();
            $table->string('note_b')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parent');
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
        Schema::dropIfExists('orders');
    }
}
