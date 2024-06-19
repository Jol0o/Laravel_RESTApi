<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number');
            $table->enum('type', ['single', 'double', 'suite']);
            $table->decimal('price', 8, 2);
            $table->enum('status', ['available', 'booked', 'maintenance']);
            $table->timestamps();
            $table->string('img');
        });

    }
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
