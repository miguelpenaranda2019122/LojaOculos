<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('oculo', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->string('color');
            $table->string('material');
            $table->string('image');
            $table->string('description');
            $table->float('price');
            $table->integer('stock');
            $table->float('tamanho');
            $table->float('largura');
            $table->float('altura');
            $table->float('ponte');
            $table->float('comprimento_haste');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oculo');
    }
};
