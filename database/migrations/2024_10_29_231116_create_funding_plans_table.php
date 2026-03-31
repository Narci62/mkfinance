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
        Schema::create('funding_plans', function (Blueprint $table) {
            $table->id()->comment('identifiant plan d\'investissement ');
            $table->string('fundUsage')->comment('detail de de l\'utilisation des fonds');
            $table->string('fundingSchedule')->comment('calendrier previsionel de l\'utilisation des fonds');
            $table->foreignId('reference_project')->constrained('projects');
            $table->enum('status',['waiting','rejected','validated'])->default("waiting");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funding_plans');
    }
};
