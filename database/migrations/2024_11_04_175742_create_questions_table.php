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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->string('attach')->nullable();
            $table->foreignId('sender')->constrained('users');
            //$table->foreignId('receiver')->constrained('users');
            $table->foreignId('companie_id')->constrained('companies')->onDelete('cascade');
            $table->boolean('status')->default(0)->comment('O : non lue ; 1 : lue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
