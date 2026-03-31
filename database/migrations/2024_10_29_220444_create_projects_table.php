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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('imat');
            $table->text('titled');
            $table->string('featured_image');
            $table->longText('description');
            $table->decimal('totalFundedNeeded',12,2)->comment('montant total recherché pour le projet');
            $table->decimal('InvestmentAmountfix',12,2)->comment('montant fixe d\'investissement');
            $table->decimal('amountToStart',12,2)->comment('montant minimum pour demarrer le projet');
            $table->string('makeStudy')->comment('Etude de marché du projet'); 
            $table->foreignId('project_of')->constrained('companies');
            $table->enum('status',['waiting','rejected','validated'])->default("waiting");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
