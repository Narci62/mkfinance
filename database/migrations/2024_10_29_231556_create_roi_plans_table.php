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
        Schema::create('roi_plans', function (Blueprint $table) {
            $table->id()->comment('identifient plan de retour sur investissement (ROI)');
            $table->foreignId('reference_project')->constrained('projects');
            $table->decimal('expectROI',5,2)->comment('Rendement attendu sur l\'investissement ');
            $table->integer('paymentFrequency')->comment('frequence de paiements (en mois)');
            $table->string('paymentSchedule')->comment('liste des dates de paiements prévues');
            $table->integer('totalDuration')->comment('Durée total du plan de ROI');
            $table->string('adjusteSchedule')->comment('Ech\éancié des paiements des ROI ajusté en cas de retard ou autres');
            $table->enum('status',['waiting','rejected','validated'])->default("waiting");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roi_plans');
    }
};
