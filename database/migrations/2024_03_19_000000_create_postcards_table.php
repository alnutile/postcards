<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postcards', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_name');
            $table->string('street_1');
            $table->string('street_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->text('message');
            $table->string('filename');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postcards');
    }
};
