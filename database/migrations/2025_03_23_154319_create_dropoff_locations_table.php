<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dropoff_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('charity_id')->constrained()->onDelete('cascade');
            $table->string('location_name');
            $table->string('cord'); // Coordinates (latitude, longitude)
            $table->boolean('collection_point')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dropoff_locations');
    }
};

